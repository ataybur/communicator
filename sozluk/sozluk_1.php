<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sozlukClass
 *
 * @author burak
 */
class sozluk_1 {

    private $con;

    public function connect_db() {
        $this->con = mysql_connect("localhost", "root", "050389");
        if (!$this->con)
            die('Could not connect: ' . mysql_error());
    }

    public function create_database($db_name) {

        if (mysql_query("CREATE DATABASE " . $db_name, $this->con))
            echo "Database created";
        else
            echo "Error creating database: " . mysql_error();
    }

    public function select_db($db_name) {
        mysql_select_db($db_name, $this->con);
    }

    public function create_table($tbl_name, $clmn_name, $id_name) {

        if (mysql_query("CREATE TABLE " . $tbl_name . "(
    " . $id_name . " INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    " . $clmn_name . " VARCHAR(70)
    )", $this->con))
            echo "Table kokler created" . "<br />";
        else
            echo "Error creating table kokler: " . mysql_error() . "<br />";
    }

    public function create_table2($tbl_name, $id1_name, $id2_name) {



        if (mysql_query("CREATE TABLE " . $tbl_name . "(
    " . $id1_name . " INT,
    " . $id2_name . " INT
    )", $this->con))
            echo "Table " . $tbl_name . " created" . "<br />";
        else
            echo "Error creating table " . $tbl_name . mysql_error() . "<br />";
    }

    public function insert_into($tbl_name, $clmn_name, $value,$alphnum) {
        $arr = array();
        $is_it_alphnum;
        if($alphnum=='alphnum')
            $is_it_alphnum=strlen($value)>1 && ctype_alnum($value)==TRUE;
        else $is_it_alphnum=strlen($value)>1;
        if($is_it_alphnum)
        {
        $result = mysql_query("SELECT * FROM " . $tbl_name);
        while ($row = mysql_fetch_array($result))
            $arr[] = $row[$clmn_name];



        $value = strtoupper($value);

        if (!in_array($value, $arr))
            if (mysql_query("INSERT INTO " . $tbl_name . " (" . $clmn_name . ") values (upper('" . $value . "'))")) {
                //echo "INSERT INTO done";
            }
            else
                "Error INSERT INTO: ".mysql_error();
        else
            "the table already include ".$value;
        unset($arr);
        }
    }

    public function insert_ids($tbl_name, $value1, $value2) {
        $result = mysql_query("SELECT kok_id FROM kokler where kok=upper('" . $value1 . "')");
        $arr = array();

        $row = mysql_fetch_array($result);
        $arr[] = $row['kok_id'];

        $result = mysql_query("SELECT sozcuk_id FROM sozcukler where sozcuk=upper('" . $value2 . "')");
        $row = mysql_fetch_array($result);
        $arr[] = $row['sozcuk_id'];

        mysql_query("INSERT INTO " . $tbl_name . " values (" . $arr[0] . "," . $arr[1] . ")    ");
    }

    public function drop_db($db_name) {
        if (mysql_query("DROP DATABASE " . $db_name))
            echo "drop done";
        else
            echo "error delete";
    }

    public function delete_row($tbl_name, $clmn_name, $condition) {


        if (mysql_query("DELETE FROM " . $tbl_name . " WHERE " . $clmn_name . $condition))
            echo "delete done";
        else
            echo "error delete";
    }

    public function close_db() {
        mysql_close($this->con);
    }

    public function print_table($tbl_name, $value1, $value2) {
        $result = mysql_query("SELECT * FROM " . $tbl_name);
        while ($row = mysql_fetch_array($result))
            echo $row[$value1] . " " . $row[$value2] . "<br />";
    }

}

?>
