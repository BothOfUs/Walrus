<!-- -----------------------------------------------------------------------------
// Webcomic Archive and Live Rant Update Script for PHP
// Copyright (C) 2001, 2005  Jim Newberry http://www.newbsoft.com
// 
// Many Thanks to Team Walrus:  
//    Kagetenshi (XHTML and Testing) 
//    Rob Hamm - http://www.toastedmonkey.com (CSS and Testing)
//    Dave Buist - http://www.decafdesign.com (Calendar Mod)
//
// REQUIREMENTS: PHP 4.1.0 or higher
// 
// This script is free software; you can redistribute it and/or modify it
// under the terms of the GNU General Public License as published by the
// Free Software Foundation; either version 2 of the License, or (at your
// option) any later version.
//
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
// General Public License for more details.
//
// You should have received a copy of the GNU General Public License along
// with this program; if not, write to the Free Software Foundation, Inc.,
// 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// To get a copy of this script, visit http://www.walrusphp.com
----------------------------------------------------------------------------- -->
<?
/*
 The following variables must be customized as indicated. Load the file
 "walrus_validate.php" to check them.
*/

/* 
 These are the Relative URLs of your comic and news files. If this file is
 located at http://www.yoursite.com/walrus.php, and your comics are in the
 "http://www.yoursite.com/strips/" directory, then the Relative URL would
 be "strips/". The same principle applies for $news_url. Be sure to include
 a trailing forward slash.
*/

$comic_url = "strips/";
$news_url = "news/";

/*
 This variable is the name page that will display your comics. Default is 
 "index.php" but you can change it to "comic.php" or "view.php3", etc...
*/

$walrus_page = "index.php";

/*
 The next variable is the name of the calendar archive file. Default
 is "archive.php".
*/

$archive_page = "archive.php";

/*
 Change $image_suffix to the extension your comic files will use,
 for instance, if they are GIFs, use ".gif", ".png" for PNGs, and so on. 
 Change the $news_suffix variable to the suffix your news posts will use,
 if they are HTML files, use .htm or .html. Be sure to include the "."
*/

$image_suffix = ".png";
$image_suffix2 = ".gif";
$news_suffix = ".php";

/*
 This variable indicates whether or not you want the script to display
 comic images. In other words, you could just put your strips in .html
 files and have the script pull them that way. IMPORTANT: Either $strips
 or $news MUST be "yes" or you won't see either. They can BOTH be "yes"
 if you want.
*/

$strips = "yes";        // "yes" or "no"
$news = "yes";          // "yes" or "no"

/*
 The next variable tells Walrus whether to lock your newsposts to their
 own strips. Default is "no", which means both the most recent strip and
 most recent news will be displayed, regardless of their dates or connection
 to one another. "yes" will tell Walrus to only display news if the current
 strip has a newspost of the same date.
*/

$lock_news = "no";      // "yes" or "no"

/*
 Change $first_strip to the date ("YYYY-MM-DD") of your first comic. This
 variable will control the "first" link in the navigation menu.
*/

$first_strip = "2001-11-29";

/*
 The next several variables are for the calendar archive. If you load the file
 "walrus_validate.php" you will see an example of what your calendar will look like
 based on the following color choices. 
*/

$months_per_row = "3"; 			  // How many months per row. Default is "3".

$calendar_bgcolor = "#000000"; 	  // Background color of calendar months. Default is "#000000" - Black
$calendar_month = "#CC0000"; 	  // Background color of month name. Default is "#CC0000" - Dark Red
$calendar_outline = "#666666"; 	  // Outline color for calendar months. Default is "#666666" - Dark Grey
$calendar_highlight = "#000000";  // Color for background of days with strips. Default is "#000000" - Black
$calendar_font_color = "#FFFFFF"; // Color of the numbers of days without strips. Default is "#FFFFFF" - White
$calendar_font_month = "#FFFFFF"; // Color of month name. Default is "#FFFFFF" - White

/*
 This last variable determines whether the script should display the
 "Powered with Pride by Walrus" slogan on your main Walrus page. This is set 
 to "yes" by default because it also includes an "upgrade available" notice, 
 but feel free to set it to "no" and even remove the relevant code from the
 bottom of the index page if you want.
*/

$powered_by_walrus = "yes";   // "yes" or "no"

