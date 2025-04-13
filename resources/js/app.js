import './bootstrap'

import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'
import PerfectScrollbar from 'perfect-scrollbar'
import Inputmask from 'inputmask'

document.addEventListener("DOMContentLoaded", function () {
    // Função para aplicar máscaras aos elementos
    function applyMask(selector, mask) {
        const elements = document.querySelectorAll(selector);
        if (elements.length > 0) {
            mask.mask(elements);
        }
    }

    applyMask('.date-range', new Inputmask("99/99/9999 à 99/99/9999"));
    applyMask('.date', new Inputmask("99/99/9999"));
    applyMask('.monthYear', new Inputmask("99/9999"));
    applyMask('.cellphone', new Inputmask("(99) 99999-9999"));
    applyMask('.cpf', new Inputmask("999.999.999-99"));
    applyMask('#fiscal', new Inputmask("999.999.999"));
    applyMask('#cupom', new Inputmask("999999"));

    // Máscara dinâmica para RG (7 a 13 dígitos)
    applyMask('.rg', new Inputmask({
        mask: [
            "9{7}",
            "99.999.999-9",
            "99.999.999-99",
            "99.999.999-999",
            "99.999.999-9999",
            "99.999.999-99999"
        ],
        greedy: false,
        keepStatic: true
    }));
});

var customLocale = {
    firstDayOfWeek: 1,
    weekAbbreviation: "Sem",
    rangeSeparator: " à ",
    scrollTitle: "Role para aumentar",
    toggleTitle: "Clique para alternar",
    weekdays: {
        shorthand: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
        longhand: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
    },
    months: {
        shorthand: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        longhand: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    },
};

window.PerfectScrollbar = PerfectScrollbar

