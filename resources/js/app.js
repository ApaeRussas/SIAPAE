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

    // const dateInputs = document.querySelectorAll('.date');
    // dateInputs.forEach(input => {
    //     input.type = "text"; // Garante que o input seja tipo "text"
    // });

    applyMask('.date-range', new Inputmask("99/99/9999 à 99/99/9999"));
    applyMask('.date', new Inputmask("99/99/9999"));
    applyMask('.monthYear', new Inputmask("99/9999"));
    applyMask('.cellphone', new Inputmask("(99) 99999-9999"));
    applyMask('.rg', new Inputmask("99.999.999-9"));
    applyMask('#fiscal', new Inputmask("999.999.999"));
    applyMask('#cupom', new Inputmask("999999"));
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
            },
            initFlatpickr() {
                //Calendário no input de data
                flatpickr(".date", {
                    dateFormat: "d/m/Y",
                    allowInput: true,
                    locale: customLocale,
                    minDate: "01/01/1960",
                    maxDate: "today",
                });

                // Aplicar o Flatpickr com a opção de intervalo de datas 
                flatpickr(".date-range", {
                    mode: "range",
                    dateFormat: "d/m/Y",
                    locale: customLocale,
                    allowInput: true,
                    minDate: "01/01/1960",
                    maxDate: "today",
                });
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
                } else {
                    this.isSidebarOpen = true;
                }
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen));
            },
            toggleSidebar() {
                this.isSidebarOpen = !this.isSidebarOpen;
                window.localStorage.setItem('isSidebarOpen', JSON.stringify(this.isSidebarOpen));
            },
            scrollingDown: false,
            scrollingUp: false,
        };
    });
});

Alpine.plugin(collapse)

Alpine.start() 
