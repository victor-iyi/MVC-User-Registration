<?php
session_start();

require_once 'app/lib/config.php';
require_once 'app/models/Database.php';
require_once 'app/lib/helpers/functions.php';

class User extends Controller
{
  public function index()
  {
    $users = $this->model('Users');
    $this->view('user/index', ['isLoggedIn' => $users->isLoggedIn()]);
  }

  public function register()
  {
    $users = $this->model('Users');
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      // retrieve inputs
      if ( !empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) ) {
        $users->firstname = htmlspecialchars(trim($_POST['firstname']));
        $users->lastname = htmlspecialchars(trim($_POST['lastname']));
        $users->username = htmlspecialchars(trim($_POST['username']));
        $users->password = password_hash(htmlspecialchars(trim($_POST['password'])), PASSWORD_BCRYPT);
      } else {
        $status = 'Please fill in all fields.';
        $this->view('user/register', ['status' => $status]);
        return;
      }
      // check username existence
      if ( !$users->userExists() ) {
        $status = 'Sorry, that username is already taken.';
        $this->view('user/register', ['status' => $status]);
        return;
      } else {
        if ( $users->register() )
          $users->login();
      }
    }
    $this->view('user/register');
  }

  public function login()
  {
    $users = $this->model('Users');
    // redirects the user if already logged in
    if ( $users->isLoggedIn() ) header("Location: ../");
    // processes the user login form
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
      $users->username = trim( $_POST['username'] );
      $users->password = trim( $_POST['password'] );
      if ( !$users->validateUser() ) {
        $status = 'Please enter a valid username and password';
        $this->view('user/login', ['status' => $status]);
        return;
      } else {
        // log the user in
        $users->login();
      }
    }
    $this->view('user/login');
  }

  public function logout()
  {
    $users = $this->model('Users');
    $users->logout();
  }
}
