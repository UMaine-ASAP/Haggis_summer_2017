<?php
if($action != 'submit') { ?>

<script src="js/popup.js"></script>

<script src='js/tinymce/tinymce.min.js'></script>
<script>tinymce.init({
                      selector: '.fancyText',
                      plugins:'code',
                      toolbar:['undo redo | styleselect | bold italic | link image | alignleft aligncenter alignright | code']
                      });</script>
<?php } ?>
