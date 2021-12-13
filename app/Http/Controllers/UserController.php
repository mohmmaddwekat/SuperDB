<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Rules\CheckNameRule;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Log;
use App\Exceptions\ErrorHandlerMsg;


class UserController extends Controller
{

    public function index()
    {
        $message =" Main controller entered index";
        Log::info($message);
        return view('users.index');
    }
    public function register()
    {
        try {

            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('users.register', $roles_permissions)) {
                abort(404);
            }
            ErrorHandlerMsg::setLog('info',"A new user has been created");
            return view(
                'users.register',
                [
                    'roles' => Role::where('id','>',1)->get(),
                ]
            );
        } catch (Exception $e) {
            
            abort(404);
        }
    }


    public function store(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users,username', 'alpha'],
            'firstname' => ['required', 'string', 'max:40', 'alpha'],
            'lastname' => ['required', 'string', 'max:40', 'alpha'],
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
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('users.store', $roles_permissions)) {
                abort(404);
            }

            User::create([
                'username' => $request->post('username'),
                'fullname' => $request->firstname . ' ' . $request->lastname,
                'email' => $request->post('email'),
                'password' => Hash::make($request->password),
                'type' => $request->post('type'),
                'role_id' => $request->post('role_id')
            ]);


            return redirect()->route('users.register')->with('success', 'Create new user!');
        } catch (Exception $e) {
            
            abort(404);
        }
    }

    public function login()
    {
        if (Auth::check()) {

            return redirect()->route('super-db.dashboard');

        }
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

            ErrorHandlerMsg::setLog('debug',"A user logged in SuperDB");
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
        ErrorHandlerMsg::setLog('debug',"User logged out of SuperDB");
        Auth::logout();
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('users.index');
    }
}
