<?php
static $DB_HOST="localhost";    
static $DB_NAME="uva";
static $DB_USER="root";
static $DB_PASS="Amola106";
global $mysqli;
if(($mysqli=mysqli_connect($DB_HOST,$DB_USER,$DB_PASS))==NULL)
    print("Error");
mysqli_query($mysqli,"set names utf8");
mysqli_select_db($mysqli,$DB_NAME);
date_default_timezone_set("PRC");
mysqli_query($mysqli,"SET time_zone = ' + 8:00'");
?>