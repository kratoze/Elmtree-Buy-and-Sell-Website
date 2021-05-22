<?php

  $host = "pvernon04.lampt.eeecs.qub.ac.uk";
  $user = "pvernon04";
  $pw = "7Gty78XkqkTGSzTd";
  $db = "pvernon04";

  $conn = new mysqli($host, $user, $pw, $db);
  //$conn->set_charset("utf8");

  if ($conn->connect_error) {
      $check = "Not connected ". $conn->connect_error;
  } else {
      $check = "Connected to your database";
  }
