function totalProdtime(){

    setInterval(function(){
        fetch('prod_hrs_server.php').then(function(response){

        return response.json();

        }).then(function(data){
          //countValue.innerText = JSON.stringify(data.viewcount,2,null);
         // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
         $("#totalProd_hr").text(data.prod_hrs.prod_hrs); 
        }).catch(function(error){
            console.log(error);
        });
    },1000);

}
document.addEventListener("DOMContentLoaded", (event) => {
  totalProdtime();
});
