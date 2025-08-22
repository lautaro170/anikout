var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
$('#add_more').click(function() {
	if(abc < 6)
	{
		$(this).before($("<div/>", {
			id: 'filediv'
		}).fadeIn('slow').append($("<input/>", {
			name: 'file',
			type: 'file',
			id: 'file'
		}), $("<br/><br/>")));
	}
	else
	{
		alert("No se pueden agregar mas imagenes. Maximo 6.");
	}
});

// Following function will executes on change event of file input to select different file.
$('body').on('change', '#file', function() {
	if (this.files && this.files[0]) {
abc += 1; // Incrementing global variable by 1.
var z = abc - 1;
var x = $(this).parent().find('#previewimg' + z).remove();
$(this).before("<div id='abcd" + abc + "' class='abcd col-xs-4'><img id='previewimg" + abc + "' src='' class='img-responsive'/></div>");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$(this).hide();
$("#abcd" + abc).append($("<img/>", {
	id: 'img',
	dataid: abc,
	src: 'dist/img/x.png',
	alt: 'delete'
}).click(function() {
	//$(this).parent().parent().hide();
	$("#previewimg" + abc).remove();
	$("#abcd" + abc).remove();
	
	//alert("delete");
	$('#file').show();
}));
}
});
// To Preview Image
function imageIsLoaded(e) {
	$('#previewimg' + abc).attr('src', e.target.result);
};
$('#upload').click(function(e) {
	var name = $(":file").val();
	if (!name) {
		alert("Debe seleccionar la primer imagen.");
		e.preventDefault();
	}

});
});