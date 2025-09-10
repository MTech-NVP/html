$(document).ready(function () {
  $("#plan_data").change(function () {
    var id = $(this).find(":selected").val();
    var dataString = "empid=" + id;
    $.ajax({
      url: "../src/controller/getPlan.php",
      dataType: "json",
      data: dataString,
      cache: false,
      success: function (empData) {
        if (empData) {
          //	$("#errorMassage").addClass('hidden').text("");
          $("#recordListing").removeClass("hidden");
          $("#empId").text(empData.id);
          $("#partno").text(empData.part_no);
          $("#line").text(empData.line);
          $("#model").text(empData.model);
          //      $("#date").text(empData.date_created);
          $("#del_date").text(empData.del_date);
          $("#balance").text(empData.balance);
          $("#manpower").text(empData.man_power);
          $("#ct_as_of").text(empData.ct_as_of);
          $("#expdate").text(empData.exp_date);
          $("#totalProd_hr").text(empData.prod_hrs);

          /*
               $("#plan1").text(empData.plan_1);
               $("#plan2").text(empData.plan_2);
               $("#plan3").text(empData.plan_3);
               $("#plan4").text(empData.plan_4);
               $("#plan5").text(empData.plan_5);
               $("#plan6").text(empData.plan_6);
               $("#plan7").text(empData.plan_7);
               $("#plan8").text(empData.plan_8);
               $("#plan9").text(empData.plan_9);
               $("#plan10").text(empData.plan_10);
               $("#plan11").text(empData.plan_11);
               $("#plan12").text(empData.plan_12);
               $("#plan13").text(empData.plan_13);
               $("#plan14").text(empData.plan_14);

                    let sum = 0;
                    
                    let p1 = document.getElementById('plan1').innerHTML;
                    let p2 = document.getElementById('plan2').innerHTML;
                    let p3 = document.getElementById('plan3').innerHTML;
                    let p4 = document.getElementById('plan4').innerHTML;
                    let p5 = document.getElementById('plan5').innerHTML;
                    let p6 = document.getElementById('plan6').innerHTML;
                    let p7 = document.getElementById('plan7').innerHTML;
                    let p8 = document.getElementById('plan8').innerHTML;
                    let p9 = document.getElementById('plan9').innerHTML;
                    let p10 = document.getElementById('plan10').innerHTML;
                    let p11 = document.getElementById('plan11').innerHTML;
                    let p12 = document.getElementById('plan12').innerHTML;
                    let p13 = document.getElementById('plan13').innerHTML;
                    let p14 = document.getElementById('plan14').innerHTML;
                    let num1 = Number(p1);
                    let num2 = Number(p2);
                    let num3 = Number(p3);
                    let num4 = Number(p4);
                    let num5 = Number(p5);
                    let num6 = Number(p6);
                    let num7 = Number(p7);
                    let num8 = Number(p8);
                    let num9 = Number(p9);
                    let num10 = Number(p10);
                    let num11 = Number(p11);
                    let num12 = Number(p12);
                    let num13 = Number(p13);
                    let num14 = Number(p14);

                    document.getElementById('total_p1').innerText = p1;
                    sum = num1+num2;
                    document.getElementById('total_p2').innerText = sum;
                    sum+=num3;
                    document.getElementById('total_p3').innerText = sum;
                    sum+=num4;
                    document.getElementById('total_p4').innerText = sum;
                    sum+=num5;
                    document.getElementById('total_p5').innerText = sum;
                    sum+=num6;
                    document.getElementById('total_p6').innerText = sum;
                    sum+=num7;
                    document.getElementById('total_p7').innerText = sum;
                    sum+=num8;
                    document.getElementById('total_p8').innerText = sum;
                    sum+=num9;
                    document.getElementById('total_p9').innerText = sum;
                    sum+=num10;
                    document.getElementById('total_p10').innerText = sum;
                    sum+=num11;
                    document.getElementById('total_p11').innerText = sum;
                    sum+=num12;
  //                  document.getElementById('total_p12').innerText = sum;
//                    sum+=num13;
                   // document.getElementById('total_p13').innerText = sum;
                    sum+=num14;
                   // document.getElementById('total_p14').innerText = sum;
		*/
        } else {
          $("#recordListing").addClass("hidden");
          //$("#errorMassage").removeClass('hidden').text("No record found!");
        }
      },
    });
  });
});
