<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Menu;

use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $data = Menu::orderBy('id', 'desc')->paginate(20);
        $titles= 'Menu';

        //return view('customer.add', compact('title'));

        return view('admin.menu.index', compact('titles','data'));
    }

    

    public function store(Request $request)
    {
       /*
        $messages = [
            'title.required' => 'We need to know your e-mail address!',
        ];*/

        $validator = Validator::make(request()->all(), [
            'title'  => 'required|max:30',
            'order'  => 'required|numeric',
            //'email' => 'required|max:100|email',
        ]);        
            

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data['id'] = \Uuid::generate(4);
        $data['title'] = $request->title;
        $data['seq'] = $request->order;
        $data['status'] = $request->status;
        $slug = $this->slug($request->title);
        $data['slug'] = $slug;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $data = Menu::insert($data);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);        
    }

    public function show($id)
    {
        $data = Menu::find($id);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
       $validator = Validator::make(request()->all(), [
            'titleedit'  => 'required|max:30',
            'orderedit'  => 'required|numeric',
            //'email' => 'required|max:100|email',
        ]);  

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data = Menu::find($id);

        $data['title'] = $request->titleedit;
        $data['seq'] = $request->orderedit;
        $data['status'] = $request->statusedit;
        $slug = $this->slug($request->titleedit);
        $data['slug'] = $slug;
        $data['updated_at'] = date('Y-m-d H:i:s');

        $data->save();
        //$data = Menu::where('id',$id)->update($data);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }
    

    public function destroy($id)
    {
        $data = Menu::destroy($id);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }

    private function slug($string){
        $string = strtolower(trim($string));
        $string = preg_replace('/\s+/','-',$string);
        $string = preg_replace('/[^a-z0-9-]/','-', $string);
        $string = preg_replace('/-+/','-', $string);
        return rtrim($string,'-');
    }
}
