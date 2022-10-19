<?php
// echo "\n"."<b><br>Data[]<pre>"."\n";
// print_r($_REQUEST);
// echo "\n"."</pre></b>"."\n";
// die("\n"."<br><b>Archivo Modificado:<br>" . __FILE__ . "</b><br>Error Desarrollo " . date("d-m-Y H:i:s")."\n");


$url = "https://api.macvendors.com/" . urlencode($_REQUEST['mac']);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
if($response) {
echo json_encode(array("mac"=>$_REQUEST['mac'],"response"=>$response));
} else {
echo json_encode(array("Not Found"));
}
?>