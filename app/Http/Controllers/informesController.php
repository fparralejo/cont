<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;

use App\oferta;
use App\seguimiento;


use Illuminate\Http\Request;

class informesController extends Controller {

	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

        
        //OK
	public function infUltdias($dias)
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }

            //var_dump($dias);die;

            //fecha menos $dias
            $fecha=date('d/m/Y',mktime(0,0,0,date('m'),date('d')-$dias,date('Y')));
            $fecha=explode('/',$fecha);
            $fechaF=$fecha[2].'-'.$fecha[1].'-'.$fecha[0].' 00:00:00';
            
            $result = \DB::table('contfpp_movimientos_final')->leftjoin('contfpp_deudores','contfpp_deudores.IdDeu','=','contfpp_movimientos_final.Deudor')
                                                          ->leftjoin('contfpp_motivos','contfpp_motivos.IdMot','=','contfpp_movimientos_final.Motivo')
                                                          ->leftjoin('contfpp_movimientos','contfpp_movimientos.IdMov','=','contfpp_movimientos_final.Movimiento')
                                                          ->where("contfpp_movimientos_final.Fecha",'>=',"$fechaF")
                                                          ->get(array("contfpp_motivos.motivo",\DB::raw("IF(contfpp_movimientos.movimiento='Ingreso',contfpp_movimientos_final.Euros,0) AS Ingreso"),
                                                                      \DB::raw("IF(contfpp_movimientos.movimiento='Gasto',contfpp_movimientos_final.Euros,0) AS Gasto"),'contfpp_deudores.deudor'));
            
            
            
        
        
            $resultadoInt = array();
            foreach ($result as $key => $value) {
                $resultadoInt[$key]['motivo'] = $value->motivo;
                $resultadoInt[$key]['Ingreso'] = $value->Ingreso;
                $resultadoInt[$key]['Gasto'] = $value->Gasto;
                $resultadoInt[$key]['deudor'] = $value->deudor;
            }         

            $arResult='';
            //resulmir por motivos
            foreach($resultadoInt as $motivo){
                //compruebo si $resultado tiene algun dato (es array)
                if(is_array($arResult)){
                    //si lo es
                    //compruebo si existe este motivo
                    $encontrado='NO';
                    //recorro el array $resultado y  veo si hay algun motivo con el mismo nombre que $motivo[motivo]
                    for($i=0;$i<count($arResult);$i++){
                        if($motivo['motivo']===$arResult[$i]['motivo']){
                            //si lo hay le sumo los valores
                            $arResult[$i]['Ingreso']=$arResult[$i]['Ingreso']+$motivo['Ingreso'];
                            $arResult[$i]['Gasto']=$arResult[$i]['Gasto']+$motivo['Gasto'];
                            //y salgo del bucle
                            $encontrado='SI';
                            break;
                        }
                    }
                    //ahora compruebo si en el anterior bucle se encontro o no
                    if($encontrado==='NO'){
                        //añado un nuevo registro con este motivo
                        $arResult[]=array(
                            "motivo"=>$motivo['motivo'],
                            "Ingreso"=>$motivo['Ingreso'],
                            "Gasto"=>$motivo['Gasto'],
                            "deudor"=>$motivo['deudor'],
                        );
                    }
                }else{
                    $arResult[]=array(
                        "motivo"=>$motivo['motivo'],
                        "Ingreso"=>$motivo['Ingreso'],
                        "Gasto"=>$motivo['Gasto'],
                        "deudor"=>$motivo['deudor'],
                    );
                }
            }
            
            //var_dump($arResult);die;
        
            return view('asientos.informedias')->with('arResult',$arResult)->with('dias',$dias); 
        }
        
        //OK
        public function infMesesYear($year)
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }

            $datos = $this->calculoMesesYear($year);
            
            //var_dump($datos);die;

            return view('asientos.informeejercicio')->with('arResult',$datos);
        }

        public function calculoMesesYear($year)
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }

            $result=\DB::table('contfpp_movimientos_final')->leftjoin('contfpp_deudores','contfpp_deudores.IdDeu','=','contfpp_movimientos_final.Deudor')
                                                          ->leftjoin('contfpp_motivos','contfpp_motivos.IdMot','=','contfpp_movimientos_final.Motivo')
                                                          ->leftjoin('contfpp_movimientos','contfpp_movimientos.IdMov','=','contfpp_movimientos_final.Movimiento')
                                                          ->where(\DB::raw("DATE_FORMAT(contfpp_movimientos_final.Fecha,'%Y')"),'=',"$year")
                                                          ->get(array(\DB::raw("DATE_FORMAT(contfpp_movimientos_final.Fecha,'%m') AS Mes"),\DB::raw("IF(contfpp_movimientos.movimiento='Ingreso',contfpp_movimientos_final.Euros,0) AS Ingreso"),
                                                                      \DB::raw("IF(contfpp_movimientos.movimiento='Gasto',contfpp_movimientos_final.Euros,0) AS Gasto")));

            $resultadoInt = array();
            foreach ($result as $key => $value) {
                $resultadoInt[$key]['Mes'] = $value->Mes;
                $resultadoInt[$key]['Ingreso'] = $value->Ingreso;
                $resultadoInt[$key]['Gasto'] = $value->Gasto;
            }         

            //ahora hago la suma de ingreso y gasto por meses
            $mes=array(
                "Ingreso"=>0,
                "Gasto"=>0
            );
            $datos=array(
                "Ejercicio"=>$year,
                "Enero"=>$mes,
                "Febrero"=>$mes,
                "Marzo"=>$mes,
                "Abril"=>$mes,
                "Mayo"=>$mes,
                "Junio"=>$mes,
                "Julio"=>$mes,
                "Agosto"=>$mes,
                "Septiembre"=>$mes,
                "Octubre"=>$mes,
                "Noviembre"=>$mes,
                "Diciembre"=>$mes
            );

            //ahora recorro todos los rows y voy sumando segun el mes que sea y si es ingreso o gasto
            for($i=0;$i<count($resultadoInt);$i++){
                if($resultadoInt[$i]['Mes']==='01'){//Enero
                    $datos['Enero']['Ingreso']=$datos['Enero']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Enero']['Gasto']=$datos['Enero']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='02'){//Febrero
                    $datos['Febrero']['Ingreso']=$datos['Febrero']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Febrero']['Gasto']=$datos['Febrero']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='02'){//Febrero
                    $datos['Febrero']['Ingreso']=$datos['Febrero']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Febrero']['Gasto']=$datos['Febrero']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='03'){//Marzo
                    $datos['Marzo']['Ingreso']=$datos['Marzo']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Marzo']['Gasto']=$datos['Marzo']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='04'){//Abril
                    $datos['Abril']['Ingreso']=$datos['Abril']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Abril']['Gasto']=$datos['Abril']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='05'){//Mayo
                    $datos['Mayo']['Ingreso']=$datos['Mayo']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Mayo']['Gasto']=$datos['Mayo']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='06'){//Junio
                    $datos['Junio']['Ingreso']=$datos['Junio']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Junio']['Gasto']=$datos['Junio']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='07'){//Julio
                    $datos['Julio']['Ingreso']=$datos['Julio']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Julio']['Gasto']=$datos['Julio']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='08'){//Agosto
                    $datos['Agosto']['Ingreso']=$datos['Agosto']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Agosto']['Gasto']=$datos['Agosto']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='09'){//Septiembre
                    $datos['Septiembre']['Ingreso']=$datos['Septiembre']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Septiembre']['Gasto']=$datos['Septiembre']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='10'){//Octubre
                    $datos['Octubre']['Ingreso']=$datos['Octubre']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Octubre']['Gasto']=$datos['Octubre']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='11'){//Noviembre
                    $datos['Noviembre']['Ingreso']=$datos['Noviembre']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Noviembre']['Gasto']=$datos['Noviembre']['Gasto']+$resultadoInt[$i]['Gasto'];
                }else if($resultadoInt[$i]['Mes']==='12'){//Diciembre
                    $datos['Diciembre']['Ingreso']=$datos['Diciembre']['Ingreso']+$resultadoInt[$i]['Ingreso'];
                    $datos['Diciembre']['Gasto']=$datos['Diciembre']['Gasto']+$resultadoInt[$i]['Gasto'];
                }
            }

            return $datos;
        }

        
        
        //******************************************
        //OK
	public function seguimientoShow()
        {
            $seguimiento = seguimiento::find(Input::get('id_seguimiento'));
            
            //cambio el formato de la fecha
            $seguimiento->fecha = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$seguimiento->fecha)->format('d/m/Y');

            //devuelvo la respuesta al send
            echo json_encode($seguimiento);
        }

        //OK
	public function seguimientoDelete(){
            $seguimiento = seguimiento::find(Input::get('id_seguimiento'));
            $IdSeg = $seguimiento->id_seguimiento;

            $seguimiento->estado = "0";

            if($seguimiento->save()){
                echo "Seguimiento ". $IdSeg ." borrado correctamente.";
            }else{
                echo "Seguimiento ". $IdSeg ." NO ha sido borrado.";
            }
	}
        
        //OK
        public function seguimientoCreateEdit(Request $request){
            //echo $request->id_seguimiento;die;
            
            //si es nuevo este valor viene vacio
            if($request->id_seguimiento === ""){
                $seguimiento = new seguimiento();
                $ok = 'Se ha dado de alta correctamente el seguimiento.';
                $error = 'ERROR al dar de alta el seguimiento.';
            }
            //sino se edita este id_oferta
            else{
                $seguimiento = seguimiento::find($request->id_seguimiento);
                $ok = 'Se ha editado correctamente el seguimiento.';
                $error = 'ERROR al edtar el seguimiento.';
            }

            //$seguimiento->id_seguimiento = $request->id_seguimiento;

            //compruebo que la fecha no venga vacia, si es asi saco la fecha de hoy
            $fecha = $request->fecha;
            if($fecha === ''){
                $fecha = date('d/m/Y');
            }
            $fecha = \Carbon\Carbon::createFromFormat('d/m/Y',$fecha)->format('Y-m-d H:i:s');
            $seguimiento->fecha = $fecha;
            
            $seguimiento->tipo = $request->tipo;
            $seguimiento->contacto = $request->contacto;
            $seguimiento->telefono = $request->telefono;
            $seguimiento->email = $request->email;
            $seguimiento->seguimiento = $request->seguimiento1;
            $seguimiento->id_oferta = $request->id_oferta;
            $seguimiento->estado = "1";

            //var_dump($seguimiento);die;
            
            if($seguimiento->save()){
                return redirect('seguimiento/'.$request->id_oferta)->with('errors', $ok);
            }else{
                return redirect('seguimiento/'.$request->id_oferta)->with('errors', $error);
            }
        }
        
        

	
}
