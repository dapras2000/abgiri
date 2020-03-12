<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::orderBy('id', 'desc')->paginate(20);
        $titles= 'Menu';

        //return view('customer.add', compact('title'));

        return view('admin.category.index', compact('titles','data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->input(), array(
            'title' => 'required',  
            'seq' => 'required|numeric',                  
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data['id'] = \Uuid::generate(4);
        $data['title'] = $request->title;
        $data['seq'] = $request->seq;
        $data['status'] = $request->status;
        $slug = $this->slug($request->title);
        $data['slug'] = $slug;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $data = Category::insert($data);

        //$data = Category::create($request->all());

        //$dataq = Category::create($data);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);        
    }

    public function show($id)
    {
        $data = Category::find($id);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }

    public function update(Request $request, $id)
    {
       $validator = Validator::make($request->input(), array(
            'titleedit' => 'required',
            'seqedit' => 'required|numeric',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data = Category::find($id);

        $data->title    =  $request->input('titleedit');
        $data->seq = $request->input('seqedit');
        $data->status = $request->input('statusedit');
        $slug = $this->slug($request->input('titleedit'));
        $data->slug = $slug;
        $data->updated_at = date('Y-m-d H:i:s');

        $data->save();
        //$data = Category::where('id',$id)->update($data);

        return response()->json([
            'error' => false,
            'data'  => $data,
        ], 200);
    }
    

    public function destroy($id)
    {
        $data = Category::destroy($id);

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
