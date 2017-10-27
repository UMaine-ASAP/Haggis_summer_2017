$(document).ready(function()
{
  $('.criteriaRating').on('change', function(e)
  {
    var curr = e.target.id;
    var currval = $(this).val();
    $('#'+curr+".criteriaRatingout").attr('value', currval);
  });
});
