function verificarLogin() {
  const usuarioInput = document.getElementById("usuario");
  const senhaInput = document.getElementById("senha");

  const usuario = usuarioInput.value;
  const senha = senhaInput.value;

  // Limpa qualquer classe anterior
  usuarioInput.classList.remove("user_pass_fail");
  senhaInput.classList.remove("user_pass_fail");

  if (usuario === "user" && senha === "pass") {
    alert("Login Ok");
  } else {
    alert("Usuário ou senha incorretos.");
    usuarioInput.classList.add("user_pass_fail");
    senhaInput.classList.add("user_pass_fail");
  }
}
