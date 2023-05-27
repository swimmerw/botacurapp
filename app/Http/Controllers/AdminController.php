<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
        {
	        $this->middleware('role:' . config('app.admin_role'));
        }


    public function show()
    {
        return view('themes.backoffice.pages.admin.show');
    }
}
