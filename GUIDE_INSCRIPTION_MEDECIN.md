# Guide d'inscription des médecins

## 🎯 Fonctionnalité

Page d'inscription dédiée aux médecins avec un formulaire complet et professionnel, similaire à celle de l'image de référence.

## ✨ Caractéristiques principales

### 1. **Formulaire complet**
- Informations personnelles détaillées
- Informations académiques
- Services complémentaires
- Validation complète des données

### 2. **Design professionnel**
- Interface moderne et responsive
- Couleurs cohérentes avec le thème
- Navigation claire et intuitive

### 3. **Fonctionnalités avancées**
- Sélection du code pays pour le téléphone
- Champs de mot de passe avec toggle de visibilité
- Validation en temps réel
- reCAPTCHA intégré

## 🔧 Structure du formulaire

### **Informations personnelles**
- Nom et prénom (obligatoires)
- Téléphone avec code pays (obligatoire)
- Email (obligatoire)
- Pays et ville (obligatoires)
- Code postal (optionnel)
- Adresse complète (optionnelle)

### **Informations académiques**
- Numéro de diplôme universitaire
- Université
- Année d'obtention

### **Services complémentaires**
- Télé-secrétariat (Oui/Non)
- Site web professionnel (Oui/Non)
- Photo/Vidéo shooting (Oui/Non)
- Affichage dynamique salle d'attente (Oui/Non)
- Rappels WhatsApp automatiques (Oui/Non)

### **Sécurité et validation**
- Mot de passe avec confirmation
- Acceptation des conditions
- reCAPTCHA
- Validation RGPD

## 🛠️ Aspects techniques

### **Routes ajoutées**
```php
Route::get('/register-doctor', [AuthController::class, 'showDoctorRegister'])->name('register.doctor');
Route::post('/register-doctor', [AuthController::class, 'registerDoctor'])->name('register.doctor');
```

### **Méthodes du contrôleur**
- `showDoctorRegister()` : Affiche le formulaire
- `registerDoctor()` : Traite l'inscription

### **Validation des données**
```php
$request->validate([
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'phone' => 'required|string|max:20',
    'phone_country_code' => 'required|string|max:5',
    'country' => 'required|string|max:100',
    'city' => 'required|string|max:100',
    // ... autres validations
]);
```

### **Création automatique**
- Création du compte utilisateur
- Création du profil médecin
- Configuration par défaut
- Connexion automatique

## 🎨 Interface utilisateur

### **Navigation**
- Header avec logo et navigation
- Message "Je suis un professionnel de santé (Inscription gratuite!)"
- Boutons Connexion/S'inscrire

### **Layout**
- Panel de contact à gauche (gradient rouge/rose)
- Formulaire principal à droite
- Cartes d'information en bas
- Section téléchargement d'app
- Footer complet

### **Responsive design**
- Adaptation mobile et desktop
- Grilles flexibles
- Boutons et champs optimisés

## 🔒 Sécurité

### **Validation côté serveur**
- Toutes les données sont validées
- Protection contre les injections
- Validation des types de données

### **Protection des données**
- Hachage des mots de passe
- Validation RGPD
- Acceptation des conditions obligatoire

### **reCAPTCHA**
- Protection contre les bots
- Validation côté client et serveur

## 📱 Fonctionnalités JavaScript

### **Toggle de mot de passe**
```javascript
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const type = field.type === 'password' ? 'text' : 'password';
    field.type = type;
}
```

### **Validation en temps réel**
- Vérification des champs requis
- Validation du format email
- Confirmation du mot de passe

## 🚀 Processus d'inscription

### **Étapes pour le médecin**

1. **Accès au formulaire**
   - Aller sur `/register-doctor`
   - Ou cliquer sur "S'inscrire" dans la navigation

2. **Remplir les informations**
   - Informations personnelles
   - Informations académiques
   - Services souhaités

3. **Validation et soumission**
   - Vérification des champs
   - Acceptation des conditions
   - Validation reCAPTCHA

4. **Création du compte**
   - Création automatique du profil
   - Connexion automatique
   - Redirection vers le profil

### **Configuration automatique**
- Spécialité par défaut
- Disponibilité de base
- Tarif de consultation par défaut
- Langues par défaut

## 📊 Données stockées

### **Table users**
- Informations de base
- Type utilisateur : 'doctor'
- Email et mot de passe

### **Table doctors**
- Profil médical complet
- Services additionnels (JSON)
- Disponibilité et tarifs

### **Services additionnels**
```json
{
    "tele_secretariat": true,
    "professional_website": false,
    "photo_video": true,
    "waiting_room_display": false,
    "whatsapp_reminders": true
}
```

## 🎯 Avantages

### **Pour les médecins**
- Inscription simple et rapide
- Formulaire complet et professionnel
- Configuration automatique
- Accès immédiat à la plateforme

### **Pour l'administration**
- Données structurées
- Validation automatique
- Profils complets
- Gestion facilitée

## 🔄 Intégration

### **Avec le système existant**
- Compatible avec l'authentification
- Intégré dans la navigation
- Cohérent avec le design
- Utilise les modèles existants

### **Extensions possibles**
- Email de bienvenue
- Validation par email
- Processus de vérification
- Intégration avec les spécialités

## 📞 Support

### **Problèmes courants**
1. **Validation échoue**
   - Vérifier tous les champs requis
   - Contrôler le format email
   - S'assurer que les conditions sont acceptées

2. **Erreur de création**
   - Vérifier la base de données
   - Contrôler les permissions
   - Consulter les logs

3. **Problème d'affichage**
   - Vérifier les assets CSS/JS
   - Contrôler la responsivité
   - Tester sur différents navigateurs

### **Contact**
- Support technique : support@rdvmedical.tn
- Documentation : GUIDE_UTILISATION.md
- Logs d'erreur : storage/logs/laravel.log 