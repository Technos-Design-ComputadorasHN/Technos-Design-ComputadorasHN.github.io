<?php
function ValidateEmail($email)
{
   $pattern = '/^([0-9a-z]([-.\w]*[0-9a-z])*@(([0-9a-z])+([-\w]*[0-9a-z])*\.)+[a-z]{2,6})$/i';
   return preg_match($pattern, $email);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['formid']) && $_POST['formid'] == 'layoutgrid1')
{
   $mailto = 'vickyrecinos685@gmail.com';
   $mailfrom = isset($_POST['email']) ? $_POST['email'] : $mailto;
   $subject = 'Website form';
   $message = 'Values submitted from web site form:';
   $success_url = '';
   $error_url = '';
   $eol = "\n";
   $error = '';
   $internalfields = array ("submit", "reset", "send", "filesize", "formid", "captcha_code", "recaptcha_challenge_field", "recaptcha_response_field", "g-recaptcha-response");
   $boundary = md5(uniqid(time()));
   $header  = 'From: '.$mailfrom.$eol;
   $header .= 'Reply-To: '.$mailfrom.$eol;
   $header .= 'MIME-Version: 1.0'.$eol;
   $header .= 'Content-Type: multipart/mixed; boundary="'.$boundary.'"'.$eol;
   $header .= 'X-Mailer: PHP v'.phpversion().$eol;

   try
   {
      if (!ValidateEmail($mailfrom))
      {
         $error .= "The specified email address (" . $mailfrom . ") is invalid!\n<br>";
         throw new Exception($error);
      }

      $message .= $eol;
      $message .= "IP Address : ";
      $message .= $_SERVER['REMOTE_ADDR'];
      $message .= $eol;
      foreach ($_POST as $key => $value)
      {
         if (!in_array(strtolower($key), $internalfields))
         {
            if (!is_array($value))
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . $value . $eol;
            }
            else
            {
               $message .= ucwords(str_replace("_", " ", $key)) . " : " . implode(",", $value) . $eol;
            }
         }
      }
      $body  = 'This is a multi-part message in MIME format.'.$eol.$eol;
      $body .= '--'.$boundary.$eol;
      $body .= 'Content-Type: text/plain; charset=ISO-8859-1'.$eol;
      $body .= 'Content-Transfer-Encoding: 8bit'.$eol;
      $body .= $eol.stripslashes($message).$eol;
      if (!empty($_FILES))
      {
         foreach ($_FILES as $key => $value)
         {
             if ($_FILES[$key]['error'] == 0)
             {
                $body .= '--'.$boundary.$eol;
                $body .= 'Content-Type: '.$_FILES[$key]['type'].'; name='.$_FILES[$key]['name'].$eol;
                $body .= 'Content-Transfer-Encoding: base64'.$eol;
                $body .= 'Content-Disposition: attachment; filename='.$_FILES[$key]['name'].$eol;
                $body .= $eol.chunk_split(base64_encode(file_get_contents($_FILES[$key]['tmp_name']))).$eol;
             }
         }
      }
      $body .= '--'.$boundary.'--'.$eol;
      if ($mailto != '')
      {
         mail($mailto, $subject, $body, $header);
      }
      header('Location: '.$success_url);
   }
   catch (Exception $e)
   {
      $errorcode = file_get_contents($error_url);
      $replace = "##error##";
      $errorcode = str_replace($replace, $e->getMessage(), $errorcode);
      echo $errorcode;
   }
   exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contactános</title>
