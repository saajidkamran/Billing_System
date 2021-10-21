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

		    $(document).on('submit','#create-user-form', function()
		    {

		    	//passing data to  json format from form submit
		    	var fd=JSON.stringify($(this).serializeObject());

		    	$.ajax
		    	({
		    		url:"http://localhost/BillingSystemCIS/Api/adduserAPI.php",
		    		type :"POST",
					contentType :"application/json",
					dataType: "json",	
					data : fd,
					dataType: "json",

        	
				    success : function(result) {
				        // User was created sussfully
				       alert("Registration success");
				      // var create_product_html=` <button type='submit' class='btn btn-primary'>
					    //    						<span class='glyphicon glyphicon-plus'></span> Create Product
					    //						</button>`

					    //$("#page-content").html(create_product_html);						
				    },
				    error: function(xhr, resp, text) {
				        // show error handling 
				       alert("Registration unsuccessful");
				       alert("Try again!");

				    }

				})

				;
				return false;
			});
	
	
});