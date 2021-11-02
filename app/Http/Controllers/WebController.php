<?php

namespace App\Http\Controllers;




use App\Models\Contact;
use Illuminate\Http\Request;


class WebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(Request $request)
    {

     //use distance filter
     if($request->distance){
         $contacts =Contact::getContactsByOfficeDistance($request->distance);
     }else{
         $contacts =Contact::getContactsByOfficeDistance();
     }

        return view('welcome',compact( 'contacts'));
    }


}
