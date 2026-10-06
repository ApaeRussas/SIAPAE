<x-app-layout>

```
<div class="documents-create-page">

    <x-slot name="header">
        <div class="documents-header">
            <div>
                <h2>Adicionar Documento</h2>
                <p>Cadastre um novo documento para um estudante.</p>
            </div>
        </div>
    </x-slot>

    <div class="documents-create-content">

        <div class="document-form-card">

            <form
                method="POST"
                action="{{ route('student-documents.store') }}"
                enctype="multipart/form-data"
                id="document-form"
            >

                @csrf

                {{-- =====================================================
                     ESTUDANTE
                ====================================================== --}}

                <div class="form-section">

                    <div class="section-title">
                        <span class="section-number">1</span>

                        <div>
                            <h3>Estudante</h3>
                            <p>Selecione o estudante ao qual o documento pertence.</p>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="student-search">
                            Estudante <span>*</span>
                        </label>

                        <div class="student-select-wrapper">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="student-search-icon"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m21 21-4.35-4.35m1.35-5.4a6.75 6.75 0 1 1-13.5 0 6.75 6.75 0 0 1 13.5 0Z"
                                />
                            </svg>

                            <input
                                type="text"
                                id="student-search"
                                class="form-input student-search-input"
                                placeholder="Digite o nome do estudante para buscar..."
                                autocomplete="off"
                            >

                            <input
                                type="hidden"
                                name="student_id"
                                id="student_id"
                                value="{{ old('student_id') }}"
                            >

                        </div>

                        <div
                            id="student-results"
                            class="student-results"
                        ></div>

                        <div
                            id="selected-student"
                            class="selected-student"
                            style="display: none;"
                        >
                            <div class="selected-student-info">

                                <div class="selected-student-icon">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="19"
                                        height="19"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a8.25 8.25 0 0 1 15 0"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <span>Estudante selecionado</span>
                                    <strong id="selected-student-name"></strong>
                                </div>

                            </div>

                            <button
                                type="button"
                                id="change-student"
                                class="change-student-button"
                            >
                                Alterar
                            </button>

                        </div>

                        @error('student_id')
                            <p class="form-error">{{ $message }}</p>
                        @enderror

                    </div>

                </div>


                {{-- =====================================================
                     DADOS DO DOCUMENTO
                ====================================================== --}}

                <div class="form-section">

                    <div class="section-title">
                        <span class="section-number">2</span>

                        <div>
                            <h3>Dados do documento</h3>
                            <p>Informe as informações básicas do documento.</p>
                        </div>
                    </div>

                    <div class="form-grid">

                        {{-- Tipo --}}
                        <div class="form-group">

                            <label for="document_type">
                                Tipo do documento <span>*</span>
                            </label>

                            <select
                                name="document_type"
                                id="document_type"
                                class="form-input"
                                required
                            >
                                <option value="">
                                    Selecione o tipo de documento
                                </option>

                                <option
                                    value="RG"
                                    {{ old('document_type') === 'RG' ? 'selected' : '' }}
                                >
                                    RG
                                </option>

                                <option
                                    value="CPF"
                                    {{ old('document_type') === 'CPF' ? 'selected' : '' }}
                                >
                                    CPF
                                </option>

                                <option
                                    value="Certidão de nascimento"
                                    {{ old('document_type') === 'Certidão de nascimento' ? 'selected' : '' }}
                                >
                                    Certidão de nascimento
                                </option>

                                <option
                                    value="Cartão SUS"
                                    {{ old('document_type') === 'Cartão SUS' ? 'selected' : '' }}
                                >
                                    Cartão SUS
                                </option>

                                <option
                                    value="Comprovante de residência"
                                    {{ old('document_type') === 'Comprovante de residência' ? 'selected' : '' }}
                                >
                                    Comprovante de residência
                                </option>

                                <option
                                    value="Documento do responsável"
                                    {{ old('document_type') === 'Documento do responsável' ? 'selected' : '' }}
                                >
                                    Documento do responsável
                                </option>

                                <option
                                    value="Laudo/Relatório"
                                    {{ old('document_type') === 'Laudo/Relatório' ? 'selected' : '' }}
                                >
                                    Laudo/Relatório
                                </option>

                                <option
                                    value="Outros"
                                    {{ old('document_type') === 'Outros' ? 'selected' : '' }}
                                >
                                    Outros
                                </option>

                            </select>

                            @error('document_type')
                                <p class="form-error">{{ $message }}</p>
                            @enderror

                        </div>


                        {{-- Título --}}
                        <div class="form-group">

                            <label for="title">
                                Título do documento <span>*</span>
                            </label>

                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="form-input"
                                value="{{ old('title') }}"
                                placeholder="Ex.: RG - Frente e verso"
                                maxlength="255"
                                required
                            >

                            @error('title')
                                <p class="form-error">{{ $message }}</p>
                            @enderror

                        </div>

                    </div>


                    {{-- Descrição --}}
                    <div class="form-group">

                        <label for="description">
                            Descrição
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            class="form-input form-textarea"
                            rows="3"
                            placeholder="Adicione alguma observação sobre este documento, se necessário..."
                        >{{ old('description') }}</textarea>

                        @error('description')
                            <p class="form-error">{{ $message }}</p>
                        @enderror

                    </div>

                </div>


                {{-- =====================================================
                     ARQUIVO
                ====================================================== --}}

                <div class="form-section">

                    <div class="section-title">
                        <span class="section-number">3</span>

                        <div>
                            <h3>Arquivo</h3>
                            <p>Envie o arquivo que será armazenado no sistema.</p>
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="document">
                            Arquivo <span>*</span>
                        </label>

                        <label
                            for="document"
                            class="file-upload-area"
                            id="file-upload-area"
                        >

                            <div class="file-upload-icon">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="27"
                                    height="27"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 16V4m0 0-4 4m4-4 4 4M5 14v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-5"
                                    />
                                </svg>

                            </div>

                            <div class="file-upload-text">

                                <strong id="file-name">
                                    Clique para selecionar o arquivo
                                </strong>

                                <span id="file-description">
                                    PDF, JPG, JPEG, PNG, DOC ou DOCX — máximo de 10 MB
                                </span>

                            </div>

                            <input
                                type="file"
                                name="document"
                                id="document"
                                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                required
                            >

                        </label>

                        @error('document')
                            <p class="form-error">{{ $message }}</p>
                        @enderror

                    </div>

                </div>


                {{-- =====================================================
                     BOTÕES
                ====================================================== --}}

                <div class="form-actions">

                    <a
                        href="{{ route('student-documents.index') }}"
                        class="cancel-button"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="submit-button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="18"
                            height="18"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14M12 5l7 7-7 7"
                            />
                        </svg>

                        Cadastrar documento
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<style>

    /* =========================================================
       PÁGINA
    ========================================================= */

    .documents-create-page {
        width: 100%;
        min-height: calc(100vh - 64px);
        background: transparent;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    /* =========================================================
       CABEÇALHO
    ========================================================= */

    .documents-header {
        width: calc(100% - 64px);
        max-width: 1400px;
        margin: 0 auto;
        padding: 16px 0 12px;
        box-sizing: border-box;
    }

    .documents-header h2 {
        margin: 0;
        color: #000;
        font-size: 27px;
        font-weight: 700;
        line-height: 1.2;
    }

    .documents-header p {
        margin: 5px 0 0;
        color: #62746B;
        font-size: 15px;
        line-height: 1.4;
    }


    /* =========================================================
       CONTEÚDO
    ========================================================= */

    .documents-create-content {
        width: calc(100% - 64px);
        max-width: 1400px;
        margin: 0 auto;
        padding: 4px 0 28px;
        box-sizing: border-box;
    }


    /* =========================================================
       CARD
    ========================================================= */

    .document-form-card {
        width: 100%;
        background: #fff;
        border: 1px solid #DCE7E1;
        border-radius: 18px;
        overflow: hidden;
        box-sizing: border-box;
    }


    /* =========================================================
       SEÇÕES
    ========================================================= */

    .form-section {
        padding: 22px 26px;
        border-bottom: 1px solid #EDF1EE;
    }

    .form-section:last-of-type {
        border-bottom: none;
    }

    .section-title {
        display: flex;
        align-items: center;
        gap: 11px;
        margin-bottom: 18px;
    }

    .section-number {
        flex-shrink: 0;
        width: 31px;
        height: 31px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #E7F1EB;
        color: #327A58;
        font-size: 14px;
        font-weight: 700;
    }

    .section-title h3 {
        margin: 0;
        color: #263D32;
        font-size: 16px;
        font-weight: 700;
    }

    .section-title p {
        margin: 2px 0 0;
        color: #718078;
        font-size: 13px;
    }


    /* =========================================================
       CAMPOS
    ========================================================= */

    .form-group {
        margin-bottom: 16px;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group > label:not(.file-upload-area) {
        display: block;
        margin-bottom: 6px;
        color: #344E41;
        font-size: 13px;
        font-weight: 600;
    }

    .form-group > label span {
        color: #327A58;
    }

    .form-input {
        width: 100%;
        height: 45px;
        padding: 0 13px;
        border: 1px solid #D7E2DC;
        border-radius: 10px;
        outline: none;
        background: #fff;
        color: #334E68;
        font-size: 14px;
        box-sizing: border-box;
        transition:
            border-color .2s ease,
            box-shadow .2s ease;
    }

    .form-input:focus {
        border-color: #327A58;
        box-shadow: 0 0 0 3px rgba(50, 122, 88, .08);
    }

    select.form-input {
        cursor: pointer;
    }

    .form-textarea {
        height: auto;
        min-height: 88px;
        padding: 11px 13px;
        resize: vertical;
        line-height: 1.45;
    }

    .form-input::placeholder {
        color: #87958E;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 18px;
        margin-bottom: 16px;
    }


    /* =========================================================
       BUSCA DO ESTUDANTE
    ========================================================= */

    .student-select-wrapper {
        position: relative;
    }

    .student-search-input {
        padding-left: 42px;
    }

    .student-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        width: 19px;
        height: 19px;
        transform: translateY(-50%);
        color: #7A8D83;
        pointer-events: none;
        z-index: 2;
    }

    .student-results {
        position: relative;
        z-index: 10;
        width: 100%;
        max-height: 210px;
        overflow-y: auto;
        background: #fff;
        border: 1px solid #D7E2DC;
        border-top: none;
        border-radius: 0 0 10px 10px;
        box-sizing: border-box;
        box-shadow: 0 8px 18px rgba(38, 61, 50, .08);
    }

    .student-result {
        width: 100%;
        padding: 11px 13px;
        border: none;
        border-bottom: 1px solid #EDF1EE;
        background: #fff;
        color: #334E68;
        text-align: left;
        font-size: 14px;
        cursor: pointer;
        transition: background .15s ease;
    }

    .student-result:last-child {
        border-bottom: none;
    }

    .student-result:hover {
        background: #F1F5F2;
    }

    .no-student-result {
        padding: 13px;
        color: #718078;
        font-size: 13px;
    }


    /* =========================================================
       ESTUDANTE SELECIONADO
    ========================================================= */

    .selected-student {
        margin-top: 8px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        border: 1px solid #CFE0D5;
        border-radius: 10px;
        background: #F5F9F6;
        box-sizing: border-box;
    }

    .selected-student-info {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }

    .selected-student-icon {
        flex-shrink: 0;
        width: 34px;
        height: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #E7F1EB;
        color: #327A58;
    }

    .selected-student-info span {
        display: block;
        margin-bottom: 2px;
        color: #718078;
        font-size: 11px;
    }

    .selected-student-info strong {
        display: block;
        color: #263D32;
        font-size: 14px;
        font-weight: 700;
    }

    .change-student-button {
        flex-shrink: 0;
        border: none;
        background: transparent;
        color: #327A58;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .change-student-button:hover {
        text-decoration: underline;
    }


    /* =========================================================
       UPLOAD
    ========================================================= */

    .file-upload-area {
        position: relative;
        min-height: 112px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 13px;
        padding: 18px;
        border: 1.5px dashed #C8D9CF;
        border-radius: 12px;
        background: #FAFCFB;
        cursor: pointer;
        box-sizing: border-box;
        transition:
            border-color .2s ease,
            background .2s ease;
    }

    .file-upload-area:hover {
        border-color: #327A58;
        background: #F5F9F6;
    }

    .file-upload-area input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        pointer-events: none;
    }

    .file-upload-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 13px;
        background: #E7F1EB;
        color: #327A58;
    }

    .file-upload-text {
        min-width: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .file-upload-text strong {
        color: #286048;
        font-size: 14px;
        font-weight: 700;
    }

    .file-upload-text span {
        color: #718078;
        font-size: 12px;
    }


    /* =========================================================
       ERROS
    ========================================================= */

    .form-error {
        margin: 5px 0 0;
        color: #B94A48;
        font-size: 12px;
    }


    /* =========================================================
       BOTÕES
    ========================================================= */

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        padding: 15px 26px;
        background: #FAFCFB;
        border-top: 1px solid #EDF1EE;
    }

    .cancel-button,
    .submit-button {
        height: 42px;
        padding: 0 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        box-sizing: border-box;
        cursor: pointer;
        text-decoration: none !important;
    }

    .cancel-button {
        border: 1px solid #D7E2DC;
        background: #fff;
        color: #526A60 !important;
    }

    .cancel-button:hover {
        background: #F5F8F6;
    }

    .submit-button {
        border: none;
        background: #327A58;
        color: #fff;
    }

    .submit-button:hover {
        background: #245E43;
    }


    /* =========================================================
       RESPONSIVO
    ========================================================= */

    @media (max-width: 900px) {

        .documents-header,
        .documents-create-content {
            width: calc(100% - 36px);
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

    }

    @media (max-width: 640px) {

        .documents-header,
        .documents-create-content {
            width: calc(100% - 24px);
        }

        .documents-header {
            padding-top: 12px;
        }

        .documents-header h2 {
            font-size: 23px;
        }

        .documents-header p {
            font-size: 14px;
        }

        .form-section {
            padding: 18px 15px;
        }

        .form-actions {
            padding: 13px 15px;
            flex-direction: column-reverse;
        }

        .cancel-button,
        .submit-button {
            width: 100%;
        }

        .file-upload-area {
            flex-direction: column;
            text-align: center;
        }

    }

</style>


<script>

    document.addEventListener('DOMContentLoaded', function () {

        const students = @json(
            $students->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => $student->name,
                ];
            })->values()
        );

        const searchInput = document.getElementById('student-search');
        const studentIdInput = document.getElementById('student_id');
        const resultsContainer = document.getElementById('student-results');

        const selectedStudent = document.getElementById('selected-student');
        const selectedStudentName = document.getElementById('selected-student-name');
        const changeStudentButton = document.getElementById('change-student');

        function showResults(search = '') {

            const term = search.trim().toLowerCase();

            if (!term) {
                resultsContainer.innerHTML = '';
                return;
            }

            const filteredStudents = students
                .filter(student =>
                    student.name.toLowerCase().includes(term)
                )
                .slice(0, 10);

            if (filteredStudents.length === 0) {

                resultsContainer.innerHTML = `
                    <div class="no-student-result">
                        Nenhum estudante encontrado.
                    </div>
                `;

                return;
            }

            resultsContainer.innerHTML = filteredStudents
                .map(student => `
                    <button
                        type="button"
                        class="student-result"
                        data-id="${student.id}"
                        data-name="${escapeHtml(student.name)}"
                    >
                        ${escapeHtml(student.name)}
                    </button>
                `)
                .join('');

        }

        function selectStudent(id, name) {

            studentIdInput.value = id;
            selectedStudentName.textContent = name;

            selectedStudent.style.display = 'flex';

            searchInput.value = '';
            searchInput.style.display = 'none';

            resultsContainer.innerHTML = '';

        }

        function resetStudent() {

            studentIdInput.value = '';

            selectedStudent.style.display = 'none';

            searchInput.style.display = 'block';
            searchInput.value = '';

            searchInput.focus();

        }

        function escapeHtml(value) {

            const div = document.createElement('div');

            div.textContent = value;

            return div.innerHTML;

        }

        searchInput.addEventListener('input', function () {
            showResults(this.value);
        });

        resultsContainer.addEventListener('click', function (event) {

            const button = event.target.closest('.student-result');

            if (!button) {
                return;
            }

            selectStudent(
                button.dataset.id,
                button.dataset.name
            );

        });

        changeStudentButton.addEventListener('click', function () {
            resetStudent();
        });

        document.addEventListener('click', function (event) {

            if (
                !event.target.closest('.student-select-wrapper') &&
                !event.target.closest('#student-results')
            ) {
                resultsContainer.innerHTML = '';
            }

        });


        // {{-- =====================================================
        //      ARQUIVO SELECIONADO
        // ====================================================== --}}

        const fileInput = document.getElementById('document');
        const fileName = document.getElementById('file-name');
        const fileDescription = document.getElementById('file-description');

        fileInput.addEventListener('change', function () {

            if (!this.files || !this.files.length) {
                fileName.textContent =
                    'Clique para selecionar o arquivo';

                fileDescription.textContent =
                    'PDF, JPG, JPEG, PNG, DOC ou DOCX — máximo de 10 MB';

                return;
            }

            const file = this.files[0];

            fileName.textContent = file.name;

            const sizeMb = file.size / (1024 * 1024);

            fileDescription.textContent =
                sizeMb < 1
                    ? `${(file.size / 1024).toFixed(1)} KB`
                    : `${sizeMb.toFixed(2)} MB`;

        });


        // {{-- =====================================================
        //      ESTUDANTE ANTIGO APÓS ERRO DE VALIDAÇÃO
        // ====================================================== --}}

        const oldStudentId = @json(old('student_id'));

        if (oldStudentId) {

            const oldStudent = students.find(
                student => String(student.id) === String(oldStudentId)
            );

            if (oldStudent) {
                selectStudent(
                    oldStudent.id,
                    oldStudent.name
                );
            }

        }

    });

</script>

</x-app-layout>
