<?php namespace App\Http\Controllers;

use Session;
use Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\loginController;
use App\Http\Controllers\informesController;


use Illuminate\Http\Request;

class graficasController extends Controller {

	
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

        
        public function graficasMeses($yearI)
        {
            //control de sesion
            $login = new loginController();
            if (!$login->getControl()) {
                return redirect('/')->with('login_errors', '<font color="#ff0000">La sesión a expirado. Vuelva a logearse..</font>');
            }

            $informes = new informesController();
            
            $year = $informes->calculoMesesYear($yearI);

            //preparo los distintos datos a suministrar al grafico
            $meses = '';
            $gasto = '';
            $ingreso = '';

            //Enero
            $meses = $meses . "'Enero',";
            $gasto = $gasto . "" . $year['Enero']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Enero']['Ingreso'] . ",";
            //Febrero
            $meses = $meses . "'Febrero',";
            $gasto = $gasto . "" . $year['Febrero']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Febrero']['Ingreso'] . ",";
            //Marzo
            $meses = $meses . "'Marzo',";
            $gasto = $gasto . "" . $year['Marzo']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Marzo']['Ingreso'] . ",";
            //Abril
            $meses = $meses . "'Abril',";
            $gasto = $gasto . "" . $year['Abril']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Abril']['Ingreso'] . ",";
            //Mayo
            $meses = $meses . "'Mayo',";
            $gasto = $gasto . "" . $year['Mayo']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Mayo']['Ingreso'] . ",";
            //Junio
            $meses = $meses . "'Junio',";
            $gasto = $gasto . "" . $year['Junio']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Junio']['Ingreso'] . ",";
            //Julio
            $meses = $meses . "'Julio',";
            $gasto = $gasto . "" . $year['Julio']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Julio']['Ingreso'] . ",";
            //Agosto
            $meses = $meses . "'Agosto',";
            $gasto = $gasto . "" . $year['Agosto']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Agosto']['Ingreso'] . ",";
            //Septiembre
            $meses = $meses . "'Septiembre',";
            $gasto = $gasto . "" . $year['Septiembre']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Septiembre']['Ingreso'] . ",";
            //Octubre
            $meses = $meses . "'Octubre',";
            $gasto = $gasto . "" . $year['Octubre']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Octubre']['Ingreso'] . ",";
            //Noviembre
            $meses = $meses . "'Noviembre',";
            $gasto = $gasto . "" . $year['Noviembre']['Gasto'] . ",";
            $ingreso = $ingreso . "" . $year['Noviembre']['Ingreso'] . ",";
            //Diciembre
            $meses = $meses . "'Diciembre'";
            $gasto = $gasto . "" . $year['Diciembre']['Gasto'] . "";
            $ingreso = $ingreso . "" . $year['Diciembre']['Ingreso'] . "";


            return view('graficas.graficasMeses')->with('year',$yearI)->with('meses',$meses)->with('gasto',$gasto)->with('ingreso',$ingreso);
        }

    
    
}
