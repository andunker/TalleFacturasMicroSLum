<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculoController extends Controller
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
        $res = $client->request(
            'GET',
            'http://127.0.0.1:8000/api/routing/1',
            [
                'headers' => [
                    'Content-type' => 'application/json'
                ]
            ]
        );

        return ($res->getBody());

        //

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
