<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

use App\Models\Category;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    public function index(Request $request)
    {
        $data = Content::orderBy('id', 'desc')->paginate(20);
        $cats = Category::orderBy('title', 'desc')->get();
        $titles= 'Posts';

        //return view('customer.add', compact('title'));

        return view('admin.content.index', compact('titles','data','cats'));
    }

    private function upload($image){
        $name = $image->getClientOriginalName();
        $newName = date('ymdgis').$name;
        $image->move(public_path().'/Uploads',$newName);
        return $newName;
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title'  => 'required|max:100',
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
        $data['category'] = $request->category;        
        $data['description'] = dd($request->description);

        $data['status'] = $request->status;
        $slug = $this->slug($request->title);
        $data['slug'] = $slug;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        $data['image'] = $request->select_file;
        if(!empty($data['image'])){            
                $data['image'] = $this->upload($data['image']);            
        }else{
            $data['image']= "";
        }
        
        $data = Content::insert($data);

        //$data = Category::create($request->all());

        //$dataq = Category::create($data);

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
