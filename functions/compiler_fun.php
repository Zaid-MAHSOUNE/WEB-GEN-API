<?php

/*      HTML     */

function attributes_compiler($arg){
    $html_encoded = "";
    foreach($arg as $key=>$value){
        if($key!="style" && $key!="tag" && $key!="parentId" && $key!="value")
           $html_encoded .= " ".$key."=\"".$value."\" ";  
    }
    return $html_encoded;
}

function aux_compiler($args,$id){
    $html_encoded = "";
    foreach($args as $a){
        if($a->parentId === $id){
        if($a->tag !== "input" && $a->tag !== "img")
        $html_encoded .= "\n<".$a->tag." ".attributes_compiler($a).">".$a->value.aux_compiler($args,$a->id)."</".$a->tag.">\n";
        else
        $html_encoded .= "\n<".$a->tag." ".attributes_compiler($a)."/>\n";
    }}
    return $html_encoded;
}

function html_compiler($args) {
    print_r($args);
    $html_encoded = "\n";
    foreach($args as $a){
        if($a->parentId === 0){
        if($a->tag !== "input" && $a->tag !== "img")
        $html_encoded .= "\t\t<".$a->tag." ".attributes_compiler($a).">".$a->value.aux_compiler($args,$a->id)."</".$a->tag.">\n";
        else
        $html_encoded .= "\t\t<".$a->tag." ".attributes_compiler($a)."/>\n";
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