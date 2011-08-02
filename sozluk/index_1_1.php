
<?php

include 'sozluk.php';
include 'sorguClass.php';
$database = new sozluk();
$sorgu = new sorguClass();
$db_name = "koksozluk_db";
$database->connect_db();
//$database->drop_db($db_name);
//$database->create_database($db_name);
$database->select_db($db_name);
//$database->create_table("sozcukler", "sozcuk", "sozcuk_id");

$url = 'http://thesaurus.com/';
$for_index = '/href="\/list\/(.*?)">/i';
$for_links = '/class="result_list"><a href="(.*?)" class="result_link">/i';
$for_words = '/class="result_list"><a href="(.*?)" class="result_link">/i';


foreach ($sorgu->getResult($url, $for_index) as $indices) {
    $url = $url.'list/' . $indices . '/';
    foreach ($sorgu->getResult($url, $for_links) as $resulties) {
        $array_words = array();
        foreach ($sorgu->getResult($resulties, $for_words) as $value) {

            $value = substr($value . " ", 28, -1);
            if (strpos($value, "+")) {
                $temp = explode('+', $value);
                foreach ($temp as $tempy) {
                    if (!is_numeric($tempy))
                        $array_words[] = $tempy;
                }
            }

            else {
                if (!is_numeric($value))
                    $array_words[] = $value;
            }
        }

        foreach ($array_words as $element)
            $database->insert_into("sozcukler", "sozcuk", $element);
    }
    unset($array_words);
}
$database->print_table("sozcukler", "sozcuk_id", "sozcuk");
?>

