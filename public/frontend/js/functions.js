
/* Slider */
$(document).ready(function() {
  
  /* Filter select */
  $('.js-example-basic-multiple').select();
   
  /* Slider settings */ 
    $("#Slider1").responsiveSlides({
        auto: true,
        pause: true,
        nav: false,
    controller: false,
        speed: 1000,
        timeout: 6000,
        namespace: 'Slider',
        manualControls: '.slider-tabs'
    });
  
  /* Partner with us slider */ 
  $("#Slider2").responsiveSlides({
        auto: true,
        pause: true,
        nav: true,
    controller: false,
        speed: 1000,
        timeout: 6000,
        namespace: 'Partner',
        manualControls: '.partner-tabs'
    });
  
});
$(window).resize(function() {
  resize();
});
function resize() {
  var win = $(window).width();
  var temp_width =1170;
  var temp_height =502;
  var temp_s_height =289;
  var temp_result = (temp_height/temp_width) * win;
  var temp_s_result = (temp_s_height/temp_width) * win;
  if(win < temp_width) {
    if (320<= win) {
      $('#Slider-Container #Slider').css("height", temp_result);
            $('#Slider-Container-S #Slider').css("height", temp_s_result);
      
      }
    if (320>= win) {
      $('#Slider-Container #Slider').css("height",502);
      $('#Slider-Container-s #Slider').css("height", 289);
    }
  }
}

/* Star Rating 
$('.fav-pitch i').click(function() {
  if ($(this).hasClass("selected") ) {
    $(this).removeClass("selected");
  }
  else{
    $(this).addClass("selected");
  }
  
});*/

$(function(){
  $('.register-type input').click(function(){
    if($(this).val() == "1")
    {
    $(".fund-raiser-list").css("display", "block");
    }
  else{
    $(".fund-raiser-list").css("display", "none");
  }
  });
});


/* Quick JS */
$(document).ready(function(){
    $(".enquiry").click(function(){
        $(".fixed-contact-intra").css("display", "inherit");
        $(".fixed-contact-intra").css("opacity", "1");
    });
  $(".close-btn").click(function(){
        $(".fixed-contact-intra").css("opacity", "0");
        $(".fixed-contact-intra").css("display", "none");
    });
});


/* Restrict Letters */
$(function(){
  $(".limit-words").each(function(i){
    len=$(this).text().length;
    if(len>150)
    {
      $(this).text($(this).text().substr(0,150)+'…');
    }
  });
  $(".live-pitch-list>li p").each(function(i){
    livelen=$(this).text().length;
    if(livelen>200)
    {
      $(this).text($(this).text().substr(0,200)+'…');
    }
  });
  $(".live-pitch-list .two-grid li.location-pitch").each(function(i){
    liveloclen=$(this).text().length;
    if(liveloclen>25)
    {
      $(this).text($(this).text().substr(0,25)+'…');
    }
  });
});


/* Accordion */
$(document).ready(function() {
  var url = (window.location).href;
    var id = url.substring(url.lastIndexOf('#') + 1);
    if(id != url){
    $(".accordion h3").removeClass('current');
    $('#'+id).addClass("current");
    $('#'+id).next(".acc-content").slideDown('slow');
  }         
});
$(".accordion h3").click(function () {
  $(this).next(".acc-content").slideToggle("slow").siblings(".acc-content:visible").slideUp("slow");
  $(this).toggleClass("current").siblings("h3").removeClass("current");
});


/* Toggle Tabs */
$(".toggle-tabs li").click(function(){
 $(this).addClass('active-tab').parents('ul.toggle-tabs').find('li').not($(this)).removeClass('active-tab');
 var currentTabIndex = $(this).index();
 $('.content-box:eq('+ currentTabIndex +')').addClass('active-content-box').parents('.tabbed-content-wrap').find('.content-box').not($('.content-box:eq('+ currentTabIndex +')')).removeClass('active-content-box');
});


/* Dropdown Filter & expand*/
// $(document).ready(function() {
//  // $('select').val([1]);
//  $('select').formSelect();
//  $('select.select_all').siblings('ul').prepend('<li id=sm_select_all><span>Select All</span></li>');
//  $('li#sm_select_all').on('click', function () {
//    var jq_elem = $(this), 
//      jq_elem_span = jq_elem.find('span'),
//      select_all = jq_elem_span.text() == 'Select All',
//      set_text = select_all ? 'Select None' : 'Select All';
//    jq_elem_span.text(set_text);
//    jq_elem.siblings('li').filter(function() {
//    return $(this).find('input').prop('checked') != select_all;
//    }).click();
//  });
// });
  

/* Filter Close Outside Div */  
$(document).mouseup(function (e)
{
  var container = $(".investor-filter-search"); 

  if (!container.is(e.target) 
    && container.has(e.target).length === 0) 
  {
  $(".filter-grid").addClass("closed");
  $(".filter-grid").removeClass("open");
  $(".filter span").addClass("plus");
  }
});

