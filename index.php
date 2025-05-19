<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FormaPlus - Formation, Stage et Emploi pour Jeunes Diplômés</title>
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
        /* Animation du diaporama */
        @keyframes fade {
            0% { opacity: 0; }
            20% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }
        
        .slide {
            animation: fade 12s infinite;
            opacity: 0;
        }
        
        .slide:nth-child(1) { animation-delay: 0s; }
        .slide:nth-child(2) { animation-delay: 4s; }
        .slide:nth-child(3) { animation-delay: 8s; }
        
        /* Animation des cartes */
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Animation des stats */
        @keyframes countUp {
            from { width: 0; }
            to { width: var(--width); }
        }
        
        .stat-bar {
            animation: countUp 2s ease-out forwards;
        }

        /* Styles pour les menus déroulants */
        .dropdown-menu {
            transition: opacity 0.2s ease, visibility 0.2s ease;
        }
        
        .submenu {
            transition: all 0.2s ease;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-10px);
            pointer-events: none;
        }
        
        .submenu-container:hover .submenu,
        .submenu:hover {
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
            pointer-events: auto;
        }
        
        .submenu-gap {
            position: absolute;
            right: -10px;
            width: 20px;
            height: 100%;
            top: 0;
        }
        
        .right-full {
            right: 100%;
            left: auto !important;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <!-- Barre de navigation -->
    <nav class="bg-white text-black shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-2">
                    <img src="log.png" alt="Logo" class="h-12">
                </div>
                
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#accueil" class="hover:text-primary transition">Accueil</a>
                    
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
                                    <a href="secretariat/bureautique.php" class="block px-4 py-2 hover:bg-gray-100">Sécretariat bureautique</a>
                                    <a href="secretariat/caisse.php" class="block px-4 py-2 hover:bg-gray-100">Sécretariat caisse</a>
                                    <a href="secretariat/comptabilite.php" class="block px-4 py-2 hover:bg-gray-100">Sécretariat comptabilité</a>
                                    <a href="secretariat/medical.php" class="block px-4 py-2 hover:bg-gray-100">Sécretariat médical</a>
                                </div>
                            </div>
                            
                            <!-- Management -->
                            <div class="relative submenu-container" data-submenu="management">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Comptabilité</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="comptabilite/pratique.php" class="block px-4 py-2 hover:bg-gray-100">Comptabilité pratique</a>
                                    <a href="comptabilite/caisse.php" class="block px-4 py-2 hover:bg-gray-100">Caisse</a>
                                    <a href="comptabilite/saari.php" class="block px-4 py-2 hover:bg-gray-100">Sage SAARI gestion commerciale vs i7</a>
                                    <a href="comptabilite/audit.php" class="block px-4 py-2 hover:bg-gray-100">Comptabilité-Audit-Finance</a>
                                </div>
                            </div>
                            
                            <!-- Finance -->
                            <div class="relative submenu-container" data-submenu="finance">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Informatique</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="informatique/maintenance.php" class="block px-4 py-2 hover:bg-gray-100">Maintenance informatique et GSM</a>
                                    <a href="informatique/maintenance.php" class="block px-4 py-2 hover:bg-gray-100">Maintenance informatique et réseau</a>
                                    <a href="informatique/initiation.php" class="block px-4 py-2 hover:bg-gray-100">Initiation à l'informatique</a>
                                    <a href="informatique/bureautique.php" class="block px-4 py-2 hover:bg-gray-100">Buréautique avancé</a>
                                </div>
                            </div>
                            
                            <!-- Marketing -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Marketing</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="marketing/multimedia.php" class="block px-4 py-2 hover:bg-gray-100">Multimédia et infographie</a>
                                    <a href="marketing/photographie.php" class="block px-4 py-2 hover:bg-gray-100">Photographie & Traitement d'images</a>
                                    <a href="marketing/marketing&com.php" class="block px-4 py-2 hover:bg-gray-100">Marketing & communication digitale</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Création de site web</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Infographie</a>
                                </div>
                            </div>

                            <!-- Droit -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Droit</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Assistanat juridique</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Secrétaire juridique</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Audit foncier et sécurisation immobilière</a>
                                </div>
                            </div>

                            <!-- Langues -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Langues</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Anglais des affaires</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Allemand</a>
                                </div>
                            </div>

                            <!-- Dévélopement personnel -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Développement personnel</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Rédaction de CV et LM</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Entrepreneuriat et développement d'affaires</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Art oratoire</a>
                                </div>
                            </div>

                            <!-- Renforcément de capacité -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Renforcement de capacités</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Auto-école</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Nouvelles technologies de communication et de gestion de données</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Gestion de projet</a>
                                </div>
                            </div>

                            <!-- Santé -->
                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <span>Santé</span>
                                    <i class="fas fa-chevron-right text-xs ml-2"></i>
                                    <div class="submenu-gap"></div>
                                </div>
                                <div class="submenu hidden absolute left-full top-0 bg-white shadow-lg rounded-md py-2 w-64 z-50 ml-1">
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Délégation médicale</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Secrétariat médical</a>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100">Vente en pharmacie</a>
                                </div>
                            </div>

                            <div class="relative submenu-container" data-submenu="marketing">
                                <div class="flex items-center justify-between hover:bg-gray-50 px-4 py-2">
                                    <a href="https://exemple.com/formation-rh" class="block w-full text-gray-900 hover:text-blue-600">
                                        Formation RH
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
        
        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden md:hidden bg-dark pb-4 px-4">
            <a href="#accueil" class="block py-2 hover:text-primary">Accueil</a>
            <div class="py-2">
                <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('services-menu-mobile')">
                    Nos services <i class="fas fa-chevron-down"></i>
                </button>
                <div id="services-menu-mobile" class="hidden pl-4 mt-2">
                    <a href="#formations" class="block py-2 hover:text-primary">Formations professionnelles</a>
                    <a href="#stages" class="block py-2 hover:text-primary">Stages en entreprise</a>
                    <a href="#emplois" class="block py-2 hover:text-primary">Insertion professionnelle</a>
                    <a href="#accompagnement" class="block py-2 hover:text-primary">Accompagnement personnalisé</a>
                </div>
            </div>
            <a href="#apropos" class="block py-2 hover:text-primary">À propos</a>
            <div class="py-2">
                <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('formations-menu-mobile')">
                    Formations <i class="fas fa-chevron-down"></i>
                </button>
                <div id="formations-menu-mobile" class="hidden pl-4 mt-2">
                    <div class="py-2">
                        <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('informatique-menu')">
                            Informatique <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="informatique-menu" class="hidden pl-4">
                            <a href="#" class="block py-2 hover:text-primary">Développement Web</a>
                            <a href="#" class="block py-2 hover:text-primary">Réseaux Informatiques</a>
                            <a href="#" class="block py-2 hover:text-primary">Data Science</a>
                            <a href="#" class="block py-2 hover:text-primary">Cybersécurité</a>
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('management-menu')">
                            Management <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="management-menu" class="hidden pl-4">
                            <a href="#" class="block py-2 hover:text-primary">Gestion de projet</a>
                            <a href="#" class="block py-2 hover:text-primary">Leadership</a>
                            <a href="#" class="block py-2 hover:text-primary">Ressources Humaines</a>
                            <a href="#" class="block py-2 hover:text-primary">Communication</a>
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('finance-menu')">
                            Finance <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="finance-menu" class="hidden pl-4">
                            <a href="#" class="block py-2 hover:text-primary">Comptabilité</a>
                            <a href="#" class="block py-2 hover:text-primary">Analyse financière</a>
                            <a href="#" class="block py-2 hover:text-primary">Fiscalité</a>
                            <a href="#" class="block py-2 hover:text-primary">Audit</a>
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('marketing-menu')">
                            Marketing <i class="fas fa-chevron-down"></i>
                        </button>
                        <div id="marketing-menu" class="hidden pl-4">
                            <a href="#" class="block py-2 hover:text-primary">Digital Marketing</a>
                            <a href="#" class="block py-2 hover:text-primary">Branding</a>
                            <a href="#" class="block py-2 hover:text-primary">SEO</a>
                            <a href="#" class="block py-2 hover:text-primary">Social Media</a>
                        </div>
                    </div>
                    <div class="py-2">
                        <button class="flex items-center justify-between w-full hover:text-primary" onclick="toggleMobileSubmenu('marketing-menu')">
                            Formation RH <i class="fas fa-chevron-down"></i>
                        </button>
                    </div>
                </div>
            </div>
            <a href="#contact" class="block py-2 hover:text-primary">Contact</a>
            <a href="#actualites" class="block py-2 hover:text-primary">Actualités</a>
        </div>
    </nav>

    <!-- Diaporama -->
   <section id="accueil" class="relative h-screen overflow-hidden"><br><br>
    <!-- Texte défilant -->
    <marquee behavior="scroll" direction="left" scrollamount="10" class="absolute top-4 w-full text-white text-4xl md:text-6xl font-extrabold z-20">
        🌟 Bienvenue à la vitrine de l'étudiant ! 🌟
    </marquee>

    <div class="absolute inset-0 flex items-center justify-center">
        <!-- Slide 1 -->
        <div class="slide absolute inset-0 bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center flex items-center">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="container mx-auto px-4 z-10 text-white text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Formation Professionnelle <span class="text-primary">de Qualité</span></h1>
                <p class="text-xl md:text-2xl mb-8">Accélérez votre carrière avec nos programmes adaptés aux besoins du marché</p>
                <a href="#formations" class="bg-primary text-dark font-bold px-8 py-3 rounded-full hover:bg-yellow-500 transition">Découvrir nos formations</a>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="slide absolute inset-0 bg-[url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center flex items-center">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="container mx-auto px-4 z-10 text-white text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Stages en <span class="text-primary">Entreprise</span></h1>
                <p class="text-xl md:text-2xl mb-8">Acquérez une expérience pratique avec nos partenaires professionnels</p>
                <a href="#stages" class="bg-primary text-dark font-bold px-8 py-3 rounded-full hover:bg-yellow-500 transition">Voir les offres</a>
            </div>
        </div>

        <!-- Slide 3 -->
        <div class="slide absolute inset-0 bg-[url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center flex items-center">
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="container mx-auto px-4 z-10 text-white text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">Accompagnement <span class="text-primary">Personnalisé</span></h1>
                <p class="text-xl md:text-2xl mb-8">Nos experts vous guident vers le succès professionnel</p>
                <a href="#accompagnement" class="bg-primary text-dark font-bold px-8 py-3 rounded-full hover:bg-yellow-500 transition">En savoir plus</a>
            </div>
        </div>
    </div>

    <!-- Contrôles du diaporama -->
    <div class="absolute bottom-8 left-0 right-0 flex justify-center space-x-2 z-10">
        <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none" onclick="goToSlide(0)"></button>
        <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none" onclick="goToSlide(1)"></button>
        <button class="w-3 h-3 rounded-full bg-white bg-opacity-50 focus:outline-none" onclick="goToSlide(2)"></button>
    </div>
</section>

    <!-- Section Statistiques -->
    <section class="py-16 bg-secondary text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Vitrine de l'étudiant en Chiffres</h2>
                <p class="max-w-2xl mx-auto">Notre impact sur la formation et l'insertion professionnelle des jeunes diplômés</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2" id="students-count">0</div>
                    <p>Étudiants formés</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2" id="partners-count">0</div>
                    <p>Partenaires entreprises</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2" id="employment-count">0</div>
                    <p>Taux d'insertion</p>
                </div>
                <div class="text-center">
                    <div class="text-4xl font-bold mb-2" id="trainings-count">0</div>
                    <p>Formations disponibles</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Services -->
    <section id="services" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 text-dark">Nos Services</h2>
                <p class="max-w-2xl mx-auto text-gray-600">Découvrez notre gamme complète de services dédiés à votre réussite professionnelle</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Service 1 -->
                <div id="formations" class="service-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-dark">Formations Professionnelles</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Des programmes adaptés aux besoins du marché, dispensés par des experts.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">En savoir plus →</a>
                    </div>
                </div>
                
                <!-- Service 2 -->
                <div id="stages" class="service-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-briefcase text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-dark">Stages en Entreprise</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Accès à des opportunités de stage dans des entreprises partenaires de renom.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">En savoir plus →</a>
                    </div>
                </div>
                
                <!-- Service 3 -->
                <div id="emplois" class="service-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1521791055366-0d553872125f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-user-tie text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-dark">Insertion Professionnelle</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Accompagnement vers l'emploi avec notre réseau d'entreprises partenaires.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">En savoir plus →</a>
                    </div>
                </div>
                
                <!-- Service 4 -->
                <div id="accompagnement" class="service-card bg-white rounded-lg shadow-md overflow-hidden transition duration-300">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-hands-helping text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold text-dark">Accompagnement Personnalisé</h3>
                        </div>
                        <p class="text-gray-600 mb-4">Coaching individuel pour maximiser votre potentiel et atteindre vos objectifs.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">En savoir plus →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section À propos -->
    <section id="apropos" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 md:pr-8">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Équipe FormaPlus" class="rounded-lg shadow-lg">
                </div>
                <div class="md:w-1/2">
                    <h2 class="text-3xl font-bold mb-6 text-dark">À propos de <span class="text-primary">la vitrine de l'étudiant</span></h2>
                    <p class="text-gray-600 mb-4">Fondée en 2010, la vitrine de l'éudiant s'est imposée comme un acteur majeur dans la formation et l'accompagnement des jeunes diplômés vers l'emploi.</p>
                    <p class="text-gray-600 mb-6">Notre mission est de combler le fossé entre l'éducation et le monde professionnel en offrant des formations pratiques, des stages qualitatifs et un accompagnement personnalisé pour chaque jeune diplômé.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <p class="text-gray-600"><span class="font-semibold">Expertise:</span> Une équipe de formateurs professionnels expérimentés</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <p class="text-gray-600"><span class="font-semibold">Réseau:</span> Plus de 200 entreprises partenaires à travers le pays</p>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-primary p-2 rounded-full mr-4 mt-1">
                                <i class="fas fa-check text-white text-xs"></i>
                            </div>
                            <p class="text-gray-600"><span class="font-semibold">Approche:</span> Méthodes pédagogiques innovantes et adaptées</p>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-block mt-6 bg-secondary text-white font-bold px-6 py-2 rounded-full hover:bg-blue-700 transition">Notre histoire</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Formations -->
   <!-- Section Formations défilantes -->
<section class="py-16 bg-gray-50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-12">
      <h2 class="text-3xl font-bold mb-4 text-dark">Nos Domaines de <span class="text-primary">Formation</span></h2>
      <p class="max-w-2xl mx-auto text-gray-600">Des programmes complets et certifiants pour booster votre carrière</p>
    </div>

    <!-- Conteneur de défilement -->
   <div id="carousel-container" class="overflow-hidden">
  <div id="carousel" class="flex gap-6 transition-all duration-300">
    
    <!-- Domaine 1 - Secrétariat -->
    <div class="w-80 flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
      <div class="h-48 bg-[url('https://images.unsplash.com/photo-1555212697-194d092e3b8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
      <div class="p-6">
        <div class="bg-primary inline-block px-3 py-1 rounded-full text-xs font-semibold text-dark mb-3">Nouveau</div>
        <h3 class="text-xl font-bold text-dark mb-2">Secrétariat</h3>
        <p class="text-gray-600 mb-4">Formations en secrétariat bureautique, accueil et gestion administrative.</p>
        <a href="#" class="text-secondary font-semibold hover:underline">Voir les formations →</a>
      </div>
    </div>

    <!-- Domaine 2 - Comptabilité -->
    <div class="w-80 flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
      <div class="h-48 bg-[url('https://images.unsplash.com/photo-1553729459-efe14ef6055d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-dark mb-2">Comptabilité</h3>
        <p class="text-gray-600 mb-4">Comptabilité, analyse financière, audit et fiscalité.</p>
        <a href="#" class="text-secondary font-semibold hover:underline">Voir les formations →</a>
      </div>
    </div>

    <!-- Domaine 3 - Informatique -->
    <div class="w-80 flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
      <div class="h-48 bg-[url('https://images.unsplash.com/photo-1517430816045-df4b7de11d1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-dark mb-2">Informatique</h3>
        <p class="text-gray-600 mb-4">Formations en développement, réseaux, cybersécurité et data science.</p>
        <a href="#" class="text-secondary font-semibold hover:underline">Voir les formations →</a>
      </div>
    </div>

    <!-- Domaine 4 - Marketing -->
    <div class="w-80 flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
      <div class="h-48 bg-[url('https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
      <div class="p-6">
        <div class="bg-primary inline-block px-3 py-1 rounded-full text-xs font-semibold text-dark mb-3">Populaire</div>
        <h3 class="text-xl font-bold text-dark mb-2">Marketing</h3>
        <p class="text-gray-600 mb-4">Marketing digital, branding, SEO et réseaux sociaux.</p>
        <a href="#" class="text-secondary font-semibold hover:underline">Voir les formations →</a>
      </div>
    </div>

    <!-- Domaine 5 - Droit -->
    <div class="w-80 flex-shrink-0 bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-lg">
      <div class="h-48 bg-[url('https://images.unsplash.com/photo-1589829545856-d10d557cf95f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
      <div class="p-6">
        <h3 class="text-xl font-bold text-dark mb-2">Droit</h3>
        <p class="text-gray-600 mb-4">Formations en droit des affaires, droit social et procédures juridiques.</p>
        <a href="#" class="text-secondary font-semibold hover:underline">Voir les formations →</a>
      </div>
    </div>

  </div>
</div>

    <div class="text-center mt-12">
      <a href="#" class="inline-block bg-primary text-dark font-bold px-8 py-3 rounded-full hover:bg-yellow-500 transition">Voir toutes nos formations</a>
    </div>
  </div>

  <script>
    const carousel = document.getElementById('carousel');
    const container = document.getElementById('carousel-container');

    function initScrollIfNeeded() {
      const cards = carousel.children;
      const cardCount = cards.length;

      if (cardCount <= 4) return;

      const cardWidth = cards[0].offsetWidth;
      const gap = 24;
      const visibleWidth = container.offsetWidth;
      const totalWidth = cardCount * cardWidth + (cardCount - 1) * gap;

      if (totalWidth > visibleWidth) {
        let scrollAmount = 0;
        setInterval(() => {
          scrollAmount += 1;
          if (scrollAmount >= totalWidth - visibleWidth) {
            scrollAmount = 0;
          }
          container.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
          });
        }, 70);
      }
    }

    window.addEventListener('load', initScrollIfNeeded);
    window.addEventListener('resize', initScrollIfNeeded);
  </script>
