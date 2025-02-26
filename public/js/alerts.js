// Pegar o tema dark ou light
const getTheme = () => {
    if (window.localStorage.getItem('dark')) {
        return JSON.parse(window.localStorage.getItem('dark'));
    }
    return (
        !!window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches
    );
}

// Warning Confirm
window.warningConfirm = function (e, text, icon, confirmButtonText) {
    e.preventDefault();
    const form = e.target.closest('form');
    isDarkMode = getTheme();

    Swal.fire({
        title: "Você tem Certeza?",
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        cancelButtonText: "Cancelar",
        customClass: {
            popup: isDarkMode ? 'bg-gray-900' : 'bg-white', 
            title: isDarkMode ? 'text-white' : 'text-gray-900', 
            htmlContainer: isDarkMode ? 'text-gray-300' : 'text-gray-900', 
            confirmButton: isDarkMode ? 'bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
            cancelButton: isDarkMode ? 'bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
};
// Delete Confirm
window.deleteConfirm = function (e, title, text, confirmButton) {
    e.preventDefault();
    var form = e.target.closest('form');
    isDarkMode = getTheme();

    Swal.fire({
        title: title,
        text: text,
        input: 'password',
        inputPlaceholder: 'Senha',
        inputAttributes: {
            autocapitalize: 'off',
            autocorrect: 'off'
        },
        showCancelButton: true,
        confirmButtonText: confirmButton,
        cancelButtonText: 'Cancelar',
        customClass: {
            popup: isDarkMode ? 'bg-gray-900' : 'bg-white', 
            title: isDarkMode ? 'text-white' : 'text-gray-900',
            htmlContainer: isDarkMode ? 'text-gray-300' : 'text-gray-700', 
            input: isDarkMode ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-900', 
            confirmButton: isDarkMode ? 'bg-purple-800 hover:bg-purple-900 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
            cancelButton: isDarkMode ? 'bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out',
            validationMessage: isDarkMode ? 'text-white bg-gray-700' : 'text-gray-900 bg-gray-100',
        },
        preConfirm: (senha) => {
            return fetch('/validate-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ senha: senha })
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                }).then(data => {
                    if (data.valid) {
                        return true;
                    } else {
                        Swal.showValidationMessage('Senha incorreta!');
                        return false;
                    }
                }).catch(() => {
                    Swal.showValidationMessage('Erro na validação da senha!');
                    return false;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (result.isDismissed) {
                // Swal.fire('Exclusão Cancelada!', 'O item não foi excluído.', 'false');
            }
    });
};
// Update Confirm
window.updateConfirm = function (e, title, text, confirmButton) {
    e.preventDefault(); // Evitar envio imediato do formulário
    var form = e.target.closest('form');
    isDarkMode = getTheme();

    if (form && form.reportValidity()) {
        Swal.fire({
            title: title,
            text: text,
            input: 'password',
            inputPlaceholder: 'Senha',
            showCancelButton: true,
            confirmButtonText: confirmButton,
            cancelButtonText: 'Cancelar',
            customClass: {
                popup: isDarkMode ? 'bg-gray-900' : 'bg-white', 
                title: isDarkMode ? 'text-white font-password' : 'text-gray-900 font-password',
                htmlContainer: isDarkMode ? 'text-gray-300' : 'text-gray-700', 
                input: isDarkMode ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-900', 
                confirmButton: isDarkMode ? 'bg-purple-800 hover:bg-purple-900 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
                cancelButton: isDarkMode ? 'bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out',
                validationMessage: isDarkMode ? 'text-white bg-gray-700' : 'text-gray-900 bg-gray-100',
            },
            preConfirm: (senha) => {
                return fetch('/validate-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ senha: senha })
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response.json();
                }).then(data => {
                    if (data.valid) {
                        return true;
                    } else {
                        Swal.showValidationMessage('Senha incorreta!');
                        return false;
                    }
                }).catch(() => {
                    Swal.showValidationMessage('Erro na validação da senha!');
                    return false;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                //Swal.fire('Excluído!', 'O item foi excluído.', 'success');
            } else if (result.isDismissed) {
            }
        });
    }
};

// Alertas Personalizados para as informações (?) 
window.guestText = function (icon, text) {
    isDarkMode = getTheme();

    Swal.fire({
        html: text,
        icon: icon,
        confirmButtonText: 'Entendi',
        customClass: {
            popup: isDarkMode ? 'bg-gray-900' : 'bg-white', 
            htmlContainer: isDarkMode ? 'text-gray-300 text-justify' : 'text-gray-900 text-justify', 
            confirmButton: isDarkMode ? 'bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
        },
    });
};