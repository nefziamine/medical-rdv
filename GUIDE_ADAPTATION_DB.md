# Guide d'adaptation de la base de données

## 🎯 Objectif

Adapter les tables de la base de données pour qu'elles soient compatibles avec le nouveau code et les nouvelles pages d'inscription et de connexion.

## ✨ Modifications apportées

### 1. **Table `users`**

#### **Nouveau champ ajouté :**
- **`gender`** : Enum avec valeurs `homme`, `femme`, `autre`
- **Type** : `ENUM('homme', 'femme', 'autre')`
- **Nullable** : Oui
- **Position** : Après le champ `address`

#### **Migration créée :**
```php
// 2025_07_20_070837_add_gender_to_users_table.php
$table->enum('gender', ['homme', 'femme', 'autre'])->nullable()->after('address');
```

#### **Utilisation dans le code :**
- Formulaire d'inscription patient : champ obligatoire
- Validation : `'gender' => 'required|in:homme,femme,autre'`
- Stockage : Valeur directe dans la base de données

### 2. **Table `doctors`**

#### **Nouveau champ ajouté :**
- **`additional_services`** : JSON pour stocker les services additionnels
- **Type** : `JSON`
- **Nullable** : Oui
- **Position** : Après le champ `available_days`

#### **Migration créée :**
```php
// 2025_07_20_071031_add_additional_services_to_doctors_table.php
$table->json('additional_services')->nullable()->after('available_days');
```

#### **Structure JSON :**
```json
{
    "tele_secretariat": true,
    "professional_website": false,
    "photo_video": true,
    "waiting_room_display": false,
    "whatsapp_reminders": true
}
```

#### **Utilisation dans le code :**
- Formulaire d'inscription médecin : services optionnels
- Validation : Chaque service validé individuellement
- Cast dans le modèle : `'additional_services' => 'array'`

## 🔧 Champs existants compatibles

### **Table `users`**
- ✅ `first_name` : Prénom (obligatoire)
- ✅ `last_name` : Nom (obligatoire)
- ✅ `email` : Email (obligatoire, unique)
- ✅ `phone` : Téléphone (optionnel)
- ✅ `birth_date` : Date de naissance (optionnel)
- ✅ `address` : Adresse (optionnel)
- ✅ `user_type` : Type d'utilisateur (patient/doctor)
- ✅ `password` : Mot de passe (obligatoire)

### **Table `doctors`**
- ✅ `user_id` : Référence vers l'utilisateur
- ✅ `specialty_id` : Référence vers la spécialité
- ✅ `experience_years` : Années d'expérience
- ✅ `consultation_fee` : Tarif de consultation
- ✅ `description` : Description du médecin
- ✅ `education` : Formation
- ✅ `certifications` : Certifications
- ✅ `languages` : Langues parlées (JSON)
- ✅ `start_time` : Heure de début
- ✅ `end_time` : Heure de fin
- ✅ `available_days` : Jours disponibles (JSON)
- ✅ `clinic_address` : Adresse de la clinique
- ✅ `clinic_phone` : Téléphone de la clinique
- ✅ `is_available` : Disponibilité
- ✅ `rating` : Note moyenne

## 🚀 Commandes d'exécution

### **1. Exécuter les migrations**
```bash
php artisan migrate
```

### **2. Créer les données de test**
```bash
php artisan db:seed --class=TestDataSeeder
```

### **3. Vérifier la structure**
```bash
php artisan migrate:status
```

## 📊 Données de test créées

### **Comptes utilisateurs de test :**

#### **Patient :**
- **Email** : `patient@test.com`
- **Mot de passe** : `password123`
- **Nom** : Ahmed Ben Ali
- **Genre** : homme
- **Type** : patient

#### **Médecin :**
- **Email** : `doctor@test.com`
- **Mot de passe** : `password123`
- **Nom** : Dr. Sarah Martin
- **Genre** : femme
- **Type** : doctor
- **Spécialité** : Cardiologie
- **Services additionnels** : Télé-secrétariat, Photo/Vidéo, WhatsApp

