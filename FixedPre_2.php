<?php
if (! function_exists('quote_meta') ) {
    function quote_meta($a) {
        $lhs = array("<", ">", "[", "]", "!", "{", "}", "`", "*", "~");
        $rhs = array("&lt;", "&gt;", "&#091;", "&#093;", "&#033;", "&#123;", "&#125;", "&#96;", "&#42;", "&#126;");
        $b = str_replace("&", "\255", $a[2]);  //save "&"
        $lhs_preg = array('|<!(!*)pre>|',  '|<!(!*)/pre>|');
        $rhs_preg = array('<$1pre>',  '<$1/pre>');
        $b = preg_replace($lhs_preg, $rhs_preg, $b);
        $b = str_replace($lhs, $rhs, $b);

        /* restore '&' as '&amp;' and wrap in span tag */
        //return '<span class="fxp">' . str_replace("\255", "&amp;", $b) . '</span>';
        return '<pre class="code"><code>'.str_replace("\255", "&amp;", $b)."</code></pre>";
    }
}
/** @var $modx modX */
$output =& $modx->documentOutput;
$output = preg_replace_callback("#(<pre>)(.*?)(</pre>)#s",
    "quote_meta", $output);

//"<pre><code>".."</code></pre>"

return '';
