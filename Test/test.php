<?php

include("/Hprose/hproseHttpServer.php");
function hello($name) {
    return "Hello " . $name;
}
$server = new HproseHttpServer();
$server->addFunction("hello");
$server->handle();