


function totals(){
    setInterval(function(){
        fetch('sum_of_data.php').then(function(response){

        return response.json();

        }).then(function(data){
          //countValue.innerText = JSON.stringify(data.viewcount,2,null);
         // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
         $("#total_output").text(data.total_output.total_output);
         $("#good_qty").text(data.good_qty.good_qty);
         $("#AchieveToday").text(data.achieve_today.achieve_today+"%");
         $("#total_NG").text(data.totalngs.totalngs);
           // countValue.textContent = dataviewcount;

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function total_downtime(){
    setInterval(function(){
        fetch('get_total_downtime.php').then(function(response){

        return response.json();

        }).then(function(data){

             $("#total_downtime_data").text((data.downtime/60).toFixed(2) + " hrs");
	     const downtime = document.getElementById('total_downtime_data') ? document.getElementById('total_downtime_data').innerText : '0';
	     const totalProdhrs = document.getElementById('totalProd_hr') ? document.getElementById('totalProd_hr').innerText : '0';

// Convert downtime to hours	
	     const convertTohrs = parseFloat(downtime);

// Ensure totalProdhrs is a valid number
	     const convertTofloat = parseFloat(totalProdhrs);

// Check for invalid or NaN values	
	    if (isNaN(convertTohrs) || isNaN(convertTofloat)) {
  	         // console.error("Invalid input: downtime or totalProdhrs is not a valid number");
                  document.getElementById('actualProd_hr').innerText = 'None';
            } else {
  // Compute actual production hours
            const computeActualprod = convertTofloat - convertTohrs;

  // Display the result
            document.getElementById('actualProd_hr').innerText = computeActualprod.toFixed(2);  // Optional: rounding to 2 decimal places
}




           // countValue.textContent = dataviewcount;

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


document.addEventListener("DOMContentLoaded", (event) => {
   totals();
   total_downtime();


});
