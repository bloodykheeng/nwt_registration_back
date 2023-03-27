<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceTypeController extends Controller
{
    //present all records
    public function index()
    {


        // $service_types = ServiceType::all();
        $service_types = ServiceType::join("users", "service_types.registras_id", "users.id")->select("service_types.*", "users.name as registrars_name", "users.email as registrars_email")->get();
        return response()->json($service_types);
    }

    //store record
    public function store(Request $request)
    {

        // return ServiceType::create($request->all());
        $validateData = $request->validate(["service_name" => "required"]);
        try {
            $service_type = ServiceType::create([
                "service_name" => $request->service_name,
                "registras_id" => Auth::user()->id
            ]);

            return response()->json(["message" => "Service type created succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage(),
                "auth user is " => Auth::user(),
            ], 500);
        }
    }

    //show particular record
    public function show($id)
    {
        return ServiceType::find($id);
    }

    //update
    public function update(Request $request, $id)
    {
        // $servicetype = ServiceType::find($id);
        // $servicetype->update($request->all());
        // return $servicetype;

        $servicetype = ServiceType::find($id);
        if (!$servicetype) return response()->json(["message" => "service type Not Found!"], 404);
        try {
            $servicetype->update([
                "service_name" => $request->service_name,
                "registras_id" => Auth::user()->id
            ]);
            return response()->json(["message" => "service type updated succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    //delete
    public function destroy($id)
    {
        return ServiceType::destroy($id);
    }

    //search
    public function search($name)
    {
        return ServiceType::where("service_name", "like", "%" . $name . "%")->get();
    }
}
