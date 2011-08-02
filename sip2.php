<?php
require_once('PhpSIP.class.php');

try
{
  $api = new PhpSIP('opensips.org'); // IP we will bind to
  $api->setMethod('MESSAGE');
  $api->setUsername('sip:alpay@78.46.64.50'); // authentication username
  $api->setPassword('xxxxxx'); // authentication password
  $api->setFrom('sip:alpay@78.46.64.50');
  $api->setUri('sip:ataybur@78.46.64.50');
  $api->setBody('Evet!!!');
  $res = $api->send();  
  echo "res1: $res\n";
  
} catch (Exception $e) {
  
  echo $e->getMessage()."\n";
}

?>
