<?php

require "vendor/autoload.php";


$fileWriter = \FileWriter\FileWriter::open(__DIR__."/demofile");

$fileWriter->append("127.0.0.1\texchanger.ru")->save();

