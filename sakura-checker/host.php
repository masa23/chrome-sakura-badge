<?php

ini_set("display_errors", 1);
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");

// http://ipinfo.io/AS9371
// $("#block-table tr").find("td:eq(0) a").map((_,e)=>$(e).text())

$asn = [
	9370 => ["27.133.128.0/19", "27.134.240.0/20", "59.106.0.0/17", "59.106.128.0/18", "59.106.192.0/19", "59.106.224.0/20", "59.106.240.0/22", "61.211.224.0/20", "103.57.4.0/22", "103.198.4.0/22", "133.125.128.0/17", "153.121.0.0/19", "153.121.32.0/19", "153.121.64.0/19", "153.125.224.0/20", "160.16.0.0/17", "160.16.128.0/17", "163.43.0.0/16", "183.181.102.0/24", "202.58.16.0/22", "202.181.96.0/20", "202.222.16.0/20", "210.188.224.0/19", "210.229.64.0/21"],
	9371 => ["49.212.0.0/16", "103.238.244.0/22", "103.250.200.0/22", "112.78.112.0/20", "112.78.192.0/19", "120.136.8.0/21", "133.167.0.0/16", "157.112.144.0/20", "157.112.176.0/20", "160.27.0.0/16", "175.28.4.0/22", "182.48.0.0/18", "183.90.224.0/19", "210.188.192.0/19", "210.224.160.0/19", "219.94.128.0/17", "223.27.69.0/24", "223.27.70.0/23"],
];
$ip = gethostbyname($_GET["host"]);

$match = null;
foreach($asn as $as => $list){
	// echo "\nAS: ". $as . "\n";
	foreach($list as $mask){
		list($maskAddr, $prefix) = explode("/", $mask);
		// echo $maskAddr . " / " . $prefix . "\n";
		if(ip2long($ip) >> (32-$prefix) == ip2long($maskAddr) >> (32-$prefix)){
			$match = $as;
		}
	}
}
echo json_encode([
	"isSakura" => $match != NULL,
	"asn" => $match
]);
