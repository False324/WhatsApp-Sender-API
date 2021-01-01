<?php
namespace App\Helpers;

use PHPExcel_IOFactory;

class Excel
{
    private $xlsData = [];

    public function __construct($filename)
    {
        $this->xlsData = $this->getXLS($filename);
    }

    public function getXLS($filename)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($filename);
        $objPHPExcel->setActiveSheetIndex(0);
        $aSheet = $objPHPExcel->getActiveSheet();
        $array = [];
        foreach ($aSheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $item = [];
            foreach ($cellIterator as $cell) {
                array_push($item, $cell->getCalculatedValue());
            }
            array_push($array, $item);
        }

        return $array;
    }

    public function getXlsReciever($country_code = '+48')
    {
        $data = $this->xlsData;

        $recievers = [];

        foreach ($data as $k => $v) {
            if ($v[3] && $v[5]) {
                $ifNumber = str_replace(' ', '', $v[3]);
                $lenNumber = strlen($ifNumber);

                if ($lenNumber === 9) {
                    $number = $country_code . $ifNumber;
                } else {
                    $number = $ifNumber;
                }

                $recievers[$number] = $v[5];
            }
        }
        return $recievers;
    }
}