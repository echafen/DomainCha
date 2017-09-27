<?php

$temes = strtotime(date('Y-m-d H:i:s'));
 //返回普通消息模板
function tishi($codes, $temes, $descs){
	$toshi["status"] = $codes;
	$toshi["msg"] = $descs;
	$toshi["times"] = $temes;
  return json_encode($toshi);
}

//适合二级json
function lijson($arr){
 $ii = 0;
 $ss = 0;
 foreach($arr as $k=>$v) { 
 if(!is_array($v)) { 
 $ii++;
 $jsjs[$ii]["name"] = $k;
 $jsjs[$ii]["value"] = $v;
 }else{
 $ss++;
 $jsjs["name"] = $k;
 if(is_array($v)) {
 $jsjs["list"][$ss] = lijson($v);
   }
  }
 }
 return $jsjs;
}

$t=isset($_GET['t'])?$_GET['t']:"er";
$t = strtolower(trim($t));
//$tips = tishi("10001", $temes, "参数t缺失(类型)");
//if($t=="er" || $t=="") exit($tips);

$query=isset($_GET['d'])?$_GET['d']:"er";
$query=strtolower(trim($query));

if($t=="er" && $t==""){
$tips = tishi("10002", $temes, "参数d缺失(域名)");
if($query=="er" || $query=="") exit($tips);
}

/*
A记录：将域名指向一个IPv4地址（例如：10.10.10.10），需要增加A记录
CNAME记录：如果将域名指向一个域名，实现与被指向域名相同的访问效果，需要增加CNAME记录
MX记录：建立电子邮箱服务，将指向邮件服务器地址，需要设置MX记录
NS记录：域名解析服务器记录，如果要将子域名指定某个域名服务器来解析，需要设置NS记录
TXT记录：可任意填写（可为空），通常用做SPF记录（反垃圾邮件）使用
AAAA记录：将主机名（或域名）指向一个IPv6地址（例如：ff03:0:0:0:0:0:0:c1），需要添加AAAA记录
SRV记录：记录了哪台计算机提供了哪个服务。格式为：服务的名字.协议的类型（例如：_example-server._tcp）
*/

switch($t){

 case 'ns': //=== NS记录 ===//
/*
 	$CACHE["status"] = "10000";
	$CACHE["msg"] = "ok";
	$CACHE["times"] = $temes;
	$CACHE["types"] = "NS记录：域名解析服务器记录";
*/

 $CACHE = dns_get_record($query, DNS_NS);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;
 
 case 'a': //=== A记录 ===//
 $CACHE = dns_get_record($query, DNS_A);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;
 
 case 'aaaa'://=== AAAA记录 ===//
 $CACHE = dns_get_record($query, DNS_AAAA);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;
 
 case 'mx'://=== MX记录 ===//
 $CACHE = dns_get_record($query, DNS_MX);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;
 
 case 'cname'://=== CNAME记录 ===//
 $CACHE = dns_get_record($query, DNS_CNAME);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;

 case 'txt'://=== TXT记录 ===//
 $CACHE = dns_get_record($query, DNS_TXT);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;
 
 case 'srv'://=== SRV记录 ===//
 $CACHE = dns_get_record($query, DNS_SRV);
 if($CACHE){
 echo json_encode(lijson($CACHE)); 
 }else{
 $tips = tishi("10002", $temes, "未查询到结果");
  exit($tips);
 }
 break;

 /*更多查询请自行添加*/ 

 default:
 $CACHE["status"] = "10000";
	$CACHE["msg"] = "ok";
	$CACHE["times"] = $temes;
	$CACHE["types"] = "列出查询";

	$CACHE["item"]["1"]["types"] = "a";
	$CACHE["item"]["1"]["nrong"] = "A记录";
	$CACHE["item"]["2"]["types"] = "aaaa";
	$CACHE["item"]["2"]["nrong"] = "AAAA记录";
	$CACHE["item"]["3"]["types"] = "cname";
	$CACHE["item"]["3"]["nrong"] = "CNAME记录";
	$CACHE["item"]["4"]["types"] = "mx";
	$CACHE["item"]["4"]["nrong"] = "MX记录";
	$CACHE["item"]["5"]["types"] = "txt";
	$CACHE["item"]["5"]["nrong"] = "TXT记录";
	$CACHE["item"]["6"]["types"] = "ns";
	$CACHE["item"]["6"]["nrong"] = "NS记录";
	$CACHE["item"]["7"]["types"] = "srv";
	$CACHE["item"]["7"]["nrong"] = "SRV记录";
 $tips = json_encode($CACHE);
 exit($tips);
 break;
 } 
 
 ?>