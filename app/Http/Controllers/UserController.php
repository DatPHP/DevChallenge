<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Paginator;

class UserController extends Controller
{

      public function showRegisterForm(){

        //dd("vo day kho ta");

        return view('user.create');

      }
  
      public function storeUser(Request $request){
       
        $messages = [
          'required' => 'Trường :attribute bắt buộc nhập.',
          'email'    => 'Trường :attribute phải có định dạng email'
      ];
      $validator = Validator::make($request->all(), [
              'name'     => 'required|max:255',
              'email'    => 'required|email',
              'password' => 'required',
  
          ], $messages);
  
          if ($validator->fails()) {
              return redirect('register')
                      ->withErrors($validator)
                      ->withInput();
          } else {

              $active = $request->has('active')? 1 : 0;
              if($request->id)
              {   
                  //dd('vo if');
                  $users = User::find($request->id);

                  $request->current_password = $request->password;
                  if ($request->current_password == $users->password) {
                  }
                  else 
                  {
                    $users->password = Hash::make($request->password);
                  }      

                  $customer = Customer::where('user_id',$request->id )->first();
                 //dd($customer);
                  if($customer == null)
                  {
                    $customer = new customer;
                    $customer->user_id = $request->id;
                  }
                  $customer->address =  $request->address;
                  $customer->phone =  $request->phone;
                  $customer->status = $active;
                	$customer->save();
              }
              else 
              {
                $users = new User;
                $users->password = Hash::make($request->password);
             
              }

              $users->name = $request->name;
              $users->email = $request->email;
              $users->save();

             // dd($users);

            // return response()->json($users);
          
            return redirect('user/list')
                ->with('message', 'Đăng ký thành công.');
          }
      }

      public function getlist(){
       $users =  User::paginate(10);

        /*
        $users = DB::table('users')
        ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
        ->get();
      
        
        $users = User::leftJoin('customers', 'users.id', '=', 'customers.user_id')
                  ->get(['users.*', 'customers.*']);

                    */
            

        
       // dd($users);

       //return response()->json($users);

       return view('user.users-list', compact('users'));

      //  return view('user.users-list', ['users' => $users]);
      }

      public function edit(Request $request){
        //var_dump($request->id);
        $id= $request->id;
       // $users = User::findorFail($id);

       // dd($users);

       //$users = DB::table('users')
       $users = DB::table('users')
        ->where('users.id','=',$id)
        ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
        ->get();
        $user = $users[0];

        //return response()->json($user);

        return view('user.create', ['user' => $user, 'id'=>$id]);
      }


      public function delete(Request $request){
          $id= $request->id;
          $user = User::find($id);
          $user->delete();
          $customer = Customer::where('user_id',$request->id )->first();
          $customer->delete();

          return redirect('user/list')
          ->with('message', 'Xoa thanh cong');
      }

}