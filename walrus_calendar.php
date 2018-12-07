<? require "walrus.php";

    function createCalendar() {
         global $first_strip;
         global $walrus_page;
         global $months_per_row;

            $start_year = substr($first_strip, 0, 4);
            $start_month = substr($first_strip, 5, 2);

            $todays_date = date("Y-m-d", time());
            $end_year = substr($todays_date, 0, 4);
            $end_month = substr($todays_date, 5, 2);
         
            // check to see if start and end dates were entered
            if (isset($_GET['start'])) {
               $start_year = substr($_GET['start'], 0, 4);
               $start_month = substr($_GET['start'], 5, 2);
            }
            if (isset($_GET['end'])) {
               $end_year = substr($_GET['end'], 0, 4);
               $end_month = substr($_GET['end'], 5, 2);
			   if ($end_year > substr($todays_date, 0, 4)) { $end_year = substr($todays_date, 0, 4); }
			   if ($end_year = substr($todays_date, 0, 4)) 
			      { if($end_month > substr($todays_date, 5, 2)) {$end_month = substr($todays_date, 5, 2); }
	   			  }
			}
         
            $strip_row = 1;
            echo "<table>";
            for ($i = $start_year; $i <= $end_year; $i++) {
               if ($start_year == $end_year) {
                  for ($j = $start_month; $j <= $end_month; $j++) {
                     if ($strip_row==1) {echo "<tr>\n\n";}
                     echo "<td valign=\"top\">";
                     mk_drawCalendar($j,$i);
                     echo "</td>";
                     if ($strip_row==$months_per_row) {echo "</tr>";$strip_row=0;}
                     $strip_row++;
                  }
               }
               else if ($i == $start_year) {
                  for ($j = $start_month; $j <= 12; $j++) {
                     if ($strip_row==1) {echo "<tr>";}
                     echo "<td valign=\"top\">\n\n";
                     mk_drawCalendar($j,$i);
                     echo "</td>";
                     if ($strip_row==$months_per_row) {echo "</tr>";$strip_row=0;}
                     $strip_row++;
                  }
               }
               else if ($i == $end_year) {
                  for ($j = 1; $j <= $end_month; $j++) {
                     if ($strip_row==1) {echo "<tr>";}
                     echo "<td valign=\"top\">\n\n";
                     mk_drawCalendar($j,$i);
                     echo "</td>";
                     if ($strip_row==$months_per_row) {echo "</tr>";$strip_row=0;}
                     $strip_row++;
                  }
               }
               else {
                  for ($j = 1; $j <= 12; $j++) {
                     if ($strip_row==1) {echo "<tr>";}
                     echo "<td valign=\"top\">\n\n";
                     mk_drawCalendar($j,$i);
                     echo "</td>";
                     if ($strip_row==$months_per_row) {echo "</tr>";$strip_row=0;}
                     $strip_row++;
                  }
               }
            }
           echo "</table>";
         }
         
//*********************************************************
// DRAW CALENDAR
//*********************************************************
/*
   Draws out a calendar (in html) of the month/year
   passed to it date passed in format mm-dd-yyyy
*/
         function mk_drawCalendar($m,$y) {
         global $comic_path;
         global $comic_url;
         global $image_suffix;
         global $image_suffix2;
         global $walrus_page;
		 global $calendar_bgcolor, $calendar_month, $calendar_outline, $calendar_highlight;
		 global $calendar_font_color, $calendar_font_month;

             if ((!$m) || (!$y))
             {
                 $m = date("m",mktime());
                 $y = date("Y",mktime());
             }
         
             /*== get what weekday the first is on ==*/
             $tmpd = getdate(mktime(0,0,0,$m,1,$y));
             $month = $tmpd["month"];
             $firstwday= $tmpd["wday"];
         
             $lastday = mk_getLastDayofMonth($m,$y);
         
         ?>
            
<table cellpadding=2 cellspacing=1 border=0 bgcolor="<? echo $calendar_outline; ?>">
              
<tr align="center" bgcolor="<? echo $calendar_month; ?>">
               
<td colspan=7>
                   
  <p><font size=2 face="Verdana, Arial, Helvetica, sans-serif" color="<? echo $calendar_font_month; ?>">
    <?="$month $y"?>
  </font></p>
  </td>
</tr>
              
<tr bgcolor="<? echo $calendar_outline; ?>">
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">S</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">M</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">T</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">W</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">TH</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">F</font></th>
<th width=22 bgcolor="<? echo $calendar_bgcolor; ?>" class="tcell"><font face="Verdana, Arial, Helvetica, sans-serif" size="2" color="<? echo $calendar_font_color; ?>">SA</font></th>
</tr>
         
<?
   $d = 1;
   $wday = $firstwday;
   $firstweek = true;
         
   /*== loop through all the days of the month ==*/
   while ( $d <= $lastday) {
                 /*== set up blank days for first week ==*/
                 if ($firstweek) { print "     <tr>\n";
                                   for ($i=1; $i<=$firstwday; $i++)
                                   { print "      <td><font size=2>&nbsp;</font></td>\n"; }                                   
                                 }
         
                 /*== Sunday start week with <tr> ==*/                 
                 if ($wday==0 && !$firstweek) { print "     <tr>\n"; }                 
                 else {$firstweek = false;}
         
               $day_fix = $d;
               if ($day_fix < 10) {
                  $day_fix = "0$day_fix";
               }
               $month_fix = $m;
               if (($month_fix < 10) && (strlen($month_fix) == 1)) {
                  $month_fix = "0$month_fix";
               }
         
               $fulldate = "$y-$month_fix-$day_fix";
               $filetofind = $comic_path . $fulldate . $image_suffix;
               $filetofind2 = $comic_path . $fulldate . $image_suffix2;

               if ((file_exists($filetofind)) || (file_exists($filetofind2)))
               { if ($fulldate <= date("Y-m-d"))
                  {   print "<td class='tcell' bgcolor=\"" . $calendar_highlight . "\" align=\"center\">";
                      print "<a href=\"" . $walrus_page . "?date=" . $fulldate . "\">" . $d . "</a>";
                      print "</td>\n";
                  } else { print "<td class='tcell' bgcolor=\"" . $calendar_bgcolor . "\" align=\"center\">";
                           print "<font color=\"" . $calendar_font_color . "\">" . $d. "</font>";
                           print "</td>\n"; }
               }
               else { print "<td class='tcell' bgcolor=\"" . $calendar_bgcolor . "\" align=\"center\">";
                      print "<font color=\"" . $calendar_font_color . "\">" . $d. "</font>";
                      print "</td>\n";
                    }

               
                 /*== Saturday end week with </tr> ==*/
                 if ($wday==6) { print "     </tr>\n"; }
         
                 $wday++;
                 $wday = $wday % 7;
                 $d++;
             }
         ?>
              
</table>
         
<?
         /*== end drawCalendar function ==*/
         }
         
         /*== get the last day of the month ==*/
         function mk_getLastDayofMonth($mon,$year)
         {
             for ($tday=28; $tday <= 31; $tday++)
             {
                 $tdate = getdate(mktime(0,0,0,$mon,$tday,$year));
                 if ($tdate["mon"] != $mon)
                 { break; }
             }
             $tday--;
         
             return $tday;
         }

         $offset = 3600*11;
?>