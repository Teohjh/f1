<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Yajra\Datatables\Datatables;
use Exception;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function post_list(){
        $data = Post::all();

       return view('admin.post.post_list',['posts'=>$data]);
    }

    public function getmodal(Request $request)
    {
        $data = array();
        if (isset($request->id) && $request->id != '') {
            $id = decrypt($request->id);
            $data = Post::where('id',$id)->first();
        }
    
        return view('admin.post.getmodal', compact('data'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if ($request->hasFile('image') || !empty($input['name']) || !empty($input['message']) ) {
            try {
                if (isset($request->id)) {
                    $id = decrypt($request->id);
                    $msg =  'updated successfully';
                    $data = Post::find($id);
                    if ($request->hasFile('image')) {
                        if(file_exists(public_path('assets/image/post/'.$data->image)) && $data->image!='') {
                            unlink(public_path('assets/image/post/'.$data->image));
                        }
                    }

                    
                }else{
                    $msg =  'Added successfully';
                    $data = new Post;
                }
                
                //save image into public folder
                if($request->hasFile('image'))
                {
                    $post_image = time().'-'.$input['image']->getClientOriginalName();
                    $input['image']->move('assets\image\post', $post_image);
                }
                else
                {
                    $post_image = null;
                }

                $data->message = $input['message'];
                $data->image = $post_image;
                $data->status = "inactive";
                $data->save();
                $arr = array("status" => 200, "msg" => $msg);

            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }
        }
        return Response::json($arr);
    }

    public function edit_post($id)
    {
        $post = Post::find($id);
        if($post)
        {
            return response()->json([
                'status'=>200,
                'post'=> $post,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Post Found.'
            ]);
        }

    }

    public function update_post(Request $request, $id)
    {
        $input = $request->all();
            try {
                if (isset($request->id)) {
                    $id = decrypt($request->id);
                    $msg =  'updated successfully';
                    $data = Post::find($id);
                    if ($request->hasFile('image')) {
                        if(file_exists(public_path('assets/image/post/'.$data->image)) && $data->image!='') {
                            unlink(public_path('assets/image/post/'.$data->image));
                        }
                    }

                    
                }else{
                    $msg =  'Added successfully';
                    $data = new Post;
                }
                
                //save image into public folder
                if($request->hasFile('image'))
                {
                    $post_image = time().'-'.$input['image']->getClientOriginalName();
                    $input['image']->move('assets\image\post', $post_image);
                }
                else
                {
                    $post_image = " ";
                }

                $data->name = $input['name'];
                $data->message = $input['message'];
                $data->image = $post_image;
                $data->save();
                $arr = array("status" => 200, "msg" => $msg);

            } catch (\Illuminate\Database\QueryException $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }catch (Exception $ex) {
                $msg = $ex->getMessage();
                if (isset($ex->errorInfo[2])) :
                    $msg = $ex->errorInfo[2];
                endif;
                $arr = array("status" => 400, "msg" => $msg, 'line'=> $ex->getLine(), "result" => array());
            }
        
        return Response::json($arr);
    }

}
