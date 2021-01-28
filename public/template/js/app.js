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
    $('section.content').css('width', screenSize-20+'px')
    $('.custom-search-table').parent().removeClass('ml-auto');
  }else{
    $('#poho_password').parent().addClass('justify-content-end');
    $('#poho_password').parent().removeClass('pb-2 pt-1');
    $('#logout_button').removeClass("btn-block");
    $('section.content').css('width', 'auto');
    $('.custom-search-table').parent().addClass('ml-auto');
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

$("input.search-box").keyup(function() {  
  var value = $(this).val().toLowerCase();
  var index = $('input.search-box').index(this);    
  $($("tbody.search-table")[index]).find('tr').filter(function() {    
    console.log($(this));
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)    
  });
});

for (const x of $('tbody.search-table')) {  
  var table = $('tbody.search-table');  
  var lengthTable = $(x).find('tr').length;
  var i = table.index(x);
  $($('span.total-row')[i]).text(lengthTable);    
  addNavigationTable(i, lengthTable)
}

function createPagination(addNumber){
  return '<li class="page-item">'
  + '<a class="page-link" href="#" aria-label="Previous">'
    + '<span aria-hidden="true">&laquo;</span>'
    + '<span class="sr-only">Previous</span>'
  + '</a>'
+ '</li>'
+ '<li class="page-item active"><a class="page-link" href="#">1</a></li>'
+ addNumber
+ '<li class="page-item">'
  + '<a class="page-link" href="#" aria-label="Next">'
    + '<span aria-hidden="true">&raquo;</span>'
    + '<span class="sr-only">Next</span>'
  + '</a>'
+ '</li>';
}

function addNumberPage(number){
  return '<li class="page-item"><a class="page-link" href="#">'+number+'</a></li>';
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
      console.log($(x).index());
      $(x).show();      
    }    
  }      
}

for (let i = 0; i < $('ul.pagination').length; i++) {
  $($('ul.pagination')[i]).find('li.page-item').click(function(){
    var indexPage = $($('ul.pagination')[i]).find('li.page-item').index(this);           
    if(indexPage > 0 && indexPage < $($('ul.pagination')[i]).find('li.page-item').length){
      $($('ul.pagination')[i]).find('li.page-item').removeClass('active');    
      $(this).addClass('active');    
      setPaginationTable($($('table.table')[i]).find('tbody > tr'), $($('tbody.search-table')[i]).find('tr').length, indexPage);
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

