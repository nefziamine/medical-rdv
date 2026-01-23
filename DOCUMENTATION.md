# Documentation Technique - RDV Médical

Cette documentation détaille l'architecture et le fonctionnement interne de la plateforme **RDV Médical**.

## 🏗️ Architecture du Projet

L'application suit le pattern **MVC (Model-View-Controller)** standard de Laravel, optimisé pour une scalabilité future.

### 1. Modèles & Données (`app/Models`)
- **`User`** : Gère l'authentification globale. Un champ `user_type` distingue les `patient` des `doctor`.
- **`Doctor`** : Extension du modèle User contenant les informations spécifiques (spécialité, expérience, tarifs, adresse).
- **`Appointment`** : Cœur du système, reliant un patient à un médecin avec des statuts (`pending`, `confirmed`, `completed`, `cancelled`).
- **`Specialty`** : Catégories médicales avec slugs pour le SEO.
- **`Review`** : Système d'avis et notes pour les médecins.

### 2. Contrôleurs (`app/Http/Controllers`)
- **`AuthController`** : Logique d'inscription/connexion scindée pour offrir des parcours distincts aux patients et médecins.
- **`ProfileController`** : Gère la personnalisation des comptes et, point crucial, la **logique de disponibilité** des médecins.
- **`AppointmentController`** : Gère le cycle de vie d'un rendez-vous, de la vérification des créneaux au paiement simulé.

### 3. Système de Disponibilité
La disponibilité des médecins est stockée au format JSON dans la table `doctors`. 
- **Format** : `[{"day": "monday", "from": "09:00", "to": "17:00"}, ...]`
- **Vérification** : La logique dans `AppointmentController@getAvailableSlots` génère dynamiquement des créneaux de 30 minutes en excluant les rendez-vous déjà existants.

---

## 🎨 Système de Design

### UI (User Interface)
L'UI est construite avec **Tailwind CSS**. Un thème personnalisé a été implémenté via la configuration globale :
- **Primary** : Emerald (Vert émeraude) - représente la santé et la modernité.
- **Secondary** : Teal - apporte du contraste et du professionnalisme.
- **Micro-interactions** : Utilisation de transitions `duration-300` et d'animations de survol groupées.

### UX (User Experience)
- **Lazy Loading** : Les images et certains composants sont chargés de manière asynchrone pour la performance.
- **Feedback Immédiat** : Utilisation d'Alpine.js pour les toggles (dark mode, menus) sans rechargement de page.
- **Validation Frontend** : Gestion des erreurs en temps réel sur les formulaires d'authentification.

---

## 🔒 Sécurité
- **Middleware `auth`** : Protège l'accès aux tableaux de bord.
- **Policies** : Vérification systématique que les utilisateurs ne peuvent modifier que leurs propres rendez-vous.
- **Validation** : Sanétisation stricte de toutes les entrées utilisateur via les form requests ou les validations de contrôleur.

---

## 🚀 Déploiement

Le fichier `render.yaml` à la racine permet un déploiement rapide sur la plateforme Render.com.
Assurez-vous de configurer les variables d'environnement suivantes :
- `APP_KEY`
- `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `APP_URL`

---
*Dernière mise à jour : 24 Janvier 2026*
