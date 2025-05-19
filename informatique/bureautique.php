<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secrétariat bureautique - Vitrine de l'étudiant</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD700', // Jaune
                        secondary: '#0066CC', // Bleu
                        dark: '#1A1A1A', // Noir
                    }
                }
            }
        }
    </script>
    <style>
        .hero-section {
            background: linear-gradient(135deg, rgba(0,102,204,0.9) 0%, rgba(255,215,0,0.8) 100%);
        }
        .highlight-box {
            position: relative;
            padding-left: 1.5rem;
        }
        .highlight-box::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #FFD700;
            border-radius: 2px;
        }
        .info-card {
            transition: all 0.3s ease;
            border-left: 4px solid #0066CC;
        }
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Barre de navigation existante -->
    <nav class="bg-white text-black shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <img src="../log.png" alt="Logo" class="h-12">
                </div>
                
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="../index.php" class="hover:text-primary transition">Accueil</a>
                    
                    <!-- Services -->
                    <div class="relative group" id="services-menu">
                        <button class="hover:text-primary transition flex items-center">
                            Nos services <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute hidden group-hover:block bg-white text-dark rounded-md shadow-lg mt-2 py-2 w-48 z-50">
                            <a href="#formations" class="block px-4 py-2 hover:bg-gray-100">Formations professionnelles</a>
                            <a href="#stages" class="block px-4 py-2 hover:bg-gray-100">Stages en entreprise</a>
                            <a href="#emplois" class="block px-4 py-2 hover:bg-gray-100">Insertion professionnelle</a>
                            <a href="#accompagnement" class="block px-4 py-2 hover:bg-gray-100">Accompagnement personnalisé</a>
                        </div>
                    </div>
                                        
                    <!-- Formations -->
                    <div class="relative group" id="formations-menu">
                        <button class="hover:text-primary transition flex items-center">
                            Formations et certifications <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute hidden group-hover:block bg-white text-dark rounded-md shadow-lg mt-2 py-2 w-64 z-50">
                            <!-- Informatique -->
                            <div class="relative submenu-container" data-submenu="informatique">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Sécretariat</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sécretariat bureautique</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sécretariat caisse</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sécretariat comptabilité</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Sécretariat médical</a>
                                </div>
                            </div>
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <a href="Formation.php" class="block w-full text-gray-900 hover:text-blue-600">
                                        Autres formations
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div>
                            <a href="#apropos" class="hover:text-primary transition">À propos</a>
                            <a href="#contact" class="hover:text-primary transition">Contact</a>
                            <a href="#actualites" class="hover:text-primary transition">Actualités</a>
                        </div>
                </div>
            </div>
        </div>
    </nav>
