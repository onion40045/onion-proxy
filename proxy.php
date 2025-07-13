<?php
// Smile.One Proxy API (ggowl.infy.uk)

$uid = "2236952";
$email = "web.ggowl@gmail.com";
$product = "mobilelegends";
$key = "58fa88ff95e206a06e82e4aa1525f16c";

// Read POST data
$userid = $_POST['userid'] ?? '';
$zoneid = $_POST['zoneid'] ?? '';
$productid = $_POST['productid'] ?? '';
$time = time();

// Build sign
$params = [
    "uid" => $uid,
    "email" => $email,
    "userid" => $userid,
    "zoneid" => $zoneid,
    "product" => $product,
    "productid" => $productid,
    "time" => $time,
];
ksort($params);
$str = "";
foreach ($params as $k => $v) {
    $str .= "$k=$v&";
}
$str .= $key;
$sign = md5(md5($str));
$params['sign'] = $sign;

// Call Smile.One API
$url = "https://www.smile.one/br/smilecoin/api/createorder";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Return result
header("Content-Type: application/json");
echo $response;
?>
