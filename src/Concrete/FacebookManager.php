<?php

namespace Src\Concrete;

use Src\Abstraction\IFileService;
use Src\Helpers\FileFactory;

class FacebookManager implements IFileService
{
    protected string $fileFormat;
    protected string $platformName;

    public function __construct()
    {
        $this->fileFormat = "xml";
        $this->platformName = "facebook";
    }

    /**
     * @param array $data
     * @return false|string
     */
    public function exportFile(array $data)
    {
        return FileFactory::generate($this->fileFormat, $this->platformName, $data);
    }
}