<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<head>
    <title>WALRUS - Webcomic Archive and Live Rant Update Script for PHP - Archive</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#FF0000" vlink="#FF0000" alink="#FF0000">
<?php require "walrus_calendar.php"; ?>
<table width="750" border="0" cellspacing="10" cellpadding="5" align="center" bgcolor="#CC0000">
    <tr>
        <td align="center" bgcolor="#000000">
            <p><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                    <a href="<?php echo $walrus_page; ?>">Home</a>
                    |
                    <a href="<?php $archive_page; ?>?start=2003-10&amp;end=2003-12">2003</a>
                    |
                    <a href="<?php $archive_page; ?>?start=2004-01&amp;end=2004-12">2004</a>
                    |
                    <a href="<?php $archive_page; ?>?start=2005-01&amp;end=2005-12">2005</a></font>
            <p>
                <?php createCalendar(); ?>
    </tr>
    <tr>
        <td align="center">
            <p><a href="http://www.walrusphp.com">
                    <img src="http://www.walrusphp.com/images/walrus88x31.png" border="0"
                         alt="Powered with Pride by Walrus"></a><br>
                <?php Check_Version($walrus_version); ?></p>
        </td>
    </tr>
</table>