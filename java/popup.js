$(document).ready(function()
{

  var current;
  $(".joinClass").click(function(){
      current = "#joinClass";
      $(".overlay, #joinclass").fadeToggle();
  })

  $(".exit").click(function(){
      $(".overlay,"+current).fadeToggle();
  })

  $(".createClass").click(function(){
    current = "#createClass"
      $(".overlay, #createClass").fadeToggle();

  })
});
