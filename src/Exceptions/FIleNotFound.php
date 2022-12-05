<?php
namespace Codad5\PhpInex\Exceptions;

use Exception;
class FileNotFound extends Exception{
    public function __construct(string $file_path, int $code = 404, \Throwable $previous = null)
    {
        $this->file = $file_path;
        parent::__construct("File with name '$file_path' Not found", $code, $previous);
    }
    
}