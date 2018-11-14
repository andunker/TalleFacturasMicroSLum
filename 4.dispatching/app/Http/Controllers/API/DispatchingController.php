<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DispatchingController extends Controller
{

    public $successStatus = 200;

    /** 
     * dispatching api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function dispatching(Request $request)
    {

if('SOAP'=='SOAP'){
            die();
}

elseif('REST'=='REST'){
            die();
        }

        die();
    }

}
