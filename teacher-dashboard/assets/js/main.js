$(document).ready(function(){
	$('.custom-date').datepicker({
		format: "yyyy-mm-dd",
		autoclose: true,
		endDate: '+0d'
	});
});

function printDiv(divName) {
    var printContents = document.getElementById(divName).outerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
