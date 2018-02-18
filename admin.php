<?php 
session_start();
include("konekcija.inc"); 
	
if($_SESSION['role'] !== 'admin')
	{
	
		header('location: index.php');
	}

if(isset($_REQUEST['login'])){
	
		$username = trim($_REQUEST['Username']);
		$password = trim(md5($_REQUEST['Password']));
		
		if(empty($username) or empty($password))
			{
			$err[]="Unesite korisničko ime i šifru!";
			}
			
			else{
		
		
		$qw = "SELECT * FROM korisnici k
				 JOIN uloge u
				 ON k.uloga_id=u.uloga_id
				 WHERE kor_ime='$username'
				 AND sifra = '$password'";
		
		
		$rez = mysqli_query($konekcija, $qw);
		
		if(mysqli_num_rows($rez) == 0)
		{
			$err[] = "Pogrešni podaci za logovanje!";
		}
		else
		{
			$r = mysqli_fetch_array($rez);
			
			$_SESSION['idR'] = $r['uloga_id'];
			
			$_SESSION['role'] = $r['naziv'];
			
			$_SESSION['idU'] = $r['kor_ime'];
			
			
			
		}	        
               
 }
    }
	
		 ?>


<!DOCTYPE html>
<html lang="en">
<head>

  <title>KlubČitalaca</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Book Club, Reading, Books Belgrade, Coffee Belgrade, Klub Citalaca, Knjige, Citalacki Klub, Biblioteka, Knjizevni klub Beograd">
  <link rel="shortcut icon" type="image/x-icon" href="img/icon.png" />
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="js/script.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
  
  
  
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="css/form.css"/>
  <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all" />
  <!-- Add fancyBox -->
	
	<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.pack.js"></script>
    
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
    

</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#myPage">AdminPanel</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
         <ul class="nav navbar-nav navbar-right">
         <li><a href='#unos'>UNOS</a></li>
             <li><a href='#kontakt'>BRISANJE</a></li>
             <li><a href='#galerija'>SLIKE</a></li>
             <li><a href='logout.php'>ODJAVA</a></li>
        </ul>
    </div>
  </div>
</nav>
<div class="main text-center">
<div class="w3layoutscontaineragileits">
    		<?php
 if(!isset($_SESSION['idR']))
				{
					?>
	<h2>PRIJAVA</h2>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<input type="text" Name="Username" placeholder="KORISNIČKO IME" required="">
			<input type="password" Name="Password" placeholder="ŠIFRA" required="">
			
			<div class="aitssendbuttonw3ls">
				<input type="submit" value="PRIJAVA" name="login">
				<p> Registrujte se <span>→</span> <a class="w3_play_icon1" href="#small-dialog1"> Kliknite ovde</a></p>
				<div class="clear"></div>
			</div>
		</form>
	
	<?php }
    
    else{
        
        echo ("<h3> Dobrodošli, ".$_SESSION['idU']."</h3>");
    }
    
    ?>
    
    
    </div>
	
<div id="myCarousel" class="carousel slide" data-ride="carousel">
     
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="img/carousel/1.jpg" alt="slika1" >
           
      </div>

      <div class="item">
        <img src="img/carousel/2.jpg" alt="slika2" >
          
      </div>
    
      <div class="item">
        <img src="img/carousel/3.jpg" alt="slika3" >
          
      </div>
	  
	  <div class="item">
        <img src="img/carousel/4.jpg" alt="slika4" >
          
      </div>
    </div>
    
    </div>
	

	
</div>

<div id="klub" class="container text-center">
 

</div>
<div id="autor" class="bg-1">

   
  </div>
  
  <div id="unos" class="container text-center">

	<div id="small-dialog1" >
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<h4>UNESI KNJIGU</h4>
				<form action="admin.php#unos" method="post">
						<div class="form-sub-w3ls">
							<input placeholder="NAZIV"  type="text" required="" name="kNaziv">
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="AUTOR" class="mail" type="text" required="" name="kAutor">
							<div class="icon-agile">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="ZANR"  type="text" required="" name="kZanr">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="GODINA"  type="text" required="" name="kGodina">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
                            <span class='error'></span>
						</div>
                    <div class="form-sub-w3ls">
							<input  type="text" required="" name="kSlika" placeholder="SLIKA ID">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
                            <span class='error'></span>
						</div>
					
					
                    <span class='error'></span>
					<div class="submit-w3l">
						<input type="submit" value="Unesi" name="unos">
					</div>
				</form>
                
               
                								 <?php



    if(isset($_REQUEST['unos'])){
        
   
    $naziv=$_REQUEST['kNaziv'];
    $autor=$_REQUEST['kAutor'];
    $zanr=$_REQUEST['kZanr'];
    $godina = $_REQUEST['kGodina'];
    $god = (int)$godina;
    $slika = $_REQUEST['kSlika'];
    $pic = (int)$slika;
        
$insert_query = "INSERT INTO knjige VALUES('','$naziv', '$autor', '$zanr', $god, $pic)";


        
		$result_query = mysqli_query($konekcija, $insert_query);
		
        
		if(!$result_query)
		{
			echo "Neuspešna registracija".mysqli_error($konekcija);
		}
        
        else{
            
            echo "Uspešan unos.";
        }
		
        
        
		
  
        
      
   
    }
    
    

    
?>
                
               
			</div>
		</div>	
	</div>
</div>
      <div id="knjige" class="container text-center">
  <h3>KNJIGE</h3>
  <p><em>Izaberi žanr: </em></p>
       <select name="ddlZanr"  onchange="showBook(this.value)">
      <option>Izaberi...</option>
    <?php    
        $select_query="SELECT DISTINCT zanr FROM knjige";
        $select_res=mysqli_query($konekcija, $select_query);
        
