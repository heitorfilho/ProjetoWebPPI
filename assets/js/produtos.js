// funcao para buscar todas as categorias no banco de dados e colocar no label para select usando fetch
async function buscarCategorias() {
  try {
    const response = await fetch("../php/categorias.php");
    const data = await response.json();
    let html = '<option value="">Selecione uma categoria</option>';
    data.forEach((categoria) => {
      html += `<option value="${categoria.code}">${categoria.name}</option>`;
    });
    document.getElementById("categoria").innerHTML = html;
  } catch (e) {
    console.error(e);
  }
}

// funcao para buscar todos os produtos de acordo com a categoria selecionada
async function renderProducts(newProducts) {
  const prodsSection = document.getElementById("products");
  const template = document.getElementById("template");

  // Remove old products
  while (prodsSection.children.length > 1) {
    prodsSection.removeChild(prodsSection.lastChild);
  }

  for await (const product of newProducts) {
    const { imagePath, name, price, description, code } = product;

    const productElement = template.content.cloneNode(true);
    const itemImage = productElement.querySelector(".item-image");
    itemImage.src = `../assets/images/${imagePath}`;
    productElement.querySelector(".item-name").textContent = name;
    productElement.querySelector(".item-price").textContent = price;
    productElement.querySelector(".item-description").textContent = description;

    const item = productElement.querySelector(".item");
    item.addEventListener("click", () => redirectToProductPage(code));

    prodsSection.appendChild(productElement);
    await new Promise((resolve) => requestAnimationFrame(resolve));
  }
}

async function loadProducts() {
  try {
    const selectCategoria = document.getElementById("categoria");
    const codCategoria = selectCategoria.value;

    const response = await fetch(
      `../php/produtos.php?codCategoria=${codCategoria}`
    );
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();

    renderProducts(products);
  } catch (e) {
    console.error(e);
  }
}

async function buscarAnuncioPorNome() {
  try {
    const nomeProd = document.getElementById("inputNomeAnuncio").value;
    const response = await fetch(`../php/produtos.php?nome=${nomeProd}`);
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();
    renderProducts(products);
  } catch (e) {
    console.error(e);
  }
}

const btnBuscarAnuncio = document.querySelector("#btnBuscarAnuncio");
btnBuscarAnuncio.addEventListener("click", buscarAnuncioPorNome);

const selectCategoria = document.querySelector("#categoria");
selectCategoria.addEventListener("change", loadProducts);

window.onload = async function () {
  await buscarCategorias();
  await loadProducts();
};

window.onscroll = async function () {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    await loadProductsInfinity();
  }
};

let offset = 0; // Variável para controlar a quantidade de anúncios já carregados

async function loadProductsInfinity() {
  try {
    const codCategoria = document.querySelector("#categoria").value;
    const page =
      Math.ceil((document.querySelector("#products").children.length - 1) / 6) +
      1;
    const response = await fetch(
      `../php/produtos.php?codCategoria=${codCategoria}&page=${page}`
    );
    if (!response.ok) throw new Error(response.statusText);
    const products = await response.json();
    renderProductsInfinity(products);
  } catch (e) {
    console.error(e);
  }
}

async function renderProductsInfinity(newProducts) {
  const prodsSection = document.querySelector("#products");
  const template = document.querySelector("#template");

  for await (const product of newProducts) {
    const { imagePath, name, price, description, code } = product;

    const productElement = template.content.cloneNode(true);
    const itemImage = productElement.querySelector(".item-image");
    itemImage.src = `../assets/images/${imagePath}`;
    productElement.querySelector(".item-name").textContent = name;
    productElement.querySelector(".item-price").textContent = price;
    productElement.querySelector(".item-description").textContent = description;

    const item = productElement.querySelector(".item");
    item.addEventListener("click", () => redirectToProductPage(code));

    prodsSection.appendChild(productElement);
    await new Promise((resolve) => requestAnimationFrame(resolve));
  }
}

function redirectToProductPage(productId) {
  // Redirecionar para a página produto.php com o ID do produto
  window.location.href = `../php/produto.php?id=${productId}`;
}
