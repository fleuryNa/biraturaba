<?php
echo "Dossier controllers : " . is_dir('app/Controllers') ? 'existe' : 'n\'existe pas';
echo "<br>";
echo "Fichier : " . (file_exists('app/Controllers/AccueilBackend.php') ? 'existe' : 'n\'existe pas');