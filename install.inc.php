<?php

/**
 * gs_formstone
 * @author gilbert.seilheimer[at]contic[dot]de Gilbert Seilheimer
 * @author <a href="http://www.contic.de">www.contic.de</a>
 */

// AddOn-FORMSTONE

   //////////////////////////////////////////////////////////////////////////////////
   // CONFIG
   //////////////////////////////////////////////////////////////////////////////////

   // VARs
   $mypage = "gs_formstone";
   $fsr = 100;

   // MSG
   $msg = '';

   //////////////////////////////////////////////////////////////////////////////////
   // CHECKS
   //////////////////////////////////////////////////////////////////////////////////

   if ($REX['VERSION'] != '4' || $REX['SUBVERSION'] < '6') {
      $msg = $I18N->msg('install_redaxo_version_problem', '4.6');

   } elseif (version_compare(PHP_VERSION, '5.5.0', '<')) {
      $msg = $I18N->msg('install_checkphpversion', PHP_VERSION);

   } elseif (OOAddon::isAvailable('textile') != 1 || OOAddon::getVersion('textile') < '1.5') {
      $msg = $I18N->msg('gs_formstone_install_textile_version_problem', '1.5');

   }
   #elseif (OOAddon::isAvailable('gs_markitup') != 1 || OOAddon::getVersion('gs_markitup') < '2.0') {
   #   $msg = $I18N->msg('gs_formstone_install_gs_markitup_version_problem', '2.0');

   #}


   //////////////////////////////////////////////////////////////////////////////////
   // INSTALL
   //////////////////////////////////////////////////////////////////////////////////

   if ($msg != '') {
      $REX['ADDON']['installmsg'][$mypage] = $msg;

   } else {

      //////////////////////////////////////////////////////////////////////////////////
      // UPDATE/INSERT (DB)
      //////////////////////////////////////////////////////////////////////////////////

      $sql = rex_sql::factory();

      $sql->debugsql = 0; //Ausgabe Query

      $sql_table_tpl = $REX['TABLE_PREFIX']."template";

      $sql->setQuery("SELECT * FROM $sql_table_tpl WHERE name LIKE '%tpl : addon gs_formstone (css)%'");
      $sql->setTable($sql_table_tpl);

      if( $sql->getRows() != 0 )
      {
         $sql_id = $sql->getValue('id');
         $sql->setWhere('id = ' .$sql_id);
         $sql->setValue("content", "<!-- GS:FORMSTONE-CSS-START -->\r\n<!-- css default -->\r\n<link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/lightbox.css\" media=\"screen, projection\" />\r\n<!-- css addons - background -->\r\n<!-- <link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/background.css\" media=\"screen, projection\" /> -->\r\n<!-- css addons - carousel -->\r\n<!-- <link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/carousel.css\" media=\"screen, projection\" /> -->\r\n<!-- GS:FORMSTONE-CSS-ENDE -->");

         if ( $sql->update() )
         {
            echo rex_info("Template mit ID : $sql_id erfolgreich aktuallisiert. <br />");
         }
      }
      else
      {
         $sql->setValue("name", "tpl : addon gs_formstone (css)");
         $sql->setValue("content", "<!-- GS:FORMSTONE-CSS-START -->\r\n<!-- css default -->\r\n<link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/lightbox.css\" media=\"screen, projection\" />\r\n<!-- css addons - background -->\r\n<!-- <link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/background.css\" media=\"screen, projection\" /> -->\r\n<!-- css addons - carousel -->\r\n<!-- <link rel=\"stylesheet\" href=\"/files/addons/gs_formstone/css/carousel.css\" media=\"screen, projection\" /> -->\r\n<!-- GS:FORMSTONE-CSS-ENDE -->");

         if ( $sql->insert() )
         {
            echo rex_info("Template 'tpl : addon gs_formstone' erfolgreich eingetragen. <br />");
         }
      }


      //////////////////////////////////////////////////////////////////////////////////
      // UPDATE/INSERT (DB)
      //////////////////////////////////////////////////////////////////////////////////

      $sql_table_tpl = $REX['TABLE_PREFIX']."template";

      $sql->setQuery("SELECT * FROM $sql_table_tpl WHERE name LIKE '%tpl : addon gs_formstone (js)%'");
      $sql->setTable($sql_table_tpl);

      if( $sql->getRows() != 0 )
      {
         $sql_id = $sql->getValue('id');
         $sql->setWhere('id = ' .$sql_id);
         $sql->setValue("content", "<!-- GS:JQUERY-START -->\r\n<!-- <script src=\"/redaxo/media/jquery.min.js\"></script> -->\r\n<!-- ist manuel auf die aktuelle version von jquery inkl. map zu aktualisieren -->\r\n<!-- GS:JQUERY-ENDE -->\r\n\r\n<!-- GS:FORMSTONE-JS-START -->\r\n<!-- js default -->\r\n\r\n<script src=\"/files/addons/gs_formstone/js/core.js\"></script>\r\n<script src=\"/files/addons/gs_formstone/js/touch.js\"></script>\r\n<script src=\"/files/addons/gs_formstone/js/transition.js\"></script>\r\n\r\n<script src=\"/files/addons/gs_formstone/js/lightbox.js\"></script>\r\n\r\n<!-- js addons - background -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/background.js\"></script> -->\r\n\r\n<!-- js addons - carousel -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/carousel.js\"></script> -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/mediaquery.js\"></script> -->\r\n<!-- GS:FORMSTONE-JS-ENDE -->\r\n\r\n<!-- GS:FORMSTONE-JS-SCRIPT-START -->\r\n<script>\r\n\r\n    // FS LIGHTBOX\r\n    function fs_lightbox_default(obj) {\r\n        if(!obj.length) return;\r\n\r\n        obj.lightbox({\r\n\r\n        });\r\n    }//end function\r\n\r\n    // FS CAROUSEL\r\n    function fs_carousel_default(obj) {\r\n        if(!obj.length) return;\r\n\r\n        obj.carousel({\r\n\r\n        });\r\n    }//end function\r\n\r\n    // READY - START\r\n    $(document).ready(function() {\r\n\r\n        // Call - FS LIGHTBOX\r\n        fs_lightbox_default($(\"a.lightbox\"));\r\n\r\n        // Call - FS CAROUSEL\r\n        //fs_carousel_default($(\"a.lightbox\"));\r\n\r\n    });\r\n    // Ende ready function()\r\n\r\n</script>\r\n<!-- GS:FORMSTONE-JS-SCRIPT-ENDE -->");

         if ( $sql->update() )
         {
            echo rex_info("Template mit ID : $sql_id erfolgreich aktuallisiert. <br />");
         }
      }
      else
      {
         $sql->setValue("name", "tpl : addon gs_formstone (js)");
         $sql->setValue("content", "<!-- GS:JQUERY-START -->\r\n<!-- <script src=\"/redaxo/media/jquery.min.js\"></script> -->\r\n<!-- ist manuel auf die aktuelle version von jquery inkl. map zu aktualisieren -->\r\n<!-- GS:JQUERY-ENDE -->\r\n\r\n<!-- GS:FORMSTONE-JS-START -->\r\n<!-- js default -->\r\n\r\n<script src=\"/files/addons/gs_formstone/js/core.js\"></script>\r\n<script src=\"/files/addons/gs_formstone/js/touch.js\"></script>\r\n<script src=\"/files/addons/gs_formstone/js/transition.js\"></script>\r\n\r\n<script src=\"/files/addons/gs_formstone/js/lightbox.js\"></script>\r\n\r\n<!-- js addons - background -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/background.js\"></script> -->\r\n\r\n<!-- js addons - carousel -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/carousel.js\"></script> -->\r\n<!-- <script src=\"/files/addons/gs_formstone/js/mediaquery.js\"></script> -->\r\n<!-- GS:FORMSTONE-JS-ENDE -->\r\n\r\n<!-- GS:FORMSTONE-JS-SCRIPT-START -->\r\n<script>\r\n\r\n    // FS LIGHTBOX\r\n    function fs_lightbox_default(obj) {\r\n        if(!obj.length) return;\r\n\r\n        obj.lightbox({\r\n\r\n        });\r\n    }//end function\r\n\r\n    // FS CAROUSEL\r\n    function fs_carousel_default(obj) {\r\n        if(!obj.length) return;\r\n\r\n        obj.carousel({\r\n\r\n        });\r\n    }//end function\r\n\r\n    // READY - START\r\n    $(document).ready(function() {\r\n\r\n        // Call - FS LIGHTBOX\r\n        fs_lightbox_default($(\"a.lightbox\"));\r\n\r\n        // Call - FS CAROUSEL\r\n        //fs_carousel_default($(\"a.lightbox\"));\r\n\r\n    });\r\n    // Ende ready function()\r\n\r\n</script>\r\n<!-- GS:FORMSTONE-JS-SCRIPT-ENDE -->");

         if ( $sql->insert() )
         {
            echo rex_info("Template 'tpl : addon gs_formstone' erfolgreich eingetragen. <br />");
         }
      }


      //////////////////////////////////////////////////////////////////////////////////
      // UPDATE/INSERT (DB)
      //////////////////////////////////////////////////////////////////////////////////

      $sql_table_types = $REX['TABLE_PREFIX']."679_types";
      $sql_table_effects = $REX['TABLE_PREFIX']."679_type_effects";

      while ( $fsr <= 1200 ) {

         $sql->setQuery("SELECT * FROM $sql_table_types WHERE name LIKE '%formstone_resize_{$fsr}%'");
         $sql->setTable($sql_table_types);

         if( $sql->getRows() != 0) {
            // update image type
            $sql_id = $sql->getValue('id');
            $sql->setWhere("id = $sql_id");
            $sql->setValue("status", 1);
            $sql->setValue("name", "formstone_resize_{$fsr}");
            $sql->setValue("description", "FS RESIZE[{$fsr}px]");

            if ( $sql->update() )
            {
               echo rex_info("Type mit ID : $sql_id erfolgreich aktuallisiert. <br />");
            }

         } else {
            // insert image type
            $sql->setValue("status", 1);
            $sql->setValue("name", "formstone_resize_{$fsr}");
            $sql->setValue("description", "FS RESIZE[{$fsr}px]");

            if ( $sql->insert() )
            {
               echo rex_info("Type mit 'formstone_resize_{$fsr}' erfolgreich eingetragen. <br />");
            }
         }

         // save last insert id
         #$sql_lastId = $sql->getLastId();
         #echo "LAST SQL ID: $sql_lastId";
         #echo "SQL ID: $sql_id";

         $sql->setQuery("SELECT * FROM $sql_table_effects, $sql_table_types WHERE name LIKE '%formstone_resize_{$fsr}%' AND rex_679_types.id = rex_679_type_effects.type_id");
         $sql->setTable($sql_table_effects);

         if( $sql->getRows() != 0) {
            // update effect type
            $sql->setQuery("SELECT * FROM $sql_table_types WHERE name LIKE '%formstone_resize_{$fsr}%'");
            $sql_id = $sql->getValue('id');

            $sql->setTable($sql_table_effects);
            $sql->setWhere("id = $sql_id");
            $sql->setValue("type_id", $sql_id);
            $sql->setValue("effect", "resize");
            $sql->setValue("parameters", "a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"{$fsr}\";s:24:\"rex_effect_resize_height\";s:3:\"{$fsr}\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}");
            $sql->setValue("prior", 1);
            $sql->setValue("updatedate", time());
            $sql->setValue("updateuser", "gs");
            $sql->setValue("createdate", time());
            $sql->setValue("createuser", "gs");

            if ( $sql->update() )
            {
               echo rex_info("Type mit ID : $sql_id erfolgreich aktuallisiert. <br />");
            }

         } else {
            // insert effect type
            $sql->setQuery("SELECT * FROM $sql_table_types WHERE name LIKE '%formstone_resize_{$fsr}%'");
            $sql_id = $sql->getValue('id');

            $sql->setTable($sql_table_effects);
            $sql->setValue("type_id", $sql_id);
            $sql->setValue("effect", "resize");
            $sql->setValue("parameters", "a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"{$fsr}\";s:24:\"rex_effect_resize_height\";s:3:\"{$fsr}\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}");
            $sql->setValue("prior", 1);
            $sql->setValue("updatedate", time());
            $sql->setValue("updateuser", "gs");
            $sql->setValue("createdate", time());
            $sql->setValue("createuser", "gs");

            if ( $sql->insert() )
            {
               echo rex_info("Type mit 'formstone_resize_{$fsr}' erfolgreich eingetragen. <br />");
            }

         }

         // count pixels + 100 = 8 Inserts (Types + Effects)
         $fsr = $fsr + 150;

      }


      //////////////////////////////////////////////////////////////////////////////////
      // INSTALL - FINISHING
      //////////////////////////////////////////////////////////////////////////////////

      if ( $sql->hasError() ) {
         $msg = 'MySQL-Error: ' . $sql->getErrno() . '<br />';
         $msg .= $sql->getError();

         $REX['ADDON']['install'][$mypage] = FALSE;
         $REX['ADDON']['installmsg'][$mypage] = $msg;

      } else {
         $REX['ADDON']['install'][$mypage] = TRUE;

      }

   }