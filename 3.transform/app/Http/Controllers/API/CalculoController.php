<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalculoController extends Controller
{

    public $successStatus = 200;
    /** 
     * sumar api 
     * 
     * @return \Illuminate\Http\Response 
     */

    public function sumar(Request $request)
    {
        $a = $request['a'];
        $b = $request['b'];
        return $a + $b;
    }

    /** 
     * restar api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function restar(Request $request)
    {
        $a = $request['a'];
        $b = $request['b'];
        return $a - $b;
    }

    /** 
     * multiplicar api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function multiplicar(Request $request)
    {
        $a = $request['a'];
        $b = $request['b'];
        return $a * $b;
    }

    /** 
     * dividir api 
     * 
     * @return \Illuminate\Http\Response 
     */
    public function dividir(Request $request)
    {
        $a = $request['a'];
        $b = $request['b'];
        return $a / $b;
    }

}
