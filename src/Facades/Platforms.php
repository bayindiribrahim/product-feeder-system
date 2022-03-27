<?php

namespace src\Facades;

use Src\Abstraction\IFileService;

class Platforms
{
    private IFileService $facebook;
    private IFileService $cimri;
    private IFileService $google;

    public function __construct(IFileService $facebook, IFileService $cimri, IFileService $google)
    {
        $this->facebook = $facebook;
        $this->cimri = $cimri;
        $this->google = $google;
    }

    /**
     * @param array $data
     * @return object
     */
    public function exporter(array $data): object
    {
        try {
            $this->facebook->exportFile($data);
            $this->cimri->exportFile($data);
            $this->google->exportFile($data);
        }catch (\Exception $exception){
            return (object) [
                "status" => false,
                "message" => "Unexpected problem $exception"
            ];
        }

        return (object) [
            "status" => true,
            "message" => "Exported files for all platforms as successfully."
        ];
    }
}