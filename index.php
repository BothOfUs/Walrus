<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
    <title>WALRUS - Webcomic Archive and Live Rant Update Script for PHP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body bgcolor="#000000" text="#FFFFFF" link="#FFFFFF" vlink="#FFFFFF" alink="#FFFFFF">
<?php require "walrus.php"; ?>
<table width="750" border="0" cellspacing="10" cellpadding="5" align="center" bgcolor="#CC0000">
    <tr>
        <td align="center" bgcolor="#000000"><p>

                <!-- Insert Comic Image -->
                <?php echo $current_strip; ?>

            <p>
                <!-- Insert News -->
                <?php get_news($date); ?>

            <table width="100%" border="0" cellspacing="0" cellpadding="5">
                <tr align="center" valign="middle">
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">

                            <?php if ($previous) {
                                /*
                                 The text following this comment will be displayed to point you to the
                                 previous comic. You can change it to an image, or to say anything you like.
                                */
                                ?>
                                <a href="<?php echo $prevlink; ?>">Previous</a>

                            <?php } else {
                                /*
                                 The text after this comment will be displayed if there is NO comic
                                 BEFORE the one currently on display. Feel free to change it to something
                                 else.
                                */ ?>

                                Previous

                            <?php } ?>
                        </font></td>
                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                            <?php if ($date != $first_strip) {
                                /*
                                 The text following this comment will be displayed to point you to the
                                 FIRST comic. You can change it to an image, or to say anything you like.
                                */ ?>
                                <a href="<?php echo $firstlink; ?>">First</a>

                            <?php } else {
                                /*
                                 The text after this comment will be displayed if you are currently displaying
                                 the FIRST strip. Feel free to change it to something else.
                                */ ?>

                                First

                            <?php } ?>
                        </font></td>

                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">

                            <a href="<?php echo $archive_page; ?>">Archive</a></font></td>

                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">

                            <?php if ($is_last != "yes") {

                                /*
                                 The text following this comment will be displayed to point you to the
                                 LAST comic. You can change it to an image, or to say anything you like.
                                */ ?>

                                <a href="<?php echo $lastlink; ?>">Last</a>

                            <?php } else {
                                /*
                                 The text after this comment, will be displayed if you are currently viewing
                                 the most recent comic. Feel free to change it to something else.
                                */ ?>

                                Last

                            <?php } ?>
                        </font></td>

                    <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">

                            <?php if ($next) {
                                /*
                                 The text following this comment will be displayed to point you to the next comic. You can
                                 change it to an image, or to say anything you like.
                                */ ?>

                                <a href="<?php echo $nextlink; ?>">Next</a>

                            <?php } else {
                                /*
                                 The text after this comment, will be displayed if there is NO comic
                                 AFTER the one currently on display. Feel free to change it to something
                                 else.
                                */ ?>

                                Next

                            <?php } ?>
                        </font></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>

        <td align="center">
            <p>
                <a href="http://www.walrusphp.com">Powered with Pride by Walrus</a><br>
                Updated By <a href="http://bothofus.se">BothOfUs</a>
                <?php
                /*
                 The following code will check the Walrus website for the newest version
                 number, and display a message if there is an update available
                */ ?>

                <?php Check_Version($walrus_version); ?>

            </p>
        </td>
    </tr>
</table>
</body>
</html>