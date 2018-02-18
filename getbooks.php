<?php
include("konekcija.inc");
$q=$_GET["q"];
$book_sql="SELECT * FROM knjige k JOIN slike s WHERE k.slika=s.slika_id AND zanr='$q'";
$book_query=mysqli_query($konekcija, $book_sql);


while($rsBook=mysqli_fetch_assoc($book_query)){
    
    
                  
                
    echo("
    
        <div class='edName'>
        <a rel='group' href=".$rsBook['src']." class='fancybox'>
        <img src=".$rsBook['src']." alt=".$rsBook['alt']." width='150' height='200'/></a>
        <p> <i>Autor:</i> <b>".$rsBook['autor']."</b><br/>
         <i>Naslov:</i> <b>".$rsBook['naziv']."</b>
        <br/>
         <i>Žanr:</i> <b>".$rsBook['zanr']."</b> 
         <br/>
         <i>Godina:</i> <b>".$rsBook['godina']."</b>
         </p>
        </div>    
        ");
                 
} 
        
        
        
        ?>