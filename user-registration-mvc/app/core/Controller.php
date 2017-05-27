<?php

class Controller
{

  // use model
  protected function model($model)
  {
    $modelFile = 'app/models/' . $model . '.php';
    if ( file_exists($modelFile) ) {
      require_once $modelFile;
      return new $model;
    }
  }

  // render views
  protected function view($view, $data=[])
  {
    extract($data);
    $viewFile = 'app/views/' . $view . '.php';
    if ( file_exists($viewFile) )
      require_once 'app/views/layout.php';
  }

}
