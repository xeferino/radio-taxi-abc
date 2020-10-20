<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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
            ->where('chofer1', Auth::user()->nombre)
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
                'movil' => $item->movil,
                'id' => $item->id,
                'chofer1' => $chofer1,
                'chofer2' => $chofer2,
                'chofer3' => $chofer3,
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

    public function cliente(Request $request)
    {
        $cliente = DB::table('clientes')->where('rut', $request->rut)->get();

        if (count($cliente) > 0) {
            return response()->json(['success' => true, 'cliente' => $cliente], 200);
        } else {
            return response()->json(['error' => true], 200);
        }
    }

    public function codigo(Request $request)
    {
        $cliente = DB::table('clientes')->where('codigo_validacion', $request->codigo)->where('rut', $request->rut)->get();

        if (count($cliente) > 0) {
            return response()->json(['success' => true, 'cliente' => $cliente], 200);
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

        $servicios =  array ();
        switch ($request->porcentaje) {
            case ($request->porcentaje == 100):

                $cal_porc_movil = (($request->valor * $request->porcentaje) / 100);

                if ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu != "INTEGRAL") {

                    $insert_1 = DB::table('convenios')->insert([
                        ['movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'zulu' => $request->zulu,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => 0,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente, Vale ingresado exitosamente'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }

                } elseif ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu == "INTEGRAL") {

                    $insert_1 = DB::table('clinica integral')->insert([
                        ['movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            'valor final' => $request->valor,
                            'pchofer' => $request->valor,
                            'pmovil' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => 0,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente en la tabla clinica integral. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu == "MUTUAL DE SEGURIDAD" && $request->zulu != "INTEGRAL") {

                    $insert_1 = DB::table('convenios mutual')->insert([
                        ['movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            'valor final' => $request->valor,
                            'paciente' => $request->paciente,
                            'run' => $request->run,
                            'pmovil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut,
                            'nombres_apellidos' => $request->nombre,
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => 0,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente en la tabla convenios mutual. Vale ingresado'], 200);
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
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'zulu' => $request->zulu,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            '%chofer' => $cal_porc_chofer,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%chofer' => $cal_porc_chofer,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => $item->pchofer,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente, Vale ingresado exitosamente'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }

                } elseif ($request->zulu != "MUTUAL DE SEGURIDAD" && $request->zulu == "INTEGRAL") {

                    $insert_1 = DB::table('clinica integral')->insert([
                        ['movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            'valor final' => $request->valor,
                            'pchofer' => $request->valor,
                            'pmovil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%chofer' => $cal_porc_chofer,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => $item->pchofer,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente en la tabla clinica integral. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                } elseif ($request->zulu == "MUTUAL DE SEGURIDAD") {

                    $insert_1 = DB::table('convenios mutual')->insert([
                        ['movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'fecha' => date("Y-m-d H:i:s"),
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'final zulu' => $request->valor,
                            'valor final' => $request->valor,
                            'paciente' => $request->paciente,
                            'run' => $request->run,
                            'pmovil' => $cal_porc_movil,
                            'pchofer' => $cal_porc_chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_2 = DB::table('resumen_zulus')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_3 = DB::table('resumen_movil')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'zulu' => $request->zulu,
                            '%chofer' => $cal_porc_chofer,
                            '%movil' => $cal_porc_movil,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_4 = DB::table('resumen_zulus_sin_1_5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'zulu' => $request->zulu,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'movil' => $request->movil,
                            'chofer' => $request->chofer,
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $insert_5 = DB::table('tblvales')->insert([
                        ['vale' => $request->vale],
                    ]);

                    $insert_6 = DB::table('pago_movil_1,5')->insert([
                        ['fecha' => date("Y-m-d H:i:s"),
                            'movil' => $request->movil,
                            'vale' => $request->vale,
                            'recorrido' => $request->recorrido,
                            'nro servicios' => '1',
                            'total zulu' => $request->valor,
                            'zulu' => $request->zulu,
                            'chofer' => $request->chofer,
                            'descuento' => $this->descuento($request->valor),
                            'ver' => '0',
                            'rut_cliente' => $request->rut_cliente0,
                            'nombres_apellidos' => $request->nombres_apellidos0,
                            'rut_cliente1' => $request->rut_cliente1,
                            'nombres_apellidos1' => $request->nombres_apellidos1,
                            'rut_cliente2' => $request->rut_cliente2,
                            'nombres_apellidos2' => $request->nombres_apellidos2,
                            'rut_cliente3' => $request->rut_cliente3,
                            'nombres_apellidos3' => $request->nombres_apellidos3
                        ],
                    ]);

                    $resumen = DB::table('resumen_zulus')
                                ->join('resumen_movil', 'resumen_zulus.vale', '=', 'resumen_movil.vale')
                                ->select('resumen_movil.total zulu AS total', 'resumen_movil.%chofer AS pchofer', 'resumen_movil.%movil AS pmovil',
                                         'resumen_movil.zulu AS zulu', 'resumen_movil.recorrido AS recorrido', 'resumen_movil.vale AS vale')
                                ->where('resumen_zulus.chofer', $request->chofer)
                                ->where('resumen_zulus.movil', $request->movil)
                                ->where('resumen_zulus.fecha', 'LIKE', '%' . date('Y-m-d') . '%')
                                ->get();

                    foreach ($resumen as $item) {

                        array_push($servicios, [
                            'pchofer' => $item->pchofer,
                            'pmovil' => $item->pmovil,
                            'total' => $item->total,
                            'vale' => $item->vale,
                            'zulu' => $item->zulu,
                            'recorrido' => $item->recorrido
                        ]);
                    }

                    if ($insert_1 && $insert_2 && $insert_3 && $insert_4 && $insert_5 && $insert_6) {
                        return response()->json(['success' => true, 'servicios' => $servicios, 'msg' => 'Datos ingresados correctamente en la tabla convenios mutual. Vale ingresado'], 200);
                    } else {
                        return response()->json(['error' => true], 200);
                    }
                }
                break;
        }
    }
}
