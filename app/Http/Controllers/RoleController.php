<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Rules\CheckNameRule;
use Exception;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();

            if (!in_array('super-db.roles.index', $roles_Abilitiles)) {
                abort(403);
            }
            return view(
                'super-db.roles.index',
                [
                    'roles' => Role::with('abilities')->paginate(),
                ]
            );
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.roles.create', $roles_Abilitiles)) {
                abort(403);
            }

            return view(
                'super-db.roles.create',
                [
                    'role' => Role::paginate(),
                ]
            );
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.roles.store', $roles_Abilitiles)) {
                abort(403);
            }
            $request->validate([
                'name' => ['required', 'string', 'min:3', 'max:255', 'unique:roles,name', new CheckNameRule],
            ]);


            Role::create([
                'name' => $request->post('name'),

            ]);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles created!');
        } catch (Exception $e) {
            return \App\Connection\ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\super-db\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if (!in_array('super-db.roles.edit', $roles_Abilitiles)) {
            abort(403);
        }
        return view('super-db.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if (!in_array('super-db.roles.update', $roles_Abilitiles)) {
            abort(403);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id, new CheckNameRule],


        ]);
        $role->update([
            'name' => $request->name,

        ]);

        return redirect()->route('super-db.roles.index')->with('success', 'Roles Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\super-db\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
        if (!in_array('super-db.roles.destory', $roles_Abilitiles)) {
            abort(403);
        }
        Role::destroy($role->id);
        return  redirect()->route('super-db.roles.index')->with('success', 'Role Deleted!');
    }
}
