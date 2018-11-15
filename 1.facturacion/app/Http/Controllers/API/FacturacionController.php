<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FacturacionController extends Controller
{


    public $hostname;
    public $successStatus = 200;

    public function __construct()
    {
        $this->hostname = env('APP_URL', $this->hostname.'');
    }

    /** 
     * get_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function get_facturacion(Request $request)
    {

        return $this->process_request($request);
      
    }

    /** 
     * post_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function post_facturacion(Request $request)
    {
       return $this->process_request($request);
    }

    /** 
     * delete_facturacion api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function delete_facturacion(Request $request)
    {
        return $this->process_request($request);
    }

    public function process_request(Request $request){

        $ref_factura = $request['ref'];
        $valor_pagar = $request['valor_pagar'] ? $request['valor_pagar'] : '';

        //llamado a routing

        $client = new \GuzzleHttp\Client();
        $convenio = $client->request(
            'GET',
            $this->hostname . ':8383/routing/' . $ref_factura,
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
        $formato_pago = $client->request(
            'GET',
            $this->hostname . ':8484/transform',
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    'id_convenio' => $convenio->id,
                    'tipo_servicio' => $convenio->tipo_servicio,
                    'metodo_facturacion' => $request->method(),
                    'ref_factura' => $ref_factura,
                    'valor_pagar' => $valor_pagar,
                    'endpoint' => $convenio->endpoint
                ]
            ]
        );


        $formato_pago = json_decode($formato_pago->getBody());

     

//fin llamado transform


//llamado dispatching

        $client = new \GuzzleHttp\Client();
        $respuesta = $client->request(
            'POST',
            $this->hostname . ':8585/dispatching',
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ],
                'json' => [
                    'ref_factura' => $ref_factura,
                    'convenio' => $convenio,
                    'formato_pago' => $formato_pago,
                    'metodo' => $request->method()
                ]
            ]
        );


        return $respuesta->getBody();
    }
}
