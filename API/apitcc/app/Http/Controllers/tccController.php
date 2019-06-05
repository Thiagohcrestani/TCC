<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tccController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

	public function getAll(){
		return "getAll";

	}

	public function get($idberco){
		return"get " . $id;

	}
	public function store(Request $request){
		dd($request->all());

	}
	public function update($idberco,Request $request){
		dd($idberco, $request->all());
	}

	public function destroy($id){
		dd($idberco);
	}

    //
}
