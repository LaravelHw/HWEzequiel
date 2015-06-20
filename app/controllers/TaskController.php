<?php

class TaskController extends BaseController {

  public function assignTask(){

$data=Input::all();
/*    $data = Input::only(['folio','oficioReferencia','descripcion']);*/

$rules = array(
        'folio'             => 'numeric|required|unique:tasks',
        'oficioReferencia'  => 'required',
        'descripcion'       => 'string|required'
        
    );
  
    $messages = array(
      'folio.unique'                => 'Folio duplicado.',
      'folio.required'              => 'El folio es obligatorio.',
      'oficioReferencia.required'   => 'El Oficio Referencia es obligatorio.',
      'descripcion.required'        => 'La descripcion es obligatorio.'

    );
   
    $validation = Validator::make($data, $rules, $messages);
   
    if ($validation->fails())
    {
      
        return Redirect::to('dash')->withErrors($validation);
 
    }else{
    $task = Task::create($data);

    return View::make('auth/dash');    	
    }

  }

  public function searchTask(){
    $search = Input::get('search');
    $searchTerms = explode(' ', $search);
    $query = DB::table('tasks');
    foreach($searchTerms as $term)
    {
        $query->where('folio', 'LIKE', '%'. $term .'%');
        $query->orwhere('descripcion', 'LIKE', '%'. $term .'%');
        $query->orwhere('oficioReferencia', 'LIKE', '%'. $term .'%');

    }
    $results = $query->get();
    return Response::json(array(
          'busqueda' =>  $results
        ));


  }


}
