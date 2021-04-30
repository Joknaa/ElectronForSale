<?php
$conn = mysqli_connect("localhost", "root", "", "facturation");
if ($conn->connect_error) die("failed to connect :" . $conn->connect_error);

if (isset($_GET['Client_ID']) AND isset($_GET['Facture_ID']))
    PayBill($conn, intval($_GET['Facture_ID']));


function PrintBillsList(mysqli $conn, $id_client){
    $stmt = $conn->prepare("SELECT * FROM facturation.facture WHERE id_client = ? ");
    $stmt->bind_param("s", $id_client);
    $stmt->execute();
    $stmt_result = $stmt->get_result();

    if ($stmt_result->num_rows > 0) {
        $rows = $stmt_result->num_rows;
        do {
            $Facture = $stmt_result->fetch_assoc();
            echo '<tr><td data-label="Facture N°">' . $Facture['ID'] . '</td>';
            echo '<td data-label="Compteur">' . $Facture['consommation'] . 'KWH</td>';
            echo '<td data-label="Prix (HT)">' . $Facture['prix_ht'] . 'DH</td>';
            echo '<td data-label="Prix (TTC)">' . $Facture['prix_ttc'] . 'DH</td>';
            echo '<td data-label="Date de Saisie">' . $Facture['Date'] . '</td>';
            echo '<td data-label="Etat">' . $Facture['Paid'] . '</td>';
            echo '<td data-label="Action"><center><form action="../Scripts/S_BillingTable.php?Client_ID='.$id_client.'&Facture_ID='.$Facture['ID'].'" method="POST">';
            echo '<input class="submit_Pay" type="submit" name="PayerCheque" value="Cheque">';
            echo '<input class="submit_Pay" type="submit" name="PayerEspece" value="Espece"></form></center></td></tr>';
            $rows--;
        } while ($rows > 0);
    } else {
        $_SESSION['ID'] = "---";
        $_SESSION['CONSOMMATION'] = "---";
        $_SESSION['PRIX_HT'] = "---";
        $_SESSION['PRIX_TTC'] = "---";
        $_SESSION['Date'] = "---";
        $_SESSION['Paid'] = "---";
    }
}

function PayBill(mysqli $conn, $Facture_ID){
    if (isset($_POST['PayerCheque'])) echo "Payement Espece";
    elseif (isset($_POST['PayerEspece'])) echo "Payement par Cheque";
    else header('Location: ../Login.php');

    $stmt = "UPDATE facturation.facture SET Paid = 1 WHERE ID = " . $Facture_ID;
    if ($conn->query($stmt) === TRUE) header("Location: " . $_SERVER['HTTP_REFERER']);
    else echo "Error: " . $stmt . " <br> " . $conn->error;
}
