<?php

include 'sozluk.php';
include 'search_ROOT.php';
$db_name = 'koksozluk_db';
$for_type = new Search_ROOT();
$database = new sozluk();
$database->connect_db();
//$database->create_database($db_name);
$database->select_db($db_name);
//$database->drop_table('turler');
//$database->drop_table('sozcuktur');
//$database->create_table('turler', 'tur', 'tur_id');
//$database->create_table2('sozcuktur', 'sozcuk_id', 'tur_id');
$array = $database->getResult('sozcukler', 'sozcuk', 0, 10000);
$paranthesis=array("(",")");
foreach ($array as $element)
    if ($for_type->is_it_include($element)) {
        $result_array=$for_type->find_type($element);
        foreach ($result_array as $type) {
            $type=str_replace($paranthesis, "", $type);            
            $database->insert_into2('turler', 'tur', $type);
            $database->insert_ids('sozcuktur', $element, $type);
        }
    } else {
        $database->insert_into('turler', 'tur', 'bilinmiyor');
        $database->insert_ids('sozcuktur', $element, 'bilinmiyor');
        echo 'it cannot be found';
    }
?>