<meta name="generator" content="WYSIWYG Web Builder 15 - http://www.wysiwygwebbuilder.com">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="font-awesome.min.css" rel="stylesheet">
<link href="technos_pagina.css" rel="stylesheet">
<link href="Contactanos.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script src="wwb15.min.js"></script>
<script>
$(document).ready(function()
{
   $('#wb_FontAwesomeIcon3').addClass('visibility-hidden');
   $('#wb_FontAwesomeIcon8').addClass('visibility-hidden');
   $('#wb_FontAwesomeIcon10').addClass('visibility-hidden');
   $('#wb_FontAwesomeIcon27').addClass('visibility-hidden');
   function onScrollFontAwesomeIcon3()
   {
      var $obj = $("#wb_FontAwesomeIcon3");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_FontAwesomeIcon3', 'transform-lightspeed-in', 100, 1000);
      }
   }
   onScrollFontAwesomeIcon3();
   $(window).scroll(function(event)
   {
      onScrollFontAwesomeIcon3();
   });
   function onScrollFontAwesomeIcon8()
   {
      var $obj = $("#wb_FontAwesomeIcon8");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_FontAwesomeIcon8', 'transform-lightspeed-in', 200, 1000);
      }
   }
   onScrollFontAwesomeIcon8();
   $(window).scroll(function(event)
   {
      onScrollFontAwesomeIcon8();
   });
   function onScrollFontAwesomeIcon10()
   {
      var $obj = $("#wb_FontAwesomeIcon10");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_FontAwesomeIcon10', 'transform-lightspeed-in', 300, 1000);
      }
   }
   onScrollFontAwesomeIcon10();
   $(window).scroll(function(event)
   {
      onScrollFontAwesomeIcon10();
   });
   function onScrollFontAwesomeIcon27()
   {
      var $obj = $("#wb_FontAwesomeIcon27");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('wb_FontAwesomeIcon27', 'transform-lightspeed-in', 600, 1000);
      }
   }
   onScrollFontAwesomeIcon27();
   $(window).scroll(function(event)
   {
      onScrollFontAwesomeIcon27();
   });
});
</script>
</head>
<body>
<div id="PageHeader1">
<div id="PageHeader1_Container">
<div id="wb_Image1">
<img src="images/logo tecknos.png" id="Image1" alt=""></div>
<div id="wb_CssMenu1">
<ul role="menubar">
<li class="firstmain"><a role="menuitem" href="./Index.html#PageHeader1" target="_self" title="Inicio">Inicio</a>
</li>
<li><a role="menuitem" href="./Productos.html" target="_self" title="Productos">Productos</a>
</li>
<li><a role="menuitem" href="./Contactanos.html" target="_self" title="Contact&#225;nos">Contact&#225;nos</a>
</li>
<li><a role="menuitem" href="./Nosotros.html" target="_self" title="Nosotros">Nosotros</a>
</li>
</ul>
</div>
</div>
</div>
<div id="Layer1">
<div id="Layer1_Container">
</div>
</div>
<div id="wb_LayoutGrid3">
<div id="LayoutGrid3">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid4">
<div id="LayoutGrid4">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid1">
<form name="LayoutGrid1" method="post" action="<?php echo basename(__FILE__); ?>" enctype="multipart/form-data" id="LayoutGrid1">
<input type="hidden" name="formid" value="layoutgrid1">
<div class="row">
<div class="col-1">
<div id="wb_Text1">
<p style="font-family:Arial;font-size:11px;line-height:12px;color:#FFFFFF;"><span style="font-family:Impact;font-size:29px;line-height:37.5px;color:#FFFFFF;">CONTACTANOS</span></p>
</div>
<div id="wb_LayoutGrid2">
<div id="LayoutGrid2">
<div class="row">
<div class="col-1">
<input type="text" id="Editbox1" name="Nombre" value="" spellcheck="false" required placeholder="Nombre">
<input type="text" id="Editbox2" name="Gmail" value="" spellcheck="false" required placeholder="Gmail">
<input type="text" id="Editbox3" name="Telefono" value="" spellcheck="false" required placeholder="Telefono">
</div>
<div class="col-2">
<textarea name="Mensaje" id="TextArea1" rows="4" cols="58" spellcheck="false" required placeholder="Mensaje"></textarea>
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid5">
<div id="LayoutGrid5">
<div class="row">
<div class="col-1">
<input type="submit" id="Button1" name="" value="Enviar">
</div>
</div>
</div>
</div>
<div id="wb_Shape3">
<div id="Shape3"></div>
</div>
</div>
</div>
</form>
</div>
<div id="wb_LayoutGrid23">
<div id="LayoutGrid23">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid22">
<div id="LayoutGrid22">
<div class="row">
<div class="col-1">
</div>
</div>
</div>
</div>
<div id="wb_LayoutGrid10">
<div id="LayoutGrid10">
<div class="row">
<div class="col-1">
<div id="wb_FontAwesomeIcon3">
<a href="https://www.facebook.com/TechnosDesignComputadoras/"><div id="FontAwesomeIcon3"><i class="fa fa-facebook"></i></div></a>
</div>
<div id="wb_FontAwesomeIcon8">
<a href="https://x.com/TechnosDesign?mx=2"><div id="FontAwesomeIcon8"><i class="fa fa-twitter"></i></div></a>
</div>
<div id="wb_FontAwesomeIcon10">
<a href="https://www.instagram.com/technosdesignhn/"><div id="FontAwesomeIcon10"><i class="fa fa-instagram"></i></div></a>
</div>
<div id="wb_FontAwesomeIcon27">
<a href="https://wa.link/fhsyia"><div id="FontAwesomeIcon27"><i class="fa fa-phone"></i></div></a>
</div>
<div id="wb_Text17">
<span style="color:#FFFFFF;font-family:Arial;font-size:21px;"><strong>Somos tecnología! Somos Technos Design Computadoras!</strong></span>
</div>
<hr id="Line2">
</div>
</div>
</div>
</div>
</body>
</html>