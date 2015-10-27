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

	// GET PARAMS
	////////////////////////////////////////////////////////////////////////////////
	$page 	   = rex_request('page', 'string');
	$subpage 	= rex_request('subpage', 'string');
	$func    	= rex_request('func', 'string');
	#$oid     	= rex_request('oid', 'int');

	// save settings
	if ($func == 'update') {
		$settings = (array) rex_post('settings', 'array', array());

		rex_gs_formstone_utils::replaceSettings($settings);
		rex_gs_formstone_utils::updateSettingsFile();
	}

	//////////////////////////////////////////////////////////////////////////////////
	// CONFIG
	//////////////////////////////////////////////////////////////////////////////////

	/*
	// retrieve links to imagetypes
	$sql = new rex_sql();
	//$sql->debugsql = true;
	$sql->setQuery("SELECT id FROM `" . $REX['TABLE_PREFIX'] . "679_types` WHERE name LIKE 'boxer_image_thumb'");

	if ($sql->getRows() == 1) {
		$imageManagerLinkImage = 'index.php?page=image_manager&subpage=effects&type_id=' . $sql->getValue('id');
	} else {
		$imageManagerLinkImage = 'index.php?page=image_manager&subpage=types';
	}

	$sql->setQuery("SELECT id FROM `" . $REX['TABLE_PREFIX'] . "679_types` WHERE name LIKE 'boxer_gallery_thumb'");

	if ($sql->getRows() == 1) {
		$imageManagerLinkGallery = 'index.php?page=image_manager&subpage=effects&type_id=' . $sql->getValue('id');
	} else {
		$imageManagerLinkGallery = 'index.php?page=image_manager&subpage=types';
	}
	*/

	//////////////////////////////////////////////////////////////////////////////////
	// SUBPAGES
	//////////////////////////////////////////////////////////////////////////////////

?>

<div class="rex-addon-output">
	<div class="rex-form">

		<h2 class="rex-hl2"><?php echo $I18N->msg('gs_formstone_settings'); ?></h2>

		<form action="index.php" method="post">

			<fieldset class="rex-form-col-1">
				<div class="rex-form-wrapper">
					<input type="hidden" name="page" value="<?php echo $page; ?>" />
					<input type="hidden" name="subpage" value="<?php echo $subpage; ?>" />
					<input type="hidden" name="func" value="update" />

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-text">
							<label for="foo"><?php echo $I18N->msg('gs_formstone_settings_foo'); ?></label>
							<input type="text" value="<?php echo $REX['ADDON'][$page]['settings']['foo']; ?>" name="settings[foo]" id="foo" class="rex-form-text">
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-checkbox">
							<label for="foo2"><?php echo $I18N->msg('gs_formstone_settings_foo2'); ?></label>
							<input type="hidden" name="settings[foo2]" value="0" />
							<input type="checkbox" name="settings[foo2]" id="foo2" value="1" <?php if ($REX['ADDON'][$page]['settings']['foo2']) { echo 'checked="checked"'; } ?>>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-col-a rex-form-read">
							<label for="imagetype_gallery"><?php echo $I18N->msg('gs_settings_imagetype_gallery'); ?></label>
							<span class="rex-form-read" id="imagetype_gallery"><a href="<?php echo $imageManagerLinkGallery; ?>">boxer_gallery_thumb</a></span>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-col-a rex-form-read">
							<label for="imagetype_image"><?php echo $I18N->msg('boxer_settings_imagetype_image'); ?></label>
							<span class="rex-form-read" id="imagetype_image"><a href="<?php echo $imageManagerLinkImage; ?>">boxer_image_thumb</a></span>
						</p>
					</div>

					<div class="rex-form-row rex-form-element-v1">
						<p class="rex-form-submit">
							<input type="submit" class="rex-form-submit" name="sendit" value="<?php echo $I18N->msg('gs_formstone_settings_save'); ?>" />
						</p>
					</div>

				</div>
			</fieldset>
		</form>
	</div>
</div>



