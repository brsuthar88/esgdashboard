<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('salesperson/partials/Sellercss'); ?>

    <!-- Select2 CSS -->
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
    <?php $dataview = ['sellerdata' => $sellerdata,];
    echo view('salesperson/partials/Sellersidebar', $dataview);
    ?>
           
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Dashboard</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/supplier" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Supplier</li>
      </ul>
    </div>
<div class="card basic-data-table scrollclass">
      <div class="card-body row">
 <div class="col-md-2">
            <select class="form-select multi-select1" id="eselect" multiple>
                <option value="nonrenewablesources" class="MWh">Brændsel fra ikke-vedvarende kilder </option>
                <option value="renewablesources" class="MWh">Brændsel fra vedvarende kilder </option>
                <option value="Electricitynonrenewablesources" class="MWh">Elektricitet fra ikke-vedvarende kilder</option>
                <option value="Electricityrenewablesources" class="MWh">Elektricitet fra vedvarende kilder </option>
                <option value="CO2eemissionsScope1" class="Ton">CO2e-udledning inden for scope 1</option>
                <option value="CO2eemissionsScope2" class="Ton">CO2e-udledning inden for scope 2 (lokationsbaseret) </option>
                <option value="totalOfScope1and2" class="Ton">Total scope 1 og scope 2 CO₂e udledninger (lokationsbaseret) </option>
                <option value="CO2eIntensity" class="Ton">CO2e-intensitet </option>
                <option class="opennew" value="getDataFromSubOne">Tilføj forureningstyper herunder </option>
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
                <option class="opennew" value="getDatFromSubFiveE">Tilføj materiale her   </option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select multi-select2" multiple
                <option value="B">Beta</option>
                <option value="C">Gamma</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select multi-select3" multiple>
                <option value="Y">Yankee</option>
                <option value="Z">Zulu</option>
            </select>
        </div>
        <div class="col-md-2">
            <select class="form-select multi-select4" multiple>
                <option value="Blue">Blue</option>
                <option value="Green">Green</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-info" type="button" id="viewresult">View Result</button>
        </div>
        <div class="col-md-2">
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
        <div id="cardresult" class="card-body row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4  my-4">
        </div>
        <div id="cardgraph" class="card-body row row-cols-xxxl-5 row-cols-lg-3 row-cols-sm-2 row-cols-1 gy-4  my-4">
        </div>
</div>
</div>
  <!-- footer -->
  <?php echo view('salesperson/partials/Sellerfooter'); ?>

  <!-- JS -->
  <?php echo view('salesperson/partials/Sellerjs'); ?>

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
<script>
document.getElementById("viewresult").addEventListener("click", function () {
    let select = document.getElementById("eselect");
    let selectedValues = Array.from(select.selectedOptions).map(option => option.value);
     $.ajax({
            url: "/supplier/getfilterdata",       // Your backend file
            type: "POST",
            data: { formats: selectedValues }, // formats[] array
            success: function (data) {
           $("#cardresult").empty();

    let html = "";
    const stylePairs = [
        { gradient: 'bg-gradient-start-1', color: 'bg-cyan' },
        { gradient: 'bg-gradient-start-2', color: 'bg-2' },
        { gradient: 'bg-gradient-start-3', color: 'bg-info-900' },
        { gradient: 'bg-gradient-start-4', color: 'bg-success-main' },
        { gradient: 'bg-gradient-start-5', color: 'bg-red' },
        { gradient: 'bg-gradient-start-6', color: 'bg-warning-800' }
    ];
console.error(data);
    data.forEach(obj => {
        for (let key in obj) {
            let value = parseFloat(obj[key]);

            // Pick matched gradient + circle color
            let randomStyle = stylePairs[Math.floor(Math.random() * stylePairs.length)];
            let randomGradient = randomStyle.gradient;
            let randomColor = randomStyle.color;

            let iconHTML = "";
            if (value < 0) {
                iconHTML = `
                    <div class="w-50-px h-50-px ${randomColor} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mdi:trending-down" class="text-white text-2xl"></iconify-icon>
                    </div>
                `;
            } else if (value > 0) {
                iconHTML = `
                    <div class="w-50-px h-50-px ${randomColor} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="mdi:trending-up" class="text-white text-2xl"></iconify-icon>
                    </div>
                `;
            } else {
                iconHTML = `
                    <div class="w-50-px h-50-px ${randomColor} rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="material-symbols:horizontal-rule" class="text-white text-2xl"></iconify-icon>
                    </div>
                `;
            }

            html += `
                <div class="col" data-bs-toggle="modal" data-bs-target="#myModal">
                    <div class="card shadow-none border ${randomGradient} h-100">
                        <div class="card-body p-20">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                                <div>
                                    <p class="fw-medium text-primary-light mb-1"><b style="text-transform: capitalize;">${key}</b></p>
                                    <h6 class="mb-0">${value}</h6>
                                    <p style="font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
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
                                </div>
                                ${iconHTML}
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    });

    $("#cardresult").html(html);


            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
});
</script>
</body>
</html>