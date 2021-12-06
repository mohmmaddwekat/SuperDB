<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Rules\CheckNameRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{


    public function index(){
        return view('users.index');
    }
    public function register(){

        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('users.register',$roles_Abilitiles)){
            abort(403);
        }

        return view('users.register',
       [
            'roles' => Role::all(),
       ]);
        
    }
     

    public function store(Request $request){
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if(!in_array('users.store',$roles_Abilitiles)){
            abort(403);
        }
        $request->validate([
            'username' => ['required', 'string', 'max:255','unique:users,username','alpha'],
            'firstname' => ['required', 'string', 'max:40','alpha'],
            'lastname' => ['required', 'string', 'max:40','alpha'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
                ],
            'type' => ['required', 'in:staff,admin,reader'],
            'role_id' => ['required', 'int', 'exists:roles,id'],

        ]);
         User::create([
            'username' => $request->post('username'),
            'fullname' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->post('email'),
            'password' => Hash::make($request->password),
            'type' => $request->post('type'),
            'role_id' => $request->post('role_id') 
        ]);


        return redirect()->route('users.register')->with('success', 'Create new user!');
    }
    
    public function login(){
        return view('users.login');
    }
        /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('dashboard')->with('success', 'Welcome To Super DB!');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('users.index');
    }

}
