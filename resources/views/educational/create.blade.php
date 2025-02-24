<x-app-layout> 

    <x-table-create
        title="Relatório Pedagógico"
        onlyHead
        actionRoute="educational">
    
        <div class="my-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-2">
                <x-form.label for="student_id"> Nome do Estudante para o Relatório <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.select idSelect="student_id" valueName="student_id" full>
                    <option value="">Nome:</option>
    
                    @foreach ($students as $student)
                        <option value="{{$student->id}}" {{old('student_id') == $student->id ? 'selected' : ''}}>
                            {{$student->name}}
                        </option>
                    @endforeach
                </x-form.select>
            </div> 
            <div class="col-span-1">
                <x-form.label for="date_pedagogical">Data do Relatório <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="date_pedagogical" name="date_pedagogical" class="date dateInput dark:text-gray-400 w-full sm-w-auto" required x-init="initFlatpickr" autocomplete="off"
                value="{{old('date_pedagogical', \Carbon\Carbon::now()->format('d/m/Y'))}}" placeholder="Ex: 01/01/2001"/>
                @error("date_pedagogical")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
                <span id="errorMessage" style="color: red; display: none;">
                    Data inválida. Insira uma data entre 1960 e 2200.
                </span>
            </div>
            <div class="col=span-1">
                <x-form.label for="period"> Semestre do Aluno <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.select idSelect="period" valueName="period" full>
                    <option value="">Semestre:</option>
    
                    <option value="1º" {{old('period') == '1º' ? 'selected' : ''}}>
                        1º
                    </option>
                    <option value="2º" {{old('period') == '2º' ? 'selected' : ''}}>
                        2º
                    </option>
                </x-form.select>
                @error("professor_signature")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1 sm:col-span-2">
                <x-form.label for="school"> Escola que estuda <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="school" name="school" value="{{old('school')}}" class="w-full dark:text-gray-400" required
                placeholder="Ex: E.M Tia Benilce"/>
                @error("school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <x-form.label for="date_of_birth"> Data de Nascimento <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="date_of_birth" name="date_of_birth" readonly class="w-full sm:w-auto dark:text-gray-400" placeholder="Data fixa"/>
            </div>
            <div class="col-span-1">
                <x-form.label for="age"> Idade <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="age" name="age" value="{{old('turn_school')}}" required
                placeholder="Ex: 15 anos" class="w-full sm:w-48 dark:text-gray-400"/>
                @error("age")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 grid grid-cols-1 sm:grid-cols-4 gap-x-4 gap-y-3">
            <div class="col-span-1">
                <x-form.label for="turn_school"> Turno <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="turn_school" name="turn_school" value="{{old('turn_school')}}" required
                placeholder="Ex: Manhã" class="w-full dark:text-gray-400"/>
                @error("age")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <x-form.label for="grade_school"> Série/Ano <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="grade_school" name="grade_school" value="{{old('grade_school')}}" required
                placeholder="Ex: 1°" class="w-full dark:text-gray-400"/>
                @error("grade_school")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
            <div class="col-span-1">
                <x-form.label for="school_year"> Ano Letivo <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
                <x-form.input id="school_year" name="school_year" value="{{old('school_year', \Carbon\Carbon::now()->format('Y'))}}" 
                    required placeholder="Ex: 2024" class="w-full dark:text-gray-400"/>
                @error("school_year")
                    <span class="text-red-600 dark:text-red-400">{{$message}}</span>
                @enderror
            </div>
        </div>

        <div class="mb-3 w-full sm:w-1/2">
            <x-form.label for="professor_signature"> Professor do CAEE <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
            <x-form.select idSelect="professor_signature" valueName="professor_signature" full>
                <option value="">Nome:</option>

                @foreach ($professors as $professor)
                    <option value="{{$professor->name}}" {{old('professor_signature') == $professor->name ? 'selected' : ''}}>
                        {{$professor->name}}
                    </option>
                @endforeach
            </x-form.select>
            @error("professor_signature")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div>
            <x-form.label for="text"> Texto Principal do Relatório <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
            <x-form.textarea id="text" name="text" height="text" sizeFont="base" required placeholder="Texto .........">
                {{old('text')}}
            </x-form.textarea>
            @error("text")
                <span class="text-red-600 dark:text-red-400">{{$message}}</span>
            @enderror
        </div>

        <div class="w-full sm:w-1/2">
            <x-form.label for="signature_id"> Assinatura do Professor Responsável <span class="text-red-700 dark:text-red-500">*</span> </x-form.label>
            <x-form.select idSelect="signature_id" valueName="signature_id" full>
                <option value="">Nome:</option>
                    
                @foreach ($professors as $professor)
                    <option value="{{$professor->id}}" {{old('signature_id', Auth::user()->id) == $professor->id ? 'selected' : ''}}>
                        {{$professor->name}}
                    </option>
                @endforeach
            </x-form.select>
        </div>

    </x-table-create>
 
</x-app-layout> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#student_id').change(function () {
            var studentId = $(this).val();
            if (studentId) {
                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',
                    success: function (data) {
                        $('#date_of_birth').val(data.date_of_birth || '------'); 
                        $('#school').val(data.school || '------'); 
                        $('#grade_school').val(data.grade_school || '------'); 
                        $('#turn_school').val(data.turn_school || '------');
                        $('#age').val(data.age || '------');
                    }
                });
            } else {
                // Limpa os campos se nenhum estudante estiver selecionado 
                $('#date_of_birth').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#turn_school').val('');
                $('#age').val('');
            }
        });
</script>