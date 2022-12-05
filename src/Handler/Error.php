<?php
namespace Codad5\PhpInex\Handler;

use Codad5\PhpInex\Exceptions\FileNotFound;
use Exception;
class Error {
    public static function handle(Exception $e, $die = true){
        if($e instanceof FileNotFound){
            self::print_file_not_found_error($e);
        }
        else{
            self::print_error($e);
        }
        if ($die)
            die(500);
    }    
    public static function print_file_not_found_error(FileNotFound $e){
         self::print_error($e);
         return true;
    }
    
    private static function print_error(Exception $e)
    {
        $main_data = array_reverse($e->getTrace())[0];
        echo "<h1>Error: (".get_class($e).")</h1>";
        echo "<pre>";
        // var_dump($e->getTrace()[0]);
            echo "<ul>";
                echo "<li>";
                    echo "<span style='font-size:20px;'>Message : ".$e->getMessage()." in file ".$main_data['file']." on Line <b>".$main_data['line']."</b></span>";
                    echo "</li>";
                    echo "<h3>Trace</h3>";
                    echo "<ol>";
                    foreach(array_reverse($e->getTrace()) as $key => $e){
                            echo "<li>";
                            echo "<ul style='font-size:15px;'>";
                            self::error_list($e);
                            echo "</ul>";
                        }
                        echo "</ol>";
                    echo "</li><br/>";
            
            echo "Built by <a href='https://github.com/codad5'>Codad5</a>";
    }

    private static function error_list(array $e)
    {
        foreach($e as $key => $value){
                if(is_array($value)){
                    echo "<li>";
                    echo "$key";
                    echo "<ol>";
                    foreach($value as $point){
                        echo "<li>";
                        !is_array($point) ? print($point) : self::error_list($point);
                        echo "</li>";
                    }
                    echo "</ol>";
                    echo "</li>";
                    continue;
                }
                echo "<li>";
                echo "$key : $value";
                echo "</li>";
            }
    }
}