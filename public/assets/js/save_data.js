
function submitData(){
    const copyPartno = document.getElementById("plan_data").value;
    const copyLine = document.getElementById('line').textContent;
    const copyModel = document.getElementById('model').textContent;
    const copyDate = document.getElementById('date').textContent;
    const copyDel_date = document.getElementById('del_date').textContent;
    const copyBalance = document.getElementById('balance').textContent;
    const copyManpower = document.getElementById('manpower').textContent;
    const copyctAsof = document.getElementById('ct_as_of').textContent;
    const copyExpdate = document.getElementById('expdate').textContent;
    const totalOutput = document.getElementById("total_output").textContent;
    const totalNg = document.getElementById("total_NG").textContent;
    const goodQty = document.getElementById("good_qty").textContent;
    const totalProdhrs = document.getElementById("totalProd_hr").textContent;
    const totalDowntime = document.getElementById("total_downtime_data").textContent;
    const actualProdhrs = document.getElementById("actualProd_hr").textContent;
    const actualManpower = document.getElementById("actual_manpower").textContent;
    const breakTime = document.getElementById("breaktime").textContent;
    const achieveDay = document.getElementById("AchieveToday").textContent;
    const line_no = document.getElementById("line").innerHTML;
    const part_no = document.getElementById("plan_data").value;
    //////////
  /*
    const pland1 = document.getElementById("plan1").textContent;
    const pland2 = document.getElementById("plan2").textContent;
    const pland3 = document.getElementById("plan3").textContent;
    const pland4 = document.getElementById("plan4").textContent;
    const pland5 = document.getElementById("plan5").textContent;
    const pland6 = document.getElementById("plan6").textContent;
    const pland7 = document.getElementById("plan7").textContent;
    const pland8 = document.getElementById("plan8").textContent;
    const pland9 = document.getElementById("plan9").textContent;
    const pland10 = document.getElementById("plan10").textContent;
    const pland11 = document.getElementById("plan11").textContent;
    const pland12 = document.getElementById("plan12").textContent;
    const pland13 = document.getElementById("plan13").textContent;
    const pland14 = document.getElementById("plan14").textContent;
    /////////
    const total_hr1 = document.getElementById('total_p1').textContent; 
    const total_hr2 = document.getElementById('total_p2').textContent; 
    const total_hr3 = document.getElementById('total_p3').textContent; 
    const total_hr4 = document.getElementById('total_p4').textContent; 
    const total_hr5 = document.getElementById('total_p5').textContent; 
    const total_hr6 = document.getElementById('total_p6').textContent; 
    const total_hr7 = document.getElementById('total_p7').textContent; 
    const total_hr8 = document.getElementById('total_p8').textContent; 
    const total_hr9 = document.getElementById('total_p9').textContent; 
    const total_hr10 = document.getElementById('total_p10').textContent; 
    const total_hr11 = document.getElementById('total_p11').textContent; 
    const total_hr12 = document.getElementById('total_p12').textContent; 
    const total_hr13 = document.getElementById('total_p13').textContent; 
    const total_hr14 = document.getElementById('total_p14').textContent;   
  */
    const totalOutput_sum = document.getElementById('total_output').textContent;
    const totalngs = document.getElementById('total_NG').textContent;
    const goodQty_sum = document.getElementById('good_qty').textContent;
    const totalProdhr_sum = document.getElementById('totalProd_hr').textContent;
    const totalDowntime_sum = document.getElementById('total_downtime_data').textContent;
    const actualProdhr_sum = document.getElementById('actualProd_hr').textContent;
    const actualManpower_sum = document.getElementById('actual_manpower').textContent;
    const breakTime_sum = document.getElementById('breaktime').textContent;
    const achieveToday_sum = document.getElementById('AchieveToday').textContent;


	console.log(totalOutput_sum)
	console.log(totalngs)	
	console.log(goodQty_sum)
	console.log(totalProdhr_sum)
	console.log(totalDowntime_sum)
	console.log(actualManpower_sum)
	console.log(breakTime_sum)
	console.log(achieveToday_sum)

        console.log(copyPartno)
        console.log(copyLine)   
        console.log(copyModel)
        console.log(copyDate)
        console.log(copyDel_date)
        console.log(copyBalance)
        console.log(copyManpower)
        console.log(copyctAsof)
       console.log(copyExpdate)


    const dataToSend1 = {
        CopyPartno: copyPartno,
        CopyLine: copyLine,
        CopyModel: copyModel,
        CopyDate: copyDate,
        CopyDel_date: copyDel_date,
        CopyBalance: copyBalance,
        CopyManpower: copyManpower,
        CopyctAsof: copyctAsof,
        CopyExpdate: copyExpdate
    };
/*
const planData={
        plan1:pland1,
        plan2:pland2,
        plan3:pland3,
        plan4:pland4,
        plan5:pland5,
        plan6:pland6,
        plan7:pland7,
        plan8:pland8,
        plan9:pland9,
        plan10:pland10,
        plan11:pland11,
        plan12:pland12,
        plan13:pland13,
        plan14:pland14
    };

    const totalPlan = {
        totalhr1:total_hr1,
        totalhr2:total_hr2,
        totalhr3:total_hr3,
        totalhr4:total_hr4,
        totalhr5:total_hr5,
        totalhr6:total_hr6,
        totalhr7:total_hr7,
        totalhr8:total_hr8,
        totalhr9:total_hr9,
        totalhr10:total_hr7,
        totalhr11:total_hr7,
        totalhr12:total_hr7,
        totalhr13:total_hr13,
        totalhr14:total_hr14

    };

*/
const summary_datas = {
        total_output_data:totalOutput_sum,
        total_ng_data:totalngs,
        goodQty_data:goodQty_sum,
        totalProdhr_data:totalProdhr_sum,
        totalDowntime_data: totalDowntime_sum,
        actualProdhr_data:actualProdhr_sum,
        actualManpower_data:actualManpower_sum,
        breakTime_data:breakTime_sum,
        achieveToday_data:achieveToday_sum

    };


var urlEncodedData1 = Object.keys(dataToSend1)
    .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataToSend1[key]))
    .join('&');

