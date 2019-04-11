tinymce.init({
    selector: 'textarea',
    plugins: "anchor autolink code colorpicker emoticons hr image imagetools link lists media pagebreak paste preview print save table template textcolor wordcount",
    statusbar: false,
    menubar: false,
    toolbar: 'fontsizeselect bold italic hr link | table numlist bullist | alignleft aligncenter alignright | blockquote code | forecolor backcolor | emoticons image media | cut copy paste pastetext |'
});

$(document).ready(function(){
	$('.custom-date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true
	});
});