<?php
/**
 *=======================================================
 * modul: Galerie (jquery)
 * part: Ausgabe
 * version: 1.0.6
 * redaxo Version: 4.5
 * redaxo AddOns: Image Manager & GS_FancyBox2
 * authored: contic.de, G. Seilheimer
 * Datum: 2013-04-26
 *=======================================================
 */

   // VARS
   $error_text                = "<span style='color: red'>Fehler: </span>";
   $ok_img = true;
   $ok_txt = true;
   $ok_img_error              = "Bild fehlt...!<br />";
   $ok_txt_error              = "Text fehlt...!<br />";

   // VARS - Headline - Galerie
   $rex_img_title             = "REX_VALUE[15]"; //titel der galerie
   $rex_img_title_size        = "REX_VALUE[16]"; //h-groesse des titels

   // VARS - Bild - Pfad
   $rex_img = ""; //bild default empty
   $rex_img_array_tmp         = "REX_MEDIALIST[1]"; //array bilder
   $rex_img_size              = "REX_VALUE[2]"; //bild groesse
   $rex_img_brand             = "REX_VALUE[4]"; //bild branding in resize und fancybox (brand.gif)

   // VARS - Bild - Title
   $rex_img_txt_display       = "REX_VALUE[6]"; //bild text on/off
   $rex_img_txt               = "REX_VALUE[7]"; //bild text
   $rex_img_txt_position      = "REX_VALUE[8]"; //bild text oben/unten

   // VARS - Bild - JQuery
   $rex_img_js                = "REX_VALUE[11]"; //array galerie aktiv
   $rex_img_js_style          = "REX_VALUE[12]"; //bild js window style
   $rex_img_size_window       = "REX_VALUE[13]"; //bild groesse lightbox

   // VARS - Galerie - DIV-Style
   $div_galerie               = "<div id=\"galerie\">"; //block der galerie
   $div_galerie_end           = "</div>"; //block ende galerie
   $div_class_size_width      = $rex_img_size + 20; //wert fuer die DIV Galerie
   $div_class_size_height     = $rex_img_size + 20; //wert fuer die DIV Galerie
   $div_class_img             = "<div class=\"galerie-image\" style=\"width:{$div_class_size_width}px; \">"; //innen
   $div_class_img_end         = "</div>"; //innen end


   // CHECK - Image-Title
   if ("" != $rex_img_title)
   {
      $rex_galerie_title = "<{$rex_img_title_size}>{$rex_img_title}</{$rex_img_title_size}>";
   }
   else
   {
      $rex_galerie_title = "";
   }

   // Check - Images (array)
   if ("" == $rex_img_array_tmp)
   {
      $ok_img = false;
   }

   // CHECK - Image-Description
   if ("" == $rex_img_txt)
   {
      $ok_txt = false;
   }

   // CHECK - Image-Branding
   if ("Brand-On" === $rex_img_brand)
   {
      $rex_img_brand = "";
   }
   else
   {
      $rex_img_brand = "";
   }


   if (true == $REX['REDAXO'])
   { //Ausgabe im Backend

      if (false == $ok_img)
      {
         echo $error_text . $ok_img_error;
      }

      if (false == $ok_txt)
      {
         echo $error_text . $ok_txt_error;
      }

      if (true == $ok_img)
      {
         // Galerie Title
         echo "{$rex_galerie_title}";

         // Bild in ARRAY einlesen
         $rex_img_array = explode(',', $rex_img_array_tmp);

         foreach ($rex_img_array as $rex_img)
         {
            // Bildtitel auslesen
            if ($rex_img_tmp = OOMedia::getMediaByFileName($rex_img))
            {
               $rex_img_txt = $rex_img_tmp->getTitle();
            }
            else
            {
               $rex_img_txt = $rex_img;
            }

            echo "<a href=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size_window}&rex_img_file={$rex_img}\"
                     rel=\"group-REX_ARTICLE_ID-REX_SLICE_ID\" class=\"fancyboxStyle{$rex_img_js_style}\" title=\"{$rex_img_txt}\">";
            echo "<img src=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size}&rex_img_file={$rex_img}\"
                     title=\"{$rex_img_txt}\" alt=\"{$rex_img}\" />";
            echo "</a>";
            echo "<br />{$rex_img_txt}<br />";
         }
      }
      else
      {
         echo $error_txt . $ok_img_error;
      }

   }
   else
   { //Ausgabe im Frontend

      echo "{$rex_galerie_title}";

      echo "{$div_galerie}"; //Start - DIV

      if ($ok_img == true)
      {
         //Zaehler fuer DIVs
         $i = 1;

         // Bild in ARRAY einlesen
         $rex_img_array = explode(',', $rex_img_array_tmp);

         foreach ($rex_img_array as $rex_img)
         {

            // Bildtitel auslesen
            if ($rex_img_tmp = OOMedia::getMediaByFileName($rex_img))
            {
               $rex_img_txt = $rex_img_tmp->getTitle();
            }
            else
            {
               $rex_img_txt = $rex_img;
            }

            echo "{$div_class_img}"; //Start - Image - DIV

            if ("Alt-Title-On" === $rex_img_txt_display)
            { // Alt-Title-On
               if ("Alt-Title-Top" === $rex_img_txt_position)
               {
                  echo "{$rex_img_txt}<br />";
               }

               if ("JS-On" == $rex_img_js) { // JS aktiviert
                  echo "<a href=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size_window}&rex_img_file={$rex_img}\"
                           rel=\"group-REX_ARTICLE_ID-REX_SLICE_ID\" class=\"fancyboxStyle{$rex_img_js_style}\" title=\"{$rex_img_txt}\">";
                  echo "<img src=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size}&rex_img_file={$rex_img}\"
                           title=\"{$rex_img_txt}\" alt=\"{$rex_img}\" />";
                  echo "<span class=\"zoom\"><!-- &nbsp; --></span>";
                  echo "</a>";
               }
               else
               { // JS deaktiviert
                  echo "<img src=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size}&rex_img_file={$rex_img}\"
                           title=\"{$rex_img_txt}\" alt=\"{$rex_img}\" />";
               }

               if ("Alt-Title-Bottom" === $rex_img_txt_position)
               {
                  echo "<br />{$rex_img_txt}";
               }
            }
            else
            {
               if ("JS-On" == $rex_img_js)
               { // JS aktiviert
                  echo "<a href=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size_window}&rex_img_file={$rex_img}\"
                           rel=\"group-REX_ARTICLE_ID-REX_SLICE_ID\" class=\"fancyboxStyle{$rex_img_js_style}\" title=\"{$rex_img_txt}\">";
                  echo "<img src=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size}&rex_img_file={$rex_img}\"
                           title=\"{$rex_img_txt}\" alt=\"{$rex_img}\" />";
                  echo "<span class=\"zoom\"><!-- &nbsp; --></span>";
                  echo "</a>";
               }
               else
               { // JS deaktiviert
                  echo "<img src=\"{$REX['HTDOCS_PATH']}index.php?rex_img_type=fancybox_resize_{$rex_img_size}&rex_img_file={$rex_img}\"
                           title=\"{$rex_img_txt}\" alt=\"{$rex_img}\" />";
               }
            }

            echo "{$div_class_img_end}"; //Ende - Image - DIV

            if ($i % 2 == 0)
            {
               echo "<div class=\"clearer\"></div>";
            }

            $i++;
         }
      }

      echo "{$div_galerie_end}"; //Ende - DIV

   }
?>