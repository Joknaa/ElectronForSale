<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id'])) header('Location: ../Login.php');
$id_client = intval($_GET['id']);


$stmt = $conn->prepare("SELECT * FROM facturation.client WHERE ID = ? ");
$stmt->bind_param("s", $id_client);
$stmt->execute();
$stmt_result = $stmt->get_result();
if ($stmt_result->num_rows > 0) {
    $result = $stmt_result->fetch_assoc();
    $_SESSION['NOM_CLIENT'] = $result['Nom'];
    $_SESSION['PRENOM_CLIENT'] = $result['Prenom'];
    $_SESSION['EMAIL_CLIENT'] = $result['Email'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/Import/DialogBox.css"/>
    <meta charset='utf-8'>
    <title>Profile</title>
</head>
<body>
<?php include "../Include/ClientMenu.php"; ?>
<div class="Div_Input">
    <h1> Client Info </h1>
    <hr>
    <br>
    <label class="Label">Nom: <?php echo $_SESSION['NOM_CLIENT']; ?></label><br><br>
    <label class="Label">Prenom: <?php echo $_SESSION['PRENOM_CLIENT']; ?></label><br><br>
    <label class="Label">Email: <?php echo $_SESSION['EMAIL_CLIENT']; ?></label>
</div>
</body>
<html>
