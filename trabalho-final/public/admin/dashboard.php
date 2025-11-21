<?php
require_once __DIR__ . '/inc/auth.php';
require_once __DIR__ . '/../../src/db.php';
require_once __DIR__ . '/../../src/perguntas.php';

$conn = conectarBanco();
$totalAval = 0;
$mediaGeral = 0;
$porDispositivo = array();
if ($conn) {
    $r1 = pg_query($conn, "SELECT COUNT(*) AS t, AVG(resposta) AS m FROM avaliacoes");
    if ($r1) {
        $row = pg_fetch_assoc($r1);
        $totalAval = (int)$row['t'];
        $mediaGeral = $row['m'] !== null ? round((float)$row['m'], 2) : 0;
    }
    $r2 = pg_query($conn, "SELECT d.nome, COUNT(a.id) AS total, AVG(a.resposta) AS media
                           FROM dispositivos d LEFT JOIN avaliacoes a ON a.id_dispositivo=d.id
                           GROUP BY d.id, d.nome ORDER BY d.id");
    if ($r2) {
        while ($rw = pg_fetch_assoc($r2)) {
            $porDispositivo[] = $rw;
        }
    }
    pg_close($conn);
}
$mediasPerguntas = mediaPorPergunta();
// Preparar arrays JS
$labelsPerguntas = array_map(fn($p) => $p['texto'], $mediasPerguntas);
$dataPerguntas = array_map(fn($p) => $p['media'] ? round($p['media'], 2) : 0, $mediasPerguntas);
$labelsDispositivos = array_map(fn($d) => $d['nome'], $porDispositivo);
$dataDispositivos = array_map(fn($d) => $d['media'] ? round($d['media'], 2) : 0, $porDispositivo);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #fafafa;
            color: #333
        }

        header {
            background: #4a148c;
            color: #fff;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        nav a {
            color: #fff;
            margin-right: 12px;
            text-decoration: none;
            font-size: 14px
        }

        .container {
            padding: 15px;
            max-width: 1000px;
            margin: 0 auto
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-bottom: 20px
        }

        .card {
            background: #fff;
            padding: 12px;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1)
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 6px;
            font-size: 14px;
            text-align: left
        }

        .table th {
            background: #eee
        }

        footer {
            margin-top: 30px;
            font-size: 12px;
            text-align: center;
            color: #666
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 11px;
            background: #4a148c;
            color: #fff
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header>
        <div><strong>Painel Admin</strong></div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="perguntas.php">Perguntas</a>
            <a href="logout.php">Sair</a>
        </nav>
    </header>
    <div class="container">
        <h2>Visão Geral</h2>
        <div class="cards">
            <div class="card"><strong>Total Avaliações</strong><br><?php echo $totalAval; ?></div>
            <div class="card"><strong>Média Geral</strong><br><?php echo $mediaGeral ?: '0'; ?></div>
        </div>
        <h3>Médias por Pergunta</h3>
        <canvas id="chartPerguntas" height="120"></canvas>
        <h3>Média por Dispositivo</h3>
        <canvas id="chartDispositivos" height="120"></canvas>
    </div>
    <footer>Admin &copy; <?php echo date('Y'); ?></footer>
    <script>
        const perguntasLabels = <?php echo json_encode($labelsPerguntas, JSON_UNESCAPED_UNICODE); ?>;
        const perguntasData = <?php echo json_encode($dataPerguntas); ?>;
        const dispositivosLabels = <?php echo json_encode($labelsDispositivos, JSON_UNESCAPED_UNICODE); ?>;
        const dispositivosData = <?php echo json_encode($dataDispositivos); ?>;

        function barChart(id, labels, data, label) {
            new Chart(document.getElementById(id), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: '#4a148c'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        function lineChart(id, labels, data, label) {
            new Chart(document.getElementById(id), {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        fill: false,
                        borderColor: '#4a148c',
                        tension: .2
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        if (perguntasLabels.length) {
            barChart('chartPerguntas', perguntasLabels, perguntasData, 'Média');
        }
        if (dispositivosLabels.length) {
            barChart('chartDispositivos', dispositivosLabels, dispositivosData, 'Média');
        }
    </script>
</body>

</html>