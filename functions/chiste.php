<?php

function generateChiste() {
    $urlGoogle = "http://www.holasoyramon.com/chistes/aleatorio/";

    $content = file_get_contents($urlGoogle);
    $content = iconv("ISO-8859-1", "UTF-8", $content);
    
    $doc = new DOMDocument();
    $doc->loadHTML($content);
    
    $finder = new DomXPath($doc);
    $classname = "grande1";
    $nodes = $finder->query("//*[contains(@class, '$classname')]");

    $counter = 0;
    $textFormatted = '';
    foreach ($nodes[0]->childNodes as $node) {
        if ($counter > 1) {
            $textFormatted .= $node->nodeValue;
            // $textFormatted .= '\n ';
        }
        $counter++;
    }

    if (strlen($textFormatted) > 200) {
        return generateChiste();
    }
    return $textFormatted;
}
