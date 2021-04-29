<?php

function AddReclamation(mysqli $conn, $Client_ID){
    $Fournisseur_ID = 1;
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $stmt = "INSERT INTO facturation.reclamation(id_client, subject, message , EMAIL, id_fournisseur)
 VALUES ('$Client_ID', '$subject', '$body','$email', $Fournisseur_ID);";

    if ($conn->query($stmt) === TRUE) header('location: client.php?id=' . $Client_ID);
    else echo "Error: " . $stmt . " <br> " . $conn->error;
}