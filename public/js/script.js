function show(route) {
    window.location.href = route;
}

// VIEW Student - Atualiza o nome a direita do input tipo file com o nome do arquivo
function updateImageLabel(event) {
    const fileInput = event.target;
    const labelImage = document.getElementById('label-image');


    if (labelImage && fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        labelImage.textContent = fileName; // Atualiza o texto com o nome do arquivo
    } else {
        console.error("Elemento label-image não encontrado ou nenhum arquivo selecionado.");
    }

}

function updateImagePreview(event) {
    const fileInput = event.target;
    const imagePreview = document.getElementById('image-preview');

    if (imagePreview && fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            imagePreview.src = e.target.result; // Atualiza a imagem prévia com a nova imagem
        }

        reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
    } else {
        console.error("Elemento image-preview não encontrado ou nenhum arquivo selecionado.");
    }
}

// VIEW Expense - p/ mascara de moeda com o R$
const mascaraMoeda = (event) => {
    const onlyDigits = event.target.value
        .split("")
        .filter(s => /\d/.test(s))
        .join("")
        .padStart(3, "0")
    const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
    event.target.value = maskCurrency(digitsFloat)
}
const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
    return new Intl.NumberFormat(locale, {
        style: 'currency',
        currency
    }).format(valor)
}

// VIEW Donation - p/ mascara de moeda sem o R$
const maskMoedaDonation = (event) => {
    let valor = event.target.value;

        // Remove tudo que não seja dígito ou as letras "p" ou "d"
        valor = valor.replace(/[^\dpd]/gi, "");

        // Verifica o primeiro caractere para definir o prefixo
        let prefixo = "";
        if (valor.startsWith("p")) {
            prefixo = "p/ ";
            valor = valor.replace(/^p/, ""); // Remove o "p" inicial
        } else if (valor.startsWith("d")) {
            prefixo = "d/ ";
            valor = valor.replace(/^d/, ""); // Remove o "d" inicial
        }

        // Remove tudo que não seja dígito agora
        valor = valor.replace(/\D/g, "");

        // Adiciona a vírgula para os decimais
        valor = (valor / 100).toFixed(2) + '';

        // Formata o valor com a vírgula
        valor = valor.replace(".", ",");

        // Adiciona o prefixo
        valor = prefixo + valor;

        event.target.value = valor;
}

const currency = (valor, currency = 'BRL') => {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency,
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
    }).format(valor);
}

// Validação da Data
function validateDate() {
    document.getElementById('dateForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const dateInputs = document.querySelectorAll('.dateInput');
        const errorMessage = document.getElementById('errorMessage');

        let isValid = true;

        dateInputs.forEach(function (dateInput) {
            const dateFormated = moment(dateInput.value, 'DD/MM/YYYY').format('YYYY-MM-DD');
            const dateValue = new Date(dateFormated);
            const minDate = new Date('1960-01-01');
            const maxDate = new Date('2200-12-31');

            if (dateValue < minDate || dateValue > maxDate || isNaN(dateValue)) {
                errorMessage.style.display = 'inline';
                isValid = false;
            } else {
                errorMessage.style.display = 'none';
                dateInput.style.borderColor = '';
            }
        });

        if (isValid) {
            this.submit();
        }
    });
}

function toggleInput(checkbox) {
    const targetClass = checkbox.getAttribute('data-target');
    const targetInputs = document.querySelectorAll(`.${targetClass}`);

    // Se a checkbox estiver marcada, habilita os inputs. Caso contrário, desabilita.
    targetInputs.forEach(function (input) {
        if (checkbox.checked) {
            input.disabled = false;
        } else {
            input.disabled = true;
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const elementsToUpdate = [
        { selector: 'input[type="file"]', handler: updateImageLabel, event: 'change' },
        { selector: 'input[type="file"]', handler: updateImagePreview, event: 'change' },
        { selector: '#tipo_gasto', handler: handleExpenseTypeChange, event: 'change' },
        // { selector: '.anamnesis_student', handler: handleAnamnesisStudentChange, event: 'change' },
    ];
    
    // Verificação de todos os elementos que podem não existir
    elementsToUpdate.forEach(({ selector, handler, event }) => {
        const elements = document.querySelectorAll(selector);
        elements.forEach(element => {
            if (element) {
                element.addEventListener(event, handler);
            } else {
                console.error(`Elemento ${selector} não encontrado no DOM.`);
            }
        });
    });

    // Inicializa o estado dos inputs conforme o estado das checkboxes
    const checkboxes = document.querySelectorAll('input[type="checkbox"][data-target]');
    checkboxes.forEach(function (checkbox) {
        toggleInput(checkbox);
    });

    // Inicializa o estado dos campos conforme o valor inicial do select 
    const tipoGastoSelect = document.getElementById('tipo_gasto'); 
    if (tipoGastoSelect) { 
        mostrarCampos(tipoGastoSelect.value); 
    }

    if (document.querySelector('.dateInput')) {
        validateDate();
    }

    if (window.messages && window.messages.success) { 
        toastr.success(window.messages.success); 
    } 
    if (window.messages && window.messages.error) { 
        toastr.error(window.messages.error); 
    }
});

function handleExpenseTypeChange(event) {
    var tipoGasto = event.target.value;
    mostrarCampos(tipoGasto);
}

function mostrarCampos(tipoGasto) {
    ocultarCampos();
    if (tipoGasto === 'Nota Fiscal') {
        document.getElementById('campo_nota_fiscal').style.display = 'block';
    } else if (tipoGasto === 'Cupom Fiscal') {
        document.getElementById('campo_cupom_fiscal').style.display = 'block';
    } else if (tipoGasto === 'Recibo') {
        document.getElementById('campo_recibo').style.display = 'block';
    }
}

function ocultarCampos() {
    document.getElementById('campo_nota_fiscal').style.display = 'none';
    document.getElementById('campo_cupom_fiscal').style.display = 'none';
    document.getElementById('campo_recibo').style.display = 'none';
}

function handleClick() {
    const form = document.getElementById('dateForm');
    var button = document.getElementById('submitButton');
    const textoButton = button.querySelector('p'); // Seleciona o texto dentro do botão
    const loadingSpinner = document.getElementById('loadingSpinner'); // Seleciona o ícone de carregamento

    if (form && form.checkValidity()) 
    {
        button.disabled = true;
        if(textoButton.textContent == 'Adicionar') { textoButton.textContent = 'Adicionando...'; } 
        else { textoButton.textContent = 'Atualizando...'; }
        loadingSpinner.classList.remove('hidden'); // Mostra o spinner

        form.submit();
        ativarBotao(5000);
    }
}
function ativarBotao(tempo) {
    var button = document.getElementById('submitButton');
    setTimeout(function () {
        button.button = false;
        if(textoButton.textContent == 'Adicionando...') { textoButton.textContent = 'Adicionar'; } 
        else { textoButton.textContent = 'Atualizar'; }
        button.querySelector('#loadingSpinner').classList.add('hidden'); // Esconde o spinner
    }, tempo);
}