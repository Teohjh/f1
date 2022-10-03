<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    //
    public function guard()
    {
     return Auth::guard('admin');
    }

    public function admin_register()
    {
        return view("admin.admin_register");
    }
    
    public function admin_register_success(Request $request)
    {
            $request->validate([
                'admin_name' => 'required|unique:admins',
                'admin_email' => 'required|email',
                'admin_password' => 'required|min:8'
            ]);
            $admin = new Admin();
            $admin->admin_name = $request->admin_name;
            $admin->admin_email = $request->admin_email;
            $admin->admin_password = Hash::make($request->admin_password);
            $respond = $admin->save();
            if($respond){
                return redirect('admin/login');
                //->back()->with('success', 'You have registered successful.');
            }else{
                return back()->with('fail','Error. Please try again');
            }
    }
}
