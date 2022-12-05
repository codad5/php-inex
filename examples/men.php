

<?php
$james = "cool with you";
$export = [];

$export['welcome'] = function(){
    echo "welcome";
};

$export['print_date'] = function(){
        echo "currenct date : ".date("d-m-Y");
};
?>