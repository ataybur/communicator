<?php
include 'sozluk.php';
include 'search_ROOT.php';

$db_name = "koksozluk_db";

$sozluk = new sozluk();
$sozluk->connect_db();
//$sozluk->drop_db($db_name);
//$sozluk->create_database($db_name);
$sozluk->select_db($db_name);
$sozluk->create_table("kokler", "kok", "kok_id");
$sozluk->create_table("sozcukler", "sozcuk", "sozcuk_id");
$sozluk->create_table("turler", "tur", "tur_id");
$sozluk->create_table2("koksozcuk", "kok_id", "sozcuk_id");
$word = $_POST["word"];
$root_etc = new Search_ROOT();
if($root_etc->is_it_include($word))
{
$root_array = $root_etc->main($word);
$sozluk->insert_into("kokler", "kok", $root_array[1]);
$sozluk->insert_into("sozcukler", "sozcuk", $root_array[0]);
$sozluk->insert_into("turler", "tur", $root_array[2]);
$sozluk->insert_ids("koksozcuk", $root_array[1], $root_array[0]);
}
else
    {
    echo "The word is not included by the dictionary";
}
echo "<br />";
$sozluk->print_table("kokler", "kok_id", "kok");
$sozluk->print_table("sozcukler", "sozcuk_id", "sozcuk");
$sozluk->print_table("koksozcuk", "kok_id", "sozcuk_id");
$sozluk->print_table("turler", "tur_id", "tur");

$sozluk->close_db();
?>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form action="veritabani.php" method="post">
            Word: <input type="text" name="word">
            <input type="submit" value="Submit">
        </form>
    </body>
</html>
