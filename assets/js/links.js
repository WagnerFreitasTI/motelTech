
//LINK Sujestoes e reclamacoes
function link_reclamacao(){

    if(is_tablet){
        Swal.fire({
            title: 'Tire foto do QR e entre diretamente para fazer sua sugestão e reclamação.',
        
            imageUrl: 'assets/qrcode/website.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://www.motelmedieval.com.br/";
       location.replace(url);
    }

  
}

//LINK PlayStory
function link_playstore(){

    if(is_tablet){
        Swal.fire({
            title: 'App no Play Story',
        
            imageUrl: 'https://unsplash.it/400/200',
            imageWidth: 400,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://play.google.com/store/apps/details?id=br.com.motelx.mc.paradiso";
       location.replace(url);
    }

  
}

//LINK PlayStory
function link_facebook(){

    if(is_tablet){
        Swal.fire({
            title: 'Siga o nosso perfil no Facebook',
        
            imageUrl: 'assets/qrcode/facebook.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://www.facebook.com/motelmedieval.poa";
       location.replace(url);
    }

  
}

//LINK Instagram
function link_instagram(){

    if(is_tablet){
        Swal.fire({
            title: 'Siga o nosso perfil no Instagram',
        
            imageUrl: 'assets/qrcode/instagram.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://www.instagram.com/motelmedieval.poa/";
       location.replace(url);
    }

  
}

//LINK WhatsAPP
function link_whatsapp(){

    if(is_tablet){
        Swal.fire({
            title: 'Tire foto do QR e entre diretamente no whats',
        
            imageUrl: 'assets/qrcode/whatsapp.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://wa.me/5554999927365?text=Ola...%20gostaria%20de%20tirar%20uma%20dúvida";
       location.replace(url);
    }

  
}

//LINK WebSite
function link_website(){

    if(is_tablet){
        Swal.fire({
            title: 'Conheça nosso WebSite',
        
            imageUrl: 'assets/qrcode/website.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://www.motelmedieval.com.br/";
       location.replace(url);
    }

  
}

//LINK LGPD
function link_apresentacao(){

    if(is_tablet){
        Swal.fire({
            title: 'Apresentação',      
            imageUrl: 'https://unsplash.it/400/200',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "#";
       location.replace(url);
    }

  
}

//LINK LGPD
function link_lgpd(){

    if(is_tablet){
        Swal.fire({
            title: 'Conheça a lei LGPD',      
            imageUrl: 'assets/qrcode/gov.png',
            imageWidth: 200,
            imageHeight: 200,
    
            showCancelButton: true,
            cancelButtonText: 'Fechar',
            showConfirmButton: false,
            customClass: {
                cancelButton: 'meu-botao-cancelar'
              }
          })
       
    }else{
       var url = "https://www.gov.br/cidadania/pt-br/acesso-a-informacao/lgpd";
       location.replace(url);
    }

  
}