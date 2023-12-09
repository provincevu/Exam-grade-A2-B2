<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'exam_grade_a2_b2';


    $connect = new mysqli($servername, $username, $password, $db);
    if ($connect->connect_error){
        die('connection failed: ' . $connec->connect_error);
    }
?>