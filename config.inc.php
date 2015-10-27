<?php

/**
 * gs_formstone
 * @author gilbert.seilheimer[at]contic[dot]de Gilbert Seilheimer
 * @author <a href="http://www.contic.de">www.contic.de</a>
 *
 * @package redaxo4
 * @version svn:$Id$
 */
/**
 * formstone lib
 * @link https://github.com/Formstone/Formstone
 * @version 0.7.5
 */

// AddOn-FORMSTONE

	//////////////////////////////////////////////////////////////////////////////////
	// CONFIG
	//////////////////////////////////////////////////////////////////////////////////

   // VARs
   $mypage = "gs_formstone";
   $mypage_root = $REX['INCLUDE_PATH'].'/addons/'.$mypage.'/';

   // VARs - ADDON
   $REX['ADDON']['name'][$mypage]          = 'Formstone';
   $REX['ADDON']['rxid'][$mypage]          = '1242';
   $REX['ADDON']['page'][$mypage]          = $mypage;
   $REX['ADDON']['version'][$mypage]       = '1.0.0';
   $REX['ADDON']['author'][$mypage]        = 'Gilbert Seilheimer';
   $REX['ADDON']['supportpage'][$mypage]   = 'forum.redaxo.org';
   $REX['ADDON']['perm'][$mypage]          = $mypage.'[]';
   $REX['PERM'][]                        = $mypage.'[]';


   if( $REX['REDAXO'] && $REX['USER'] )
   {

      //////////////////////////////////////////////////////////////////////////////////
      // INCLUDES
      //////////////////////////////////////////////////////////////////////////////////
      #require_once $addon_root.'.......inc.php';
      require_once($mypage_root .'/classes/class.rex_gs_formstone_utils.inc.php');


      //////////////////////////////////////////////////////////////////////////////////
      // FUNCTIONS
      //////////////////////////////////////////////////////////////////////////////////

      /*
      // default settings (user settings are saved in data dir!)
      $REX['ADDON'][$mypage]['settings'] = array(
          'foo' => 'bar',
          'foo2' => true,
      );

      // overwrite default settings with user settings
      rex_gs_formstone_utils::includeSettingsFile();
      */


      //////////////////////////////////////////////////////////////////////////////////
      // SUBPAGES
      //////////////////////////////////////////////////////////////////////////////////

      // Sprachdateien anhaengen
      $I18N->appendFile($REX['INCLUDE_PATH'].'/addons/'.$mypage.'/lang/');

      $REX['ADDON'][$mypage]['SUBPAGES'] =
         //        subpage,         label,                                       perm,   params, attributes
         array(
            array('',               $I18N->msg($mypage.'_subpage_index'),           '',     '',     ''),
            array('readme',         $I18N->msg($mypage.'_subpage_readme'),          '',     '',     ''),
            array('modul_image',    $I18N->msg($mypage.'_subpage_modul_image'),     '',     '',     ''),
            array('modul_galery',   $I18N->msg($mypage.'_subpage_modul_galery'),    '',     '',     ''),
         );



   } else {

      //////////////////////////////////////////////////////////////////////////////////
      // INCLUDES HEADER
      //////////////////////////////////////////////////////////////////////////////////

      #rex_register_extension('OUTPUT_FILTER', 'rex_gs_formstone_utils::includeMyPageHeader');

   }


