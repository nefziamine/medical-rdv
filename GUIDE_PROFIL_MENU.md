# Guide du menu profil et pages séparées

## 🎯 Objectif

Ajouter un menu déroulant sous l'icône du profil avec des liens vers les informations personnelles, changer le mot de passe et supprimer le compte, et créer des pages séparées pour les patients et médecins.

## ✨ Fonctionnalités ajoutées

### 1. **Menu déroulant du profil**

#### **Localisation :**
- Page principale : `/profile`
- Navigation : En haut à droite, sous l'icône du profil

#### **Fonctionnalités :**
- **Menu interactif** : Utilisation d'Alpine.js pour l'interactivité
- **Liens contextuels** : Redirection automatique selon le type d'utilisateur
- **Icônes** : Chaque option a son icône distinctive
- **Séparateurs** : Organisation visuelle avec des lignes de séparation

#### **Options disponibles :**
1. **Informations personnelles** → Page spécifique patient/médecin
2. **Changer mot de passe** → Page commune de changement de mot de passe
3. **Supprimer le compte** → Confirmation avant suppression
4. **Déconnexion** → Déconnexion immédiate

### 2. **Pages séparées par type d'utilisateur**

#### **Page Patient** (`/profile/patient`)
- **URL** : `/profile/patient`
- **Route** : `profile.patient`
- **Contrôleur** : `ProfileController@showPatientProfile`
- **Vue** : `resources/views/profile/patient.blade.php`

#### **Champs disponibles :**
- Prénom (obligatoire)
- Nom (obligatoire)
- Email (obligatoire, unique)
- Téléphone (optionnel)
- Date de naissance (optionnel)
- Genre (optionnel : homme, femme, autre)
- Adresse (optionnel)

#### **Page Médecin** (`/profile/doctor`)
- **URL** : `/profile/doctor`
- **Route** : `profile.doctor`
- **Contrôleur** : `ProfileController@showDoctorProfile`
- **Vue** : `resources/views/profile/doctor.blade.php`

#### **Sections disponibles :**

##### **Informations personnelles :**
- Prénom, nom, email, téléphone
- Date de naissance, genre, adresse

##### **Informations professionnelles :**
- Spécialité (obligatoire)
- Années d'expérience
- Tarif de consultation
- Adresse de la clinique
- Téléphone de la clinique
- Disponibilité (disponible/non disponible)
- Description
- Formation
- Certifications

### 3. **Page de changement de mot de passe**

#### **URL** : `/profile/password`
- **Route** : `profile.password`
- **Contrôleur** : `ProfileController@showPasswordChange`
- **Vue** : `resources/views/profile/password.blade.php`

#### **Fonctionnalités :**
- **Mot de passe actuel** : Validation de l'ancien mot de passe
- **Nouveau mot de passe** : Minimum 8 caractères
- **Confirmation** : Double vérification du nouveau mot de passe
- **Boutons d'affichage** : Afficher/masquer les mots de passe
- **Validation** : Messages d'erreur personnalisés

## 🔧 Implémentation technique

### **1. Alpine.js pour l'interactivité**

```html
<div x-data="{ open: false }">
  <button @click="open = !open">
    <!-- Contenu du bouton -->
  </button>
  <div x-show="open" @click.away="open = false">
    <!-- Menu déroulant -->
  </div>
</div>
```

### **2. Routes ajoutées**

```php
// Profile management
Route::get('/profile/patient', [ProfileController::class, 'showPatientProfile'])->name('profile.patient');
Route::put('/profile/patient', [ProfileController::class, 'updatePatientProfile'])->name('profile.patient.update');
Route::get('/profile/doctor', [ProfileController::class, 'showDoctorProfile'])->name('profile.doctor');
Route::put('/profile/doctor', [ProfileController::class, 'updateDoctorProfile'])->name('profile.doctor.update');
Route::get('/profile/password', [ProfileController::class, 'showPasswordChange'])->name('profile.password');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.delete');
```

### **3. Méthodes du contrôleur**

#### **ProfileController :**
- `showPatientProfile()` : Affiche la page profil patient
- `updatePatientProfile()` : Met à jour le profil patient
- `showDoctorProfile()` : Affiche la page profil médecin
- `updateDoctorProfile()` : Met à jour le profil médecin
- `showPasswordChange()` : Affiche la page changement mot de passe
- `updatePassword()` : Met à jour le mot de passe

### **4. Validation des données**

