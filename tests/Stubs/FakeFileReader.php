<?php

namespace Test\Olawuyiayansola\Recursion\Stubs;

use Olawuyiayansola\Recursion\FileReaderInterface;

class FakeFileReader implements FileReaderInterface {
    private $cache = [];

    public function readfile(string $directory, string $file): string {
        return $this->cache[$directory.$file];
    }

    public function setFileContent(string $directory, string $file, string $content): void {
        $this->cache[$directory.$file] = $content;
    }
}