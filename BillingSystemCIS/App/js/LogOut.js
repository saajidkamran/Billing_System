 $(document).on('click','.btnLogout', function()
{	

		setCookie("jwt","",-1);
		window.location.replace("http://localhost/BillingSystemCIS/App/Welcome.html");
		//location.replace("http://localhost/BillingSystemCIS/App/Welcome.html");
		

 });
 function setCookie(cname, cvalue, exdays)
		 {
				    var d = new Date();
				    d.setTime(d.getTime() + (exdays*24*60*60*1000));
				    var expires = "expires="+ d.toUTCString();
				    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		  } 









