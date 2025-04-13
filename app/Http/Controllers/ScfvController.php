<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\User;
use App\Models\Scfv;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScfvRequest;
use Illuminate\Http\Request;

class ScfvController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        $context = 'scfv';
        
        $date_range = request('date_range'); 

        if ($date_range) { 
            $dates = explode(' à ', $date_range); 
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'); 
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'); 
            
            $scfvs = Scfv::whereDate('date_scfv', '>=', $start_date)
                ->whereDate('date_scfv', '<=', $end_date) 
                ->with('professor')
                ->orderBy('date_scfv', 'desc') 
                ->paginate(15)->appends(request()->query()); 
        } else { 
            $scfvs = Scfv::orderBy('date_scfv', 'desc')
                ->with('professor')
                ->paginate(15)->appends(request()->query());
        }

        return view('scfv.home', compact('scfvs', 'date_range', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professors = User::orderBy('name', 'asc')
        ->where('position', 'Professor(a)')
        ->where('state_user', 'alive')
        ->get();
        
        return view('scfv.create', compact('professors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScfvRequest $request)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['1Q_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['1Q_date'])->format('Y-m-d');
        $data['2Q_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['2Q_date'])->format('Y-m-d');
        $data['date_scfv'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_scfv'])->format('Y-m-d');
        
        $data = Scfv::create($data);
        if ($data) {
            session()->flash('success','SCFV adicionado com sucesso');
            broadcast(new CrudUpdated('created',  'scfv'))->toOthers();
            return redirect()->route('scfv.index');
        } else {
            session()->flash('error','Falha na criação');
            return redirect()->route('scfv.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $scfv = Scfv::with('professor')->findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $scfv['1Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['1Q_date'])->format('d/m/Y');
        $scfv['2Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['2Q_date'])->format('d/m/Y');
        $scfv['date_scfv'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['date_scfv'])->format('d/m/Y');

        return view('scfv.show', compact('scfv'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $scfv = Scfv::findOrFail($id);
        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $scfv['1Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['1Q_date'])->format('d/m/Y');
        $scfv['2Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['2Q_date'])->format('d/m/Y');
        $scfv['date_scfv'] = \Carbon\Carbon::createFromFormat('Y-m-d', $scfv['date_scfv'])->format('d/m/Y');

        $professors = User::orderBy('name', 'asc')
        ->where('position', 'Professor(a)')
        ->where('state_user', 'alive')
        ->get();
        
        return view('scfv.edit', compact('scfv', 'professors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScfvRequest $request, $id)
    {
        $data = $request->validated();
        // Convert 'string' to data
        $data['1Q_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['1Q_date'])->format('Y-m-d');
        $data['2Q_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['2Q_date'])->format('Y-m-d');
        $data['date_scfv'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_scfv'])->format('Y-m-d');
        
        $scfv = Scfv::findOrFail($id);

        $input = $scfv->update($data);
        if ($input) {
            session()->flash('success','SCFV atualizado com sucesso');
            broadcast(new CrudUpdated( 'updated',  'scfv'))->toOthers();
            return redirect()->route('scfv.index');
        } else {
            session()->flash('error','Falha na atualização');
            return redirect()->route('scfv.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $input = Scfv::destroy($id);
        if ($input) {
            session()->flash('success', 'SCFV excluído com sucesso!');
            broadcast(new CrudUpdated('deleted',  'scfv'))->toOthers();
            return redirect()->route('scfv.index');
        } else {
            session()->flash('error', 'Erro na exclusão do SCFV');
            return redirect()->route('scfv.index');
        }
    }
    public function generatePdf($id) 
    {
        $data = Scfv::with('professor')->findOrFail($id);

        // Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $data['1Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['1Q_date'])->format('d/m/Y');
        $data['2Q_date'] = \Carbon\Carbon::createFromFormat('Y-m-d', $data['2Q_date'])->format('d/m/Y');

        list($year, $month, $day) = explode('-', $data->date_scfv);
        $data->nameMonth = $this->getMonthName((int) $month);
        $data->year = $year;

        $alunos = explode("\n", $data->students_frequency);
        sort($alunos);
        foreach ($alunos as &$aluno) {
            if (strlen($aluno) > 40) {
                $aluno = substr($aluno, 0, 40) . '...';
            }    
        }
        $data->students_frequency = implode("\n", $alunos);

        $html = view('export.scfvPdf', compact('data'))->render();

        // Adiciona o CSS diretamente no HTML
        $css = file_get_contents(public_path('css/exportScfv.css'));
        $html = str_replace('</head>', '<style>' . $css . '</style></head>', $html);

        // Gera o PDF
        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'landscape');

        // $filename = 'SCFV - ' .  $data->number_period . ' Semestre - ' . $data->year . '.pdf';
        // return $pdf->download($filename);
        return $pdf->stream();
    } 

    public function getMonthName($monthNumber)
    {
    $months = [
        1 => 'Janeiro',
        2 => 'Fevereiro',
        3 => 'Março',
        4 => 'Abril',
        5 => 'Maio',
        6 => 'Junho',
        7 => 'Julho',
        8 => 'Agosto',
        9 => 'Setembro',
        10 => 'Outubro',
        11 => 'Novembro',
        12 => 'Dezembro',
    ];

    return $months[$monthNumber] ?? 'Mês inválido';
    }
}
