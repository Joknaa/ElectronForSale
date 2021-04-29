<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/ProviderMenu.css"/>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="menu-bar">
    <ul>
        <li><a href="ClientInfo.php?id=<?php echo $Provider_ID; ?>">Clients</a></li>
        <li><a href="Client.php?id=<?php echo $Provider_ID; ?>">Verification du consommation</a></li>
        <li><a href="ClientReclamation.php?id=<?php echo $Provider_ID; ?>">Facturation</a></li>
        <li><a href="../Login.php" class="deconnexion">Déconnexion</a></li>
    </ul>
</div>
</body>
</html>