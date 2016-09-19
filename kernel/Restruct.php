<?php
include DROOT . "/helper/phpQuery.php";
class Restruct {

    private static $selector;
    private $element;
    private $fragment;
    private $html;
    private $insert;
    private $class;
    private $htmlblock;

    function __construct() {
    }

    private function tpl($file) {
        $template = file_get_contents($file);
        $this->html = phpQuery::newDocument($template);
    }

    private function select($htmlId) {
        self::$selector = $htmlId;
        $this->element = '#' . $htmlId;
        $this->fragment = $this->html->find('#' . $htmlId . ' > div');
    }

    private static function replace($matches) {
        static $k = 0;
        $k++;
        $add = (strpos($matches[0], '_') !== false) ? $add = '_' : '';
        $ret = "[" . $add . self::$selector . "-" . $k . "]";
        if (strpos($matches[0], '_') !== false) $k--;
        return $ret;
    }

    private function rebuild($reCount) {
        $u = 0;
        foreach ($this->fragment as $unit) {
            $pq = pq($unit);
            $this->htmlblock = $pq->html();
            $u++;
            if ($u > 0) continue;
        }
        $this->htmlblock = self::normalize($this->htmlblock);

        $this->bootstrapCol($reCount);
        $k = 0;
        for ($i = 0; $i < $reCount; $i++) {
            if ($k > (count($this->fragment) - 1)) $k = 0;
            $string = preg_replace_callback('/\[.*?\]/', "self::replace", $this->htmlblock);
            $this->insert .= '<div class="' . $this->class . '">' . $string . '</div>';
            $k++;
        }
        $this->insert();
    }

    private static function normalize($data) {
        $data = urldecode($data);
        $data = str_replace(array('&lt;', '&gt;'), array('<', '>'), $data);
        return $data;
    }

    private function bootstrapCol($reCount) {
        if ($reCount >= 6) $this->class = 'col-xs-12 col-sm-4 col-md-2 col-lg-2';
        if ($reCount == 5) $this->class = 'col-xs-12 col-sm-4 col-md-15 col-lg-15';
        if ($reCount == 4) $this->class = 'col-xs-12 col-sm-6 col-md-3 col-lg-3';
        if ($reCount == 3) $this->class = 'col-xs-12 col-sm-12 col-md-4 col-lg-4';
        if ($reCount == 2) $this->class = 'col-xs-12 col-sm-12 col-md-6 col-lg-6';
        if ($reCount == 1) $this->class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
        return $this->class;
    }

    private function insert() {
        $element = $this->html->find($this->element);
        $element->html($this->insert);
    }

    function render($htmlId, $reCount) {
        $this->tpl('template/template.php');
        $this->select($htmlId);
        $this->rebuild($reCount);
        $template = self::normalize($this->html->html());
        file_put_contents('template/template.php', $template);
        header("Location: /?access=$_SESSION[access]");
    }
}
