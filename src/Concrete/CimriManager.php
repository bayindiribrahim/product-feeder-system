<?php

namespace Src\Concrete;

use Src\Abstraction\IFileService;
use Src\Helpers\FileFactory;

class CimriManager implements IFileService
{
    protected string $fileFormat;
    protected string $platformName;

    public function __construct()
    {
        $this->fileFormat = "json";
        $this->platformName = "cimri";
    }

    /**
     * @param array $data
     * @return object
     */
    public function exportFile(array $data): object
    {
        return FileFactory::generate($this->fileFormat, $this->platformName, $data);
    }
}