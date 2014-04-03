<?php 

 //Creates XML string and XML document using the DOM 
if(!(file_exists("score.xml")))
{ 
 $dom = new DomDocument('1.0'); 

 //add root - <books> 
 $classements= $dom->appendChild($dom->createElement('classements')); 

 //add <book> element to <books> 
 $classement = $classements->appendChild($dom->createElement('classement')); 
 $classement->setAttribute("Nom","Cyril");
   $classement->setAttribute("Difficulty","Normal");
 $classement->appendChild($dom->createTextNode('18'));
 
 $classement = $classements->appendChild($dom->createElement('classement')); 

  $classement->appendChild($dom->createTextNode('15')); 
 $classement->setAttribute("Nom","Tristan");
   $classement->setAttribute("Difficulty","Normal");
   
 $classement = $classements->appendChild($dom->createElement('classement')); 

 $classement->appendChild($dom->createTextNode('12'));  
 $classement->setAttribute("Nom","Aziz");
   $classement->setAttribute("Difficulty","Normal");

 //generate xml 
 $dom->formatOutput = true; // set the formatOutput attribute of 
                            // domDocument to true 
 // save XML as string or file 
 $test1 = $dom->saveXML(); // put string in test1 
 $dom->save('score.xml'); // save as file 
}

  $dom = new DomDocument;
  $dom->load("score.xml");
  

  function modif($dom2,$nom,$score,$diff)
  {
			$nouveauScore = $dom2->createElement("classement");
			$leScore = $dom2->createTextNode($score);
			$nouveauScore->setAttribute("Nom", $nom);
			$nouveauScore->setAttribute("Difficulty",$diff);
			
			$nouveauScore->appendChild($leScore);
			$class = $dom2->getElementsByTagName("classements")->item(0);
			$class->appendChild($nouveauScore);
		
		$dom2->formatOutput = true; // set the formatOutput attribute of 

		$test1 = $dom2->saveXML(); // put string in test1 
		$dom2->save('score.xml'); // save as file 
  
  }
  function trier($tableau) 
{ 
$inversion = true; // Pour qu'il rentre dans la boucle au début 
$taille = count($tableau); 
for($i = 0; $inversion == true; $i++) 
{ 
$inversion = false; 
for($j = 0; $j < $taille - 1 - $i; $j++) 
{ 
if($tableau[$j] > $tableau[$j + 1]) 
{ 
// On indique qu'il y a eu une inversion et donc qu'il faudra repasser dans la boucle. 
$inversion = true; 
// On inverse les cases $j et $j + 1 
$tmp = $tableau[$j]; 
$tableau[$j] = $tableau[$j + 1]; 
$tableau[$j + 1] = $tmp; 
} 
} 
} 
	return $tableau;
} 
  function creaTab($dom3,$difficulte)
  {
		?>	
		<table id="classement" border="1" CELLPADDING="4" CELLSPACING="2" width=20% height=60 style="border-color:#ddd;color:#444">

		<thead>	
			<tr><!-- ligne des titres de colonnes-->
				<th bgcolor='#b9c9fe'>Nom</th>
				<th bgcolor='#b9c9fe'>Score</th>
				<th bgcolor='#b9c9fe'>Rang</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$liste = $dom3->getElementsByTagName("classement");
		$indice=0;
		$scoreRef=0;
		$tab;$tab2;$tab3;
		foreach($liste as $class)
		{

			if ($class->getAttribute("Difficulty")==$difficulte)
			{
				$score=$class->nodeValue;
				
				$tab[$indice]="<tr><th bgcolor='#d3ddff'>".$class->getAttribute('Nom')."</th><th bgcolor='#d3ddff'>".$score."</th><th bgcolor='#d3ddff'>2</th></tr>";
				//echo $tab[$indice];
				$tab2[$indice]=$score;
				$tab3[$indice]=strlen($class->getAttribute('Nom'));
				$indice++;
				//echo $indice."<br>";
			}
			
		}
		sort($tab2);
		for($i=count($tab2)-1;$i>=0;$i--)
		{
			//echo $tab2[$i];

			
			for($i2=count($tab2)-1;$i2>=0;$i2--)
			{	
				$temp=$tab[$i];
				$n=54+$tab3[$i];
				$temp2=$temp[$n-1].$temp[$n].$temp[$n+1];
				$nombre=str_replace("<","",$temp2);
				$nombre=str_replace("/","",$nombre);
				echo $nombre;
				if($nombre==$tab2[$i])
				{
					//echo $tab[$i];
				}
			}
		}
  }
    creaTab($dom,"Normal");

  
 ?>
<button>Clique</button>