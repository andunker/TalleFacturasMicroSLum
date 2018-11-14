<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomologacionFactura;

class TransformController extends Controller
{

    public $successStatus = 200;

    /** 
     * transform api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function transform($id_convenio)
    {
        $homologacion_factura = HomologacionFactura::where('id_convenio', $id_convenio)->first();
        return $homologacion_factura;
    }

}
