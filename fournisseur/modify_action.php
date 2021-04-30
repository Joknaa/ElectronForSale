<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_SESSION['NOM_F'])) echo "error";

$stmt = $conn->prepare("UPDATE facturation.client SET Nom = ? AND Prenom = ? AND Adresse = ? AND Telephone = ? 
                                        AND Email = ? WHERE ID = ?");

$stmt->bind_param("sssisi", $_POST["NOM_CLIENT"], $_POST["PRENOM_CLIENT"], $_POST["ADRESSE_CLIENT"],
    $_POST["TELEPHONE_CLIENT"], $_POST["EMAIL_CLIENT"], $_POST["id_client"]);

if (!$stmt->execute()) echo "Error: " . $stmt . " <br> " . $conn->error;
?>
<script> alert('Modification a échouée!!'); </script>
