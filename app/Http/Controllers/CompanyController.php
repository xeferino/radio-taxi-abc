<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\User;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('company.driver.index');
    }

    public function services()
    {
        $zulus = DB::table('zulu')->get();
        return view('company.driver.form_services', ['zulus' => $zulus]);
    }

    public function movil(Request $request)
    {
        $choferes = DB::table('movil chofer')->where('movil', $request->id)->get();
        $conductores = [];

        foreach ($choferes as $item) {

            if ($item->chofer1 == null or $item->chofer1 == "") {
                $chofer1 = "null";
            } else {
                $chofer1 = $item->chofer1;
            }
            if ($item->chofer2 == null or $item->chofer2 == "") {
                $chofer2 = "null";
            } else {
                $chofer2 = $item->chofer2;
            }
            if ($item->chofer3 == null or $item->chofer3 == "") {
                $chofer3 = "null";
            } else {
                $chofer3 = $item->chofer3;
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

    public function movilChofer(Request $request)
    {
        $choferes = DB::table('movil chofer')
                    ->where('chofer1',   Auth::user()->nombre)
                    ->orwhere('chofer2', Auth::user()->nombre)
                    ->orwhere('chofer3', Auth::user()->nombre)
                    ->get();
        $conductores = [];

        foreach ($choferes as $item) {

            if ($item->chofer1 == null or $item->chofer1 == "") {
                $chofer1 = "null";
            } else {
                $chofer1 = $item->chofer1;
            }
            if ($item->chofer2 == null or $item->chofer2 == "") {
                $chofer2 = "null";
            } else {
                $chofer2 = $item->chofer2;
            }
            if ($item->chofer3 == null or $item->chofer3 == "") {
                $chofer3 = "null";
            } else {
                $chofer3 = $item->chofer3;
            }
            array_push($conductores, [
                'movil'     => $item->movil,
                'id'        => $item->id,
                'chofer1'   => $chofer1,
                'chofer2'   => $chofer2,
                'chofer3'   => $chofer3,
            ]);
        }
        if (count($conductores) > 0) {
            return response()->json(['success' => true, 'movil' => Auth::user()->nombre, 'conductores' => $conductores, 'chofer' => $conductores[0]['movil']], 200);
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

    public function pacientes(Request $request)
    {
        $pacientes = DB::table('paciente')->get();
        return view('company.driver.pacientes', ['pacientes' => $pacientes]);
    }

    public function vale()
    {
        $vale = DB::select('SELECT (ifnull(max(CONVERT(vale, SIGNED INTEGER)), 0)+1) AS vale
                                FROM tblvales
                            WHERE vale REGEXP "^[0-9]+$"');
        if (count($vale) > 0) {
            return response()->json(['success' => true, 'vale' => $vale[0]->vale], 200);
        } else {
            return response()->json(['error' => true], 200);
        }
    }

    public function descuento($valor)
    {
        $descuento = (($valor * 1.5) / 100);
        return $descuento;
    }

    public function store(Request $request)
    {
        switch ($request->porcentaje) {
            case ($request->porcentaje == 100):

                $cal_porc_movil = (($request->valor * $request->porcentaje) / 100);

                if ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu != "INTEGRAL") {

                    $insert_1 = DB::table('convenios')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'zulu' => $request->zulu,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'zulu' => $request->zulu,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente, Vale ingresado exitosamente'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu == "INTEGRAL") {

                    $insert_1 = DB::table('clinica integral')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         'valor final' => $request->valor,
                         'pchofer' => $request->valor,
                         'pmovil' => '0',
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'zulu' => $request->zulu,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente en la tabla clinica integral. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu == "MUTUAL DE SEGURIDAD" && $request->zulu != "INTEGRAL") {

                    $insert_1 = DB::table('convenios mutual')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         'valor final' => $request->valor,
                         'paciente' => $request->paciente,
                         'run' => $request->run,
                         'pmovil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'zulu' => $request->zulu,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente en la tabla convenios mutual. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                }
                break;

            case ($request->porcentaje != 100):

                $cal_porc_chofer = (($request->valor * $request->porcentaje) / 100);
                $cal_porc_movil = $request->valor - $cal_porc_chofer;

                if ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu != "INTEGRAL") {

                    $insert_1 = DB::table('convenios')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'zulu' => $request->zulu,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         '%chofer' => $cal_porc_chofer,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                          'movil' => $request->movil,
                          'nro servicios' => '1',
                          'total zulu' => $request->valor,
                          'vale' => $request->vale,
                          'recorrido' => $request->recorrido,
                          'zulu' => $request->zulu,
                          '%chofer' => $cal_porc_chofer,
                          '%movil' => $cal_porc_movil
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente, Vale ingresado exitosamente'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu == "INTEGRAL") {

                    $insert_1 = DB::table('clinica integral')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         'valor final' => $request->valor,
                         'pchofer' => $request->valor,
                         'pmovil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'zulu' => $request->zulu,
                         '%chofer' => $cal_porc_chofer,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente en la tabla clinica integral. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu == "MUTUAL DE SEGURIDAD") {

                    $insert_1 = DB::table('convenios mutual')->insert([
                        ['movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'fecha' => $request->fecha,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'final zulu' => $request->valor,
                         'valor final' => $request->valor,
                         'paciente' => $request->paciente,
                         'run' => $request->run,
                         'pmovil' => $cal_porc_movil,
                         'pchofer' => $cal_porc_chofer,
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'zulu' => $request->zulu,
                         '%chofer' => $cal_porc_chofer,
                         '%movil' => $cal_porc_movil,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => $request->fecha,
                         'zulu' => $request->zulu,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'movil' => $request->movil,
                         'chofer' => $request->chofer,
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => $request->fecha,
                         'movil' => $request->movil,
                         'vale' => $request->vale,
                         'recorrido' => $request->recorrido,
                         'nro servicios' => '1',
                         'total zulu' => $request->valor,
                         'zulu' => $request->zulu,
                         'chofer' => $request->chofer,
                         'descuento' => $this->descuento($request->valor),
                         'ver' => '0',
                        ],
                    ]);

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'msg' => 'Datos ingresados correctamente en la tabla convenios mutual. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                }
                break;
        }
    }
}
