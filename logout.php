<?php

  session_start();

  if (isset($_SESSION['username'])) {
      session_destroy();
      session_unset();
      $_SESSION = array();
  }

  header("Location: index.php");
