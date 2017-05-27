<?php

class Users
{
  public $firstname;
  public $lastname;
  public $username;
  public $password;

  public function validateUser()
  {
    $this->username = htmlspecialchars($this->username);
    $this->password = htmlspecialchars($this->password);

    if ( !empty($this->username) && !empty($this->password) ) {
      $db = new Database;
      $result = $db->query("SELECT password FROM users WHERE username=:username", ['username' => $this->username]);
      return ( $result->rowCount() > 0 ) ?
            password_verify($this->password, $result->fetch(PDO::FETCH_ASSOC)['password']) : false;
    }
    return false;
  }

  public function userExists()
  {
    $db = new Database;
    $result = $db->query("SELECT * FROM users WHERE username=:username", ['username' => $this->username]);
    return $result ? $result->rowCount() < 1 : true;
  }

  public function isLoggedIn()
  { return isset($_SESSION['username']); }

  public function login($redirect ='../')
  {
    $_SESSION['username'] = $this->username;
    header("Location: {$redirect}");
  }

  public function register()
  {
    $db = new Database;
    return  $db->insert('users', ['firstname' => $this->firstname, 'lastname' => $this->lastname, 'username' => $this->username, 'password' => $this->password]);
  }

  public function logout($redirect='../')
  {
    session_destroy();
    $_SESSION = [];
    header("Location: {$redirect}");
  }

}
