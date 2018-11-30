<?php

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.intra.42.fr/oauth/token");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials&client_id=<UID>&client_secret=<SECRET>");
curl_setopt($ch, CURLOPT_POST, 1);

$headers = array();
$headers[] = "Content-Type: application/x-www-form-urlencoded";
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

curl_close ($ch);
$result = json_decode($result);

if(!empty($result->error))
{
	echo $result->error;
	return(-1);
}


 
$str = "";
$res = "";
$i = 0;

$arrayobj = new ArrayObject(array());




while($res != "[]" && $res != "{}" )
{

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.intra.42.fr/v2/users/".$_GET['login']."/locations?per_page=100&page=" . $i);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


$headers = array();
$headers[] = "Authorization: Bearer " . $result->access_token;
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$res = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$arrayobj->append(json_decode($res));
curl_close ($ch);

$i++;
sleep(1);
}


echo json_encode($arrayobj);

?>


