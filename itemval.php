<?php

$val = $_GET['selectvalue'];

$subC1 = array("Mobiles","laptops","Cameras","Speakers",);
$subC2 = array("Western","Ethnic","Winter","Footware");
$subC3 = array("Washing Machine","Refrigerator","A.C","Kitchen Appliances");

switch ($val) {
    case 'Electronics':
        foreach ($subC1 as $value) {
            echo " <option> $value </option>";
        }
        break;

    case 'Clothing':
        foreach ($subC2 as $value) {
            echo " <option> $value </option>";
        }
        break;

    case 'Appliances':
        foreach ($subC3 as $value) {
            echo " <option> $value </option>";
        }
        break;


    
    default:
        echo "No data selected";
    break;
}

?>