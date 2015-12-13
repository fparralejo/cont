<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model {

	protected $table = 'contfpp_usuarios';

	protected $primaryKey = "IdUsu";

	public $timestamps = false;
        
}
