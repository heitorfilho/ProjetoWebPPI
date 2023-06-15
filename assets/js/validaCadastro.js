window.onload = function (){
    document.forms.formCadastrar.onsubmit = validaForm;
}

function validaForm (e){
    let form = e.target;
    let formValido = true;

    const spanNome = form.nome.nextElementSibling;
    const spanCPF = form.cpf.nextElementSibling;
    const spanEmail = form.email.nextElementSibling;
    const spanSenha = form.senha.nextElementSibling;
    const spanTel = form.telefone.nextElementSibling;

    spanNome.textContent = "";
    spanCPF.textContent = "";
    spanEmail.textContent = "";
    spanSenha.textContent = "";
    spanTel.textContent = "";

    if (form.nome.value === ""){
        spanNome.textContent = 'O nome deve ser preenchido';
        formValido = false;
    }
    if (form.cpf.value === ""){
        spanCPF.textContent = 'O cpf deve ser preenchido';
        formValido = false;
    }
    if (form.email.value === ""){
        spanEmail.textContent = 'O email deve ser preenchido';
        formValido = false;
    }
    if (form.senha.value === ""){
        spanSenha.textContent = 'A senha deve ser preenchida';
        formValido = false;
    }
    if (form.telefone.value === ""){
        spanTel.textContent = 'O telefone deve ser preenchido';
        formValido = false;
    }
    if (! formValido){
        e.preventDefault();
    }
}