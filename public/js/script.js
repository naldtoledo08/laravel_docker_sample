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

	$('.btn_approve_access').click(function(e) {
	    e.preventDefault();
	    var form = $("#remote-access-form-approve-" + $(this).attr('data-remoteAccessId'));	    
	    $('#confirm-approve-remote-access').modal({ backdrop: 'static', keyboard: false })
	        .on('click', '.btn-confirm-approve-remote-access', function(){
	            form.submit();
	        });
	});

	$('.btn_deny_access').click(function(e) {
	    e.preventDefault();
	    var form = $("#remote-access-form-deny-" + $(this).attr('data-remoteAccessId'));	    
	    $('#confirm-deny-remote-access').modal({ backdrop: 'static', keyboard: false })
	        .on('click', '.btn-confirm-deny-remote-access', function(){
	            form.submit();
	        });
	});
});
