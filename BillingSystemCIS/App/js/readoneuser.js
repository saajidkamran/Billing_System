
$(document).ready(function(){
        
    // handle 'read one' button click
    $(document).on('click', '.read-one-product-button', function()
    {
         event.preventDefault(); 
		var name =document.getElementById('name').value; 
		console.log(name);
		
			// read product record based on given name
	$.getJSON("http://localhost/BillingSystemCIS/Api/UserSearchAPI.php?name="+name, function(data)
		{
				// start html 


				var read_one_product_html=`
					<!-- product data will be shown in this table -->
						<table class='table table-bordered table-hover'>
						 
						    <!-- product name -->
							    <tr>
							        <td class='w-30-pct'>Name</td>
							        <td class='w-70-pct'>` + data.name + `</td>
							    </tr>
						 
						    <!-- product Email -->
							    <tr>
							        <td>Email</td>
							        <td>` + data.email + `</td>
							    </tr>
						 
						   
						</table>`;
												// inject html to 'page-content' of our app
						$("#app").html(read_one_product_html);
						 
						




    		

		});

   });
 
});