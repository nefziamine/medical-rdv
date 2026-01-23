<div x-data="chatbot()" class="fixed bottom-4 right-4 z-50">
    <!-- Chat Button -->
    <button @click="toggleChat()" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-4 shadow-lg transition-all duration-300 transform hover:scale-110">
        <i class="fas fa-comments text-xl"></i>
    </button>

    <!-- Chat Window -->
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="absolute bottom-16 right-0 w-80 h-96 bg-white dark:bg-gray-800 rounded-lg shadow-2xl border border-gray-200 dark:border-gray-700 flex flex-col">
        <!-- Header -->
        <div class="bg-blue-600 text-white p-4 rounded-t-lg flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i class="fas fa-robot text-lg"></i>
                <span class="font-semibold">Assistant RDV</span>
            </div>
            <button @click="toggleChat()" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Messages -->
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3">
            <div class="flex items-start space-x-2">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-xs"></i>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg max-w-xs">
                    <p class="text-sm text-gray-800 dark:text-gray-200">Bonjour ! Je suis l'assistant virtuel de RDV Médical. Comment puis-je vous aider ?</p>
                </div>
            </div>
        </div>

        <!-- Quick Questions -->
        <div x-show="!selectedQuestion" class="p-4 border-t border-gray-200 dark:border-gray-700">
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Questions fréquentes :</p>
            <div class="space-y-2">
                <button @click="selectQuestion('appointment')" class="w-full text-left p-2 text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                    Comment prendre rendez-vous ?
                </button>
                <button @click="selectQuestion('payment')" class="w-full text-left p-2 text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                    Comment payer ma consultation ?
                </button>
                <button @click="selectQuestion('cancel')" class="w-full text-left p-2 text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                    Comment annuler un rendez-vous ?
                </button>
                <button @click="selectQuestion('support')" class="w-full text-left p-2 text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded transition-colors">
                    Contacter le support
                </button>
            </div>
        </div>

        <!-- Answer -->
        <div x-show="selectedQuestion" class="p-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-start space-x-2 mb-3">
                <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-robot text-white text-xs"></i>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900 p-3 rounded-lg flex-1">
                    <p class="text-sm text-gray-800 dark:text-gray-200" x-html="getAnswer()"></p>
                </div>
            </div>
            <button @click="backToQuestions()" class="text-blue-600 dark:text-blue-400 text-sm hover:underline">
                ← Retour aux questions
            </button>
        </div>
    </div>
</div>

<script>
function chatbot() {
    return {
        isOpen: false,
        selectedQuestion: null,

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (!this.isOpen) {
                this.selectedQuestion = null;
            }
        },

        selectQuestion(question) {
            this.selectedQuestion = question;
        },

        backToQuestions() {
            this.selectedQuestion = null;
        },

        getAnswer() {
            const answers = {
                appointment: `
                    Pour prendre rendez-vous :<br>
                    1. Connectez-vous à votre compte<br>
                    2. Recherchez un médecin par spécialité<br>
                    3. Sélectionnez un créneau disponible<br>
                    4. Confirmez et procédez au paiement<br>
                    <br>
                    Rendez-vous confirmé après paiement !
                `,
                payment: `
                    Méthodes de paiement acceptées :<br>
                    • Carte bancaire (Visa/Mastercard)<br>
                    • Flouci (paiement mobile tunisien)<br>
                    • Virement bancaire<br>
                    <br>
                    Le paiement est sécurisé et traité immédiatement.
                `,
                cancel: `
                    Pour annuler un rendez-vous :<br>
                    1. Allez dans "Mes rendez-vous"<br>
                    2. Cliquez sur le rendez-vous<br>
                    3. Utilisez le bouton "Annuler"<br>
                    <br>
                    Annulation possible jusqu'à 24h avant.
                `,
                support: `
                    Contactez notre support :<br>
                    📧 Email: support@rdvmedical.tn<br>
                    📞 Téléphone: +216 00 000 000<br>
                    🕒 Horaires: Lun-Ven 9h-18h<br>
                    <br>
                    Nous répondons sous 24h !
                `
            };

            return answers[this.selectedQuestion] || 'Désolé, je n\'ai pas de réponse pour cette question.';
        }
    }
}
</script>