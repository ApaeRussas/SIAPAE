<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Donation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        // context não funciona aqui
        $context = 'donation';
        
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $allDonations = Donation::where('year_of_donation', $year)
                ->with('student')
                ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de students
                ->select('donations.*', 'students.name')
                ->orderBy('students.name', 'asc')
                ->get();
        } else {  
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $allDonations = Donation::where('year_of_donation', $year)
                ->with('student')
                ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de students
                ->select('donations.*', 'students.name')
                ->orderBy('students.name', 'asc')
                ->get();
        }

        $valueTotal = 0.00;
 
        foreach ($allDonations as $donation) {
            $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
            $totalByDonation = 0.00;
            
            foreach ($months as $month) {
                if (isset($donation->{$month})) {
                    $value = $donation->{$month};

                    // Processa os valores caso contenham '/ '
                    if (str_contains($value, '/ ')) {
                        list($etc, $monthValue) = explode('/ ', $value);
                        $monthValue = (float) str_replace(',', '.', $monthValue);
                    } else {
                        $monthValue = (float) str_replace(',', '.', $value);
                    }
                    $valueTotal += $monthValue;
                    $totalByDonation += $monthValue;
                }
            }
            
            $donation->Total = str_replace('.', ',', $totalByDonation);
        }

        // Paginação
        $page = request('page', 1); 
        $perPage = 15; 
        $donations = new LengthAwarePaginator(
            $allDonations->forPage($page, $perPage), 
            $allDonations->count(),                 
            $perPage,                             
            $page,
            ['path' => request()->url(), 'query' => request()->query()] // URL correta para os links de paginação
        );

        // Formatação do valor total para exibição
        $valueTotal = number_format($valueTotal, 2, ',', '.');

        // Obtém os anos disponíveis para o select
        $years = Donation::selectRaw('year_of_donation as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');

        return view('donationD.home', compact('donations', 'allDonations', 'valueTotal', 'years', 'year', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('errors.404');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'preco' => 'nullable|numeric|max:6',
            'field' => 'required|string|max:6',
        ]);

        $donation = Donation::findOrFail($id);

        if (!$donation) {
            return response()->json(['message' => 'Doação não encontrada.'], 404);
        }

        //Convert 'price'
        $preco = $request->value;
        if ($preco == '') { 
            $preco = null;
        }
        // Atualizar o campo específico
        $donation->{$request->field} = $preco;

        $input = $donation->update();
        if ($input) {
            session()->flash('success', 'Doação atualizada com sucesso!');
            return redirect()->route('donationD.index');
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('donationD.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        //
    }
    public function generatePdf(Request $request) 
    {
        $data = json_decode($request->donations);
        if(!$data || count($data) === 0) {
            return redirect()->back()->with('pdf_error', 'Sem Doações nesse ano para gerar um PDF');
        }     

        $users = User::all();

        // list($year, $month, $day) = explode('-', $data->date);

        $html = view('export.donationPdf', compact('data', 'users'))->render();

        // Adiciona o CSS diretamente no HTML
        $css = file_get_contents(public_path('css/exportDonation.css'));
        $html = str_replace('</head>', '<style>' . $css . '</style></head>', $html);

        // Gera o PDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
