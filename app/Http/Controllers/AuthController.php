<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordMail;
use App\Mail\forgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web', ['except' => ['login','register']]);
    }

    // register

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'username' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'image'=> null,
            'preference'=> null,
            'role_id'=> 2,
        ]);


        $token = Auth::fromUser($user);

        return redirect('/');
    }


    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate user
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Generate JWT
        $token = Auth::fromUser($user);
        $request->session()->put('token', $token);
        // Redirect the user to the dashboard route
        $cookie = cookie('token', $token, 60);
        return redirect()->to('/dashboard')->withCookie($cookie);
    }



// return the authenticated user's information.
    public function infoUser()
    {
        return response()->json(auth()->user());
    }



    public function refresh()
    {
        // return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        // return response()->json([
        //     'access_token' => $token,
        //     'token_type' => 'bearer',
        //     'expires_in' => auth()->factory()->getTTL() * 60
        // ]);
    }


    public function forgetpassword()
    {
        return view('authentication.forgetpassword');
    }

    public function sendResetPwd(Request $request)
    {

        $user= User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = str::random(30);
            $user->save();

            Mail::to($user->email)->send(new forgotPasswordMail($user));
            return redirect()->back()->with('success', "please check your email and reset your password");
        }else{
            return redirect()->back()->with('error', "email not found in the system");
        }
    }

    public function rest($remember_token)
    {
        $user= User::getToken($remember_token);
        if (!empty($user))
        {
            return view('authentication.reset', compact('user'));
        }
        else
        {
            abort(404);
        }
    }

    public function postrest(Request $request)
    {
        if ($request->password == $request->ConfirmPassword)
        {
            $user = User::getToken($request->remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();
            return redirect(url('authentication.login'))->with('success', "Password Successfully reset");
        }
        else
        {
            return redirect()->back()->with('error', 'password and confirm password does not match ');
        }
    }


    public function logout(Request $request)
    {


        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }


}


