<?php
include DROOT . "/helper/phpQuery.php";

class Restruct {

    private static $htmlRow;
    private $element;
    private $fragment;
    private $html;
    private $insert;

    function __construct() {
    }

    public function tpl($file) {
        $this->html = phpQuery::newDocumentFile($file);
    }

    function htmlId($htmlRow) {
        self::$htmlRow = $htmlRow;
    }

    public function fragment($css) {
        $this->element = $css;
        $this->fragment = $this->html->find($css . ' > div');
    }

    private static function replace($matches) {
        static $k = 0;
        $k++;
        return "'" . self::$htmlRow . "-" . $k . "'";
    }

    function rebuild($reCount) {
        foreach ($this->fragment as $unit) {
            $pq = pq($unit);
            $element = $pq->html();
            $class[] = $pq->attr('class');
            $dataSr[] = $pq->attr('data-sr');
            $count[] = '';
        }
        $k = 0;
        for ($i = 0; $i < $reCount; $i++) {
            if ($k > (count($count) - 1)) $k = 0;
            $string = preg_replace_callback('/\'.*?\'/', "self::replace", $element);
            $this->insert .= "\n\t" . '<div class="' . $class[$k] . '" data-sr="' . $dataSr[$k] . '">' . $string . "\n\t" . '</div>';
            $k++;
        }
        $this->insert();
    }

    private function insert() {
        $element = $this->html->find($this->element);
        $element->html($this->insert);
    }

    function render($htmlRow, $fragment, $reCount) {
        $this->tpl('template/template.php');
        $this->htmlId($htmlRow);
        $this->fragment('#' . $fragment);
        $this->rebuild($reCount);
        file_put_contents('template/template2.php', $this->html->html());
    }
}
