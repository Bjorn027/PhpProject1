<?php
function connectToDb(){
  $dbhost = "localhost";
  $dbname = "usermoney";
  $dbuser = "root";

  $con = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser);
  //Useful for debugging. Remove in production
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  return $con;
}