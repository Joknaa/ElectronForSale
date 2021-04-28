<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Menu.css"/>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="menu-bar">
    <ul>
        <li><a href="ClientInfo.php?id=<?php echo $id_client; ?>">Compte</a></li>
        <li><a href="Client.php?id=<?php echo $id_client; ?>">Factures</a></li>
        <li><a href="ClientReclamation.php?id=<?php echo $id_client; ?>">Reclamation</a></li>
        <li><a href="ClientLogin.php" class="deconnexion">Déconnexion</a></li>
    </ul>
</div>
</body>
</html>