// script para mostrar/esconder a senha
document.addEventListener("DOMContentLoaded", () => {
  // script para mostrar/esconder a senha
  function togglePasswordVisibility() {
    const passwordInput = document.querySelector(".password-wrapper input");
    const passwordToggle = document.querySelector(
      ".password-wrapper .password-toggle"
    );

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      passwordToggle.textContent = "Esconder";
    } else {
      passwordInput.type = "password";
      passwordToggle.textContent = "Mostrar";
    }
  }

  const passwordToggle = document.querySelector(
    ".password-wrapper .password-toggle"
  );
  passwordToggle.addEventListener("click", togglePasswordVisibility);
});
