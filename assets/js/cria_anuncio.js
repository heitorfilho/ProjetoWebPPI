async function fetchStates() {
  try {
    const response = await fetch("../assets/js/estados-cidades.json");
    const data = await response.json();
    const select = document.getElementById("estado");

    // Popula as opções de estado
    const options = data.estados.map((estado) => {
      return `<option value="${estado.sigla}">${estado.nome}</option>`;
    });
    select.innerHTML = options.join("");
    // for (const estado of data.estados) {
    //   const option = document.createElement("option");
    //   option.value = estado.sigla;
    //   option.text = estado.nome;
    //   select.add(option);
    // }

    // Manipula o evento de mudança de estado
    select.addEventListener("change", function () {
      const selectedState = this.value;
      const citySelect = document.getElementById("cidade");
      const estado = data.estados.find((e) => e.sigla === selectedState);
      const cities = estado.cidades;

      // Limpa as opções de cidade anteriores
      citySelect.innerHTML = "";

      // Popula as opções de cidade para o estado selecionado
      cities.forEach((city) => {
        const option = document.createElement("option");
        option.value = city;
        option.text = city;
        citySelect.add(option);
      });
    });
  } catch (error) {
    console.error("Error fetching state data:", error);
  }
}
fetchStates();
