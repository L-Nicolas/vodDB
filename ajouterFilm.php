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
        
		<div id='filmAjouter'>
	        <h1>Votre film à été ajouter</h1>
	        
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
                
                $bdd->setAttribute( PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION ) ;

                // Si tout va bien, on peut continuer
                // On essaye d'ajouter le nouveau film sinon un message d'erreur s'affiche
                try{
					$titre = ucwords($_POST['titre']);
					$annee = date('Y' , strtotime($_POST['date']));
					$realisateur = ucwords($_POST['réalisateur']);
				
                
					$ajout = $bdd->prepare('INSERT INTO Film(titre,annee,realisateur) VALUES (:titre,:annee,:realisateur)');
					$ajout->execute(array('titre' => $titre,
											'annee' => $annee,
											'realisateur' => $realisateur
											));
					
					// Affichage du film
					echo "<table>
                                <tr>
                                    <th><b>Titre</b></th>
                                    <th><b>Année</b></th>
                                    <th><b>Réalisateur</b></th>
                                </tr>
                                
								</tr> 
                        
									<td>" . ucwords($_POST['titre']) . "</td>
									<td>" . date('Y' , strtotime($_POST['date'])) . "</td>
									<td>" .	ucwords($_POST['réalisateur']) . "</td>
								</tr>";
				
					$ajout->closeCursor(); //Termine le traitement de la requête d'ajout
					$numFilm_Max->closeCursor();// Termine le traitement de la requête du nouveau numéro
				}
                catch(PDOException $e){
					die('Erreur : '.$e->getMessage());
				}
			
                unset( $bdd ) ;
            ?>

		</div>

	</body>

</html>	
