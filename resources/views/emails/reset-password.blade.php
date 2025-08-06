<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #374151;
        }
        .message {
            font-size: 16px;
            line-height: 1.7;
            color: #6b7280;
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            text-align: center;
        }
        .button:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
        .footer {
            background-color: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer p {
            margin: 0;
            color: #6b7280;
            font-size: 14px;
        }
        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 16px;
            margin: 20px 0;
        }
        .warning p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }
        .logo {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <svg width="30" height="30" fill="white" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <h1>Réinitialisation de mot de passe</h1>
        </div>
        
        <div class="content">
            <div class="greeting">
                Bonjour {{ $user->first_name }} {{ $user->last_name }},
            </div>
            
            <div class="message">
                Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte RDV Médical.
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $url }}" class="button">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            
            <div class="warning">
                <p><strong>Attention :</strong> Ce lien de réinitialisation expirera dans 60 minutes pour des raisons de sécurité.</p>
            </div>
            
            <div class="message">
                Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action n'est requise de votre part.
            </div>
        </div>
        
        <div class="footer">
            <p>Cet email a été envoyé automatiquement par RDV Médical</p>
            <p>Si vous avez des questions, contactez-nous à support@rdvmedical.tn</p>
            <p>&copy; 2025 RDV Médical. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html> 