<?php

class App
{
  protected $controller = 'user';
  protected $method = 'index';
  protected $args = [];

  public function __construct()
  {
    $url = $this->parseURL();
    // controller
    if ( file_exists('app/controllers/' . $url[0] . '.php') ) {
      $this->controller = $url[0];
      unset($url[0]);
    }

    require_once 'app/controllers/' . $this->controller . '.php';
    $this->controller = new $this->controller;

    // method
    $url = $this->checkControllerMethod($url, (int)isset($url[1]));

    // args
    $this->args = $url ? array_values($url) : [];

    // call respective controller method
    call_user_func_array([$this->controller, $this->method], $this->args);
  }

  private function checkControllerMethod($url, $index)
  {
    if ( isset($url[$index]) && method_exists($this->controller, $url[$index]) ) {
      $this->method = $url[$index];
      unset($url[$index]);
    }
    return $url;
  }

  private function parseURL()
  {
    if ( isset($_GET['url']) )
      return explode('/', filter_var(rtrim($_GET['url'], '/') ,FILTER_SANITIZE_URL));
  }

}
