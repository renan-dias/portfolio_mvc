// public/js/scripts.js

document.addEventListener('DOMContentLoaded', function() {
    // 1. Implementação do Dark/Light Mode Automático com base no horário

    function atualizarTema() {
        const agora = new Date();
        const hora = agora.getHours();
        const body = document.body;

        // Definir o tema com base no horário (ex: modo escuro das 18h às 6h)
        if (hora >= 18 || hora < 6) {
            body.classList.add('dark-mode'); // Adicionar classe 'dark-mode' para ativar o tema escuro
        } else {
            body.classList.remove('dark-mode'); // Remover classe 'dark-mode' para ativar o tema claro
        }
    }

    // Atualizar o tema inicialmente ao carregar a página
    atualizarTema();

    // (Opcional) Atualizar o tema a cada hora (para garantir a mudança de tema na virada da hora)
    // setInterval(atualizarTema, 3600000); // 3600000 milissegundos = 1 hora


    // 2. Efeito Fade-Out da Tela de Loading

    const loadingOverlay = document.getElementById('loading-overlay');

    if (loadingOverlay) {
        window.addEventListener('load', function() {
            // Aguardar um pequeno delay (opcional, para simular um carregamento - remover em produção se desnecessário)
            setTimeout(function() {
                loadingOverlay.classList.add('fade-out'); // Adicionar classe 'fade-out' para iniciar a transição CSS

                // Remover a tela de loading do DOM após a transição (opcional)
                loadingOverlay.addEventListener('transitionend', function() {
                    loadingOverlay.style.display = 'none'; // Ocultar completamente
                }, { once: true }); // 'once: true' para executar o listener apenas uma vez

            }, 500); // Delay de 500ms (0.5 segundos) - ajuste conforme necessário ou remova
        });
    }
});