<?php
namespace Codad5\PhpInex\Exceptions;

use Exception;
class NoExport extends Exception{
    public function __construct(string $file_path, int $code = 300, \Throwable $previous = null)
    {
        $this->file = $file_path;
        parent::__construct("Nothing to Export in ($file_path)", $code, $previous);
    }
    
}