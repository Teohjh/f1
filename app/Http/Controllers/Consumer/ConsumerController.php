<?php

namespace App\Http\Controllers\Consumer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consumer;

class ConsumerController extends Controller
{
    public function index()
    {
        return view("consumer.consumer_index");
    }

    public function consumer_list()
    {
        $data = Consumer::all();

        return view('admin.consumer.consumer_list',['consumers'=>$data]);
    }
    public function consumer_search()
    {
        $search_text = $_GET['query'];
        $consumers = Consumer::where('name', 'LIKE', '%'.$search_text. '%')->get();

        return view('admin.consumer.consumer_list_search',compact('consumers'));
    }

}
