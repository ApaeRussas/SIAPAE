<?php

namespace App\Http\Controllers;

use App;
use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Regional;
use App\Models\User;
use App\Http\Requests\RegionalRequest;

class RegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        session(['previous_url_secondary' => url()->full()]);
        $context = 'regional';
        
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $regionals = Regional::whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->with('coordinator')
            ->paginate(15)->appends(request()->query());
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $regionals = Regional::whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->with('coordinator')
            ->paginate(15)->appends(request()->query());
        }
        
        // Obtém os anos disponíveis para o select
        $years = Regional::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');
        
        return view('regional.home', compact('regionals', 'years', 'year', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $coordinators = User::orderBy('name', 'asc')
        ->where('position', 'Cordenador(a)')
        ->where('state_user', 'alive')
        ->get();
        return view("regional.create", compact('coordinators'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegionalRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;  
        
        $data = Regional::create($data);
        if ($data) {
            session()->flash('success','Relatório adicionado com sucesso');
            broadcast(new CrudUpdated('created',  'regional'))->toOthers();
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('regional.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        session(['previous_url_secondary' => url()->full()]);
        $regional = Regional::findOrFail($id);
        
        $regional['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $regional['date'])->format('d/m/Y');

        return view('regional.show', compact('regional'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $regional = Regional::findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $regional['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $regional['date'])->format('d/m/Y');

        $coordinators = User::orderBy('name', 'asc')
        ->where('position', 'Cordenador(a)')
        ->where('state_user', 'alive')
        ->get();
        
        return view('regional.edit', compact('regional', 'coordinators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RegionalRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 
        
        $regional = Regional::findOrFail($id);
        
        $input = $regional->update($data);
        if ($input) {
            session()->flash('success', 'Relatório atualizado com sucesso!');
            broadcast(new CrudUpdated('updated',  'regional'))->toOthers();
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error','Falha na edição');
            return redirect()->route('regional.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Regional::findOrFail($id);
        // Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year; 

        $input = Regional::destroy($id);
        if ($input) {
            session()->flash('success', 'Relatório excluído com sucesso!');
            broadcast(new CrudUpdated('deleted',  'regional'))->toOthers();
            return redirect()->route('regional.index', compact('year'));
        } else {
            session()->flash('error', 'Erro na exclusão do Relatório');
            return redirect()->route('regional.index');
        }
    }
    public function generatePdf($id) 
    {
        $data = Regional::with('coordinator')->findOrFail($id);

        list($year, $month, $day) = explode('-', $data->date);
        $data->year = $year;
        if ($month >= 0 && $month <= 7) {
            $data->period = 'PRIMEIRO';
            $data->number_period = '1º';
        } else {
            $data->period = 'SEGUNDO';
            $data->number_period = '2º';
        }

        $html = view('export.regionalPdf', compact('data'))->render();

        // Adiciona o CSS diretamente no HTML
        $css = file_get_contents(public_path('css/export.css'));
        $html = str_replace('</head>', '<style>' . $css . '</style></head>', $html);

        // Gera o PDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        // $filename = 'Relatório Regional - ' .  $data->number_period . ' Semestre - ' . $data->year . '.pdf';
        // return $pdf->download($filename);
        return $pdf->stream();
    }
}
