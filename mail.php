<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations du formulaire et échapper les caractères spéciaux
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['textarea1']));

    // Valider les champs
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Définir l'adresse e-mail de destination
        $to = 'pro.emeric.m@gmail.com';

        // Définir le sujet du message
        $subject = 'Nouveau message de ' . $name;

        // Construire le corps du message
        $body = "Vous avez reçu un nouveau message de " . $name . " (" . $email . ") :\n\n" . $message;

        // Définir les en-têtes de l'e-mail
        $headers = "From: " . $email . "\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Envoyer l'e-mail
        if (mail($to, $subject, $body, $headers)) {
            echo 'Merci pour votre message !';
        } else {
            echo 'Désolé, une erreur s\'est produite. Veuillez réessayer.';
        }
    } else {
        echo 'Veuillez remplir tous les champs correctement.';
    }
}
?>