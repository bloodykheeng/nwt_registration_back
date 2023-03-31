<?php

namespace App\Http\Controllers;

use App\Models\ServiceState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceStateController extends Controller
{
    public function index()
    {

        //    return  ServiceState::all();
        $client_details = ServiceState::join("service_types", "service_types.id", "service_states.service_type_id")->join("client_details", "client_details.id", "service_states.client_id")->join("users", "service_states.registras_id", "users.id")->select("service_states.*", "service_types.service_name", "service_types.id as service_types_id", "client_details.client_name", "client_details.id as client_id", "users.name as registrars_name", "users.email as registrars_email")->get();

        return response()->json($client_details);
    }

    //store
    public function store(Request $request)
    {

        // return ServiceState::create($request->all());

        // return ServiceType::create($request->all());
        $validateData =
            $request->validate([
                "service_type_id" => "required",
                "start_date" => "required",
                "end_date" => "required",
                "tax" => "required",
                "quantity" => "required",
                "price" => "required",
                "currency" => "required",
                "description" => "required",
                "client_id" => "required",

            ]);
        try {
            $service_state = ServiceState::create([
                "service_type_id" => $request->service_type_id,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "tax" => $request->tax,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "currency" => $request->currency,
                "description" => $request->description,
                "client_id" => $request->client_id,
                "registras_id" => Auth::user()->id,
            ]);

            return response()->json(["message" => "Service state created succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage(),
                "auth user is " => Auth::user(),
            ], 500);
        }
    }



    //show or getting a single record
    public function show($id)
    {
        // return ServiceState::find($id);

        $client_details = ServiceState::join("service_types", "service_types.id", "service_states.service_type_id")->join("client_details", "client_details.id", "service_states.client_id")->join("users", "service_states.registras_id", "users.id")->select("service_states.*", "service_types.service_name", "service_types.id as service_types_id", "client_details.client_name", "client_details.id as client_id", "users.name as registrars_name", "users.email as registrars_email")->where("users.id", $id)->get();

        return response()->json($client_details);
    }

    public function update(Request $request, $id)
    {
        // $servicestate = ServiceState::find($id);
        // $servicestate->update($request->all());
        // return $servicestate;

        $servicestate = ServiceState::find($id);
        if (!$servicestate) return response()->json(["message" => "service state Not Found!"], 404);
        try {
            $servicestate->update([
                "service_name" => $request->service_name,
                "start_date" => $request->start_date,
                "end_date" => $request->end_date,
                "tax" => $request->tax,
                "quantity" => $request->quantity,
                "price" => $request->price,
                "currency" => $request->currency,
                "description" => $request->description,
                "client_id" => $request->client_id,
                "registras_id" => Auth::user()->id,
            ]);
            return response()->json(["message" => "service state updated succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    //deleting a record
    public function destroy($id)
    {
        return ServiceState::destroy($id);
    }

    //searching
    public function search($client_id)
    {
        return ServiceState::where("client_id", "like", "%" . $client_id . "%")->get();
    }
}
