## Simple Filewriter for PHP
> #### Provides quick and easy approach to open and writes text to Files.
### Installation
You will need to have `PHP ~5.4` and `composer` installed.
>Simply use composer in your **Terminal**
```
composer require ionware/filewriter
```

### Usage
Create an Instance of the `fileWriter` and start writing.
```php
<?php

require "vendor/autoload.php";

use FileWriter\FileWriter;

//Get an Instance of the Filewriter
$fileWriter = FileWriter::open(__DIR__."/demofile");

$fileWriter->append("127.0.0.1\texchanger.ru")
    ->prepend("127.0.0.1\tapms.dev")
    ->save();


```

### License
The MIT License (MIT). See [License file](LICENSE.md) for more information.