<?php
/**
* edit functionality
* Created By: Kirti
* Date: 17/06/2016
* modified:23/06/2016
**/ 
require_once ('library/filemakerlib/Filemaker.php');
$fm = new FileMaker('kirti.fmp12', '172.16.8.138', 'Admin', 'mindfire');
$recrdId = $_POST['recordId'];

$name1 = $_POST['php_name'];
$age1 = $_POST['php_age'];
$gender1 = $_POST['php_gender'];
$email1 = $_POST['php_email'];
$address1= $_POST['php_address'];
$usr_type= $_POST['usertype'];

$editRecord = $fm->newEditCommand('Web_Layout', $recrdId);
$editRecord->setField('name',$name1 );
$editRecord->setField('age', $age1);
$editRecord->setField('gender', $gender1);
$editRecord->setField('address', $address1);
$editRecord->setField('email', $email1);
$editRecord->setField('user_type', $usr_type);

$result = $editRecord->execute();

?>