<!-- Contenu principal -->
<main>
    <!-- Hero Section -->
    <section class="hero-section text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">Informatique Bureautique</h1>
                <p class="text-xl md:text-2xl mb-8">Devenez opérationnel avec les outils bureautiques les plus utilisés dans le monde professionnel</p>
                <a href="../index.php" class="bg-primary text-dark font-bold px-8 py-3 rounded-lg hover:bg-yellow-500 transition duration-300 inline-block">
                    <i class="fas fa-user-graduate mr-2"></i> S'inscrire maintenant
                </a>
            </div>
        </div>
    </section>

    <!-- Contenu de la formation -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Résumé -->
                <div class="mb-12 highlight-box">
                    <h2 class="text-2xl font-bold text-secondary mb-4">Pourquoi suivre cette formation ?</h2>
                    <p class="text-gray-700 leading-relaxed">
                        La maîtrise des logiciels bureautiques est devenue indispensable dans le monde du travail. Cette formation vous permet d’apprendre à utiliser efficacement Word, Excel, PowerPoint et Outlook afin de produire des documents professionnels, gérer des données et réaliser des présentations percutantes.
                    </p>
                </div>

                <!-- Objectifs -->
                <div class="mb-12 bg-gray-50 p-8 rounded-lg border-l-4 border-primary">
                    <h2 class="text-2xl font-bold text-secondary mb-6">Objectifs pédagogiques</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">
                                <i class="fas fa-check text-xs"></i>
                            </span>
                            <span class="text-gray-700">Créer et mettre en forme des documents Word</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">
                                <i class="fas fa-check text-xs"></i>
                            </span>
                            <span class="text-gray-700">Utiliser Excel pour les calculs, tableaux et graphiques</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">
                                <i class="fas fa-check text-xs"></i>
                            </span>
                            <span class="text-gray-700">Créer des présentations PowerPoint claires et dynamiques</span>
                        </li>
                        <li class="flex items-start">
                            <span class="bg-primary text-white rounded-full w-6 h-6 flex items-center justify-center mr-3">
                                <i class="fas fa-check text-xs"></i>
                            </span>
                            <span class="text-gray-700">Gérer efficacement vos emails avec Outlook</span>
                        </li>
                    </ul>
                </div>

                <!-- Infos pratiques -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <!-- Durée -->
                    <div class="info-card bg-gray-50 p-6 rounded-lg">
                        <div class="text-secondary text-3xl mb-3">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Durée</h3>
                        <p class="text-gray-700 font-medium">1 mois</p>
                        <p class="text-gray-600 text-sm">(Cours intensif + pratique)</p>
                    </div>
                    
                    <!-- Date début -->
                    <div class="info-card bg-gray-50 p-6 rounded-lg">
                        <div class="text-secondary text-3xl mb-3">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Prochaine session</h3>
                        <p class="text-gray-700 font-medium">7 Octobre 2025</p>
                        <p class="text-gray-600 text-sm">En salle ou en ligne</p>
                    </div>
                    
                    <!-- Frais -->
                    <div class="info-card bg-gray-50 p-6 rounded-lg">
                        <div class="text-secondary text-3xl mb-3">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-2">Frais de participation</h3>
                        <p class="text-gray-700 font-medium">45 000 FCFA</p>
                        <p class="text-gray-600 text-sm">Manuels + support technique inclus</p>
                    </div>
                </div>

                <!-- CTA -->
                <div class="text-center">
                    <a href="#contact" class="bg-secondary text-white font-bold px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 inline-block mr-4">
                        <i class="fas fa-info-circle mr-2"></i> En savoir plus
                    </a>
                    <a href="#" class="bg-primary text-dark font-bold px-8 py-3 rounded-lg hover:bg-yellow-500 transition duration-300 inline-block">
                        <i class="fas fa-file-download mr-2"></i> Télécharger le programme
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

    <!-- Pied de page existant -->
    <footer class="bg-dark text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-graduation-cap text-primary text-2xl"></i>
                        <span class="font-bold text-xl">Vitrine de<span class="text-primary">l'étudiant</span></span>
                    </div>
                    <p class="text-gray-400">La vitrine de l'étudiant accompagne les jeunes diplômés vers l'emploi à travers des formations qualifiantes, des stages en entreprise et un suivi personnalisé.</p>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#accueil" class="text-gray-400 hover:text-primary transition">Accueil</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-primary transition">Nos services</a></li>
                        <li><a href="#apropos" class="text-gray-400 hover:text-primary transition">À propos</a></li>
                        <li><a href="#formations" class="text-gray-400 hover:text-primary transition">Formations</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-primary transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Nos services</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Formations professionnelles</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Stages en entreprise</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Insertion professionnelle</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Accompagnement personnalisé</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-primary transition">Certifications</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Newsletter</h4>
                    <p class="text-gray-400 mb-4">Abonnez-vous à notre newsletter pour recevoir nos dernières actualités et offres.</p>
                    <form class="flex">
                        <input type="email" placeholder="Votre email" class="px-4 py-2 rounded-l-md focus:outline-none text-dark w-full">
                        <button type="submit" class="bg-primary text-dark px-4 py-2 rounded-r-md hover:bg-yellow-500 transition">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 mb-4 md:mb-0">© 2025 Vitrine de l'étudiant. Tous droits réservés.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-primary transition">Mentions légales</a>
                    <a href="#" class="text-gray-400 hover:text-primary transition">Politique de confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-primary transition">Conditions générales</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Votre script existant pour la navbar mobile
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        function toggleMobileSubmenu(id) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('hidden');
        }
    </script>
</body>
</html>