<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;

use App\oferta;
use App\webtrabajo;


use Illuminate\Http\Request;

class webController extends Controller {

	
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
            
            $listado = webtrabajo::where("id_usuario","=",Session::get('id'))
                                                 ->where("estado","=","1")
                                                 ->get();
            
            //var_dump($oferta);die;
            
            return view('web/main')->with('listado',$listado); 
        }

        //OK
	public function webShow()
        {
            $web = webtrabajo::find(Input::get('id_web'));
            
            //cambio el formato de la fecha
            $web->fecha = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$web->fecha)->format('d/m/Y');

            //devuelvo la respuesta al send
            echo json_encode($web);
        }

        //OK
	public function webDelete(){
            $web = webtrabajo::find(Input::get('id_web'));
            $IdWeb = $web->id_web;

            $web->estado = "0";

            if($web->save()){
                echo "Web de trabajo ". $IdWeb ." borrada correctamente.";
            }else{
                echo "Web de trabajo ". $IdWeb ." NO ha sido borrada.";
            }
	}
        
        //OK
        public function webCreateEdit(Request $request){
            //echo $request->id_seguimiento;die;
            
            //si es nuevo este valor viene vacio
            if($request->id_web === ""){
                $web = new webtrabajo();
                $ok = 'Se ha dado de alta correctamente la web de trabajo.';
                $error = 'ERROR al dar de alta la web de trabajo.';
            }
            //sino se edita este id_oferta
            else{
                $web = webtrabajo::find($request->id_web);
                $ok = 'Se ha editado correctamente la web de trabajo.';
                $error = 'ERROR al editar la web de trabajo.';
            }

            //$seguimiento->id_seguimiento = $request->id_seguimiento;

            //compruebo que la fecha no venga vacia, si es asi saco la fecha de hoy
            $fecha = $request->fecha;
            if($fecha === ''){
                $fecha = date('d/m/Y');
            }
            $fecha = \Carbon\Carbon::createFromFormat('d/m/Y',$fecha)->format('Y-m-d H:i:s');
            $web->fecha = $fecha;
            
            $web->nombre = $request->nombre;
            $web->url = $request->url;
            $web->usuario = $request->usuario;
            $web->pass = $request->pass;
            $web->id_web = $request->id_web;
            $web->id_usuario = Session::get('id');
            $web->estado = "1";

            //var_dump($seguimiento);die;
            
            if($web->save()){
                return redirect('web')->with('errors', $ok);
            }else{
                return redirect('seguimiento')->with('errors', $error);
            }
        }
}
