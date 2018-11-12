<?php
include 'view/main.php';
 $test = Excel::import('/home/irina/projects/rzd-ss/output.csv');
        $prod = Excel::import('/home/irina/projects/rzd-ss/prod.xlsx');
        
        foreach ($prod as $item){
            $result[$item['indexname']] = [
                'schema' => $item['schemaname'],
                'table' =>  $item['tablename'],
                'prod' => 1,
                'test' => 0,
            ];
        }
        foreach ($test as $item){
            if (key_exists($item['indexname'], $result)) {
                $result[$item['indexname']]['test'] = 1;
            } else {
                $result[$item['indexname']] = [
                    'schema' => $item['schemaname'],
                    'table' =>  $item['tablename'],
                    'prod' => 0,
                    'test' => 1,
                ];
            }
        }
        $schemas = [];
        $onlyProd = [];
        $onlyTest = [];
        foreach ($result as $index => $item) {
            if ($item['prod'] && !$item['test']) {
                
                $schemas[$item['schema'] . '.' .$item['table']] = [
                    'where' => 'prod',
                    'prod' => $index,
                    'test' => null,
                    ];
                $onlyProd[$index] = [
                    'schemaname' =>  $item['schema'],
                    'tablename' => $item['table'],
                    'indexname' => $index,
                ];
                
            } elseif (!$item['prod'] && $item['test']) {
                $onlyTest[$index] = $item;
                $key = $item['schema'] . '.' .$item['table'];
                if (key_exists($key, $schemas)) {
                    $schemas[$key]['where'] = 'prod&test';
                    $schemas[$key]['test'] = $index;
                    unset($onlyProd[$index]);
                } else {
                    $schemas[$key] = [
                    'where' => 'test',
                    'test' => $index,
                    'prod' => null,
                    ];                     
                    $onlyTest[$index] = [
                        'schemaname' =>  $item['schema'],
                        'tablename' => $item['table'],
                        'indexname' => $index,
                    ];
                }
            }
        }
        foreach ($onlyProd as $item) {
            $result .= '$this->createIndex({$item["indexname"]}, {$item["schemaname"].$item["tablename"]}, $column);\n';
        }
        echo '<pre>';
        var_dump($result);
        echo '</pre>';
        die;
        
        