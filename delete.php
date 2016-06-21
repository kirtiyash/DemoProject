<?php

require_once ('library/filemakerlib/Filemaker.php');
$fm = new FileMaker('kirti.fmp12', '172.16.8.138', 'Admin', 'mindfire');

$recrdId = $_POST['recordId'];
if (FileMaker::isError($recrdId)){
        echo $result->getMessage();
        exit;
    }

/*$request = $fm->newFindCommand('Web_Layout');
$request->addFindCriterion('name', $name);
$result = $request->execute();
$records = $result->getRecords();
$recordId=$records->getRecordId();*/

$deleteRecord = $fm->newDeleteCommand('Web_Layout', $recrdId);
$result = $deleteRecord->execute();

?>
