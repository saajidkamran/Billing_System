
$(document).ready(function(){
     
    // Run when the button "btnchkAvb" click
    $(document).on('click', '.btnchkAvb', function()
    {
           var v =[];//creating the array to inittialising the ajax array  
           // running the rest api made to get json object from the database so we can put into the chart by assigning  it to variable
           var settings = {
           "async": true,
           "crossDomain": true,
           "url": "http://localhost/BillingSystemCIS/Api/getproductdetailAPI.php",
           "method": "GET"
          }

         $.ajax(settings).done(function (response) {
                console.log(response);//get record array
                //inittialising the ajax array to get into external chart
                v[0]=response.records[0].Value1;
                v[1]=response.records[1].Value2;
                v[2]=response.records[2].Value3;
                v[3]=response.records[3].Value4;
                v[4]=response.records[4].Value5;
                //print demo check it is working 
                  console.log("1",v[1]);
                  console.log("2",v[2]);
                  console.log("3",v[3]);
                  console.log("4",v[4]);
                  //Extrenal api
            window.open("https://quickchart.io/chart?c={ type: 'pie', data: { datasets: [ { data:  ["+v[0]+","+v[1]+","+v[2]+", "+v[3]+","+v[4]+"], backgroundColor: [ 'rgb(255, 99, 132)', 'rgb(255, 159, 64)', 'rgb(255, 205, 86)', 'rgb(75, 192, 192)', 'rgb(54, 162, 235)', ], label: 'Dataset 1', }, ], labels: ['Bike Engine Oil (20-40w)','Brake Oil Car', 'Brake Oil Bike(Dot4)', 'car Engine Oil(0-40w)', 'Brake Oil Bike(Dot3)'], }, }");
         

         });

      

 
  });
});