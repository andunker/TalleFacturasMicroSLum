<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\HomologacionFactura;
use App\SoapConvenio;

class TransformController extends Controller
{

    public $successStatus = 200;

    /** 
     * transform api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function transform(Request $request)
    {
        $id_convenio = $request->all()['id_convenio'];
        $tipo_servicio = $request->all()['tipo_servicio'];
        $metodo_facturacion = $request->all()['metodo_facturacion'];
        $ref_factura = $request->all()['ref_factura'];
        $valor_pagar = $request->all()['valor_pagar'];


        $homologacion_factura = HomologacionFactura::where('id_convenio', $id_convenio)->first();

        $nombre_id_referencia = json_decode($homologacion_factura)->nombre_id_referencia;
        $nombre_valor_pagar = json_decode($homologacion_factura)->nombre_valor_pagar;

        $variables = array($nombre_id_referencia => $ref_factura, $nombre_valor_pagar => $valor_pagar);

        if ($tipo_servicio == 'SOAP') {
          
            $soap_convenio = SoapConvenio::where('id_convenio', $id_convenio)->first();

          

            if ($metodo_facturacion == 'GET') {
                $accion = $soap_convenio->consultar_accion;
                $xml_beta = $soap_convenio->consultar_xml;
            } 
            
            elseif ($metodo_facturacion == 'POST') {
                $valor_pagar = $request->all()['valor_pagar'];
                $accion = $soap_convenio->pagar_accion;
                $xml_beta = $soap_convenio->pagar_xml;
            } 
            
            elseif ($metodo_facturacion == 'DELETE') {
                $valor_pagar = $request->all()['valor_pagar'];
                $accion = $soap_convenio->compensar_accion;
                $xml_beta = $soap_convenio->compensar_xml;
            }

            //

           

           

            foreach ($variables as $key => $value) {
                $xml_beta = str_replace('{' . $key . '}', $value, $xml_beta);
            }

            $xml= [
              'plantilla' =>  $xml_beta,
              'accion' => $accion,
              'valor_pagar' => $valor_pagar
            ];
            
            return json_encode($xml);

        } elseif ($tipo_servicio == 'REST') {

            $endpoint_beta = $request->all()['endpoint'];

            foreach ($variables as $key => $value) {
                $endpoint_beta = str_replace('{' . $key . '}', $value, $endpoint_beta);
            }


            $params_endpoint = [
                'plantilla' => '',
                'accion' => $endpoint_beta,
                'valor_pagar' => $valor_pagar
            ];

            return json_encode($params_endpoint);

        }

    }

}
