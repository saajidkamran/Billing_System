$(document).ready(function(){

		

	// function to set cookie
	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	} 
	//validate the login 
	function getCookie(cname){
		 var name = cname + "=";
		 var decodedCookie = decodeURIComponent(document.cookie);
		var ca = decodedCookie.split(';');
			for(var i = 0; i <ca.length; i++) {
						var c = ca[i];
						while (c.charAt(0) == ' '){
						    c = c.substring(1);
						}
										 
						if (c.indexOf(name) == 0) {
						return c.substring(name.length, c.length);
					 }
		}
										    
		return "";}
	// trigger when login form is submitted
	$(document).on('submit', '#login_form', function()
		{	 			
					setCookie("jwt", "", 1);
				    // get form data
				    var login_form=$(this);
				    var form_data=JSON.stringify(login_form.serializeObject());
				  
				 
				// submit form data to api
				$.ajax({ 
				    url: "http://localhost/BillingSystemCIS/Api/LogInAPI.php",
				    type : "POST",
				    contentType : 'application/json',
				    data : form_data,

				    success : function(result)
				    {
					 		 // store jwt to cookie
					        setCookie("jwt", result.jwt, 1);
					 
							// show home page
					 
						    	// validate jwt to verify access
						    var jwt = getCookie('jwt');
						    
						    $.post("http://localhost/BillingSystemCIS/Api/validate_token.php",
						     JSON.stringify({ jwt:jwt })).done(function(result) 
						    {
						    	var id=result.data.email;
						    	
						    	if (id =="Admin@gmail.com") 
						    	{
						    	
						    		location.replace("http://localhost/BillingSystemCIS/App/Admin.html");
						    	}else {
						    		location.replace("http://localhost/BillingSystemCIS/App/User.html");
						    	}
								 		
								 		
										
										
							})
					},	
					error: function(result)
							{
						    
						    	alert("please log in to visit the homepage,Login failed ");
						    	console.log(result);

							} 
						

				
					});
				return false;

						// get or read cookie

			 
	});
	$.fn.serializeObject = function(){
 
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
	
});
 
// login form submit trigger will be here