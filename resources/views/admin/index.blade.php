<x-app-layout
    :context="$context"
    class="admin-frequency-layout"
>

    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h2 class="text-2xl font-bold leading-tight text-[#3E4C43] dark:text-white">
                {{ __('Parte Admin') }}
            </h2>

        </div>
    </x-slot>


    <main class="admin-frequency-page">

        <div
            x-data="{
                selectedMonth: '',
                selectedYear: '',

                months: [
                    'Janeiro',
                    'Fevereiro',
                    'Março',
                    'Abril',
                    'Maio',
                    'Junho',
                    'Julho',
                    'Agosto',
                    'Setembro',
                    'Outubro',
                    'Novembro',
                    'Dezembro'
                ],

                years: {{ json_encode($years) }},

                students: [],
                monthYear: '',
                loading: false,
                loadingUpdate: false,


                async loadStudents() {

                    if (!this.selectedMonth || !this.selectedYear) {
                        return;
                    }

                    this.loading = true;

                    try {

                        const response = await fetch(
                            `/admin/check?month=${this.selectedMonth}&year=${this.selectedYear}`
                        );

                        const data = await response.json();

                        this.students = data.students;
                        this.monthYear = data.monthYear;

                    } catch (error) {

                        console.error(error);

                        toastr.error(
                            'Erro ao carregar frequências e doações'
                        );

                    } finally {

                        this.loading = false;

                    }
                },


                async updateFrequenciesAndDonations() {

                    if (!this.selectedMonth || !this.selectedYear) {
                        return;
                    }

                    this.loadingUpdate = true;

                    try {

                        const studentIds = this.students.map(
                            student => student.id
                        );

                        const response = await fetch(
                            '/admin/update-frequencies-donations',
                            {
                                method: 'POST',

                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },

                                body: JSON.stringify({
                                    month: this.selectedMonth,
                                    year: this.selectedYear,
                                    student_ids: studentIds
                                })
                            }
                        );

                        const result = await response.json();

                        if (result.success) {

                            toastr.success(result.message);

                            this.students = this.students.map(student => {

                                const updatedStudent =
                                    result.students.find(
                                        s => s.id === student.id
                                    );

                                if (updatedStudent) {

                                    return {
                                        ...student,

                                        frequency_status:
                                            updatedStudent.frequency_status,

                                        donation_status:
                                            updatedStudent.donation_status
                                    };

                                }

                                return student;

                            });

                            this.students =
                                this.students.filter(
                                    student =>
                                        student.state !== 'archived'
                                );

                        } else {

                            toastr.error(result.message);

                        }

                    } catch (error) {

                        console.error(
                            'Erro ao atualizar:',
                            error
                        );

                        toastr.error(
                            'Erro ao atualizar frequências e doações.'
                        );

                    } finally {

                        this.loadingUpdate = false;

                    }
                },


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

                            popup: 'admin-swal-popup',

                            title: 'admin-swal-title',

                            confirmButton:
                                'admin-swal-confirm',

                            denyButton:
                                'admin-swal-deny',

                            cancelButton:
                                'admin-swal-cancel'
                        }

                    });


                    if (option === true) {

                        this.deleteRecord(
                            studentId,
                            'frequency'
                        );

                    } else if (option === false) {

                        this.deleteRecord(
                            studentId,
                            'donation'
                        );

                    }

                },


                async deleteRecord(studentId, type) {

                    let titleText;

                    if (type === 'donation') {

                        titleText =
                            'Excluir a doação selecionada?';

                    } else {

                        titleText =
                            'Excluir a frequência selecionada?';

                    }


                    const { value: password } =
                        await Swal.fire({

                            title: titleText,

                            text:
                                'Por favor, insira a senha para confirmar a exclusão.',

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

                                popup:
                                    'admin-swal-popup',

                                title:
                                    'admin-swal-title',

                                htmlContainer:
                                    'admin-swal-text',

                                input:
                                    'admin-swal-input',

                                confirmButton:
                                    'admin-swal-confirm',

                                cancelButton:
                                    'admin-swal-cancel',

                                validationMessage:
                                    'admin-swal-validation'
                            },


                            preConfirm: (senha) => {

                                return fetch(
                                    '/validate-password',
                                    {
                                        method: 'POST',

                                        headers: {
                                            'Content-Type':
                                                'application/json',

                                            'X-CSRF-TOKEN':
                                                '{{ csrf_token() }}'
                                        },

                                        body: JSON.stringify({
                                            senha: senha
                                        })
                                    }
                                )
                                .then(response => {

                                    if (!response.ok) {

                                        throw new Error(
                                            response.statusText
                                        );

                                    }

                                    return response.json();

                                })
                                .then(data => {

                                    if (data.valid) {

                                        return true;

                                    }

                                    Swal.showValidationMessage(
                                        'Senha incorreta!'
                                    );

                                    return false;

                                })
                                .catch(() => {

                                    Swal.showValidationMessage(
                                        'Erro na validação da senha!'
                                    );

                                    return false;

                                });

                            }

                        });


                    if (!password) {
                        return;
                    }


                    try {

                        const endpoint =
                            type === 'frequency'

                                ? `/admin/delete-frequency/${studentId}`

                                : `/admin/delete-donation/${studentId}`;


                        const response = await fetch(
                            endpoint,
                            {
                                method: 'DELETE',

                                headers: {
                                    'X-CSRF-TOKEN':
                                        '{{ csrf_token() }}',

                                    'Content-Type':
                                        'application/json'
                                },

                                body: JSON.stringify({

                                    password: password,

                                    month:
                                        this.selectedMonth,

                                    year:
                                        this.selectedYear

                                })
                            }
                        );


                        const result =
                            await response.json();


                        if (result.success) {

                            toastr.success(
                                result.message
                            );

                            this.loadStudents();

                        } else {

                            toastr.error(
                                result.message
                            );

                        }

                    } catch (error) {

                        console.error(
                            `Erro ao apagar ${type}:`,
                            error
                        );

                        toastr.error(
                            `Erro ao apagar ${type}.`
                        );

                    }

                },


                clearStudents() {

                    this.students = [];
                    this.monthYear = '';

                }

            }"

            x-init="
                $watch('selectedMonth', () => clearStudents());
                $watch('selectedYear', () => clearStudents());
            "

            class="admin-frequency-card"
        >


            {{-- =====================================================
                 TÍTULO
            ====================================================== --}}

            <div class="admin-frequency-heading">

                <div>

                    <h1>
                        Atualizar Frequências e Doações
                    </h1>

                    <p>
                        Selecione o mês e o ano para consultar e atualizar os registros dos estudantes.
                    </p>

                </div>

            </div>


            {{-- =====================================================
                 FILTROS
            ====================================================== --}}

            <div class="admin-frequency-filters">

                <div>

                    <label
                        for="month"
                        class="admin-frequency-label"
                    >
                        Mês
                    </label>


                    <select
                        id="month"
                        x-model="selectedMonth"
                        class="admin-frequency-select"
                    >

                        <option value="">
                            Selecione um mês
                        </option>


                        <template
                            x-for="(month, index) in months"
                            :key="index"
                        >

                            <option
                                x-text="month"
                                :value="month"
                            ></option>

                        </template>

                    </select>

                </div>


                <div>

                    <label
                        for="year"
                        class="admin-frequency-label"
                    >
                        Ano
                    </label>


                    <select
                        id="year"
                        x-model="selectedYear"
                        class="admin-frequency-select"
                    >

                        <option value="">
                            Selecione um ano
                        </option>


                        <template
                            x-for="(year, index) in years"
                            :key="index"
                        >

                            <option
                                x-text="year"
                                :value="year"
                            ></option>

                        </template>

                    </select>

                </div>

            </div>


            {{-- =====================================================
                 BOTÃO CARREGAR
            ====================================================== --}}

            <div class="admin-frequency-actions">

                <button
                    type="button"
                    @click="loadStudents()"

                    x-bind:disabled="
                        !selectedMonth ||
                        !selectedYear ||
                        loading ||
                        loadingUpdate
                    "

                    class="admin-frequency-primary-button"
                >

                    <svg
                        x-show="!loading"
                        xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                    </svg>


                    <svg
                        x-show="loading"
                        class="animate-spin w-5 h-5"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>


                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                        ></path>

                    </svg>


                    <span x-show="!loading">
                        Carregar Estudantes
                    </span>


                    <span x-show="loading">
                        Carregando...
                    </span>

                </button>

            </div>


            {{-- =====================================================
                 LISTA DE ESTUDANTES
            ====================================================== --}}

            <div
                x-show="selectedMonth && selectedYear"
                x-transition
                class="admin-frequency-results"
            >


                <div class="admin-frequency-results-header">

                    <div>

                        <h3>
                            Estudantes
                        </h3>


                        <p
                            x-show="monthYear"
                            x-text="monthYear"
                        ></p>

                    </div>


                    <span
                        x-show="students.length"
                        x-text="students.length + ' estudante(s)'"
                        class="admin-frequency-count"
                    ></span>

                </div>


                {{-- =================================================
                     TABELA
                ================================================== --}}

                <div class="admin-frequency-table-wrapper">

                    <table class="admin-frequency-table">

                        <thead>

                            <tr>

                                <th>
                                    Nome
                                </th>

                                <th>
                                    Frequência
                                </th>

                                <th>
                                    Doação
                                </th>

                                <th class="text-center">
                                    Ação
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <template
                                x-for="student in students"
                                :key="student.id"
                            >

                                <tr>

                                    <td>

                                        <div class="admin-student-name">

                                            <span
                                                x-text="student.name"
                                            ></span>


                                            <span
                                                x-show="
                                                    student.state === 'archived'
                                                "
                                                class="admin-archived-label"
                                            >
                                                Arquivado
                                            </span>

                                        </div>

                                    </td>


                                    <td>

                                        <span
                                            :class="{

                                                'status-success':
                                                    student.frequency_status === 'Presente' ||
                                                    student.frequency_status === 'Criado',

                                                'status-danger':
                                                    student.frequency_status === 'Não Criado',

                                                'status-info':
                                                    student.frequency_status === 'Já Presente'

                                            }"

                                            x-text="
                                                student.frequency_status
                                            "
                                        ></span>

                                    </td>


                                    <td>

                                        <span
                                            :class="{

                                                'status-success':
                                                    student.donation_status === 'Presente' ||
                                                    student.donation_status === 'Criado',

                                                'status-danger':
                                                    student.donation_status === 'Não Criado',

                                                'status-info':
                                                    student.donation_status === 'Já Presente'

                                            }"

                                            x-text="
                                                student.donation_status
                                            "
                                        ></span>

                                    </td>


                                    <td>

                                        <div class="flex justify-center">

                                            <button
                                                type="button"
                                                @click="
                                                    openDeleteMenu(
                                                        student.id
                                                    )
                                                "
                                                class="admin-delete-button"
                                                title="Excluir frequência ou doação"
                                            >

                                                <svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5"
                                                    fill="none"
                                                    viewBox="0 0 24 24"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h12"
                                                    />

                                                </svg>

                                            </button>

                                        </div>

                                    </td>

                                </tr>

                            </template>


                            {{-- =================================================
                                 NENHUM RESULTADO
                            ================================================== --}}

                            <tr
                                x-show="
                                    !loading &&
                                    students.length === 0 &&
                                    monthYear
                                "
                            >

                                <td
                                    colspan="4"
                                    class="admin-empty-state"
                                >

                                    <div>

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="w-10 h-10 mx-auto mb-3"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor"
                                            stroke-width="1.5"
                                        >

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4"
                                            />

                                        </svg>


                                        <p>
                                            Nenhum estudante encontrado para este período.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>


                {{-- =================================================
                     BOTÃO ATUALIZAR
                ================================================== --}}

                <div class="admin-frequency-update">

                    <button
                        type="button"

                        @click="
                            updateFrequenciesAndDonations()
                        "

                        x-show="
                            selectedMonth &&
                            selectedYear &&
                            students.length
                        "

                        x-bind:disabled="
                            !selectedMonth ||
                            !selectedYear ||
                            loading ||
                            loadingUpdate
                        "

                        class="admin-frequency-update-button"
                    >

                        <svg
                            x-show="!loadingUpdate"
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                            />

                        </svg>


                        <svg
                            x-show="loadingUpdate"
                            class="animate-spin w-5 h-5"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >

                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>


                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
                            ></path>

                        </svg>


                        <span x-show="!loadingUpdate">
                            Atualizar Frequências e/ou Doações
                        </span>


                        <span x-show="loadingUpdate">
                            Atualizando...
                        </span>

                    </button>

                </div>

            </div>

        </div>

    </main>


    <style>

        /* =========================================================
           PALETA PADRÃO DO SIAPAE
           ========================================================= */

        html,
        body {
            background-color: #E8F0EA !important;
        }


        /*
         * Fundo principal da página.
         *
         * A tela padrão utiliza exatamente o mesmo
         * verde-claro do .siapae-system-bg do x-app-layout.
         */

        .admin-frequency-page {
            width: 100%;

            min-height: calc(100vh - 64px);

            padding: 1.5rem 1rem;

            background-color: #E8F0EA !important;

            box-sizing: border-box;
        }


        /* =========================================================
           CARD PRINCIPAL
        ========================================================= */

        .admin-frequency-card {

            width: 100%;

            max-width: 1480px;

            margin: 0 auto;

            /*
             * Na tela padrão o card é branco.
             */

            background-color: #FFFFFF !important;

            border: 1px solid #E4E8E2;

            border-radius: 14px;

            box-shadow:
                0 8px 24px rgba(47, 107, 79, 0.06);

            padding: 2rem;

            display: flex;

            flex-direction: column;

            gap: 1.75rem;

            box-sizing: border-box;
        }


        /* =========================================================
           CABEÇALHO
        ========================================================= */

        .admin-frequency-heading {

            padding-bottom: 1.25rem;

            border-bottom: 1px solid #E4E8E2;
        }


        .admin-frequency-heading h1 {

            margin: 0;

            color: #3E4C43;

            font-size: 1.5rem;

            line-height: 1.35;

            font-weight: 700;
        }


        .admin-frequency-heading p {

            margin-top: 0.45rem;

            color: #7A867E;

            font-size: 0.9rem;
        }


        /* =========================================================
           FILTROS
        ========================================================= */

        .admin-frequency-filters {

            display: grid;

            grid-template-columns:
                repeat(2, minmax(0, 1fr));

            gap: 1.25rem;
        }


        .admin-frequency-label {

            display: block;

            margin-bottom: 0.5rem;

            color: #3E4C43;

            font-size: 0.875rem;

            font-weight: 600;
        }


        .admin-frequency-select {

            width: 100%;

            min-height: 48px;

            padding:
                0.7rem
                0.9rem;

            border: 1px solid #D7DEE5;

            border-radius: 8px;

            background-color: #FFFFFF;

            color: #3E4C43;

            font-size: 0.95rem;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background-color 0.2s ease;
        }


        .admin-frequency-select:hover {

            border-color: #B9C9BE;
        }


        .admin-frequency-select:focus {

            border-color: #2F6B4F;

            box-shadow:
                0 0 0 3px rgba(47, 107, 79, 0.10);
        }


        /* =========================================================
           BOTÃO CARREGAR
        ========================================================= */

        .admin-frequency-actions {

            display: flex;

            justify-content: flex-end;
        }


        .admin-frequency-primary-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 0.5rem;

            min-height: 46px;

            padding:
                0.7rem
                1.25rem;

            border: none;

            border-radius: 8px;

            /*
             * Verde padrão da interface.
             */

            background-color: #2F6B4F;

            color: #FFFFFF;

            font-size: 0.9rem;

            font-weight: 600;

            box-shadow:
                0 2px 5px rgba(47, 107, 79, 0.15);

            transition:
                background-color 0.2s ease,
                transform 0.2s ease,
                box-shadow 0.2s ease;
        }


        .admin-frequency-primary-button:hover:not(:disabled) {

            background-color: #285D44;

            transform: translateY(-1px);

            box-shadow:
                0 4px 9px rgba(47, 107, 79, 0.18);
        }


        .admin-frequency-primary-button:disabled {

            cursor: not-allowed;

            opacity: 0.55;
        }


        /* =========================================================
           RESULTADOS
        ========================================================= */

        .admin-frequency-results {

            padding-top: 1.5rem;

            border-top: 1px solid #E4E8E2;
        }


        .admin-frequency-results-header {

            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 1rem;

            margin-bottom: 1rem;
        }


        .admin-frequency-results-header h3 {

            margin: 0;

            color: #3E4C43;

            font-size: 1.1rem;

            font-weight: 700;
        }


        .admin-frequency-results-header p {

            margin-top: 0.25rem;

            color: #2F6B4F;

            font-size: 0.875rem;

            font-weight: 500;
        }


        .admin-frequency-count {

            display: inline-flex;

            align-items: center;

            padding:
                0.35rem
                0.7rem;

            border-radius: 999px;

            background-color: #E9F0EA;

            color: #2F6B4F;

            font-size: 0.8rem;

            font-weight: 600;
        }


        /* =========================================================
           TABELA
        ========================================================= */

        .admin-frequency-table-wrapper {

            overflow-x: auto;

            border: 1px solid #E4E8E2;

            border-radius: 10px;

            background-color: #FFFFFF;
        }


        .admin-frequency-table {

            width: 100%;

            min-width: 700px;

            border-collapse: collapse;
        }


        .admin-frequency-table thead {

            /*
             * Cabeçalho das tabelas da identidade padrão.
             */

            background-color: #F1F4EF;
        }


        .admin-frequency-table th {

            padding:
                0.85rem
                1rem;

            border-bottom: 1px solid #E4E8E2;

            color: #6B8174;

            font-size: 0.75rem;

            font-weight: 700;

            text-align: left;

            text-transform: uppercase;

            letter-spacing: 0.025em;
        }


        .admin-frequency-table td {

            padding:
                0.9rem
                1rem;

            border-bottom: 1px solid #EDF1EE;

            color: #3E4C43;

            font-size: 0.875rem;

            vertical-align: middle;
        }


        .admin-frequency-table tbody tr:last-child td {

            border-bottom: none;
        }


        .admin-frequency-table tbody tr {

            transition:
                background-color 0.15s ease;
        }


        .admin-frequency-table tbody tr:hover {

            background-color: #F8FAF9;
        }


        /* =========================================================
           NOME DO ESTUDANTE
        ========================================================= */

        .admin-student-name {

            display: flex;

            align-items: center;

            gap: 0.5rem;

            font-weight: 500;
        }


        .admin-archived-label {

            display: inline-flex;

            align-items: center;

            padding:
                0.2rem
                0.5rem;

            border-radius: 999px;

            background-color: #F0F2F1;

            color: #7A867E;

            font-size: 0.7rem;

            font-weight: 600;
        }


        /* =========================================================
           STATUS
        ========================================================= */

        .status-success,
        .status-danger,
        .status-info {

            display: inline-flex;

            align-items: center;

            padding:
                0.3rem
                0.65rem;

            border-radius: 999px;

            font-size: 0.75rem;

            font-weight: 600;
        }


        .status-success {

            background-color: #E9F4EC;

            color: #2F6B4F;
        }


        .status-danger {

            background-color: #FBECEC;

            color: #A33A3A;
        }


        .status-info {

            background-color: #EDF3F8;

            color: #42647A;
        }


        /* =========================================================
           BOTÃO EXCLUIR
        ========================================================= */

        .admin-delete-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            width: 36px;

            height: 36px;

            border: 1px solid #F0D9D9;

            border-radius: 7px;

            background-color: #FFF8F8;

            color: #A33A3A;

            transition:
                background-color 0.2s ease,
                border-color 0.2s ease,
                color 0.2s ease;
        }


        .admin-delete-button:hover {

            background-color: #FBECEC;

            border-color: #E8BDBD;

            color: #8D2E2E;
        }


        /* =========================================================
           ESTADO VAZIO
        ========================================================= */

        .admin-empty-state {

            padding: 3rem 1rem !important;

            color: #7A867E;

            text-align: center;
        }


        /* =========================================================
           BOTÃO ATUALIZAR
        ========================================================= */

        .admin-frequency-update {

            display: flex;

            justify-content: flex-end;

            margin-top: 1.25rem;
        }


        .admin-frequency-update-button {

            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 0.5rem;

            min-height: 46px;

            padding:
                0.7rem
                1.25rem;

            border: none;

            border-radius: 8px;

            background-color: #2F6B4F;

            color: #FFFFFF;

            font-size: 0.9rem;

            font-weight: 600;

            box-shadow:
                0 2px 5px rgba(47, 107, 79, 0.15);

            transition:
                background-color 0.2s ease,
                transform 0.2s ease;
        }


        .admin-frequency-update-button:hover:not(:disabled) {

            background-color: #285D44;

            transform: translateY(-1px);
        }


        .admin-frequency-update-button:disabled {

            cursor: not-allowed;

            opacity: 0.55;
        }


        /* =========================================================
           SWEETALERT
        ========================================================= */

        .admin-swal-popup {

            border-radius: 12px !important;

            border: 1px solid #E4E8E2 !important;
        }


        .admin-swal-title {

            color: #3E4C43 !important;

            font-weight: 700 !important;
        }


        .admin-swal-text {

            color: #7A867E !important;
        }


        .admin-swal-input {

            border: 1px solid #D7DEE5 !important;

            border-radius: 8px !important;

            color: #3E4C43 !important;
        }


        .admin-swal-confirm {

            background-color: #2F6B4F !important;

            border-radius: 7px !important;

            color: #FFFFFF !important;
        }


        .admin-swal-confirm:hover {

            background-color: #285D44 !important;
        }


        .admin-swal-deny {

            background-color: #7A867E !important;

            border-radius: 7px !important;

            color: #FFFFFF !important;
        }


        .admin-swal-cancel {

            background-color: #EEF1EF !important;

            border-radius: 7px !important;

            color: #3E4C43 !important;
        }


        .admin-swal-validation {

            background-color: #FBECEC !important;

            color: #A33A3A !important;
        }


        /* =========================================================
           RESPONSIVO
        ========================================================= */

        @media (max-width: 768px) {

            .admin-frequency-page {

                padding: 1rem;
            }


            .admin-frequency-card {

                padding: 1.25rem;

                border-radius: 10px;
            }


            .admin-frequency-filters {

                grid-template-columns: 1fr;
            }


            .admin-frequency-actions {

                justify-content: stretch;
            }


            .admin-frequency-primary-button {

                width: 100%;
            }


            .admin-frequency-results-header {

                align-items: flex-start;

                flex-direction: column;
            }


            .admin-frequency-update {

                justify-content: stretch;
            }


            .admin-frequency-update-button {

                width: 100%;
            }

        }

    </style>

</x-app-layout>