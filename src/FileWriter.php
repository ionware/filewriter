<?php

namespace FileWriter;

use FileWriter\Exception\FileException;

class FileWriter {

    private $handle;

    function __construct($handle)
    {
        $this->handle = $handle;
    }

    /**
     * @param string $filepath the path to file
     * @throws FileException
     * @return Instance of FileWriter
     */
    public static function open($filepath)
    {
        if (! self::assertFileExists($filepath)){
            throw new FileException("File does  not exists");
            exit(1);
        }

        try {
            $file_handle = fopen($filepath, 'w+');

            return new self($file_handle);

        } catch (\Exception $e){

            throw new FileException("Failed to open file. Check file Permission.");
        }

    }

    /**
     * @param $lines
     * @return $this
     */
    public function append($lines)
    {
        if ( is_array($lines)){

            foreach($lines as $line){
                fwrite($this->handle, $line. "/r/n");
            }

            return $this;
        }

        fwrite($this->handle, $lines. "/r/n");

        return $this;
    }
    
    /**
     * @return void
     */
    public function save(){

        @fclose($this->handle);
    }

    public static function assertFileExists($filepath)
    {
        return file_exists($filepath);
    }
}