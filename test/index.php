<!doctype html>
<html lang="en">
<head>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( ".draggableui-widget-content" ).draggable({ snap: ".ui-widget-header" });
  } );
  </script>
</head>
<body>

<div id="snaptarget" class="ui-widget-header">
  <p>I'm a snap target</p>
</div>



<div id="draggable2" class="draggableui-widget-content">
  <p>I only snap to the big box</p>
</div>




</body>
</html>
