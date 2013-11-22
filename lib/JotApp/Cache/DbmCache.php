<?php

namespace JotApp\Cache;

use JotApp\Cache\Cache;

class DbmCache implements Cache {
    // DBM modes in ascending order of capabilities
    const MODE_READABLE  = 'r';
    const MODE_WRITEABLE = 'w';
    const MODE_CREATABLE = 'c';
    const MODE_TRUNCATE  = 'n';

    private $dbmFile;
    private $dbmMode = self::MODE_READABLE;
    private $dbmType = 'db4'; // Default handler BDB4+
    private $dbm;

    
    public function __construct() {
    }

    
    public function __destruct() {
        $this->_close();
    }


    public function close() {
        if ($this->dbm) {
            $this->_close();
        }
    }

    public function setFilePath($filePath, $dbmType = NULL) {
        $this->dbmFile = $filePath;

        if ($dbmType) {
            // TODO: Check that the type is supported by PHP instance
            $this->dbmType = $dbmType;
        }
    }

    public function setMode($mode) {
        $this->dbmMode = $mode;
    }


    public function exists($key) {
        $this->_init();
        return dba_exists($key, $this->dbm);
    }


    public function get($key) {
        //$this->_init();
        $response = NULL;

        if ($this->exists($key)) {
            $response = dba_fetch($key, $this->dbm);
        }

        return $response;
    }


    public function set($key, $value) {
        $this->_init();
        $this->_setWriteable();
        return dba_replace($key, $value, $this->dbm);
    }


    public function delete($key) {
        $this->_init();
        return dba_delete($key, $this->dbm);
    }


    /**
        _setWriteable -- sets the dbm file to writeable if it's in a readable state.
    **/
    protected function _setWriteable() {
        if ($this->dbmMode === self::MODE_READABLE) {
            $this->_close();
            $this->setMode(self::WRITEABLE);
            $this->_init();
        }
    }


    /**
        _init -- initialises a new dbm connection
    **/
    protected function _init() {
        if (!$this->dbm) {
            $this->_connect();
        }
    }


    /**
        _connect -- connects to the dbm file, given the path, mode and dbm type
    **/
    protected function _connect() {
        $dbm = dba_open($this->dbmFile, $this->dbmMode, $this->dbmType);

        if (!$dbm) {
            echo "[ERROR] Can'd open DBM file $this->dbmFile\n";
            exit;
        }

        $this->dbm = $dbm;
    }


    /**
        _close -- closes the current dbm file handle
    **/
    protected function _close() {
        if ($this->dbm) {
            dba_close($this->dbm);
            $this->dbm = NULL;
        }
    }

}

?>