### **Médecins supplémentaires :**
1. **Dr. Mohamed Hassan** - Dermatologie
2. **Dr. Fatima Zouari** - Gynécologie
3. **Dr. Ali Ben Salem** - Pédiatrie

### **Spécialités créées :**
- Cardiologie, Dermatologie, Gynécologie
- Neurologie, Ophtalmologie, Orthopédie
- Pédiatrie, Psychiatrie, Radiologie, Urologie

## 🔒 Validation des données

### **Inscription Patient :**
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

### **Inscription Médecin :**
```php
$request->validate([
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|email|unique:users',
    'phone' => 'required|string|max:20',
    'phone_country_code' => 'required|string|max:5',
    'country' => 'required|string|max:100',
    'city' => 'required|string|max:100',
    'postal_code' => 'nullable|string|max:20',
    'address' => 'nullable|string|max:500',
    'diploma_number' => 'nullable|string|max:100',
    'university' => 'nullable|string|max:200',
    'graduation_year' => 'nullable|integer|min:1950|max:2030',
    'tele_secretariat' => 'nullable|in:yes,no',
    'professional_website' => 'nullable|in:yes,no',
    'photo_video' => 'nullable|in:yes,no',
    'waiting_room_display' => 'nullable|in:yes,no',
    'whatsapp_reminders' => 'nullable|in:yes,no',
    'message' => 'nullable|string|max:1000',
    'password' => ['required', 'confirmed', Password::defaults()],
    'terms' => 'required|accepted',
    'recaptcha' => 'required|accepted',
]);
```

## 🎯 Compatibilité avec les pages

### **Pages d'inscription :**
- ✅ `/register` - Page de choix
- ✅ `/register-patient` - Inscription patient
- ✅ `/register-doctor` - Inscription médecin

### **Pages de connexion :**
- ✅ `/login` - Page de choix
- ✅ `/login-patient` - Connexion patient
- ✅ `/login-doctor` - Connexion médecin

### **Pages existantes :**
- ✅ `/profile` - Profil utilisateur
- ✅ `/doctors` - Liste des médecins
- ✅ `/appointments` - Rendez-vous

## 🔄 Modèles mis à jour

### **User Model :**
```php
protected $fillable = [
    'first_name', 'last_name', 'email', 'phone',
    'birth_date', 'address', 'gender', 'user_type', 'password',
];
```

### **Doctor Model :**
```php
protected $casts = [
    'languages' => 'array',
    'available_days' => 'array',
    'consultation_fee' => 'decimal:2',
    'experience_years' => 'integer',
    'is_available' => 'boolean',
    'rating' => 'decimal:2',
    'availability' => 'array',
    'additional_services' => 'array',
];
```

## 📞 Support et dépannage

### **Problèmes courants :**

1. **Erreur de migration**
   ```bash
   php artisan migrate:rollback
   php artisan migrate
   ```

2. **Erreur de seeder**
   ```bash
   php artisan db:seed --class=TestDataSeeder
   ```

3. **Vérification de la structure**
   ```bash
   php artisan migrate:status
   ```

### **Vérification des données :**
```sql
-- Vérifier les utilisateurs
SELECT id, first_name, last_name, email, gender, user_type FROM users;

-- Vérifier les médecins
SELECT d.*, u.first_name, u.last_name, s.name as specialty 
FROM doctors d 
JOIN users u ON d.user_id = u.id 
JOIN specialties s ON d.specialty_id = s.id;

-- Vérifier les spécialités
SELECT * FROM specialties;
```

## 🎉 Résultat final

La base de données est maintenant entièrement compatible avec :
- ✅ Les nouveaux formulaires d'inscription
- ✅ Les nouveaux formulaires de connexion
- ✅ La validation spécifique par type d'utilisateur
- ✅ Le stockage des services additionnels
- ✅ Les données de test pour le développement

Toutes les pages fonctionnent correctement avec la nouvelle structure de base de données ! 🚀 