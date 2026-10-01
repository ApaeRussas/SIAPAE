<x-app-layout :notRegularSidebar="$notRegularSidebar" :element="$element">

    <div class="student-form-page">

    <x-table-edit 
        title="Aluno - {{$student->name}}" 
        :elementEdit="$student" 
        onlyHead 
        actionRoute="student">

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-2 gap-y-2 mb-3">
            <div class="col-span-1">
                <label for="name" class="block text-sm sm:text-base font-medium mt-3 mb-2">
                    Nome do Aluno: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="name" type="text" name="name" value="{{ old('name', $student->name) }}"
                    class="w-full" placeholder="Ex: João" required />
    
                @error("name")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="name_mother" class="block text-sm sm:text-base font-medium mt-3 mb-2">
                    Nome da Mãe do Aluno: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="name_mother" type="text" name="name_mother" value="{{ old('name_mother', $student->name_mother) }}" class="w-full"
                    placeholder="Ex: Francisca .." required/>
    
                @error("name_mother")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-2 gap-y-3 mb-3">
            <div>
                <label for="class_apae" class="block text-sm sm:text-base font-medium mb-2">
                    Dias de Atendimento na APAE: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.select full idSelect="class_apae" valueName="class_apae">
                    <option value=""> Dias: </option>

                    <option value="Segunda" {{ old('class_apae', $student->class_apae) == 'Segunda' ? 'selected' : '' }}>
                        Segunda
                    </option>
                    <option value="Terça" {{ old('class_apae', $student->class_apae) == 'Terça' ? 'selected' : '' }}>
                        Terça
                    </option>
                    <option value="Quarta" {{ old('class_apae', $student->class_apae) == 'Quarta' ? 'selected' : '' }}>
                        Quarta
                    </option>
                    <option value="Quinta" {{ old('class_apae', $student->class_apae) == 'Quinta' ? 'selected' : '' }}>
                        Quinta
                    </option>
                    <option value="Sexta" {{ old('class_apae', $student->class_apae) == 'Sexta' ? 'selected' : '' }}>
                        Sexta
                    </option>
                    <option value="Segunda e Terça" {{ old('class_apae', $student->class_apae) == 'Segunda e Terça' ? 'selected' : '' }}>
                        Segunda e Terça
                    </option>
                    <option value="Segunda e Quarta" {{ old('class_apae', $student->class_apae) == 'Segunda e Quarta' ? 'selected' : '' }}>
                        Segunda e Quarta
                    </option>
                    <option value="Segunda e Quinta" {{ old('class_apae', $student->class_apae) == 'Segunda e Quinta' ? 'selected' : '' }}>
                        Segunda e Quinta
                    </option>
                    <option value="Segunda e Sexta" {{ old('class_apae', $student->class_apae) == 'Segunda e Sexta' ? 'selected' : '' }}>
                        Segunda e Sexta
                    </option>
                    <option value="Terça e Quarta" {{ old('class_apae', $student->class_apae) == 'Terça e Quarta' ? 'selected' : '' }}>
                        Terça e Quarta
                    </option>
                    <option value="Terça e Quinta" {{ old('class_apae', $student->class_apae) == 'Terça e Quinta' ? 'selected' : '' }}>
                        Terça e Quinta
                    </option>
                    <option value="Terça e Sexta" {{ old('class_apae', $student->class_apae) == 'Terça e Sexta' ? 'selected' : '' }}>
                        Terça e Sexta
                    </option>
                    <option value="Quarta e Quinta" {{ old('class_apae', $student->class_apae) == 'Quarta e Quinta' ? 'selected' : '' }}>
                        Quarta e Quinta
                    </option>
                    <option value="Quarta e Sexta" {{ old('class_apae', $student->class_apae) == 'Quarta e Sexta' ? 'selected' : '' }}>
                        Quarta e Sexta
                    </option>
                    <option value="Quinta e Sexta" {{ old('class_apae', $student->class_apae) == 'Quinta e Sexta' ? 'selected' : '' }}>
                        Quinta e Sexta
                    </option>
                    <option value="Segunda, Terça e Quarta" {{ old('class_apae', $student->class_apae) == 'Segunda, Terça e Quarta' ? 'selected' : '' }}>
                        Segunda, Terça e Quarta
                    </option>
                    <option value="Segunda, Terça e Quinta" {{ old('class_apae', $student->class_apae) == 'Segunda, Terça e Quinta' ? 'selected' : '' }}>
                        Segunda, Terça e Quinta
                    </option>
                    <option value="Segunda, Terça e Sexta" {{ old('class_apae', $student->class_apae) == 'Segunda, Terça e Sexta' ? 'selected' : '' }}>
                        Segunda, Terça e Sexta
                    </option>
                    <option value="Segunda, Quarta e Quinta" {{ old('class_apae', $student->class_apae) == 'Segunda, Quarta e Quinta' ? 'selected' : '' }}>
                        Segunda, Quarta e Quinta
                    </option>
                    <option value="Segunda, Quarta e Sexta" {{ old('class_apae', $student->class_apae) == 'Segunda, Quarta e Sexta' ? 'selected' : '' }}>
                        Segunda, Quarta e Sexta
                    </option>
                    <option value="Segunda, Quinta e Sexta" {{ old('class_apae', $student->class_apae) == 'Segunda, Quinta e Sexta' ? 'selected' : '' }}>
                        Segunda, Quarta e Sexta
                    </option>
                    <option value="Terça, Quarta e Quinta" {{ old('class_apae', $student->class_apae) == 'Terça, Quarta e Quinta' ? 'selected' : '' }}>
                        Terça, Quarta e Quinta
                    </option>
                    <option value="Terça, Quarta e Sexta" {{ old('class_apae', $student->class_apae) == 'Terça, Quarta e Sexta' ? 'selected' : '' }}>
                        Terça, Quarta e Sexta
                    </option>
                    <option value="Terça, Quinta e Sexta" {{ old('class_apae', $student->class_apae) == 'Terça, Quinta e Sexta' ? 'selected' : '' }}>
                        Terça, Quinta e Sexta
                    </option>
                    <option value="Quarta, Quinta e Sexta" {{ old('class_apae', $student->class_apae) == 'Quarta, Quinta e Sexta' ? 'selected' : '' }}>
                        Quarta, Quinta e Sexta
                    </option>
                </x-form.select>
                @error("class_apae")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div>
                <label for="class_apae" class="block text-sm sm:text-base font-medium mb-2">
                    Selecione o Turno realizado na APAE: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.select valueName="turn_apae" full>
                    <option value=""> Turno: </option>

                    <option value="Manhã" {{ old('turn_apae', $student->turn_apae) == 'Manhã' ? 'selected' : '' }}>
                        Manhã
                    </option>
                    <option value="Tarde" {{ old('turn_apae', $student->turn_apae) == 'Tarde' ? 'selected' : '' }}>
                        Tarde
                    </option>
                </x-form.select>
                @error("turn_apae")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>
        
        <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-2 gap-y-3">
            <div class="col-span-1 sm:col-span-2">
                <label for="diagnostic" class="block text-sm sm:text-base font-medium mb-2">
                    Diagnótico do Aluno: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="diagnostic" type="text" name="diagnostic" value="{{ old('diagnostic',$student->diagnostic) }}"
                    class="w-full" placeholder="Ex: Autismo" required/>

                @error("diagnostic")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="cpf" class="block text-sm sm:text-base font-medium mb-2">
                    CPF: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="cpf" type="text" name="cpf" value="{{ old('cpf', $student->cpf) }}"
                    class="cpf w-full" placeholder="Ex: 213.798.541-99" required/>
    
                @error("cpf")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="date" class="block text-sm sm:text-base font-medium mb-2">
                    Data de Nascimento: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="date" type="text" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" autocomplete="off"
                    class="w-full date dateInput" x-init="initFlatpickr" placeholder="Ex: 01/01/2021" required/>
    
                <span id="errorMessage" style="color: red; display: none;">
                    Data inválida. Insira uma data entre 1960 e 2200.
                </span>
                @error("date_of_birth")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-3">
            <div class="col-span-1 sm:col-span-2">
                <label for="school" class="block text-sm sm:text-base font-medium mb-2">
                    Escola do Aluno: (*opcional)
                </label>
                <x-form.input id="school" type="text" name="school" value="{{ old('school', $student->school) }}"
                    class="w-full" placeholder="Ex: Benilce.." />
    
                @error("school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            
            <div class="col-span-1">
                <label for="student_id" class="block text-sm sm:text-base font-medium mb-2">
                    ID do Estudante: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="student_id" type="text" name="student_id" value="{{ old('student_id', $student->student_id) }}"
                    class="w-full" placeholder="Ex: 2137981" required/>
    
                @error("student_id")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div class="col-span-1">
                <label for="sige" class="block text-sm sm:text-base font-medium mb-2">
                    Nº do SIGE do Aluno: <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="sige" type="text" name="sige" value="{{ old('sige', $student->sige) }}"
                    class="w-full" placeholder="Ex: nºsige 21372" required/>

                @error("sige")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-x-2 gap-y-3 mb-3">
            <div>
                <label for="grade_school" class="block text-sm sm:text-base font-medium mb-2">
                    Série: (*opcional)
                </label>
                <x-form.input id="grade_school" type="text" name="grade_school"
                    value="{{ old('grade_school', $student->grade_school) }}" class="w-full"
                    placeholder="Ex: 2º ano Fundamental" />

                @error("grade_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>

            <div>
                <label for="turn_school" class="block text-sm sm:text-base font-medium mb-2">
                    Turno do Aluno na Escola: (*opcional)
                </label>
                <x-form.select idSelect="turn_school" valueName="turn_school" full notRequired>
                    <option value=""> Turno: </option>

                    <option value="Manhã" {{ old('turn_school', $student->turn_school) == 'Manhã' ? 'selected' : '' }}>
                        Manhã
                    </option>
                    <option value="Tarde" {{ old('turn_school', $student->turn_school) == 'Tarde' ? 'selected' : '' }}>
                        Tarde
                    </option>
                </x-form.select>
                @error("turn_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-3">
            <div class="col-span-1">
                <label for="service" class="block text-sm sm:text-base font-medium mb-2">
                    Qual o serviço realizado na Apae ? <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <x-form.input id="service" type="text" name="service" value="{{ old('service', $student->service) }}" class="w-full"
                    placeholder="Ex: AEE" required/>
    
                @error("service")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <label for="professors_service" class="block text-sm sm:text-base font-medium mb-2">
                    Professores Responsáveis pelos Atendimentos <span class="text-red-700 dark:text-red-500">*</span>
                </label>
                <select id="professors_service" name="professors_service[]" multiple required
                    class="student-form-multiple-select">

                    @foreach ($professors as $professor) 
                        <option value="{{ $professor->id }}" 
                            {{ in_array($professor->id, old('professors_service', $student->professors->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                            {{ $professor->name }}
                        </option>
                    @endforeach
                </select>
                @error("professors_service")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        @if ($student->state_student === 'archived')
            <div class="mb-3 mt-3">
                <label for="archiving_justify" class="block text-sm sm:text-base font-medium mb-2">
                    Motivo de Desligamento:
                </label>

                <x-form.textarea id="archiving_justify" name="archiving_justify" class="w-full" sizeFont="base"
                    placeholder="Ex: Aluno saiu da Apae e ...">
                    {{old('archiving_justify', $student->archiving_justify)}}
                </x-form.textarea>

                @error("image")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        @endif

        <div class="mb-3 mt-3">
            <p class="block text-sm sm:text-base font-medium mb-2">
                Foto do Aluno: (*opcional)
            </p>
            <div class="flex flex-col sm:flex-row gap-2">
                <div class="flex">
                    <x-form.button-image />

                    <input id="file-upload" type="file" name="image" value="{{ old("image", $student->image) }}"
                        class="hidden" onchange="updateImageLabel(event) updateImagePreview(event)">
                </div>

                <div class="flex items-center">
                    <p id="label-image" class="text-sm sm:text-base truncate">
                        Nenhuma Nova Imagem Selecionada
                    </p>
                </div>
            </div>

            @error("image")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>


    </x-table-edit>

    </div>

</x-app-layout>


<style>
    /* =========================================================
       FORMULÁRIO DE ALUNO (CRIAR / EDITAR)
       MESMO PADRÃO VISUAL DA PÁGINA DE ANAMNESE
       (com suporte correto ao tema claro/escuro)
       ========================================================= */

    .student-form-page {
        /* -------- tema claro (padrão) -------- */
        --siapae-green: #3B7D5A;
        --siapae-green-dark: #2F684A;
        --siapae-green-soft: #EDF5F0;
        --siapae-text: #102A43;
        --siapae-secondary: #66788A;
        --siapae-border: #E1E7EC;
        --siapae-input-border: #D7DEE5;
        --siapae-card-bg: #FFFFFF;
        --siapae-input-bg: #FFFFFF;
        --siapae-error: #BA4D38;
        --siapae-error-bg: #FFF7EF;
        --siapae-error-border: #F1D3BC;
        --siapae-shadow: rgba(39, 67, 54, 0.06);
    }

    /* -------- tema escuro: usa as mesmas cores do restante do painel -------- */
    .dark .student-form-page {
        --siapae-green: #4CA57A;
        --siapae-green-dark: #3E8C67;
        --siapae-green-soft: #17301F;
        --siapae-text: #E5EAE7;
        --siapae-secondary: #9CB0A6;
        --siapae-border: #24382C;
        --siapae-input-border: #2A4433;
        --siapae-card-bg: #16241B;
        --siapae-input-bg: #10251A;
        --siapae-error: #E08A6E;
        --siapae-error-bg: #2A1D17;
        --siapae-error-border: #4A2F22;
        --siapae-shadow: rgba(0, 0, 0, 0.35);
    }


    /* =========================================================
       CARD / FUNDO
       ========================================================= */

    .student-form-page .bg-white {
        background-color: var(--siapae-card-bg) !important;
    }

    .student-form-page .border-gray-200,
    .student-form-page .border-gray-300,
    .student-form-page .border-gray-400 {
        border-color: var(--siapae-border) !important;
    }

    .student-form-page .shadow,
    .student-form-page .shadow-sm,
    .student-form-page .shadow-md {
        box-shadow: 0 8px 24px var(--siapae-shadow) !important;
    }

    .student-form-page .rounded-md,
    .student-form-page .rounded-lg,
    .student-form-page .rounded-xl,
    .student-form-page .rounded-2xl {
        border-radius: 10px !important;
    }


    /* =========================================================
       TÍTULOS
       ========================================================= */

    .student-form-page h1,
    .student-form-page h2,
    .student-form-page h3 {
        color: var(--siapae-text) !important;
    }


    /* =========================================================
       LABELS (tipografia padronizada com o resto do sistema)
       ========================================================= */

    .student-form-page label,
    .student-form-page p.block {
        color: var(--siapae-text) !important;
        font-size: 14px !important;
        line-height: 1.35 !important;
    }


    /* =========================================================
       CAMPOS DE TEXTO
       ========================================================= */

    .student-form-page input:not([type="hidden"]):not([type="file"]):not([type="checkbox"]):not([type="radio"]),
    .student-form-page select,
    .student-form-page textarea {
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
        border: 1px solid var(--siapae-input-border) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        outline: none !important;
        font-size: 14px !important;
        transition:
            border-color .18s ease,
            box-shadow .18s ease,
            background-color .18s ease;
    }

    /* Hover */
    .student-form-page input:not([type="hidden"]):not([type="file"]):not([type="checkbox"]):not([type="radio"]):hover,
    .student-form-page select:hover,
    .student-form-page textarea:hover {
        border-color: var(--siapae-green) !important;
    }

    /* Focus */
    .student-form-page input:not([type="hidden"]):not([type="file"]):not([type="checkbox"]):not([type="radio"]):focus,
    .student-form-page select:focus,
    .student-form-page textarea:focus {
        border-color: var(--siapae-green) !important;
        box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        outline: none !important;
    }

    /* Placeholder */
    .student-form-page input::placeholder,
    .student-form-page textarea::placeholder {
        color: var(--siapae-secondary) !important;
        opacity: 1 !important;
    }


    /* =========================================================
       SELECT DOS PROFESSORES
       ========================================================= */

    .student-form-page .student-form-multiple-select {
        width: 100% !important;
        min-height: 42px !important;
        padding: 8px !important;
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
        border: 1px solid var(--siapae-input-border) !important;
        border-radius: 9px !important;
        box-shadow: none !important;
        font-size: 14px !important;
    }

    .student-form-page .student-form-multiple-select option {
        background-color: var(--siapae-input-bg) !important;
        color: var(--siapae-text) !important;
    }

    .student-form-page .student-form-multiple-select:focus {
        border-color: var(--siapae-green) !important;
        box-shadow: 0 0 0 3px rgba(59, 125, 90, 0.10) !important;
        outline: none !important;
    }


    /* =========================================================
       CHECKBOXES
       ========================================================= */

    .student-form-page input[type="checkbox"],
    .student-form-page input[type="radio"] {
        accent-color: var(--siapae-green) !important;
    }


    /* =========================================================
       BOTÕES
       ========================================================= */

    .student-form-page .bg-blue-500,
    .student-form-page .bg-blue-600,
    .student-form-page .bg-blue-700 {
        background-color: var(--siapae-green) !important;
        background-image: none !important;
        border-color: var(--siapae-green) !important;
        color: #ffffff !important;
    }

    .student-form-page .bg-blue-500:hover,
    .student-form-page .bg-blue-600:hover,
    .student-form-page .bg-blue-700:hover {
        background-color: var(--siapae-green-dark) !important;
        border-color: var(--siapae-green-dark) !important;
        color: #ffffff !important;
    }

    .student-form-page button:hover,
    .student-form-page a:hover {
        transition: all .18s ease;
    }


    /* =========================================================
       TEXTO DA FOTO
       ========================================================= */

    .student-form-page #label-image {
        color: var(--siapae-secondary) !important;
    }


    /* =========================================================
       MENSAGENS DE ERRO
       ========================================================= */

    .student-form-page .text-red-600,
    .student-form-page .text-red-400 {
        color: var(--siapae-error) !important;
    }

    .student-form-page #errorMessage {
        display: none;
        color: var(--siapae-error) !important;
        background-color: var(--siapae-error-bg) !important;
        border: 1px solid var(--siapae-error-border) !important;
        border-radius: 9px !important;
        padding: 8px 10px !important;
        margin-top: 6px;
    }


    /* =========================================================
       RESPONSIVIDADE
       ========================================================= */

    @media (max-width: 640px) {
        .student-form-page input:not([type="hidden"]):not([type="file"]):not([type="checkbox"]):not([type="radio"]),
        .student-form-page select,
        .student-form-page textarea {
            min-height: 40px !important;
        }
    }
</style>