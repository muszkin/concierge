<?php
/**
 * Created by PhpStorm.
 * User: muszkin
 * Date: 13.04.17
 * Time: 12:37
 */

namespace AppBundle\Services\Export;


use AppBundle\Services\Provider\ConciergeProviderInterface;
use Symfony\Component\HttpFoundation\File\File;

class CsvExporter implements ExporterInterface
{
    private $conciergeProvider;

    public function __construct(ConciergeProviderInterface $conciergeProvider)
    {
        $this->conciergeProvider = $conciergeProvider;
    }

    public function doExport($team, $licenses)
    {
        $data = $this->csv_to_array($licenses);
        if (!$data){
            throw new \Exception("Error - can't read file");
        }
        $licenses = array_column($data,'license_id');
        if (!count($licenses)){
            throw new \Exception("there is no column license_id in file");
        }
        $result = $this->conciergeProvider->exportAllData($team,$licenses);

        return $result;
    }

    public function csv_to_array($filename='', $delimiter=';')
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }
        $header = NULL;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== FALSE)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
            {
                if(!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
        return $data;
    }
}