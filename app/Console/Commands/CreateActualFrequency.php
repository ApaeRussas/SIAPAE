<?php

namespace App\Console\Commands;

use App\Models\Frequency;
use App\Models\Student;
use Illuminate\Console\Command;

class CreateActualFrequency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-actual-frequency {month/year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria uma frequência para cada aluno no mês e ano atual (caso o indivíduo não coloque o mês/ano na direita do código ex: 12/2024)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::all();

        $monthYear = $this->argument('month/year') ?? null;

        foreach ($students as $student) {

            if ($monthYear) {
                //Se for passado um valor para a variável e ele for válido, rode o código normalmente
                if (!$this->isValidMonthYear($monthYear)) { 
                    $this->error("{$monthYear} não é um mês/ano válido. Coloque um valor de mês entre 1 a 12 e ano de 0001 a 9999. (ex: 10/2024)"); 
                    return; // Para a execução do comando 
                }
            } else {
                //Se não for passado um valor, rode com o mês e ano atuais
                $monthYear = \Carbon\Carbon::now()->format('m/Y');
            }

            $frequencyExist = Frequency::where('student_id', $student->id)
                ->where('month_year', $monthYear)
                ->exists();

            //Caso a frequência não exista
            if (!$frequencyExist) {
                if($student['state_student'] == 'alive') {
                    Frequency::create([
                        'student_id' => $student->id,
                        'class_apae' => $student->class_apae,
                        'turn_apae' => $student->turn_apae,
                        'month_year' => $monthYear,
                    ]);
                    $this->info("Frequência criada para o aluno {$student->name} no ano {$monthYear}.");
                } else { 
                    $this->info("Frequência não criada para o Aluno {$student->name} por estar na Lixeira.");
                }
            } else {
                $this->info("O aluno {$student->name} já tem uma Frequência para o ano {$monthYear}.");
            }
        }
    }
    private function isValidMonthYear($monthYear) { 
        // Verifica se o formato é m/Y 
        if (preg_match('/^(0[1-9]|1[0-2])\/\d{4}$/', $monthYear)) { 
            // Tenta criar uma data Carbon com o mês e ano 
            try { 
                $date = \Carbon\Carbon::createFromFormat('m/Y', $monthYear); 
                // Verifica se a data é válida (Carbon trata a data inválida como exceção) 
                return $date && $date->format('m/Y') === $monthYear; 
            } 
            catch (\Exception $e) { 
                return false; 
            } 
        } 
        return false; 
    }
}
