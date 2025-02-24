<?php

namespace App\Console\Commands;

use App\Models\Donation;
use App\Models\Student;
use Illuminate\Console\Command;

class DeleteDonation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-donation {year}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleta a tabela de doação de um ano específico pré digitado. Ex: php artisan app:delete-donation 2025 -> Irá deletar a tabela de doações do ano de 2025';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $students = Student::all();

        $year = $this->argument('year') ?? null;

        //Verifica se o valor passado é válido
        if(!$this->isValidYear($year)) {
            $this->error("{$year} não é um ano válido. Coloque um valor numérico entre 1900 e 2500");
            return; //Para a execução do comando
        }

        foreach ($students as $student) {

            $donationExist = Donation::where('student_id', $student->id)
                ->where('year_of_donation', $year)
                ->exists();

            if ($donationExist) {
                $donation = Donation::where('student_id', $student->id)
                ->where('year_of_donation', $year)
                ->first();
                Donation::destroy($donation->id); // Delete a instância da doação
                $this->info("Lista de Doação deletada para o Aluno {$student->name} no ano {$year}.");
            } else {
                $this->info("O Aluno {$student->name} não tem uma Lista de Doação a ser apagada para o ano {$year}.");
            }

        }
    }
    private function isValidYear($year) { 
        return is_numeric($year) && $year >= 1900 && $year <= 2500; 
    }
}
