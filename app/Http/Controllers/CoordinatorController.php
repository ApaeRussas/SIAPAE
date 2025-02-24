<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CoordinatorController extends Controller
{
    public function index(Request $request): View
    {
        $search = request('search');
        
        if ($search) {
            $users = User::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_user', 'alive')
            ->where('position', '!=', '---')
            ->orderBy('access_level', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $users = User::where('state_user', 'alive')
            ->where('position', '!=', '---')
            ->orderBy('access_level', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('coordinator.index', compact('users', 'search'));
    }

    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:125'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:125', 'unique:'.User::class],
            'password' => ['required', 'string','max:125'],
            'position' => ['required', 'string', 'max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'access_level' => 'user',
        ]);

        event(new Registered($user));

        // return redirect(route('coordinator.index', absolute: false));
        if ($user) {
            session()->flash('success', 'Usuário adicionado com sucesso!');
            return redirect()->route('coordinator.index');
        } else {
            session()->flash('error', 'Falha na edição do Usuário');
            return redirect()->route('coordinator.edit');
        }
    }
    public function show($id) 
    {
        $user = User::find($id);

        $isArchived = null;
        if($user['state_user'] == 'archived') {
            $isArchived = true; 
        }

        $date_range = request('date_range'); 
        $scrollBack = null;

        if ($date_range) { 
            $dates = explode(' à ', $date_range); 
            $start_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[0]))->format('Y-m-d'); 
            $end_date = \Carbon\Carbon::createFromFormat('d/m/Y', trim($dates[1]))->format('Y-m-d'); 
            
            $attendances = Attendance::join('users', 'attendances.signature_id', '=', 'users.id')
                ->select('attendances.*', 'users.name as user_name')
                ->whereDate('date', '>=', $start_date)
                ->whereDate('date', '<=', $end_date) 
                ->where('users.name', $user->name)
                ->with('student', 'professor')
                ->orderBy('date', 'desc') 
                ->paginate(15); 

            $scrollBack = true;
        } else { 
            $attendances = Attendance::join('users', 'attendances.signature_id', '=', 'users.id')
            ->select('attendances.*', 'users.name as user_name')
            ->where('users.name', $user->name)
            ->with('student', 'professor')
            ->orderBy('date', 'desc') 
            ->paginate(15); 
        }

        return view('coordinator.show', compact('user', 'date_range', 'scrollBack', 'attendances', 'isArchived'));
    }
    public function archive($id)
    {
        $user = User::findOrFail($id);

        $user['state_user'] = 'archived';

        $input = $user->save();

        if ($input) {
            session()->flash('success', 'Usuário arquivado com sucesso!');
            return redirect()->route('coordinator.index');
        } else {
            session()->flash('error', 'Erro na arquivação do Usuário');
            return redirect()->route('coordinator.index');
        }
    }
    public function deposit()
    {
        $search = request('search');
        
        if ($search) {
            $users = User::where([
                ['name', 'like', '%' . $search . '%']
            ])->where('state_user', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        } else {
            $users = User::where('state_user', 'archived')
            ->orderBy('name', 'asc')
            ->paginate(15);
        }

        return view('coordinator.deposit', compact('users', 'search'));
    }
    public function restore($id) 
    {
        $user = User::find($id);

        $user['state_user'] = 'alive';

        $input = $user->save();

        if ($input) {
            session()->flash('success', 'Usuário Restaurado com sucesso!');
            return redirect()->route('coordinator.deposit');
        } else {
            session()->flash('error', 'Erro na restauração do Usuário');
            return redirect()->route('coordinator.deposit');
        }
    }
    /**
     * Display the user's profile form in view coordinator
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('coordinator.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        $request->validate([
            'name' => ['required', 'string', 'max:125'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:125', Rule::unique('users')->ignore($user->id)],
            'position' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string','max:125']
        ]);

        $userUpdate = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        // return redirect(route('coordinator.index', absolute: false));
        if ($userUpdate) {
            session()->flash('success', 'Usuário atualizado com sucesso!');
            return redirect()->route('coordinator.index');
        } else {
            session()->flash('error', 'Falha na atualização do Usuário');
            return redirect()->route('coordinator.edit');
        }
    }
    public function destroy($id)
    {
        $input = User::destroy($id);

        if ($input) {
            session()->flash('success', 'Usuário excluído com sucesso!');
            return redirect()->route('coordinator.deposit');
        } else {
            session()->flash('error', 'Erro na exclusão do Usuário');
            return redirect()->route('coordinator.deposit');
        }
    }
}
