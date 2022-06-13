<?php

namespace Olawuyiayansola\Recursion;

class FileReader implements FileReaderInterface {

    public function readfile(string $directory, string $file): string {
        $dataFile = $directory.$file;
        $openFile = fopen($dataFile, 'r');
        $contents = fread($openFile, filesize($dataFile));
        fclose($openFile);
        return $contents;
    }
}