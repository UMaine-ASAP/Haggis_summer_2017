$(document).ready(function()
{
  $('.criteriaRating').on('change', function(e)
  {
    var curr = e.target.id;
    var currval = $(this).val();
    console.log(curr);
    $('#'+curr+".criteriaRatingout").attr('value', currval);
  });
});
