$(document).ready(function(){
	// function to make form values to json format
			
 	    // show html form when 'update product' button was clicked
    
     
    // will run if 'create product' form was submitted
	$(document).on('submit', '#update-product-form', function(){
	     event.preventDefault();
	    var e = document.getElementById("ProductValue").value;
	   	var s = document.getElementById("oil").value;
	   	alert (s);
	   var fd=JSON.stringify(
									{ name:s,
									  Value:e 
									}
								);
	    	   	
	   	
		
		$.ajax({
		    url: "http://localhost/BillingSystemCIS/Api/ProductValueAPI.php",
		    type : "POST",
		    contentType : 'application/json',	
			data : fd,
			dataType: "json",	
		    success : function(result) {
		       
		        console.log(result);
		        alert("Successfully Updated the stock");
		    },
		    error: function(result) {
		        // show error to console
			alert("error");		    }
		});
	     
	    return false;
	});
	


});