document.addEventListener('alpine:init', () => {
    Alpine.data('mainState', () => {
        let lastScrollTop = 0
        const init = function () {
            this.applyTheme();
            window.addEventListener('scroll', () => {
                let st = window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    this.scrollingDown = true;
                    this.scrollingUp = false;
                } else {
                    this.scrollingDown = false;
                    this.scrollingUp = true;
                    if (st === 0) {
                        this.scrollingDown = false;
                        this.scrollingUp = false;
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st;
            });

            // Restaurar estado da barra lateral a partir do localStorage
            const storedSidebarState = window.localStorage.getItem('isSidebarOpen');
            this.isSidebarOpen = storedSidebarState !== null ? JSON.parse(storedSidebarState) : (window.innerWidth > 1024);

            // Adjust sidebar visibility based on initial window size
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false;
            }
        }

        const getTheme = () => {
            if (window.localStorage.getItem('dark')) {
                return JSON.parse(window.localStorage.getItem('dark'));
            }
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            );
        }

        const setTheme = (value) => {
            window.localStorage.setItem('dark', value);
        }

        return {
            init,
            isDarkMode: getTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode
                setTheme(this.isDarkMode)
                this.applyTheme();
            },
            applyTheme() {
                const darkTheme = document.getElementById('flatpickr-dark');
                const lightTheme = document.getElementById('flatpickr-light');
            
                if (darkTheme && lightTheme) {
                    darkTheme.disabled = !this.isDarkMode;
                    lightTheme.disabled = this.isDarkMode;
                }

                this.applyScrollbarTheme();
                this.applyToastrDarkTheme();
            },
            // Aplicação do calendário flatpickr
            initFlatpickr() {
                flatpickr(".date", {
                    dateFormat: "d/m/Y",
                    allowInput: true,
                    locale: customLocale,
                    minDate: "01/01/1960",
                    maxDate: "today",
                    disableMobile: true,
                });
 
                flatpickr(".date-range", {
                    mode: "range",
                    dateFormat: "d/m/Y",
                    locale: customLocale,
                    allowInput: true,
                    minDate: "01/01/1960",
                    maxDate: "today",
                    disableMobile: true,
                });
            },
            // Aplicação da estilização da mensagem do toastr
            applyToastrDarkTheme() {
                const isDark = getTheme();
                
                if (isDark) {
                    // Sobrescrever os estilos padrão do Toastr para dark mode
                    const style = document.createElement('style');
                    style.id = 'toastr-dark-theme';
                    style.textContent = `
                        .toast-bottom-left, .toast-top-left, 
                        .toast-top-right, .toast-bottom-right {
                            opacity: 1 !important;
                        }
                        .toast {
                            background-color: #1f2937 !important;
                            color: #f3f4f6 !important;
                            border: 1px solid #374151 !important;
                            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.5) !important;
                        }
                        .toast-success {
                            background-color: #1f2937 !important;
                        }
                        .toast-error {
                            background-color: #1f2937 !important;
                        }
                        .toast-info {
                            background-color: #1f2937 !important;
                        }
                        .toast-warning {
                            background-color: #1f2937 !important;
                        }
                        .toast-progress {
                            background-color: #3b82f6 !important;
                            opacity: 0.7;
                        }
                        .toast-close-button {
                            color: #9ca3af !important;
                        }
                        .toast-close-button:hover {
                            color: #f3f4f6 !important;
                        }
                        .toast-title {
                            color: #f3f4f6 !important;
                        }
                        .toast-message {
                            color: #e5e7eb !important;
                        }
                        /* Ícones com cores mais suaves para dark mode */
                        .toast-success .toast-icon {
                            color: #86efac !important;
                        }
                        .toast-error .toast-icon {
                            color: #fca5a5 !important;
                        }
                        .toast-info .toast-icon {
                            color: #93c5fd !important;
                        }
                        .toast-warning .toast-icon {
                            color: #fcd34d !important;
                        }
                    `;
                    
                    // Remove o estilo anterior se existir
                    const existingStyle = document.getElementById('toastr-dark-theme');
                    if (existingStyle) {
                        existingStyle.remove();
                    }
                    document.head.appendChild(style);
                } else {
                    // Remove o estilo dark se existir
                    const existingStyle = document.getElementById('toastr-dark-theme');
                    if (existingStyle) {
                        existingStyle.remove();
                    }
                }
            },
            applyScrollbarTheme() {
                const scrollbarThumbColor = this.isDarkMode ? '#555555' : '#c1c1c1';
                const scrollbarTrackColor = this.isDarkMode ? '#333333' : '#f1f1f1';
                var scrollbarHeight = '';

                if (window.innerWidth > 1024) {
                    scrollbarHeight = '7px';
                } else {
                    scrollbarHeight = '4px';
                }

                // Aplicar estilos dinamicamente
                const style = document.createElement('style');
                style.id = 'scrollbar-theme';
                style.textContent = `
                    .scrollbar-custom::-webkit-scrollbar {
                        height: ${scrollbarHeight};
                        }
                    .scrollbar-custom::-webkit-scrollbar-thumb {
                        background-color: ${scrollbarThumbColor};
                        border-radius: 4px;
                    }
                    .scrollbar-custom::-webkit-scrollbar-track {
                        background-color: ${scrollbarTrackColor};
                        border-radius: 0px 0px 5px 5px;
                    }
                `;

                // Remover o estilo anterior (se existir)
                const existingStyle = document.getElementById('scrollbar-theme');
                if (existingStyle) {
                    existingStyle.remove();
                }

                // Adicionar o novo estilo
                document.head.appendChild(style);
            },
            isSidebarOpen: JSON.parse(window.localStorage.getItem('isSidebarOpen')) ?? (window.innerWidth > 1024),
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return;
                }
                this.isSidebarHovered = value;
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false;
                    document.body.style.overflow = 'auto';
                } else {
                    this.isSidebarOpen = true;
                    document.body.style.overflow = 'auto'; 
                }
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen));
            },
            toggleSidebar() {
                this.isSidebarOpen = !this.isSidebarOpen;
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen));
                
                if (this.isSidebarOpen && window.innerWidth < 1024) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = 'auto';
                }
            },
            scrollingDown: false,
            scrollingUp: false,
        };
    });
});

Alpine.plugin(collapse)

Alpine.start() 
