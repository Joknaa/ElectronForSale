<?php
$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);

if (isset($_POST['Confirme']) AND isset($_GET['Client_ID']) AND isset($_GET['Facture_ID']))
    ConfirmeConsumption($conn, intval($_GET['Facture_ID']), intval($_GET['Client_ID']));


function AddConsumption(mysqli $conn, $Client_ID){
    $Provider_ID = 1;
    $Date = "".date('Y')."-".$_POST["month"]."-01";
    $Consumption = $_POST['consommation'];
    $TVA = 14 / 100;

    if ($Consumption <= 0): {
        echo "Please write a Consumption greater than 0";
        exit();
    }
    elseif (0 < $Consumption && $Consumption <= 100): $UnitPrice = 0.91;
    elseif (101 < $Consumption && $Consumption < 200): $UnitPrice = 1.01;
    else: $UnitPrice = 1.12;
    endif;

    //TODO: Swap the HT with TTC ?
    $PrixTTC = $Consumption * $UnitPrice;
    $PrixHT = $PrixTTC / (1 + $TVA);

    $stmt = $conn->prepare("INSERT INTO facturation.facture(id_client, id_fournisseur, consommation, prix_ttc, 
                                prix_ht, Date) VALUES ($Client_ID, $Provider_ID, $Consumption, $PrixTTC, $PrixHT, 
                                                               STR_TO_DATE(?,'%Y-%m-%d'));");
    $stmt->bind_param("s", $Date);
    if ($stmt->execute()) header('location: client.php?id=' . $Client_ID);
    else echo "Error: " . $stmt . " <br> " . $conn->error;
}

function PrintConsumptionsList(mysqli $conn, $id_client){
    $stmt_result = GetRequestResult($conn, "SELECT * FROM facturation.facture WHERE id_client = " . $id_client);

    if ($stmt_result->num_rows > 0) {
        $rows = $stmt_result->num_rows;
        do {
            $Facture = $stmt_result->fetch_assoc();
            echo '<tr><td data-label="Client N°">' . $id_client . '</td>';
            echo '<td data-label="Facture N°">' . $Facture['ID'] . '</td>';
            echo '<td data-label="Date">' . $Facture['Date'] . '</td>';
            echo '<td data-label="Consommation Entree">' . $Facture['consommation'] . ' KWH</td>';
            echo '<td data-label="Consommation Real">';
            echo '<form action="../Scripts/S_Consumption.php?Client_ID='.$id_client.'&Facture_ID='.$Facture['ID'].'" method="POST">';
            echo '<input type="number" name="RealConsumption" required> KWH</td>';
            echo '<td data-label="Action"><input type="submit" name="Confirme" value="Confirme"></form></td></tr>';
            $rows--;
        } while ($rows > 0);
    } else {
        echo '<tr><td data-label="Facture N°"> --- </td>';
        echo '<td data-label="Date"> --- </td>';
        echo '<td data-label="Consommation Entree"> --- </td>';
        echo '<td data-label="Consommation Real"> --- </td>';
        echo '<td data-label="Action"> --- </td></tr>';
    }
}

function PrintClientList(mysqli $conn){
    $stmt_result = GetRequestResult($conn, "SELECT * FROM facturation.client");

    if ($stmt_result->num_rows > 0) {
        $rows = $stmt_result->num_rows;
        do {
            $Client = $stmt_result->fetch_assoc();
            echo '<option value="' . $Client["ID"] . '">' . $Client["Email"] . '</option>';
            $rows--;
        } while ($rows > 0);
    }
}


function ConfirmeConsumption(mysqli $conn, $Facture_ID, $Client_ID){
    $OldDept = GetOldDept($conn, $Client_ID);
    $NewDept = CalculateNewDept($conn, $Facture_ID);
    $Dept = $OldDept + $NewDept;

    $stmt_UpdateDept = "UPDATE facturation.client SET Dept = " . $Dept . " WHERE ID = " . $Client_ID;
    $stmt_UpdateVerified = "UPDATE facturation.facture SET Verified = 1 WHERE ID = " . $Facture_ID;

    if (($conn->query($stmt_UpdateVerified) === TRUE) AND ($conn->query($stmt_UpdateDept) === TRUE))
        header("Location: " . $_SERVER['HTTP_REFERER']);
    else echo "Error: " . $stmt_UpdateVerified . " <br> " . $conn->error;
}

function GetRequestResult(mysqli $conn, $Request) {
    $Request_prep = $conn->prepare($Request);
    $Request_prep->execute();
    return $Request_prep->get_result();
}

function GetOldDept(mysqli $conn, $Client_ID){
    $ClientOldDept = 0;
    $Client = GetRequestResult($conn, "SELECT * FROM facturation.client WHERE ID = " . $Client_ID);
    if ($Client->num_rows > 0) {
        $Client = $Client->fetch_assoc();
        $ClientOldDept = $Client["Dept"];
    }
    return $ClientOldDept;
}
function CalculateNewDept(mysqli $conn, $Facture_ID){
    $ClientConsumption = 0;
    $Facture = GetRequestResult($conn, "SELECT * FROM facturation.facture WHERE ID = ".$Facture_ID);
    if ($Facture->num_rows > 0) {
        $Facture = $Facture->fetch_assoc();
        $ClientConsumption = $Facture["consommation"];
    }
    $RealConsumption = $_POST["RealConsumption"];
    $Sign = $ClientConsumption > $RealConsumption ? -1 : 1;
    $Dept = abs($ClientConsumption - $RealConsumption);
    $TVA = 14 / 100;

    if ($Dept <= 0): return 0;
    elseif (0 < $Dept && $Dept <= 100): $UnitPrice = 0.91;
    elseif (101 < $Dept && $Dept < 200): $UnitPrice = 1.01;
    else: $UnitPrice = 1.12;
    endif;
    return $Sign * $Dept * $UnitPrice / (1 + $TVA);
}