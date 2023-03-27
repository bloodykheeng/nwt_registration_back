<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return Admin::all();
    }

    //store method
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json(
            [
                "message" => "user created successfully",
                "user" => $request->name
            ]
        );
    }



    //show a single record
    public function show($id)
    {
        return
            Admin::find($id);
    }

    //update records
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->update($request->all());
        return $admin;
    }

    //deleting
    public function destroy($id)
    {
        return Admin::destroy($id);
    }

    //searching
    public function search($name)
    {
        return Admin::where("name", "like", "%" . $name . "%")->get();
    }
}
