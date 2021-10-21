
$(document).ready(function(){
       
    // handle 'read one' button click
    $(document).on('submit','#billingorder-form', function()
    {
		var name =document.getElementById('oil').value; 
		 
			// read product record based on given name
	$.getJSON("http://localhost/BillingSystemCIS/Api/gettotalAPI.php?name="+name, function(data)
		{
				// start html 
			
				

				var read_one_product_html=`
					<!-- total  will be shown in this table -->
						<table class='table table-bordered table-hover'>
						 
						    <!-- total amount  -->
							    <tr>
							        <td class='w-30-pct'>Total</td>
							        <td class='w-70-pct'>` + data.totalprice + `</td>
							    </tr>

						    
						</table>`;
												// inject html to 'page-content' of our app
						$("#app").html(read_one_product_html);
						 
						




    		

		});

   });
 
});