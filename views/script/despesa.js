/******************* Sobre os dropdowns(combobox) ********************/
document.addEventListener("DOMContentLoaded", function() {
    // Seleciona os botões
    const btnMes = document.getElementById("btnMes");
    const btnAno = document.getElementById("btnAno");

    // Captura os meses e adiciona evento de clique
    document.querySelectorAll(".btn-group:first-child .dropdown-item").forEach(item => {
        item.addEventListener("click", function() {
            btnMes.textContent = this.textContent;
        });
    });

    // Adiciona event delegation para os anos
    document.getElementById("anosLista").addEventListener("click", function(event) {
        if (event.target.classList.contains("dropdown-item")) {
            btnAno.textContent = event.target.textContent;
        }
    });
});

// Gerando os anos dinamicamente
const anosLista = document.getElementById("anosLista");
const anoAtual = new Date().getFullYear();

for (let ano = 2010; ano <= anoAtual; ano++) {
    let item = document.createElement("li");
    item.innerHTML = `<a class="dropdown-item">${ano}</a>`;
    anosLista.appendChild(item);
}

/**************** Mascara do valor ******************/
const inputValor = document.getElementById('valor');

inputValor.addEventListener('input', function(e) {
    let valor = e.target.value;

    // Remove tudo que não for número
    valor = valor.replace(/\D/g, '');

    // Divide por 100 pra simular centavos e formata
    valor = (Number(valor) / 100).toFixed(2);

    // Converte para formato brasileiro
    valor = valor.replace('.', ',');

    // Adiciona separador de milhar
    valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    e.target.value = 'R$ ' + valor;
});

// Funções para abrir e fechar modais
document.addEventListener('DOMContentLoaded', () => {
    const modalAdd = document.getElementById('modal-add');
    const modalEdit = document.getElementById('modal-edit');
    const modalRemove = document.getElementById('modal-remove');

    const abrirAdd = document.getElementById('abrirModalAdd');
    const fecharAdd = document.getElementById('fecharModalAdd');

    const abrirEdit = document.getElementById('abrirModalEdit');
    const fecharEdit = document.getElementById('fecharModalEdit');

    const abrirRemove = document.getElementById('abrirModalRemove');
    const fecharRemove = document.getElementById('fecharModalRemove');
    const fecharRemoveBtn = document.getElementById('fecharModalRemoveBtn');

    // Abrir modal Adicionar
    abrirAdd.addEventListener('click', () => {
        modalAdd.style.display = 'flex';
    });

    // Fechar modal Adicionar
    fecharAdd.addEventListener('click', () => {
        modalAdd.style.display = 'none';
    });

    // Abrir modal Editar
    abrirEdit.addEventListener('click', () => {
        modalEdit.style.display = 'flex';
    });

    // Fechar modal Editar
    fecharEdit.addEventListener('click', () => {
        modalEdit.style.display = 'none';
    });

    // Abrir modal Remover
    abrirRemove.addEventListener('click', () => {
        modalRemove.style.display = 'flex';
    });
    
    // Fechar modal Remover
    fecharRemove.addEventListener('click', () => {
        modalRemove.style.display = 'none';
    });

    // Fechar modal Remover pelo botao
    fecharRemoveBtn.addEventListener('click', () => {
        modalRemove.style.display = 'none';
    });

    // Fechar ao clicar fora do modal
    window.addEventListener('click', (e) => {
        if (e.target === modalAdd) modalAdd.style.display = 'none';
        if (e.target === modalEdit) modalEdit.style.display = 'none';
        if (e.target === modalRemove) modalRemove.style.display = 'none';
    });
});

