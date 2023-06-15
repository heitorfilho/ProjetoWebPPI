// Script para ativar menu em mobile (em formato burguer)
const menuItems = document.getElementById("MenuItems");
menuItems.style.maxHeight = "0px";

const toggleMenu = () => {
  menuItems.style.maxHeight =
    menuItems.style.maxHeight === "0px" ? "200px" : "0px";
};

// Script para ativar formulário
const formEntrar = document.querySelector("#formEntrar");
const formCadastrar = document.querySelector("#formCadastrar");
const indicador = document.querySelector("#indicador");

const entrar = () => {
  formCadastrar.style.transform = `translateX(300px)`;
  formEntrar.style.transform = `translateX(300px)`;
  indicador.style.transform = `translateX(0px)`;
};

const cadastrar = () => {
  formCadastrar.style.transform = `translateX(0px)`;
  formEntrar.style.transform = `translateX(0px)`;
  indicador.style.transform = `translateX(100px)`;
};

// Função para fazer o login de forma assíncrona usando fetch
const login = async (form) => {
  try {
    const response = await fetch("../php/login.php", {
      method: "post",
      body: new FormData(form),
    });
    if (!response.ok) throw new Error(response.statusText);
    const result = await response.json();

    if (result.success) {
      window.location = result.detail;
    } else {
      form.senha.value = "";
      form.senha.focus();
    }
  } catch (error) {
    console.error(error);
  }
};

window.addEventListener("load", () => {
  const form = document.forms.formEntrar;
  form.addEventListener("submit", (event) => {
    login(form);
    event.preventDefault();
  });
});