#### **Patient :**
```php
'first_name' => 'required|string|max:255',
'last_name' => 'required|string|max:255',
'email' => 'required|email|unique:users,email,' . $user->id,
'phone' => 'nullable|string|max:20',
'birth_date' => 'nullable|date',
'gender' => 'nullable|in:homme,femme,autre',
'address' => 'nullable|string|max:500',
```

#### **Médecin :**
```php
// + champs patient
'specialty_id' => 'required|exists:specialties,id',
'experience_years' => 'nullable|integer|min:0|max:50',
'consultation_fee' => 'nullable|numeric|min:0',
'clinic_address' => 'nullable|string|max:255',
'clinic_phone' => 'nullable|string|max:20',
'is_available' => 'boolean',
'description' => 'nullable|string|max:1000',
'education' => 'nullable|string|max:1000',
'certifications' => 'nullable|string|max:1000',
```

#### **Mot de passe :**
```php
'current_password' => ['required', 'current_password'],
'password' => ['required', 'string', 'min:8', 'confirmed'],
```

## 🎨 Interface utilisateur

### **1. Menu déroulant**

#### **Style :**
- **Position** : Absolute, aligné à droite
- **Largeur** : 48 (w-48)
- **Ombre** : Shadow-lg pour l'élévation
- **Z-index** : 50 pour être au-dessus des autres éléments

#### **Options :**
- **Informations personnelles** : Icône utilisateur, fond coloré selon la page active
- **Changer mot de passe** : Icône clé
- **Supprimer le compte** : Icône poubelle, texte rouge
- **Déconnexion** : Icône sortie

### **2. Pages de profil**

#### **Patient (Bleu) :**
- **Couleur principale** : Blue-500
- **Focus** : Ring-blue-500
- **Bouton** : Bg-blue-500

#### **Médecin (Rouge) :**
- **Couleur principale** : Red-500
- **Focus** : Ring-red-500
- **Bouton** : Bg-red-500

#### **Mot de passe (Bleu) :**
- **Couleur principale** : Blue-500
- **Boutons d'affichage** : Icônes œil pour afficher/masquer

### **3. Navigation**

#### **Breadcrumb :**
- **Retour au profil** : Bouton gris en haut à droite
- **Titre** : Grand titre avec description
- **Messages** : Succès/erreur en haut de page

## 🔒 Sécurité

### **1. Vérification des permissions**

```php
if (!$user->isPatient()) {
    return redirect()->route('profile')->with('error', 'Accès non autorisé.');
}

if (!$user->isDoctor()) {
    return redirect()->route('profile')->with('error', 'Accès non autorisé.');
}
```

### **2. Validation des données**

- **Email unique** : Exclusion de l'utilisateur actuel
- **Validation des mots de passe** : Vérification de l'ancien mot de passe
- **Messages d'erreur** : Personnalisés en français

### **3. Suppression de compte**

- **Confirmation** : Popup de confirmation JavaScript
- **Message** : "Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible."
- **Sécurité** : Validation du mot de passe avant suppression

## 📱 Responsive design

### **1. Menu déroulant**
- **Mobile** : Menu adaptatif
- **Desktop** : Menu fixe à droite
- **Tablet** : Menu centré

### **2. Formulaires**
- **Grille** : Responsive avec grid-cols-1 md:grid-cols-2
- **Champs** : Pleine largeur sur mobile
- **Boutons** : Taille adaptative

## 🚀 Utilisation

### **1. Accès au menu**
1. Cliquer sur l'icône du profil (en haut à droite)
2. Sélectionner l'option désirée
3. Le menu se ferme automatiquement en cliquant ailleurs

### **2. Navigation entre les pages**
- **Informations personnelles** : Redirection automatique selon le type d'utilisateur
- **Retour au profil** : Bouton "Retour au profil" en haut à droite
- **Breadcrumb** : Navigation claire et intuitive

### **3. Mise à jour des informations**
1. Remplir le formulaire
2. Cliquer sur "Mettre à jour"
3. Message de succès affiché
4. Redirection vers la même page

## 🎉 Résultat final

Le système de profil est maintenant :
- ✅ **Modulaire** : Pages séparées pour patients et médecins
- ✅ **Sécurisé** : Validation et vérification des permissions
- ✅ **Intuitif** : Menu déroulant avec icônes
- ✅ **Responsive** : Adaptation mobile et desktop
- ✅ **Complet** : Toutes les fonctionnalités demandées implémentées

Les utilisateurs peuvent maintenant facilement gérer leurs informations personnelles, changer leur mot de passe et supprimer leur compte via un menu déroulant intuitif ! 🚀 