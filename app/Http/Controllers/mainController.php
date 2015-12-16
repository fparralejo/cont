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

        
        //OK
	public function main()
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            
            //extraigo el listado de contfpp_movimientos_final
            //$mfinal = movimientosfinal::where('Fecha','>=',date('Y').'-01-01 00:00:00')->get();
            $mfinal = movimientosfinal::where('Fecha','>=',date('Y-m-d H:i:s', strtotime('-1 year')))->get();
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
        public function motivoCreate(Request $request){
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            //busco si existe o no este motivo, si existe no se debe dar de alta e indicarlo
            $existeMotivo = motivos::where('motivo','=',$request->motivo)->count();
            if($existeMotivo>0){
                return redirect('main')->with('errors', 'ERROR: este motivo YA existe');
            }else{
                $motivo = new motivos();
                $motivo->motivo = $request->motivo;

                if($motivo->save()){
                    return redirect('main')->with('errors', 'Se ha dado de alta correctamente un nuevo motivo.');
                }else{
                    return redirect('main')->with('errors', 'ERROR: al dar de alta un motivo nuevo.');
                }
            }
        }


        //OK
        public function listadoDeudores(){
            $term = Input::get('term');
            
            $listarDeudores = deudores::where('deudor','LIKE','%'.$term.'%')->get();
            
            //pasarlo a JSON
            //primero lo paso a array
            $listar = "";
            foreach ($listarDeudores as $deudor) {
                $listar[] = array("value"=>$deudor->deudor);
            }
            
            //devuelvo el array en JSON
            echo json_encode($listar);
        }
        
        //OK
        public function existeDeudor(){
            $existeDeudor = deudores::where('deudor','=',Input::get('deudor'))->count();
            
            if($existeDeudor>0){
                echo "SI";
            }else{
                echo "NO";
            }
        }

        //OK
        public function deudorCreate(Request $request){
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            //busco si existe o no este motivo, si existe no se debe dar de alta e indicarlo
            $existeDeudor = deudores::where('deudor','=',$request->deudor)->count();
            if($existeDeudor>0){
                return redirect('main')->with('errors', 'ERROR: este deudor YA existe');
            }else{
                $deudor = new deudores();
                $deudor->deudor = $request->deudor;

                if($deudor->save()){
                    return redirect('main')->with('errors', 'Se ha dado de alta correctamente un nuevo editor.');
                }else{
                    return redirect('main')->with('errors', 'ERROR: al dar de alta un editor nuevo.');
                }
            }
        }
        
        //OK
	public function mainShow()
        {
            $movimientosfinal = movimientosfinal::find(Input::get('Id'));
            //relacion con motivos
            $motivo = movimientosfinal::find(Input::get('Id'))->motivo;
            //relacion con deudores
            $deudor = movimientosfinal::find(Input::get('Id'))->deudor;
            
            //preparo array para devolver datos
            $datos['Id'] = $movimientosfinal->Id;
            $datos['Fecha'] = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$movimientosfinal->Fecha)->format('d/m/Y');
            $datos['Movimiento'] = $movimientosfinal->Movimiento;
            $datos['Motivo'] = $motivo[0]->motivo;
            $datos['Euros'] = $movimientosfinal->Euros;
            $datos['Deudor'] = $deudor[0]->deudor;
            

            //devuelvo la respuesta al send
            echo json_encode($datos);
        }

        //OK
	public function mainDelete(){
            $asiento = movimientosfinal::find(Input::get('Id'));
            $Id = $asiento->Id;

            if($asiento->delete()){
                echo "Asiento ". $Id ." borrado.";
            }else{
                echo "Asiento ". $Id ." NO ha sido borrado.";
            }
	}
        
        //OK
        public function mainCreateEdit(Request $request){
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            
            //si es nuevo este valor viene vacio
            if($request->Id === ""){
                $asiento = new movimientosfinal();
                $ok = 'Se ha dado de alta correctamente el asiento.';
                $error = 'ERROR al dar de alta el asiento.';
            }
            //sino se edita este Id
            else{
                $asiento = movimientosfinal::find($request->Id);
                $ok = 'Se ha editado correctamente el asiento.';
                $error = 'ERROR al edtar el asiento.';
            }

            //compruebo que la fecha no venga vacia, si es asi saco la fecha de hoy
            $fecha = $request->fecha;
            if($fecha === ''){
                $fecha = date('d/m/Y');
            }
            $fecha = \Carbon\Carbon::createFromFormat('d/m/Y',$fecha)->format('Y-m-d H:i:s');
            $asiento->Fecha = $fecha;
            
            $asiento->Movimiento = $request->movimientos;
            $asiento->Euros = $request->euros;
            
            //ahora busco el IdMot segun su motivo
            $motivo = motivos::where('motivo','=',$request->motivos)->get();
            //var_dump($motivo[0]->IdMot);die;
            $asiento->Motivo = $motivo[0]->IdMot;
            
            //ahora busco el IdDeu segun su deudor
            $deudor = deudores::where('deudor','=',$request->deudor)->get();
            $asiento->Deudor = $deudor[0]->IdDeu;
            
            if($asiento->save()){
                return redirect('main')->with('errors', $ok);
            }else{
                return redirect('main')->with('errors', $error);
            }
        }
        
        

	
}
