<?php
/**
* Adding User to the table 
* Created By: Kirti
* Date: 17/06/2016
**/ 

require_once ('library/filemakerlib/Filemaker.php');
$fm = new FileMaker('kirti.fmp12', '172.16.8.138', 'Admin', 'mindfire');


        $name1 = $_POST['php_name'];
        $age1 = $_POST['php_age'];
        $gender1 = $_POST['php_gender'];
        $email1 = $_POST['php_email'];
        $address1= $_POST['php_address'];
        $usr_type= $_POST['usertype'];
        
        $record = $fm->createRecord('Web_Layout');
        $record->setField('name',$name1);
        $record->setField('age', $age1);
        $record->setField('gender', $gender1);
        $record->setField('address', $address1);
        $record->setField('email', $email1);
        $record->setField('user_type', $usr_type);
        
        $result = $record->commit();
        $request = $fm->newFindAllCommand('Web_Layout');
        $result = $request->execute();
        $records = $result->getRecords();
        
        $users = [];
        $i = 0;
        foreach ($records as $record) {
        $users[$i]['recordId'] = $record->getRecordId();
        $users[$i]['name'] = $record->getField('name');
        $users[$i]['age'] = $record->getField('age');
        $users[$i]['email'] = $record->getField('email');
        $users[$i]['gender'] = $record->getField('gender');
        $users[$i]['address'] = $record->getField('address');
        $i++;
        
    }
    echo json_encode($users);
        
       
?>
