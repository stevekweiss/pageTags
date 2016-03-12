<?php
/**
 * Created by IntelliJ IDEA.
 * User: steveweiss
 * Date: 3/11/16
 * Time: 10:46 PM
 */
require_once('XML_HTMLSax-2.1.2/XML_HTMLSax-2.1.2/XML_HTMLSax.php');

class HtmlProcessor {
    var $html;

    var $output = '';
    var $tags = array();

    function __construct($html) {	$this->html = $html;	}

    function process() {
        $parser=new XML_HTMLSax();
        $parser->set_object($this);
        $parser->set_element_handler('openHandler','closeHandler');
        $parser->set_data_handler('dataHandler');
        $parser->set_escape_handler('escapeHandler');
        $parser->set_pi_handler('piHandler');
        $parser->set_jasp_handler('jaspHandler');

        $parser->parse($this->html);
        arsort($this->tags);
    }

    function getOutput() { return $this->output; }

    function openHandler(& $parser,$name,$attrs) {
        $count = 1;
        $key = strtolower($name);
        if (isset($this->tags[$key])) {
            $count = $this->tags[$key] + 1;
        }
        $this->tags[$key] = $count;

        $str = "&lt;<span class=\"tag_$name\">$name</span>";
        foreach ($attrs as $key => $val) {
            $str .= " $key=\"$val\"";
        }
        $str .= '&gt;';
        $this->output .= $str;
    }
    function closeHandler(& $parser,$name) {
        $this->output .= "&lt;/$name&gt;<br/>";
    }
    function dataHandler(& $parser,$data) {
    }
    function escapeHandler(& $parser,$data) {
    }
    function piHandler(& $parser,$target,$data) {
    }
    function jaspHandler(& $parser,$data) {
    }

    function getTags() {
        return $this->tags;
    }

}