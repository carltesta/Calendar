<?php
//Settings!!!
date_default_timezone_set('America/New_York');
$filename = "cal.xml";	//Name of the file
$maxshow = 99;				//Maximum number of news files to show
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Name of Calendar</title>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
</head>
<body>

<header class="container">
<div class="row">
  <h1 class="col-xs-8 col-sm-6 col-md-8"><a href="#" target="_self">Name of Calendar</a></h1>
  <nav class="col-xs-4 col-sm-6 col-md-4 text-right">
    <p><a href="about.php" target="_self">About</a></p>
  </nav>
  </div>
  </header>
  
  <section class="container">
  <div class="row">
  <figure class="col-sm-12">
  <h4>Upcoming Concerts</h4>
  
<?
$count = 0;
$xml = simplexml_load_file($filename);
foreach ($xml->event as $item) {
	$description = nl2br($item->description->asXML());
	if ($count < $maxshow) {
		
		if (strtotime($item->date) > strtotime("-1 day")) {
			print "<tr>\n";
			print "<td valign=\"top\" class=\"style1\">";
			print $item->date . "<br>" . $item->time . "<br>";
			print "</td>\n";
			
			print "<td valign=\"top\" class=\"style1\">";
			print $item->artist . "<br>\n";
			if (isset($item->series) && $item->series != "") {
				print nl2br($item->series) . "<br> \n";				
			}
			
			if (isset($item->venue) && $item->venue != "") {
				print nl2br($item->venue) . "<br> \n";
			}
			
			if (isset($item->address) && $item->address != "") {
				print nl2br($item->address) . "<br> \n";			
			}
			
			if (isset($item->performers) && $item->performers != "") {
				print nl2br($item->performers) .	"<br> \n";	
			}
			
			if ($item->url != ""){
			print "<a href='" . $item->url . "' target='_blank'>More Info...</a>";
			print "<br> \n";
			}
			
			print "</td>";
			print "</tr>\n";
			print "<br>";
		}
	}
	$count++;
}
?>

</figure>
</div>
</section>
  
  <footer class="container">
    <div class="row">
      <p class="col-xs-3">&copy; <?php echo date("Y") ?></p> 
      <ul class="col-xs-9">
        <a href="/login" target="_self">Admin Login</a>
      </ul>
    </div>
  </footer>

</body>
</html>
