let timerInterval;
let secondsElapsed = 0;
let show = 0
let row_downtime = 0;
let minutes = 0;
const fourMinutes = 65;

function startTimer() {
    document.getElementById('status-id-circle').style.backgroundColor='red';
    document.getElementById('cancelBtn').style.display="block";
    document.getElementById('startBtn').style.display="none";
    document.getElementById('status-txt-id').textContent="Stopping";
    if (timerInterval) clearInterval(timerInterval); // Clear any existing interval
    timerInterval = setInterval(function () {
        secondsElapsed++;
        document.getElementById('timer').textContent = formatTime(secondsElapsed);
        checkMins();
    }, 1000);



}

function cancelTimer(){
    if (timerInterval) clearInterval(timerInterval);
    secondsElapse = 0;
    const timer = document.querySelector('.time-content').innerText = "00:00:00";
    document.getElementById('stopBtn').style.display="none";
    document.getElementById('startBtn').style.display="block";
    document.getElementById('cancelBtn').style.display="none";
    document.getElementById('status-id-circle').style.backgroundColor='#4CBB17';
    document.getElementById('status-txt-id').textContent="On-going"; 
   }

function stopTimer() {
     minutes = parseInt(secondsElapsed / 60);
   // let sendMin = minutes;
    if (timerInterval) clearInterval(timerInterval); // Stop the timer
//    saveTime(secondsElapsed);
    const timer = document.querySelector('.time-content').innerText;
    document.getElementById('con_time').style.display = 'block';
    document.getElementById('downtime_data').style.display = 'block';
    document.getElementById('timer_record').value=timer;
    document.getElementById('number_time').value = minutes;
   document.getElementById('status-txt-id').textContent="On-going";
   document.getElementById('keyb-downtime').style.display="grid"; 

    
}

function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const remainingSeconds = seconds % 60;
    return (hours < 10 ? '0' : '') + hours + ":" + 
           (minutes < 10 ? '0' : '') + minutes + ":" + 
           (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
}
function submit_Data_timer(){
    document.getElementById('status-id-circle').style.backgroundColor='#4CBB17';
    secondsElapsed = 0;
    const timer = document.querySelector('.time-content').innerText = "00:00:00";
    document.getElementById('con_time').style.display = 'none';
    document.getElementById('stopBtn').style.display="none";
    document.getElementById('startBtn').style.display="block";
    document.getElementById('cancelBtn').style.display="none";
    document.getElementById('keyb-downtime').style.display ="none";

  //  document.getElementById('keyboard_container').style.display = "none";
   //  minutes = 0;
}
function exit_downtime_form(){
     document.getElementById('con_time').style.display = "none";
     document.getElementById('downtime_data').style.display = "none";
     secondsElapsed = 0;
     document.getElementById('status-id-circle').style.backgroundColor='#28A745';

}

function checkMins(){

     if(secondsElapsed>=fourMinutes){
        document.getElementById('stopBtn').style.display="block";
        document.getElementById('startBtn').style.display="none";
        document.getElementById('cancelBtn').style.display="none";

        }else{
          document.getElementById('stopBtn').style.display="none";
          document.getElementById('startBtn').style.display="none";
          document.getElementById('cancelBtn').style.display="block";

        }



}
