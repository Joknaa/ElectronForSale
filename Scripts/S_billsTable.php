<?php
$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);
//if (isset($_GET['Client_ID']) AND isset($_GET['Facture_ID']))

function PrintClientList(mysqli $conn)
{
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

function PrintYearsList(mysqli $conn, $id_client)
{

    $stmt = $conn->prepare("SELECT * FROM facturation.consombyyear WHERE id_client = ? ");
    $stmt->bind_param("s", $id_client);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $rows = $stmt_result->num_rows;
        do {
            $result = $stmt_result->fetch_assoc();
            echo '<tr><td data-label="year">' . $result['year'] . '</td>';
            echo '<td data-label="Annual consumption">' . $result['consomation'] . 'KWH</td>';
            echo '<td data-label="Credit">' . $result['dept'] . 'DH</td>';
            echo '<td data-label="Action"><form action="recappdf.php?Client_ID=' . $id_client . '" method="POST">';

            echo '<input type="submit" name="bill" value="Generate Bill"></form></td></tr>';
            $rows--;
        } while ($rows > 0);
    } else {
        $_SESSION['ID_FACTURE'] = "---";
        $_SESSION['CONSOMMATION'] = "---";
        $_SESSION['PRIX_HT'] = "---";
        $_SESSION['ETAT_FACTURE'] = "---";
    }


}


function generateBill(mysqli $conn, $id_client)
{
    $year = 2021;
    $stmt = "UPDATE facturation.consombyyear SET consomation =consomation+dept WHERE dept IN(SELECT dept FROM  consombyyear WHERE id_client =? AND year=$year)";

    if ($conn->query($stmt) === TRUE) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        echo "dept updated successfully !";
    } else {
        echo "Error: " . $stmt . " <br> " . $conn->error;
    }

}


function CalculateNewDept(mysqli $conn, $Facture_ID)
{
    $ClientConsumption = 0;
    $Facture = GetRequestResult($conn, "SELECT * FROM facturation.facture WHERE ID = " . $Facture_ID);
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


function GetRequestResult(mysqli $conn, $Request)
{
    $Request_prep = $conn->prepare($Request);
    $Request_prep->execute();
    return $Request_prep->get_result();
}
