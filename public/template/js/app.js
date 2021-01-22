var toggle_side = false;
var screenWidth = $(window).width();
var screenHeight = $(window).height();

$(window).resize(function(){
  screenWidth = $(window).width();
  // console.log(screenWidth);
  mediaScreen(screenWidth);
});

mediaScreen(screenWidth);

function mediaScreen(screenSize){
  if(screenSize <= "700"){    
    $('#poho_password').parent().removeClass('justify-content-end');
    $('#poho_password').parent().addClass('pb-2 pt-1');
    $('#logout_button').addClass("btn-block");
  }else{
    $('#poho_password').parent().addClass('justify-content-end');
    $('#poho_password').parent().removeClass('pb-2 pt-1');
    $('#logout_button').removeClass("btn-block");
  }
}

$('#button_search').on('click', function(){
  if(screenWidth <= "700"){
    $('#search_modal').modal('show');
  }else{        
    $('#button_search').parent().submit();    
  }
});

$('#btn_side').on('click', function(){    
    if(!toggle_side){         
      if(screenWidth <= "700"){
        $('.bg-side').addClass('show-main-side');
      }else{
        $('.bg-side').addClass('mini-main-side');            
      }                        
        toggle_side = true;
    }else{        
        if(screenWidth <= "700"){
          $('.bg-side').removeClass('show-main-side');
        }else{
          $('.bg-side').removeClass('mini-main-side');            
        }             
        toggle_side = false;
    }    
});

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
        $('#blah').css('opacity', 'unset');
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  
  $("#imgInp").change(function() {
    readURL(this);
  });


  

  // $('.btn-upload-img-profile > label > span');

$('.btn-upload-img-profile').hover(function(){  
  $('div.btn-upload-img-profile > label > span').toggleClass('active');
});