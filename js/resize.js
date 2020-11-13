//Sacha Le Doeuff
$(document).ready( function() {
    $("#chat").draggable({handle : "p.poigne"});
    $("#chat").resizable({alsoResize: "#chatBox,#formMess"});
} );