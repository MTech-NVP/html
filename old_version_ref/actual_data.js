let timerInterval;
let secondsElapsed = 0;
let show = 0
let row_downtime = 0;


function actualOutput(){
    setInterval(() => {
        fetch('./sheets/getActualOutput.php')
            .then(async response => {
                const contentType = response.headers.get('content-type');

                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error("Expected JSON, got:", text);
                    return;
                }

                return response.json();
            })
            .then(data => {
                if (!data) return;
                data.lines.forEach(line => {
                    const i = line.id;
                    $("#prod_count_"      + i).text(line.per_hr);
                    $("#prod_total_count" + i).text(line.total);
                    $("#achieve"          + i).text(line.achieved + '%');
                });
            })
            .catch(err => {
                console.error("Fetch error:", err);
            });
    }, 5000);
}



// Usage example:
// const intervalId = actualOutput();
// To stop: clearInterval(intervalId);
/*
function prodtime_6am7am(){

    setInterval(function(){
        fetch('actual1.php').then(function(response){

        return response.json();

        }).then(function(data){

         $("#prod_count_1").text(data.countPerHr.countPerHr);
         $("#prod_total_count1").text(data.countPerHr.countTol);
         $("#achieve_1").text(data.achieved.achieved+"%");
        
       
         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function prodtime_7am8am(){
    setInterval(function(){
        fetch('actual2.php').then(function(response){

        return response.json();

        }).then(function(data){

         $("#prod_count_2").text(data.countPerHr.countPerHr);
         $("#prod_total_count2").text(data.countTol.countTol);
         $("#achieve2").text(data.achieved.achieved+"%");         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_8am9am(){
    setInterval(function(){
        fetch('actual3.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_3").text(data.countPerHr.countPerHr);
         $("#prod_total_count3").text(data.countTol.countTol);
         $("#achieve3").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);
}

function prodtime_9am10am(){
    setInterval(function(){
        fetch('actual4.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_4").text(data.countPerHr.countPerHr);
         $("#prod_total_count4").text(data.countTol.countTol);
         $("#achieve4").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_10am11am(){
    setInterval(function(){
        fetch('actual5.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_5").text(data.countPerHr.countPerHr);
         $("#prod_total_count5").text(data.countTol.countTol);
         $("#achieve5").text(data.achieved.achieved+"%");         

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}
function prodtime_11am12nn(){
    setInterval(function(){
        fetch('actual6.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_6").text(data.countPerHr.countPerHr);
         $("#prod_total_count6").text(data.countTol.countTol);
         $("#achieve6").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}
function prodtime_12nn1pm(){
    setInterval(function(){
        fetch('actual7.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_7").text(data.countPerHr.countPerHr);
         $("#prod_total_count7").text(data.countTol.countTol);
         $("#achieve7").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_1pm2pm(){
    setInterval(function(){
        fetch('actual8.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_8").text(data.countPerHr.countPerHr);
         $("#prod_total_count8").text(data.countTol.countTol);
         $("#achieve8").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function prodtime_2pm3pm(){
    setInterval(function(){
        fetch('actual9.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_9").text(data.countPerHr.countPerHr);
         $("#prod_total_count9").text(data.countTol.countTol);
         $("#achieve9").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_3pm4pm(){
    setInterval(function(){
        fetch('actual10.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_10").text(data.countPerHr.countPerHr);
         $("#prod_total_count10").text(data.countTol.countTol);
         $("#achieve10").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}



function prodtime_4pm5pm(){
    setInterval(function(){
        fetch('actual11.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_11").text(data.countPerHr.countPerHr);
         $("#prod_total_count11").text(data.countTol.countTol);
         $("#achieve11").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function prodtime_5pm6pm(){
    setInterval(function(){
        fetch('actual12.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_12").text(data.countPerHr.countPerHr);
         $("#prod_total_count12").text(data.countTol.countTol);
         $("#achieve12").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function prodtime_6pm7pm(){
    setInterval(function(){
        fetch('actual13.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_13").text(data.countPerHr.countPerHr);
         $("#prod_total_count13").text(data.countTol.countTol);
         $("#achieve13").text(data.achieved.achieved+"%");         

         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function prodtime_7pm8pm(){
    setInterval(function(){
        fetch('actual14.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#prod_count_14").text(data.countPerHr.countPerHr);
         $("#prod_total_count14").text(data.countTol.countTol);
         $("#achieve14").text(data.achieved.achieved+"%");         
        
         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

*/


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

// downtime

