<?php

function AddConsumption(mysqli $conn, $Client_ID){
    $Provider_ID = 1;
    $Date = "".date('Y')."-".$_POST["month"]."-01";
    $Consumption = $_POST['consommation'];
    $TVA = 14 / 100;

    if ($Consumption <= 0): {
        echo "Please write a Consumption greater than 0";
        exit();
    }
    elseif (0 < $Consumption && $Consumption <= 100): $UnitPrice = $Consumption * 0.91;
    elseif (101 < $Consumption && $Consumption < 200): $UnitPrice = $Consumption * 1.01;
    else: $UnitPrice = $Consumption * 1.12;
    endif;

    $PrixTTC = $Consumption * $UnitPrice;
    $PrixHT = $PrixTTC / (1 + $TVA);

    $stmt = $conn->prepare("INSERT INTO facturation.facture(id_client, id_fournisseur, consommation, prix_ttc, 
                                prix_ht, date_facture) VALUES ($Client_ID, $Provider_ID, $Consumption, $PrixTTC, $PrixHT, 
                                                               STR_TO_DATE(?,'%Y-%m-%d'));");

    $stmt->bind_param("s", $Date);
    if ($stmt->execute()) header('location:client.php?id=' . $Client_ID);
    else echo "Error: " . $stmt . " <br> " . $conn->error;
}

