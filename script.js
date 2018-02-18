/*kontakt*/

function posalji(){
    
    var regIme = "(^[A-Z][a-z]*(-|\s)[A-Z][a-z]*$)";
    var regEmail = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/";
    
    var ime = document.querySelector("#name").value;
    var email = document.querySelector("#email").value;
    var komentar = document.querySelector("#comments");
    
    var greskeDiv = document.querySelector("#kontaktGreske");
    
    var podaci = new Array();
	var greske = new Array();
    
    if(komentar.value == ""){
        
       komentar.style.borderColor = "#ff7372";
       greske.push("Polje za komentar je prazno!");
    }
  
    
    if(!ime.match(regIme)){
        
        komentar.style.borderColor = "#ff7372";
        greske.push("Ime i prezime nisu u dobrom formatu!");
    }
    
    
     if(!email.match(regEmail)){
        
        komentar.style.borderColor = "#ff7372";
        greske.push("Email nije u dobrom formatu!");
    }
    
  
    
    if(greske.length>0){
              greskeLista="";
              for(var i=0; i<greske.length; i++){
                 greskeLista+=greske[i]+"<br/> ";
              }
         			  
		   greskeDiv.innerHTML+=greskeLista;
    
}
    
    
    if(greske.length == 0){
        
        var link = 'mailto:marija.lekic.132.13@ict.edu.rs?subject=Message from '
             + ime + " , " + email 
             +'&body='+komentar.value;
    window.location.href = link;
    }
}

/*fancyBox galerija*/


	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
	


/*scroll*/

$(document).ready(function(){

  $('[data-toggle="tooltip"]').tooltip(); 
  

  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

  
    if (this.hash !== "") {

 
      event.preventDefault();

     
      var hash = this.hash;

      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   

        window.location.hash = hash;
      });
    } 
  });
})




/*register pop-up*/

$(document).ready(function() {
		$('.w3_play_icon,.w3_play_icon1,.w3_play_icon2').magnificPopup({
			type: 'inline',
			fixedContentPos: false,
			fixedBgPos: true,
			overflowY: 'auto',
			closeBtnInside: true,
			preloader: false,
			midClick: true,
			removalDelay: 300,
			mainClass: 'my-mfp-zoom-in'
		});
																		
		});
