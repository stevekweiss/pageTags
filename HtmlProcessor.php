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
    }

    function getOutput() { return $this->output; }

    function openHandler(& $parser,$name,$attrs) {
        echo ( 'Open Tag Handler: '.$name.'<br />' );
        echo ( 'Attrs:<pre>' );
        print_r($attrs);
        echo ( '</pre>' );
       // $this->output = $this->output . $name;
    }
    function closeHandler(& $parser,$name) {
        echo ( 'Close Tag Handler: '.$name.'<br />' );
    }
    function dataHandler(& $parser,$data) {
        echo ( 'Data Handler: '.$data.'<br />' );
    }
    function escapeHandler(& $parser,$data) {
        echo ( 'Escape Handler: '.$data.'<br />' );
    }
    function piHandler(& $parser,$target,$data) {
        echo ( 'PI Handler: '.$target.' - '.$data.'<br />' );
    }
    function jaspHandler(& $parser,$data) {
        echo ( 'Jasp Handler: '.$data.'<br />' );
    }

}