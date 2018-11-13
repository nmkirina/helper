<?php
include 'view/main.php';
       $test = Excel::import('/home/irina/projects/rzd-ss/output.csv');
        $prod = Excel::import('/home/irina/projects/rzd-ss/prod.xlsx');
        
        foreach ($test as $item)
        {
            preg_match("/\((.*)\)/", $item['indexdef'], $matches);
            if (empty($matches)) {
                $matches = '';
            } else{
                $matches = $matches[1];
            }
            $keyField = str_replace(', ', '.', $matches);
            $fields = explode(',', $matches);
            $key = $item['schemaname'] . '.' . $item['tablename'] . '.' . $keyField;
            $result[$key] = [
               'schema' => $item['schemaname'],
               'table' => $item['tablename'],
               'field' => $fields,
               'indexnameTest' => $item['indexname'],
               'indexDefTest' => $item['indexdef'],            
            ];
        }
//        foreach ($prod as $item)
//        {
//            preg_match("/\((.*)\)/", $item['indexdef'], $matches);
//             if (empty($matches)) {
//                $matches = '';
//            } else{
//                $matches = $matches[1];
//            }
//            $keyField = str_replace(', ', '.', $matches);
//            $fields = explode(',', $matches);
//            $key = $item['schemaname'] . '.' . $item['tablename'] . '.' . $keyField;
//           
//            if (!key_exists($key, $result)){
//                $result[$key]['schema'] = $item['schemaname'];
//                $result[$key]['table'] = $item['tablename'];
//                $result[$key]['field'] = $fields;
//                $result[$key]['indexnameProd'] = $item['indexname'];
//                $result[$key]['indexDefProd'] = $item['indexdef'];
//            } else {
//                if (key_exists($key, $result)){
//               
//                        //($result[$key]['indexnameTest'] != $item['indexname'])) {
//                    $result[$key]['indexnameProd'] = $item['indexname'];
//                    $result[$key]['indexDefProd'] = $item['indexdef'];
//                }
//            }
//        }
        echo '<pre>';
        var_dump($prod);
        echo '</pre>';
        die;
//        echo '<pre>';
//        foreach ($onlyTest as $item) {
//            print('$this->execute("' . $item['indexdef']."\"); \n");
//        }
//        echo '</pre>';
//        die;
        
        