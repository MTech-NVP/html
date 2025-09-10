let selectedElement; // Declare variable to hold the select element

function selectedProcess() {
    const selectedProcess_txt = document.getElementById('downtime_process');
    selectedElement = selectedProcess_txt; // Store the select element itself
}

$(document).ready(function() {  	
    $("#downtime_process").change(function() {    
        selectedProcess(); // Call the function to update selectedElement
        
        // Now access the selected option's text
        var id = selectedElement.options[selectedElement.selectedIndex].text;
        var dataString = 'empid=' + id;    

        $.ajax({
            url: 'getdowntime_input.php',
            dataType: "json",
            data: dataString,  
            cache: false,
            success: function(empData) {
                if (empData) {
                    $("#recordListing").removeClass('hidden');							
                    $("#empId").text(empData.id);
                    $("#process_form").val(empData.process_d);
                    $("#details_form").val(empData.details_d);
                    $("#action_form").val(empData.action_d);
                 //   $("#pic_form").val(empData.pic_d);
                 //   $("#remarks_form").val(empData.remarks_d);
                } else {
                    $("#recordListing").addClass('hidden');	
                    // $("#errorMassage").removeClass('hidden').text("No record found!");
                }   
            } // Close success function
        }); // Close ajax function
    }); // Close change function
}); // Close document ready



