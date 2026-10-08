<!-- Alvo para rolagem -->
<div class="scroll-target"></div>

<x-app-layout>

    <div class="med-history-archive-action">
        <button
            type="button"
            class="archive-anamnesis-button"
            onclick="confirmArchiveAnamnesis()"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.8"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M20.25 7.5l-.625 10.5a2.25 2.25 0 01-2.245 2.116H6.62a2.25 2.25 0 01-2.245-2.116L3.75 7.5m3 0V5.25A2.25 2.25 0 019 3h6a2.25 2.25 0 012.25 2.25V7.5m-10.5 0h12.5m-8.25 4.5v4.5m3-4.5v4.5"
                />
            </svg>

            <span>Armazenar a Anamnese</span>
        </button>
    </div>

    <x-medHistory.showLayout :medHistory="$medHistory" />

</x-app-layout>

<style>
    .med-history-archive-action {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 0 1.5rem 1rem;
        box-sizing: border-box;
    }

    .archive-anamnesis-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.55rem;
        min-height: 42px;
        padding: 0.65rem 1rem;
        border: 1px solid #2F6B4F !important;
        border-radius: 0.65rem;
        background-color: #2F6B4F !important;
        color: #FFFFFF !important;
        font-size: 0.875rem;
        font-weight: 600;
        line-height: 1;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(47, 107, 79, 0.16);
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.2s ease,
            transform 0.2s ease;
    }

    .archive-anamnesis-button svg {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .archive-anamnesis-button:hover {
        background-color: #1F513A !important;
        border-color: #1F513A !important;
        color: #FFFFFF !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(31, 81, 58, 0.20);
    }

    .archive-anamnesis-button:focus {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(47, 107, 79, 0.18) !important;
    }

    .archive-anamnesis-button:active {
        transform: translateY(0);
    }

    .next-step,
    .prev-step {
        background-color: #2F6B4F !important;
        border-color: #2F6B4F !important;
        color: #FFFFFF !important;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .next-step:hover,
    .prev-step:hover {
        background-color: #1F513A !important;
        border-color: #1F513A !important;
        color: #FFFFFF !important;
    }

    .next-step:focus,
    .prev-step:focus {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(47, 107, 79, 0.18) !important;
    }

    .med-history-action-student {
        background-color: #3B7D5A !important;
        border-color: #3B7D5A !important;
        color: #FFFFFF !important;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .med-history-action-student:hover {
        background-color: #2F684A !important;
        border-color: #2F684A !important;
        color: #FFFFFF !important;
    }

    .med-history-action-edit {
        background-color: #76A98A !important;
        border-color: #76A98A !important;
        color: #FFFFFF !important;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .med-history-action-edit:hover {
        background-color: #5F9174 !important;
        border-color: #5F9174 !important;
        color: #FFFFFF !important;
    }

    .med-history-action-delete {
        background-color: #527A65 !important;
        border-color: #527A65 !important;
        color: #FFFFFF !important;
        transition:
            background-color 0.2s ease,
            border-color 0.2s ease,
            color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .med-history-action-delete:hover {
        background-color: #3E624F !important;
        border-color: #3E624F !important;
        color: #FFFFFF !important;
    }

    .med-history-action-student:focus,
    .med-history-action-edit:focus,
    .med-history-action-delete:focus {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(47, 107, 79, 0.18) !important;
    }

    .dark .archive-anamnesis-button {
        background-color: #3A8060 !important;
        border-color: #3A8060 !important;
        color: #FFFFFF !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.20);
    }

    .dark .archive-anamnesis-button:hover {
        background-color: #4A9A75 !important;
        border-color: #4A9A75 !important;
        color: #FFFFFF !important;
    }

    .dark .archive-anamnesis-button:focus {
        box-shadow: 0 0 0 3px rgba(118, 181, 143, 0.25) !important;
    }

    .dark .next-step,
    .dark .prev-step {
        background-color: #3A8060 !important;
        border-color: #3A8060 !important;
        color: #FFFFFF !important;
    }

    .dark .next-step:hover,
    .dark .prev-step:hover {
        background-color: #4A9A75 !important;
        border-color: #4A9A75 !important;
        color: #FFFFFF !important;
    }

    .dark .next-step:focus,
    .dark .prev-step:focus {
        box-shadow: 0 0 0 3px rgba(118, 181, 143, 0.25) !important;
    }

    .dark .med-history-action-student {
        background-color: #3A8060 !important;
        border-color: #3A8060 !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-student:hover {
        background-color: #4A9A75 !important;
        border-color: #4A9A75 !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-edit {
        background-color: #5F9174 !important;
        border-color: #5F9174 !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-edit:hover {
        background-color: #76A98A !important;
        border-color: #76A98A !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-delete {
        background-color: #527A65 !important;
        border-color: #527A65 !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-delete:hover {
        background-color: #6A957D !important;
        border-color: #6A957D !important;
        color: #FFFFFF !important;
    }

    .dark .med-history-action-student:focus,
    .dark .med-history-action-edit:focus,
    .dark .med-history-action-delete:focus {
        box-shadow: 0 0 0 3px rgba(118, 181, 143, 0.25) !important;
    }

    @media (max-width: 640px) {
        .med-history-archive-action {
            padding: 0 1rem 1rem;
        }

        .archive-anamnesis-button {
            width: 100%;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function confirmArchiveAnamnesis() {
        alert('O botão "Armazenar a Anamnese" foi adicionado. A função de arquivamento ainda precisa ser ligada ao controller.');
    }

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

            if (element) {
                element.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }

        function styleActionButtons() {

            $("button, a").each(function () {

                const element = $(this);

                const text = element.text()
                    .replace(/\s+/g, " ")
                    .trim()
                    .toLowerCase();

                if (
                    text.includes("ir para aluno") ||
                    text.includes("ir para o aluno")
                ) {
                    element.addClass("med-history-action-student");
                }

                if (
                    text === "editar" ||
                    text.includes("editar")
                ) {
                    element.addClass("med-history-action-edit");
                }

                if (
                    text === "deletar" ||
                    text.includes("deletar")
                ) {
                    element.addClass("med-history-action-delete");
                }
            });
        }

        if (steps.length > 0) {
            steps.eq(currentStep).show();
        }

        updateStepIndicator();

        styleActionButtons();

        $(".next-step").on("click", function () {

            if (currentStep < steps.length - 1) {

                steps.eq(currentStep).hide();

                currentStep++;

                steps.eq(currentStep).show();

                updateStepIndicator();

                scrollToSelector();
            }
        });

        $(".prev-step").on("click", function () {

            if (currentStep > 0) {

                steps.eq(currentStep).hide();

                currentStep--;

                steps.eq(currentStep).show();

                updateStepIndicator();

                scrollToSelector();
            }
        });

        $("#student_id").change(function () {

            const studentId = $(this).val();

            if (studentId) {

                $.ajax({
                    url: "/studentapi/" + studentId,
                    type: "GET",

                    success: function (data) {

                        $("#date_of_birth").val(
                            data.date_of_birth || "------"
                        );

                        $("#diagnostic").val(
                            data.diagnostic || "------"
                        );

                        $("#school").val(
                            data.school || "------"
                        );

                        $("#grade_school").val(
                            data.grade_school || "------"
                        );

                        $("#sige").val(
                            data.sige || "------"
                        );

                        $("#turn_school").val(
                            data.turn_school || "------"
                        );
                    }
                });

            } else {

                $("#date_of_birth").val("");
                $("#diagnostic").val("");
                $("#school").val("");
                $("#grade_school").val("");
                $("#sige").val("");
                $("#turn_school").val("");
            }
        });
    });
</script>