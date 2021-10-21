$(document).ready(function() 
{		    



			// function to make form values to json format
			$.fn.serializeObject = function()
			{
			    var o = {};
			    var a = this.serializeArray();
			    $.each(a, function() {
			        if (o[this.name] !== undefined) {
			            if (!o[this.name].push) {
			                o[this.name] = [o[this.name]];
			            }
			            o[this.name].push(this.value || '');
			        } else {
			            o[this.name] = this.value || '';
			        }
			    });
			    return o;
			};
			//run when the button click inside the form 
		    $(document).on('submit','#billingorder-form', function()
		    {
					
		    	event.preventDefault();
		    	//get the value from the id given by user and convert to json fromat 
			    var p = document.getElementById("ProductValue").value;
	   			var o = document.getElementById("oil").value;
	   			var fd=JSON.stringify(
									{ name:o,
									  orderValue:p 
									}
								);
		    	
		    	
		    	$.ajax
		    	({
		    		url:"http://localhost/BillingSystemCIS/Api/UserOrderProductAPI.php",
		    		type :"POST",
					contentType :"application/json",
					dataType: "json",	
					data : fd,
					dataType: "json",

        	
				    success : function(result) {
				        // User was created sussfully
				       alert("order success");					
				    },
				    error: function(result) {
				        // show error handling 
				       console.log(result);
				    }



				})

				;
				return false;
			});
	
	
});