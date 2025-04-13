<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Record;
use App\Http\Controllers\Controller;
use App\Http\Requests\RecordRequest;

class RecordController extends Controller
{
    public function index()
    {
        session(['previous_url' => url()->full()]);
        $context = 'record';
        
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $records = Record::whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->paginate(15)->appends(request()->query());
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $records = Record::whereYear('date', $year)
            ->orderBy('date', 'desc')
            ->paginate(15)->appends(request()->query());
        }

        // Obtém os anos disponíveis para o select
        $years = Record::selectRaw('YEAR(date) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');

        return view('record.home', compact('records', 'years', 'year', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('record.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecordRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;

        $input = Record::create($data);
        if ($input) {
            session()->flash('success', 'Ata adicionada com sucesso');
            broadcast(new CrudUpdated('created',  'record'))->toOthers();
            return redirect()->route('record.index', compact('year'));
        } else {
            session()->flash('error', 'Falha na criação');
            return redirect()->route('record.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $record = Record::findOrFail($id);
        $record['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $record['date'])->format('d/m/Y');

        return view('record.show', compact('record'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = Record::findOrFail($id);
        $record['date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $record['date'])->format('d/m/Y');
        return view('record.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecordRequest $request, $id)
    {
        $data = $request->validated();

        $record = Record::findOrFail($id);
        $data['date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;

        $input = $record->update($data);
        if ($input) {
            session()->flash('success', 'Ata atualizada com sucesso!');
            broadcast(new CrudUpdated('updated',  'record'))->toOthers();
            return redirect()->route('record.index', compact('year'));
        } else {
            session()->flash('error', 'Falha na edição');
            return redirect()->route('record.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Record::find($id);
        $carbonDate = \Carbon\Carbon::parse($data['date']);
        $year = $carbonDate->year;

        $input = Record::findOrFail($id)->delete();
        if ($input) {
            session()->flash('success', 'Ata excluída com sucesso!');
            broadcast(new CrudUpdated('deleted',  'record'))->toOthers();
            return redirect()->route('record.index', compact('year'));
        } else {
            session()->flash('error', 'Erro na exclusão do item');
            return redirect()->route('record.index');
        }
    }

    public function generatePdf($id) 
    {
        $data = Record::findOrFail($id);

        $html = view('export.ataPdf', compact('data'))->render();

        // Adiciona o CSS diretamente no HTML
        $css = file_get_contents(public_path('css/export.css'));
        $html = str_replace('</head>', '<style>' . $css . '</style></head>', $html);

        // Gera o PDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}
