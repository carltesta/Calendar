<!-- if you need user information, just put them into the $_SESSION variable and output them here 
Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in.
Try to close this browser tab and open it again. Still logged in! ;)

-->
<?php
//Settings!!!
date_default_timezone_set('America/New_York');
$filename = "../cal.xml";	//Name of the file
$maxshow = 99;				//Maximum number of news files to show
?>

<html>
<head>
	<title>Add Shows</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<header class="container">
<div class="row">
  <h1 class="col-xs-8 col-sm-6 col-md-8"><a href="#" target="_self">Name of Calendar</a></h1>
  <nav class="col-xs-4 col-sm-6 col-md-4 text-right">
    <p><a href="../about.php" target="_self">About</a></p>
  </nav>
  </div>
  </header>

<section class="container">
  <div class="row">
  <figure class="col-sm-12">
<h1>Add Shows...</h1>
<form action="../success_redirect.php" method="post">
Username:<input type="text" name="user" readonly="readonly" value="<?php echo $_SESSION['user_name']; ?>"/><br>
Date:<input type="text" name="date"/><br>
Time:<input type="text" name="time"/><br>
Series:<input type="text" name="series"/><br>
Artist:<input type="text" name="artist"/><br>
Venue:<input type="text" name="venue"/><br>
Address:<input type="text" name="address"/><br>
Link:<input type="text" name="url"/><br>
<input type="submit" name="submit" value="submit"/>
</form>

<h1>Upcoming Concerts</h1>
<?
$count = 0;
$xml = simplexml_load_file($filename);
foreach ($xml->event as $item) {
	$description = nl2br($item->description->asXML());
	if ($count < $maxshow) {
		
		if (strtotime($item->date) > strtotime("-1 day")) {
			print "<tr>\n";
			print "<td valign=\"top\" class=\"style1\">";
			print "posted by " . $item->user . "<br>";
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
			print "<a href='" . $item->url . "' target='_blank'>More Info</a>";
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
        <a href="index.php?logout">LOGOUT</a>
      </ul>
    </div>
  </footer>

</body>
</html>


<!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" 
<a href="index.php?logout">Logout</a>-->
