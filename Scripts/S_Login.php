<?php
function LoginClient(mysqli $conn){
    $useremail = $_POST['username'];
    $pass = $_POST['password'];

    $stmt_client = $conn->prepare("SELECT * FROM facturation.client WHERE EMAIL_CLIENT = ?");
    $stmt_client->bind_param("s", $useremail);
    $stmt_client->execute();
    $stmt_client_result = $stmt_client->get_result();
    $stmt2_fournisseur = $conn->prepare("SELECT * FROM facturation.fournisseur WHERE email_fourniss = ?");
    $stmt2_fournisseur->bind_param("s", $useremail);
    $stmt2_fournisseur->execute();
    $stmt2_fournisseur_result = $stmt2_fournisseur->get_result();

    if ($stmt_client_result->num_rows > 0) {
        $result = $stmt_client_result->fetch_assoc();
        if ($result['MDP_CLIENT'] === $pass) {
            header('location: Client/Client.php?id=' . $result["id_client"]);
            echo "login successfully";
        } else echo "invalide email or password";
    } else if ($stmt2_fournisseur_result->num_rows > 0) {
        $result = $stmt2_fournisseur_result->fetch_assoc();
        if ($result['mdp_fourniss'] === $pass) {
            //todo; change the link to fournisseur
            header('location: Client.php');
            echo "login fournisseur successfully";
        } else echo "invalide email or password";
    } else echo "invalide email or pass";
}