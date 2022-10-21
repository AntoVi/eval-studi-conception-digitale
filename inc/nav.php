<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-0" aria-label="Eighth navbar example">
                <div class="container">
                    
            
                    <div class="collapse navbar-collapse" id="navbarsExample07">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <!-- lien page home -->
                            <li class="nav-item">
                                <!-- chemin absolu pour tout les liens de la nav : http://localhost/PHP/10-boutique/index.php -->
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/-index.php"><i class="bi bi-house-fill"></i></a>
                            </li>

                        
                            <?php if(connect()): // lien accordé à un utilisateur authentifié sur le site mais NON ADMIN ?>

                                <li class="nav-item">
                                    <p class="text-light nav-link"> Bienvenue </p>
                                </li>

                                <?php else: // lien accordé à l'utilisateur lambda NON AUTHENTIFIE ?>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?= URL ?>/inscription.php">Créer votre compte</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?= URL ?>/connexion.php">Identifiez-vous</a>
                                </li>

                            <?php endif; ?>
                            

                            <!-- liens commun accordé à n'importe quel utilisateur -->
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/agents/listeAgent.php">Liste Agents</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/contacts/listeContact.php">Liste Contacts</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/planques/listePlanque.php">Liste planques</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/cibles/listeCible.php">Liste cibles</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="<?= URL ?>/missions/listeMission.php">Liste missions</a>
                            </li>

                           
                        
                        </ul>

                        <?php if(connect()): ?>
                            
                            <a href="<?= URL ?>/-index.php?action=deconnexion" class="btn btn-success text-white"><i class="bi bi-box-arrow-right text-white"></i> Déconnexion</a>
                            </span>
                        <?php endif; ?>

                    </div>
                </div>
            </nav>

           
        </header>

        <main class="container zone-main">