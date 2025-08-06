# Guide d'inscription avec choix du type de compte

## 🎯 Fonctionnalité

Système d'inscription amélioré qui permet aux utilisateurs de choisir entre l'inscription patient ou médecin, avec des formulaires dédiés et optimisés pour chaque type d'utilisateur.

## ✨ Caractéristiques principales

### 1. **Page de choix centralisée**
- Interface claire pour choisir le type de compte
- Design moderne avec logo personnalisé
- Navigation intuitive

### 2. **Formulaires spécialisés**
- **Patient** : Formulaire simple et direct
- **Médecin** : Formulaire complet avec services additionnels

### 3. **Expérience utilisateur optimisée**
- Processus d'inscription guidé
- Validation en temps réel
- Messages d'erreur clairs

## 🔧 Structure du système

### **Flux d'inscription**

```
/register (Page de choix)
├── Patient → /register-patient
└── Médecin → /register-doctor
```

### **Pages créées**

1. **`register-choice.blade.php`** - Page de choix
2. **`register-patient.blade.php`** - Inscription patient
3. **`register-doctor.blade.php`** - Inscription médecin (existante)

## 🎨 Interface utilisateur

### **Page de choix (`/register`)**

#### **Design**
- Logo personnalisé avec figures humaines
- Cartes interactives pour chaque type
- Effets de survol et transitions
- Design responsive

#### **Fonctionnalités**
- Clic sur carte pour redirection
- Bouton retour fonctionnel
- Lien vers connexion existante

### **Page d'inscription patient (`/register-patient`)**

#### **Design basé sur l'image de référence**
- Logo identique
- Formulaire en deux colonnes
- Champs avec placeholders
- Icônes pour les champs spéciaux

#### **Champs du formulaire**
- **Colonne gauche** : Prénom, Contact, Mot de passe, Genre
- **Colonne droite** : Nom, Courriel, Confirmation mot de passe, Naissance
- **Validation** : Conditions et RGPD

## 🛠️ Aspects techniques

### **Routes ajoutées**
```php
Route::get('/register', [AuthController::class, 'showRegisterChoice'])->name('register');
Route::get('/register-patient', [AuthController::class, 'showPatientRegister'])->name('register.patient');
Route::post('/register-patient', [AuthController::class, 'registerPatient'])->name('register.patient');
```

### **Méthodes du contrôleur**
- `showRegisterChoice()` : Affiche la page de choix
- `showPatientRegister()` : Affiche le formulaire patient
- `registerPatient()` : Traite l'inscription patient

### **Validation patient**
```php
$request->validate([
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'phone' => 'required|string|max:20',
    'birth_date' => 'required|date',
    'gender' => 'required|in:homme,femme,autre',
    'password' => ['required', 'confirmed', Password::defaults()],
    'terms' => 'required|accepted',
]);
```

### **Modèle User mis à jour**
- Ajout du champ `gender` dans `$fillable`
- Support pour les genres : homme, femme, autre

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
- Validation de la date de naissance

## 🚀 Processus d'inscription

### **Étapes pour l'utilisateur**

1. **Accès à l'inscription**
   - Cliquer sur "S'inscrire" dans la navigation
   - Redirection vers `/register`

2. **Choix du type de compte**
   - Sélectionner "Patient" ou "Médecin"
   - Redirection vers le formulaire approprié

3. **Remplir le formulaire**
   - **Patient** : Formulaire simple avec champs essentiels
   - **Médecin** : Formulaire complet avec services additionnels

4. **Validation et création**
   - Validation des données
   - Création du compte
   - Connexion automatique

### **Différences entre les formulaires**

#### **Patient**
- Champs essentiels uniquement
- Validation simple
- Création directe du compte

#### **Médecin**
- Formulaire complet
- Services additionnels
- Configuration automatique du profil

## 📊 Données collectées

### **Patient**
- Informations personnelles de base
- Date de naissance obligatoire
- Genre obligatoire
- Téléphone avec code pays (+216)

### **Médecin**
- Informations personnelles complètes
- Informations académiques
- Services souhaités
- Configuration professionnelle

## 🎯 Avantages

### **Pour les utilisateurs**
- Processus d'inscription clair
- Formulaires adaptés au besoin
- Expérience utilisateur optimisée
- Navigation intuitive

### **Pour l'administration**
- Séparation claire des types d'utilisateurs
- Données structurées par type
- Validation spécialisée
- Gestion facilitée

## 🔄 Intégration

### **Avec le système existant**
- Compatible avec l'authentification
- Utilise les modèles existants
- Cohérent avec le design
- Navigation intégrée

### **Extensions possibles**
- Validation par email
- Processus de vérification
- Profils personnalisés
- Statistiques d'inscription

## 📞 Support

### **Problèmes courants**
1. **Erreur de validation**
   - Vérifier tous les champs requis
   - Contrôler le format des données
   - S'assurer que les conditions sont acceptées

2. **Problème de redirection**
   - Vérifier les routes
   - Contrôler les noms de vues
   - Consulter les logs

3. **Erreur de création**
   - Vérifier la base de données
   - Contrôler les permissions
   - Valider les modèles

### **Contact**
- Support technique : support@rdvmedical.tn
- Documentation : GUIDE_UTILISATION.md
- Logs d'erreur : storage/logs/laravel.log

## 🎨 Design et UX

### **Cohérence visuelle**
- Logo identique sur toutes les pages
- Couleurs cohérentes (rouge/bleu)
- Typographie uniforme
- Espacement harmonieux

### **Accessibilité**
- Labels clairs pour tous les champs
- Messages d'erreur explicites
- Navigation au clavier
- Contraste suffisant

### **Responsive design**
- Adaptation mobile et desktop
- Grilles flexibles
- Boutons optimisés pour le tactile
- Formulaires adaptatifs 