<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;

use App\oferta;
use App\entrevista;


use Illuminate\Http\Request;

class entrevistasController extends Controller {

	
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
            
            $listado = entrevista::where("id_oferta","=",$id_oferta)
                                                 ->where("estado","=","1")
                                                 ->get();
            
            $oferta = oferta::where("id_oferta","=",$id_oferta)
                                                 ->where("estado","=","1")
                                                 ->get();
            //var_dump($listado[0]);die;
            
            return view('entrevista/main')->with('listado',$listado)->with('oferta',$oferta); 
        }

        //OK
	public function entrevistaShow()
        {
            $entrevista = entrevista::find(Input::get('id_entrevista'));
            
            //cambio el formato de la fecha
            $entrevista->fecha = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$entrevista->fecha)->format('d/m/Y');

            //devuelvo la respuesta al send
            echo json_encode($entrevista);
        }

        //OK
	public function entrevistaDelete(){
            $entrevista = entrevista::find(Input::get('id_entrevista'));
            $IdEntrev = $entrevista->id_entrevista;

            $entrevista->estado = "0";

            if($entrevista->save()){
                echo "Entrevista ". $IdEntrev ." borrada correctamente.";
            }else{
                echo "Entrevista ". $IdEntrev ." NO ha sido borrada.";
            }
	}
        
        //OK
        public function entrevistaCreateEdit(Request $request){
            //echo $request->id_entrevista;die;
            
            //si es nuevo este valor viene vacio
            if($request->id_entrevista === ""){
                $entrevista = new entrevista();
                $ok = 'Se ha dado de alta correctamente la entrevista.';
                $error = 'ERROR al dar de alta la entrevista.';
            }
            //sino se edita este id_oferta
            else{
                $entrevista = entrevista::find($request->id_entrevista);
                $ok = 'Se ha editado correctamente la entrevista.';
                $error = 'ERROR al edtar la entrevista.';
            }

            //compruebo que la fecha no venga vacia, si es asi saco la fecha de hoy
            $fecha = $request->fecha;
            if($fecha === ''){
                $fecha = date('d/m/Y');
            }
            $fecha = \Carbon\Carbon::createFromFormat('d/m/Y',$fecha)->format('Y-m-d H:i:s');
            $entrevista->fecha = $fecha;
            
            $entrevista->lugar = $request->lugar;
            $entrevista->contacto = $request->contacto;
            $entrevista->telefono = $request->telefono;
            $entrevista->email = $request->email;
            $entrevista->entrevista = $request->entrevista1;
            $entrevista->id_oferta = $request->id_oferta;
            $entrevista->estado = "1";

            //var_dump($entrevista);die;
            
            if($entrevista->save()){
                return redirect('entrevistas/'.$request->id_oferta)->with('errors', $ok);
            }else{
                return redirect('entrevistas/'.$request->id_oferta)->with('errors', $error);
            }
        }
        
        

	
}
