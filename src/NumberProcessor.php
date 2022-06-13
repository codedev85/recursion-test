<?php 

namespace Olawuyiayansola\Recursion;

require './vendor/autoload.php';

class NumberProcessor {
    private FileReaderInterface $fileReader;
    private string $directory;
    
    public function __construct(FileReaderInterface $fileReader, string $directory) {
        $this->fileReader = $fileReader;
        $this->directory = $directory;
    }

    public function sumNumberInFiles(string $fileName, array $processedFiles = []): array
    {

        $contents = $this->fileReader->readfile($this->directory, $fileName);

        $dataInFile =  explode(',', $contents);

        $processedFiles[$fileName] = true;

        $result = [];

        $arrayNum = array();

        foreach($dataInFile as $arrayData)
        {
            $extension = pathinfo($arrayData, PATHINFO_EXTENSION);
            if($extension != 'txt' && is_numeric($arrayData)) {
                array_push($arrayNum,$arrayData);
            }elseif($extension == 'txt' && !array_key_exists($arrayData, $processedFiles)){

                $result = array_merge($result, $this->sumNumberInFiles($arrayData, $processedFiles));
            }
        }
        $sumNum = array_sum($arrayNum);

        $result[$fileName] = $sumNum;

        return $result;
    }
}

