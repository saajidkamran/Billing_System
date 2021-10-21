$(document).ready(function(){
	
			
 
    // will run if the delete button(find user button since it is mearge with find user ) was clicked
    $(document).on('click', '.delete-user-button', function(){
		// get the user name
		event.preventDefault();

		
		var deleteusername =document.getElementById('name').value;
		
		// bootbox for good looking 'confirm pop up'
		bootbox.confirm({
		 
		   message: "<h4>Are you sure?</h4>",
		    buttons: {
		        confirm: {
		           label: '<span class="glyphicon glyphicon-ok" ></span>  Yes',
		            className: ''
		        },
		        cancel: {
		            label: '<span class="glyphicon glyphicon-remove"></span> No',
		            className: ''
		       }
		   },
							    callback: function (result) {
							        if(result==true){
							        		console.log(deleteusername);
							        		
										    // send delete request to api / remote server
										    $.ajax({
										        url: "http://localhost/BillingSystemCIS/Api/deleteuserAPI.php",
										        type : "POST",
										        dataType : 'json',
										        data : JSON.stringify({ name: deleteusername }),
										        success : function() {
										 			alert("success");
										        },
										        error: function(xhr, resp, text) {
										            alert("fail");
										        }
										    });
					 
										}
							    	}
		});



	 });


});