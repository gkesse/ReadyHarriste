<!-- ============================================ -->
<div class="MainBlock">
	<div class="Content">
		<h1 class="Title2" id="Editeur_Base_Donnees">
			<a class="Link3" href="#">
				Editeur de Base de Données
			</a>
		</h1>
		<!-- ============================================ -->
        <div class="Body">
            <div class="Row10">
                <div class="Col">
                    <button class="Button2 DatabaseTab" title="Accueil" 
                    onclick="openDatabaseTab(this, 'DatabaseTab0');"><i class="fa fa-home"></i></button>
                </div>
                <div class="Col">
                    <button class="Button2 DatabaseTab" title="Sélectionner une base de données" 
                    onclick="openDatabaseTab(this, 'DatabaseTab1');">Base de Données</button>
                </div>
                <div class="Col">
                    <button class="Button2 DatabaseTab" title="Afficher une donnée" 
                    onclick="openDatabaseTab(this, 'DatabaseTab2');">Afficher</button>
                </div>
                <div class="Col">
                    <button class="Button2 DatabaseTab" title="Modifier une donnée" 
                    onclick="openDatabaseTab(this, 'DatabaseTab3');">Modifier</button>
                </div>
                <div class="Col">
                    <button class="Button2 DatabaseTab" title="Ajouter une donnée" 
                    onclick="openDatabaseTab(this, 'DatabaseTab4');">Ajouter</button>
                </div>
            </div>
            <!-- ============================================ -->
            <div class="Row Left DatabaseTabCtn" id="DatabaseTab0">
                <h2 class="Title4">
                    ReadyDB
                </h2>
                <div class="Body6">
                    <div class="Content9">
                        <b>ReadyDB</b> est un éditeur de bases de données.
                        Il vous permet de créer, lire, modifier ou supprimer une donnée
                        dans les bases de données du siteweb. C'est une interface développée en <b>PHP</b>
                        et maintenue par <b>Gérard KESSE</b>, concepteur du site <b>ReadyDev</b>,
                        la Plateforme de Développement Continu.
                    </div>
                </div>
            </div>
            <!-- ============================================ -->
            <div class="Row Left DatabaseTabCtn" id="DatabaseTab1">
                <h2 class="Title4">
                    Base de Données
                </h2>
                <div class="Body9 Left">
                    <div class="Row17"><i class="Icon8 fa fa-file-text-o"> :</i></div>
                    <div class="Row18"><div class="Field4" id="DatabaseFilePath"></div></div>
                </div>
                <div class="Body10 Left" id="DatabaseFileMenu"></div>
                <div class="Body11">
                    <div id="DatabaseFileMap"></div>
                </div>
            </div>
            <!-- ============================================ -->
            <div class="Row Left DatabaseTabCtn" id="DatabaseTab2">
                <h2 class="Title4">
                    Afficher une donnée
                </h2>
                <div class="Body14">
                    <div class="Content9">
                        <div class="Body19" id="DatabaseFileRead"></div>
                    </div>
                </div>
            </div>
            <!-- ============================================ -->
            <div class="Row Left DatabaseTabCtn" id="DatabaseTab3">
                <h2 class="Title4">
                    Modifier une donnée
                </h2>
                <div class="Body14">
                    <div class="Content9">
                        <div class="Body21" id="DatabaseFileUpdate"></div>
                    </div>
                </div>
            </div>
            <!-- ============================================ -->
            <div class="Row Left DatabaseTabCtn" id="DatabaseTab4">
                <h2 class="Title4">
                    Ajouter une donnée
                </h2>
                <div class="Body14">
                    <div class="Content9">
                        <div class="Body21" id="DatabaseFileCreate"></div>
                    </div>
                </div>
            </div>
		</div>
		<!-- ============================================ -->
	</div>
</div>
<!-- ============================================ -->
<script src="/js/class/GDatabase.js"></script>
<script src="/js/database.js"></script>
<!-- ============================================ -->


