<?php
// sessionManager.php

class session
{

  public function __construct()
  {
    if (session_status() == PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function isEmployeeLoggedIn()
  {
    return isset($_SESSION['empleado']);
  }

  public function destroySession()
  {
    session_destroy();
  }
}