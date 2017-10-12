<?php

namespace App\Http\Controllers\AccountSettings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(){
        // dd($request);
        return view('settings.changepassword');
    }

    public function update(Request $request){
        
        // $actualpassword = $request->input('actualpassword');
        // $newpassword = $request->input('newpassword');
        // $confirmpassword = $request->input('confirmpassword');

        //Validation 
        $this->validate($request, [
            'old' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();
        $hashedPassword = $user->password;

        if(Hash::check($request->input('old'), $hashedPassword)){
            
            //Change password
            $user->fill([
                'password' => Hash::make($request->input('password'))
            ])->save();
            
            return back()
                ->with('success', 'Your password has been changed.');
        }
        
        return back()
            ->with('failure', 'Your password has not been changed.');

    }
    
}
