<?php
/**
* Adding User to the table 
* Created By: Kirti
* Date: 17/06/2016
**/
require_once ('library/filemakerlib/Filemaker.php');
$fm = new FileMaker('kirti.fmp12', '172.16.8.138', 'Admin', 'mindfire');
        
    $request = $fm->newFindAllCommand('Web_Layout');
    $result = $request->execute();
    
    if (FileMaker::isError($result)){
        echo $result->getMessage();
        exit;
    }
    $records = $result->getRecords();
   
   // Display table records
   
   $users = [];
   $i = 0;
    foreach ($records as $record) {
        //echo '<tr data-recordId="'. $record->getRecordId(). '">';
        //echo '<td>' . $record->getField('name') . '</td>';
        //echo '<td>' . $record->getField('age') . '</td>';    
        //echo '<td>' . $record->getField('email') . '</td>';
        //echo '<td>' . $record->getField('gender') . '</td>';
        //echo '<td>' . $record->getField('address') . '</td>';
        //echo "</tr>";
        $users[$i]['recordId'] = $record->getRecordId();
        $users[$i]['name'] = $record->getField('name');
        $users[$i]['age'] = $record->getField('age');
        $users[$i]['gender'] = $record->getField('gender');
        $users[$i]['email'] = $record->getField('email');
        $users[$i]['address'] = $record->getField('address');
        $i++;
    }
    echo json_encode($users);
        
?>