/*
-----------------------------------------------------------------------------
 Only change the code beyond this notice if you know what you're doing.
-----------------------------------------------------------------------------
*/

	 $gtod1 = gettimeofday();
     $is_last="no";
     $today = date("Y-m-d");
     if (isset($_GET['date'])) { $date=$_GET['date']; }
 	 else { $date = $today;
            $is_last="yes";
          }
     if ( ereg("^[0-9]{4}-[0-9]{2}-[0-9]{2}$", $date) ) {     }
          else { $date = date("Y-m-d"); }
     if ($date > date("Y-m-d")) { $date = date("Y-m-d"); }
     
     $walrus_version = "2.9.5080700";
	 
	 $update_interval = "86400";

// Get Absolute Path to strips and news on the server
     $comic_path = getcwd() . "/" . $comic_url;
     $news_path = getcwd() . "/" . $news_url;

	 function next_strip ($date)
               { global $comic_path;
                 global $today;
                 global $image_suffix;
                 global $image_suffix2;
                 global $update_interval;
                 $epoch = mktime(10, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
                 while ($epoch = $epoch + $update_interval)
                        {   $newdate = date("Y-m-d", $epoch);
                            if ($newdate > $today) { return ''; }
                            if (file_exists($comic_path . $newdate . $image_suffix) ||
                            file_exists($comic_path . $newdate . $image_suffix2))
                            { return $newdate; }
                        }
               }

     function previous_strip ($date)
                   {    global $comic_path;
                        global $first_strip;
                        global $image_suffix;
                        global $image_suffix2;
                        global $update_interval;
                        $epoch = mktime(10, 0, 0, substr($date, 5, 2), substr($date, 8, 2), substr($date, 0, 4));
                        while ($epoch = $epoch - $update_interval)
                        {
                            $newdate = date("Y-m-d", $epoch);
                            if ($newdate < $first_strip) { return ''; }
                            if (file_exists($comic_path . $newdate . $image_suffix) ||
                            file_exists($comic_path . $newdate . $image_suffix2))
                            { return $newdate; }
                        }
                   }

    function get_strip ($date)
                   {   global $comic_path;
                       global $image_suffix;
                       global $image_suffix2;
                       global $previous;
                       global $strips;
                       global $first_strip;

                       if (file_exists($comic_path . $date . $image_suffix))
                       { $current_strip = $date . $image_suffix; }
                       elseif (file_exists($comic_path . $date . $image_suffix2))
                       { $current_strip = $date . $image_suffix2; }
                       else { if ($date != $first_strip)
                              { $prevstrip = $date;
                                $breakloop = 0;
                                do { $prevstrip = previous_strip($prevstrip);
                                     if(file_exists($comic_path . $prevstrip . $image_suffix))
                                     { $current_strip = $prevstrip . $image_suffix;
                                       $breakloop = 1;
                                     }
                                     elseif(file_exists($comic_path . $prevstrip . $image_suffix2))
                                     { $current_strip = $prevstrip . $image_suffix2;
                                       $breakloop = 1; }
                                   } while ($breakloop <> 1);
                              }
                            }
                   return $current_strip;
                   }

    function get_news ($date)
                   {   global $news_path;
                       global $comic_url;
                       global $news_suffix;
                       global $previous;
                       global $news;
                       global $lock_news;
                       global $first_strip;

                       if ($news !="yes")
                       { return ''; } /* if $news doesn't equal "yes" then DO NOTHING */
                       elseif (file_exists($news_path . $date . $news_suffix))
                       { include($news_path . $date . $news_suffix); }
                       else { if ($lock_news !="yes")
                              { if ($date != $first_strip)
                                { $prevnews = $date;
                                  $breakloop = 0;
                                  do { $prevnews = previous_strip($prevnews);
                                       if(file_exists($news_path . $prevnews . $news_suffix))
                                       { $breakloop = 1; }
                                     } while ($breakloop <> 1);
                                     include($news_path . $prevnews . $news_suffix);
                                }
                              }
                            }
                   }

function Check_Version($walrus_version)
         { global $powered_by_walrus;
           global $walrus_version;

           if ($powered_by_walrus != "yes") { $versioncheck = ''; }
           else { include "http://www.walrusphp.com/files/current_version.php?version=" . $walrus_version; }
         }
?><!-- Walrus <? echo $walrus_version; ?> --><?
	if ($strips == "yes")
	   { $strip_date = get_strip($date);
		 $current_strip = "<img src=\"" . $comic_url . $strip_date . "\" alt=\"" . $strip_date . "\">"; }
	   else
	   { $current_strip = ''; }
	$previous = previous_strip(get_strip($date));
	$prevlink = $walrus_page . "?date=" . $previous;
	$firstlink = $walrus_page . "?date=" . $first_strip;
	$next = next_strip($date);
	$nextlink = $walrus_page . "?date=" . $next;
	$lastlink = $walrus_page;
?>
