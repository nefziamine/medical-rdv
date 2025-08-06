# Guide CSS Personnalisé - RDV Médical

## Vue d'ensemble

Ce fichier CSS personnalisé a été créé pour améliorer l'apparence et l'expérience utilisateur de toutes les pages du site, y compris les nouvelles pages de mot de passe oublié.

## 🎨 Classes CSS Disponibles

### Boutons

```html
<!-- Bouton principal -->
<button class="btn btn-primary">Connexion</button>

<!-- Bouton secondaire -->
<button class="btn btn-secondary">Annuler</button>

<!-- Bouton succès -->
<button class="btn btn-success">Confirmer</button>

<!-- Bouton danger -->
<button class="btn btn-danger">Supprimer</button>

<!-- Bouton outline -->
<button class="btn btn-outline">Plus d'infos</button>
```

### Cartes

```html
<!-- Carte simple -->
<div class="card">
    <div class="card-header">
        <h3>Titre de la carte</h3>
    </div>
    <div class="card-body">
        <p>Contenu de la carte</p>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary">Action</button>
    </div>
</div>
```

### Formulaires

```html
<!-- Groupe de formulaire -->
<div class="form-group">
    <label class="form-label">Email</label>
    <input type="email" class="form-input" placeholder="votre@email.com">
    <div class="form-error">Message d'erreur</div>
</div>

<!-- Input avec erreur -->
<input type="text" class="form-input form-input-error">

<!-- Message de succès -->
<div class="form-success">Opération réussie !</div>
```

### Alertes

```html
<!-- Alerte succès -->
<div class="alert alert-success">
    Votre mot de passe a été réinitialisé avec succès !
</div>

<!-- Alerte warning -->
<div class="alert alert-warning">
    Attention : ce lien expire dans 60 minutes.
</div>

<!-- Alerte danger -->
<div class="alert alert-danger">
    Une erreur s'est produite.
</div>

<!-- Alerte info -->
<div class="alert alert-info">
    Information importante.
</div>
```

### Pages Spécifiques

#### Mot de passe oublié
```html
<div class="forgot-password-container">
    <div class="forgot-password-card">
        <div class="forgot-password-header">
            <div class="forgot-password-icon">
                <!-- Icône -->
            </div>
            <h1 class="forgot-password-title">Mot de passe oublié</h1>
            <p class="forgot-password-subtitle">Entrez votre email</p>
        </div>
        <!-- Formulaire -->
    </div>
</div>
```

#### Réinitialisation
```html
<div class="reset-password-container">
    <div class="reset-password-card">
        <!-- Contenu -->
    </div>
</div>
```

### Dashboard

```html
<!-- Carte de statistiques -->
<div class="dashboard-stats-card">
    <div class="dashboard-stats-icon bg-blue-100">
        <!-- Icône -->
    </div>
    <div class="dashboard-stats-number">25</div>
    <div class="dashboard-stats-label">Rendez-vous</div>
</div>
```

### Rendez-vous

```html
<!-- Carte de rendez-vous -->
<div class="appointment-card">
    <div class="appointment-status appointment-status-confirmed">
        Confirmé
    </div>
    <!-- Contenu -->
</div>
```

### Médecins

```html
<!-- Carte médecin -->
<div class="doctor-card">
    <div class="doctor-avatar">DR</div>
    <div class="doctor-rating">
        ⭐⭐⭐⭐⭐ (4.8)
    </div>
    <!-- Contenu -->
</div>
```

### Profil

```html
<!-- Section profil -->
<div class="profile-section">
    <div class="profile-header">
        <div class="profile-avatar">JD</div>
        <div>
            <h2>John Doe</h2>
            <p>Médecin</p>
        </div>
    </div>
    <!-- Contenu -->
</div>
```

## 🎯 Utilisation dans les Vues

### Exemple : Page de mot de passe oublié

```html
@extends('layouts.guest')

@section('content')
<div class="forgot-password-container">
    <div class="forgot-password-card">
        <div class="forgot-password-header">
            <div class="forgot-password-icon">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                </svg>
            </div>
            <h1 class="forgot-password-title">Mot de passe oublié</h1>
            <p class="forgot-password-subtitle">Entrez votre adresse e-mail</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Adresse e-mail</label>
                <input type="email" name="email" class="form-input @error('email') form-input-error @enderror" 
                       value="{{ old('email') }}" required placeholder="votre@email.com">
                @error('email')
                    <div class="form-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-full">
                Envoyer le lien de réinitialisation
            </button>
        </form>
    </div>
</div>
@endsection
```

## 🎨 Classes Utilitaires

### Gradients
```html
<div class="bg-gradient-primary">Gradient bleu</div>
<div class="bg-gradient-success">Gradient vert</div>
<div class="bg-gradient-warning">Gradient orange</div>
<div class="bg-gradient-danger">Gradient rouge</div>
```

### Texte gradient
```html
<h1 class="text-gradient">Titre avec gradient</h1>
```

### Animations
```html
<div class="fade-in">Animation d'apparition</div>
<div class="slide-in">Animation de glissement</div>
```

## 📱 Responsive

Le CSS inclut des styles responsives automatiques :

- **Mobile** : Cartes et formulaires s'adaptent
- **Tablet** : Layout optimisé
- **Desktop** : Design complet

## 🌙 Dark Mode

Support automatique du mode sombre basé sur les préférences système.

## ♿ Accessibilité

- Focus visible sur tous les éléments interactifs
- Contraste suffisant
- Support des lecteurs d'écran

## 🎯 Avantages

1. **Cohérence** : Design uniforme sur tout le site
2. **Maintenabilité** : Classes réutilisables
3. **Performance** : CSS optimisé avec Tailwind
4. **Accessibilité** : Standards WCAG respectés
5. **Responsive** : Adaptation automatique

## 🔧 Personnalisation

Pour modifier les couleurs ou styles :

1. Éditez les variables CSS dans `:root`
2. Modifiez les classes Tailwind dans les composants
3. Ajoutez de nouvelles classes selon vos besoins

## 📋 Checklist d'utilisation

- [ ] Utiliser les classes `btn` pour tous les boutons
- [ ] Utiliser les classes `card` pour les conteneurs
- [ ] Utiliser les classes `form-*` pour les formulaires
- [ ] Utiliser les classes `alert-*` pour les messages
- [ ] Tester sur mobile et desktop
- [ ] Vérifier l'accessibilité

---

**Note** : Ce CSS est maintenant actif sur toutes les pages du site, y compris les nouvelles pages de mot de passe oublié ! 