<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Réussie</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .header {
            background-color: #3182ce;
            text-align: center;
            padding: 20px;
            color: #ffffff;
        }
        .header img {
            max-width: 150px;
            height: auto;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            color: #3182ce;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 16px;
            color: #333333;
            line-height: 1.5;
        }
        .content a {
            display: inline-block;
            background-color: #3182ce;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
        .footer {
            background-color: #eeeeee;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://tikerama.com/assets/img/brand/logo-tikerama.png" alt="Logo">
        </div>
        <div class="content">
            <h1>Inscription Réussie</h1>
            <p>Bonjour, {{ $user->name }} {{ $user->surname }}</p>
            <p>Merci pour votre inscription ! Veuillez trouver dans ce mail votre mot de passe de connexion.</p>
            
            <p><strong>Mot de passe :</strong> {{ $password }}</p>
            <p>Désormais, vous pouvez <a href="http://127.0.0.1:8000/login">vous connecter ici</a> en renseignant vos informations de connexion.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Tikerama. Tous droits réservés.</p>
        </div>
        <div class="footer text-xs">
            <span>Si vous n'avez pas fait cette inscription, veuillez ignorer ce message.</span>
        </div>
    </div>
</body>
</html>
