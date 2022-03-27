<?php

namespace Src\Abstraction;

interface IFileService
{
    /**
     * @param array $data
     * @return object
     */
    public function exportFile(array $data): object;
}
