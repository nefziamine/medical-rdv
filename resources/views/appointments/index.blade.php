@extends('layouts.app')

@section('title', 'Mes rendez-vous')

@section('header')
<div class="bg-gradient-to-br from-green-600 via-emerald-600 to-teal-700 text-white relative overflow-hidden">
  <!-- Background Pattern -->
  <div class="absolute inset-0 opacity-10">
    <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 bg-teal-300 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative">
    <div class="flex items-center justify-between">
      <div class="animate-slide-up">
        <div class="flex items-center mb-4">
          <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center mr-4 animate-bounce">
            <i class="fas fa-calendar-check text-3xl"></i>
          </div>
          <div>
            <h1 class="text-4xl lg:text-5xl font-bold mb-2 bg-gradient-to-r from-white to-green-100 bg-clip-text text-transparent">
              Mes rendez-vous
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-green-300 to-teal-300 rounded-full"></div>
          </div>
        </div>
        <p class="text-white/90 text-xl leading-relaxed max-w-2xl">
          @if(auth()->user()->isDoctor())
            <i class="fas fa-user-md mr-2 text-green-300"></i>
            Gérez vos consultations médicales avec élégance
          @else
            <i class="fas fa-heartbeat mr-2 text-teal-300"></i>
            Suivez vos rendez-vous médicaux en toute sérénité
          @endif
        </p>
      </div>
      <div class="hidden lg:block animate-fade-in" style="animation-delay: 0.5s;">
        <a href="{{ route('profile') }}" class="group inline-flex items-center bg-white/20 backdrop-blur-md text-white px-8 py-4 rounded-2xl hover:bg-white/30 transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
          <i class="fas fa-arrow-left mr-3 group-hover:-translate-x-1 transition-transform duration-300"></i>
          <span class="font-semibold">Retour au tableau de bord</span>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection

