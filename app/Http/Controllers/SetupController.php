<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setup;

use Illuminate\Support\Facades\Validator;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        $data = Setup::orderBy('id', 'desc')->paginate(20);
        $titles= 'Setup';

        //return view('customer.add', compact('title'));

        return view('admin.setup.index', compact('titles','data'));
    }

    public function show($id)
    {
        $data = Setup::find($id);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->input(), array(
            'logo' => 'required',
            'meta_title' => 'required',
            'address' => 'required',
            'contact' => 'required',
            'email' => 'required|email',
            'social' => 'required',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data = Setup::find($id);

        $data->logo    =  $request->input('logo');
        $data->meta_title    =  $request->input('meta_title');
        $data->address    =  $request->input('address');
        $data->contact    =  $request->input('contact');
        $data->email    =  $request->input('email');
        $data->social    =  $request->input('social');
        $data->updated_at = date('Y-m-d H:i:s');

        $data->save();

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }
    

}
