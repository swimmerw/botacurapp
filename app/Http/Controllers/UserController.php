<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('themes.backoffice.pages.user.index',[
            'users' => User::all(),
            //'roles' => Role::all(),
        ]);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('themes.backoffice.pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('themes.backoffice.pages.user.show',[
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
    /**
     * Mostrar formulario para asignar rol
     * 
     */
    public function assign_role(User $user)
    {
        //dd($request);
        //$this->authorize('assign_role', $user);
        return view('themes.backoffice.pages.user.assign_role',[
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Asignar los roles en la tabla pivote de la base de datos
     * 
     */
    public function role_assignment(Request $request, User $user)
    {
        //$this->authorize('assign_role', $user);
        $user->role_assignment($request);
        $user->roles()->sync($request->roles);
        $user->verify_permission_integrity();
        alert('Éxito', 'Roles asignados', 'success')->showConfirmButton();

        return redirect()->route('backoffice.user.show',$user);
    }

     /**
     * Mostrar el formulario para asignar los permisos
     * 
     */
    public function assign_permission(User $user)
    {
        //$this->authorize('assign_permission', $user);
        return view('themes.backoffice.pages.user.assign_permission',[
            'user' => $user,
            'roles' => $user->roles
        ]);
    }

    /**
     * Asignar permisos en la tabla pivote de la base de datos
     * 
     */
    public function permission_assignment(Request $request, User $user)
    {
        //$this->authorize('assign_permission', $user);
        $user->permissions()->sync($request->permissions);
        alert('Éxito', 'Permisos asignados', 'success');
        return redirect()->route('backoffice.user.show', $user);
    }


}
