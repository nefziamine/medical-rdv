# 🏥 RDV Médical - Plateforme de Gestion de Rendez-vous

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=2D3748)](https://alpinejs.dev)

**RDV Médical** est une application web moderne et élégante conçue pour simplifier la prise de rendez-vous médicaux en Tunisie. Elle offre une interface premium et intuitive tant pour les patients que pour les praticiens.

---

## ✨ Fonctionnalités Clés

### 👤 Espace Patient
- **Recherche Avancée :** Trouvez des médecins par spécialité ou par nom avec suggestion automatique.
- **Réservation Intuitive :** Sélectionnez des créneaux disponibles en temps réel.
- **Tableau de Bord Premium :** Suivez vos rendez-vous (en attente, confirmés, terminés).
- **Historique Médical :** Accédez à la liste complète de vos anciennes consultations.
- **Gestion de Profil :** Personnalisez vos informations et votre photo de profil.

### 👨‍⚕️ Espace Médecin
- **Gestion des Disponibilités :** Configurez vos créneaux horaires par jour de la semaine.
- **Validation des RDV :** Acceptez ou refusez les demandes de consultation.
- **Statistiques en Temps Réel :** Visualisez votre activité via des cartes de scores dynamiques.
- **Profil Praticien :** Mettez en avant votre expertise, vos tarifs et l'adresse de votre cabinet.

---

## 🎨 Design & Expérience Utilisateur

L'application arbore une identité visuelle **"Emerald Premium"** :
- **Palette de couleurs :** Vert émeraude, Teal profond et blanc épuré pour un aspect médical haut de gamme.
- **Effets Visuels :** Utilisation intensive du Glassmorphism, de dégradés fluides et d'animations `slide-up`.
- **Responsive :** Une expérience parfaitement adaptée sur desktop, tablette et mobile.

---

## 🛠️ Stack Technique

- **Framework PHP :** Laravel 10+
- **Frontend :** Tailwind CSS (Design), Alpine.js (Interactivité)
- **Base de données :** MySQL
- **Asset Bundler :** Vite

---

## 📂 Structure du Projet (Vue d'ensemble)

Le projet a été réorganisé pour une maintenance optimale :

```text
resources/views/
├── auth/            # Connexion, Inscription (Patient/Docteur), MDP oublié
├── doctors/         # Listing et profils détaillés des médecins
├── specialties/     # Gestion et affichage des spécialités médicales
├── profile/         # Tableaux de bord, plannings et historique
├── pages/           # Contact, Conseils santé
├── layouts/         # Structure de base (App, Navigation)
└── components/      # Composants réutilisables (Navbar, Footer, Chatbot)
```

---

## ⚙️ Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/nefziamine/medical-rdv.git
   cd medical-rdv
   ```

2. **Installer les dépendances**
   ```bash
   composer install
   npm install
   ```

3. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   *Configurez vos accès DB dans le fichier `.env`.*

4. **Migrations et Seeds**
   ```bash
   php artisan migrate --seed
   ```

5. **Lancer l'application**
   ```bash
   php artisan serve
   npm run dev
   ```

---

## 👨‍💻 Auteur

**Amine Nefzi** - [GitHub Profile](https://github.com/nefziamine)

---
*Réalisé avec passion pour améliorer le secteur de la santé numérique.*
