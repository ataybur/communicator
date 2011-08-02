<?php
require_once('PhpSIP.class.php');

try
{
  $api = new PhpSIP('opensips.org'); // IP we will bind to
  $api->setMethod('MESSAGE');
  $api->setUsername('sip:kutadgu@78.46.64.50'); // authentication username
  $api->setPassword('050389'); // authentication password
  $api->setFrom('sip:kutadgu@78.46.64.50');
  $api->setUri('sip:ataybur@opensips.org');
  $api->setBody('Hi, can we meet at 5pm today?');
  $res = $api->send();  
  echo "res1: $res\n";
  
  $api->listen2();
  $api->yazdir();
} catch (Exception $e) {
  
  echo $e->getMessage()."\n";
}

?>
