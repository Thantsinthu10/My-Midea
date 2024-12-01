<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct admin home page
    public function index(){
        $id= Auth::user()->id;
        $user = User::select('id','name','phone','address','email','gender')->where('id',$id)->first();
        return view('admin.profile.index',compact('user'));
    }

    //update admin account
    public function updateAdminAccount(Request $request){
        $userData = $this->getUserInfo($request);

        $validator = $this->userValidationCheck($request);

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::where('id',Auth::user()->id)->update($userData);
        return back()->with(['updateSuccess'=>'Admin account Updated!']);
    }

    //direct change password
    public function directChangePassword(){
        return view('admin.profile.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        $validator = $this->changePasswordValidationCheck($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $dbData= User::where('id',Auth::user()->id)->first();
        $dbPassword = $dbData->password;
        $hashUserPassword = Hash::make($request->newPassword);

        $updateData = [
            'password' => $hashUserPassword,
            'updated_at' => Carbon::now()
        ];

        if(Hash::check($request->oldPassword, $dbPassword)){
           User::where('id',Auth::user()->id)->update($updateData);
           return redirect()->route('dashboard');
        }else{
            return back()->with(['fail'=> 'Old password do not match']);
        }
    }

    //get user info
    private function getUserInfo($request){
        return[
            'name' => $request->adminName,
            'email'=>$request->adminEmail,
            'address'=>$request->adminAddress,
            'phone'=>$request->adminPhone,
            'gender'=>$request->adminGender,
            'updated_at'=>Carbon::now()
        ];
    }

    //USER VALIDATION CHECK
    private function userValidationCheck($request){
    return Validator::make($request->all(), [
            'adminName' => 'required',
            'adminEmail' => 'required',
        ]);

}

// change password validation check
private function changePasswordValidationCheck($request){
    $validationRules = [
        'oldPassword'=> 'required',
        'newPassword'=>'required|min:8',
        'confirmPassword'=>'required|same:newPassword|min:8'
    ];

    $validationMessage = [
        'confirmPassword.same' => 'New Password & Conform Password must be same!'
    ];
    return Validator::make($request->all(),$validationRules,$validationMessage);
}

}
