<?php
class Sessionprocess {
  public function __construct() {
    session_start();
  }
  public function sessionSet() {
    session_start();
    if(!isset($_SESSION['flag'])){
      return FALSE;
    }
    else {
      return TRUE;
    }
  }
}
?>
