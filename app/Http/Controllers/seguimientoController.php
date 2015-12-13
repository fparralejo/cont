<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;

use App\oferta;
use App\seguimiento;


use Illuminate\Http\Request;

class seguimientoController extends Controller {

	
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
	public function main($id_oferta)
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }
            
            $listado = seguimiento::where("id_oferta","=",$id_oferta)
                                                 ->where("estado","=","1")
                                                 ->get();
            
            $oferta = oferta::where("id_oferta","=",$id_oferta)
                                                 ->where("estado","=","1")
                                                 ->get();
            //var_dump($oferta);die;
            
            return view('seguimiento/main')->with('listado',$listado)->with('oferta',$oferta); 
        }

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
