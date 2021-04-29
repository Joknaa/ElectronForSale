<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
if (!isset($_GET['id'])) header('Location: ../Login.php');
$id_client = intval($_GET['id']);


$stmt = $conn->prepare("SELECT * FROM facturation.client WHERE id_client = ? ");
$stmt->bind_param("s", $id_client);
$stmt->execute();
$stmt_result = $stmt->get_result();
if ($stmt_result->num_rows > 0) {
    $result = $stmt_result->fetch_assoc();
    $_SESSION['NOM_CLIENT'] = $result['NOM_CLIENT'];
    $_SESSION['PRENOM_CLIENT'] = $result['PRENOM_CLIENT'];
    $_SESSION['EMAIL_CLIENT'] = $result['EMAIL_CLIENT'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/Menu.css"/>
    <link rel="stylesheet" href="../CSS/ClientInfo.css"/>
    <meta charset='utf-8'>
    <title>Accueil</title>
</head>
<body>
<?php include "../Include/Menu.php"; ?>
<div class="user">
    <h1> Client Info </h1><br>
    Nom:<span class="nom"> <?php echo $_SESSION['NOM_CLIENT']; ?> </span><br><br>
    Prénom:<span class="prenom"> <?php echo $_SESSION['PRENOM_CLIENT']; ?> </span><br><br>
    Email:<span class="email"> <?php echo $_SESSION['EMAIL_CLIENT']; ?> </span>
</div>
</body>
<html>