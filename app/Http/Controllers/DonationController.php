<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Donation;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Pega o ano passado como parâmetro na requisição
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $donations = Donation::where('year_of_donation', $year)
            ->with('student')
            ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de partners
            ->select('donations.*','students.name')
            ->orderBy('students.name', 'asc')  // Ordenando pelo nome do parceiro
            ->paginate(15);
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $donations = Donation::where('year_of_donation', $year)
            ->with('student')
            ->join('students', 'donations.student_id', '=', 'students.id')  // Realizando o join com a tabela de partners
            ->select('donations.*','students.name')
            ->orderBy('students.name', 'asc')  // Ordenando pelo nome do parceiro
            ->paginate(15);
        }

        $quant_donations = count($donations);
        $valueTotal = 0.00;
        for ($i = 0; $i < $quant_donations; $i++) {
            if(str_contains($donations[$i]->Jan, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jan); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jan); }
            if(str_contains($donations[$i]->Fev, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Fev); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Fev); }
            if(str_contains($donations[$i]->Mar, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Mar); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Mar); }
            if(str_contains($donations[$i]->Abr, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Abr); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Abr); }
            if(str_contains($donations[$i]->Mai, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Mai); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Mai); }
            if(str_contains($donations[$i]->Jun, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jun); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jun); }
            if(str_contains($donations[$i]->Jul, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Jul); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Jul); }
            if(str_contains($donations[$i]->Ago, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Ago); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Ago); }
            if(str_contains($donations[$i]->Set, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Set); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Set); }
            if(str_contains($donations[$i]->Out, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Out); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Out); }
            if(str_contains($donations[$i]->Nov, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Nov); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Nov); }
            if(str_contains($donations[$i]->Dez, '/ ')) { list($etc, $value) = explode('/ ', $donations[$i]->Dez); $valueTotal += (float) str_replace(',', '.', $value);  } else { $valueTotal += (float) str_replace(',', '.', $donations[$i]->Dez); }
        }
        $valueTotal = number_format($valueTotal, 2, ',', '.');

        // Obtém os anos disponíveis para o select
        $years = Donation::selectRaw('year_of_donation as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');

        return view('donationD.home', compact('donations', 'valueTotal', 'years', 'year'));
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
