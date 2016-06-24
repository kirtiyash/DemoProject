<?php
/**
* compound find functionality
* Created By: Kirti
* Date: 23/06/2016
**/ 
    require_once ('library/filemakerlib/Filemaker.php');
    $fm = new FileMaker('kirti.fmp12', '172.16.8.138', 'Admin', 'mindfire');

    $searchElement = $_POST['currentVal'];

    $request = $fm->newFindRequest('Web_Layout');
    $request->addFindCriterion('name', $searchElement);
    $request->addFindCriterion('user_type', 'admin');

    $request2 = $fm->newFindRequest('Web_Layout');
    $request2->addFindCriterion('age', $searchElement);
    $request2->addFindCriterion('user_type', 'admin');

    $request3= $fm->newFindRequest('Web_Layout');
    $request3->addFindCriterion('gender', $searchElement);
    $request3->addFindCriterion('user_type', 'admin');

    $request4= $fm->newFindRequest('Web_Layout');
    $request4->addFindCriterion('address', $searchElement);
    $request4->addFindCriterion('user_type', 'admin');

    $request5 = $fm->newFindRequest('Web_Layout');
    $request5->addFindCriterion('email', $searchElement);
    $request5->addFindCriterion('user_type', 'admin');

    $compoundFind = $fm->newCompoundFindCommand('Web_Layout');
    $compoundFind->add(1, $request);
    $compoundFind->add(2, $request2);
    $compoundFind->add(3, $request3);
    $compoundFind->add(4, $request4);
    $compoundFind->add(5, $request5);

    $result = $compoundFind->execute();
    if (FileMaker::isError($result)){
        echo $result->getMessage();
     } else{
        $records = $result->getRecords();
        foreach ($records as $record) {
           echo '<tr>';
           echo '<td>'.$record->getField('name').'</td>';
           echo '<td>'.$record->getField('age').'</td>';
           echo '<td>'.$record->getField('gender').'</td>';
           echo '<td>'.$record->getField('address').'</td>';
           echo '<td>'.$record->getField('email').'</td>';
           echo '</tr>';
          }
       echo '</table>';
    }
?>