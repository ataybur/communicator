<?php
include 'sozluk_1.php';
$db=new sozluk_1();
$db->connect_db();
//$db->drop_db('temp');
//$db->create_database('temp');
$db->select_db('temp');
$db->create_table('adresler', 'adres', 'adres_id');

$url = 'http://thesaurus.com/';
$for_index = '/href="\/list\/(.*?)">/i';
$contents = file_get_contents($url);
preg_match_all($for_index, $contents, $result);


foreach ($result[1] as $element) {
    $url = 'http://thesaurus.com/list/' . $element . '/';
    $for_next = '/href="(.*?)">NEXT &raquo;/i';
    $contents = file_get_contents($url);
    if (strpos($contents, "lnkactive")) {
        preg_match_all($for_next, $contents, $result3);
    }
    foreach($result3[1] as $element)
        $result4[]=$element;
}

foreach($result4 as $element4)
    $db->insert_into('adresler','adres' ,'http://thesaurus.com'.$element4,'not_alpnum');
    $db->print_table('adresler', 'adres','adres_id');
?>
