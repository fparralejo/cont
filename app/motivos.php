<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class motivos extends Model {

    protected $table = 'contfpp_motivos';

    protected $primaryKey = "IdMot";

    public $timestamps = false;
        
//    //relacion con motivos
//    public function movFinal()
//    {
//        return $this->hasOne('App\movimientosfinal','Motivo');
//    }
}
