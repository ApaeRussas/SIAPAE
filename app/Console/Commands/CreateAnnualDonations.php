<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\Student;
use Illuminate\Console\Command;

class CreateAnnualDonations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-annual-donations {year?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar uma nova lista de doação para cada estudante de acordo com o ano atual ou o valor passado depois';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::all();

        $year = $this->argument('year') ?? null;

        foreach ($students as $student) {

            if ($year) {
                //Caso tenha um valor de ano e ele for normal, rode normalmente
                if(!$this->isValidYear($year)) {
                    $this->error("{$year} não é um ano válido. Coloque um valor numérico entre 1900 e 2500");
                    return; //Para a execução do comando
                }
            } else {
                //Caso não haja um valor, pegue o ano atual
                $year = \Carbon\Carbon::now()->year;
            }

            $donationExist = Donation::where('student_id', $student->id)
                ->where('year_of_donation', $year)
                ->exists();

            if (!$donationExist) {
                if($student['state_student'] == 'alive') {
                    Donation::create([
                        'student_id' => $student->id,
                        'year_of_donation' => $year,
                    ]);
                    $this->info("Lista de Doação criada para o Aluno {$student->name} no ano {$year}.");
                } else {    
                    $this->info("Doação não criada para o Aluno {$student->name} por estar na Lixeira.");
                }
            } else {
                $this->info("O Aluno {$student->name} já tem uma Lista de Doação para o ano {$year}.");
            }

        }
    }
    private function isValidYear($year) { 
        return is_numeric($year) && $year >= 1900 && $year <= 2500; 
    }
}
