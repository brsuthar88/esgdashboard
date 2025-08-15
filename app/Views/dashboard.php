<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title><!-- css -->
  <?php echo view('partials/Customercss'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--multiple {
            height: auto !important;
            min-height: 38px;
        }
        .selection{display:block;}
        .select2-container .select2-search--inline .select2-search__field{height: 22px;}
        .select2-dropdown{margin-top: -28px;}
    </style>
</head>
<body>
    <!-- Sidebar -->
    <?php $dataview = ['customerdata' => $customerdata];
    echo view('partials/Customersidebar', $dataview); 
      
    ?>
           
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Dashboard</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="dashboard.html" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>-</li>
        <li class="fw-medium"><?=$customerdata['name'];?></li>
      </ul>
    </div>
    <!-- Trigger Button -->
    <div class="card basic-data-table scrollclass">
        <div class="card-body row">
            <div class="col-md-10 row">
                <div class="col-md-6">
                    <select class="form-select multi-select1" id="eselect" multiple>
                        <option value="nonrenewablesources" data-file="uploaddocument1filenames" class="MWh">Brændsel fra ikke-vedvarende kilder </option>
                        <option value="renewablesources" data-file="uploaddocument1filenames" class="MWh">Brændsel fra vedvarende kilder </option>
                        <option value="Electricitynonrenewablesources" data-file="uploaddocument1filenames" class="MWh">Elektricitet fra ikke-vedvarende kilder</option>
                        <option value="Electricityrenewablesources" data-file="uploaddocument1filenames" class="MWh">Elektricitet fra vedvarende kilder </option>
                        <option value="CO2eemissionsScope1" data-file="uploaddocument1filenames" class="Ton">CO2e-udledning inden for scope 1</option>
                        <option value="CO2eemissionsScope2" data-file="uploaddocument1filenames" class="Ton">CO2e-udledning inden for scope 2 (lokationsbaseret) </option>
                        <option value="totalOfScope1and2" data-file="uploaddocument1filenames" class="Ton">Total scope 1 og scope 2 CO₂e udledninger (lokationsbaseret) </option>
                        <option value="CO2eIntensity" data-file="uploaddocument1filenames" class="Ton">CO2e-intensitet </option>
                       <!-- <option class="opennew" value="getDataFromSubOne">Tilføj forureningstyper herunder </option>
                        <option class="opennew" value="getDataFromSubTwo">Tilføj lokationener for områderne herunder</option>
                        <option value="dropdown14|areaUser1|dropdown15|areaUser2">Arealforbrug  </option>
                        <option value="dropdown17E|areaUser4|dropdown16|areaUser3">Befæstet område </option>
                        <option value="dropdown19E|constructionArea2|dropdown18E|constructionArea1">Naturorienteret område på anlægsområdet  </option>
                        <option value="dropdown21|constructionArea4|dropdown20|constructionArea3">Naturorienteret område uden for anlægsområdet </option>
                        <option value="outletCombined">Vandudtag - samlet for alle lokationer</option>
                        <option value="locationsE">Vandudtag - fra lokationer i områder med mangel på vand (højt vandstress) </option>
                        <option value="waterOutlet|collectedRainwater|waterDischarge">Vandforbrug - samlet for alle lokationer </option>
                        <option value="waterWithdrawal|collectedRainwater2|waterDischarge2">Vandforbrug - fra lokationer i områder med mangel på vand (højt vandstress) </option>
                        <option value="input60">Hvordan arbejder I med minimering af affald og forurening? </option>
                        <option value="input61">Hvordan arbejder I med regenerering af naturen i områder hvor virksomheden har påvirket miljøet, dyrelivet mv.? </option>
                        <option value="input62">Hvordan arbejder i med cirkulering af produkter og materialer?</option>
                        <option class="opennew" value="getDataFromSubThree">Tilføj produkter af ikke-farligt affald </option>
                        <option class="opennew" value="getDataFromSubFour">Tilføj produkter af farligt affald  </option>
                        <option class="opennew" value="getDatFromSubFiveE">Tilføj materiale her   </option>-->
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select multi-select2" multiple
                        <option value="B">Beta</option>
                        <option value="C">Gamma</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select multi-select3" multiple>
                        <option value="Y">Yankee</option>
                        <option value="Z">Zulu</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select multi-select4" multiple>
                        <option value="Blue">Blue</option>
                        <option value="Green">Green</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="date" id="startDate" class="form-control" placeholder="Start Date" value="<?= date('Y-m-d') ?>">
                </div>
                <div class="col-md-6">
                    <input type="date" id="endDate" class="form-control" placeholder="End Date" value="<?= date('Y-m-d') ?>">
                </div>
            </div>
            <div class="col-md-2 row">
                <div class="col-md-12">
                    <button class="btn btn-info" type="button" id="viewresult">View Result</button>
                </div>
                <div class="col-md-12">
                    <!-- Bootstrap 5 example -->
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" id="downloadMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        Download
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="downloadMenu">
                        <li><a class="dropdown-item" href="#" id="downloadExcel">Download Excel</a></li>
                        <li><a class="dropdown-item" href="#" id="downloadPDF">Download VSME Report</a></li>
                        <li><a class="dropdown-item" href="#" id="downloadPDF">Download Graph</a></li>
                      </ul>
                    </div>
        
                </div>
            </div>
        </div>
        <div id="cardresult" class="card-body row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4  my-4"></div>
        <div id="cardgraph" class="card-body row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4 my-4"></div>
        <div id="cardgraphbar1" class="card-body row row-cols-xxxl-12 row-cols-lg-12 row-cols-sm-12 row-cols-1 gy-4 my-4"></div>
        <div id="cardgraphbar" class="card-body row row-cols-xxxl-12 row-cols-lg-12 row-cols-sm-12 row-cols-1 gy-4 my-4"></div>
    </div>
</div>
  <!-- footer -->
  <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.multi-select1').select2({
            placeholder: "Choose E",
            width: '100%'
        });
        $('.multi-select2').select2({
            placeholder: "Choose S",
            width: '100%'
        });
        $('.multi-select3').select2({
            placeholder: "Choose G",
            width: '100%'
        });
        $('.multi-select4').select2({
            placeholder: "Choose A",
            width: '100%'
        });
    });
