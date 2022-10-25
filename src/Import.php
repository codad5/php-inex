<?php
/**
 * @author Codad5 <aniezeoformic@gmail.com>
 * @example ../examples/index.php How to use Import
 */
namespace Codad5\PhpInex;

use Closure;
use Exception;
use RuntimeException;


// This is a library that helps in simulating node.js import in php
class Import{

    /**
     * This function help to get the full path to the required file based on the request file 
     * @param string $file - This is the name of file to be imported
     * @param string $from  - This is the file that the import  is been requested
     * @return string - Return full path to requested file
     */
    protected static function resolve_file(string $file, $from) 
    {   
        $file_path = $file;
        if(self::get_ext($file) != "php" && count(explode('.', $file)) > 0 && !file_exists(dirname($from)."/$file")) $file_path = "$file.php";
        if(!file_exists(dirname($from)."/$file_path")) throw new Exception("No file found with name $file");
        // return $_SERVER['DOCUMENT_ROOT']."/$file";
        return dirname($from)."/$file_path";
    }
    
    /**
     * This is to ready the import request
     * @param string $file_path This is the file to be imported
     * @param string $from This is path to the file where the requested file is been imported from
     * @return mixed - If a php file will return any instance of `$export` in the global namespace , if no instance throw an error and stop the script
     *               - If not a php file will return the content of the file
     */
    protected static function prep_filename($file_path, $from)
    {
        $to_be_exported = null; 
        try{
            $file_path = self::resolve_file($file_path, $from);
            if(!file_exists($file_path)){
                throw new RuntimeException("File Not found :: $file_path");
            }
            switch (strtolower(self::get_ext($file_path))) {
                case 'php':
                    # code...
                    $to_be_exported = self::export_php($file_path);
                    break;
                default:
                    # code...
                    $to_be_exported = self::export_file($file_path);
                    break;
            }
            return $to_be_exported;
        }
        catch(Exception $e){
            self::print_error($e);
            die(500);
        }
    }
    public static function this($file_path)
    {   
        $from = self::get_caller_path(debug_backtrace());
        return  self::prep_filename($file_path, $from);
    }
    /**
     * This will return any instance of `$export` in the global namespace of the param `$file_path`
     * @param string $file_path Full Path to php file to be exported
     * 
     */

    private static function export_php($file_path)
    {
        $to_be_exported = null;
        $export = [];
        ob_start();
        require $file_path;
        if(!isset($export)){
            throw new Exception('Nothing to export in '.$file_path);
        }
        $to_be_exported = $export;
        ob_end_clean();
        return $to_be_exported;
    }
    /**
     * This will return the file content of the param `$file_path`
     * @param string $file_path Full Path to php file to be exported
     * 
     */
    protected static function export_file($file_path){
        return file_get_contents($file_path);
    }
    /**
     * To get File Extension
     * @param string $file_name File to get extension
     * @return string
     */
    public static function get_ext($file_name)
    {
        $file_ext = explode('.', $file_name);
        return strtolower(end($file_ext));

    }
    /**
     * Get path to file that request the import
     * @param array $trace The trace of the request
     * @return string The path to the request file
     */
    private static function get_caller_path($trace)
    {
        return $trace[0]['file'];
    }
    /**
     * To print error as formatted HTML
     * @param Exception $e - Error Object
     */

    private static function print_error(Exception $e)
    {
        echo "<h1>Error</h1>";
        echo "<pre>";
        // var_dump($e->getTrace()[0]);
            echo "<ul>";
                echo "<li>";
                    echo "Message : ".$e->getMessage();
                    echo "</li>";
                    echo "<h3>Trace</h3>";
                    echo "<ol>";
                    foreach($e->getTrace() as $key => $e){
                            echo "<li>";
                            echo "<ul>";
                            self::error_list($e);
                            echo "</ul>";
                        }
                        echo "</ol>";
                    echo "</li>";
            
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
                        echo "$point";
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
