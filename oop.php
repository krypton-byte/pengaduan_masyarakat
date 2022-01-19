<?php

class HelloWorld {
    public function __construct($fname, $lname) {
        $this->fname = $fname;
        $this->lname = $lname;
    }

    private function exte() {
        return $this->fname.' '.$this->lname;

    }

    public function _print() {
        return $this->exte();
    }

    public function call($f) {
        return $f();
    }
}
$myc = new HelloWorld('krypton', 'byte');
echo $myc->call(($myc->_print));
?>