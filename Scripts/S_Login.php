<?php

function LoginClient(mysqli $conn){
    $GLOBALS["Conn"] = $conn;
    $GLOBALS["Email"] = $_POST['username'];
    $GLOBALS["Password"] = $_POST['password'];

    $Result = UserExist_In("client");
    if ($Result -> num_rows > 0) {
        $Result = $Result->fetch_assoc();
        if ($Result['Password'] === $GLOBALS["Password"]) {
            header('location: Client/Client.php?id=' . $Result["ID"]);
        } else
            echo "invalide email or password";
    }

    $Result = UserExist_In("fournisseur");
    if ($Result -> num_rows > 0) {
        $Result = $Result->fetch_assoc();
        if ($Result['Password'] === $GLOBALS["Password"]) {
            header('location: Provider/ConsumptionVerification.php?id=' . $Result["ID"]);
        } else
            echo "invalide email or password";
    } else echo "invalide email or pass";
}

function UserExist_In($Table){
    $stmt = $GLOBALS["Conn"]->prepare("SELECT * FROM facturation.". $Table ." WHERE Email = ?");
    $stmt->bind_param("s", $GLOBALS["Email"]);
    $stmt->execute();
    return $stmt->get_result();
}