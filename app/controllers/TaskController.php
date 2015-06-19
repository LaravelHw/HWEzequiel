<?php

class TaskController extends BaseController {

  public function assignTask(){
    $data = Input::only(['folio','oficioReferencia','descripcion']);

    $task = Task::create($data);

    return View::make('auth/dash');


  }

}
