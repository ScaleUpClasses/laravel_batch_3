<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidate;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function list()
    {
        if (!Auth::user()) {
            return redirect('/');
        }
        $users =    DB::table('users')->join('cities','cities.id','users.city_id')
                    ->select('users.*','cities.name as city_name')->get();
        // $users = User::get();
        return view('user-list',compact('users'));
    }

    public function extraFunction()
    {
        $name = "aa";
        // $users = User::get()->skip(2);
        // $users = User::get()->take(2);
        // $users = User::where('name','like', '%' .$name. '%')
        //             ->orWhere('gender','female')
        //             ->orWhere('role','1')
        //             ->get()->pluck('name');
        //             // ->get()->count();

        $users = User::get()->max('name');
        $users = User::get()->min('city_id');
        $users = User::get()->sum('role');
        dd($users);
        return view('user-list',compact('users'));
    }

    public function create()
    {
        return view('user-create');
    }

    public function store(UserValidate $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:25|min:2',
            'email' => 'required|email|unique:users,email',
            'mo_no' => 'required|digits:10',
            'password' => 'required',
        ]);

        $image = $request->image;
        $img_name = time().rand(100000,999999).$image->getClientOriginalName();

        $image->move('uploads/',$img_name);

        $name = $request->name;
        $email = $request->email;
        $mo_no = $request->mo_no;
        $password = Hash::make($request->password);

        $data = [
            'name' => $name,
            'email' => $email,
            'mo_no' => $mo_no,
            'password' => $password,
        ];
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->mo_no = $request->mo_no;
        $user->image = $img_name;
        $user->hobby = implode(',',$request->hobby);

        $user->save();
        // $user = DB::table('users')->insert($data);

        // return response()->json(['user'=>$user,'message'=>'user created successfully.']);
        return redirect('user/list');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $user = DB::table('users')->where('id',$id)->first();

        return view('user-edit',compact('user'));
    }

    public function update(Request $request)
    {
        $name = $request->name;
        $email = $request->email;
        $mo_no = $request->mo_no;

        $data = [
            'name' => $name,
            'email' => $email,
            'mo_no' => $mo_no,
        ];

        DB::table('users')->where('id',$request->id)->update($data);
        return redirect('user/list');
    }

    public function delete($id)
    {
        $user = DB::table('users')->where('id',$id)->delete();
        return back();
    }

    public function deleteAjax(Request $request)
    {
        // $user = DB::table('users')->where('id',$request->u_id)->delete();
        $user = User::find($request->u_id)->delete();
        return response()->json(["message" => "Data deleted successfully.","status" => 200]);

        // $data = [
        //     'message' => "Data deleted successfully.",
        //     'status' => 200,
        // ];

        // return response()->json($data);
    }

    public function mailSend(Request $request)
    {
        // $email = $request->email;
        $email = "vimaldudhat30@gmail.com";
        $otp = rand(100000,999999);
        $details = [
            'otp' => $otp,
            'email' => $email,
        ];

        dispatch(new SendEmailJob($details));
        dump(123);
        return redirect('/');
    }
}
