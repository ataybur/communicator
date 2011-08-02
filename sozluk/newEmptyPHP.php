<?php

class sozluk{
    public function create_database($db_name){
$con = mysql_connect("localhost","root","050389");
if (!$con)
  die('Could not connect: ' . mysql_error());
if (mysql_query("CREATE DATABASE ".$db_name,$con))
  echo "Database created";
else
  echo "Error creating database: ".mysql_error();
mysql_close($con);
    }

    public function create_table($tbl_name,$clmn_name,$id_name){
  $con = mysql_connect("localhost","root","050389");
  if (!$con)
  die('Could not connect: ' . mysql_error());
  mysql_select_db("koksozluk_db", $con);

  if (mysql_query("CREATE TABLE ".$tbl_name."(
    ".$id_name." INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ".$clmn_name." VARCHAR(40)
    )",$con))
  echo "Table kokler created"."<br />";
else
  echo "Error creating table kokler: " . mysql_error()."<br />";


    }
    public function insert_into($tbl_name,$value){}
    public function insert_into($tbl_name,$clmn_name,$value){
        $con = mysql_connect("localhost","root","050389");
if (!$con)
  die('Could not connect: ' . mysql_error());
$result=mysql_query("SELECT * FROM ".$tbl_name);
while($row=mysql_fetch_array($result))
    $arr[]=$row["'".$clmn_name."'"];

    $arr=array();
    $value=strtoupper($value);
    if(!in_array($value,$arr))
if (mysql_query("INSERT INTO ".tbl_name." (".$clmn_name.") values (upper('".$value."'))"))
  {
     echo "INSERT INTO done";
  }
  else "Error INSERT INTO: ".mysql_error();
  else "the table already include ".$value;


mysql_close($con);
    }
 
    public function delete_row($tbl_name,$clmn_name){}
    public function delete_row($tbl_name,$clmn_name,$condition){
                $con = mysql_connect("localhost","root","050389");
if (!$con)
  die('Could not connect: ' . mysql_error());

if(mysql_query("DELETE FROM ".$tbl_name." WHERE ".$clmn_name.$condition))
    echo "delete done";
else
    echo "error delete";

  mysql_close($con);

    }



}
$kok=strtoupper('nice');
$arr=array();
$con = mysql_connect("localhost","root","050389");
if (!$con)
  {
  die('Could not connect: ' . mysql_error())."<br />";
  }
mysql_query("CREATE DATABASE koksozluk_db",$con);
 

  mysql_select_db("koksozluk_db", $con);

  if (mysql_query("CREATE TABLE kokler(
    kok_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    kok VARCHAR(40)
    )",$con))
  {
  echo "Table kokler created"."<br />";
  }
else
  {
  echo "Error creating table kokler: " . mysql_error()."<br />";
  }
 if (mysql_query("CREATE TABLE sozcukler(
    sozcuk_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sozcuk VARCHAR(100)
    )",$con))
  {
  echo "Table sozcukler created"."<br />";
  }
else
  {
  echo "Error creating table sozcukler: " . mysql_error()."<br />";
  }
  
$result=mysql_query("SELECT * FROM kokler");
while($row=mysql_fetch_array($result)){
    echo $row['kok_id']." ".$row['kok']."<br />";
    $arr[]=$row['kok'];
}
print_r($arr);
/*
if(mysql_query("DELETE FROM kokler WHERE kok_id<>1"))
    echo "delete done";
else
    echo "error delete";
*/
if(!in_array($kok,$arr))
if (mysql_query("INSERT INTO kokler (kok) values (upper('".$kok."'))"))
  {
     echo "INSERT INTO done";
  }
  else "Error INSERT INTO: ".mysql_error();
  else "the table already include ".$kok;


mysql_close($con);

?>

