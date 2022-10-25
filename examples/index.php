<?php
require __DIR__.'/../vendor/autoload.php';
use Codad5\PhpInex\Import;

$test = Import::class;
['welcome' => $welcome, 'print_date' => $print_date] = Import::this('../men');
$style = $test::this('/style');
var_dump($welcome, $style, $test);

?>
<style>
    <?=$style?>
</style>

<h1>
    <?=$welcome()?>
</h1>

<h4> 
    <?=$print_date()?>
</h4>