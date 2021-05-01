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
        <a href="Provider.php?id=<?php echo $Provider_ID; ?>"><li>Clients</li></a>
        <a href="ConsumptionVerification.php?id=<?php echo $Provider_ID; ?>"><li>Consommation</li></a>
        <a href="Facturation.php?id=<?php echo $Provider_ID; ?>"><li>Facturation</li></a>
        <a href="../Login.php" class="Btn_Logout"><li>Déconnexion</li></a>
    </ul>
</div>
</body>
</html>