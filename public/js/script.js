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

	$('.btn_delete_timein').click(function(e) {
	    e.preventDefault();
	    var delete_form = $("#timesheet-form-delete-" + $(this).attr('data-timesheetId'));	    
	    $('#confirm-delete-timein').modal({ backdrop: 'static', keyboard: false })
	        .on('click', '.btn-delete-timein', function(){
	            delete_form.submit();
	        });
	});
});
