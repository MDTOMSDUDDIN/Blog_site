<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function role(){
        $permissions = Permission::all();
        $roles = Role::all();
        $Users = User::all();
        return view('admin.role.role',[
            'permissions' => $permissions,
            'roles' => $roles,
            'Users' => $Users,
        ]);
    }

    function permission_store(Request $request){
        // Validate the permission name
    $request->validate([
        'permission_name' => 'required',
    ], [
        'permission_name.required' => 'Permission name is required!',
    ]);

        $permission = Permission::create(['name' => $request->permission_name]);
        return back()->with('success','Permission created successfully!');
    }

    function role_store(Request $request){
        // Validate the request input
        $request->validate([
            'role_name' => 'required',
        ], [
            'role_name.required' => 'Role name is required!',
        ]);
        $role = Role::create(['name' => $request->role_name]);
        $role->givePermissionTo($request->permission);
        return back()->with('success_role','Role created successfully!');
    }
    function role_assign(Request $request){
        $user = User::find($request->user_id);
        $user->assignRole($request->role);
        return back()->with('success_assign','User Assigned Successfully!');
    }


    function role_delete($role_id){
        DB::table('role_has_permissions')->where('role_id',$role_id)->delete();
        $role = Role::find($role_id)->delete();
        return back()->with('del','Role deleted successfully!');
    }

    function role_remove($user_id){
        $user = User::find($user_id);
        $user->syncRoles([]);
        return back()->with('delete','User Role removed successfully!');
    }
}
