<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::orderBy('seq', 'asc')->paginate(20);
        $titles= 'Category';

        //return view('customer.add', compact('title'));

        return view('admin.category.index', compact('titles','data'));
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

        $data = Category::insert($data);

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

        $data = Category::find($id);

        $data['title'] = $request->titleedit;
        $data['seq'] = $request->orderedit;
        $data['status'] = $request->statusedit;
        $slug = $this->slug($request->titleedit);
        $data['slug'] = $slug;
        $data['updated_at'] = date('Y-m-d H:i:s');

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
