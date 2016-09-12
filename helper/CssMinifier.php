<?php
class CssMinifier {

    private $contents;
    private $cssInput = 'css/bootstrap.min.css, 
                       css/font-awesome.min.css,
                       css/bootstrap-theme.min.css, 
                       css/nivo-lightbox.css, 
                       css/owl.carousel.css, 
                       css/owl.theme.green.css, 
                       css/responsive.css, 
                       css/colors/blue.css, 
                       css/style.css,
                       admin/css/admin.css';

    private $cssOutput = 'css/compress.css';

    function __construct() {
        if (!isset($cssFiles)) $this->cssFiles = $this->cssInput;
        if (!isset($outputFile)) $this->outputFile = $this->cssOutput;
        if (!is_array($this->cssFiles)) $this->cssFiles = explode(',', $this->cssFiles);
        $this->outputFile = trim($this->outputFile);

        if (file_exists($this->outputFile)) {
            $this->outputFileModify = date("Y-m-d H:i:s", filemtime($this->outputFile));
            $this->resetCache = str_replace(array('-',' ',':'), array('','',''), $this->outputFileModify);
        }

        foreach ($this->cssFiles as $file) {
            $this->inputFileModify = date("Y-m-d H:i:s", filemtime(trim($file)));
            if ($this->inputFileModify != $this->outputFileModify) $this->compress();
        }
    }

    private function compress() {
        foreach ($this->cssFiles as $file) {
            touch(trim($file));
            $cssCode = ($file) ? file_get_contents(trim($file)) : '';
            $cssCode = str_replace(array("\n", "\r"), '', $cssCode);
            $cssCode = preg_replace('!\s+!', ' ', $cssCode);
            $cssCode = str_replace(array(' {',' }','{ ','} ',' ;','; ',': '), array('{','}','{','}',';',';',':'), $cssCode);
            $cssCode = preg_replace( '#/\*(?:[^*]*(?:\*(?!/))*)*\*/#', '', $cssCode );
            $this->contents .= $cssCode;
        }

        file_put_contents($this->outputFile, $this->contents);
        $this->outputFileModify = date("Y-m-d H:i:s", filemtime($this->outputFile));
        $this->resetCache = str_replace(array('-',' ',':'), array('','',''), $this->outputFileModify);
    }

    public function tagLink() {
        return '<link rel="stylesheet" href="/' . $this->outputFile . '?d=' . $this->resetCache .'">' . "\n";
    }

    public function rawCode() {
        return '<style>' . file_get_contents($this->outputFile) . '</style>' . "\n";
    }
}