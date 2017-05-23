<?php

namespace FileWriter;

use FileWriter\Exception\FileException;

class FileWriter {

    private $handle;
    private $file_content;
    private $file_path;

    function __construct($file_path)
    {
        $this->file_content = file_get_contents($file_path);
        $this->handle = fopen($file_path, 'w+');
        $this->file_path = $file_path;

    }

    /**
     * Check the file Existence and Permission
     * @param string $filepath the path to file
     * @throws FileException
     * @return Instance of FileWriter
     */
    public static function open($filepath)
    {
        if (! self::assertFileExists($filepath) and ! self::assertFileIsWritable($filepath) ){
            throw new FileException("File does  not exists");
        }

        return new self($filepath);

    }

    /**
     * Write Lines to the top of the file
     * @param array | string $lines
     * @return $this
     */
    public function append($lines)
    {
        if ( is_array($lines)){


            $this->file_content = $this->merge($this->writeLines($lines), $this->file_content);

            return $this;
        }

        $this->file_content = $this->merge(
            $this->merge($lines, "\r\n"), $this->file_content);

        return $this;
    }

    /**
     * Write to the very bottom (starting at EOF) of file
     * @param array | string $lines
     * @return $this
     */
    public function prepend($lines)
    {
        if ( is_array($lines)){

            $this->file_content = $this->merge($this->writeLines($lines), $this->file_content);

            return $this;
        }

        $this->file_content = $this->merge(
            $this->merge($lines, "\r\n"), $this->file_content, 'after');

        return $this;
    }
    
    /**
     * Flush the content to file and close the handle
     * @return void
     */
    public function save(){

        fwrite($this->handle, $this->file_content);
        @fclose($this->handle);
    }

    /**
     * Write Multiple lines from Array to fileContent
     * @param array $lines
     * @param string $pos
     * @return string
     */
    private function writeLines(array $lines, $pos = 'after')
    {
        $tmp_content = "";

        foreach($lines as $line){
            $string = $this->merge($line, "\r\n");
            $tmp_content = $this->merge($string, $tmp_content, $pos);
        }

        return $tmp_content;
    }
    /**
     * Check the existence of file
     * @param $filepath
     * @return bool
     */
    public static function assertFileExists($filepath)
    {
        return file_exists($filepath);
    }

    /**
     * Check if file is writable
     * @param $file_path
     * @return bool
     */
    public static function assertFileIsWritable($file_path)
    {
        return is_writable($file_path);
    }

    /**
     * Concatenate two strings together
     * @param $string
     * @param $parent
     * @param string $pos
     * @return string
     */
    private function merge($string, $parent, $pos = 'before')
    {
        if ($pos === 'before'){

            return $string . $parent;
        }

        return $parent . $string;
    }

}