while($select_rec=mysqli_fetch_array($select_res)){
    
    echo("<option value=".$select_rec['zanr'].">".$select_rec['zanr']."</option>");
}
    ?>
     
      
      </select><br/><br/>
      
   <div class="booksList">   
                

 </div> <br/>

</div>
<div id="galerija" class="bg-1"><div id="small-dialog1" >
		<div class="contact-form1">
			<div class="contact-w3-agileits">
 <form method="post" action="admin.php#galerija" enctype="multipart/form-data">
    <input type="file" name = "fSlika"/>
     <input type="submit" name = "btnSlika" value="Unesi"/>
    </form>
    <?php
    if(isset($_REQUEST['btnSlika'])){
        $imeFajla = $_FILES['fSlika']['name'];
		
		$privremenoImeFajla = $_FILES['fSlika']['tmp_name'];
		
		$putanjaSlike = "img/books/".$imeFajla;
    
        
		
		if(move_uploaded_file($privremenoImeFajla, $putanjaSlike))
		{
			$upit_upis = "INSERT INTO slike VALUES('', '$putanjaSlike', '$imeFajla')";
			
			$rez_upis = mysqli_query($konekcija, $upit_upis);
			
			if(!$rez_upis)
			{
				echo "Upis nije izvrsen! - ".mysqli_error($konekcija);
			}
			else
			{
				echo "Podaci su upisani!";
			}
		}
    }
    
    $slike_sql = "SELECT * FROM slike";
    $slike_query=mysqli_query($konekcija, $slike_sql);
    echo "<table border='1'>";
    echo "<tr><td>ID</td><td>SRC</td><td>ALT</td></tr>";
    while($rez=mysqli_fetch_assoc($slike_query)){
        
        
        echo "<tr><td>".$rez['slika_id']."</td><td>".$rez['src']."</td><td>".$rez['alt']."</td></tr>";
       
        
    }
    echo "</table>"
                ?>
   
  </div>
  	</div>	
	</div>
</div>



<div id="kontakt" class="container">
<?php
    $korisnik_sql = "SELECT * FROM korisnici";
    $korisnik_query=mysqli_query($konekcija, $korisnik_sql);
    echo "<table border='1'>";
    echo "<tr><td>ID</td><td>KorisničkoIme</td><td>Email</td></tr>";
    while($rez=mysqli_fetch_assoc($korisnik_query)){
        
        
        echo "<tr><td>".$rez['korisnik_id']."</td><td>".$rez['kor_ime']."</td><td>".$rez['email']."</td></tr>";
       
        
    }
    echo "</table>"
?>
  <form action="admin.php#kontakt">
      <label>Unesite ID korisnika koga želite da obrišete</label>
    <input type="text" name="korId" maxlength="5"/>
    <input type="submit" name="brisi" value="Obrisi" />
    </form><br/>
    <?php
    
        if(isset($_REQUEST['brisi'])){
            
            $input = $_REQUEST['korId'];
            $id = (int)$input;
            
            $brisanje = "DELETE FROM korisnici WHERE korisnik_id='$id'";
            $obrisano = mysqli_query($konekcija,$brisanje);
            
            if(!$obrisano)
			{
				echo "Brisanje nije izvrseno! - ".mysqli_error();
			}
			else
			{
				echo "Korisnik je obrisan!";
			}
          
        }
    
    
    $korisnik_sql = "SELECT * FROM anketa";
    $korisnik_query=mysqli_query($konekcija, $korisnik_sql);
    echo "<table border='1'>";
    echo "<tr><td>ID</td><td>Odgovor</td><td>Glasovi</td></tr>";
    while($rez=mysqli_fetch_assoc($korisnik_query)){
        
        
        echo "<tr><td>".$rez['id']."</td><td>".$rez['odgovor']."</td><td>".$rez['glasovi']."</td></tr>";
       
        
    }
    echo "</table>"
?>
  <form action="admin.php#kontakt">
      <label>Unesite novu opciju za anketu</label>
    <input type="text" name="novaOpcija" />
    <label>Unesite ID opcije koju želite da obrišete</label>
    <input type="text" name="aId" maxlength="5"/>
    <input type="submit" name="dodaj" value="Dodaj" />
    <input type="submit" name="aObrisi" value="Obrisi" />
    </form>
    <?php
    
        if(isset($_REQUEST['dodaj'])){
            
            
            $opcija = $_REQUEST['novaOpcija'];
            $upit = "INSERT INTO anketa VALUES ('', '$opcija', '0')";
            $dodato = mysqli_query($konekcija,$upit);
            
            if(!$dodato)
			{
				echo "Dodavanje nije izvrseno! - ".mysqli_error();
			}
			else
			{
				echo "Opcija je uneta!";
			}
          
        }
        if(isset($_REQUEST['aObrisi'])){
            
            $input = $_REQUEST['aId'];
            $id = (int)$input;
            
            $brisanje = "DELETE FROM anketa WHERE id='$id'";
            $obrisano = mysqli_query($konekcija,$brisanje);
            
            if(!$obrisano)
			{
				echo "Brisanje nije izvrseno! - ".mysqli_error();
			}
			else
			{
				echo "Opcija je obrisana!";
			}
          
        }
    ?>
    
    
 </div>


<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="VRATI NA POČETAK">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
 <a href="documentation.pdf" data-toggle="tooltip" title="Documentation">DOKUMENTACIJA</a>
</footer>
    <script type="text/javascript" src="ajax.js">
       
    </script>
</body>
</html>
