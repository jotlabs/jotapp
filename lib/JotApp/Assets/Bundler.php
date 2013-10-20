<?php

namespace JotApp\Assets;

class Bundler {
    protected $cssRoot     = '';
    protected $jsRoot      = '';
    protected $cssBundle   = array();
    protected $jsBundle    = array();

    public function __construct($config=NULL) {
        if (is_array($config)) {
            if (!empty($config['cssRoot'])) {
                $this->cssRoot = $config['cssRoot'];
            }
            if (!empty($config['jsRoot'])) {
                $this->jsRoot = $config['jsRoot'];
            }

        }
    }

    public function bundle($bundleName, $type='css') {
        $bundle   = $this->_getBundleByType($type);
        $filePath = $this->_getFilePathByType($type);

        $buffer = '/* Bundle: $bundleName not found */';

        if (!empty($bundle)) {
            $buffer = $this->_recurseBundle($bundle, $bundleName, $filePath);
            if (is_array($buffer)) {
                $buffer = implode('', $buffer);
            }

        } else {
            // TODO: Report as an Error Object
            echo "No Bundle of Type '$type' found.\n";

        }

        return $buffer;
    }


    protected function _getBundleByType($type) {
        $bundle = NULL;
        switch($type) {
            case 'css':
                $bundle = $this->cssBundle;
                break;
            case 'js':
                $bundle = $this->jsBundle;
                break;
            default:
                break;
        }
        return $bundle;
    }


    protected function _getFilePathByType($type) {
        $filePath = '';
        switch($type) {
            case 'css':
                $filePath = $this->cssRoot;
                break;
            case 'js':
                $filePath = $this->jsRoot;
                break;
            default:
                break;
        }
        return $filePath;
    }


    protected function _recurseBundle($bundle, $bundleName, $filePath) {
        $buffer = array();
        if (array_key_exists($bundleName, $bundle)) {
            foreach($bundle[$bundleName] as $bundleRef) {
                if ($bundleRef[0]==='@') {
                    // References another bundle
                    //echo "$bundleName REFERENCE $bundleRef\n";
                    array_splice(
                        $buffer,
                        count($buffer),
                        0,
                        $this->_recurseBundle($bundle, substr($bundleRef, 1), $filePath)
                    );
                } elseif (file_exists($filePath . $bundleRef)) {
                    // References an asset file
                    //echo "$bundleName FILE $filePath$bundleRef\n";
                    $buffer[] = file_get_contents($filePath . $bundleRef);
                } else {
                    echo "// $bundleName UNKNOWN $bundleRef\n";

                }
            }
        }
        return $buffer;
    }

}

?>
