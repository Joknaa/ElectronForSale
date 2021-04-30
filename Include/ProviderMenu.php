<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/Menu.css"/>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="menu-bar">
    <ul class="UL_Menu">
        <a href="ClientInfo.php?id=<?php echo $id_client; ?>"><li>Clients</li></a>
        <a href="Client.php?id=<?php echo $id_client; ?>"><li>Consommation</li></a>
        <a href="ClientReclamation.php?id=<?php echo $id_client; ?>"><li>Facturation</li></a>
        <a href="../Login.php" class="Btn_Logout"><li>Déconnexion</li></a>
    </ul>
</div>
</body>
</html>