/* Toggle Filter Open & Close  */
$(document).ready(function(){
  $(".filter .expand").click(function(){
    if ($(".filter-grid").hasClass("closed")) {
    $(".filter-grid").removeClass("closed");
    $(".filter-grid").addClass("open");
      $(this).removeClass("plus");
    }
    else if ($(".filter-grid").hasClass("open")) {
      $(".filter-grid").removeClass("open");
      $(this).addClass("plus");
      $(".filter-grid").addClass("closed");
    }
  });
});


/* Slider Scroll*/
$(document).ready(function() {
  var slider = document.getElementById("myRange");
  var output = document.getElementById("price-range");
  if (slider != null)
  {
    output.innerHTML = slider.value;
    slider.oninput = function() {
      output.innerHTML = this.value;
    }
  }
  

  
});



/* Header Fixed */
$(window).scroll(function(e) {
var st = $(window).scrollTop();
if ($(document).width() > 640) {
  if (st > 10) {
    $('header').addClass('fixed')
  } else {
    $('header').removeClass('fixed')
  }
}
});


/* Menu */
$(document).ready(function() {
    $(".menu").clone().appendTo(".Wrapper");
    $('.Wrapper').find('ul').removeClass('menu');
    $('.Wrapper').find('li').removeAttr('class');
    $('.Wrapper').find('ul:first').addClass('par-menu');
    $('.menu-mobile').click(function() {
        $(".Wrapper").slideToggle();
    });
    $(".Wrapper .sub-menu").parent(this).find("a:first").attr("href", "javascript:void(0);").addClass("menu-parent");
    $(".menu-parent").each(function() {
        $(this).click(function() {
            $(this).next(".sub-menu").slideToggle();
        });
    });
    $(".Wrapper .sub-menu ul").parent(this).find("a:first").attr("href", "javascript:void(0);").removeClass('menu-parent').addClass("sub-parent").next('ul').removeClass('sub-menu').addClass('child-menu');
    $('.sub-parent').each(function() {
        $(this).click(function() {
            $(this).next(".child-menu").slideToggle();
        });
    });
});



/* Back to Top */
$(document).ready(function() {
  $('body').materialScrollTop({
    revealElement: 'header',
    revealPosition: 'bottom',
    onScrollEnd: function() {
      console.log('Scrolling End');
    }
  });
});

/* Pagination */
var items = $(".pagination-rows tr");
var numItems = items.length;
var perPage = 4;

items.slice(perPage).hide();

$('#pagination-container').pagination({
  items: numItems,
  itemsOnPage: perPage,
  prevText: "&laquo;",
  nextText: "&raquo;",
  onPageClick: function (pageNumber) {
    var showFrom = perPage * (pageNumber - 1);
    var showTo = showFrom + perPage;
    items.hide().slice(showFrom, showTo).show();
  }
});


/* Progress Bar */
$('.progressbar .progressbar-intra').each(function(){
    var width=$(this).data('width');
    
    if(width > 100){
        $(this).animate({ width: '100%' }, 2500);
        $(this).after( '<span class="perc">' + width + '% </span>');
        $('.perc').delay(3000).fadeIn(1000);
    }else{
       
        $(this).animate({ width: width+'%' }, 2500);
        $(this).after( '<span class="perc">' + width + '% </span>');
        $('.perc').delay(3000).fadeIn(1000);
    }
    
}); 


/* Restrict Uploading FIles */
$(document).ready(function(){ 
  $('.fileinput').change(function(){
    if(this.files.length>10)
      alert('Too many files, maximum upload is 10 files')
  });
  // Prevent submission if limit is exceeded.
  // $('form').submit(function(){
  //  if(this.files.length>10)
  //    return false;
  // });
});


/* Country State City */
$(document).ready(function(){ 
  $('#country').change(function(){ 
    loadState($(this).find(':selected').val())
  })
  $('#state').change(function(){
    loadCity($(this).find(':selected').val())
  })
});





/* Popup & OTP Key */

$(function() {
  'use strict';

  var body = $('.otpPopUp');

  function goToNextInput(e) {
    var key = e.which,
      t = $(e.target),
      sib = t.next('input');

    if (key != 9 && key != 8 && (key < 48 || key > 57)) {
      e.preventDefault();
      return false;
    }

    if (key === 9) {
      return true;
    }
    if (key === 8) {
      return true;
    }

    if (!sib || !sib.length) {
      sib = body.find('input').eq(0);
    }
    sib.select().focus();
  }

  function onKeyDown(e) {
    var key = e.which;

    if (key === 9 || key === 8 || (key >= 48 && key <= 57)) {
      return true;
    }

    e.preventDefault();
    return false;
  }
  function onFocus(e) {
    $(e.target).select();
  }
  body.on('keyup', 'input', goToNextInput);
  body.on('keydown', 'input', onKeyDown);
  body.on('click', 'input', onFocus);
})


/* Gallery Popup */
$('.gallery-item').magnificPopup({
  type: 'image',
  gallery:{
    enabled:true
  }
});

