<?php 
session_start();
include("konekcija.inc"); 



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
			echo ("Pogrešni podaci za logovanje!");
		}
		else
		{
			$r = mysqli_fetch_array($rez);
			
			$_SESSION['idR'] = $r['uloga_id'];
			
			$_SESSION['role'] = $r['naziv'];
			
			$_SESSION['idU'] = $r['kor_ime'];
			
              if($_SESSION['role'] == 'admin')
	{
		header('location: admin.php');
	}
			
			
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
      <a class="navbar-brand" href="#myPage">KlubČitalaca</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
         <ul class="nav navbar-nav navbar-right">
         <?php include("menu.php");?>
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
			<input type="text" Name="Username" placeholder="(admin / username)" required="">
			<input type="password" Name="Password" placeholder="(admin123 / user123)" required="">
			
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
    <div name="logErr"></div>
    
    </div>
	<!-- for register popup -->
	<div id="small-dialog1" class="mfp-hide">
		<div class="contact-form1">
			<div class="contact-w3-agileits">
				<h3>REGISTRACIJA</h3>
				<form action="index.php#small-dialog" method="post">
						<div class="form-sub-w3ls">
							<input placeholder="KORISNIČKO IME"  type="text" required="" name="username">
							<div class="icon-agile">
								<i class="fa fa-user" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="EMAIL" class="mail" type="email" required="" name="email">
							<div class="icon-agile">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="ŠIFRA"  type="password" required="" name="password">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
						</div>
						<div class="form-sub-w3ls">
							<input placeholder="PONOVI ŠIFRU"  type="password" required="" name="cPassw">
							<div class="icon-agile">
								<i class="fa fa-unlock-alt" aria-hidden="true"></i>
							</div>
                            <span class='error'></span>
						</div>
					<div class="login-check">
						
					</div>
                    <span class='error'></span>
					<div class="submit-w3l">
						<input type="submit" value="Registruj se" name="register">
					</div>
				</form>
                
               
                								 <?php



    if(isset($_REQUEST['register'])){
        
   
    $username=$_REQUEST['username'];
    $email=$_REQUEST['email'];
    $password=md5($_REQUEST['password']);
    $checkbox = $_REQUEST['checkbox'];
   
  
        
$insert_query = "INSERT INTO korisnici VALUES('','$username', '$password', '$email', '2')";


        
		$result_query = mysqli_query($konekcija, $insert_query);
		
        
		if(!$result_query)
		{
			echo "Neuspešna registracija".mysqli_error();
		}
		
        
        
		
  
        
      
   
    }
    
    

    
?>
                
               
			</div>
		</div>	
	</div>
	<!-- //for register popup -->
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
  <h3>KLUB ČITALACA</h3>
  <p><em>We love books!</em></p>
  <p>Dobrodošli u klub čitalaca. Svake nedelje čitamo knjigu po vašem izboru. </p>
  <br>

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
<div id="galerija" class="bg-1">
  <div class="container text-center">
    <h3 class="text-center">GALERIJA</h3>
      
   <?php
$pic_query="SELECT * FROM slike WHERE slika_id<9";

$pic_res=mysqli_query($konekcija, $pic_query);
        
while($pic_rec=mysqli_fetch_array($pic_res)){
    
    echo("<a class='fancybox' rel='group' href=".$pic_rec['src']."><img src=".$pic_rec['src']." alt=".$pic_rec['alt']." /></a>");
}
?>
    
    </div>
   
  </div>
  



<div id="kontakt" class="container">
    <h3 class="text-center">Kontakt</h3>
  <p class="text-center"><em>Pridružite nam se!</em></p>

  <div class="row">
    <div class="col-md-4">
      <p>Pišite nam!</p>
      <p><span class="glyphicon glyphicon-map-marker"></span>Beograd, RS</p>
      <p><span class="glyphicon glyphicon-phone"></span>Telefon: +381 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
    </div>
    <div class="col-md-8">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Ime i Prezime" type="text" class="kontakt" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" class="kontakt" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Komentar" rows="5" class="kontakt"></textarea>
      <br>
      <div class="row">
        <div class="col-md-12 form-group">
          <button class="btn pull-right" type="submit" onclick="posalji()" id="btnKontakt">Send</button>
        </div>
      </div>
    </div>
  </div>
    <div id="kontaktGreske"></div>
  <br/>



  <h3 class="text-center">Anketa</h3>  
 
      <div class="tab-content">
    		  <div id="poll" class="text">
                  <p class="text-center"><em>Sledeće nedelje obrađujemo knjigu:</em></p>
<div id="pollcontent">
<form action="index.php#poll" method="post"
name="anketa" class="forma">
                  <?php 
        $query="SELECT * FROM anketa ORDER BY glasovi DESC";
        $res=mysqli_query($konekcija, $query);
        
while($result=mysqli_fetch_array($res)){
    
    echo "<input type='radio' name='poll' value=".$result['id']." /> ";
    echo "<label>".$result['odgovor']."</label>";
    echo "<label>[".$result['glasovi']."]</label><br/>";
    
}
                  ?>


<br/><br/>
<input type="submit"
name="glasaj" id="btnPosalji" value="GLASAJ" class='btn' />
<input type="submit"
name="rezultat" id="btnRezultati" value="REZULTAT"
 class='btn'  style='background-color:#b42eb5;' />
</form>
    <?php
if (isset($_POST['glasaj'])) {
    
  $id= $_POST['poll'];
  $que = "UPDATE anketa SET glasovi = glasovi + 1 WHERE id='$id'";
  $update = mysqli_query($konekcija, $que);
    
    if(!$update){
        
        echo "Greska! Glas nije zabeležen.";
    }
    
    else{
        
        echo "Uspešno ste glasali";
    }
}
?>
</div>
<div id="pollres" style="margin-left:170px;"></div>
</div>
  </div>
 </div>
<div id="autor" class="bg-1">
  <div class="container text-center">
    <h3 class="text-center">AUTOR</h3>
    <p class="text-center">Marija Lekic<br> 132-13</p>
    <img src="img/moi.jpg" alt="autorka" width="150" class="img-circle"/>
    </div>
   
  </div>

<footer class="text-center">
  <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="VRATI NA POČETAK">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a><br><br>
 <a href="documentation.pdf" data-toggle="tooltip" title="Documentation" target="_blank">DOKUMENTACIJA</a>
</footer>
  
    <script type="text/javascript" src="ajax.js">
       
    </script>
</body>
</html>
