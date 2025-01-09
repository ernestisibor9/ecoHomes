<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    //
    public function AgentDashboard(){
        return view('frontend.agent.index');
    }
    public function AgentLogin(){
        return view('frontend.agent.agent_login');
    }
    public function AgentRegister(){
        return view('frontend.agent.agent_register');
    }
    public function AgentStoreRegister(Request $request){
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => '1',
        ]);
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::AGENT);
        //return view('auth.login');
    }
}
