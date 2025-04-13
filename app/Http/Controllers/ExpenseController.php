<?php

namespace App\Http\Controllers;

use App\Events\CrudUpdated;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Expense;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Ramsey\Uuid\Type\Decimal;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        session(['previous_url' => url()->full()]);
        $context = 'expense';
        
        $year = request('year');

        // Se o ano for fornecido, filtra os gastos por year
        if ($year) {
            $allExpenses = Expense::whereYear('date_of_emission', $year)
            ->orderBy('date_of_emission', 'desc')
            ->get();
        } else {
            // Caso contrário, pega todos os gastos com o ano atual
            $year = \Carbon\Carbon::now()->year;
            $allExpenses = Expense::whereYear('date_of_emission', $year)
            ->orderBy('date_of_emission', 'desc')
            ->get();
        }

        $quant_expenses = count($allExpenses);
        $valueTotal = 0;
        for ($i = 0; $i < $quant_expenses; $i++) {
            $valueTotal += $allExpenses[$i]->price; 
        }
        $valueTotal = number_format($valueTotal, 2, ',', '.');

        // Paginação
        $page = request('page', 1); 
        $perPage = 15; 
        $expenses = new LengthAwarePaginator(
            $allExpenses->forPage($page, $perPage), 
            $quant_expenses,                 
            $perPage,                             
            $page,
            ['path' => request()->url(), 'query' => request()->query()] // URL correta para os links de paginação
        );

        // Obtém os anos disponíveis para o select
        $years = Expense::selectRaw('YEAR(date_of_emission) as year')
            ->distinct()
            ->orderByDesc('year')->pluck('year', 'year');
        
        return view('expense.home', compact('expenses', 'allExpenses', 'valueTotal', 'years', 'year', 'context'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("expense.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // Convert 'string' to data
        $data['date_of_emission'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_emission'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date_of_emission']);
        $year = $carbonDate->year;  
        
        //Colocar para valores nulos dependendo do tipo
        if($data['type'] == "Nota Fiscal") {
            $data['cupom_number'] = null;
            $data['description'] = null;
        } elseif ($data['type'] == "Cupom Fiscal") {
            $data['fiscal_number'] = null;
            $data['description'] = null;
        } else {
            $data['fiscal_number'] = null;
            $data['cupom_number'] = null;
            $data['enterprise'] = null;
        }

        //Convert 'price'
        $preco = $data['price'];
        $precoDecimal = preg_replace('/\D/', '', $preco);  // Remove qualquer caractere não numérico (incluindo simbolos de moeda);
        $precoDecimal = substr($precoDecimal, 0, strlen($precoDecimal) - 2) . '.' . substr($precoDecimal, -2);  // Cria um valor com ponto decimal

        // Agora converte para float
        $data['price'] = (float) $precoDecimal;

        $data = Expense::create($data);
        if ($data) {
            session()->flash('success','Gasto adicionado com sucesso');
            broadcast(new CrudUpdated('created',  'expense'))->toOthers();
            return redirect()->route('expense.index', compact('year'));
        } else {
            session()->flash('error','Falha na criação do Gasto');
            return redirect()->route('expense.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $expense = Expense::findOrFail($id);
        return view("expense.show", compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        //Formatando a data que está em Y/m/d para d/m/Y, pois estou usando um input type text pra data
        $expense['date_of_emission'] = \Carbon\Carbon::createFromFormat('Y-m-d', $expense['date_of_emission'])->format('d/m/Y');
        
        return view('expense.edit', compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, $id)
    {
        $data = $request->validated();
        // Formatando a data que está em Y-m-d para d/m/Y
        $data['date_of_emission'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['date_of_emission'])->format('Y-m-d');
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date_of_emission']);
        $year = $carbonDate->year; 
        
        //Convert 'price'
        $preco = $data['price'];
        $precoDecimal = preg_replace('/\D/', '', $preco);  // Remove qualquer caractere não numérico (incluindo simbolos de moeda);
        $precoDecimal = substr($precoDecimal, 0, strlen($precoDecimal) - 2) . '.' . substr($precoDecimal, -2);  // Cria um valor com ponto decimal

        // Agora converte para float
        $data['price'] = (float) $precoDecimal;

        $expense = Expense::findOrFail($id);

        $input = $expense->update($data);
        if ($input) {
            session()->flash('success', 'Gasto atualizado com sucesso!');
            broadcast(new CrudUpdated('updated',  'expense'))->toOthers();
            return redirect()->route('expense.index', compact('year'));
        } else {
            session()->flash('error','Falha na edição do Gasto');
            return redirect()->route('expense.edit');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Expense::findOrFail($id);
        //Para a data criada seja aquela que vai aparecer no .index
        $carbonDate = \Carbon\Carbon::parse($data['date_of_emission']);
        $year = $carbonDate->year; 

        $input = Expense::destroy($id);
        if ($input) {
            session()->flash('success', 'Gasto excluído com sucesso!');
            broadcast(new CrudUpdated('deleted',  'expense'))->toOthers();
            return redirect()->route('expense.index', compact('year'));
        } else {
            session()->flash('error', 'Erro na exclusão do Gasto');
            return redirect()->route('expense.index');
        }
    }
}
