<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::create('usuarios', function(Blueprint $table)
//		{
//			$table->increments('id');
//			$table->string('nombre');
//			$table->string('apellidos');
//			$table->string('email')->unique();
//			$table->string('direccion');
//			$table->integer('telefono');
//			$table->integer('rol');
//			$table->string('password', 60);
//			$table->timestamps();
//		});
                
                
		Schema::create('ofertas', function(Blueprint $table)
		{
			$table->increments('id_oferta');
			$table->string('oferta', 100);
			$table->longText('descripcion');
			$table->string('empresa', 75);
			$table->string('telefono', 20)->nullable();
			$table->string('email', 100)->nullable();
			$table->string('url', 200)->nullable();
			$table->string('tipo_contrato', 30)->nullable();
			$table->string('duracion', 25)->nullable();
			$table->string('jornada', 25)->nullable();
			$table->string('salario', 20)->nullable();
			$table->dateTime('fecha');
			$table->integer('id_usuario');
//			$table->timestamps();
		});
                
		Schema::create('seguimientos', function(Blueprint $table)
		{
			$table->increments('id_seguimiento');
			$table->dateTime('fecha');
			$table->string('tipo', 25);//llamada, email, etc..
			$table->string('contacto', 50);
			$table->string('telefono', 20)->nullable();
			$table->string('email', 100)->nullable();
			$table->longText('seguimiento');
			$table->integer('id_oferta');
		});
                
		Schema::create('entrevistas', function(Blueprint $table)
		{
			$table->increments('id_entrevista');
			$table->dateTime('fecha');
			$table->string('lugar', 100);
			$table->string('contacto', 50);
			$table->string('telefono', 20)->nullable();
			$table->string('email', 100)->nullable();
			$table->longText('entrevista');
			$table->integer('id_oferta');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::drop('usuarios');		
		Schema::drop('ofertas');		
		Schema::drop('seguimientos');		
		Schema::drop('entrevistas');		
	}

}
