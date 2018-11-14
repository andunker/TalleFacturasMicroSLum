<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Convenio;

class RoutingController extends Controller
{

    public $successStatus = 200;

    /** 
     * routing api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function routing($ref_factura)
    {
        $num_convenio = substr($ref_factura, 0, 4);
        $convenio = Convenio::where('prefijo', $num_convenio)->first();

        return $convenio;
    }

}
