<?php  
include("hprose/hproseHttpClient.php");  
$client = new HproseHttpClient("http://localhost/test/test/test.php");  
echo $client->Hello("Hprose");  
?>  