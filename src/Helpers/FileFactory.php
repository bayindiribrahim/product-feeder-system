<?php

namespace Src\Helpers;

class FileFactory
{
    /**
     * @param string $outputType
     * @param string $platform
     * @param array $data
     * @return object
     */
    public static function generate(string $outputType, string $platform, array $data): object
    {
        return match ($outputType) {
            "json" => self::generateAsJsonFile($platform, $data),
            "xml" => self::generateAsXmlFile($platform, $data),
            default => throw new \InvalidArgumentException('Invalid file type.'),
        };
    }

    /**
     * @param string $platform
     * @param array $data
     * @return object
     */
    private static function generateAsJsonFile(string $platform, array $data): object
    {
        try {
            $output = fopen("$platform-products.json", "w");
            fwrite($output, json_encode($data));
            fclose($output);
        } catch (\Exception $e){
            return (object) [
                "status" => false,
                "message" => "file could not create $e"
            ];
        }

        return (object) [
            "status" => true,
            "message" => "file created successfully"
        ];
    }

    /**
     * @param string $platform
     * @param array $data
     * @return object
     */
    private static function generateAsXmlFile(string $platform, array $data): object
    {
        try {
            $xml = "";
            /** convert array to xml */
            foreach ($data as $item)
            {
                $xml = $xml . self::array2xml($item) . "\n";
            }

            /** export as xml file */
            $output = fopen("$platform-products.xml", "w");
            fwrite($output, $xml);
            fclose($output);
        } catch (\Exception $e){
            return (object) [
                "status" => false,
                "message" => "file could not create $e"
            ];
        }

        return (object) [
            "status" => true,
            "message" => "file created successfully"
        ];

    }

    /**
     * @param $array_item
     * @return string
     */
    private static function array2xml($array_item): string
    {
        $xml = '';
        foreach($array_item as $element => $value)
        {
            if (is_array($value))
            {
                $xml .= "<$element>". self::array2xml($value) ."</$element>";
            }
            elseif($value == '')
            {
                $xml .= "<$element />";
            }
            else
            {
                $xml .= "<$element>".htmlentities($value)."</$element>";
            }
        }
        return $xml;
    }
}
