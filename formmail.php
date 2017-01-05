<?php

/* Récupération des valeurs des champs du formulaire */
if (get_magic_quotes_gpc())
{
    $nom = stripslashes($_POST['NomClient']);
    $expediteur = stripslashes($_POST['MailClient']);
    $objet = stripslashes($_POST['ObjetClient']);
    $message = stripslashes($_POST['MessageClient']);
}
else
{
    $nom = $_POST['NomClient'];
    $expediteur = $_POST['MailClient'];
    $objet = $_POST['ObjetClient'];
    $message = $_POST['MessageClient'];
}

/* Destinataire (votre adresse e-mail) */
$to = 'mikael68210@gmail.com';

/* Construction du message */
$msg  = 'Bonjour,'."\r\n\r\n";
$msg .= 'Ce mail a été envoyé depuis monsite.com par '.$nom."\r\n\r\n";
$msg .= 'Voici le message qui vous est adressé :'."\r\n";
$msg .= '***************************'."\r\n";
$msg .= $message."\r\n";
$msg .= '***************************'."\r\n";

/* En-têtes de l'e-mail */
$headers = 'From: '.$nom.' <'.$expediteur.'>'."\r\n\r\n";

if (mail($to, $objet, $msg, $headers))
{
    $alert = 'E-mail envoyé avec succès';

    /* On créé un cookie de courte durée (ici 120 secondes) pour éviter de
    * renvoyer un mail en rafraichissant la page */
    setcookie("sent", "1", time() + 120);

    /* On détruit la variable $_POST */
    unset($_POST);
}
else
{
    $alert = 'Erreur d\'envoi de l\'e-mail';
}



if (empty($nom)
    || empty($expediteur)
    || empty($objet)
    || empty($message))
{
    $alert = 'Tous les champs doivent être renseignés';
}
else
{
    /* envoi de l'e-mail */
}

/* On affiche l'erreur s'il y en a une */
if (!empty($alert))
{
    echo $alert;
}
?>