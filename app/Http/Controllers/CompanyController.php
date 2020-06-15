<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
class CompanyController extends Controller
{
    public function index()
    {
        return view('company.driver.index');
    }

    public function services()
    {
        $zulus = DB::table('zulu')->get();
        $vale = $this->vale();
        return view('company.driver.form_services', ['zulus' => $zulus, 'vale' => $vale]);
    }

    public function movil(Request $request)
    {
        $choferes = DB::table('movil chofer')->where('movil', $request->id)->get();
        $conductores = [];
            
            foreach ($choferes as $item) {
                
                if($item->chofer1==null or $item->chofer1==""){
                    $chofer1="null";
                }else{
                    $chofer1=$item->chofer1;
                }
                if($item->chofer2==null or $item->chofer2==""){
                    $chofer2="null";
                }else{
                    $chofer2=$item->chofer2;
                }
                if($item->chofer3==null or $item->chofer3==""){
                    $chofer3="null";
                }else{
                    $chofer3=$item->chofer3;
                }
                array_push($conductores, [
                    'movil' => $item->movil,
                    'id' => $item->id,
                    'chofer1' => $chofer1,
                    'chofer2' => $chofer2,
                    'chofer3' => $chofer3,
                    
                ]);
            }
        if (count($conductores) > 0) {
            return response()->json(['success' => true, 'choferes' => $conductores], 200);
        } else {
            return response()->json(['error' => true], 200);
        }
    }

    public function porcentaje(Request $request)
    {
        $porcentaje = DB::table('choferes')->select('porcentaje')->where('nombre', $request->chofer)->get();
        
        if (count($porcentaje) > 0) {
            return response()->json(['success' => true, 'porcentaje' => $porcentaje[0]], 200);
        } else {
            return response()->json(['error' => true], 200);
        }
    }

    public function vale()
    {
        $vale = DB::select('SELECT (ifnull(max(CONVERT(vale, SIGNED INTEGER)), 0)+1) AS vale
                                FROM tblvales 
                            WHERE vale REGEXP "^[0-9]+$"');
        return $vale[0]->vale;
    }
}