</script>
<script>
document.getElementById("downloadExcel").addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "/path/to/your-excel-file.xlsx"; // Replace with your file path
});

document.getElementById("downloadPDF").addEventListener("click", function (e) {
    e.preventDefault();
    window.location.href = "/path/to/your-pdf-file.pdf"; // Replace with your file path
});
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let chartInstances = {}; // store chart objects so we can destroy them

document.getElementById("viewresult").addEventListener("click", function () {
    let select = document.getElementById("eselect");
    let selectedValues = Array.from(select.selectedOptions).map(option => ({
        value: option.value,
        file: option.dataset.file
    }));

    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;
    $.ajax({
        url: "/getfilterdata",
        type: "POST",
         data: { 
            formats: selectedValues,
            startDate: startDate,
            endDate: endDate
        },
        success: function (response) {
            // Clear previous UI
            $("#cardresult").empty();
            $("#cardgraph").empty();
            $("#cardgraphbar").empty();
            $("#cardgraphbar1").empty();

            // ===== Average calculation =====
            let keysSum = {}, keysCount = {};
            response.forEach(item => {
                for (let key in item) {
                    if (key !== "email" && key !== "s_id" && !isNaN(parseFloat(item[key]))) {
                        keysSum[key] = (keysSum[key] || 0) + parseFloat(item[key]);
                        keysCount[key] = (keysCount[key] || 0) + 1;
                    }
                }
            });

            let averages = {};
            for (let key in keysSum) {
                averages[key] = (keysSum[key] / keysCount[key]).toFixed(2);
            }

            // ===== Card UI rendering =====
            let html = "";
            const stylePairs = [
                { gradient: 'bg-gradient-start-1', color: 'bg-cyan' },
                { gradient: 'bg-gradient-start-2', color: 'bg-2' },
                { gradient: 'bg-gradient-start-3', color: 'bg-info-900' },
                { gradient: 'bg-gradient-start-4', color: 'bg-success-main' },
                { gradient: 'bg-gradient-start-5', color: 'bg-red' },
                { gradient: 'bg-gradient-start-6', color: 'bg-warning-800' }
            ];

            for (let key in averages) {
                let value = parseFloat(averages[key]);
                let randomStyle = stylePairs[Math.floor(Math.random() * stylePairs.length)];
                let iconHTML = "";

                if (value < 0) {
                    iconHTML = `<div class="w-50-px h-50-px ${randomStyle.color} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mdi:trending-down" class="text-white text-2xl"></iconify-icon>
                    </div>`;
                } else if (value > 0) {
                    iconHTML = `<div class="w-50-px h-50-px ${randomStyle.color} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mdi:trending-up" class="text-white text-2xl"></iconify-icon>
                    </div>`;
                } else {
                    iconHTML = `<div class="w-50-px h-50-px ${randomStyle.color} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="material-symbols:horizontal-rule" class="text-white text-2xl"></iconify-icon>
                    </div>`;
                }

                let optionText = $(`#eselect option[value="${key}"]`).text();
                html += `
                    <div class="col" data-bs-toggle="modal" data-bs-target="#myModal">
                        <div class="card shadow-none border ${randomStyle.gradient} h-100">
                            <div class="card-body p-20">
                                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                    <div style="width: 75%;">
                                        <p class="fw-medium text-primary-light mb-1"><b style="text-transform: capitalize;">${optionText}</b></p>
                                        <h6 class="mb-0">${value}</h6>
                                        <p style="font-size: 12px; display: inline-flex; align-items: center; gap: 4px;margin-bottom:0px">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" 
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                                                class="lucide lucide-file-text">
                                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"></path>
                                                <path d="M14 2v4a2 2 0 0 0 2 2h4"></path>
                                                <path d="M10 9H8"></path>
                                                <path d="M16 13H8"></path>
                                                <path d="M16 17H8"></path>
                                            </svg>
                                            E - Environmental
                                        </p>
                                        <span style="font-size:10px;display:block">Total supplier is <b>${response.length}</b></span>
                                    </div>
                                    ${iconHTML}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
            $("#cardresult").html(html);

            // ===== Pie charts =====
            let numericKeys = Object.keys(response[0]).filter(
                key => key !== "email" && key !== "s_id" && !isNaN(parseFloat(response[0][key]))
            );

            numericKeys.forEach(key => {
                let chartId = `${key}Chart`;
                let optionText = $(`#eselect option[value="${key}"]`).text();
                $("#cardgraph").append(`
                    <div class="col-12 col-md-4 text-center">
                        <h6 style="text-transform: capitalize; margin-bottom: 10px;font-size: 14px !important;">${optionText}</h6>
                        <div style="width:150px; height:150px; margin:0 auto;">
                            <canvas id="${chartId}"></canvas>
                        </div>
                        <div class="mt-2" id="${chartId}-labels"></div>
                    </div>
                `);

                if (chartInstances[chartId]) chartInstances[chartId].destroy();

                const labels = response.map(item => `Supplier ${item.s_id}`);
                const emails = response.map(item => item.email);
                const dataValues = response.map(item => parseFloat(item[key]));
                const colors = dataValues.map(() => `hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`);

                let emailHtml = emails.map((email, i) => {
                    return `<div style="font-size: 12px; color: ${colors[i]}; font-weight: 500;">
                                ${labels[i]} - ${email} (${dataValues[i]})
                            </div>`;
                }).join("");
                $(`#${chartId}-labels`).html(emailHtml);

                chartInstances[chartId] = new Chart(document.getElementById(chartId), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: key,
                            data: dataValues,
                            backgroundColor: colors,
                            borderColor: '#fff',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        let idx = context.dataIndex;
                                        return `${labels[idx]} (${emails[idx]}): ${context.parsed}`;
                                    }
                                }
                            }
                        }
                    }
                });
            });

            // ===== Per-supplier values chart =====
            let totalYes = 0, totalNo = 0;

            response.forEach(supplier => {
                let valuesChartId = `supplierValues_${supplier.s_id}`;
                $("#cardgraphbar1").append(`
                    <div class="col-12 col-md-6 text-center mb-4">
                        <h6 style="margin-bottom: 10px; font-size: 14px !important;">
                            Supplier ${supplier.s_id} - ${supplier.email}
                        </h6>
                        <div style="width: 100%; height: 300px;">
                            <canvas id="${valuesChartId}"></canvas>
                        </div>
                    </div>
                `);

                if (chartInstances[valuesChartId]) chartInstances[valuesChartId].destroy();

                let chartLabels = [];
                let chartValues = [];
                let chartColors = [];

                selectedValues.forEach(item => {
                    let optionText = $(`#eselect option[value="${item.value}"]`).text();
                    chartLabels.push(optionText);
                    chartValues.push(parseFloat(supplier[item.value]) || 0);
                    chartColors.push(`hsl(${Math.floor(Math.random() * 360)}, 70%, 50%)`);
                });

                chartInstances[valuesChartId] = new Chart(document.getElementById(valuesChartId), {
                    type: 'bar',
                    data: {
                        labels: chartLabels,
                        datasets: [{
                            label: 'Values',
                            data: chartValues,
                            backgroundColor: chartColors
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });

                // Count Yes / No for combined chart
                if (supplier.uploaddocument1filenames && supplier.uploaddocument1filenames.trim() !== "") {
                    totalYes++;
                } else {
                    totalNo++;
                }
            });

            // ===== Single combined Yes/No chart =====
            let combinedChartId = "combinedYesNoChart";
            $("#cardgraphbar").append(`
                <div class="col-12 text-center mb-4">
                    <h6 style="margin-bottom: 10px; font-size: 14px !important;">
                        Document Upload Status (All Suppliers)
                    </h6>
                    <div style="width: 100%; height: 300px;">
                        <canvas id="${combinedChartId}"></canvas>
                    </div>
                </div>
            `);

            if (chartInstances[combinedChartId]) chartInstances[combinedChartId].destroy();

            chartInstances[combinedChartId] = new Chart(document.getElementById(combinedChartId), {
                type: 'bar',
                data: {
                    labels: ["Yes", "No"],
                    datasets: [{
                        label: 'Document Uploaded',
                        data: [totalYes, totalNo],
                        backgroundColor: ["#4CAF50", "#F44336"]
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, stepSize: 1 } }
                }
            });
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});
</script>
</body>
</html>