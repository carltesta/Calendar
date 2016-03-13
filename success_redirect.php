<?php 

if(isset($_REQUEST['submit'])){
	$xml = new DOMDocument("1.0","UTF-8");
	$xml->load("cal.xml");
	
	$rootTag = $xml->getElementsByTagName("document")->item(0);
	
	$eventTag = $xml->createElement("event");
	
	$userTag = $xml->createElement("user",$_REQUEST['user']);
	$dateTag = $xml->createElement("date",$_REQUEST['date']);
	$timeTag = $xml->createElement("time",$_REQUEST['time']);
	$seriesTag = $xml->createElement("series",$_REQUEST['series']);
	$artistTag = $xml->createElement("artist",$_REQUEST['artist']);
	$venueTag = $xml->createElement("venue",$_REQUEST['venue']);
	$addressTag = $xml->createElement("address",$_REQUEST['address']);
	$urlTag = $xml->createElement("url",$_REQUEST['url']);
	
	$eventTag->appendChild($userTag);
	$eventTag->appendChild($dateTag);
	$eventTag->appendChild($timeTag);
	$eventTag->appendChild($seriesTag);
	$eventTag->appendChild($artistTag);
	$eventTag->appendChild($venueTag);
	$eventTag->appendChild($addressTag);
	$eventTag->appendChild($urlTag);
	
	$rootTag->appendChild($eventTag);
	
	$xml->save("cal.xml");
}

//NOW SORT IT!
$xml=simplexml_load_file("cal.xml");
$arr=array();
foreach($xml->event as $anEvent)
{
    $arr[]=$anEvent;
}
//print_r($arr);
/* uncomment the above line to debug */
usort($arr,function($a,$b){
    return strtotime($a->date)-strtotime($b->date);
});
//print_r($arr);
/* uncomment the above line to debug */
$xml=simplexml_load_string(<<<XML
<?xml version="1.0"?>
<document>
</document>
XML
);
foreach($arr as $anEvent)
{
    $tTask=$xml->addChild($anEvent->getName());
    $tTask->addChild($anEvent->user->getName(),(string)$anEvent->user);
    $tTask->addChild($anEvent->date->getName(),(string)$anEvent->date);
    $tTask->addChild($anEvent->time->getName(),(string)$anEvent->time);
    $tTask->addChild($anEvent->series->getName(),(string)$anEvent->series);
    $tTask->addChild($anEvent->artist->getName(),(string)$anEvent->artist);
    $tTask->addChild($anEvent->venue->getName(),(string)$anEvent->venue);
    $tTask->addChild($anEvent->address->getName(),(string)$anEvent->address);
    $tTask->addChild($anEvent->url->getName(),(string)$anEvent->url);
}
$xml->asXML("cal.xml");

header("Location: /login/index.php");
exit;
?>