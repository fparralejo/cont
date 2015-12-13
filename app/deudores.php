<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class deudores extends Model {

	protected $table = 'contfpp_deudores';

	protected $primaryKey = "IdDeu";

	public $timestamps = false;

}
