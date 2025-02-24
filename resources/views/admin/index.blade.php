<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col md:justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mb-4">
            <h2 class="text-2xl font-bold leading-tight pt-2">
                {{ __('Parte Admin') }}
            </h2>
        </div>
    </x-slot>
    
    <!-- Page Content -->
    <main class="px-4 py-6 sm:px-6 flex-1">
        
        <div x-data="{
            selectedMonth: '',
            selectedYear: '',
            months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            years: {{ json_encode($years) }},
            students: [], 
            monthYear: '',
            loading: false,     
            loadingUpdate: false,

            // Função para carregar estudantes e suas frequências/doações
            async loadStudents() {
                if (!this.selectedMonth || !this.selectedYear) return;

                this.loading = true;
                try {
                    const response = await fetch(`/admin/check?month=${this.selectedMonth}&year=${this.selectedYear}`);

                    const data = await response.json();
                    this.students = data.students;
                    this.monthYear = data.monthYear;
                } catch (error) {
                    toastr.error('Erro ao carregar frequências e doações');
                } finally {
                    this.loading = false;
                }
            },

            // Função para atualizar frequências e doações
            async updateFrequenciesAndDonations() {
                if (!this.selectedMonth || !this.selectedYear) return;

                this.loadingUpdate = true;
                try {
                    const studentIds = this.students.map(student => student.id);

                    const response = await fetch('/admin/update-frequencies-donations', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            month: this.selectedMonth,
                            year: this.selectedYear,
                            student_ids: studentIds,
                        })
                    });

                    const result = await response.json();

                    if (result.success) {
                        toastr.success(result.message); 

                        // Atualiza o status de cada estudante
                        this.students = this.students.map(student => {
                            const updatedStudent = result.students.find(s => s.id === student.id);
                            if (updatedStudent) {
                                return {
                                    ...student,
                                    frequency_status: updatedStudent.frequency_status,
                                    donation_status: updatedStudent.donation_status,
                                };
                            }
                            return student;
                        });

                        this.students = this.students.filter(student => student.state !== 'archived');
                    } else {
                        toastr.error(result.message);
                    }
                } catch (error) {
                    console.error('Erro ao atualizar:', error);
                } finally {
                    this.loadingUpdate = false;
                }
            },
            
            // Funções para abrir o menu de deletar e deletar a frequência ou doação
            async openDeleteMenu(studentId) {
                const { value: option } = await Swal.fire({
                    title: 'O que deseja apagar?',
                    icon: 'question',
                    showDenyButton: true, 
                    showCancelButton: true, 
                    confirmButtonText: 'Frequência',
                    denyButtonText: 'Doação',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        popup: isDarkMode ? 'bg-gray-900' : 'bg-white', // Fundo do popup
                        title: isDarkMode ? 'text-white' : 'text-gray-900', // Título
                        confirmButton: isDarkMode ? 'bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
                        denyButton: isDarkMode ? 'bg-purple-700 hover:bg-purple-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded transition duration-300 ease-in-out', 
                        cancelButton: isDarkMode ? 'bg-red-700 hover:bg-red-800 text-white px-4 py-2 rounded transition duration-300 ease-in-out' : 'bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-300 ease-in-out',
                    }
                });

                if (option === true) {
                    this.deleteRecord(studentId, 'frequency'); // Apagar frequência
                } else if (option === false) {
                    this.deleteRecord(studentId, 'donation'); // Apagar doação
                } else {
                    // Nada Acontecerá
                }
            },
            async deleteRecord(studentId, type) {
                if(type == 'donation') {
                    titleText = `Excluir a doação selecionada?`;
                } else {
                    titleText = `Excluir a frequência selecionada?`;
                }
                const { value: password } = await Swal.fire({
                    title: titleText,
                    text: 'Por favor, insira a senha para confirmar a exclusão.',
                    input: 'password',
                    inputPlaceholder: 'Senha',
                    inputAttributes: {
                        autocapitalize: 'off',
                        autocorrect: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Confirmar',
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
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                });

                if (password) {
                    try {
                        const endpoint = type === 'frequency' 
                            ? `/admin/delete-frequency/${studentId}` 
                            : `/admin/delete-donation/${studentId}`;

                        const response = await fetch(endpoint, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ 
                                password: password,
                                month: this.selectedMonth,
                                year: this.selectedYear 
                            })
                        });

                        const result = await response.json();

                        if (result.success) {
                            toastr.success(result.message);
                            this.loadStudents(); // Recarrega os dados após a exclusão
                        } else {
                            toastr.error(result.message);
                        }
                    } catch (error) {
                        console.error(`Erro ao apagar ${type}:`, error);
                        toastr.error(`Erro ao apagar ${type}.`);
                    }
                }
            },
                
            // Função para limpar a lista de estudantes quando o mês ou ano for alterado
            clearStudents() {
                this.students = []; // Limpa a lista de estudantes
                this.monthYear = ''; // Limpa o mês/ano exibido
            },
        }" 
        x-init="function() {
            // Observa alterações nos inputs de mês e ano
            $watch('selectedMonth', this.clearStudents.bind(this));
            $watch('selectedYear', this.clearStudents.bind(this));
        }"
        class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 space-y-6">
        
        <!-- Título da Seção -->
        <h2 class="text-l md:text-xl font-semibold text-gray-900 dark:text-gray-100">Atualizar Frequências e Doações</h2>

        <!-- Seleção de Mês -->
        <div class="flex space-x-4">
            <div class="w-1/2">
                <label for="month" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mês</label>
                <select id="month" x-model="selectedMonth" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                    <option value="">Selecione um mês</option>
                    <template x-for="(month, index) in months" :key="index">
                        <option x-text="month" :value="month"></option>
                    </template>
                </select>
            </div>

            <!-- Seleção de Ano -->
            <div class="w-1/2">
                <label for="year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ano</label>
                <select id="year" x-model="selectedYear" class="mt-1 block w-full bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-200 border-gray-300 dark:border-gray-600 rounded-md shadow-sm">
                    <option value="">Selecione um ano</option>
                    <template x-for="(year, index) in years" :key="index">
                        <option x-text="year" :value="year"></option>
                    </template>
                </select>
            </div>
        </div>

        <!-- Botão para Carregar Estudantes -->
        <div class="flex justify-end">
            <x-button @click="loadStudents()" x-bind:disabled="!selectedMonth || !selectedYear || loading || loadingUpdate" variant="blue">
                Carregar Estudantes
            </x-button>
        </div>

        <!-- Lista de Estudantes para o Mês/Ano Selecionado -->
        <div x-show="selectedMonth && selectedYear" class="mt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                Estudantes <span x-text="monthYear"></span>
            </h3>

            <div class="overflow-x-auto mt-4">
                <table class="min-w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700">
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Nome</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Frequência</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Doação</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300 flex item-center justify-center">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <template x-for="student in students" :key="student.id">
                        <tr class="border-b border-gray-200 dark:border-gray-700 text-sm">
                            <td class="w-1/2 px-4 py-2 text-sm" :class="{ 'text-gray-900 dark:text-gray-200': student.state === 'alive', 'text-gray-500 dark:text-gray-400': student.state === 'archived' }">
                                <span x-text="student.name"></span>
                                <span x-show="student.state === 'archived'" class="text-sm text-gray-500"> (Arquivado)</span>
                            </td>
                            <td class="w-2/10 px-4 py-2">
                                <span :class="{ 
                                    'text-green-600': student.frequency_status === 'Presente' || student.frequency_status === 'Criado',
                                    'text-red-600': student.frequency_status === 'Não Criado',
                                    'text-blue-600': student.frequency_status === 'Já Presente'
                                }" x-text="student.frequency_status"></span>
                            </td>
                            <td class="w-2/10 px-4 py-2">
                                <span :class="{ 
                                    'text-green-600': student.donation_status === 'Presente' || student.donation_status === 'Criado',
                                    'text-red-600': student.donation_status === 'Não Criado',
                                    'text-blue-600': student.donation_status === 'Já Presente'
                                }" x-text="student.donation_status"></span>
                            </td>
                            <td class="w-1/10 px-4 py-2 flex item-center justify-center">
                                <button @click="openDeleteMenu(student.id)" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i> <!-- Ícone de lixeira -->
                                </button>
                            </td>
                        </tr>
                    </template>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Botão para Atualizar Frequências e Doações -->
        <div class="flex justify-end">
            <x-button @click="updateFrequenciesAndDonations()" x-show="selectedMonth && selectedYear" x-bind:disabled="!selectedMonth || !selectedYear || loading || loadingUpdate" variant="blue">
                <span x-show="!loading && !loadingUpdate">Atualizar Frequências e/ou Doações</span>
                
                <span x-show="loading">Carregando...</span>
                <span x-show="loadingUpdate">Atualizando...</span>
                <svg x-show="loading || loadingUpdate" class="animate-spin h-5 w-5 text-gray-100 ml-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </x-button>
        </div>
    </div>
        
    </main>

</x-app-layout>
