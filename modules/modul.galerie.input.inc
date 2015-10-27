<?php
/**
 *=======================================================
 * Modul: Galerie (Format + Layout (jquery))
 * Bereich: Eingabe
 * Version: 2.1.4
 * Redaxo Version: 4.5
 * Redaxo AddOns: Image Manager & GS:FancyBox2
 * Erstellung: contic.de, G. Seilheimer
 * Datum: 2013-04-26
 *=======================================================
 */

if(OOAddon::isAvailable('image_manager') && OOAddon::isAvailable('gs_fancybox2'))
{
   ?>
   <!--
   <script type="text/javascript">
      // $ is assigned to jQuery
      ;(function($) {

         // DOM Ready
         $(function() {

            $(".toggle_container").hide();
            $("h2.trigger:first").addClass("active");
            $(".toggle_container:first").slideToggle("slow,");

            $("h2.trigger").toggle(function(){
               $(this).addClass("active");
            }, function(){
               $(this).removeClass("active");
            });

            $("h2.trigger").click(function(){
               $(this).next(".toggle_container").slideToggle("slow,");
            });

         });

      })(jQuery);
   </script>
   -->

   <style type="text/css">
      <!--
         /* start - div */
      .container {
         width: 700px;
         margin: 0 auto;
      }
      h2.trigger {
         padding: 0 0 0 20px;
         margin: 0 0 5px 0;
         background: #3C9ED0;
         height: 46px;
         line-height: 46px;
         width: 680px;
         font-size: 1.5em;
         font-weight: normal;
         float: left;
      }
      h2.trigger a {
         color: #fff;
         text-decoration: none;
         display: block;
      }
      h2.trigger a:hover {
         color: #ccc;
      }
      h2.active {
         background: #14568a;
      }
      .toggle_container {
         margin: 0 0 5px;
         padding: 0;
         border-top: 1px solid #d6d6d6;
         background: #f0f0f0;
         overflow: hidden;
         font-size: 1.0em;
         line-height: 1.5em;
         width: 700px;
         clear: both;
      }
      .toggle_container .block {
         padding: 20px;
         background: #f0f0f0;
      }
      .toggle_container .block p {
         padding: 5px 0;
         margin: 5px 0;
      }
      .toggle_container h3 {
         font: 1.5em normal Georgia, "Times New Roman", Times, serif;
         margin: 0 0 10px;
         padding: 0 0 5px 0;
         border-bottom: 1px dashed #ccc;
      }
      .toggle_container img {
         float: left;
         margin: 10px 15px 15px 0;
         padding: 5px;
         background: #ddd;
         border: 1px solid #ccc;
      }
         /* end - div */
      -->
   </style>
   <div class="container">

   <h2 class="trigger"><a href="#">GALERIE (Basics) (An/Aus)</a></h2>
   <div class="toggle_container">
      <div class="block">

         <h3>Titel der Galerie</h3>
         <p>
            <input type="text" name="VALUE[15]" value="REX_VALUE[15]" size="80" />
         </p>

         <h3>Groesse des Titels (h1 = gross | h6 = klein)</h3>
         <p>
            <select name="VALUE[16]" id="VALUE[16]">
               <?php
               foreach (array("h1", "h2", "h3", "h4", "h5", "h6") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[16]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>
         <p>
            REX_MEDIALIST_BUTTON[1]
         </p>

         <h3>Groese der Thumbnails</h3>
         <p>
            <select name="VALUE[2]" id="VALUE[2]">
               <?php
               foreach (array("100", "200", "300", "450", "600", "800", "950") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[2]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>

         <h3>Branding der Bilder (Galerieansicht)</h3>
         <p>
            <select name="VALUE[4]" id="VALUE[4]">
               <?php
               foreach (array("Brand-Off", "Brand-On") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[4]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>
      </div>
   </div>

   <h2 class="trigger"><a href="#">GALERIE (Title) (An/Aus)</a></h2>
   <div class="toggle_container">
      <div class="block">
         <h3>Bildtext (On/Off)</h3>
         <p>
            <select name="VALUE[6]" id="VALUE[6]">
               <?php
               foreach (array("Alt-Title-Off", "Alt-Title-On") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[6]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>

         <h3>Bildtext (Eigener Title moeglich)</h3>
         <p>
            <input type="text" name="VALUE[7]" value="REX_VALUE[7]" size="80" />
         </p>

         <h3>Bildtext (Ausrichtung)</h3>
         <p>
            <select name="VALUE[8]" id="VALUE[8]">
               <?php
               foreach (array("Alt-Title-Bottom", "Alt-Title-Top") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[8]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>
      </div>
   </div>

   <h2 class="trigger"><a href="#">FANCYBOX (Basics) (An/Aus)</a></h2>
   <div class="toggle_container">
      <div class="block">
         <h3>Galeriefunktion (On/Off)</h3>
         <p>
            <select name="VALUE[11]" id="VALUE[11]">
               <?php
               foreach (array("JS-On", "JS-Off") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[11]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>

         <h3>Galeriestyle</h3>
         <p>
            <select name="VALUE[12]" id="VALUE[12]">
               <?php
               foreach (array("Default", "GalerieSpecial-1", "GalerieSpecial-2") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[12]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>

         <h3>Galeriegroesse (Bild)</h3>
         <p>
            <select name="VALUE[13]" id="VALUE[13]">
               <?php
               foreach (array("450", "600", "800", "950", "1200") as $value)
               {
                  echo '<option value="'.$value.'" ';

                  if ("REX_VALUE[13]" == "$value") {
                     echo 'selected="selected" ';
                  }

                  echo '>'.$value.'</option>';
               }
               ?>
            </select>
         </p>
      </div>
   </div>
<?php

}
else
{
   echo rex_warning('Dieses Modul benoetigt das "image_manager" Addon & das "gs_fancybox2" Addon!');
}

?>