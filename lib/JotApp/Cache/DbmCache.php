<?php

namespace JotApp\Cache;

use JotApp\Cache\Cache;

class DbmCache implements Cache {
    const MODE_READABLE  = 'r';
    const MODE_WRITEABLE = 'w';
    const MODE_CREATABLE = 'c';
    const MODE_TRUNCATE  = 'n';

    private $dbmFile;
    private $dbmMode = self::MODE_READABLE;
    private $dbmType;
    private $dbm;

    
    public function __construct() {
        // TODO: Get these settings from config
        $this->dbmFile = '/tmp/test.db';
        $this->dbmType = 'db4';
    }

    
    public function __destruct() {
        $this->_close();
    }


    public function close() {
        if ($this->dbm) {
            $this->_close();
        }
    }

    public function setFilePath($filePath) {
        $this->dbmFile = $filePath;
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


    protected function _setWriteable() {
        if ($this->dbmMode === self::MODE_READABLE) {
            $this->_close();
            $this->setMode(self::WRITEABLE);
            $this->_init();
        }
    }


    protected function _init() {
        if (!$this->dbm) {
            $this->_connect();
        }
    }


    protected function _connect() {
        $dbm = dba_open($this->dbmFile, $this->dbmMode, $this->dbmType);

        if (!$dbm) {
            echo "[ERROR] Can'd open DBM file $this->dbmFile\n";
            exit;
        }

        $this->dbm = $dbm;
    }


    protected function _close() {
        if ($this->dbm) {
            dba_close($this->dbm);
            $this->dbm = NULL;
        }
    }

}

?>
