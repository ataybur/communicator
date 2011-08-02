
<?php



$list[] = 'm/2';
$list[] = 'p/2';
$list[] = 's/2';
$list[] = 't/2';
$list[] = 'w/2';



include 'sozluk.php';
$database = new sozluk();
$db_name = "koksozluk_db";
$database->connect_db();
//$database->drop_db($db_name);
//$database->create_database($db_name);
//$database->select_db($db_name);
$database->select_db('temp');
//$database->create_table("sozcukler", "sozcuk", "sozcuk_id");

$url = 'http://thesaurus.com/';
$for_index = '/href="\/list\/(.*?)">/i';
$for_links = '/class="result_list"><a href="(.*?)" class="result_link">/i';
$for_words = '/class="result_list"><a href="(.*?)" class="result_link">/i';
/*$contents = file_get_contents($url);
preg_match_all($for_index, $contents, $result0);
 *
 */
$ikinciler=mysql_query("select lower(adres) from adresler");
while ($row = mysql_fetch_array($ikinciler))        
        $result0[] = substr($row['lower(adres)']." ",26,-1);
                
            
$database->close_db();
$database->connect_db();
$database->select_db($db_name);

foreach ($result0 as $indices) {
    $indices;
    if (in_array($indices, $list)) {
    //    if (1) {
        echo $indices;
        $url = 'http://thesaurus.com/list/' . $indices ;
        $contents = file_get_contents($url);

        preg_match_all($for_links, $contents, $result);
        foreach ($result[1] as $resulties) {
            $content = file_get_contents($resulties);
            preg_match_all($for_words, $content, $result2);

            $array_words = array();
            foreach ($result2[1] as $value) {

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
}
//$database->print_table("sozcukler", "sozcuk_id", "sozcuk");
$database->close_db();
?>

