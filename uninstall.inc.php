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


   //////////////////////////////////////////////////////////////////////////////////
   // UPDATE (DB)
   //////////////////////////////////////////////////////////////////////////////////


   $sql_table = $REX['TABLE_PREFIX']."template";

   $sql = rex_sql::factory();
   $sql->debugsql = 1; //Ausgabe Query
   $sql->setQuery("SELECT * FROM $sql_table WHERE name LIKE '%tpl : addon gs_formstone%'");
   $sql->setTable($sql_table);

   if( $sql->getRows() != 0 )
   {
      $sql_id = $sql->getValue('id');
      $sql->setWhere('id = '.$sql_id);
      $sql->setValue("content", "<!-- GS:FORMSTONE-START -->\r\nADDON gs_formstone deinstalliert\r\n<!-- GS:FORMSTONE-ENDE -->");

      if ( $sql->update() )
      {
         echo "Template mit ID : $sql_id erfolgreich aktuallisiert.";
      }
   }


   //////////////////////////////////////////////////////////////////////////////////
   // UNINSTALL
   //////////////////////////////////////////////////////////////////////////////////

   $REX['ADDON']['install'][$mypage] = FALSE;