</section>




    <!-- Section Témoignages -->
    <section class="py-16 bg-secondary text-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Ils parlent de <span class="text-primary">nous</span></h2>
                <p class="max-w-2xl mx-auto">Découvrez ce que nos étudiants et partenaires disent de leur expérience la vitrine de l'étudiant</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Témoignage 1 -->
                <div class="bg-white bg-opacity-10 rounded-lg p-6 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Sarah K." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Sarah K.</h4>
                            <p class="text-primary text-sm">Développeuse Web</p>
                        </div>
                    </div>
                    <p class="italic mb-4">"La formation en développement web m'a permis d'acquérir des compétences concrètes et de décrocher mon premier emploi dans une startup innovante."</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Témoignage 2 -->
                <div class="bg-white bg-opacity-10 rounded-lg p-6 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Thomas D." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Thomas D.</h4>
                            <p class="text-primary text-sm">Responsable Marketing</p>
                        </div>
                    </div>
                    <p class="italic mb-4">"L'accompagnement personnalisé m'a aidé à préciser mon projet professionnel et à développer mon réseau. Aujourd'hui, je dirige une équipe marketing."</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                
                <!-- Témoignage 3 -->
                <div class="bg-white bg-opacity-10 rounded-lg p-6 backdrop-blur-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Amélie P." class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-bold">Amélie P.</h4>
                            <p class="text-primary text-sm">Analyste Financière</p>
                        </div>
                    </div>
                    <p class="italic mb-4">"Le stage en entreprise que la vitrine de l'étudiant m'a permis d'obtenir a été déterminant pour mon recrutement. Les formateurs sont des professionnels passionnés."</p>
                    <div class="flex text-yellow-300">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Actualités -->
    <section id="actualites" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 text-dark">Nos <span class="text-primary">Actualités</span></h2>
                <p class="max-w-2xl mx-auto text-gray-600">Restez informés des dernières nouvelles et événements de la vitrine de l'étudiant</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Actualité 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl border border-gray-100">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>15 Juin 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Nouveau partenariat avec TechInnov</h3>
                        <p class="text-gray-600 mb-4">FormaPlus signe un accord avec TechInnov pour offrir des stages spécialisés en intelligence artificielle à nos étudiants.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">Lire la suite →</a>
                    </div>
                </div>
                
                <!-- Actualité 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl border border-gray-100">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>2 Juin 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Forum Emploi 2023</h3>
                        <p class="text-gray-600 mb-4">Notre forum annuel réunira plus de 50 entreprises à la recherche de jeunes talents formés par FormaPlus.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">Lire la suite →</a>
                    </div>
                </div>
                
                <!-- Actualité 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition duration-300 hover:shadow-xl border border-gray-100">
                    <div class="h-48 bg-[url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')] bg-cover bg-center"></div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span>20 Mai 2023</span>
                        </div>
                        <h3 class="text-xl font-bold text-dark mb-3">Lancement de la formation Cybersécurité</h3>
                        <p class="text-gray-600 mb-4">Une nouvelle formation intensive de 3 mois pour répondre aux besoins croissants en experts en sécurité informatique.</p>
                        <a href="#" class="text-secondary font-semibold hover:underline">Lire la suite →</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-block bg-dark text-white font-bold px-8 py-3 rounded-full hover:bg-gray-800 transition">Voir toutes les actualités</a>
            </div>
        </div>
    </section>

    <!-- Section Contact -->
    <section id="contact" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4 text-dark">Contactez-<span class="text-primary">nous</span></h2>
                <p class="max-w-2xl mx-auto text-gray-600">Nous sommes à votre disposition pour répondre à toutes vos questions</p>
            </div>
            
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-1/2 bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-dark mb-6">Informations de contact</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark mb-1">Adresse</h4>
                                <p class="text-gray-600">Juste à côté de l'entrée campus adewi<br>Lomé, TOGO</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-phone-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark mb-1">Téléphone</h4>
                                <p class="text-gray-600">+228 90 00 11 22<br>+228 98 00 11 22</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark mb-1">Email</h4>
                                <p class="text-gray-600">contact@vitrinetudiant.com<br>info@formaplus.com</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-primary p-3 rounded-full mr-4">
                                <i class="fas fa-clock text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-dark mb-1">Horaires d'ouverture</h4>
                                <p class="text-gray-600">Lundi - Vendredi: 8h - 18h<br>Samedi: 9h - 13h</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <h4 class="font-bold text-dark mb-4">Suivez-nous</h4>
                        <div class="flex space-x-4">
                            <a href="#" class="bg-dark text-white p-3 rounded-full hover:bg-gray-800 transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="bg-dark text-white p-3 rounded-full hover:bg-gray-800 transition">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="bg-dark text-white p-3 rounded-full hover:bg-gray-800 transition">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="bg-dark text-white p-3 rounded-full hover:bg-gray-800 transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="lg:w-1/2 bg-white p-8 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-dark mb-6">Envoyez-nous un message</h3>
                    
                    <form id="contact-form" class="space-y-4">
                        <div>
                            <label for="name" class="block text-gray-700 mb-2">Nom complet</label>
                            <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-gray-700 mb-2">Sujet</label>
                            <select id="subject" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary">
                                <option value="">Sélectionnez un sujet</option>
                                <option value="formation">Demande d'information sur les formations</option>
                                <option value="stage">Demande de stage</option>
                                <option value="emploi">Demande d'emploi</option>
                                <option value="autre">Autre demande</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full bg-primary text-dark font-bold py-3 rounded-md hover:bg-yellow-500 transition">
                            Envoyer le message
                        </button>
                    </form>
                </div>
            </div>
            
           <div class="mt-12 bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-bold text-dark mb-4">Localisation</h3>
    <div id="map" class="h-64 rounded-md z-0"></div>
    <div class="mt-4 flex items-center text-gray-600">
        <i class="fas fa-map-marker-alt text-secondary mr-2"></i>
        <p>Rue des Banques, Lomé, Togo</p>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Coordonnées du centre-ville de Lomé
        const map = L.map('map').setView([6.130419, 1.215829], 15);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        
        // Marqueur positionné sur Lomé
        L.marker([6.130419, 1.215829])
            .addTo(map)
            .bindPopup("Notre centre à Lomé");
    });
