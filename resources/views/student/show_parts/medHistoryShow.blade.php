<!-- Alvo para rolagem --> <div class="scroll-target"></div>
<x-app-layout notRegularSidebar :element="$student">

    <x-medHistory.showLayout :medHistory="$medHistory" notButtonBack routesNotCommomEditDelete/>

</x-app-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        let currentStep = 0;
        const steps = $(".form-step");

        function updateStepIndicator() {
            $(".current-step").text(currentStep + 1);
            $(".total-steps").text(steps.length);
            $(".prev-step").toggle(currentStep > 0);
        }

        function scrollToSelector() {
            const element = document.querySelector(".scroll-target");
            element.scrollIntoView({
                behavior: 'smooth'
            });
        }

        steps.eq(currentStep).show();
        updateStepIndicator();

        $(".next-step").on("click", function () {
            steps.eq(currentStep).hide();
            currentStep++;
            steps.eq(currentStep).show();
            updateStepIndicator();
            scrollToSelector();
        });
        $(".prev-step").on("click", function () {
            steps.eq(currentStep).hide();
            currentStep--;
            steps.eq(currentStep).show();
            updateStepIndicator();
            scrollToSelector();
        });


        $('#student_id').change(function () {
            var studentId = $(this).val();
            if (studentId) {
                $.ajax({
                    url: '/studentapi/' + studentId,
                    type: 'GET',
                    success: function (data) {
                        $('#date_of_birth').val(data.date_of_birth || '------');
                        $('#diagnostic').val(data.diagnostic || '------');
                        $('#school').val(data.school || '------');
                        $('#grade_school').val(data.grade_school || '------');
                        $('#sige').val(data.sige || '------');
                        $('#turn_school').val(data.turn_school || '------');
                    }
                });
            } else {
                // Limpa os campos se nenhum estudante estiver selecionado 
                $('#date_of_birth').val('');
                $('#diagnostic').val('');
                $('#school').val('');
                $('#grade_school').val('');
                $('#sige').val('');
                $('#turn_school').val('');
            }
        });

    });
</script>