<style>
/* Enhanced animations and styles for appointments page */
@keyframes slide-up {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fade-in {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes scale-in {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

@keyframes spin-slow {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

@keyframes counter {
  from {
    opacity: 0;
    transform: scale(0.5);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

@keyframes progress {
  from {
    width: 0%;
  }
  to {
    width: var(--progress-width);
  }
}

@keyframes glow {
  0%, 100% {
    box-shadow: 0 0 5px rgba(59, 130, 246, 0.5);
  }
  50% {
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.8), 0 0 30px rgba(59, 130, 246, 0.4);
  }
}

@keyframes particle-float {
  0%, 100% {
    transform: translateY(0px) rotate(0deg);
    opacity: 0.7;
  }
  25% {
    transform: translateY(-5px) rotate(90deg);
    opacity: 1;
  }
  50% {
    transform: translateY(-10px) rotate(180deg);
    opacity: 0.8;
  }
  75% {
    transform: translateY(-5px) rotate(270deg);
    opacity: 0.9;
  }
}

@keyframes ripple {
  0% {
    transform: scale(0);
    opacity: 1;
  }
  100% {
    transform: scale(4);
    opacity: 0;
  }
}

@keyframes typewriter {
  from {
    width: 0;
  }
  to {
    width: 100%;
  }
}

.animate-slide-up {
  animation: slide-up 0.6s ease-out;
}

.animate-fade-in {
  animation: fade-in 0.8s ease-out;
}

.animate-scale-in {
  animation: scale-in 0.5s ease-out;
}

.animate-float {
  animation: float 3s ease-in-out infinite;
}

.animate-spin-slow {
  animation: spin-slow 8s linear infinite;
}

.animate-counter {
  animation: counter 0.8s ease-out;
}

.animate-progress {
  animation: progress 2s ease-out forwards;
}

.animate-glow {
  animation: glow 2s ease-in-out infinite;
}

.animate-particle-float {
  animation: particle-float 4s ease-in-out infinite;
}

.animate-ripple {
  animation: ripple 0.6s linear;
}

.animate-typewriter {
  animation: typewriter 2s steps(40, end);
}

/* Enhanced visual effects */
.glass-morphism {
  backdrop-filter: blur(10px);
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
}

.neon-glow {
  box-shadow: 0 0 5px rgba(59, 130, 246, 0.5), 0 0 10px rgba(59, 130, 246, 0.3), 0 0 15px rgba(59, 130, 246, 0.2);
}

.gradient-border {
  position: relative;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 2px;
  border-radius: 16px;
}

.gradient-border::before {
  content: '';
  position: absolute;
  inset: 2px;
  background: white;
  border-radius: 14px;
}

.magnetic-hover {
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.magnetic-hover:hover {
  transform: scale(1.05) translateY(-2px);
}

/* Particle system */
.particles-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  overflow: hidden;
  pointer-events: none;
}

.particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: rgba(59, 130, 246, 0.6);
  border-radius: 50%;
  animation: particle-float 6s ease-in-out infinite;
}

.particle:nth-child(2n) {
  background: rgba(139, 92, 246, 0.6);
  animation-delay: 1s;
}

.particle:nth-child(3n) {
  background: rgba(236, 72, 153, 0.6);
  animation-delay: 2s;
}

.particle:nth-child(4n) {
  background: rgba(34, 197, 94, 0.6);
  animation-delay: 3s;
}

/* Enhanced card hover effects */
.appointment-card {
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.appointment-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Progress bar animation */
.progress-bar {
  transition: width 0.8s ease-in-out;
}

/* Button hover effects */
.btn-enhanced {
  position: relative;
  overflow: hidden;
}

.btn-enhanced::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.btn-enhanced:hover::before {
  left: 100%;
}

/* Status indicator animations */
.status-indicator {
  animation: pulse 2s infinite;
}

.status-indicator.confirmed {
  animation: bounce 1s infinite;
}

.status-indicator.completed {
  animation: none;
}

/* Floating animation for empty state */
@keyframes float {
  0%, 100% {
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-10px);
  }
}

.floating-element {
  animation: float 3s ease-in-out infinite;
}

/* Gradient text effects */
.gradient-text {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

/* Enhanced shadow effects */
.shadow-enhanced {
  box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.shadow-enhanced:hover {
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Responsive enhancements */
@media (max-width: 768px) {
  .appointment-card {
    margin: 0 16px;
  }

  .stats-card {
    margin: 0 8px;
  }
}

/* Loading states */
.loading-shimmer {
  background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
  background-size: 200% 100%;
  animation: loading 1.5s infinite;
}

@keyframes loading {
  0% {
    background-position: 200% 0;
  }
  100% {
    background-position: -200% 0;
  }
}

/* Custom scrollbar */
.custom-scrollbar::-webkit-scrollbar {
  width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 10px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
}
</style>

<script>
// Enhanced JavaScript interactions with advanced animations
document.addEventListener('DOMContentLoaded', function() {
  // Counter animation for statistics
  function animateCounter(element, target) {
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        current = target;
        clearInterval(timer);
      }
      element.textContent = Math.floor(current);
    }, 30);
  }

  // Animate counters when they come into view
  const counters = document.querySelectorAll('.animate-counter');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const target = parseInt(entry.target.getAttribute('data-target'));
        animateCounter(entry.target, target);
        counterObserver.unobserve(entry.target);
      }
    });
  });

  counters.forEach(counter => counterObserver.observe(counter));

  // Progress bar animations with dynamic widths
  const progressBars = document.querySelectorAll('.animate-progress');
  progressBars.forEach((bar, index) => {
    const width = bar.getAttribute('data-width') || '100%';
    bar.style.setProperty('--progress-width', width);
    bar.style.animationDelay = `${index * 0.2}s`;
  });

  // Magnetic hover effect for cards
  const cards = document.querySelectorAll('.appointment-card, .stats-card');
  cards.forEach(card => {
    card.addEventListener('mousemove', function(e) {
      const rect = this.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;

      const centerX = rect.width / 2;
      const centerY = rect.height / 2;

      const rotateX = (y - centerY) / 10;
      const rotateY = (centerX - x) / 10;

      this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
    });

    card.addEventListener('mouseleave', function() {
      this.style.transform = '';
    });
  });

  // Particle system for background effects
  function createParticles() {
    const particlesContainer = document.querySelector('.particles-container') || document.body;
    for (let i = 0; i < 20; i++) {
      const particle = document.createElement('div');
      particle.className = 'particle';
      particle.style.left = Math.random() * 100 + '%';
      particle.style.top = Math.random() * 100 + '%';
      particle.style.animationDelay = Math.random() * 6 + 's';
      particlesContainer.appendChild(particle);
    }
  }

  // Create floating particles
  createParticles();

  // Ripple effect for buttons
  const buttons = document.querySelectorAll('button, .btn-enhanced');
  buttons.forEach(button => {
    button.addEventListener('click', function(e) {
      const ripple = document.createElement('div');
      ripple.className = 'animate-ripple';
      ripple.style.position = 'absolute';
      ripple.style.borderRadius = '50%';
      ripple.style.background = 'rgba(255, 255, 255, 0.6)';
      ripple.style.transform = 'scale(0)';
      ripple.style.animation = 'ripple 0.6s linear';

      const rect = this.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      ripple.style.width = ripple.style.height = size + 'px';
      ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
      ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';

      this.style.position = 'relative';
      this.appendChild(ripple);

      setTimeout(() => ripple.remove(), 600);
    });
  });

  // Enhanced scroll animations
  const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-fade-in');
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.animate-on-scroll').forEach(el => scrollObserver.observe(el));

  // Dynamic status updates with animations
  function updateStatusIndicators() {
    const indicators = document.querySelectorAll('.status-indicator');
    indicators.forEach(indicator => {
      if (indicator.classList.contains('confirmed')) {
        indicator.style.animation = 'bounce 2s infinite';
      } else if (indicator.classList.contains('pending')) {
        indicator.style.animation = 'pulse 2s infinite';
      }
    });
  }

  updateStatusIndicators();

  // Keyboard shortcuts
  document.addEventListener('keydown', function(e) {
    // Ctrl + A for appointments overview
    if (e.ctrlKey && e.key === 'a') {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Number keys for quick navigation
    if (e.key >= '1' && e.key <= '4') {
      const cards = document.querySelectorAll('.stats-card');
      const index = parseInt(e.key) - 1;
      if (cards[index]) {
        cards[index].scrollIntoView({ behavior: 'smooth' });
        cards[index].classList.add('animate-glow');
        setTimeout(() => cards[index].classList.remove('animate-glow'), 2000);
      }
    }
  });

  // Auto-refresh with visual feedback
  function updateStatsWithAnimation() {
    const statsCards = document.querySelectorAll('.stats-card');
    statsCards.forEach(card => {
      card.style.animation = 'none';
      setTimeout(() => {
        card.style.animation = 'scale-in 0.5s ease-out';
      }, 10);
    });
  }

  // Update stats every 5 minutes with animation
  setInterval(updateStatsWithAnimation, 300000);

  // Enhanced loading states with progress
  const links = document.querySelectorAll('a[href]:not([href^="#"])');
  links.forEach(link => {
    link.addEventListener('click', function(e) {
      if (this.href && !this.href.includes('#')) {
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Chargement...';
        this.style.pointerEvents = 'none';

        // Re-enable after 3 seconds (fallback)
        setTimeout(() => {
          this.innerHTML = originalText;
          this.style.pointerEvents = 'auto';
        }, 3000);
      }
    });
  });

  // Parallax effect for floating elements
  window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const rate = scrolled * -0.5;

    document.querySelectorAll('.animate-float').forEach(element => {
      element.style.transform = `translateY(${rate * 0.1}px)`;
    });
  });

  // Theme toggle (if needed in future)
  function toggleTheme() {
    document.body.classList.toggle('dark-theme');
    localStorage.setItem('theme', document.body.classList.contains('dark-theme') ? 'dark' : 'light');
  }

  // Load saved theme
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-theme');
  }
});

