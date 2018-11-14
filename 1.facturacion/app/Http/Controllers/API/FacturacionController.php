<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacturacionController extends Controller
{

    public $successStatus = 200;

    /** 
     * get_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function get_facturacion(Request $request)
    {
        $ref_factura = $request['ref'];

        //llamado a routing

        $client = new \GuzzleHttp\Client();
        $convenio = $client->request(
            'GET',
            'http://localhost:8383/routing/' . $ref_factura,
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ]
        );


        $convenio = json_decode($convenio->getBody());

     

        //fin llamado routing

//llamado transform

        $client = new \GuzzleHttp\Client();
        $homologacion_factura = $client->request(
            'GET',
            'http://localhost:8484/transform/' . $convenio->id,
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ]
        );


        $homologacion_factura = json_decode($homologacion_factura->getBody());

     

//fin llamado transform


//llamado dispatching

        $client = new \GuzzleHttp\Client();
        $respuesta = $client->request(
            'POST',
            'http://localhost:8585/dispatching',
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    'valorFactura' => 5000
                ]
            ]
        );


        $respuesta = json_decode($respuesta->getBody());

     
//fin llamado dispatching

  // return ($convenio->getBody());
        die();
    }

    /** 
     * post_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function post_facturacion(Request $request)
    {
        $ref_factura = $request['ref'];
    }

    /** 
     * delete_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function delete_facturacion(Request $request)
    {
        $ref_factura = $request['ref'];
    }

}
