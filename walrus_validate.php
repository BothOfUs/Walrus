<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>WALRUS - Validation Script</title>
<style type="text/css">
<!--
.style22 {color: "<? echo $calendar_font_month; ?>"}
.style23 {color: "<? echo $calendar_font_color; ?>"}
-->
</style>
</head>

<body>
<? include "walrus.php"; ?>
<? echo "Hey, how's it going? I'm the Walrus Validation Script. I'm just going to check your variables real quick.<br><br>";

// Check Walrus Version
	echo "Checking Version: ";
	Check_Version($walrus_version);
	echo "<br><br>";

// Check PHP Version
 	if (phpversion() >= "4.1.0") { echo "PHP Version: " . phpversion() . " - OK!<br>"; }
	else { echo "<b>ERROR! PHP Version: " . phpversion() . ". Must be 4.1.0 or greater!</b><br>"; }

// Check for trailing slash on comic and news urls
    if ( $comic_url{strlen($comic_url)-1} == "/" ) { echo "\$comic_url has trailing slash - OK!<br>"; }
	else { $comic_url = $comic_url . "/"; 
	       echo "<b>ERROR! \"\$comic_url\" is missing a trailing slash in walrus.php</b><br>"; }
    if ( $news_url{strlen($news_url)-1} == "/" ) { echo "\$comic_url has trailing slash - OK!<br>"; }
	else { $news_url = $news_url . "/"; 
		   echo "<b>ERROR! \"\$news_url\" is missing a trailing slash in walrus.php</b><br>"; }

// Check to make sure index and archive pages exist
	if (file_exists($walrus_page)) { echo "$walrus_page exists - OK!<br>"; } else {
	echo "<b>ERROR! \"\$walrus_page\" points to a non-existant file!</b><br>"; }
	if (file_exists($archive_page)) { echo "$archive_page exists - OK!<br>"; } else {
	echo "<b>Error! \"\$archive_page\" points to a non-existant file!</b><br>"; }

// Check for "." in news and image suffixes
	if ($image_suffix{0} == ".") { echo "\$image_suffix\" has a \".\" at the front - OK!<br>"; }
	else { $image_suffix = "." . $image_suffix; 
	 		echo "<b>ERROR! \"\$image_suffix\" is missing a \".\" in walrus.php</b><br>"; }
 	if ($image_suffix2{0} == ".") { echo "\$image_suffix2\" has a \".\" at the front - OK!<br>"; }
	else { $image_suffix2 = "." . $image_suffix2; 
 	 		echo "<b>ERROR! \"\$image_suffix2\" is missing a \".\" in walrus.php</b><br>"; }
	if ($news_suffix{0} == ".") { echo "\$news_suffix\" has a \".\" at the front - OK!<br>"; }
	else { $news_suffix = "." . $news_suffix; 
	 		echo "<B>ERROR! \"\$news_suffix\" is missing a \".\" in walrus.php</b><br>"; }

// Check the YES/NO variables
	if (($strips=="yes") || ($strips=="no")) { echo "\$strips is set to $strips - OK!<br>"; }
	else { echo "<b>ERROR! \$strips must be set to either \"yes\" or \"no\".</b><BR>"; }
	if (($news=="yes") || ($news=="no")) { echo "\$news is set to $news - OK!<br>"; }
	else { echo "<b>ERROR! \$news must be set to either \"yes\" or \"no\".</b><BR>"; }
	if (($lock_news=="yes") || ($lock_news=="no")) { echo "\$lock_news is set to $lock_news - OK!<br>"; }
	else { echo "<b>ERROR! \$lock_news must be set to either \"yes\" or \"no\".</b><BR>"; }
	if (($powered_by_walrus=="yes") || ($powered_by_walrus=="no")) { echo "\$powered_by_walrus is set to $lock_news - OK!<br>"; }
	else { echo "<b>ERROR! \$powered_by_walrus must be set to either \"yes\" or \"no\".</b><BR>"; }


// Check First Strip
     if ( ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2}$", $first_strip) ) { echo "\$first_strip is set to: " . $first_strip . " - OK!<br>"; }
	 else { echo "<b>ERROR! \$first_strip is set to $first_strip. The correct format is YYYY-MM-DD."; }
	 if ((file_exists($comic_url . $first_strip . $image_suffix)) || (file_exists($comic_url . $first_strip . $image_suffix2)))
	 { echo "$first_strip exists! - OK! (make sure this is your first strip)<br>"; } else { echo "<b>ERROR! $first_strip does not exist!</b><br>"; }

// Check Calendar
	echo "\$months_per_row is set to $months_per_row.<br><br>";
	echo "Here's what your calendar is going to look like:<br><br>";
?>
<table border="0" cellspacing="1" bgcolor="<? echo $calendar_outline; ?>">
  <tr align="center" bgcolor="<? echo $calendar_month; ?>">
    <td colspan="7"><font color="<? echo $calendar_font_month; ?>">January</font></td>
  </tr>
  <tr align="center" bgcolor="<? echo $calendar_bgcolor; ?>">
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">S</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">M</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">T</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">W</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">Th</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">F</font></td>
    <td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">Sa</font></td>
  </tr>
  <tr align="center" bgcolor="<? echo $calendar_bgcolor; ?>">
    <td width="20" height="20" bgcolor="<? echo $calendar_outline; ?>">&nbsp;</td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">1</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">2</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">3</font></td>
	<td width="20" height="20" bgcolor="<? echo $calendar_highlight; ?>"><font color="<? echo $calendar_font_color; ?>"><a href="http://www.walrusphp.com">4</a></font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">5</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">6</font></td>
	
  </tr>
  <tr align="center" bgcolor="<? echo $calendar_bgcolor; ?>">
<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">7</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">8</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">9</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">10</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">11</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">12</font></td>
	<td width="20" height="20"><font color="<? echo $calendar_font_color; ?>">13</font></td>
</tr>
</table>
<p>&nbsp;</p>
</body>
</html>
