<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Rules\CheckNameRule;
use Exception;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class RoleController extends Controller
{

    /**
     * Redirect the user to the roles page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            ErrorHandlerMsg::setLog('info',"Role controller entered by authorized user");
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();

            if (!in_array('super-db.roles.index', $roles_permissions)) {
            abort(404);
            }
            return view(
                'super-db.roles.index',
                [
                    'roles' => Role::where('id','>',1)->get(),
                ]
            );
        } catch (Exception $e) {
            ErrorHandlerMsg::setLog('debug',"Unauthorized operation");
            abort(404);
        }
    }

    /**
     * Create a new user role and assign permissions to it 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.roles.create', $roles_permissions)) {
                abort(404);
            }
            ErrorHandlerMsg::setLog('info',"ٌRole is created");
            return view(
                'super-db.roles.create',
                [
                    'role' => Role::paginate(),
                ]
            );
        } catch (Exception $e) {
            ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in role controller");
            abort(404);
        }
    }

    /**
     * Store (save) the newly added role
     * Validate on that role (name constraints)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255', 'unique:roles,name', new CheckNameRule],
        ]);
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.roles.store', $roles_permissions)) {
                ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in role controller");
                abort(404);
            }



            Role::create([
                'name' => $request->post('name'),

            ]);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles created!');
        } catch (Exception $e) {
            ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in role controller");
            abort(404);
        }
    }


    /**
     * Redirect the user to the edit role page
     *
     * @param  \App\Models\super-db\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
        if (!in_array('super-db.roles.edit', $roles_permissions)) {
            abort(404);
        }
        return view('super-db.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Edit a role with it's permissions 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        try {        
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.roles.update', $roles_permissions)) {
                abort(404);
            }
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $role->id, new CheckNameRule],
            ]);
            $role->update([
                'name' => $request->name,

            ]);
            ErrorHandlerMsg::setLog('info',"ٌRole has been updated");
            return redirect()->route('super-db.roles.index')->with('success', 'Roles Updated!');
        } catch (Exception $th) {
            ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in role controller");
            abort(404);
        }

    }

    /**
     * Delete a specific role
     *
     * @param  \App\Models\super-db\Role $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.roles.destroy', $roles_permissions)) {
                abort(404);
            }
            Role::destroy($role->id);
            ErrorHandlerMsg::setLog('info',"Role has been deleted");
            return  redirect()->route('super-db.roles.index')->with('success', 'Role Deleted!');
        } catch (Exception $th) {
            ErrorHandlerMsg::setLog('error',"ٌUnauthorized operation in role controller");
            abort(404);
        }
        
    }
}
