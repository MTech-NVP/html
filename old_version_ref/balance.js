function update_balance(){

    setInterval(function(){
        fetch('balance_server.php').then(function(response){

        return response.json();

        }).then(function(data){
          //countValue.innerText = JSON.stringify(data.viewcount,2,null);
         // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
         $("#balance").text(data.balance_data.balance);
        // $("#prod_total_count1").text(data.countPerHr.countTol);
        // $("#achieve_1").text(data.achieved.achieved+"%");
        
           // countValue.textContent = dataviewcount;
         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}
document.addEventListener("DOMContentLoaded", (event) => {

update_balance();



});
