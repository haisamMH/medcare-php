<?php
  session_start();
  $_SESSION['userSession'] = false;
  session_destroy();
  header("location:index.php");