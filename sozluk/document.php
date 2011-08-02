<?php
class Search_ROOT {

    private $arr = array();

    public function main() {
        $word = "nicely";
        $url = 'http://www.ldoceonline.com/dictionary/' . $word;
        $for_root = '/class="HYPHENATION">(.*?)<\/span>/i';
        $fot_type = '/<sup><\/sup><i>&nbsp;(.*?)<\/i><\/b><\/div>/i';
        $contents = file_get_contents($url);

        preg_match_all('/class="HYPHENATION">(.*?)<\/span>/i', $contents, $result);
        preg_match_all('/<sup><\/sup><i>&nbsp;(.*?)<\/i><\/b><\/div>/i', $contents, $result2);
        $temp = explode("‧", $result[1][0]);
        $this->arr[] = $word;
        $this->arr[] = $temp[0];
        $this->arr[] = $result2[1][0];

        return $this->arr;
    }

}

$root=new Search_ROOT();
$arr2=$root->main();
print_r($arr2);
?>
