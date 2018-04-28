<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/PhpSpreadsheet/samples/Header.php';
const FIELDS = [
    'dataType' => 'H',
    'length' => 'I',
    'defaultValue' => 'F',
    'nullable' => 'G'
];

    $inputFileType = 'Xls';
    $inputFileNames = [__DIR__ . '/test.xls', '/home/irina/tmp/download.xls'];

    foreach ($inputFileNames as $key => $fileName) {
        $helper->log('Loading file ' . pathinfo($fileName, PATHINFO_BASENAME) . ' using IOFactory with a defined reader type of ' . $inputFileType);
        $reader = IOFactory::createReader($inputFileType);
        $helper->log('Turning Formatting off for Load');
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($fileName);

        $sheetData[$key] = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
    }

    foreach ($sheetData[0] as $data) {
        $compare[$data['B']][$data['C']][$data['D']] = [
            'dataType' => $data['H'],
            'length' => $data['I'],
            'defaultValue' => $data['F'],
            'nullable' => $data['G']
        ];
    }
    $result = [];
    foreach ($sheetData[1] as $data) {
        if (
                key_exists($data['B'], $compare) 
                && key_exists($data['C'], $compare[$data['B']]) 
                && key_exists($data['D'], $compare[$data['B']][$data['C']])
            ) {
            foreach (FIELDS as $key => $litter) {
                if ($compare[$data['B']][$data['C']][$data['D']][$key] != $data[$litter]) {
                    $result[$data['B']][$data['C']][$data['D']][$key]['prod'] = $compare[$data['B']][$data['C']][$key];
                    $result[$data['B']][$data['C']][$data['D']][$key]['test'] = $data[$litter];
                }
            }
        } elseif (key_exists($data['B'], $compare)) {
                $result[$data['B']]['prod'] = $compare[$data['B']];
                $result[$data['B']]['test'] = null;
        } elseif (key_exists($data['C'], $compare[$data['B']])) {
            $result[$data['B']][$data['C']]['prod'] = $compare[$data['B']][$data['C']];
        }else {
            $result['prod'] = $compare[$data['B']];
            $result['test'] = null;
        }
        
    }
    
var_dump($result);
