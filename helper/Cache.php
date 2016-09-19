<?php
class Cache {

    public $cacheFile;
    public $cacheDir = '/cache/';
    public $cacheExt = '.html';
    public $cacheTime = 31536000;
    public $tidy = true;

    function __construct($name = null) {
        if (!isset($name)) return;
        $this->cacheFile = $_SERVER["DOCUMENT_ROOT"] . $this->cacheDir . hash('md5', $name) . $this->cacheExt;
    }

    public function getCache() {
        if ($this->mode()) {
            if (file_exists($this->cacheFile)) unlink($this->cacheFile);
            return;
        }
        $this->startLoadTime();
        if (file_exists($this->cacheFile) && time() - $this->cacheTime < filemtime($this->cacheFile)) {
            include ($this->cacheFile);
            echo "\n<!--\nCached copy, generated " . date('d-m-Y H:i:s', filemtime($this->cacheFile)) . "\n-->";
            $this->checkpointLoadTime();
            exit;
        }
        ob_start();
    }

    public function setCache() {
        if ($this->mode()) return;
        $content = ($this->tidy) ? $this->tidy(ob_get_contents()) : ob_get_contents();
        file_put_contents($this->cacheFile, $content);
        ob_end_flush();
        $this->checkpointLoadTime();
    }

    public function microtimeFloat() {
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    }

    public function startLoadTime() {
        $time_start = $this->microtimeFloat();
        define('ST_T', $time_start);
    }

    public function checkpointLoadTime() {
        $time_end = $this->microtimeFloat();
        $time = $time_end - ST_T;
        $time = number_format($time, 8, ',', '.');
        echo "\n<!--\n";
        echo "Page load time: $time seconds\n";
        echo "Memory usage: " . round((memory_get_peak_usage(true) / 1024 / 1024), 2) . " Mb\n";
        echo "-->";
    }

    public function mode() {
        $queryAdmin = isset($_GET['access']) ? $_GET['access'] : 1;
        $sessionAdmin = isset($_SESSION['access']) ? $_SESSION['access'] : 2;
        return ($sessionAdmin == $queryAdmin);
    }

    public function tidy($html) {
        $tidy = new TidyHTML;
        return $tidy->beautify($html);
    }

}
