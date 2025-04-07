
document.addEventListener("DOMContentLoaded", function() 
{
    let ts = new TomSelect("#professors_service", {
        plugins: ['checkbox_options'],
        placeholder: "Escolha o(s) Professor(es)",
        hideSelected: true,
        maxItems: null,
        onDropdownOpen: function() {
            // Força a aplicação dos estilos quando o dropdown é aberto
            setTimeout(applyStyles, 10);
        }
    });
    
    // Função para aplicar estilos dinamicamente quando os elementos forem criados
    function applyStyles() {
        let dropdown = document.querySelector('.ts-dropdown');
        if (dropdown) {
            dropdown.classList.add(
                "bg-white", "dark:bg-dark-eval-1", "border", "border-gray-300",
                "dark:border-gray-600", "rounded-md", "shadow-lg", "p-2",
                "text-gray-800", "dark:text-gray-400"
            );
        }

        let options = document.querySelectorAll('.ts-dropdown .option');
        options.forEach((option, index) => {
            option.classList.add(
                "flex", "items-center", "space-x-2", "px-4", "py-2", "cursor-pointer",
                "hover:bg-gray-200", "dark:hover:bg-gray-700", "rounded-md",
                "text-gray-800", "dark:text-gray-300"
            );

            // Aplica o estilo dark imediatamente se estiver no modo dark
            const isDark = JSON.parse(window.localStorage.getItem('dark')) == 1;
            if (isDark) {
                option.style.color = "#d1d5db";
                
                // Remove o background do item ativo (se for o primeiro)
                if (index === 0 && option.classList.contains('active')) {
                    option.style.backgroundColor = "transparent";
                }
            }

            // Corrigindo a cor do item ativo no modo dark
            option.addEventListener("mouseenter", () => {
                option.style.backgroundColor = isDark ? "#374151" : "#e5e7eb";
                option.style.color = isDark ? "#d1d5db" : "#111827";
            });

            option.addEventListener("mouseleave", () => {
                option.style.backgroundColor = "transparent";
                option.style.color = isDark ? "#d1d5db" : "#111827";
            });
        });

        let checkboxes = document.querySelectorAll('.ts-dropdown .tomselect-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.classList.add(
                "w-4", "h-4", "text-blue-600", "border-gray-300", "rounded",
                "focus:ring", "focus:ring-blue-500", "dark:bg-gray-800", "dark:border-gray-600"
            );
        });

        // Ajustando os itens selecionados dentro da caixa
        let selectedItems = document.querySelectorAll('.ts-control .item');
        selectedItems.forEach(item => {
            const isDark = JSON.parse(window.localStorage.getItem('dark')) == 1;
            item.style.backgroundColor = isDark ? "#374151" : "#e5e7eb";
            item.style.color = isDark ? "#d1d5db" : "#111827";
            item.style.border = isDark ? "1px solid #4b5563" : "none";
            item.style.borderRadius = "0.375rem";
            item.style.padding = "2px 6px";
        });
    }

    // Observador para detectar mudanças na DOM e aplicar os estilos
    let observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            applyStyles();
        });
    });

    // Observa o dropdown por mudanças
    let dropdownContainer = document.querySelector('.ts-wrapper');
    if (dropdownContainer) {
        observer.observe(dropdownContainer, { childList: true, subtree: true });
    }

    let control = document.querySelector('.ts-control');
    if (control) {
        control.classList.add(
            "max-w-full", "border", "border-gray-400", "rounded-md", "p-2.75",
            "focus:border-gray-400", "focus:ring", "focus:ring-gray-500",
            "focus:ring-offset-2", "focus:ring-offset-white",
            "dark:border-gray-600", "dark:bg-dark-eval-1",
            "dark:focus:ring-offset-dark-eval-1", "dark:text-gray-400"
        );
        control.style.minHeight  = '42px'; // Altura fixa igual ao input de texto
    }
    let professors_control = document.querySelector('#professors-ts-control');
    if (professors_control) {
        professors_control.classList.add(
            "text-base"
        );
    }
    
    setTimeout(() => {
        applyStyles();
    }, 10);
}) 