<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Helper\ResponseHelper;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function UserLogin(Request $request):JsonResponse{
        try{
            $userEmail = $request->userEmail;
            $OTP = rand(100000, 999999);
            $details = ['code'=> $OTP];
            Mail::to($userEmail)->send(new OTPMail($details));
            $req = User::updateOrCreate(['email'=>$userEmail], ['email'=> $userEmail, 'otp'=> $OTP]);
            echo $req;
            return ResponseHelper::Out('success', "A 6 digit OTP has been send to your email address", 200);
            // return "hello";
        }
        catch(Exception $e){
            return ResponseHelper::Out('fail', $e, 200);
        }
    }

    public function VerifyLogin(Request $request):JsonResponse{
        $userEmail = $request->userEmail;
        $OTP = $request->OTP;
        $verification = User::where('email', $userEmail)->where('otp', $OTP)->first();
        if( $verification){
            User::where('email', $userEmail)->where('otp', $OTP)->update(['otp'=> '0']);
            $token = JWTToken::CreateToken($userEmail, $verification->id);
            return ResponseHelper::Out('success', "", 200)->cookie('token', $token, 60*24*24);
        }
        else{
            return ResponseHelper::Out('fail',null,401);
        }
    }
    public function UserLogOut(){
        return redirect('/userLoginPage')->cookie('token', '', -1);
    }
}
