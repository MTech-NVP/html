<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/ico" href="../../media/icons/nichivi-logo.ico">
    <title>DOM | Tube Assembly</title>
    <link rel="stylesheet" href="pnddesign.css">
</head>
<body>

    <nav>
        <div id="nav-title">
            <div id="company">
                <div>
                    <img width="35" src="../../media/icons/nichivi_logo_white.png" alt="logo">
                </div>
                <div id="company-name-container">
                    <div id="company-name">
                        NICHIVI PHILIPPINES CORPORATION
                    </div>                    
                </div>                
            </div>

            <div id="line-nav"></div>
            <div id="site-title">
                <div>
                    DOM - PRODUCTION OUTPUT AND DOWNTIME MONITORING <span>(生産管理板)</span>
                </div>
                <div id="production_line_name">
                    Loading...
                </div> 
            </div>
        </div>
        <button id="menu-toggle">☰</button>
        <div id="nav-buttons">
            <button class="nav-btns">
                Dashboard
            </button>
            <button class="nav-btns">
                History Data
            </button>
            <button class="nav-btns">
                SWP
            </button>
            <button class="nav-btns">
                Video Tutorial
            </button>
        </div>
    </nav>
    <div id="data_container">
        <div id="output_container">
            <table id="actual_output_table">
                <thead>
                    <tr>
                        <th colspan="11"> <span>PRODUCTION MONITORING</span> <button class="button-81" role="button" onclick="showDown()">Downtime</button></th>

                    </tr>
                    <tr>
                        <th colspan="5">PLAN</th>
                        <th colspan="3">ACTUAL <button onclick="showEditform()">EDIT</button> </th>
                        <th> <button onclick="show_ng_form()">ADD</button> </th>
                    </tr>
                    <tr>
                        <th>TIME</th>
                        <th>CYCLE TIME</th>
                        <th>MIN</th>
                        <th>PLAN OUTPUT/HR</th>
                        <th>TOTAL PLAN OUTPUT</th>
                        <th>ACTUAL OUTPUT/HR</th>
                        <th>TOTAL OUTPUT</th>
                        <th>ACHIEVE OUTPUT/HR</th>
                        <th>NG-QTY</th>
                    </tr>
                </thead>
                <tbody style="font-size:15px;">

                </tbody>
            </table>
        </div>


        <div id="production-table">
            <div id="plan-data-container" class="data-container">
                <table id="plan-data-table" class="data-table">
                    <tr>
                        <th colspan="4" class="actual-title">PLAN</th>
                    </tr>
                    <tr>
                        <th class="actual-header">TIME</th>
                        <th class="actual-header">CYCLE TIME</th>
                        <th class="actual-header">MINUTES</th>
                        <th class="actual-header">PLAN OUTPUT</th>
                    </tr>
                    </tr>
                    <tr>
                        <td>06:00 - 07:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>07:00 - 08:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>08:00 - 09:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>09:00 - 10:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>10:00 - 11:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>11:00 - 12:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>12:00 - 13:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>13:00 - 14:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>14:00 - 15:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>15:00 - 16:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>16:00 - 17:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>17:00 - 18:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>18:00 - 19:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>19:00 - 20:00</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>   
                </table>
            </div>
            <div id="actual-data-container" class="data-container">
                <table id="actual-data-table" class="data-table">
                    <tr>
                        <th colspan="6" class="actual-title">ACTUAL</th>
                    </tr>
                    <tr>
                        <th class="actual-header">ACTUAL OUTPUT</th>
                        <th class="actual-header">PERCENTAGE</th>
                        <th class="actual-header">TOTAL</th>
                        <th class="actual-header">DOWNTIME</th>
                        <th class="actual-header">NG QUANTITY</th>
                        <th class="actual-header">REMARKS</th>                 
                </table>
            </div>            
        </div>

        <!--<div id="downtime_container">
            <table id="downtime_data_table">
                <thead>
                    <tr>
                        <th id="downtime_title" colspan="7"> <span>DOWNTIME MONITORING</span> <button class="button-81" role="button" onclick="showProd()">Production</button></th>
                    </tr>
                    <tr>
                        <th>TIME</th>
                        <th>PROCESS</th>
                        <th>DETAILS</th>
                        <th>ACTION</th>
                        <th>DOWNTIME</th>
                        <th>PIC</th>
                        <th>REMARKS</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div> -->


    </div>
    
</body>

<script>
        const menuToggle = document.getElementById('menu-toggle');
        const navButtons = document.getElementById('nav-buttons');

        menuToggle.addEventListener('click', (event) => {
            event.stopPropagation(); 
            navButtons.classList.toggle('active');
        });

        document.addEventListener('click', (event) => {
            const isClickInsideMenu = navButtons.contains(event.target);
            const isClickOnToggle = menuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnToggle) {
            navButtons.classList.remove('active');
            }
        });

        const buttons = document.querySelectorAll('.nav-btns');
        buttons.forEach((btn) => {
            btn.addEventListener('click', () => {
            navButtons.classList.remove('active');
            });
        });

        const dashboardNames = {
            "10.0.0.189": "TUBE ASSEMBLY: C4 PRODUCTION LINE (チューブ組立：C4 生産ライン)",
            "10.0.0.102": "TUBE ASSEMBLY: C7 PRODUCTION LINE (チューブ組立：C7 生産ライン)",
            "10.0.0.136": "TUBE ASSEMBLY: C9 PRODUCTION LINE (チューブ組立：C9 生産ライン)",
            "10.0.0.125": "TUBE ASSEMBLY: C9-1 PRODUCTION LINE (チューブ組立：C9-1 生産ライン)",
            "10.0.0.164": "TUBE ASSEMBLY: C10 PRODUCTION LINE (チューブ組立：C10 生産ライン)",
            "localhost": "ADMINISTRATOR (管理者)",
            "192.168.0.228": "TUBE ASSEMBLY: C4 PRODUCTION LINE (チューブ組立：C4 生産ライン)"
        }

        const currentIP = window.location.hostname;

        const dashboardTitle = dashboardNames[currentIP] || "PRODUCTION LINE";
        
        document.addEventListener("DOMContentLoaded", function() {
            const titleSpan = document.querySelector("#production_line_name");
            if (titleSpan) {
                titleSpan.textContent = dashboardTitle;
            }
        });
</script>

</html>