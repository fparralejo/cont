<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\oferta;
use Faker\Factory as Faker;

class UsuarioTableSeeder extends Seeder {

	public function run()
	{
            $faker = Faker::create();
            
            for ($index = 0; $index < 20; $index++) {
		oferta::create(array(
			"oferta"=>$faker->title,
			"descripcion"=>$faker->sentence(20),
			"empresa"=>$faker->company,
			"telefono"=>$faker->phoneNumber,
			"email"=>$faker->email,
			"url"=>$faker->url,
			"tipo_contrato"=>$faker->city,
			"duracion"=>$faker->text,
			"jornada"=>$faker->text,
			"salario"=>$faker->text,
			"fecha"=>$faker->dateTime,
			"id_usuario"=>1
		));
            }
	}

}