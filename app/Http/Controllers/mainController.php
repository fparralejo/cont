<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;

use App\movimientosfinal;
use App\movimientos;
use App\motivos;
use App\deudores;


use Illuminate\Http\Request;

class mainController extends Controller {

	
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


//	public function main_NO()
//	{
//        //control de sesion
//		$login = new loginController();
//        if (!$login->getControl()) {
//        	return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
//        }
//
//		return view('md.main'); 
//	}

        //OK
	public function main()
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            
            //extraigo el listado de contfpp_movimientos_final
            $mfinal = movimientosfinal::where('Fecha','>=',date('Y').'-01-01 00:00:00')->get();
            $movimientosI = movimientos::all();
            
            $movimientos='';
            foreach($movimientosI as $mov){
                    $movimientos[$mov->IdMov]=$mov->movimiento;
            }

            $motivosI = motivos::all();
            $motivos = '';
            foreach($motivosI as $mot){
                    $motivos[$mot->IdMot]=$mot->motivo;
            }

            $deudoresI = deudores::all();
            $deudores = '';
            foreach($deudoresI as $deu){
                    $deudores[$deu->IdDeu]=$deu->deudor;
            }

            return view('main')->with('mfinal',$mfinal)->with('movimientos',$movimientos)->with('motivos',$motivos)->with('deudores',$deudores)
                                ->with('motivosI',$motivosI)->with('deudoresI',$deudoresI);
        }

        //OK
        public function listadoMotivos(){
            $term = Input::get('term');
            
            $listarMotivos = motivos::where('motivo','LIKE','%'.$term.'%')->get();
            
            //pasarlo a JSON
            //primero lo paso a array
            $listar = "";
            foreach ($listarMotivos as $motivo) {
                $listar[] = array("value"=>$motivo->motivo);
            }
            
            //devuelvo el array en JSON
            echo json_encode($listar);
        }
        
        //OK
        public function existeMotivo(){
            
            $existeMotivo = motivos::where('motivo','=',Input::get('motivo'))->count();
            
            if($existeMotivo>0){
                echo "SI";
            }else{
                echo "NO";
            }
        }

        //OK
        public function nuevoMotivo(){
            return view('motivo.main');
        }

        //OK
        public function motivoCreateEdit(Request $request){
            echo "OK";die;
        }

        
        
        //NOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
	public function mainShow()
        {
            
            
//            $oferta = oferta::find(Input::get('id_oferta'));
//            
//            //cambio el formato de la fecha
//            $oferta->fecha = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$oferta->fecha)->format('d/m/Y');
//
//            //devuelvo la respuesta al send
//            echo json_encode($oferta);
        }

        //OK
	public function ofertasDelete(){
            $oferta = oferta::find(Input::get('id_oferta'));
            $IdOferta = $oferta->id_oferta;

            $oferta->estado = "0";

            if($oferta->save()){
                echo "Oferta ". $IdOferta ." borrada correctamente.";
            }else{
                echo "Oferta ". $IdOferta ." NO ha sido borrada.";
            }
	}
        
        //OK
        public function ofertasCreateEdit(Request $request){
            //echo "he llegado";die;
            
            //si es nuevo este valor viene vacio
            if($request->id_oferta === ""){
                $oferta = new oferta();
                $ok = 'Se ha dado de alta correctamente la oferta.';
                $error = 'ERROR al dar de alta la oferta.';
            }
            //sino se edita este id_oferta
            else{
                $oferta = oferta::find($request->id_oferta);
                $ok = 'Se ha editado correctamente la oferta.';
                $error = 'ERROR al edtar la oferta.';
            }

            $oferta->id_oferta = $request->id_oferta;
            $oferta->oferta = $request->oferta;
            $oferta->descripcion = $request->descripcion;
            $oferta->empresa = $request->empresa;
            $oferta->telefono = $request->telefono;
            $oferta->email = $request->email;
            $oferta->url = $request->url;
            $oferta->webtrabajo = $request->webtrabajo;
            $oferta->tipo_contrato = $request->tipo_contrato;
            $oferta->duracion = $request->duracion;
            $oferta->jornada = $request->jornada;
            $oferta->salario = $request->salario;
            
            //compruebo que la fecha no venga vacia, si es asi saco la fecha de hoy
            $fecha = $request->fecha;
            if($fecha === ''){
                $fecha = date('d/m/Y');
            }
            $fecha = \Carbon\Carbon::createFromFormat('d/m/Y',$fecha)->format('Y-m-d H:i:s');
            $oferta->fecha = $fecha;
            
            $oferta->cv_pdf = $request->cv_pdf;
            $oferta->id_usuario = Session::get('id');
            $oferta->estado = "1";

            //var_dump($oferta);die;
            
            if($oferta->save()){
                return redirect('ofertas')->with('errors', $ok);
            }else{
                return redirect('ofertas')->with('errors', $error);
            }
        }
        
        

	
}
