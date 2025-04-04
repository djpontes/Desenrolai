////////////////// VISU E NÃO VISU DA SENHA DO LOGIN //////////////////////////////
document.getElementById("toggleSenha").addEventListener("click", function () {
var senhaInput = document.getElementById("senha");
        if (senhaInput.type === "password") {
            senhaInput.type = "text";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        } else {
            senhaInput.type = "password";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        }
});

////////////////// VISU E NÃO VISU DA SENHA DO CADASTRO //////////////////////////////
document.querySelector("#togglePasswordSignup").addEventListener("click", function() {
    var passwordField = document.querySelector("#passwordSignup");
    var icon = this;
    
    if (passwordField.type === "password") {
        passwordField.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passwordField.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye"); 
    }
});

////////////////// OS CONTEUDOS "SUMIREM" AO CLICAR EM LOGIN/CADASTRO /////////////////
var formLogin = document.querySelector('#login')
var formSignup = document.querySelector('#signup')
var btnColor = document.querySelector('.btnColor')

document.querySelector('#btnSignin').addEventListener('click', () => {
    formLogin.style.left = "25px"
    formSignup.style.left = "450px"
    btnColor.style.left = "0px"
})

document.querySelector('#btnSignup').addEventListener('click', () => {
    formLogin.style.left = "-450px"
    formSignup.style.left = "25px"
    btnColor.style.left = "110px"

})

////////////////////////// FECHAR E ABRIR O MODAL /////////////////////////
// Funções para abrir e fechar modais
document.addEventListener('DOMContentLoaded', () => {
    const modalSing = document.getElementById('modal');

    const abrirSing = document.getElementById('abrirModalSing');
    const fecharSing = document.getElementById('fecharModalSing');

    // Abrir modal 
    abrirSing.addEventListener('click', () => {
        modalSing.style.display = 'flex';
    });

    // Fechar modal 
    fecharSing.addEventListener('click', () => {
        modalSing.style.display = 'none';
    });

    // Fechar ao clicar fora do modal
    window.addEventListener('click', (e) => {
        if (e.target === modalSing) modalSing.style.display = 'none';
    });
});