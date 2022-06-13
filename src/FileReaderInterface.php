<?php

namespace Olawuyiayansola\Recursion;

interface FileReaderInterface {
    public function readfile(string $directory, string $file): string;
}