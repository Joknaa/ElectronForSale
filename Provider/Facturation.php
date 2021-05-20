<?php
require "../Scripts/S_billsTable.php";

session_start();
$conn = mysqli_connect("localhost", "root", "", "facturation");
$result = $conn->query("SELECT ID From facturation.client ");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../CSS/Client.css"/>
    <meta charset='utf-8'>
    <title>fournisseur Space</title>
</head>
<body>
<?php include "../Include/ProviderMenu.php"; ?>

<center>
    <h1>Liste des clients</h1>
    <form method="POST">
        <select name="clients">
            <?php $stmt_result = GetRequestResult($conn, "SELECT * FROM facturation.client");

            if ($stmt_result->num_rows > 0) {
                $rows = $stmt_result->num_rows;
                do {
                    $Client = $stmt_result->fetch_assoc();

                    echo '<option value="' . $Client["ID"] . '">Client ' . $Client["ID"] . '</option>';
                    $rows--;
                } while ($rows > 0);
            } ?>
        </select>
        <input type="submit" name="submit" value="Submit"/>
    </form>
    <form action="../Scripts/filetotable.php" method="GET">
        <input type="file" name="fileUploader"/>
        <input type="submit" name="AddFile"/>
    </form>
    <h3>Liste des annees</h3>

    <table>
        <thead>
        <tr>
            <th>year</th>
            <th>Annual consumption</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_POST["submit"])) PrintYearsList($conn, $_POST["clients"]);

        ?>
        <?php
        if (isset($_POST["bill"])) generateBill($conn, $_POST["clients"]);

        ?>
        </tbody>

    </table>
</center>
</body>
</html>
