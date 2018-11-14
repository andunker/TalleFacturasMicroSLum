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

        $data_factura = $request->all();
        if ($data_factura['convenio']['tipo_servicio'] == 'SOAP') {



            $client = new \GuzzleHttp\Client();


            $xml = $data_factura['formato_pago']['plantilla'];



            $res = $client->request(
                'POST',
                $data_factura['convenio']['endpoint'],
                [
                    'headers' => [
                        'Content-type' => 'text/xml',


                        'SOAPAction' => $data_factura['formato_pago']['accion']


                    ],
                    'body' => $xml
                ]

            );

            return ($res->getBody());




        } elseif ($data_factura['convenio']['tipo_servicio'] == 'REST') {
            die();
        }

        die();
    }

}
