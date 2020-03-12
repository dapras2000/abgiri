<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        $setups = DB::table('setups')->first();
        if (!empty($setups->social)){
            $socials= explode(',',$setups->social);
            $icons= explode(',',$setups->social);
            foreach ($icons as $icon){
                $icon = explode('.',$icon);
                $icon = $icon[1];
                $fa[] = $icon;
            }
        }else{
            $socials = [];
        }
        //print_r($fa);
        $cats = DB::table('categories')->where('status','on')->get();

        return view ('frontend.index',[
            'setups' => $setups,
            'socials' => $socials,
            'fa' => $fa,
            'cats' => $cats,
        ]);
    }
}
