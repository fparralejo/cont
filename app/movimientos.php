<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class movimientos extends Model {

	protected $table = 'contfpp_movimientos';

	protected $primaryKey = "IdMov";

	public $timestamps = false;

}
