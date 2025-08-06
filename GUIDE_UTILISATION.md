# Guide d'Utilisation - Gestion des Rendez-vous

## 🎯 Vue d'Ensemble

Ce guide explique comment utiliser les nouvelles fonctionnalités de gestion des rendez-vous qui ont été améliorées pour résoudre les problèmes de conflits et de disponibilité.

## 👨‍⚕️ Pour les Médecins

### 1. **Confirmation des Rendez-vous**

#### Comment ça fonctionne :
- Les rendez-vous des patients arrivent avec le statut "pending"
- Vous pouvez les confirmer depuis votre profil ou la liste des rendez-vous
- Le système vérifie automatiquement la disponibilité avant confirmation

#### Étapes de confirmation :
1. Connectez-vous à votre compte médecin
2. Allez dans votre profil
3. Section "Rendez-vous patients"
4. Cliquez sur "Confirmer" à côté du rendez-vous en attente

#### Vérifications automatiques :
- ✅ Le créneau est toujours dans votre disponibilité
- ✅ Aucun autre rendez-vous confirmé sur ce créneau
- ✅ Le rendez-vous est bien en statut "pending"
- ✅ Le patient reçoit automatiquement une notification

### 2. **Gestion de la Disponibilité**

#### Définir vos créneaux :
1. Allez dans votre profil
2. Cliquez sur "Gérer disponibilité"
3. Ajoutez vos créneaux de consultation
4. Sauvegardez

#### Format des créneaux :
- **Jour** : Lundi, Mardi, Mercredi, etc.
- **De** : Heure de début (ex: 09:00)
- **À** : Heure de fin (ex: 17:00)

#### Exemple de disponibilité :
```
Lundi : 09:00 - 17:00
Mardi : 09:00 - 17:00
Mercredi : 09:00 - 12:00
Jeudi : 09:00 - 17:00
Vendredi : 09:00 - 17:00
```

### 3. **Notifications**

Vous recevrez des notifications pour :
- Nouveaux rendez-vous en attente
- Confirmations de rendez-vous
- Annulations de rendez-vous

## 👤 Pour les Patients

### 1. **Prise de Rendez-vous**

#### Comment ça fonctionne :
- Choisissez un médecin disponible
- Sélectionnez une date et un créneau
- Le système vérifie automatiquement la disponibilité
- Le rendez-vous est créé en statut "pending"

#### Étapes de prise de rendez-vous :
1. Allez sur la page des médecins
2. Choisissez un médecin
3. Cliquez sur "Prendre rendez-vous"
4. Sélectionnez une date et un créneau disponible
5. Remplissez les informations
6. Confirmez

#### Vérifications automatiques :
- ✅ Le médecin est disponible
- ✅ Le créneau est libre
- ✅ Vous n'avez pas déjà un rendez-vous à cette heure
- ✅ La date est dans le futur

### 2. **Suivi des Rendez-vous**

#### Statuts possibles :
- **En attente** : En attente de confirmation du médecin
- **Confirmé** : Confirmé par le médecin
- **Terminé** : Rendez-vous effectué
- **Annulé** : Rendez-vous annulé

#### Actions possibles :
- **Modifier** : Seulement si le rendez-vous est en attente
- **Annuler** : Seulement si le rendez-vous est en attente
- **Voir détails** : Toujours possible

### 3. **Notifications**

Vous recevrez des notifications pour :
- Confirmation de votre rendez-vous
- Annulation de votre rendez-vous
- Rappels de rendez-vous

## 🔧 Fonctionnalités Techniques

### 1. **Nettoyage Automatique**

Le système nettoie automatiquement :
- Les rendez-vous expirés (marqués comme annulés)
- Les anciens rendez-vous (supprimés après 6 mois)
- Les rendez-vous orphelins (données incohérentes)

#### Exécution manuelle :
```bash
php clean_orphaned_appointments.php
```

### 2. **Vérifications de Disponibilité**

#### Lors de la prise de rendez-vous :
- Vérification que le médecin est disponible
- Vérification que le créneau est libre
- Vérification que le patient n'a pas de conflit

#### Lors de la confirmation :
- Vérification que le créneau est toujours disponible
- Vérification qu'aucun autre rendez-vous n'est confirmé
- Vérification que le rendez-vous est en attente

### 3. **Gestion des Conflits**

#### Conflits détectés :
- Deux rendez-vous confirmés au même créneau
- Un patient avec deux rendez-vous à la même heure
- Un créneau hors de la disponibilité du médecin

#### Actions automatiques :
- Refus de la prise de rendez-vous
- Refus de la confirmation
- Messages d'erreur explicites

## 🚨 Messages d'Erreur Courants

### Pour les Patients :
- **"Ce créneau n'est pas disponible"** : Le créneau est déjà réservé
- **"Ce médecin n'est pas disponible"** : Le médecin a désactivé sa disponibilité
- **"Vous avez déjà un rendez-vous à cette heure"** : Conflit avec un autre rendez-vous

### Pour les Médecins :
- **"Ce jour n'est plus disponible"** : Le jour a été retiré de votre disponibilité
- **"Ce créneau est déjà réservé"** : Un autre patient a confirmé ce créneau
- **"Ce rendez-vous ne peut plus être confirmé"** : Le rendez-vous n'est plus en attente

## 📊 Monitoring et Maintenance

### 1. **Scripts de Maintenance**

#### Nettoyage automatique :
```bash
# Exécuter manuellement
php clean_orphaned_appointments.php

# Ou via une tâche cron (recommandé)
0 2 * * * cd /path/to/app && php clean_orphaned_appointments.php
```

### 2. **Vérifications Régulières**

#### À vérifier régulièrement :
- Rendez-vous expirés non nettoyés
- Conflits de créneaux
- Disponibilité des médecins
- Notifications non envoyées

### 3. **Logs et Debugging**

#### Logs disponibles :
- Erreurs de validation
- Conflits de créneaux
- Actions de confirmation
- Nettoyage automatique

## 🎯 Bonnes Pratiques

### Pour les Médecins :
1. **Définissez votre disponibilité** avant de recevoir des patients
2. **Confirmez rapidement** les rendez-vous en attente
3. **Mettez à jour** votre disponibilité si nécessaire
4. **Vérifiez régulièrement** vos rendez-vous

### Pour les Patients :
1. **Vérifiez la disponibilité** avant de prendre rendez-vous
2. **Attendez la confirmation** avant de vous déplacer
3. **Annulez à l'avance** si vous ne pouvez pas venir
4. **Consultez vos notifications** régulièrement

### Pour l'Administration :
1. **Exécutez le nettoyage** régulièrement
2. **Surveillez les conflits** et résolvez-les
3. **Vérifiez la cohérence** des données
4. **Maintenez les scripts** à jour

## 🔄 Workflow Complet

### 1. **Prise de Rendez-vous**
```
Patient → Choisit médecin → Sélectionne créneau → Système vérifie disponibilité → Rendez-vous créé (pending)
```

### 2. **Confirmation**
```
Médecin → Voir rendez-vous pending → Cliquer confirmer → Système vérifie disponibilité → Rendez-vous confirmé → Patient notifié
```

### 3. **Nettoyage**
```
Système → Vérifier créneaux expirés → Marquer comme annulés → Supprimer anciens → Nettoyer orphelins
```

## 📞 Support

En cas de problème :
1. Vérifiez les messages d'erreur
2. Consultez les logs
3. Exécutez le script de nettoyage
4. Contactez l'administrateur si nécessaire

---

**Note** : Ce système est conçu pour être robuste et automatique. La plupart des problèmes sont résolus automatiquement, mais une surveillance régulière est recommandée. 