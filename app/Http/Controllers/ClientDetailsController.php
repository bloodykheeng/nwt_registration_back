<?php

namespace App\Http\Controllers;

use App\Models\ClientDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;


class ClientDetailsController extends Controller
{
    public function index()
    {
        // $client_details = ClientDetails::all();
        $client_details = ClientDetails::join("users", "client_details.registras_id", "users.id")->select("client_details.*", "users.name as registrars_name", "users.email as registrars_email")->get();

        return response()->json($client_details);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate(["client_name" => "required"]);
        try {
            $client_detail = ClientDetails::create([
                "client_name" => $request->client_name,
                "client_address" => $request->client_address,
                "client_pobox" => $request->client_pobox,
                "client_phonenumber" => $request->client_phonenumber,
                "client_email" => $request->client_email,
                "registras_id" => Auth::user()->id
            ]);

            return response()->json(["message" => "client created succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage(),
                "auth user is " => Auth::user(),
            ], 500);
        }
    }


    //show a  specific resource
    public function show($id)
    {

        $clientdetail = ClientDetails::find($id);
        if (!empty($clientdetail)) {
            return response()->json($clientdetail);
        } else {
            return response()->json(["message" => "Client detail Not Found!"], 404);
        }
    }

    // updating a particular field

    public function update(Request $request, $id)
    {
        $clientDetail = ClientDetails::find($id);
        if (!$clientDetail) return response()->json(["message" => "CLient detail Not Found!"], 404);
        try {
            $clientDetail->update([
                "client_name" => $request->client_name,
                "client_address" => $request->client_address,
                "client_pobox" => $request->client_pobox,
                "client_phonenumber" => $request->client_phonenumber,
                "client_email" => $request->client_email,
                "registras_id" => Auth::user()->id
            ]);
            return response()->json(["message" => "client updated succesfully"], 201);
        } catch (\Exception $e) {
            // Return Error Response
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }


    // Remove a particular field
    public function destroy($id)
    {
        $clientdetail = ClientDetails::find($id);
        if (!empty($clientdetail)) {
            $clientdetail->delete();
            return response()->json(['success' => 'Successfully deleted the client detail.'], 201);
        } else {
            return response()->json(["message" => "Client Detail Not Found!"], 404);
        }
    }
}
