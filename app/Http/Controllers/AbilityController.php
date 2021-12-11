<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbilityController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Role $role)
    {
        try {

            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.abilities.create', $roles_Abilitiles)) {
                abort(403);
            }

            return view(
                'super-db.abilities.create',
                [
                    'abilities' => Ability::all(),
                    'role' => $role,
                    'roles_Abilitiles' => [],
                ]
            );
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Role $role)
    {
        $request->validate([
            'abilitiy' => ['required', 'exists:abilities,id']
        ]);
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.abilities.store', $roles_Abilitiles)) {
                abort(403);
            }
  
            $abilities = $request->post('abilitiy', []);

            $role->abilities()->attach($abilities);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles with Abilities Created!');
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.abilities.edit', $roles_Abilitiles)) {
                abort(403);
            }
            $roles_Abilitiles = $role->abilities()->pluck('id')->toArray();
            return view(
                'super-db.abilities.edit',
                [
                    'abilities' => Ability::all(),
                    'role' => $role,
                    'roles_Abilitiles' => $roles_Abilitiles,
                ]
            );
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)

    {
        $request->validate([
            'abilitiy' => ['required']
        ]);
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.abilities.update', $roles_Abilitiles)) {
                abort(403);
            }

   
            $abilities = $request->post('abilitiy', []);


            //detach is invert  sync //attach add without check if exits in db 
            $role->abilities()->sync($abilities);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles with Abilities upated!');
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }
}
