GPS Stock Ticker
=================

By Cameron Huntington

For WordPress use.
                                                                               
This plugin uses the SimplyScroll 2 jQuery plugin found here:
http://logicbox.net/jquery/simplyscroll/

=================

Feature additions coming eventually:

  - Custom styling (slowly implementing features deemed important)
  - Alternate display option - fade (wip, writing soon)

=================

Change Log:

0.5: March 3, 2014

  - Widget now supports custom background styles, and display options (fade still wip, defaults to scroll)
  - Having both one or more shortcodes alongside a widget on a page now display and function correctly
  - cst-stocks.js is no longer a global function - now it's own method that is instantiated upon each stock element found in the DOM
  - Stock initiation is now held in separate .js file

0.4: February 28, 2014

  - Widget created (widgets only pull data from the database)
  - Multisite compatible
  - Added JavaScript functionality to initiate multiple tickers on the same page

0.3: February 27, 2014

  - Now storing checkbox options in the wp-options database table under cst_options
  - Stock list array created and moved to separate file

0.2.2: February 26, 2014

  - Incorporated display option into the shortcode

0.2.1: February 25, 2014

  - Added widget support for shortcode use

0.2: February 24, 2014

  - Added checklist of popular stock extensions to settings page
  - Added shortcode generator that corresponds with checkboxes
  - Added stock symbol testing input field to check against Google Finance without navigating away from page

0.1: January 21, 2014

  - Initial release. Thanks go to Bananas, Bryce Flory, and Hot Tamales.

<!--                                                       I7I
                                     I              I77I           ??
                                ZZ$7            II777III 77IIIII????
                             OOZZ$   OZZZZZZ$$$77777777777777777????
                           OOOOOZZOOOZZZZZZZ$7777$$$$$$$$77777I????
               ZZZZOOOZZZZZZZZZZZZZZZZZZZZZ$8OOO7IIIII7Z$77IIIII???
           $ZOOOO8OOOOOOOOOZZZZZZZZZZZZZZZZZZ$77ZOOOOOZ$ZZIIIII???
        =$OO8888OOOOOOOOOZZOOOZZZZZZZZZZZZZZZZZZZZZZ$7IZ$ZZZ$$ZI? 7777777
      7+OO8888OOOOOOOOOOI?+++?IIZZZZZZZZZZZZZZZZZZZ$IOZZZZZZZ7I?$$$$$$$77III77
     7?$88888OOOOOOOZ???+IOZZZZZZZZZZZZZZZZZZZZZ$$I$OZZZZZZ$IIZIIII??????
    77?I8888OOOOZI?III?8ZZZZZZZZZZZZZZZZOOZZZZ$I78OOOOZZZZ$ZZI77IIIIII?????
  O8$O8888OOOOOOOOOOZZZZZZZZZZZZZZZ8 MMOZZZZZ888OOOOOZOZZZZIII7             ?
 ZD8Z88888OOOOOZZZZZZ$$7777$ZZO8NM   DZZZZZZZZZZO$$$$$77Z$IIIII$777
 DD 88888OOOOZZZZZZZ7II$8D$8DZZ    ZZZZZZZZZZZZZZZZZIOOZZZI7$77777777I
8D     88OOOOO8 MM   D8OZZO      MZZZZZZZZZZZZZZZZZZ$OOOZII$$$77II???I
8DM                            M8ZZZZOOOOOOOOOZZZZ$ZOOOII$$$II
8DMM    MM                   M8ZZZZOOOOO88888OZZ$?ZZZ7$$$$III
 8MMMM 888OM              M ZZZZZZOOO888888OOZZ$ZZZZZ$$$$
 DDDDDD88OOOOOD MMMMM  OZZZZZZZZZOO88888DOOOZZZZZZZZZ$$
  8D8DD88OOOOOZZZZZZZZZZZZZZZZZZZO888DD 7O8OZZZZZZZZ
  88D8D888OOOOZZZZZZZZZZZZZZZZZZZOODDD Z$O8ZZZZZ
    ZODD8OOOOOZZZZZZZZZZZZZZZZO88$   77$O8ZZZZZ
     DI??7$ZOO88888888888O$I      M=OIO88ZZZ
       DD MMMM  DDD           MM$~OIZOD8ZZ
        8DDD               $::OO7$O888OZ
         MDDDDD        OOZZZZZO88D8OO
           MDDDD8888888888DDDDD8OO
              DDDDDDDD888888OO 												-->