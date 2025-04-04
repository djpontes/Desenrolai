// Funções para abrir e fechar modais
document.addEventListener('DOMContentLoaded', () => {
    const modalEdit = document.getElementById('modal');

    const abrirEdit = document.getElementById('abrirModalEdit');
    const fecharEdit = document.getElementById('fecharModalEdit');

    // Abrir modal Editar
    abrirEdit.addEventListener('click', () => {
        modalEdit.style.display = 'flex';
    });

    // Fechar modal Editar
    fecharEdit.addEventListener('click', () => {
        modalEdit.style.display = 'none';
    });

    // Fechar ao clicar fora do modal
    window.addEventListener('click', (e) => {
        if (e.target === modalEdit) modalEdit.style.display = 'none';
    });
});