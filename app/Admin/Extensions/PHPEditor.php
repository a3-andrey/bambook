<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class PHPEditor extends Field
{
    protected $view = 'admin.php-editor';

    protected static $css = [
        '/packages/codemirror-5.63.3/lib/codemirror.css',
    ];

    protected static $js = [
        '/packages/codemirror-5.63.3/lib/codemirror.js',
        '/packages/codemirror-5.63.3/addon/edit/matchbrackets.js',
        '/packages/codemirror-5.63.3/mode/htmlmixed/htmlmixed.js',
        '/packages/codemirror-5.63.3/mode/xml/xml.js',
        '/packages/codemirror-5.63.3/mode/javascript/javascript.js',
        '/packages/codemirror-5.63.3/mode/css/css.js',
        '/packages/codemirror-5.63.3/mode/clike/clike.js',
        '/packages/codemirror-5.63.3/mode/php/php.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

CodeMirror.fromTextArea(document.getElementById("{$this->id}"), {
    lineNumbers: true,
    mode: "text/x-php",
    extraKeys: {
        "Tab": function(cm){
            cm.replaceSelection("    " , "end");
        }
     }
});

EOT;
        return parent::render();

    }
}