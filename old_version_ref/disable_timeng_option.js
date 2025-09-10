let time_length = 0;  // Use `let` for reassignment

function planLength() {
    setInterval(function() {
        fetch('server_plan_length.php')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                // Assuming data.val_length is an object that contains 'val_length' as a key
                if (data && data.val_length.val_length) {
                    time_length = data.val_length.val_length-1;  // Correct assignment
		    console.log(`time length ${time_length}`)
                }
            })
            .catch(function(error) {
                console.log(error);
            });
    }, 1000);  // Fetches data every second
}



  // Retrieve the saved timeValue from localStorage, or default to 0 if not found
  let timeValue = parseInt(localStorage.getItem("timeValue")) || 0;
     
timeValue = 7 
 localStorage.setItem("timeValue", timeValue);      
  // Function to enable one option and disable the rest
  function enableOnlyOption(value) {
    const options = document.querySelectorAll('#time_value option');
    options.forEach((option) => {
      if (option.value == value) {
        option.disabled = false; // Enable the current option
      } else {
        option.disabled = true; // Disable all others
      }
    });
    console.log(`Option ${value} is now enabled.`);
  }

  // Initially enable the option based on the stored timeValue
  enableOnlyOption(timeValue + 1); // +1 since dropdown values start at 1

  let now = new Date();

  // Initialize the start time to the next full hour
  let startTime = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate(),
    now.getHours() + 1, // Next full hour
    0, // Minutes
    0, // Seconds
    0  // Milliseconds
  );

  console.log(`Initial start time is: ${startTime}`);

  setInterval(() => {
    let currentTime = new Date();
    console.log("Current time: " + currentTime);
    if(timeValue == time_length){
       console.log("reset time value")
       timeValue = 0;
       console.log(`time value:${timeValue}`)
     }

    if (currentTime >= startTime) {
      console.log(`1 hour has elapsed since: ${startTime}`);

      // Increment the start time to the next hour
      startTime = new Date(
        startTime.getFullYear(),
        startTime.getMonth(),
        startTime.getDate(),
        startTime.getHours() + 1, // Increment hour by 1
        0,
        0,
        0
      );

      // Increment timeValue and enable the corresponding dropdown option
      timeValue++;
      enableOnlyOption(timeValue + 1); // +1 since dropdown values start at 1

      // Save the updated timeValue to localStorage
      localStorage.setItem("timeValue", timeValue);

      console.log(`Start time updated to: ${startTime}`);
    } else {
      let timeLeft = (startTime - currentTime) / (1000 * 60); // Time left in minutes
      console.log(`Time left until next interval: ${timeLeft.toFixed(2)} minutes`);
    }
  }, 1000); // Check every second

 
console.log(`time length ${time_length}`)

document.addEventListener("DOMContentLoaded", (event) => {
planLength();
});
