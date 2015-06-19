<?php
class Tarea extends Eloquent {
/*autoriza asignacion masiva*/

	protected $fillable = ['folio','oficioReferencia','descripcion'];
	public $timestamps = false;
  
    public function user()
    {
    	return $this->belongsTo('User');
    }
  
}