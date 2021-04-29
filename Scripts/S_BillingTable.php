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
            $result = $stmt_result->fetch_assoc();
            echo '<tr><td data-label="Facture N°">' . $result['id_facture'] . '</td>';
            echo '<td data-label="Compteur">' . $result['consommation'] . 'KWH</td>';
            echo '<td data-label="Prix (HT)">' . $result['prix_ht'] . 'DH</td>';
            echo '<td data-label="Prix (TTC)">' . $result['prix_ttc'] . 'DH</td>';
            echo '<td data-label="Date de Saisie">' . $result['date_facture'] . '</td>';
            echo '<td data-label="Etat">' . $result['etat_facture'] . '</td>';
            echo '<td data-label="Action"><form action="../Scripts/S_BillingTable.php?Client_ID='.$id_client.'&Facture_ID='.$result['id_facture'].'" method="POST">';
            echo '<input type="submit" name="PayerCheque" value="Cheque ">';
            echo '<input type="submit" name="PayerEspece" value="Espece"></form></td></tr>';
            $rows--;
        } while ($rows > 0);
    } else {
        $_SESSION['ID_FACTURE'] = "---";
        $_SESSION['CONSOMMATION'] = "---";
        $_SESSION['PRIX_HT'] = "---";
        $_SESSION['PRIX_TTC'] = "---";
        $_SESSION['DATE_FACTURE'] = "---";
        $_SESSION['ETAT_FACTURE'] = "---";
    }
}

function PayBill(mysqli $conn, $Facture_ID){
    if (isset($_POST['PayerCheque'])) echo "Payement Espece";
    elseif (isset($_POST['PayerEspece'])) echo "Payement par Cheque";
    else header('Location: ../Login.php');

    $stmt = "UPDATE facturation.facture SET etat_facture=1 WHERE id_facture = " . $Facture_ID;
    if ($conn->query($stmt) === TRUE) header("Location: " . $_SERVER['HTTP_REFERER']);
    else echo "Error: " . $stmt . " <br> " . $conn->error;
}
