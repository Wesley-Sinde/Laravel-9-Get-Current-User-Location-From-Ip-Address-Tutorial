<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
  
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $ip = $request->ip(); Dynamic IP address */
        $ip = '197.248.42.165'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
          
        return view('user', compact('currentUserInfo'));
    }
}