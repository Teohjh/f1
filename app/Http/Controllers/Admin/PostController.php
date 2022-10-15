<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;

class PostController extends Controller
{
    public function post_list(){
        $data = Post::all();

        return view('admin.facebook.post_list',['posts'=>$data]);
    }

   
}
