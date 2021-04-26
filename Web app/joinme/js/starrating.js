var value = 0;
var set = false;
$('#rateit').prop('disabled', true);
$('#one').hover(function(){
    $(this).removeClass("fa-star")
    $(this).addClass("fa-star-o")
    $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
    value = 1;
    set = false;
  }, function(){
      if(!set){
        $('#one').removeClass("fa-star")
        $('#one').addClass("fa-star-o")
        $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
        value = 0;
      }
  })
  $('#two').hover(function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
    value = 2;
    set = false;
  }, function(){
      if(!set){
        $('#one').removeClass("fa-star")
        $('#one').addClass("fa-star-o")
        $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
        value = 0;
      }
  })
  $('#three').hover(function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
    value = 3;
    set = false;
  }, function(){
      if(!set){
        $('#one').removeClass("fa-star")
        $('#one').addClass("fa-star-o")
        $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
        value = 0;
      }
  })
  $('#four').hover(function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $('#three').removeClass("fa-star-o")
    $('#three').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
    value = 4;
    set = false;
  }, function(){
      if(!set){
        $('#one').removeClass("fa-star")
        $('#one').addClass("fa-star-o")
        $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
        value = 0;
      }
  })
  $('#five').hover(function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $('#three').removeClass("fa-star-o")
    $('#three').addClass("fa-star")
    $('#four').removeClass("fa-star-o")
    $('#four').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    value = 5;
    set = false;
  }, function(){
      if(!set){
        $('#one').removeClass("fa-star")
        $('#one').addClass("fa-star-o")
        $('#two').removeClass("fa-star")
        $('#two').addClass("fa-star-o")
        $('#three').removeClass("fa-star")
        $('#three').addClass("fa-star-o")
        $('#four').removeClass("fa-star")
        $('#four').addClass("fa-star-o")
        $('#five').removeClass("fa-star")
        $('#five').addClass("fa-star-o")
        value = 0;
      }
  })

  $('#one').on("click", function(){
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    set = true;
  $('#rateit').prop('disabled', false);
  })
  $('#two').on("click", function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    set = true;
  $('#rateit').prop('disabled', false);
  })
  $('#three').on("click", function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    set = true;
  $('#rateit').prop('disabled', false);
  })
  $('#four').on("click", function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $('#three').removeClass("fa-star-o")
    $('#three').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    set = true;
  $('#rateit').prop('disabled', false);
  })
  $('#five').on("click", function(){
    $('#one').removeClass("fa-star-o")
    $('#one').addClass("fa-star")
    $('#two').removeClass("fa-star-o")
    $('#two').addClass("fa-star")
    $('#three').removeClass("fa-star-o")
    $('#three').addClass("fa-star")
    $('#four').removeClass("fa-star-o")
    $('#four').addClass("fa-star")
    $(this).removeClass("fa-star-o")
    $(this).addClass("fa-star")
    set = true;
  $('#rateit').prop('disabled', false);
  })