<?php
class TidyHTML {
    public $tidy_config;

    function __construct() {
        $this->tidy = new tidy;
        $this->config();
    }

    function config() {
        $this->tidy_config = array(
            'hide-comments' => true,
            'tidy-mark' => false,
            'indent' => true,
            'indent-spaces' => 2,
            'new-blocklevel-tags' => 'menu,article,header,footer,section,nav,main',
            'new-inline-tags' => 'video,audio',
            'doctype' => '<!DOCTYPE html>',
            'vertical-space' => false,
            'output-xml' => true,
            'wrap' => 0,
            'wrap-attributes' => false,
            'break-before-br' => false,
            'char-encoding' => 'utf8',
            'input-encoding' => 'utf8',
            'output-encoding' => 'utf8');
    }

    function beautify($html) {
        $html = str_replace('></span', '>&nbsp;</span', $html);
        $html = str_replace('></i', '>&nbsp;</i', $html);
        $this->tidy->parseString($html, $this->tidy_config, 'utf8');        
        $this->tidy = str_replace('/>', '>', $this->tidy);
        $this->tidy = str_replace(' >', '>', $this->tidy);                
        return str_replace('&nbsp;', '', $this->tidy);
    }
}