function downtime2(){
    setInterval(function(){
        fetch('downtime2.php').then(function(response){

        return response.json();

        }).then(function(data){
	 $("#process2").text(data.process.process);
   	 $("#detail2").text(data.details.details);
   	 $("#act2").text(data.action.Act);
         $("#downtime2").text(data.downtime.time_Elapse);
   	 $("#pic2").text(data.pic.Pics);
    	$("#remark2").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime3(){
    setInterval(function(){
        fetch('downtime3.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process3").text(data.process.process);
         $("#detail3").text(data.details.details);
         $("#act3").text(data.action.Act);
         $("#downtime3").text(data.downtime.time_Elapse);
         $("#pic3").text(data.pic.Pics);
        $("#remark3").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime4(){
    setInterval(function(){
        fetch('downtime4.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process4").text(data.process.process);
         $("#detail4").text(data.details.details);
         $("#act4").text(data.action.Act);
         $("#downtime4").text(data.downtime.time_Elapse);
         $("#pic4").text(data.pic.Pics);
        $("#remark4").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime5(){
    setInterval(function(){
        fetch('downtime5.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process5").text(data.process.process);
         $("#detail5").text(data.details.details);
         $("#act5").text(data.action.Act);
         $("#downtime5").text(data.downtime.time_Elapse);
         $("#pic5").text(data.pic.Pics);
        $("#remark5").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime6(){
    setInterval(function(){
        fetch('downtime6.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process6").text(data.process.process);
         $("#detail6").text(data.details.details);
         $("#act6").text(data.action.Act);
         $("#downtime6").text(data.downtime.time_Elapse);
         $("#pic6").text(data.pic.Pics);
        $("#remark6").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime7(){
    setInterval(function(){
        fetch('downtime7.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process7").text(data.process.process);
         $("#detail7").text(data.details.details);
         $("#act7").text(data.action.Act);
         $("#downtime7").text(data.downtime.time_Elapse);
         $("#pic7").text(data.pic.Pics);
        $("#remark7").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime8(){
    setInterval(function(){
        fetch('downtime8.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process8").text(data.process.process);
         $("#detail8").text(data.details.details);
         $("#act8").text(data.action.Act);
         $("#downtime8").text(data.downtime.time_Elapse);
         $("#pic8").text(data.pic.Pics);
        $("#remark8").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime9(){
    setInterval(function(){
        fetch('downtime9.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process9").text(data.process.process);
         $("#detail9").text(data.details.details);
         $("#act9").text(data.action.Act);
         $("#downtime9").text(data.downtime.time_Elapse);
         $("#pic9").text(data.pic.Pics);
        $("#remark9").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function downtime10(){
    setInterval(function(){
        fetch('downtime10.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process10").text(data.process.process);
         $("#detail10").text(data.details.details);
         $("#act10").text(data.action.Act);
         $("#downtime10").text(data.downtime.time_Elapse);
         $("#pic10").text(data.pic.Pics);
        $("#remark10").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime11(){
    setInterval(function(){
        fetch('downtime11.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process11").text(data.process.process);
         $("#detail11").text(data.details.details);
         $("#act11").text(data.action.Act);
         $("#downtime11").text(data.downtime.time_Elapse);
         $("#pic11").text(data.pic.Pics);
        $("#remark11").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime12(){
    setInterval(function(){
        fetch('downtime12.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process12").text(data.process.process);
         $("#detail12").text(data.details.details);
         $("#act12").text(data.action.Act);
         $("#downtime12").text(data.downtime.time_Elapse);
         $("#pic12").text(data.pic.Pics);
        $("#remark12").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function downtime13(){
    setInterval(function(){
        fetch('downtime13.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process13").text(data.process.process);
         $("#detail13").text(data.details.details);
         $("#act13").text(data.action.Act);
         $("#downtime13").text(data.downtime.time_Elapse);
         $("#pic13").text(data.pic.Pics);
        $("#remark13").text(data.remark.remark);

        }).catch(function(error){
            console.log(error);
        });

    },1000);

}


function downtime14(){
    setInterval(function(){
        fetch('downtime14.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#process14").text(data.process.process);
         $("#detail14").text(data.details.details);
         $("#act14").text(data.action.Act);
         $("#downtime14").text(data.downtime.time_Elapse);
         $("#pic14").text(data.pic.Pics);
        $("#remark14").text(data.remark.remark);

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
        
             $("#total_downtime_data").text(data.downtime/60 + " min");
            
          //countValue.innerText = JSON.stringify(data.viewcount,2,null);
         // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
         
        

           // countValue.textContent = dataviewcount;
         
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}

function startTimer() {
    document.getElementById('status').style.backgroundColor='red';
    if (timerInterval) clearInterval(timerInterval); // Clear any existing interval
    timerInterval = setInterval(function () {
        secondsElapsed++;
        document.getElementById('timer').textContent = formatTime(secondsElapsed);
    }, 1000);
}

function stopTimer() {
    if (timerInterval) clearInterval(timerInterval); // Stop the timer
    saveTime(secondsElapsed);
    const timer = document.querySelector('.time-content').innerText;
    document.getElementById('con_time').style.display = 'block';
    document.getElementById('timer_record').value=timer;
    document.getElementById('number_time').value = secondsElapsed;
    document.getElementById('keyboard_container').style.display = "block";
    
}

function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;
    return (hours < 10 ? '0' : '') + hours + ":" + 
           (minutes < 10 ? '0' : '') + minutes + ":" + 
           (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
}

function saveTime(seconds) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "db_timer.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
//    xhr.send("time=" + seconds);
}
function submit_Data_timer(){
    document.getElementById('status').style.backgroundColor='#28A745';
    secondsElapsed = 0;
    const timer = document.querySelector('.time-content').innerText = "00:00:00";
    document.getElementById('con_time').style.display = 'none';
    document.getElementById('keyboard_container').style.display = "none";
    setInterval(function(){
          fetch('get_data_downtime.php').then(function(response){

          return response.json();

        }).then(function(data){
  //countValue.innerText = JSON.stringify(data.viewcount,2,null);
 // total_Value1.innerText  = JSON.stringify(data.viewcount2,2,null);
    $("#process1").text(data.process_1.process);
    $("#detail1").text(data.details_1.details);
    $("#act1").text(data.action1.Act);
    $("#downtime1").text(data.downtime1.time_Elapse);
    $("#pic1").text(data.pic_1.Pics);
    $("#remark1").text(data.remark_1.remark);

    // countValue.textContent = dataviewcount;
    
    }).catch(function(error){
        console.log(error);
    });

},1000);
///////////////////////////////////////////////////////////
}   
function test_pic(){
    setInterval(function(){
        fetch('get_data_downtime1.php').then(function(response){
    
        return response.json();
      }).then(function(data){
            $("#process2").text(data.process2.process);
            $("#detail2").text(data.details2.details);
            $("#act2").text(data.action2.Act);
            $("#downtime2").text(data.downtime2.time_Elapse);
            $("#pic2").text(data.pic2.Pics);
            $("#remark2").text(data.remark2.remark);
            
    // countValue.textContent = dataviewcount;
    
    }).catch(function(error){
      console.log(error);
    });
    
    },1000);
}

function displayNgs(){
    setInterval(function(){
        fetch('displayngs.php').then(function(response){

        return response.json();

        }).then(function(data){
         $("#totalng1").text(data.ng1.ng1);
         $("#totalng2").text(data.ng2.ng2);
         $("#totalng3").text(data.ng3.ng3);
         $("#totalng4").text(data.ng4.ng4);
         $("#totalng5").text(data.ng5.ng5);
         $("#totalng6").text(data.ng6.ng6);
         $("#totalng7").text(data.ng7.ng7);
         $("#totalng8").text(data.ng8.ng8);
         $("#totalng9").text(data.ng9.ng9);
         $("#totalng10").text(data.ng10.ng10);
         $("#totalng11").text(data.ng11.ng11);
         $("#totalng12").text(data.ng12.ng12);
         $("#totalng13").text(data.ng13.ng13);
         $("#totalng14").text(data.ng14.ng14);        
        }).catch(function(error){
            console.log(error);
        });

    },1000);

}





document.addEventListener("DOMContentLoaded", (event) => {
   /*rodtime_6am7am();
    prodtime_7am8am();
    prodtime_8am9am();
    prodtime_9am10am();
    prodtime_10am11am();
    prodtime_11am12nn();
    prodtime_12nn1pm();

    prodtime_1pm2pm();
    prodtime_2pm3pm();
    prodtime_3pm4pm();
    prodtime_4pm5pm();
    prodtime_5pm6pm();
*/  //odtime_6pm7pm();
    //odtime_7pm8pm();
    actualOutput()
    testPHPEndpoint()


 ///   totals();
//    test_pic();
    total_downtime();

// call downtime function
//  submit_Data_timer();
   //downtime2();
   //downtime3();
  // downtime4();
  /*
   downtime5();
   downtime6();
   downtime7();
   downtime8();
   downtime9();
   downtime10();
   downtime11();
   downtime12();
   downtime13();
   downtime14();
  
  totals();  
  displayNgs()
    */
});
  