// Utility functions
function showNotification(message, type = 'success') {
  // Create notification element
  const notification = document.createElement('div');
  notification.className = `fixed top-4 right-4 z-50 p-4 rounded-xl shadow-2xl animate-slide-up max-w-sm ${
    type === 'success' ? 'bg-green-500 text-white' :
    type === 'error' ? 'bg-red-500 text-white' :
    'bg-blue-500 text-white'
  }`;
  notification.innerHTML = `
    <div class="flex items-center">
      <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'} mr-3"></i>
      <span class="font-medium">${message}</span>
    </div>
  `;

  document.body.appendChild(notification);

  // Remove after 5 seconds
  setTimeout(() => {
    notification.classList.add('opacity-0');
    setTimeout(() => notification.remove(), 300);
  }, 5000);
}

// Export functions for global use
window.showNotification = showNotification;
</script>

@section('content')
@php
  $user = Auth::user();
@endphp
<div class="py-8">
  <!-- Enhanced Statistics Cards with Animations -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
    <div class="text-center mb-8">
      <h2 class="text-3xl font-bold text-gray-900 mb-2 animate-fade-in">
        <i class="fas fa-chart-line mr-3 text-blue-500 animate-pulse"></i>
        Aperçu de vos rendez-vous
      </h2>
      <p class="text-gray-600 animate-slide-up" style="animation-delay: 0.2s;">Statistiques en temps réel de vos consultations</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
      <!-- Total Appointments -->
      <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-3xl p-8 text-white relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-scale-in">
        <!-- Animated background particles -->
        <div class="absolute top-4 right-4 w-2 h-2 bg-white rounded-full animate-ping opacity-75"></div>
        <div class="absolute bottom-4 left-4 w-1 h-1 bg-white rounded-full animate-ping opacity-50" style="animation-delay: 0.5s;"></div>
        <div class="absolute top-1/2 right-8 w-1.5 h-1.5 bg-white rounded-full animate-pulse opacity-60" style="animation-delay: 1s;"></div>

        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center animate-bounce">
              <i class="fas fa-calendar-alt text-2xl animate-pulse"></i>
            </div>
            <div class="text-right">
              <p class="text-blue-100 text-sm font-medium animate-fade-in">Total RDV</p>
              <p class="text-3xl font-bold animate-counter" data-target="{{ $appointments->total() }}">0</p>
            </div>
          </div>
          <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
            <div class="bg-white h-2 rounded-full animate-progress" style="width: 0%; animation-delay: 1s;" data-width="100%"></div>
          </div>
        </div>
      </div>

      <!-- Confirmed Appointments -->
      <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-3xl p-8 text-white relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-scale-in" style="animation-delay: 0.1s;">
        <!-- Animated checkmarks -->
        <div class="absolute top-6 right-6 opacity-20">
          <i class="fas fa-check text-4xl animate-bounce" style="animation-delay: 0.2s;"></i>
        </div>
        <div class="absolute bottom-6 left-6 opacity-20">
          <i class="fas fa-check text-2xl animate-bounce" style="animation-delay: 0.4s;"></i>
        </div>

        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center animate-spin-slow">
              <i class="fas fa-check-circle text-2xl animate-pulse"></i>
            </div>
            <div class="text-right">
              <p class="text-green-100 text-sm font-medium animate-fade-in">Confirmés</p>
              <p class="text-3xl font-bold animate-counter" data-target="{{ $appointments->where('status', 'confirmed')->count() }}">0</p>
            </div>
          </div>
          <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
            <div class="bg-green-200 h-2 rounded-full animate-progress" style="width: 0%; animation-delay: 1.2s;" data-width="{{ $appointments->total() > 0 ? ($appointments->where('status', 'confirmed')->count() / $appointments->total()) * 100 : 0 }}%"></div>
          </div>
        </div>
      </div>

      <!-- Pending Appointments -->
      <div class="bg-gradient-to-br from-yellow-500 to-orange-500 rounded-3xl p-8 text-white relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-scale-in" style="animation-delay: 0.2s;">
        <!-- Animated clock elements -->
        <div class="absolute top-4 right-4 w-3 h-3 border-2 border-white rounded-full opacity-30 animate-ping"></div>
        <div class="absolute bottom-4 left-4 w-2 h-2 border-2 border-white rounded-full opacity-20 animate-ping" style="animation-delay: 0.3s;"></div>

        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center">
              <i class="fas fa-clock text-2xl animate-spin-slow"></i>
            </div>
            <div class="text-right">
              <p class="text-yellow-100 text-sm font-medium animate-fade-in">En attente</p>
              <p class="text-3xl font-bold animate-counter" data-target="{{ $appointments->where('status', 'pending')->count() }}">0</p>
            </div>
          </div>
          <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
            <div class="bg-yellow-200 h-2 rounded-full animate-progress" style="width: 0%; animation-delay: 1.4s;" data-width="{{ $appointments->total() > 0 ? ($appointments->where('status', 'pending')->count() / $appointments->total()) * 100 : 0 }}%"></div>
          </div>
        </div>
      </div>

      <!-- Completed Appointments -->
      <div class="bg-gradient-to-br from-emerald-500 to-teal-600 rounded-3xl p-8 text-white relative overflow-hidden group hover:shadow-2xl transition-all duration-300 transform hover:scale-105 animate-scale-in" style="animation-delay: 0.3s;">
        <!-- Animated stars -->
        <div class="absolute top-6 left-6 text-emerald-200 opacity-30 animate-pulse">
          <i class="fas fa-star text-lg"></i>
        </div>
        <div class="absolute bottom-6 right-6 text-emerald-200 opacity-20 animate-pulse" style="animation-delay: 0.5s;">
          <i class="fas fa-star text-sm"></i>
        </div>

        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="relative z-10">
          <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center animate-bounce">
              <i class="fas fa-check-double text-2xl animate-pulse"></i>
            </div>
            <div class="text-right">
              <p class="text-emerald-100 text-sm font-medium animate-fade-in">Terminés</p>
              <p class="text-3xl font-bold animate-counter" data-target="{{ $appointments->where('status', 'completed')->count() }}">0</p>
            </div>
          </div>
          <div class="w-full bg-white/20 rounded-full h-2 overflow-hidden">
            <div class="bg-emerald-200 h-2 rounded-full animate-progress" style="width: 0%; animation-delay: 1.6s;" data-width="{{ $appointments->total() > 0 ? ($appointments->where('status', 'completed')->count() / $appointments->total()) * 100 : 0 }}%"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if($appointments->count() > 0)
    <!-- Enhanced Appointments Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Vos rendez-vous</h2>
        <p class="text-gray-600">Gérez vos consultations médicales</p>
      </div>

      <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        @foreach($appointments as $appointment)
          <div class="bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden group hover:transform hover:scale-[1.02] relative appointment-card">
            <!-- Animated Status Indicator -->
            <div class="absolute top-4 right-4 z-10">
              @if($appointment->status === 'pending')
                <div class="w-5 h-5 bg-yellow-400 rounded-full animate-pulse shadow-lg" title="En attente">
                  <div class="w-full h-full bg-yellow-300 rounded-full animate-ping opacity-75"></div>
                </div>
              @elseif($appointment->status === 'confirmed')
                <div class="w-5 h-5 bg-green-400 rounded-full animate-bounce shadow-lg" title="Confirmé">
                  <i class="fas fa-check text-white text-xs flex items-center justify-center w-full h-full"></i>
                </div>
              @elseif($appointment->status === 'completed')
                <div class="w-5 h-5 bg-blue-400 rounded-full shadow-lg" title="Terminé">
                  <i class="fas fa-check-double text-white text-xs flex items-center justify-center w-full h-full animate-pulse"></i>
                </div>
              @elseif($appointment->status === 'cancelled')
                <div class="w-5 h-5 bg-red-400 rounded-full shadow-lg" title="Annulé">
                  <i class="fas fa-times text-white text-xs flex items-center justify-center w-full h-full"></i>
                </div>
              @endif
            </div>

            <!-- Floating decorative elements -->
            <div class="absolute top-6 left-6 opacity-10 animate-float">
              <i class="fas fa-stethoscope text-emerald-500 text-2xl"></i>
            </div>
            <div class="absolute bottom-6 right-6 opacity-10 animate-float" style="animation-delay: 1s;">
              <i class="fas fa-heartbeat text-teal-400 text-xl"></i>
            </div>

            <!-- Header with Gradient Background -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-8 py-6 border-b border-gray-100">
              <div class="flex items-center space-x-4">
                @if($user->isDoctor())
                  <!-- Patient Info for Doctor -->
                  <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-3xl flex items-center justify-center shadow-lg">
                      <i class="fas fa-user text-white text-xl"></i>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-green-400 rounded-full border-2 border-white flex items-center justify-center">
                      <i class="fas fa-check text-white text-xs"></i>
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-bold text-gray-900 text-lg">{{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}</h3>
                    <p class="text-sm text-gray-600 flex items-center">
                      <i class="fas fa-envelope mr-2 text-emerald-400"></i>
                      {{ $appointment->patient->email }}
                    </p>
                    @if($appointment->patient->phone)
                      <p class="text-sm text-gray-600 flex items-center mt-1">
                        <i class="fas fa-phone mr-2 text-emerald-400"></i>
                        {{ $appointment->patient->phone }}
                      </p>
                    @endif
                  </div>
                @else
                  <!-- Doctor Info for Patient -->
                  <div class="relative">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-600 to-emerald-600 rounded-3xl flex items-center justify-center shadow-lg">
                      <i class="fas fa-user-md text-white text-xl"></i>
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-400 rounded-full border-2 border-white flex items-center justify-center">
                      <i class="fas fa-stethoscope text-white text-xs"></i>
                    </div>
                  </div>
                  <div class="flex-1">
                    <h3 class="font-bold text-gray-900 text-lg">Dr. {{ $appointment->doctor->user->first_name }} {{ $appointment->doctor->user->last_name }}</h3>
                    <p class="text-sm text-gray-600 flex items-center">
                      <i class="fas fa-stethoscope mr-2 text-emerald-400"></i>
                      {{ $appointment->doctor->specialty->name ?? 'Médecin' }}
                    </p>
                    <div class="flex items-center mt-1">
                      <div class="flex text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                      </div>
                      <span class="text-sm text-gray-600 ml-2">(4.8)</span>
                    </div>
                  </div>
                @endif
              </div>
            </div>

            <!-- Enhanced Appointment Details -->
            <div class="px-8 py-6">
              <!-- Date & Time / Location Grid -->
              <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Date & Time Card -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-5 border border-emerald-100">
                  <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                      <i class="fas fa-calendar-alt text-white"></i>
                    </div>
                    <div class="flex-1">
                      <p class="text-sm font-medium text-emerald-900 mb-1">Date & Heure</p>
                      <p class="font-bold text-emerald-800 text-lg">
                        {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d/m/Y') }}
                      </p>
                      <p class="text-emerald-700 font-medium">
                        <i class="fas fa-clock mr-2"></i>
                        {{ is_string($appointment->appointment_time) ? $appointment->appointment_time : \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                      </p>
                    </div>
                  </div>
                </div>

                <!-- Location Card -->
                <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-2xl p-5 border border-green-200">
                  <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                      @if($appointment->appointment_type === 'online')
                        <i class="fas fa-video text-white"></i>
                      @else
                        <i class="fas fa-map-marker-alt text-white"></i>
                      @endif
                    </div>
                    <div class="flex-1">
                      <p class="text-sm font-medium text-green-900 mb-1">Lieu de consultation</p>
                      <p class="font-bold text-green-800 text-lg">
                        @if($appointment->appointment_type === 'online')
                          Consultation en ligne
                        @else
                          Cabinet médical
                        @endif
                      </p>
                      <p class="text-green-700 text-sm">
                        @if($user->isDoctor())
                          <i class="fas fa-home mr-2"></i>
                          {{ $appointment->patient->address ?? 'Adresse non renseignée' }}
                        @else
                          <i class="fas fa-building mr-2"></i>
                          {{ $appointment->doctor->clinic_address ?? 'Adresse non disponible' }}
                        @endif
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Fee Display -->
              <div class="bg-gradient-to-r from-yellow-50 to-orange-50 rounded-2xl p-5 mb-6 border border-yellow-200">
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-yellow-500 rounded-xl flex items-center justify-center">
                      <i class="fas fa-coins text-white"></i>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-yellow-900">Tarif de consultation</p>
                      <p class="text-xs text-yellow-700">Prix convenu pour la consultation</p>
                    </div>
                  </div>
                  <div class="text-right">
                    <span class="text-2xl font-bold text-yellow-800">{{ $appointment->fee }} DT</span>
                    <p class="text-xs text-yellow-600">TTC</p>
                  </div>
                </div>
              </div>

              <!-- Notes Section -->
              @if($appointment->notes)
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-5 mb-6 border border-purple-200">
                  <div class="flex items-start space-x-3">
                    <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center flex-shrink-0">
                      <i class="fas fa-sticky-note text-white"></i>
                    </div>
                    <div class="flex-1">
                      <p class="text-sm font-medium text-purple-900 mb-2">Note du patient</p>
                      <p class="text-purple-800 leading-relaxed">{{ $appointment->notes }}</p>
                    </div>
                  </div>
                </div>
              @endif

              <!-- Enhanced Actions with Visual Effects -->
              <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('appointments.show', $appointment->id) }}"
                   class="flex-1 bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 px-6 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group relative overflow-hidden">
                  <!-- Animated background effect -->
                  <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-green-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                  <i class="fas fa-eye mr-3 group-hover:animate-pulse relative z-10"></i>
                  <span class="relative z-10">Détails de la consultation</span>
                  <!-- Floating particles -->
                  <div class="absolute top-2 right-2 w-1 h-1 bg-white rounded-full opacity-60 animate-ping"></div>
                </a>

                @if($user->isDoctor() && $appointment->status === 'pending')
                  <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-4 px-6 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group relative overflow-hidden">
                      <i class="fas fa-check-circle mr-3 relative z-10"></i>
                      <span class="relative z-10">Confirmer le RDV</span>
                    </button>
                  </form>
                @endif

                @if($appointment->status === 'pending' && $user->isPatient())
                  <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir annuler ce rendez-vous ?')"
                            class="w-full bg-gradient-to-r from-red-500 to-pink-500 text-white py-4 px-6 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group relative overflow-hidden">
                      <i class="fas fa-times-circle mr-3 relative z-10"></i>
                      <span class="relative z-10">Annuler le RDV</span>
                    </button>
                  </form>
                @endif

                @if($appointment->status === 'cancelled' && $user->isPatient())
                  <form method="POST" action="{{ route('appointments.force-delete', $appointment->id) }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer définitivement ce rendez-vous ? Cette action est irréversible.')"
                            class="w-full bg-gradient-to-r from-gray-600 to-gray-700 text-white py-4 px-6 rounded-2xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105 flex items-center justify-center group relative overflow-hidden">
                      <!-- Delete effect -->
                      <div class="absolute inset-0 bg-gradient-to-r from-gray-700 to-gray-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                      <i class="fas fa-trash-alt mr-3 group-hover:animate-pulse relative z-10"></i>
                      <span class="relative z-10">Supprimer définitivement</span>
                      <!-- Danger indicator -->
                      <div class="absolute -top-1 -right-1 w-3 h-3 bg-red-400 rounded-full animate-ping opacity-75"></div>
                    </button>
                  </form>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="mt-12 flex justify-center">
        {{ $appointments->links() }}
      </div>
    </div>
  @else
    <!-- Enhanced Empty State -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center py-24">
        <!-- Enhanced Animated Empty State Illustration -->
        <div class="relative mb-12">
          <!-- Main illustration with multiple layers -->
          <div class="w-48 h-48 bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 rounded-3xl flex items-center justify-center mx-auto relative overflow-hidden shadow-2xl">
            <!-- Animated background layers -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-200/30 to-purple-200/30 rounded-3xl animate-pulse"></div>
            <div class="absolute inset-2 bg-gradient-to-br from-purple-200/20 to-pink-200/20 rounded-2xl animate-pulse" style="animation-delay: 0.5s;"></div>
            <div class="absolute inset-4 bg-gradient-to-br from-pink-200/10 to-blue-200/10 rounded-xl animate-pulse" style="animation-delay: 1s;"></div>

            <!-- Main icon with glow effect -->
            <div class="relative z-10">
              <div class="absolute inset-0 bg-blue-400 rounded-full blur-lg opacity-30 animate-pulse"></div>
              <i class="fas fa-calendar-times text-blue-500 text-7xl animate-bounce relative z-10"></i>
            </div>

            <!-- Orbiting elements -->
            <div class="absolute inset-0 animate-spin-slow">
              <div class="absolute top-2 left-1/2 transform -translate-x-1/2 w-3 h-3 bg-blue-400 rounded-full opacity-60"></div>
              <div class="absolute bottom-2 left-1/2 transform -translate-x-1/2 w-2 h-2 bg-purple-400 rounded-full opacity-60"></div>
              <div class="absolute left-2 top-1/2 transform -translate-y-1/2 w-2 h-2 bg-pink-400 rounded-full opacity-60"></div>
              <div class="absolute right-2 top-1/2 transform -translate-y-1/2 w-3 h-3 bg-green-400 rounded-full opacity-60"></div>
            </div>
          </div>

          <!-- Enhanced floating elements -->
          <div class="absolute top-8 left-1/2 transform -translate-x-1/2 w-10 h-10 bg-yellow-300 rounded-full opacity-70 animate-bounce shadow-lg" style="animation-delay: 0.5s;">
            <i class="fas fa-star text-yellow-600 text-lg flex items-center justify-center w-full h-full animate-spin"></i>
          </div>
          <div class="absolute bottom-8 right-1/4 w-8 h-8 bg-green-300 rounded-full opacity-70 animate-bounce shadow-lg" style="animation-delay: 1s;">
            <i class="fas fa-heart text-green-600 text-sm flex items-center justify-center w-full h-full animate-pulse"></i>
          </div>
          <div class="absolute top-1/2 right-12 w-6 h-6 bg-purple-300 rounded-full opacity-70 animate-bounce shadow-lg" style="animation-delay: 1.5s;">
            <i class="fas fa-plus text-purple-600 text-xs flex items-center justify-center w-full h-full animate-spin"></i>
          </div>
          <div class="absolute bottom-12 left-1/4 w-7 h-7 bg-pink-300 rounded-full opacity-70 animate-bounce shadow-lg" style="animation-delay: 2s;">
            <i class="fas fa-calendar text-pink-600 text-sm flex items-center justify-center w-full h-full animate-pulse"></i>
          </div>

          <!-- Connecting lines animation -->
          <svg class="absolute inset-0 w-full h-full" viewBox="0 0 200 200">
            <defs>
              <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" style="stop-color:#3B82F6;stop-opacity:0.3" />
                <stop offset="100%" style="stop-color:#8B5CF6;stop-opacity:0.3" />
              </linearGradient>
            </defs>
            <path d="M100,50 Q150,100 100,150 Q50,100 100,50" stroke="url(#lineGradient)" stroke-width="2" fill="none" class="animate-pulse" style="animation-duration: 3s;">
              <animate attributeName="stroke-dasharray" values="0,100;100,0" dur="3s" repeatCount="indefinite"/>
            </path>
          </svg>
        </div>

        <div class="max-w-2xl mx-auto">
          <h3 class="text-4xl font-bold text-gray-900 mb-6 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Aucun rendez-vous trouvé
          </h3>
          <p class="text-xl text-gray-600 mb-12 leading-relaxed">
            @if($user->isDoctor())
              <i class="fas fa-user-md mr-2 text-blue-500"></i>
              Vous n'avez pas encore de rendez-vous programmés avec vos patients.
              <br><span class="text-gray-500">Commencez par gérer vos disponibilités pour recevoir des demandes.</span>
            @else
              <i class="fas fa-user mr-2 text-purple-500"></i>
              Vous n'avez pas encore pris de rendez-vous médical.
              <br><span class="text-gray-500">Explorez notre répertoire de médecins et prenez votre premier rendez-vous.</span>
            @endif
          </p>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            @if(!$user->isDoctor())
              <a href="{{ route('doctors.index') }}"
                 class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-3xl font-semibold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:animate-pulse">
                  <i class="fas fa-search text-xl"></i>
                </div>
                <div class="text-left">
                  <div class="font-bold">Trouver un médecin</div>
                  <div class="text-sm opacity-90">Explorer le répertoire</div>
                </div>
                <i class="fas fa-arrow-right ml-4 group-hover:translate-x-2 transition-transform duration-300"></i>
              </a>

              <a href="{{ route('specialties.index') }}"
                 class="group inline-flex items-center px-8 py-4 bg-white border-2 border-gray-200 text-gray-700 rounded-3xl font-semibold hover:shadow-xl hover:border-blue-300 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-stethoscope mr-3 text-blue-500 group-hover:animate-spin"></i>
                <span>Voir les spécialités</span>
              </a>
            @else
              <a href="{{ route('profile.availability') }}"
                 class="group inline-flex items-center px-10 py-5 bg-gradient-to-r from-green-600 to-teal-600 text-white rounded-3xl font-semibold hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mr-4 group-hover:animate-pulse">
                  <i class="fas fa-calendar-plus text-xl"></i>
                </div>
                <div class="text-left">
                  <div class="font-bold">Gérer ma disponibilité</div>
                  <div class="text-sm opacity-90">Recevoir des RDV</div>
                </div>
                <i class="fas fa-arrow-right ml-4 group-hover:translate-x-2 transition-transform duration-300"></i>
              </a>

              <a href="{{ route('profile') }}"
                 class="group inline-flex items-center px-8 py-4 bg-white border-2 border-gray-200 text-gray-700 rounded-3xl font-semibold hover:shadow-xl hover:border-green-300 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-tachometer-alt mr-3 text-green-500 group-hover:animate-bounce"></i>
                <span>Tableau de bord</span>
              </a>
            @endif
          </div>

          <!-- Additional Info -->
          <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
              <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-shield-alt text-white"></i>
              </div>
              <h4 class="font-semibold text-blue-900 mb-2">Sécurisé</h4>
              <p class="text-sm text-blue-700">Toutes vos données sont protégées</p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200">
              <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-clock text-white"></i>
              </div>
              <h4 class="font-semibold text-green-900 mb-2">24/7</h4>
              <p class="text-sm text-green-700">Support disponible à tout moment</p>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
              <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-star text-white"></i>
              </div>
              <h4 class="font-semibold text-purple-900 mb-2">Qualité</h4>
              <p class="text-sm text-purple-700">Médecins certifiés et expérimentés</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif
</div>
@endsection