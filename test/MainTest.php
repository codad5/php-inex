<?php

declare(strict_types=1);

//load environment variables

namespace Test\Unit;

use Codad5\PhpInex\Import;
use Codad5\PhpInex\Exceptions\{FileNotFound};
use \PHPUnit\Framework\TestCase;


class MainTest extends TestCase
{
    /** @test */
    public function php_file_import_is_working()
    {
       $men = Import::this('../examples/men.php');
       $this->assertArrayHasKey('welcome', $men);
    }
    /** @test */
    public function if_no_ext_will_import_file_with_php_ext()
    {
       $men = Import::this('../examples/men');
       $this->assertArrayHasKey('welcome', $men);
    }
    
    // /** @test */
    // public function through_exception_if_file_not_found()
    // {
    //     $this->expectException(FileNotFound::class);
    //     $men = Import::this('../inter');
    // }
    
    
}