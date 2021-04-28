<?php
function LoginClient(mysqli $conn){
    $useremail = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM facturation.client WHERE EMAIL_CLIENT = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $result = $stmt_result->fetch_assoc();
        if ($result['MDP_CLIENT'] === $pass) {
            header('location: Client.php?id=' . $result["id_client"]);
            echo "login successfully";
        } else echo "invalide email or password";
    } else echo "invalide email or pass";
}