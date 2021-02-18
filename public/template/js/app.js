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
        $('.custom-menu-text').hide()
      }                        
        toggle_side = true;
    }else{        
        if(screenWidth <= "700"){
          $('.bg-side').removeClass('show-main-side');
        }else{
          $('.custom-menu-text').show();
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

$('ul > li.navbar-item.active > .btn-custom-menu').append('<span class="fa fa-chevron-right pr-2"></span>');


$("input.search-box").keyup(function() {  
  var value = $(this).val().toLowerCase();
  var index = $('input.search-box').index(this);    
  $($("tbody.search-table")[index]).find('tr').filter(function() {        
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)    
  });
});

countRowLength();
function countRowLength(){
  for (const x of $('tbody.search-table')) {  
    var table = $('tbody.search-table');  
    var lengthTable = $(x).find('tr').length;
    var lengthColumn = $(x).parent().find('thead > tr > th').length;
    var i = table.index(x);
    $($('span.total-row')[i]).text(lengthTable);        
    if(lengthTable < 1){
      $(x).find('tr').append('<td colspan='+lengthColumn+'>Tidak Ada Data</td>');
    }
    addNavigationTable(i, lengthTable)
  }
}

function createPagination(addNumber){
  return '<li class="page-item">'
  + '<a class="page-custom-link" href="#" aria-label="Previous">'
    + '<span aria-hidden="true"><i class="fa fa-chevron-left"></i></span>'
    + '<span class="sr-only">Previous</span>'
  + '</a>'
+ '</li>'
+ '<li class="page-item active"><a class="page-custom-link" href="#">1</a></li>'
+ addNumber
+ '<li class="page-item">'
  + '<a class="page-custom-link" href="#" aria-label="Next">'
    + '<span aria-hidden="true"><i class="fa fa-chevron-right"></i></span>'
    + '<span class="sr-only">Next</span>'
  + '</a>'
+ '</li>';
}

function addNumberPage(number){
  return '<li class="page-item"><a class="page-custom-link" href="#">'+number+'</a></li>';
}

function addNavigationTable(i, lengthTable){          
  var pagination = $($('ul.pagination')[i]);
  var countPagination = 2;
  var numberPage = '';
  var limitCount = 10;  
  if(lengthTable >= 10){    
    $($('nav.pagination-table')[i]).show();                      
      for (let j = 0; j < lengthTable; j++) {            
        if(j >= limitCount){ 
          numberPage += addNumberPage(countPagination++);
          limitCount += 10;                    
        }
      }  
      pagination.append(createPagination(numberPage));                            
      setPaginationTable($($('table.table')[i]).find('tbody > tr'), lengthTable, 1);
    }
}      


function setPaginationTable(table, lengthTable, active){        
  var countTablePage = [];          
  for (let i = 0; i < lengthTable; i++) {
      if(i >= 9){        
        countTablePage.push(i);                                
        lengthTable -= 9;
      }
  }           
  active -= 1;    
  countTablePage.push(lengthTable);    
  countTablePage[active] = parseInt(countTablePage[active] * active) + 9;          
  for (const x of table) {            
    $(x).hide();                
    if($(x).index() >= active * 10 && $(x).index() <= countTablePage[active]){
      // console.log($(x).index());
      $(x).show();      
    }    
  }      
}

function animatePagination(current, active){
  active = $(active);
  console.log(current.parent().find('.active').text(), active.text())
  var currentPage = current.parent().find('.active').text();
  var activePage = active.text();
  var currentIndex = current.parent().find('.active').index();
  if(currentPage < activePage){     
    var rangePage = activePage-currentPage;
    current.removeClass('active');                 
    $(current[currentIndex]).prepend('<div class="selection-page"></div>');            
    setTimeout(function(){      
      $(current[currentIndex]).find('.selection-page').css({
        'margin-left' : (rangePage * 44) + 'px',
        'transition' : '0.2s'
      })      
    }, 200)       
    setTimeout(function(){
      active.addClass('active');              
      $(current[currentIndex]).find('.selection-page').remove()
    }, 400)       
  }else{    
    var rangePage = currentPage - activePage;
    current.removeClass('active');                 
    $(current[currentIndex]).prepend('<div class="selection-page"></div>');                
    setTimeout(function(){      
      $(current[currentIndex]).find('.selection-page').css({
        'margin-left' : '-'+(rangePage * 44) + 'px',
        'transition' : '0.2s'
      })      
    }, 200)       
    setTimeout(function(){
      active.addClass('active');              
      $(current[currentIndex]).find('.selection-page').remove()
    }, 400)       
  }              
}

for (let i = 0; i < $('ul.pagination').length; i++) {
  $($('ul.pagination')[i]).find('li.page-item').click(function(){    
    var indexPage = $($('ul.pagination')[i]).find('li.page-item').index(this);           
    if(indexPage > 0 && indexPage < $($('ul.pagination')[i]).find('li.page-item').length){
      animatePagination($($('ul.pagination')[i]).find('li.page-item'), this);    
      setPaginationTable($($('tbody')[i]).find('tr'), $($('tbody.search-table')[i]).find('tr').length, indexPage);
    }    
  });     

  $($('ul.pagination')[i]).find("li.page-item > a[aria-label='Previous']").click(function(){
    console.log('prev');    
    var indexPage = findActivePagination(i);
    if(indexPage > 1){
      indexPage--;
      setPageTableActive(i, $($('ul.pagination')[i]).find('li.page-item'), indexPage);
    }
  });

  $($('ul.pagination')[i]).find("li.page-item > a[aria-label='Next']").click(function(){
    console.log('next');
  });
}

function findActivePagination(i){
  return $($('ul.pagination')[i]).find('li.page-item.active').index();
}

function setPageTableActive(i, pagination, indexPage){
  $($('ul.pagination')[i]).find('li.page-item').removeClass('active');    
      $(pagination[indexPage]).addClass('active');    
      setPaginationTable($($('table.table')[i]).find('tbody > tr'), $($('tbody.search-table')[i]).find('tr').length, indexPage);
}

var arrCustomSelect = [];

function setSelected(){
  $('select.custom-select').parent().find('button').css({
    "border" : "1px solid #ced4da",
    "background-color" : "#fff",
    "outline" : "0 none"    
  });    
  $('select.custom-select').parent().find('button').removeClass('btn-light').addClass('custom-button-select');
  $('select.custom-select').parent().find('div').css({"outline" : "0 none"});
  
}

$('select.custom-select').parent().click(function(){
  $(this).css({"outline" : "0 none"});
});

for (const item of $('table.radio-select-table')) {
  $(item).find('tbody > tr').click(function(){      
    $(item).find('tbody > tr').css({'background-color' : '', 'color' : ''});    
    $(this).find('input.radio-selectable').attr('checked', true);
    $(this).css({'background-color' : '#FF9CBB', 'color' : '#fff'});        
  });
}

$('.input-custom-select').click(function(){
  $(this).parent().find('ui.custom-option').show();
});

function addCustomSelect(selected, val = '', button=''){
  return  '<div class="full-custom-select">'+
  '<div class="input-custom-select">'+
    '<span class="text-input">'+selected+'</span>'+
    '<span class="fa fa-sort-down"></span>'+
  '</div>'+
  '<ul class="custom-option">'+
    '<li class="option-item selected" data-val="'+val+'"><span class="option-text">'+selected+'</span>'+button+'</li>'+    
  '</ul>'+
'</div>';
}

function addCustomOption(text, val = '', button=''){
  return '<li class="option-item d-flex" data-val="'+val+'"><span class="option-text">'+text+'</span>'+button+'</li>';
}

var toggleSelect = [];

setDataCustomSelect('<button type="button" class="ml-auto option-button-delete"><span class="fa fa-times"></span></button>', '<li class="d-flex"><button type="button" class="option-button-add"><span class="fa fa-plus"></span> Tambah Satuan</button></li>');
  function setDataCustomSelect(button='', fullButton = ''){
    for (const item of $('div.form-custom-select')) {    
      var customSelect = $(item).find('select.full-custom-select');      
      $(item).append(addCustomSelect(customSelect.find('option:selected').text(), customSelect.find('option:selected').val()));
      for (const opt of customSelect.find('option')) {
        if($(opt).prop('selected')){
          continue;
        }      
        $('ul.custom-option').append(addCustomOption($(opt).text(), $(opt).val(), button));            
      }        
      $('ul.custom-option').append(fullButton);
      toggleSelect[$(item).index()] = false;
      $('ul.custom-option').hide();    
    }    
  }

  $('div.full-custom-select').click(function(){        
    var customOption = $(this).find('ul.custom-option');        
    if(!toggleSelect[$(this).parent().index()]){
      $(this).find('div.input-custom-select').css({
        'border-color': '#FDD9DA',
        'box-shadow': '0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px #FDD9DA'
      });
      // customOption.show();
      toggleSelect[$(this).index()] = true;
    }else{
      $(this).find('div.input-custom-select').css({
        'border-color': '',
        'box-shadow': ''
      });
      toggleSelect[$(this).index()] = false;
      // customOption.hide();
    }    
    customOption.toggle();    
  });
  
  $(document).click(function(event){ 
    // IF NOT CLICKING THE SEARCH BOX OR ITS CONTENTS OR SEARCH ICON            
    if (!$(event.target).parent().is("div.input-custom-select") && !$(event.target).is('button.option-button-add') && !$(event.target).is('input.input-option')) {          
      $('div.input-custom-select').parent().find('ul.custom-option').hide();  
      $('div.input-custom-select').css({
        'border-color': '',
        'box-shadow': ''
      });    
      for (let i = 0; i < toggleSelect.length; i++) {
        toggleSelect[i] = false;
      }
    }    
  });
  
  $('.option-item').click(function(){
    var getIndex = $(this).parent().parent().parent().index();  
    if($(this).find('span').hasClass('option-text')){
      $($('select.full-custom-select')[getIndex]).find('option:selected').removeAttr('selected');  
    $($('select.full-custom-select')[getIndex]).val($(this).data('val'))  
    $(this).parent().find('li.selected').removeClass('selected');
    $(this).addClass('selected');
    $(this).parent().parent().find('div.input-custom-select > span.text-input').text($(this).find('span.option-text').text());      
    }  
  });

  $('.option-button-add').click(function(){
    $(this).parent().parent().toggle();    
    $('#modal_input_satuan').modal('show');
  })
// $('input.input-option').click(function(){
//   $(this).parent().parent().toggle();
// })

// $('input.input-option').focus(function(){
//   $(this).parent().parent().toggle();
// })

// $('input.input-option').keyup(function(){
//   $(this).parent().parent().toggle();
// })

// $('input.input-option').keyup(function(){
//   $(this).parent().parent().toggle();
// })






