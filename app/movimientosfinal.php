<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class movimientosfinal extends Model {

    protected $table = 'contfpp_movimientos_final';

    protected $primaryKey = "Id";

    public $timestamps = false;


    //relacion con motivos
    public function motivo()
    {
        return $this->hasMany('App\motivos','IdMot','Motivo');
    }
    
    //relacion con deudores
    public function deudor()
    {
        return $this->hasMany('App\deudores','IdDeu','Deudor');
    }
}
