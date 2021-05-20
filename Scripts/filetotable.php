<?php
FileToTable();

function FileToTable(){
    $conn = mysqli_connect("localhost", "root", "", "facturation");
    if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);
    $file = fopen("file.txt", "r");
    while (!feof($file)) {
        $tab = fgets($file);
        $a = explode(",", $tab);
        list($id_client, $year, $consomation) = $a;
        $sql = "INSERT INTO facturation.consombyyear (`id_client`, `year`, `consomation`) VALUES ('$id_client','$year','$consomation')";
        $conn->query($sql);
    }
    fclose($file);
    header("Location: ../Provider/Facturation.php");
}

