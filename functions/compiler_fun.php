<?php

/*      HTML     */

function aux_compiler($args,$id){
    $html_encoded = "";
    foreach($args as $a){
        if($a->parentId === $id){
        if($a->tag !== "input" && $a->tag !== "img")
        $html_encoded .= "\n<".$a->tag." class=\"".$a->class."\"".">".$a->value.aux_compiler($args,$a->id)."</".$a->tag.">\n";
        else
        $html_encoded .= "\n<".$a->tag." class=\"".$a->class."\""."/>\n";
    }}
    return $html_encoded;
}

function html_compiler($args) {
    $html_encoded = "";
    foreach($args as $a){
        if($a->parentId === 0){
        if($a->tag !== "input" && $a->tag !== "img")
        $html_encoded .= "<".$a->tag." class=\"".$a->class."\"".">".$a->value.aux_compiler($args,$a->id)."</".$a->tag.">\n";
        else
        $html_encoded .= "<".$a->tag." class=\"".$a->class."\""."/>\n";
    }}
    return $html_encoded;
}

/*     CSS      */

function css_notation($arg){
    $index = strcspn($arg,'ABCDEFGHIJKLMNOPQRSTVWXYZ');
    $length = strlen($arg);
    $arg=strtolower($arg);
    if($length !== $index)
    $arg = substr_replace($arg,"-",$index,0);
    return $arg; 
}

function aux_css_compiler($args) {
    $css_encoded = "";
    foreach($args as $key => $value){
        $css_encoded .= "".css_notation($key).":".$value.";\n";
    }
    return $css_encoded;
}

function css_compiler($args) {
    $class_array = [];
    $defined = [];
    $css_encoded = "";
    foreach($args as $a){
        if(!in_array($a->class,$defined)){
        $obj = array("class"=>$a->class,"style"=>$a->style);
        $class_array[] = $obj;
        $defined[] = $a->class;
        }
    }
    
    foreach($class_array as $class) {
        $css_encoded .= ".".$class["class"]."{\n".aux_css_compiler($class["style"])."}\n";
    }

    return $css_encoded;
}



?>