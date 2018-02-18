 <?php
        $menu_query="SELECT * FROM menu WHERE parent=0";
        $menu_res=mysqli_query($konekcija, $menu_query);
        
while($menu_rec=mysqli_fetch_array($menu_res)){
    
    echo("<li class='dropdown'><a href=".$menu_rec['link']." class='dropdown-toggle'>".$menu_rec['menu_name']."</a>");
    submenu($menu_rec['menu_id']);
    echo ( "</li>");
      		

					
}
 if(isset($_SESSION['idR']))
 {
     echo("<li class='dropdown'><a href='logout.php'>IZLOGUJ SE</a>");
    
    echo ( "</li>");
 }
             
           function submenu($parent){

			$server = "localhost";
			$name = "root";
			$pass = "";
			$dbname = "book_club";
	
		    $baza = mysqli_connect($server, $name, $pass, $dbname);
						  
           
           $query_menu = "SELECT * FROM menu WHERE parent=$parent";
           $res_menu = mysqli_query($baza, $query_menu);
           $submenu_y = mysqli_num_rows($res_menu);
     
        if($submenu_y){
         
         echo ("<ul class='dropdown-content dropdown-menu'>");
         
       while($menuRs=mysqli_fetch_assoc($res_menu)) {
           
           
           echo ("<li ><a href=".$menuRs['link'].">".$menuRs['menu_name']."</a>");
                 
                 
            submenu($menuRs['menu_id']);

              
        echo("</li>");}
               echo("</ul>");           
         
                 }
                      }
        ?>