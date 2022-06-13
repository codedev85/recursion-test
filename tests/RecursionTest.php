<?php

namespace Test\Olawuyiayansola\Recursion;

require './vendor/autoload.php';

use Test\Olawuyiayansola\Recursion\Stubs\FakeFileReader;
use Olawuyiayansola\Recursion\NumberProcessor;

class RecursionTest extends \PHPUnit\Framework\TestCase
{

    public function test_it_can_sum_files():void
    {
        $fakeFileReader = new FakeFileReader();
        $directory = 'fake-directory';

        $fakeFileReader->setFileContent($directory, 'sample.txt', '1,2,3,4,5');
    
        $numberProcessor = new NumberProcessor($fakeFileReader, $directory);

        $results = $numberProcessor->sumNumberInFiles('sample.txt');

        $this->assertArrayHasKey('sample.txt', $results);
        $this->assertEquals($results['sample.txt'], 15);

    }

    public function test_it_can_sum_recursive_files():void
    {
        $fakeFileReader = new FakeFileReader();
        $directory = 'fake-directory';

        $fakeFileReader->setFileContent($directory, 'sample.txt', '1,2,3,4,5,sample2.txt');
        $fakeFileReader->setFileContent($directory, 'sample2.txt', '10,90,10,sample3.txt');
        $fakeFileReader->setFileContent($directory, 'sample3.txt', '5,3,4');
    
        $numberProcessor = new NumberProcessor($fakeFileReader, $directory);

        $results = $numberProcessor->sumNumberInFiles('sample.txt');

        $this->assertArrayHasKey('sample.txt', $results);
        $this->assertEquals($results['sample.txt'], 15);

        $this->assertArrayHasKey('sample2.txt', $results);
        $this->assertEquals($results['sample2.txt'], 110);

        $this->assertArrayHasKey('sample3.txt', $results);
        $this->assertEquals($results['sample3.txt'], 12);

    }

    public function test_it_can_sum_infinite_recursive_files():void
    {
        $fakeFileReader = new FakeFileReader();
        $directory = 'fake-directory';

        $fakeFileReader->setFileContent($directory, 'sample.txt', '1,2,3,4,5,sample2.txt');
        $fakeFileReader->setFileContent($directory, 'sample2.txt', '10,90,10,sample3.txt');
        $fakeFileReader->setFileContent($directory, 'sample3.txt', '5,3,4,sample.txt');
    
        $numberProcessor = new NumberProcessor($fakeFileReader, $directory);

        $results = $numberProcessor->sumNumberInFiles('sample.txt');

        $this->assertArrayHasKey('sample.txt', $results);
        $this->assertEquals($results['sample.txt'], 15);

        $this->assertArrayHasKey('sample2.txt', $results);
        $this->assertEquals($results['sample2.txt'], 110);

        $this->assertArrayHasKey('sample3.txt', $results);
        $this->assertEquals($results['sample3.txt'], 12);

    }
}