const MenuItems = document.getElementById("MenuItems");
MenuItems.style.maxHeight = "0px";

function menutoggle() {
  MenuItems.style.maxHeight =
    MenuItems.style.maxHeight === "0px" ? "200px" : "0px";
}

function renderProducts(newProducts) {
  const prodsSection = document.getElementById("products");
  const template = document.getElementById("template");

  for (let i = 0; i < Math.min(newProducts.length, 10); i++) {
    const product = newProducts[i];

    let html = template.innerHTML
      .replace("{{prod-image}}", product.imagePath)
      .replace("{{prod-name}}", product.name)
      .replace("{{prod-description}}", product.description)
      .replace("{{prod-price}}", product.price);

    const productElement = document.createElement("div");
    productElement.innerHTML = html;

    // Adicione o manipulador de eventos de clique ao elemento do produto
    productElement.addEventListener("click", function () {
      redirectToProductPage(product.code); // Redirecionar para a página do produto com o ID do produto
    });

    prodsSection.appendChild(productElement);
  }
}

async function loadProducts() {
  try {
    let response = await fetch("./php/produtos.php?codCategoria=");
    if (!response.ok) throw new Error(response.statusText);
    var products = await response.json();
  } catch (e) {
    console.error(e);
    return;
  }

  renderProducts(products);
}

window.onload = function () {
  loadProducts();
};

function redirectToProductPage(productId) {
  // Redirecionar para a página produto.php com o ID do produto
  window.location.href = `./php/produto.php?id=${productId}`;
}
