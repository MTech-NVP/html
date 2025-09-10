function planData(){
         var selectedValue = document.getElementById("plan_data").value;

         var xhr = new XMLHttpRequest();
              xhr.open("POST", "check_plan.php", true);
               xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
               xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                                         // alert("Response from server: " + xhr.responseText);
                           console.log("Response from server: " + xhr.responseText);
                       }
                };
               xhr.send("dropdownValue=" + encodeURIComponent(selectedValue));

	}
