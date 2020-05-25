<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style/vod.css" />
        <script src="https://kit.fontawesome.com/54bba90930.js" crossorigin="anonymous"></script>
        <title>VOD FR</title>
    </head>

    <body>
    	<div id="acceuil"> 
            <a href="vod.html" id="logo"><i class="fas fa-video fa-1x"></i>  VOD FR</a>
        </div>

        <div id="filmSupprimer">
	        <h1>Votre film</h1>

			<?php
                try
                {
                	// On se connecte à MySQL

                	$bdd = new PDO('mysql:host=localhost;dbname=vod;charset=utf8', 'adminvod', 'azerty');
                }

                catch(Exception $e)
                {
                	// En cas d'erreur, on affiche un message et on arrête tout
                    
                    die('Erreur : '.$e->getMessage());
                }

                // Si tout va bien, on peut continuer
                // On recherche si le film demander est disponible
                $recherche = $bdd->prepare('SELECT * FROM Film WHERE titre = :titre');
				$recherche->execute(array(':titre' => $_POST['titre']));
				
				$estDispo = $recherche->rowCount();
					
				// Si le film est dans la base de donnée on peut ensuite le supprimer et afficher le film supprimer
				if($estDispo == 1){
				
					echo "<table>
                                <tr>
                                    <th><b>Titre</b></th>
                                    <th><b>Année</b></th>
                                    <th><b>Réalisateur</b></th>
                                </tr>";
					// On affiche chaque entrée une à une
	
					while ($donnees = $recherche->fetch())

					{
                        echo 
                        '</tr> 
                        
							<td>' . $donnees['titre'] . '</td>
							<td>' . $donnees['annee'] . '</td>
							<td>' . $donnees['realisateur'] . '</td>
						</tr>';

					}
					$recherche = $bdd->prepare('DELETE FROM Film WHERE titre = :titre');
					$recherche->execute(array(':titre' => ucwords($_POST['titre'])));                
					$recherche->closeCursor(); // Termine le traitement de la requête
				}
				else{
					echo "<h2>n'existe pas :(</h2>";
				}
			
                $estDispo->closeCursor(); // Termine le traitement de la requête
                unset( $bdd ) ;
                ?>
		</div>
	</body>
</html>	
