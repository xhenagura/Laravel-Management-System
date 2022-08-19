<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function UserAll(){
        return view('backend.users.user_all');
    }

    public  function UserAdd()
    {
        # code...
        return view('backend.users.user_add');
    }

    public function UserStore(Request $request){

        
        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->address,

        ]);

        $user->assignRole($request->input('roles'));

         $notification = array(
            'message' => 'Supplier Inserted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('user.all')->with($notification);
    }

    public function UserEdit($id){

        $user = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.users.user_edit',compact('user','roles','userRole'));

    } // End Method 

    public function UserUpdate(Request $request, $id){

        $user_id = $request->id;

        $user = User::findOrFail($user_id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ]);

        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

         $notification = array(
            'message' => 'Supplier Updated Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->route('supplier.all')->with($notification);

    } // End Method 


    public function SupplierDelete($id){

      User::findOrFail($id)->delete();
      
       $notification = array(
            'message' => 'Supplier Deleted Successfully', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method 

}
