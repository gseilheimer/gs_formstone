<?php

class rex_gs_formstone_utils
{
    public static function includeMyPageHeader($params) {
        global $REX;

        $insert = PHP_EOL;
        $insert .= "\t" . '<!-- BEGIN AddOn gs:formstone -->' . PHP_EOL;
        $insert .= "\t" . '<link rel="stylesheet" type="text/css" href="' . $REX['HTDOCS_PATH'] . 'files/addons/boxer/jquery.fs.boxer.css" media="screen" />' . PHP_EOL;

        if ($REX['ADDON']['boxer']['settings']['include_jquery'] == 1) {
            $insert .= "\t" . '<script type="text/javascript" src="' . $REX['HTDOCS_PATH'] . 'files/addons/boxer/jquery-1.11.1.min.js"></script>' . PHP_EOL;
        }

        $insert .= "\t" . '<script type="text/javascript" src="' . $REX['HTDOCS_PATH'] . 'files/addons/boxer/jquery.fs.boxer.min.js"></script>' . PHP_EOL;
        $insert .= "\t" . '<script type="text/javascript" src="' . $REX['HTDOCS_PATH'] . 'files/addons/boxer/init.js"></script>' . PHP_EOL;
        $insert .= "\t" . '<!-- END AddOn Boxer -->' . PHP_EOL;

        return str_replace('</head>', $insert . '</head>', $params['subject']);
    }

    public static function getSettingsFile($mypage)
    {
        global $REX;

        $dataDir = $REX['INCLUDE_PATH'] . '/data/addons/' . $mypage . '/';

        return $dataDir . 'settings.inc.php';
    }

    public static function includeSettingsFile()
    {
        global $REX; // important for include

        $settingsFile = self::getSettingsFile();

        if (!file_exists($settingsFile)) {
            self::updateSettingsFile(false);
        }

        require_once($settingsFile);
    }

    public static function updateSettingsFile($mypage, $showSuccessMsg = true)
    {
        global $REX, $I18N;

        $settingsFile = self::getSettingsFile();
        $msg = self::checkDirForFile($settingsFile);

        if ($msg != '') {
            if ($REX['REDAXO']) {
                echo rex_warning($msg);
            }
        } else {
            if (!file_exists($settingsFile)) {
                self::createDynFile($settingsFile);
            }

            $content = "<?php\n\n";

            foreach ((array)$REX['ADDON'][$mypage]['settings'] as $key => $value) {
                $content .= "\$REX['ADDON'][$mypage]['settings']['$key'] = " . var_export($value, true) . ";\n";
            }

            if (rex_put_file_contents($settingsFile, $content)) {
                if ($REX['REDAXO'] && $showSuccessMsg) {
                    echo rex_info($I18N->msg($mypage.'_config_ok'));
                }
            } else {
                if ($REX['REDAXO']) {
                    echo rex_warning($I18N->msg($mypage.'_config_error'));
                }
            }
        }
    }

    public static function replaceSettings($mypage, $settings)
    {
        global $REX;

        // type conversion
        foreach ($REX['ADDON'][$mypage]['settings'] as $key => $value) {
            if (isset($settings[$key])) {
                $settings[$key] = self::convertVarType($value, $settings[$key]);
            }
        }

        $REX['ADDON'][$mypage]['settings'] = array_merge((array)$REX['ADDON'][$mypage]['settings'], $settings);
    }

    public static function createDynFile($file)
    {
        $fileHandle = fopen($file, 'w');

        fwrite($fileHandle, "<?php\r\n");
        fwrite($fileHandle, "// --- DYN\r\n");
        fwrite($fileHandle, "// --- /DYN\r\n");

        fclose($fileHandle);
    }

    public static function checkDir($mypage, $dir)
    {
        global $REX, $I18N;

        $path = $dir;

        if (!@is_dir($path)) {
            @mkdir($path, $REX['DIRPERM'], true);
        }

        if (!@is_dir($path)) {
            if ($REX['REDAXO']) {
                return $I18N->msg($mypage.'_install_make_dir', $dir);
            }
        } elseif (!@is_writable($path . '/.')) {
            if ($REX['REDAXO']) {
                return $I18N->msg($mypage.'_install_perm_dir', $dir);
            }
        }

        return '';
    }

    public static function checkDirForFile($fileWithPath)
    {
        $pathInfo = pathinfo($fileWithPath);

        return self::checkDir($pathInfo['dirname']);
    }

    public static function convertVarType($originalValue, $newValue)
    {
        $arrayDelimiter = ',';

        switch (gettype($originalValue)) {
            case 'string':
                return trim($newValue);
                break;
            case 'integer':
                return intval($newValue);
                break;
            case 'boolean':
                return (bool)$newValue;
                break;
            case 'array':
                if ($newValue == '') {
                    return array();
                } else {
                    return explode($arrayDelimiter, $newValue);
                }
                break;
            default:
                return $newValue;

        }
    }

    public static function getHtmlFromMDFile($mypage, $mdFile, $search = array(), $replace = array(), $setBreaksEnabled = true)
    {
        global $REX;

        $curLocale = strtolower($REX['LANG']);

        if ($curLocale == 'de_de') {
            $file = $REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/' . $mdFile;
        } else {
            $file = $REX['INCLUDE_PATH'] . '/addons/' . $mypage . '/lang/' . $curLocale . '/' . $mdFile;
        }

        if (file_exists($file)) {
            $md = file_get_contents($file);
            $md = str_replace($search, $replace, $md);
            $md = self::makeHeadlinePretty($md);

            if (method_exists('Parsedown', 'set_breaks_enabled')) {
                $out = Parsedown::instance()->set_breaks_enabled($setBreaksEnabled)->parse($md);
            } elseif (method_exists('Parsedown', 'setBreaksEnabled')) {
                $out = Parsedown::instance()->setBreaksEnabled($setBreaksEnabled)->parse($md);
            } else {
                $out = Parsedown::instance()->parse($md);
            }

            return $out;
        } else {
            return '[translate:' . $file . ']';
        }
    }

    public static function makeHeadlinePretty($mypage, $md)
    {
        return str_replace($mypage . ' - ', '', $md);
    }
}

