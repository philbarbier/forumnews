Readme file

  seepies.net Forumnews

  This work is copyrighted to Phil Barbier (c) 2003 - 2004.
  Please do not copy this without permission to the author.
  Also, please do not edit/alter the core code(1) and do not
  distribute this software without permission from the author.

  Please leave the copyright notice intact when using this product,
  you can change the format, display and the placement but please keep
  it visible on the page where you use this product. Any other design
  or page layout is also completely open to the end user.

  Don't be scared to ask, I'm only human ;) I just want to keep
  track of this :) Thanks.

  For technical support or questions, please use the following:-

  http://www.seepies.net/forum/viewforum.php?f=4
  Phil Barbier - coder@seepies.net

phpBB and phpbb (and likenesses thereof) are known references to the community forum 
software which belongs to the phpBB group under copyright (c) 2001, 2002 phpBB Group

For more information on phpBB, please visit http://www.phpbb.com/

Invision Board, IPB, IB or any likenesses are all copyright (c) 2003  IPS, Inc.

For more information on Invision Board, please visit http://www.invisionboard.com/

I cannot and will not support phpBB or Invision Board, but only the software that is
contained in this package.

(1) - This does NOT include the HTML and page layout, I actively encourage
      users of this script to modify the layout/design to seamlessly fit into
      their page.

===========================
Updates since initial release
===========================

(o) - Tweaked user interface, and the way things are displayed
(o) - Built in MS Access support, so it is now an additional option
(o) - Changed engine slightly to allow support for other forum types
(o) - Built initial release support for Invision Board forums.
  
===========================
 Installation Instructions
===========================

--------------------------------------------------------------------------------------------------
Read this if you DO NOT have shell access to the web space (or do not
know what this means).
--------------------------------------------------------------------------------------------------

1). Download the .tar file to a location on your PC.
2). Untar the file (Winzip can handle this) on your PC.
3). Load up your favourite FTP client, and connect to your web hosting
    space.
4). Upload the files you untarred to the desired location in your web
    hosting area (for example /www/news or /docs/news or something similar, consult
    your web host for further assistance). 
    
*** You can place these files anywhere within your web hosting space as long as they
    remain intact as they were in the archive (this means the files in db/ have to be
    placed in db/ wherever you install this to).
    
For example:

My forum is located at http://www.mydomain.com/forum/
My forum website files are located in /www/forum/ in my web hosting space.
I want to display the forum news information in my main website news page which is
http://www.mydomain.com/news.php so I choose to install the files in /www on my web space.

Proceed to step 5)

--------------------------------------------------------------------------------------------------
Read this if you DO have shell access to your web space
--------------------------------------------------------------------------------------------------

1). Download the .tar file to a location in your shell 
    (wget http://flimflam.homelinux.org/projects/forumnews/forumnews.tar)
2). Make the directory and/or ensure that the archive is in the correct desired location for installation.
3). Untar the archive (tar -xvf forumnews.tar)
4). This step doesn't really exist - it's not here, you never read it - in fact, there is no Step 4 ;)

Proceed to step 5)

--------------------------------------------------------------------------------------------------

All users read this:-

5). Once the files are uploaded, you can edit the file you want the forum posts to appear in
    with the following text:- (* Note this has to be a PHP file).
    
    <? include("forumnews.php"); ?>
    
6). You should be ready to go :) If you encounter any issues, or have any questions or comments
    related to this utility, please send them either to me (Phil Barbier) at coder@seepies.net or
    post them at my forum: http://www.seepies.net/forum/viewforum.php?f=4

---------------------------------------------------------------------------------------------------

===========================
 Configuring the utility
===========================

Configuration is a relatively trivial matter, the config.php file is the only file you are required
to edit, and the options therein are straightforward to follow.

Once you have made the appropriate changes to the config.php file then upload/copy the file to the area
where you installed the script for the changes to take place.

If you do not know the answers to some of the more advanced questions, then leave them at default.
If the defaults do not work, either contact your web host technical support, or if you prefer an
answer within a smaller timeframe, post a question on the forum:-
http://www.seepies.net/forum/viewforum.php?f=4

---------------------------------------------------------------------------------------------------

===========================
 Layout of the script
===========================

With web design and layout being so diverse, I've not bothered to make the default layout or look
anything special. However, I have put the information within self-contained tables (<table> tags)
so that it ought to be easier to include into your page. If you want to juggle the information around
and make it fit into your site design, then go right ahead, if you could send me a URL so I can see
it in action, that'd be great too :)

---------------------------------------------------------------------------------------------------

===========================
 Future considerations
===========================

OK, so I've only just finished 0.1b, but I want to make a note of a few thoughts I have, before I
get suggestions coming in.

I want to make the design and/or look/feel (colouring, etc.) a little more customisable through the
config.php
I want to look into supporting other types of forum, as well as other types of database to try and
go alongside at least what phpBB can offer.

As an update, I'm starting on a conversion for this to work under ASP, natively under IIS rather than
requiring PHP - so far it's very much a testing side, so it won't be included in this release.

---------------------------------------------------------------------------------------------------

===========================
 Notes
===========================

I've tested this myself on a Linux server, running Apache 1.3.27/PHP 4.3.2 on phpBB 2.0.6 using both
MySQL and PostgreSQL databases and it seems to work fine.

-------
Update
-------

I've now built in MS Access support as well, this has been run on IIS 5.1 (Windows XP Pro.) with 
PHP version 4.3.4 and phpBB 2.0.6c - this has worked reliably so far, but please let me know of any
issues, as I'm not convinced I have worked out all bugs when operating on a Windows based system.

If you have any issues at all with the script, please be sure to either e-mail them to me (include as
much information with it as you can, and if possible a test URL where I can witness the issue) or post
them in the forum so that I can get a fix out. I've not got the resources to test in every situation, so
this likely won't work for some people (it is the nature of software ;)).

I hope someone enjoys this, if you did, I'd love to hear your comments - if you didn't, I'd love to hear your
flames about it - any feedback is appreciated.

This script doesn't promise, or in fact do anything too special. It does one of those jobs that most people
could write themselves, but often may not be bothered to do. I just hope it can be used by someone :)

Thank you for trying it :)

Have now built in Invision Board support, and have tested this with the above webserver config 
(Apache 1.3.27 and PHP 4.3.2) with Invision Board version 1.3 final. Seems to work well, although it's 
not final - there are some tweaks needed, however I feel it's release ready.

Thanks.

-------------
Latest Update
-------------

Initial avatar display support has been built in for phpBB only right now, also preliminary work has
begun on vBulletin support, but I'm awaiting legal confirmation from vBulletin to ensure that it's
OK for me to write the module.

Also put the projcet into CVS, which will make things a lot easier to work with.

---------------------------------------------------------------------------------------------------

Phil. <coder@seepies.net> http://www.seepies.net/forum/viewforum.php?f=4

---------------------------------------------------------------------------------------------------

-- EOF.