var xhr1 = new XMLHttpRequest();
xhr1.open("POST", "../src/controller/copyOfdata.php", true);
xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
xhr1.onreadystatechange = function() {
    if (xhr1.readyState === XMLHttpRequest.DONE) {
        if (xhr1.status === 200) {
            console.log("details_product is recorded");
            
            // Uncomment and ensure these elements exist
            // var imageUrll = document.getElementById("signa_prepared").src;
            // var imageUrl2 = document.getElementById("signa_checked").src;
            // var imageUrl3 = document.getElementById("signa_approved").src;
            // window.location.href = "print_data.php?image=" + encodeURIComponent(imageUrll) + "&image1=" + encodeURIComponent(imageUrl2) + "&image3=" + encodeURIComponent(imageUrl3);
            
            // Redirect to print_data.php without image URLs
            //window.location.href = "print_data.php";
        } else {
            alert("Error: " + xhr1.status);
        }
    }
};
xhr1.send(urlEncodedData1);

/*
    var urlEncodedData1 = Object.keys(dataToSend1)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(dataToSend1[key]))
        .join('&');

    var xhr1 = new XMLHttpRequest();
    xhr1.open("POST", "copyOfdata.php", true);
    xhr1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr1.onreadystatechange = function() {
        if (xhr1.readyState === XMLHttpRequest.DONE) {
            if (xhr1.status === 200) {
		console.log("details_product is recorded")
                // After both data sets are sent successfully, redirect with both image URLs
               // var imageUrll = document.getElementById("signa_prepared").src;
               // var imageUrl2 = document.getElementById("signa_checked").src;
               // var imageUrl3 = document.getElementById("signa_approved").src;
               // window.location.href = "print_data.php?image=" + encodeURIComponent(imageUrll) + "&image1=" + encodeURIComponent(imageUrl2)+ "&image3=" + encodeURIComponent(imageUrl3);
		window.location.href = "print_data.php";
            } else {
                alert("Error: " + xhr1.status);
            }
        }
    };
    xhr1.send(urlEncodedData1);
*/
   /*
    var urlEncodedData2 = Object.keys(planData)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(planData[key]))
        .join('&');

    var xhr2 = new XMLHttpRequest();
    xhr2.open("POST", "send_plan_data.php", true);
    xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr2.onreadystatechange = function() {
        if (xhr2.readyState === XMLHttpRequest.DONE) {
            if (xhr2.status === 200) {
              //  alert("successfuly save plan data");
              console.log("plan data  is recorded");
            } else {
                alert("Error: " + xhr2.status);
            }
        }
    };
    xhr2.send(urlEncodedData2);


    var urlEncodedData3 = Object.keys(totalPlan)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(totalPlan[key]))
        .join('&');
    var xhr3 = new XMLHttpRequest();
    xhr3.open("POST", "send_totalplan_data.php", true);
    xhr3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr3.onreadystatechange = function() {
        if (xhr3.readyState === XMLHttpRequest.DONE) {
            if (xhr3.status === 200) {
                console.log("total plan data  is recorded");

            } else {
                alert("Error: " + xhr3.status);
            }
        }
    };
    xhr3.send(urlEncodedData3);
    */

     var urlEncodedData4 = Object.keys(summary_datas)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(summary_datas[key]))
        .join('&');
    var xhr4 = new XMLHttpRequest();
    xhr4.open("POST", "../src/controller/summaryprint.php", true);
    xhr4.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr4.onreadystatechange = function() {
        if (xhr4.readyState === XMLHttpRequest.DONE) {
            if (xhr4.status === 200) {
                console.log("summary data  is recorded");

            } else {
                alert("Error: " + xhr4.status);
            }
        }
    };
    xhr4.send(urlEncodedData4);

    window.location.href = "../new_sheet1.php";

}
