<?php

namespace App\Console\Commands;

use App\Models\Frequency;
use App\Models\Student;
use Illuminate\Console\Command;

class DeleteFrequency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-frequency {month/year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta a lista de frequência de um mês/ano específico pré digitado. Ex: php artisan app:delete-donation 01/2025 -> Irá deletar a tabela de frequencia dos alunos no mês 1 do ano de 2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::all();

        $monthYear = $this->argument('month/year') ?? null;

        if (!$this->isValidMonthYear($monthYear)) { 
            $this->error("{$monthYear} não é um mês/ano válido. Coloque um valor de mês entre 1 a 12 e ano de 0001 a 9999. (ex: 10/2024)"); 
            return; // Para a execução do comando 
        }

        foreach ($students as $student) {

            $frequencyExist = Frequency::where('student_id', $student->id)
                ->where('month_year', $monthYear)
                ->exists();

            //Caso a frequência exista, delete-a
            if ($frequencyExist) {
                $frequency = Frequency::where('student_id', $student->id)
                ->where('month_year', $monthYear)
                ->first();
                Frequency::destroy($frequency->id);
                $this->info("Frequência deletada para o aluno {$student->name} no mês/ano {$monthYear}.");
            } else {
                $this->info("O aluno {$student->name} não tem uma Frequência a ser apagada para o mês/ano {$monthYear}.");
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
