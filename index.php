<?php

require "vendor/autoload.php";

use FileWriter\FileWriter;

//Get an Instance of the Filewriter.
$fileWriter = FileWriter::open(__DIR__."/demofile");

$fileWriter->append("127.0.0.1\texchanger.ru")
    ->prepend("127.0.0.1\tapms.dev")
    ->save();

