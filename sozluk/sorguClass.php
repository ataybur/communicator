<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sorguClass
 *
 * @author burak
 */
class sorguClass {

    public function getResult($url, $parttern) {
        $contents = file_get_contents($url);
        preg_match_all($pattern, $contents, $result);
        return $result[1];
    }

    public function insert($value, $array) {

        $value = substr($value . " ", 28, -1);
        if (strpos($value, "+")) {
            $temp = explode('+', $value);
            foreach ($temp as $tempy) {
                if (!is_numeric($tempy))
                    $array[] = $tempy;
            }
        }

        else
        if (!is_numeric($value))
            $array[] = $value;


        foreach ($array as $element)
            $database->insert_into("sozcukler", "sozcuk", $element);
    }

}

$sorgu = new sorguClass();

$url = 'http://thesaurus.com/';
$for_index = '/href="\/list\/(.*?)">/i';
$for_links = '/class="result_list"><a href="(.*?)" class="result_link">/i';
$for_words = '/class="result_list"><a href="(.*?)" class="result_link">/i';

foreach ($sorgu->getResult($url, $for_index) as $element) {
    $url = $url . 'list/' . $element . '/';
    foreach ($sorgu->getResult($url, $for_links) as $element2) {
        $array_words = array();
        foreach ($sorgu->getResult($element2, $for_words) as $value) {
            $sorgu->insert($value, $array_words);
            unset($array_words);
        }
    }
}
?>