</script>
        </div>
    </section>

    <!-- Pied de page -->
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
        // Configuration
        const CONFIG = {
            closeDelay: 500,    // Délai avant fermeture
            gapWidth: 30       // Largeur de la zone de sécurité
        };

        // Gestion des sous-menus
        document.querySelectorAll('.submenu-container').forEach(container => {
            const submenu = container.querySelector('.submenu');
            let closeTimer;
            
            // Ouverture
            container.addEventListener('mouseenter', () => {
                clearTimeout(closeTimer);
                submenu.classList.remove('hidden');
                
                // Vérifier la position
                const rect = submenu.getBoundingClientRect();
                if (rect.right > window.innerWidth) {
                    submenu.classList.add('right-full', 'mr-1');
                    submenu.classList.remove('left-full', 'ml-1');
                } else {
                    submenu.classList.add('left-full', 'ml-1');
                    submenu.classList.remove('right-full', 'mr-1');
                }
            });
            
            // Fermeture avec délai
            container.addEventListener('mouseleave', () => {
                closeTimer = setTimeout(() => {
                    if (!submenu.matches(':hover')) {
                        submenu.classList.add('hidden');
                    }
                }, CONFIG.closeDelay);
            });
            
            // Gestion du sous-menu
            submenu.addEventListener('mouseenter', () => clearTimeout(closeTimer));
            submenu.addEventListener('mouseleave', () => {
                closeTimer = setTimeout(() => {
                    submenu.classList.add('hidden');
                }, CONFIG.closeDelay);
            });
        });

        // Gestion des menus principaux
        ['services-menu', 'formations-menu'].forEach(id => {
            const menu = document.getElementById(id);
            const dropdown = menu.querySelector('div');
            let closeTimer;
            
            menu.addEventListener('mouseleave', () => {
                closeTimer = setTimeout(() => {
                    if (!dropdown.matches(':hover')) {
                        dropdown.classList.add('hidden');
                    }
                }, CONFIG.closeDelay);
            });
            
            dropdown.addEventListener('mouseenter', () => clearTimeout(closeTimer));
        });

        // Menu mobile
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });

        function toggleMobileSubmenu(id) {
            const submenu = document.getElementById(id);
            submenu.classList.toggle('hidden');
        }

        // Compteurs animés
        function animateCounters() {
            const studentsCount = document.getElementById('students-count');
            const partnersCount = document.getElementById('partners-count');
            const employmentCount = document.getElementById('employment-count');
            const trainingsCount = document.getElementById('trainings-count');
            
            animateCounter(studentsCount, 0, 2500, 2000);
            animateCounter(partnersCount, 0, 200, 2000);
            animateCounter(employmentCount, 0, 85, 2000);
            animateCounter(trainingsCount, 0, 50, 2000);
        }
        
        function animateCounter(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                element.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    if (element.id === 'employment-count') {
                        element.innerHTML += '%';
                    } else if (element.id === 'trainings-count') {
                        element.innerHTML += '+';
                    }
                }
            };
            window.requestAnimationFrame(step);
        }
        
        // Diaporama
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        
        function goToSlide(n) {
            slides[currentSlide].style.opacity = 0;
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].style.opacity = 1;
        }
        
        function nextSlide() {
            goToSlide(currentSlide + 1);
        }
        
        // Auto-advance slides
        setInterval(nextSlide, 4000);
        
        // Form contact
        const contactForm = document.getElementById('contact-form');
        
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;
            
            const whatsappMessage = `Bonjour FormaPlus,%0A%0AJe m'appelle ${name}.%0A%0AMon email: ${email}%0AMon téléphone: ${phone}%0A%0ASujet: ${subject}%0A%0AMessage: ${message}%0A%0ACordialement`;
            
            window.open(`https://wa.me/33123456789?text=${whatsappMessage}`, '_blank');
            
            // Reset form
            contactForm.reset();
            
            // Show success message
            alert('Votre message a été préparé pour WhatsApp. Merci de finaliser l\'envoi depuis l\'application.');
        });
        
        // Animation au scroll
        function checkScroll() {
            const statsSection = document.querySelector('.bg-secondary');
            const sectionPosition = statsSection.getBoundingClientRect().top;
            const screenPosition = window.innerHeight / 1.3;
            
            if (sectionPosition < screenPosition) {
                animateCounters();
                window.removeEventListener('scroll', checkScroll);
            }
        }
        
        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            // Set first slide as active
            slides[0].style.opacity = 1;
            
            // Check if stats are visible on load
            checkScroll();
            
            // Add scroll event listener
            window.addEventListener('scroll', checkScroll);
        });
    </script>
</body>
</html>
