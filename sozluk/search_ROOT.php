<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of search_ROOT
 *
 * @author burak
 */
class Search_ROOT {

    private $arr = array();

    public function is_it_include($word) {
        $needle = '>'.$word.'</span>';
        $url = 'http://dictionary.reference.com/browse/' . $word;
        $contents = file_get_contents($url);
        
        return strpos($contents, $needle);
    }

    public function main($word) {

        $url = 'http://www.ldoceonline.com/dictionary/' . $word;
        $for_root = '/class="HYPHENATION">(.*?)<\/span>/i';
        $for_type = '/<sup><\/sup><i>&nbsp;(.*?)<\/i><\/b><\/div>/i';
        $contents = file_get_contents($url);

        preg_match_all('/class="HYPHENATION">(.*?)<\/span>/i', $contents, $result);
        preg_match_all('/<sup><\/sup><i>&nbsp;(.*?)<\/i><\/b><\/div>/i', $contents, $result2);
        $temp = explode("‧", $result[1][0]);
        $this->arr[] = $word;
        $this->arr[] = $temp[0];
        $this->arr[] = $result2[1][0];

        return $this->arr;
    }
    public function find_type($word){
        $array=array();
        $url = 'http://dictionary.reference.com/browse/' . $word;
        $for_type = '/<span class="pg">–(.*?) <\/span>/i';
        $contents = file_get_contents($url);
        preg_match_all($for_type, $contents, $result);
        foreach ($result[1] as $element)
            $array[]=$element;
        return $array;
    }

}
?>
