<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:/xampp/htdocs/gestion parking/vendor/autoload.php';

class MailController {
    public static function envoyerEmailConfirmation($nomClient, $horaireD, $horaireF, $destinataire) {
        $mail = new PHPMailer(true);

        try {
            // Configuration du serveur SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'msellatihabiba7@gmail.com'; // Votre adresse email
            $mail->Password = 'qkkx hbye cqmv onkf'; // Votre mot de passe ou mot de passe d'application
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuration des destinataires
            $mail->setFrom('msellatihabiba7@gmail.com', 'EasyParki'); // Expéditeur
            $mail->addAddress($destinataire); // Destinataire

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Confirmation de votre réservation';
            $mail->Body = '
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f9;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 20px auto;
                            background: #ffffff;
                            border-radius: 8px;
                            overflow: hidden;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                            border: 1px solid #e0e0e0;
                        }
                        .header {
                            background: #4e73df;
                            padding: 20px;
                            text-align: center;
                            color: white;
                        }
                        .header h1 {
                            margin: 0;
                            font-size: 24px;
                        }
                        .content {
                            padding: 20px;
                            color: #333333;
                        }
                        .content p {
                            margin: 10px 0;
                            line-height: 1.6;
                        }
                        .content ul {
                            padding-left: 20px;
                        }
                        .content ul li {
                            margin-bottom: 10px;
                        }
                        .footer {
                            text-align: center;
                            padding: 15px;
                            background: #f8f9fa;
                            color: #6c757d;
                            font-size: 12px;
                        }
                        .button {
                            display: inline-block;
                            padding: 10px 20px;
                            margin-top: 20px;
                            background: #4e73df;
                            color: white;
                            text-decoration: none;
                            border-radius: 5px;
                            font-weight: bold;
                        }
                        .button:hover {
                            background: #3b5bbf;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="header">
                            <h1>Confirmation de réservation</h1>
                        </div>
                        <div class="content">
                            <p>Bonjour <strong>' . htmlspecialchars($nomClient) . '</strong>,</p>
                            <p>Nous vous confirmons votre réservation avec les détails suivants :</p>
                            <ul>
                                <li><strong>Horaire de début :</strong> ' . htmlspecialchars($horaireD) . '</li>
                                <li><strong>Horaire de fin :</strong> ' . htmlspecialchars($horaireF) . '</li>
                            </ul>
                            <p>Merci d\'avoir choisi <strong>EasyParki</strong>. Nous sommes ravis de vous servir.</p>
                            <a href="file:///C:/xampp/htdocs/gestion%20parking/view/front_office/parking%20form.html" class="button">Voir ma réservation</a>
                        </div>
                        <div class="footer">
                            <p>Ceci est un message automatique - Merci de ne pas y répondre</p>
                            <p>© ' . date('Y') . ' EasyParki - Tous droits réservés</p>
                        </div>
                    </div>
                </body>
                </html>
            ';

            // Envoyer l'email
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erreur lors de l'envoi de l'email : {$mail->ErrorInfo}");
            return false;
        }
    }
}