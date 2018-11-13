$(document).ready(function() {
	//$('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
	$('#btn_logout').click(function(e) {
	    e.preventDefault();
	    var form = $("#timesheet-logout-" + $(this).attr('data-timesheetId'));	    
	    $('#confirm-logout').modal({ backdrop: 'static', keyboard: false })
	        .on('click', '.btn-logout', function(){
	            form.submit();
	        });
	});
});
