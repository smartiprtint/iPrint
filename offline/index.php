<!doctype html><html><head><meta charset="utf-8"><title>Home</title><meta name="generator" content="WYSIWYG Web Builder 11 - http://www.wysiwygwebbuilder.com"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link href="ricochet.ico" rel="shortcut icon" type="image/x-icon"><link href="font-awesome.min.css" rel="stylesheet"><link href="IPrint_v2.css" rel="stylesheet"><link href="index.css" rel="stylesheet"><script src="jquery-1.11.3.min.js"></script><script src="wb.parallax.min.js"></script><script src="wb.lazyload.min.js"></script><script src="jquery.ui.effect.min.js"></script><script src="jquery.ui.effect-slide.min.js"></script><script src="jquery.ui.effect-drop.min.js"></script><script src="jquery.ui.effect-blind.min.js"></script><script src="jquery.ui.effect-size.min.js"></script><script src="jquery.ui.effect-scale.min.js"></script><script src="jquery.ui.effect-fade.min.js"></script><script src="wwb11.min.js"></script><script>
$(document).ready(function()
{
   $('#Layer1').parallax();
   $('#Layer8').parallax();
   function Bookmark1Scroll()
   {
      var $obj = $("#wb_Bookmark1");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('wb_Text1', 1, 'slideup', 1600, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text2', 1, 'slidedown', 1300, 'easeInOutExpo');
         ShowObjectWithEffect('wb_CssMenu1', 1, 'slideleft', 1000, 'easeInOutExpo');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObjectWithEffect('wb_CssMenu1', 0, 'slideup', 500, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text1', 0, 'slideup', 500, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text2', 0, 'slideup', 500, 'easeInOutExpo');
      }
   }
   Bookmark1Scroll();
   $(window).scroll(function(event)
   {
      Bookmark1Scroll();
   });
   $('a[href*=#Bookmark1]').click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_Bookmark1').offset().top }, 600, 'easeInOutBack');
   });
   function Bookmark2Scroll()
   {
      var $obj = $("#wb_Bookmark2");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('wb_Text3', 1, 'slidedown', 1000, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text4', 1, 'slideright', 1300, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Line1', 1, 'dropup', 1600, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Image2', 1, 'slideright', 1900, 'easeInOutExpo');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObjectWithEffect('wb_Text3', 0, 'slideup', 500, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text4', 0, 'slideup', 500, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Line1', 0, 'slideup', 500, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Image2', 0, 'slideup', 500, 'easeInOutExpo');
      }
   }
   Bookmark2Scroll();
   $(window).scroll(function(event)
   {
      Bookmark2Scroll();
   });
   $('a[href*=#Bookmark2]').click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_Bookmark2').offset().top }, 600, 'linear');
   });
   function Bookmark3Scroll()
   {
      var $obj = $("#wb_Bookmark3");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('wb_Text5', 1, 'slidedown', 1000, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text6', 1, 'slideright', 1300, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Line2', 1, 'dropup', 1600, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Image3', 1, 'slideleft', 1900, 'easeInOutExpo');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObjectWithEffect('wb_Text5', 0, 'slideup', 500);
         ShowObjectWithEffect('wb_Text6', 0, 'blindhorizontal', 500);
         ShowObjectWithEffect('wb_Line2', 0, 'blindhorizontal', 500);
         ShowObjectWithEffect('wb_Image3', 0, 'blindhorizontal', 500);
      }
   }
   Bookmark3Scroll();
   $(window).scroll(function(event)
   {
      Bookmark3Scroll();
   });
   function Bookmark4Scroll()
   {
      var $obj = $("#wb_Bookmark4");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('wb_Text7', 1, 'slideup', 1000, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Text8', 1, 'slideup', 1300, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Line3', 1, 'dropdown', 1600, 'easeInOutExpo');
         ShowObjectWithEffect('wb_Image4', 1, 'slideright', 1900, 'easeInOutExpo');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObjectWithEffect('wb_Text7', 0, 'slideup', 500);
         ShowObjectWithEffect('wb_Text8', 0, 'slideup', 500);
         ShowObjectWithEffect('wb_Line3', 0, 'slideup', 500);
         ShowObjectWithEffect('wb_Image4', 0, 'slideup', 500);
      }
   }
   Bookmark4Scroll();
   $(window).scroll(function(event)
   {
      Bookmark4Scroll();
   });
   function Bookmark5Scroll()
   {
      var $obj = $("#wb_Bookmark5");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         ShowObjectWithEffect('Layer11', 1, 'scale', 1000, 'easeInOutBack');
      }
      if ($obj.hasClass("in-viewport") && !$obj.inViewPort(true))
      {
         $obj.removeClass("in-viewport");
         ShowObjectWithEffect('Layer11', 0, 'fade', 500);
      }
   }
   Bookmark5Scroll();
   $(window).scroll(function(event)
   {
      Bookmark5Scroll();
   });
   $('img[data-src]').lazyload();
});
</script></head><body><div id="container"></div><div id="Layer1"><div id="Layer1_Container"><div id="wb_Text1"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;">Smart </span><span style="color:#1E90FF;font-family:Arial;font-size:75px;">i</span><span style="color:#000000;font-family:Arial;font-size:75px;">Print</span></div><div id="wb_Text2"><span style="color:#000000;font-family:Arial;font-size:35px;"><em>Speed<br>Accuracy and Reliability</em></span></div><div id="wb_CssMenu1"><ul><li class="firstmain"><a href="./SampleData.dll" target="_self">Download</a></li></ul></div><div id="wb_Bookmark1"><a id="Bookmark1">&nbsp;</a></div></div></div><div id="Layer3"><div id="Layer3_Container"><div id="wb_Image1"><img src="images/placeholder.gif" data-src="images/iprintlogo.jpg" id="Image1" alt=""></div></div></div><div id="Layer2"><div id="Layer2_Container"><div id="wb_ResponsiveMenu1"><label class="toggle" for="ResponsiveMenu1-submenu" id="ResponsiveMenu1-title">Menu<div id="ResponsiveMenu1-icon"><span>&nbsp;</span><span>&nbsp;</span><span>&nbsp;</span></div></label><input type="checkbox" id="ResponsiveMenu1-submenu"><ul class="ResponsiveMenu1" id="ResponsiveMenu1"><li><a href="./index.php" class="active"><i class="fa fa-home fa-2x">&nbsp;</i><br>Home</a></li><li><label for="ResponsiveMenu1-submenu-0" class="toggle"><i class="fa fa-sign-in fa-2x">&nbsp;</i>Sign-in<b class="arrow-down"></b></label><a href="./Sign-in.php"><i class="fa fa-sign-in fa-2x">&nbsp;</i><br>Sign-in<b class="arrow-down"></b></a><input type="checkbox" id="ResponsiveMenu1-submenu-0"><ul><li><a href="./Sign-in.php"><i class="fa fa-users fa-2x">&nbsp;</i>Customer</a></li><li><a href="./Sign-in_shopOwner.php"><i class="fa fa-user-md fa-2x">&nbsp;</i>Shop&nbsp;Owner</a></li><li><a href="./../admin/Sign-in_Admin.php"><i class="fa fa-user-secret fa-2x">&nbsp;</i>Administrator</a></li></ul></li><li><label for="ResponsiveMenu1-submenu-1" class="toggle"><i class="fa fa-user-plus fa-2x">&nbsp;</i>Sign-up<b class="arrow-down"></b></label><a href="./Sign-up.php"><i class="fa fa-user-plus fa-2x">&nbsp;</i><br>Sign-up<b class="arrow-down"></b></a><input type="checkbox" id="ResponsiveMenu1-submenu-1"><ul><li><a href="./Sign-up.php"><i class="fa fa-users fa-2x">&nbsp;</i>Customer</a></li><li><a href="./Sign-up_shopOwner.php"><i class="fa fa-user-md fa-2x">&nbsp;</i>Shop&nbsp;Owner</a></li></ul></li><li><a href="./SampleData.dll"><i class="fa fa-download fa-2x">&nbsp;</i><br>Download</a></li></ul></div></div></div><div id="Layer4"><div id="Layer4_Container"></div></div><div id="Layer5"><div id="Layer5_Container"><div id="wb_Text4"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;"><strong>Speed</strong></span></div><div id="wb_Line1"><img src="images/img0001.png" id="Line1" alt=""></div><div id="wb_Bookmark2"><a id="Bookmark2">&nbsp;</a></div><div id="wb_Image2"><img src="images/Android-Phone-Movie-Gallery.png" id="Image2" alt=""></div><div id="wb_Text3"><span style="color:#FFFFFF;font-family:Arial;font-size:16px;"><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </strong></span></div></div></div><div id="Layer6"><div id="Layer6_Container"><div id="wb_Text5"><span style="color:#FFFFFF;font-family:Arial;font-size:16px;"><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </strong></span></div><div id="wb_Text6"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;"><strong>Accuracy</strong></span></div><div id="wb_Line2"><img src="images/img0002.png" id="Line2" alt=""></div><div id="wb_Image3"><img src="images/Android-Phone-Movie-Gallery.png" id="Image3" alt=""></div><div id="wb_Bookmark3"><a id="Bookmark3">&nbsp;</a></div></div></div><div id="Layer7"><div id="Layer7_Container"><div id="wb_Text7"><span style="color:#FFFFFF;font-family:Arial;font-size:16px;"><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </strong></span></div><div id="wb_Text8"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;"><strong>Reliability</strong></span></div><div id="wb_Line3"><img src="images/img0003.png" id="Line3" alt=""></div><div id="wb_Bookmark4"><a id="Bookmark4">&nbsp;</a></div><div id="wb_Image4"><img src="images/Android-Phone-Movie-Gallery.png" id="Image4" alt=""></div></div></div><div id="Layer8"><div id="Layer8_Container"><div id="Layer11"><div id="wb_Text10"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;"><strong>About Us</strong></span></div><div id="wb_Text9"><span style="color:#FFFFFF;font-family:Arial;font-size:11px;"><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </strong></span></div><div id="wb_Text11"><span style="color:#FFFFFF;font-family:Arial;font-size:11px;"><strong>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </strong></span></div><div id="wb_Text12"><span style="color:#FFFFFF;font-family:Arial;font-size:35px;"><strong>Former Reviews</strong></span></div><div id="wb_Bookmark5"><a id="Bookmark5">&nbsp;</a></div></div></div></div><div id="Layer9"><div id="Layer9_Container"></div></div><div id="Layer10"><div id="Layer10_Container"><div id="wb_Image5"><img src="images/placeholder.gif" data-src="images/img0004.jpg" id="Image5" alt=""></div><hr id="Line4"><div id="wb_Text13"><span style="color:#FFFFFF;font-family:Arial;font-size:13px;"> 2016 Copyright Smart iPrint. All Rights Reserved.</span></div></div></div></body></html>