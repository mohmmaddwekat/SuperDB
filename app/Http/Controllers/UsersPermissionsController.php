<?php

namespace App\Http\Controllers;

use App\Exceptions\ErrorHandlerMsg;
use App\Models\Permissions;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersPermissionsController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUserRole(Role $role)
    {
        try {

            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.permissions.create', $roles_permissions)) {
                abort(404);
            }

            return view(
                'super-db.permissions.create',
                [
                    'permissions' => Permissions::all(),
                    'role' => $role,
                    'roles_permissions' => [],
                ]
            );
        } catch (Exception $e) {
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
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
            'permissions' => ['required', 'exists:permissions,id']
        ]);
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.permissions.store', $roles_permissions)) {
                abort(404);
            }
  
            $permissions = $request->post('permissions', []);

            $role->permissions()->attach($permissions);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles with Permissions Created!');
        } catch (Exception $e) {
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            //abort(404);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editRolePermissions(Role $role)
    {
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.permissions.edit', $roles_permissions)) {
                abort(404);
            }
            $roles_permissions = $role->permissions()->pluck('id')->toArray();
            return view(
                'super-db.permissions.edit',
                [
                    'permissions' => Permissions::all(),
                    'role' => $role,
                    'roles_permissions' => $roles_permissions,
                ]
            );
        } catch (Exception $e) {
            return ErrorHandlerMsg::getErrorMsgWithLog($e->getMessage());
            // abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateUserRole(Request $request, Role $role)

    {
        $request->validate([
            'permissions' => ['required']
        ]);
        try {
            $roles_permissions = Auth::user()->role->permissions()->pluck('code')->toArray();
            if (!in_array('super-db.permissions.update', $roles_permissions)) {
                abort(404);
            }

   
            $permissions = $request->post('permissions', []);


            //detach is invert  sync //attach add without check if exits in db 
            $role->permissions()->sync($permissions);

            return redirect()->route('super-db.roles.index')->with('success', 'Roles with Permissions upated!');
        } catch (Exception $e) {
            abort(404);
        }
    }
}
