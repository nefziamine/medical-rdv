# Guide - Système de Mot de Passe Oublié

## Vue d'ensemble

Le système de réinitialisation de mot de passe permet aux utilisateurs de récupérer l'accès à leur compte en cas d'oubli de mot de passe. Le processus est sécurisé et utilise des tokens temporaires.

## Fonctionnalités

### ✅ Implémentées

1. **Page de demande de réinitialisation** (`/forgot-password`)
   - Interface moderne et responsive
   - Validation des emails
   - Messages d'erreur et de succès

2. **Page de réinitialisation** (`/reset-password/{token}`)
   - Formulaire sécurisé avec token
   - Validation du nouveau mot de passe
   - Confirmation du mot de passe

3. **Email de réinitialisation**
   - Template HTML personnalisé
   - Design professionnel
   - Lien sécurisé avec token

4. **Sécurité**
   - Tokens temporaires (60 minutes)
   - Validation des emails
   - Protection contre les attaques

## Routes disponibles

| Méthode | URL | Nom | Description |
|---------|-----|-----|-------------|
| GET | `/forgot-password` | `password.request` | Affiche le formulaire de demande |
| POST | `/forgot-password` | `password.email` | Traite la demande d'envoi |
| GET | `/reset-password/{token}` | `password.reset` | Affiche le formulaire de réinitialisation |
| POST | `/reset-password` | `password.store` | Traite la réinitialisation |

## Fichiers créés/modifiés

### Vues
- `resources/views/forgot-password.blade.php` - Page de demande
- `resources/views/reset-password.blade.php` - Page de réinitialisation
- `resources/views/emails/reset-password.blade.php` - Template email

### Contrôleurs
- `app/Http/Controllers/AuthController.php` - Méthodes ajoutées

### Modèles
- `app/Models/User.php` - Méthode `sendPasswordResetNotification`

### Notifications
- `app/Notifications/ResetPasswordNotification.php` - Notification personnalisée

### Routes
- `routes/web.php` - Routes de réinitialisation ajoutées

## Configuration requise

### 1. Configuration Email

Ajoutez dans votre fichier `.env` :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="RDV Médical"
```

### 2. Base de données

Vérifiez que la table `password_reset_tokens` existe :

```bash
php artisan migrate:status
```

Si elle n'existe pas :

```bash
php artisan migrate
```

## Utilisation

### Pour les utilisateurs

1. **Demande de réinitialisation**
   - Aller sur `/forgot-password`
   - Entrer l'adresse email
   - Cliquer sur "Envoyer le lien de réinitialisation"

2. **Réception de l'email**
   - Vérifier la boîte email
   - Cliquer sur le lien dans l'email

3. **Réinitialisation du mot de passe**
   - Entrer le nouveau mot de passe
   - Confirmer le mot de passe
   - Cliquer sur "Réinitialiser le mot de passe"

4. **Connexion**
   - Utiliser le nouveau mot de passe pour se connecter

### Pour les développeurs

#### Test des routes

```bash
php test_password_reset.php
```

#### Test manuel

1. Créer un utilisateur de test
2. Aller sur `/forgot-password`
3. Entrer l'email de test
4. Vérifier l'email reçu
5. Tester la réinitialisation

## Sécurité

### Mesures implémentées

- **Tokens temporaires** : 60 minutes d'expiration
- **Validation des emails** : Vérification de l'existence
- **Protection CSRF** : Tokens inclus dans les formulaires
- **Validation des mots de passe** : Règles de complexité
- **Throttling** : Limitation des demandes

### Bonnes pratiques

1. **Configuration SMTP sécurisée**
2. **Monitoring des tentatives**
3. **Logs de sécurité**
4. **Tests réguliers**

## Personnalisation

### Modifier le design

Les vues utilisent Tailwind CSS. Modifiez les classes dans :
- `resources/views/forgot-password.blade.php`
- `resources/views/reset-password.blade.php`

### Modifier l'email

Éditez le template dans :
- `resources/views/emails/reset-password.blade.php`

### Modifier les messages

Les messages sont dans les vues. Modifiez les textes selon vos besoins.

## Dépannage

### Problèmes courants

1. **Email non reçu**
   - Vérifier la configuration SMTP
   - Vérifier les logs Laravel
   - Tester avec un email valide

2. **Lien expiré**
   - Le token expire après 60 minutes
   - Demander un nouveau lien

3. **Erreur de validation**
   - Vérifier le format de l'email
   - Respecter les règles de mot de passe

### Logs utiles

```bash
# Voir les logs Laravel
tail -f storage/logs/laravel.log

# Voir les logs d'email
tail -f storage/logs/laravel.log | grep mail
```

## Tests

### Test automatisé

```bash
php test_password_reset.php
```

### Test manuel

1. Créer un utilisateur
2. Tester la demande de réinitialisation
3. Vérifier l'email
4. Tester la réinitialisation
5. Vérifier la connexion

## Support

Pour toute question ou problème :
- Vérifiez les logs Laravel
- Testez avec `test_password_reset.php`
- Consultez la documentation Laravel
- Contactez l'équipe de développement

---

**Note** : Ce système est maintenant entièrement fonctionnel et prêt à être utilisé en production. 