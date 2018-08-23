<?php

use PhpOffice\PhpSpreadsheet\IOFactory;

require __DIR__ . '/PhpSpreadsheet/samples/Header.php';
const FIELDS = ['dataType','length','defaultValue','nullable'];

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
        $test[$data['B']][$data['C']][$data['D']] = [
            'dataType' => $data['H'],
            'length' => $data['I'],
            'defaultValue' => $data['F'],
            'nullable' => $data['G']
        ];
    }
    foreach ($sheetData[1] as $data) {
        $prod[$data['B']][$data['C']][$data['D']] = [
            'dataType' => $data['H'],
            'length' => $data['I'],
            'defaultValue' => $data['F'],
            'nullable' => $data['G']
        ];
    }
    $result = [];
    
    foreach ($prod as $prodSchema => $schema) {
        if (key_exists($prodSchema, $test)) {
            foreach ($schema as $prodTable => $table) {
                if(key_exists($prodTable, $test[$prodSchema])) {
                    foreach ($table as $prodField => $field) {
                        if (key_exists($prodField, $test[$prodSchema][$prodTable])) {
                            foreach (FIELDS as $fieldName) {
                                if ((!is_null($field[$fieldName]) && !is_null($test[$prodSchema][$prodTable][$prodField][$fieldName])) 
                                        && ($field[$fieldName] != $test[$prodSchema][$prodTable][$prodField][$fieldName])) {
                                    $result[$prodSchema][$prodTable][$prodField][$fieldName]['prod'] = $field[$fieldName];
                                    $result[$prodSchema][$prodTable][$prodField][$fieldName]['test'] = $test[$prodSchema][$prodTable][$prodField][$fieldName];
                                }
                            }
                        } else {
                            $result[$prodSchema][$prodTable]['prodField'][$prodField] = $field;
                        }
                    } 
                } else {
                    $result[$prodSchema]['prodTable'][$prodTable] = $table;
                }
            }
        } else {
            $result['prodSchema'][$prodSchema] = $schema;
        }
    }
    
var_dump($result);
