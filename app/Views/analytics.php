<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>
<!-- css -->
  <?php echo view('partials/Customercss'); ?>
<style type="text/css">
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}

.select2-container--default .select2-selection--single{
    height: 2.75rem !important;
  border: 1px solid var(--input-form-light);
  color: var(--text-primary-light) !important;
  background-color: var(--white);
  padding: 0.5625rem 1.25rem;
  display: block;
  width: 100%;
  padding: .375rem .75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5 !important;
  color: var(--bs-body-color);
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color) !important;
  border-radius: var(--bs-border-radius) !important;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.select2-container--default .selection{
     width:100%;
 }
 .select2-container--default .select2-selection--single .select2-selection__arrow{
     height: 2.75rem !important;
       line-height: 1.5 !important;
 }
.disabled {
    cursor: not-allowed;
    opacity: 0.5; /* Makes it look disabled */
    pointer-events: none; /* Prevents clicks */
}
 .card-box {
      background: white;
      border-radius: 10px;
      padding: 24px;
      box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
      margin-bottom: 24px;
    }
    .dashed-box {
      border: 2px dashed #ccc;
      padding: 2rem;
      text-align: center;
      border-radius: 0.5rem;
      background: #f9fafb;
    }
    .tile-box {
      border: 1px solid #dee2e6;
      border-radius: 0.375rem;
      padding: 0.75rem 1rem;
      background-color: #f8f9fa;
      margin-bottom: 0.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .preview-tile {
      height: 56px;
      background-color: #f1f5f9;
      border-radius: 0.5rem;
      margin-bottom: 0.5rem;
    }
</style>
<style>
    .insight-card {
      border-radius: 12px;
      padding: 20px;
      height: 100%;
    }
    .insight-icon {
      font-size: 1.5rem;
      margin-right: 8px;
    }
    .text-green { color: #15803d; }
    .text-orange { color: #92400e; }
    .text-blue { color: #1d4ed8; }
    .text-purple { color: #7e22ce; }
    .bg-light-green { background-color: #ecfdf5; }
    .bg-light-orange { background-color: #fffbeb; }
    .bg-light-blue { background-color: #eff6ff; }
    .bg-light-purple { background-color: #f5f3ff; }
  </style>
</head>
<body>
      <!-- Sidebar -->
    <?php $dataview = ['sellerdata' => $sellerdata];
echo view('partials/Customersidebar', $dataview);

?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Advanced Analytics</h6>
       <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard </a> </li>
        <li>-</li>
        <li class="fw-medium">Analytics</li>
      </ul>
    </div>
    
    <div class="card h-100 p-0 radius-12 mb-20">
      <div class="card-body">
      <div class="row row-cols-xxxl-4 row-cols-lg-4 row-cols-sm-4 row-cols-1 gy-4">
      <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
          <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div>
                <p class="fw-medium mb-1  text-cyan">Total Reduction</p>
                <h6 class="mb-0  text-cyan">28.8%</h6>
              </div>
              <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                <iconify-icon icon="mdi:trending-down" class="text-white text-2xl mb-0"></iconify-icon>
              </div>
            </div>
            <p class="fw-medium text-sm text-cyan mt-12 mb-0 d-flex align-items-center gap-2">
              <span class="d-inline-flex align-items-center gap-1 text-cyan"></span>
              vs last year
            </p>
          </div>
        </div><!-- card end -->
      </div>
      <div class="col">
        <div class="card shadow-none border bg-gradient-start-2 h-100">
          <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div>
                <p class="fw-medium text-purple mb-1">Suppliers Tracked</p>
                <h6 class="mb-0 text-purple">24</h6>
              </div>
              <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                <iconify-icon icon="hugeicons:building-02" class="text-white text-2xl mb-0"></iconify-icon>
              </div>
            </div>
            <p class="fw-medium text-sm text-purple mt-12 mb-0 d-flex align-items-center gap-2">
              <span class="d-inline-flex align-items-center gap-1 text-purple"></span> 
              across 5 regions
            </p>
          </div>
        </div><!-- card end -->
      </div>
      <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
          <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div>
                <p class="fw-medium text-success-main mb-1">Target Achievement</p>
                <h6 class="mb-0 text-success-main">87</h6>
              </div>
              <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-target h-8 w-8 text-white"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
              </div>
            </div>
            <p class="fw-medium text-sm text-success-main mt-12 mb-0 d-flex align-items-center gap-2">
              <span class="d-inline-flex align-items-center gap-1 text-success-main"></span> 
              on track
            </p>
          </div>
        </div><!-- card end -->
      </div>
     <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
          <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
              <div>
                <p class="fw-medium text-danger mb-1">Industry Ranking</p>
                <h6 class="mb-0 text-danger">Top 15%</h6>
              </div>
              <div class="w-50-px h-50-px bg-danger rounded-circle d-flex justify-content-center align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-award h-8 w-8 text-white"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>
              </div>
            </div>
            <p class="fw-medium text-sm text-danger mt-12 mb-0 d-flex align-items-center gap-2">
              <span class="d-inline-flex align-items-center gap-1 text-success-main"></span> 
              in sector
            </p>
          </div>
        </div><!-- card end -->
      </div>
    </div>
    
    <div class="row my-4 gy-4">
            <div class="col-md-6">
                <div class="card h-100 p-0">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Emissions Trend Analysis</h6>
                    </div>
                    <div class="card-body p-24">
                        <div id="zoomAbleLineChart" style="min-height: 279px;"><div id="apexchartseyy5i3kk" class="apexcharts-canvas apexchartseyy5i3kk apexcharts-theme-light" style="width: 547px; height: 264px;"><svg id="SvgjsSvg1803" width="547" height="264" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="547" height="264"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 132px;"></div></foreignObject><rect id="SvgjsRect1808" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG1891" class="apexcharts-yaxis" rel="0" transform="translate(36.75, 0)"><g id="SvgjsG1892" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1894" font-family="Helvetica, Arial, sans-serif" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1895">$100k</tspan><title>$100k</title></text><text id="SvgjsText1897" font-family="Helvetica, Arial, sans-serif" x="20" y="70.1224" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1898">$80k</tspan><title>$80k</title></text><text id="SvgjsText1900" font-family="Helvetica, Arial, sans-serif" x="20" y="108.7448" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1901">$60k</tspan><title>$60k</title></text><text id="SvgjsText1903" font-family="Helvetica, Arial, sans-serif" x="20" y="147.3672" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1904">$40k</tspan><title>$40k</title></text><text id="SvgjsText1906" font-family="Helvetica, Arial, sans-serif" x="20" y="185.9896" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1907">$20k</tspan><title>$20k</title></text><text id="SvgjsText1909" font-family="Helvetica, Arial, sans-serif" x="20" y="224.612" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1910">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG1805" class="apexcharts-inner apexcharts-graphical" transform="translate(54.75, 30)"><defs id="SvgjsDefs1804"><clipPath id="gridRectMaskeyy5i3kk"><rect id="SvgjsRect1810" width="495.3583333492279" height="197.112" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskeyy5i3kk"></clipPath><clipPath id="nonForecastMaskeyy5i3kk"></clipPath><clipPath id="gridRectMarkerMaskeyy5i3kk"><rect id="SvgjsRect1811" width="491.3583333492279" height="197.112" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1816" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1817" stop-opacity="0.6" stop-color="rgba(72,127,255,0.6)" offset="0"></stop><stop id="SvgjsStop1818" stop-opacity="0.3" stop-color="#487fff00" offset="1"></stop><stop id="SvgjsStop1819" stop-opacity="0.3" stop-color="#487fff00" offset="1"></stop></linearGradient></defs><line id="SvgjsLine1809" x1="0" y1="0" x2="0" y2="193.112" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="193.112" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine1826" x1="0" y1="194.112" x2="0" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1827" x1="40.61319444576899" y1="194.112" x2="40.61319444576899" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1828" x1="81.22638889153798" y1="194.112" x2="81.22638889153798" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1829" x1="121.83958333730698" y1="194.112" x2="121.83958333730698" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1830" x1="162.45277778307596" y1="194.112" x2="162.45277778307596" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1831" x1="203.06597222884494" y1="194.112" x2="203.06597222884494" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1832" x1="243.67916667461392" y1="194.112" x2="243.67916667461392" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1833" x1="284.2923611203829" y1="194.112" x2="284.2923611203829" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1834" x1="324.9055555661519" y1="194.112" x2="324.9055555661519" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1835" x1="365.51875001192093" y1="194.112" x2="365.51875001192093" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1836" x1="406.13194445768994" y1="194.112" x2="406.13194445768994" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1837" x1="446.74513890345895" y1="194.112" x2="446.74513890345895" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1838" x1="487.35833334922796" y1="194.112" x2="487.35833334922796" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1822" class="apexcharts-grid"><g id="SvgjsG1823" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1840" x1="0" y1="38.6224" x2="487.3583333492279" y2="38.6224" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1841" x1="0" y1="77.2448" x2="487.3583333492279" y2="77.2448" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1842" x1="0" y1="115.8672" x2="487.3583333492279" y2="115.8672" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1843" x1="0" y1="154.4896" x2="487.3583333492279" y2="154.4896" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1824" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine1846" x1="0" y1="193.112" x2="487.3583333492279" y2="193.112" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine1845" x1="0" y1="1" x2="0" y2="193.112" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1812" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1813" class="apexcharts-series" seriesName="ThisxDay" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath1820" d="M 0 193.112 L 0 169.93856 L 40.613194445769 158.35183999999998 L 81.226388891538 169.93856 L 121.83958333730698 100.41823999999998 L 162.452777783076 158.35183999999998 L 203.06597222884497 135.17839999999998 L 243.67916667461395 158.35183999999998 L 284.29236112038296 164.1452 L 324.905555566152 23.17343999999997 L 365.51875001192093 115.86719999999998 L 406.13194445768994 67.58919999999999 L 446.74513890345895 146.76512 L 487.3583333492279 100.41823999999998 L 487.3583333492279 193.112M 487.3583333492279 100.41823999999998z" fill="url(#SvgjsLinearGradient1816)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskeyy5i3kk)" pathTo="M 0 193.112 L 0 169.93856 L 40.613194445769 158.35183999999998 L 81.226388891538 169.93856 L 121.83958333730698 100.41823999999998 L 162.452777783076 158.35183999999998 L 203.06597222884497 135.17839999999998 L 243.67916667461395 158.35183999999998 L 284.29236112038296 164.1452 L 324.905555566152 23.17343999999997 L 365.51875001192093 115.86719999999998 L 406.13194445768994 67.58919999999999 L 446.74513890345895 146.76512 L 487.3583333492279 100.41823999999998 L 487.3583333492279 193.112M 487.3583333492279 100.41823999999998z" pathFrom="M -1 193.112 L -1 193.112 L 40.613194445769 193.112 L 81.226388891538 193.112 L 121.83958333730698 193.112 L 162.452777783076 193.112 L 203.06597222884497 193.112 L 243.67916667461395 193.112 L 284.29236112038296 193.112 L 324.905555566152 193.112 L 365.51875001192093 193.112 L 406.13194445768994 193.112 L 446.74513890345895 193.112 L 487.3583333492279 193.112"></path><path id="SvgjsPath1821" d="M 0 169.93856 L 40.613194445769 158.35183999999998 L 81.226388891538 169.93856 L 121.83958333730698 100.41823999999998 L 162.452777783076 158.35183999999998 L 203.06597222884497 135.17839999999998 L 243.67916667461395 158.35183999999998 L 284.29236112038296 164.1452 L 324.905555566152 23.17343999999997 L 365.51875001192093 115.86719999999998 L 406.13194445768994 67.58919999999999 L 446.74513890345895 146.76512 L 487.3583333492279 100.41823999999998" fill="none" fill-opacity="1" stroke="#487fff" stroke-opacity="1" stroke-linecap="round" stroke-width="4" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMaskeyy5i3kk)" pathTo="M 0 169.93856 L 40.613194445769 158.35183999999998 L 81.226388891538 169.93856 L 121.83958333730698 100.41823999999998 L 162.452777783076 158.35183999999998 L 203.06597222884497 135.17839999999998 L 243.67916667461395 158.35183999999998 L 284.29236112038296 164.1452 L 324.905555566152 23.17343999999997 L 365.51875001192093 115.86719999999998 L 406.13194445768994 67.58919999999999 L 446.74513890345895 146.76512 L 487.3583333492279 100.41823999999998" pathFrom="M -1 193.112 L -1 193.112 L 40.613194445769 193.112 L 81.226388891538 193.112 L 121.83958333730698 193.112 L 162.452777783076 193.112 L 203.06597222884497 193.112 L 243.67916667461395 193.112 L 284.29236112038296 193.112 L 324.905555566152 193.112 L 365.51875001192093 193.112 L 406.13194445768994 193.112 L 446.74513890345895 193.112 L 487.3583333492279 193.112" fill-rule="evenodd"></path><g id="SvgjsG1814" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle1914" r="0" cx="0" cy="0" class="apexcharts-marker wnwva2fyg no-pointer-events" stroke="#ffffff" fill="#487fff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG1815" class="apexcharts-datalabels" data:realIndex="0"></g></g><g id="SvgjsG1825" class="apexcharts-grid-borders"><line id="SvgjsLine1839" x1="0" y1="0" x2="487.3583333492279" y2="0" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1844" x1="0" y1="193.112" x2="487.3583333492279" y2="193.112" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1890" x1="0" y1="194.112" x2="487.3583333492279" y2="194.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><line id="SvgjsLine1847" x1="0" y1="0" x2="487.3583333492279" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1848" x1="0" y1="0" x2="487.3583333492279" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1849" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1850" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1852" font-family="Helvetica, Arial, sans-serif" x="0" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1853">Jan</tspan><title>Jan</title></text><text id="SvgjsText1855" font-family="Helvetica, Arial, sans-serif" x="40.613194445769" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1856">Feb</tspan><title>Feb</title></text><text id="SvgjsText1858" font-family="Helvetica, Arial, sans-serif" x="81.22638889153798" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1859">Mar</tspan><title>Mar</title></text><text id="SvgjsText1861" font-family="Helvetica, Arial, sans-serif" x="121.83958333730696" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1862">Apr</tspan><title>Apr</title></text><text id="SvgjsText1864" font-family="Helvetica, Arial, sans-serif" x="162.45277778307593" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1865">May</tspan><title>May</title></text><text id="SvgjsText1867" font-family="Helvetica, Arial, sans-serif" x="203.0659722288449" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1868">Jun</tspan><title>Jun</title></text><text id="SvgjsText1870" font-family="Helvetica, Arial, sans-serif" x="243.67916667461392" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1871">Jul</tspan><title>Jul</title></text><text id="SvgjsText1873" font-family="Helvetica, Arial, sans-serif" x="284.29236112038296" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1874">Aug</tspan><title>Aug</title></text><text id="SvgjsText1876" font-family="Helvetica, Arial, sans-serif" x="324.905555566152" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1877">Sep</tspan><title>Sep</title></text><text id="SvgjsText1879" font-family="Helvetica, Arial, sans-serif" x="365.518750011921" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1880">Oct</tspan><title>Oct</title></text><text id="SvgjsText1882" font-family="Helvetica, Arial, sans-serif" x="406.13194445769" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1883">Nov</tspan><title>Nov</title></text><text id="SvgjsText1885" font-family="Helvetica, Arial, sans-serif" x="446.745138903459" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1886">Dec</tspan><title>Dec</title></text><text id="SvgjsText1888" font-family="Helvetica, Arial, sans-serif" x="487.358333349228" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan1889"></tspan><title></title></text></g></g><g id="SvgjsG1911" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1912" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1913" class="apexcharts-point-annotations"></g><rect id="SvgjsRect1915" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect1916" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 p-0">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Supplier Performance Matrix</h6>
                    </div>
                    <div class="card-body p-24">
                        <div id="doubleLineChart" style="min-height: 279px;"><div id="apexchartsda3cbv3u" class="apexcharts-canvas apexchartsda3cbv3u apexcharts-theme-light" style="width: 547px; height: 264px;"><svg id="SvgjsSvg2056" width="547" height="264" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="547" height="264"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 132px;"></div></foreignObject><rect id="SvgjsRect2061" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect><g id="SvgjsG2139" class="apexcharts-yaxis" rel="0" transform="translate(28.9666748046875, 0)"><g id="SvgjsG2140" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2142" font-family="Helvetica, Arial, sans-serif" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2143">$50k</tspan><title>$50k</title></text><text id="SvgjsText2145" font-family="Helvetica, Arial, sans-serif" x="20" y="70.1224" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2146">$40k</tspan><title>$40k</title></text><text id="SvgjsText2148" font-family="Helvetica, Arial, sans-serif" x="20" y="108.7448" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2149">$30k</tspan><title>$30k</title></text><text id="SvgjsText2151" font-family="Helvetica, Arial, sans-serif" x="20" y="147.3672" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2152">$20k</tspan><title>$20k</title></text><text id="SvgjsText2154" font-family="Helvetica, Arial, sans-serif" x="20" y="185.9896" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2155">$10k</tspan><title>$10k</title></text><text id="SvgjsText2157" font-family="Helvetica, Arial, sans-serif" x="20" y="224.612" text-anchor="end" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2158">$0k</tspan><title>$0k</title></text></g></g><g id="SvgjsG2058" class="apexcharts-inner apexcharts-graphical" transform="translate(46.9666748046875, 30)"><defs id="SvgjsDefs2057"><clipPath id="gridRectMaskda3cbv3u"><rect id="SvgjsRect2063" width="494.58332538604736" height="197.112" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskda3cbv3u"></clipPath><clipPath id="nonForecastMaskda3cbv3u"></clipPath><clipPath id="gridRectMarkerMaskda3cbv3u"><rect id="SvgjsRect2064" width="490.58332538604736" height="197.112" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><line id="SvgjsLine2062" x1="0" y1="0" x2="0" y2="193.112" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="193.112" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line><line id="SvgjsLine2078" x1="0" y1="194.112" x2="0" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2079" x1="44.23484776236794" y1="194.112" x2="44.23484776236794" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2080" x1="88.46969552473588" y1="194.112" x2="88.46969552473588" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2081" x1="132.70454328710383" y1="194.112" x2="132.70454328710383" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2082" x1="176.93939104947177" y1="194.112" x2="176.93939104947177" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2083" x1="221.1742388118397" y1="194.112" x2="221.1742388118397" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2084" x1="265.40908657420766" y1="194.112" x2="265.40908657420766" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2085" x1="309.6439343365756" y1="194.112" x2="309.6439343365756" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2086" x1="353.8787820989436" y1="194.112" x2="353.8787820989436" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2087" x1="398.11362986131155" y1="194.112" x2="398.11362986131155" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2088" x1="442.3484776236795" y1="194.112" x2="442.3484776236795" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine2089" x1="486.5833253860475" y1="194.112" x2="486.5833253860475" y2="200.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG2074" class="apexcharts-grid"><g id="SvgjsG2075" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine2091" x1="0" y1="38.6224" x2="486.58332538604736" y2="38.6224" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2092" x1="0" y1="77.2448" x2="486.58332538604736" y2="77.2448" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2093" x1="0" y1="115.8672" x2="486.58332538604736" y2="115.8672" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2094" x1="0" y1="154.4896" x2="486.58332538604736" y2="154.4896" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG2076" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine2097" x1="0" y1="193.112" x2="486.58332538604736" y2="193.112" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2096" x1="0" y1="1" x2="0" y2="193.112" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG2065" class="apexcharts-line-series apexcharts-plot-series"><g id="SvgjsG2066" class="apexcharts-series" seriesName="ThisxDay" data:longestSeries="true" rel="1" data:realIndex="0"><path id="SvgjsPath2069" d="M 0 162.21408C 15.482196716828778 162.21408 28.752651045539164 135.17839999999998 44.23484776236794 135.17839999999998C 59.717044479196716 135.17839999999998 72.9874988079071 158.35183999999998 88.46969552473588 158.35183999999998C 103.95189224156466 158.35183999999998 117.22234657027505 115.86719999999998 132.70454328710383 115.86719999999998C 148.1867400039326 115.86719999999998 161.45719433264298 154.4896 176.93939104947177 154.4896C 192.42158776630055 154.4896 205.69204209501092 65.65807999999998 221.1742388118397 65.65807999999998C 236.65643552866848 65.65807999999998 249.92688985737888 142.90287999999998 265.40908657420766 142.90287999999998C 280.8912832910364 142.90287999999998 294.1617376197468 108.14271999999998 309.64393433657557 108.14271999999998C 325.1261310534044 108.14271999999998 338.3965853821147 162.21408 353.87878209894353 162.21408C 369.3609788157723 162.21408 382.6314331444827 127.45392 398.11362986131144 127.45392C 413.59582657814025 127.45392 426.8662809068506 154.4896 442.3484776236794 154.4896C 457.8306743405082 154.4896 471.10112866921855 135.17839999999998 486.58332538604736 135.17839999999998" fill="none" fill-opacity="1" stroke="rgba(255,159,41,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskda3cbv3u)" pathTo="M 0 162.21408C 15.482196716828778 162.21408 28.752651045539164 135.17839999999998 44.23484776236794 135.17839999999998C 59.717044479196716 135.17839999999998 72.9874988079071 158.35183999999998 88.46969552473588 158.35183999999998C 103.95189224156466 158.35183999999998 117.22234657027505 115.86719999999998 132.70454328710383 115.86719999999998C 148.1867400039326 115.86719999999998 161.45719433264298 154.4896 176.93939104947177 154.4896C 192.42158776630055 154.4896 205.69204209501092 65.65807999999998 221.1742388118397 65.65807999999998C 236.65643552866848 65.65807999999998 249.92688985737888 142.90287999999998 265.40908657420766 142.90287999999998C 280.8912832910364 142.90287999999998 294.1617376197468 108.14271999999998 309.64393433657557 108.14271999999998C 325.1261310534044 108.14271999999998 338.3965853821147 162.21408 353.87878209894353 162.21408C 369.3609788157723 162.21408 382.6314331444827 127.45392 398.11362986131144 127.45392C 413.59582657814025 127.45392 426.8662809068506 154.4896 442.3484776236794 154.4896C 457.8306743405082 154.4896 471.10112866921855 135.17839999999998 486.58332538604736 135.17839999999998" pathFrom="M -1 193.112 L -1 193.112 L 44.23484776236794 193.112 L 88.46969552473588 193.112 L 132.70454328710383 193.112 L 176.93939104947177 193.112 L 221.1742388118397 193.112 L 265.40908657420766 193.112 L 309.64393433657557 193.112 L 353.87878209894353 193.112 L 398.11362986131144 193.112 L 442.3484776236794 193.112 L 486.58332538604736 193.112" fill-rule="evenodd"></path><g id="SvgjsG2067" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="0"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2162" r="0" cx="0" cy="0" class="apexcharts-marker w9ejqkam3 no-pointer-events" stroke="#ffffff" fill="#ff9f29" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2070" class="apexcharts-series" seriesName="Example" data:longestSeries="true" rel="2" data:realIndex="1"><path id="SvgjsPath2073" d="M 0 162.21408C 15.482196716828778 162.21408 28.752651045539164 100.41823999999998 44.23484776236794 100.41823999999998C 59.717044479196716 100.41823999999998 72.9874988079071 123.59168 88.46969552473588 123.59168C 103.95189224156466 123.59168 117.22234657027505 38.62239999999997 132.70454328710383 38.62239999999997C 148.1867400039326 38.62239999999997 161.45719433264298 123.59168 176.93939104947177 123.59168C 192.42158776630055 123.59168 205.69204209501092 7.724479999999971 221.1742388118397 7.724479999999971C 236.65643552866848 7.724479999999971 249.92688985737888 108.14271999999998 265.40908657420766 108.14271999999998C 280.8912832910364 108.14271999999998 294.1617376197468 46.34687999999997 309.64393433657557 46.34687999999997C 325.1261310534044 46.34687999999997 338.3965853821147 123.59168 353.87878209894353 123.59168C 369.3609788157723 123.59168 382.6314331444827 77.24479999999998 398.11362986131144 77.24479999999998C 413.59582657814025 77.24479999999998 426.8662809068506 115.86719999999998 442.3484776236794 115.86719999999998C 457.8306743405082 115.86719999999998 471.10112866921855 84.96927999999998 486.58332538604736 84.96927999999998" fill="none" fill-opacity="1" stroke="rgba(72,127,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="1" clip-path="url(#gridRectMaskda3cbv3u)" pathTo="M 0 162.21408C 15.482196716828778 162.21408 28.752651045539164 100.41823999999998 44.23484776236794 100.41823999999998C 59.717044479196716 100.41823999999998 72.9874988079071 123.59168 88.46969552473588 123.59168C 103.95189224156466 123.59168 117.22234657027505 38.62239999999997 132.70454328710383 38.62239999999997C 148.1867400039326 38.62239999999997 161.45719433264298 123.59168 176.93939104947177 123.59168C 192.42158776630055 123.59168 205.69204209501092 7.724479999999971 221.1742388118397 7.724479999999971C 236.65643552866848 7.724479999999971 249.92688985737888 108.14271999999998 265.40908657420766 108.14271999999998C 280.8912832910364 108.14271999999998 294.1617376197468 46.34687999999997 309.64393433657557 46.34687999999997C 325.1261310534044 46.34687999999997 338.3965853821147 123.59168 353.87878209894353 123.59168C 369.3609788157723 123.59168 382.6314331444827 77.24479999999998 398.11362986131144 77.24479999999998C 413.59582657814025 77.24479999999998 426.8662809068506 115.86719999999998 442.3484776236794 115.86719999999998C 457.8306743405082 115.86719999999998 471.10112866921855 84.96927999999998 486.58332538604736 84.96927999999998" pathFrom="M -1 193.112 L -1 193.112 L 44.23484776236794 193.112 L 88.46969552473588 193.112 L 132.70454328710383 193.112 L 176.93939104947177 193.112 L 221.1742388118397 193.112 L 265.40908657420766 193.112 L 309.64393433657557 193.112 L 353.87878209894353 193.112 L 398.11362986131144 193.112 L 442.3484776236794 193.112 L 486.58332538604736 193.112" fill-rule="evenodd"></path><g id="SvgjsG2071" class="apexcharts-series-markers-wrap apexcharts-hidden-element-shown" data:realIndex="1"><g class="apexcharts-series-markers"><circle id="SvgjsCircle2163" r="0" cx="0" cy="0" class="apexcharts-marker w03zty4imf no-pointer-events" stroke="#ffffff" fill="#487fff" fill-opacity="1" stroke-width="3" stroke-opacity="0.9" default-marker-size="0"></circle></g></g></g><g id="SvgjsG2068" class="apexcharts-datalabels" data:realIndex="0"></g><g id="SvgjsG2072" class="apexcharts-datalabels" data:realIndex="1"></g></g><g id="SvgjsG2077" class="apexcharts-grid-borders"><line id="SvgjsLine2090" x1="0" y1="0" x2="486.58332538604736" y2="0" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2095" x1="0" y1="193.112" x2="486.58332538604736" y2="193.112" stroke="#d1d5db" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2138" x1="0" y1="194.112" x2="486.58332538604736" y2="194.112" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><line id="SvgjsLine2098" x1="0" y1="0" x2="486.58332538604736" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2099" x1="0" y1="0" x2="486.58332538604736" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2100" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2101" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText2103" font-family="Helvetica, Arial, sans-serif" x="0" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2104">Jan</tspan><title>Jan</title></text><text id="SvgjsText2106" font-family="Helvetica, Arial, sans-serif" x="44.23484776236795" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2107">Feb</tspan><title>Feb</title></text><text id="SvgjsText2109" font-family="Helvetica, Arial, sans-serif" x="88.46969552473588" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2110">Mar</tspan><title>Mar</title></text><text id="SvgjsText2112" font-family="Helvetica, Arial, sans-serif" x="132.7045432871038" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2113">Apr</tspan><title>Apr</title></text><text id="SvgjsText2115" font-family="Helvetica, Arial, sans-serif" x="176.93939104947174" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2116">May</tspan><title>May</title></text><text id="SvgjsText2118" font-family="Helvetica, Arial, sans-serif" x="221.17423881183967" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2119">Jun</tspan><title>Jun</title></text><text id="SvgjsText2121" font-family="Helvetica, Arial, sans-serif" x="265.4090865742076" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2122">Jul</tspan><title>Jul</title></text><text id="SvgjsText2124" font-family="Helvetica, Arial, sans-serif" x="309.64393433657557" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2125">Aug</tspan><title>Aug</title></text><text id="SvgjsText2127" font-family="Helvetica, Arial, sans-serif" x="353.87878209894353" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2128">Sep</tspan><title>Sep</title></text><text id="SvgjsText2130" font-family="Helvetica, Arial, sans-serif" x="398.1136298613115" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2131">Oct</tspan><title>Oct</title></text><text id="SvgjsText2133" font-family="Helvetica, Arial, sans-serif" x="442.34847762367946" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2134">Nov</tspan><title>Nov</title></text><text id="SvgjsText2136" font-family="Helvetica, Arial, sans-serif" x="486.5833253860474" y="222.112" text-anchor="middle" dominant-baseline="auto" font-size="14px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2137">Dec</tspan><title>Dec</title></text></g></g><g id="SvgjsG2159" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2160" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2161" class="apexcharts-point-annotations"></g><rect id="SvgjsRect2164" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect><rect id="SvgjsRect2165" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(72, 127, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 159, 41);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 p-0">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Performance Distribution</h6>
                    </div>
                    <div class="card-body p-24 text-center d-flex flex-wrap align-items-start gap-5 justify-content-center">
                        <div class="position-relative">
                            <div id="basicDonutChart" class="w-auto d-inline-block apexcharts-tooltip-z-none" style="min-height: 242.7px;"><div id="apexchartsbp7j0gvaj" class="apexcharts-canvas apexchartsbp7j0gvaj apexcharts-theme-light" style="width: 300px; height: 242.7px;"><svg id="SvgjsSvg1546" width="300" height="242.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="300" height="242.7"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml"></div></foreignObject><g id="SvgjsG1548" class="apexcharts-inner apexcharts-graphical" transform="translate(31, 0)"><defs id="SvgjsDefs1547"><clipPath id="gridRectMaskbp7j0gvaj"><rect id="SvgjsRect1549" width="246" height="264" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskbp7j0gvaj"></clipPath><clipPath id="nonForecastMaskbp7j0gvaj"></clipPath><clipPath id="gridRectMarkerMaskbp7j0gvaj"><rect id="SvgjsRect1550" width="244" height="266" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1551" class="apexcharts-pie"><g id="SvgjsG1552" transform="translate(0, 0) scale(1)"><circle id="SvgjsCircle1553" r="72.19756097560976" cx="120" cy="120" fill="transparent"></circle><g id="SvgjsG1554" class="apexcharts-slices"><g id="SvgjsG1555" class="apexcharts-series apexcharts-pie-series" seriesName="series-1" rel="1" data:realIndex="0"><path id="SvgjsPath1556" d="M 120 8.926829268292678 A 111.07317073170732 111.07317073170732 0 0 1 230.59935216701433 109.75146075619811 L 191.88957890855932 113.33844949152878 A 72.19756097560976 72.19756097560976 0 0 0 120 47.80243902439024 L 120 8.926829268292678 z" fill="rgba(22,163,74,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="84.70588235294117" data:startAngle="0" data:strokeWidth="2" data:value="44" data:pathOrig="M 120 8.926829268292678 A 111.07317073170732 111.07317073170732 0 0 1 230.59935216701433 109.75146075619811 L 191.88957890855932 113.33844949152878 A 72.19756097560976 72.19756097560976 0 0 0 120 47.80243902439024 L 120 8.926829268292678 z" stroke="#ffffff"></path></g><g id="SvgjsG1557" class="apexcharts-series apexcharts-pie-series" seriesName="series-2" rel="2" data:realIndex="1"><path id="SvgjsPath1558" d="M 230.59935216701433 109.75146075619811 A 111.07317073170732 111.07317073170732 0 0 1 99.59035843569123 229.1819389258656 L 106.7337329831993 190.96826030181262 A 72.19756097560976 72.19756097560976 0 0 0 191.88957890855932 113.33844949152878 L 230.59935216701433 109.75146075619811 z" fill="rgba(72,127,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="105.88235294117645" data:startAngle="84.70588235294117" data:strokeWidth="2" data:value="55" data:pathOrig="M 230.59935216701433 109.75146075619811 A 111.07317073170732 111.07317073170732 0 0 1 99.59035843569123 229.1819389258656 L 106.7337329831993 190.96826030181262 A 72.19756097560976 72.19756097560976 0 0 0 191.88957890855932 113.33844949152878 L 230.59935216701433 109.75146075619811 z" stroke="#ffffff"></path></g><g id="SvgjsG1559" class="apexcharts-series apexcharts-pie-series" seriesName="series-3" rel="3" data:realIndex="2"><path id="SvgjsPath1560" d="M 99.59035843569123 229.1819389258656 A 111.07317073170732 111.07317073170732 0 0 1 55.3181562372922 210.296779255141 L 77.95680155423993 178.69290651584166 A 72.19756097560976 72.19756097560976 0 0 0 106.7337329831993 190.96826030181262 L 99.59035843569123 229.1819389258656 z" fill="rgba(37,99,235,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="25.026737967914443" data:startAngle="190.58823529411762" data:strokeWidth="2" data:value="13" data:pathOrig="M 99.59035843569123 229.1819389258656 A 111.07317073170732 111.07317073170732 0 0 1 55.3181562372922 210.296779255141 L 77.95680155423993 178.69290651584166 A 72.19756097560976 72.19756097560976 0 0 0 106.7337329831993 190.96826030181262 L 99.59035843569123 229.1819389258656 z" stroke="#ffffff"></path></g><g id="SvgjsG1561" class="apexcharts-series apexcharts-pie-series" seriesName="series-4" rel="4" data:realIndex="3"><path id="SvgjsPath1562" d="M 55.3181562372922 210.296779255141 A 111.07317073170732 111.07317073170732 0 0 1 10.338459195822168 102.3479257635641 L 48.719998477284406 108.52615174631667 A 72.19756097560976 72.19756097560976 0 0 0 77.95680155423993 178.69290651584166 L 55.3181562372922 210.296779255141 z" fill="rgba(220,38,38,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="63.529411764705884" data:startAngle="215.61497326203207" data:strokeWidth="2" data:value="33" data:pathOrig="M 55.3181562372922 210.296779255141 A 111.07317073170732 111.07317073170732 0 0 1 10.338459195822168 102.3479257635641 L 48.719998477284406 108.52615174631667 A 72.19756097560976 72.19756097560976 0 0 0 77.95680155423993 178.69290651584166 L 55.3181562372922 210.296779255141 z" stroke="#ffffff"></path></g><g id="SvgjsG1563" class="apexcharts-series apexcharts-pie-series" seriesName="series-5" rel="5" data:realIndex="4"><path id="SvgjsPath1564" d="M 10.338459195822168 102.3479257635641 A 111.07317073170732 111.07317073170732 0 0 1 69.65698551056624 20.990757257154698 L 87.27704058186805 55.643992217150554 A 72.19756097560976 72.19756097560976 0 0 0 48.719998477284406 108.52615174631667 L 10.338459195822168 102.3479257635641 z" fill="rgba(248,102,36,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-4" index="0" j="4" data:angle="53.903743315507995" data:startAngle="279.14438502673795" data:strokeWidth="2" data:value="28" data:pathOrig="M 10.338459195822168 102.3479257635641 A 111.07317073170732 111.07317073170732 0 0 1 69.65698551056624 20.990757257154698 L 87.27704058186805 55.643992217150554 A 72.19756097560976 72.19756097560976 0 0 0 48.719998477284406 108.52615174631667 L 10.338459195822168 102.3479257635641 z" stroke="#ffffff"></path></g><g id="SvgjsG1565" class="apexcharts-series apexcharts-pie-series" seriesName="series-6" rel="6" data:realIndex="5"><path id="SvgjsPath1566" d="M 69.65698551056624 20.990757257154698 A 111.07317073170732 111.07317073170732 0 0 1 119.98061407469942 8.926830960033797 L 119.98739914855463 47.80244012402197 A 72.19756097560976 72.19756097560976 0 0 0 87.27704058186805 55.643992217150554 L 69.65698551056624 20.990757257154698 z" fill="rgba(255,193,7,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-5" index="0" j="5" data:angle="26.951871657753998" data:startAngle="333.04812834224595" data:strokeWidth="2" data:value="14" data:pathOrig="M 69.65698551056624 20.990757257154698 A 111.07317073170732 111.07317073170732 0 0 1 119.98061407469942 8.926830960033797 L 119.98739914855463 47.80244012402197 A 72.19756097560976 72.19756097560976 0 0 0 87.27704058186805 55.643992217150554 L 69.65698551056624 20.990757257154698 z" stroke="#ffffff"></path></g></g></g></g><line id="SvgjsLine1567" x1="0" y1="0" x2="240" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1568" x1="0" y1="0" x2="240" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g></svg><div class="apexcharts-tooltip apexcharts-theme-dark"><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(22, 163, 74);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(72, 127, 255);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(37, 99, 235);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(220, 38, 38);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 5;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(248, 102, 36);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="order: 6;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 193, 7);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                            <div class="position-absolute start-50 top-50 translate-middle">
                              
                            </div>
                        </div>

                        <div class="max-w-290-px w-100">
                            <div class="d-flex align-items-center justify-content-between gap-12 border pb-12 mb-12 border-end-0 border-top-0 border-start-0">
                                <span class="text-primary-light fw-medium text-sm">Label</span>
                                <span class="text-primary-light fw-medium text-sm">Value</span>
                                <span class="text-primary-light fw-medium text-sm">%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-success-600 rounded-circle"></span> Label 1 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">12</span>
                                <span class="text-primary-light fw-medium text-sm"> 30.6% </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-primary-600 rounded-circle"></span> Label 2 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">22</span>
                                <span class="text-primary-light fw-medium text-sm">  42.9%</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-info-600 rounded-circle"></span> Label 3 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">12</span>
                                <span class="text-primary-light fw-medium text-sm"> 24.6% </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-danger-600 rounded-circle"></span> Label 4 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">12</span>
                                <span class="text-primary-light fw-medium text-sm"> 26.6% </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-orange rounded-circle"></span> Label 5 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">7</span>
                                <span class="text-primary-light fw-medium text-sm"> 13.3% </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-12 mb-12">
                                <span class="text-primary-light fw-medium text-sm d-flex align-items-center gap-12">
                                    <span class="w-12-px h-12-px bg-warning rounded-circle"></span> Label 6 
                                    </span>
                                <span class="text-primary-light fw-medium text-sm">7</span>
                                <span class="text-primary-light fw-medium text-sm"> 15.3% </span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 p-0">
                    <div class="card-header border-bottom bg-base py-16 px-24">
                        <h6 class="text-lg fw-semibold mb-0">Industry Benchmark</h6>
                    </div>
                    <div class="card-body p-24">
                        <div id="columnGroupBarChart" class="" style="min-height: 279px;"><div id="apexchartswwzio083" class="apexcharts-canvas apexchartswwzio083 apexcharts-theme-light" style="width: 547px; height: 264px;"><svg id="SvgjsSvg1890" width="547" height="264" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><foreignObject x="0" y="0" width="547" height="264"><div class="apexcharts-legend" xmlns="http://www.w3.org/1999/xhtml" style="max-height: 132px;"></div></foreignObject><g id="SvgjsG2045" class="apexcharts-yaxis" rel="0" transform="translate(22.4666748046875, 0)"><g id="SvgjsG2046" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2048" font-family="Helvetica, Arial, sans-serif" x="20" y="31.5" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2049">100k</tspan><title>100k</title></text><text id="SvgjsText2051" font-family="Helvetica, Arial, sans-serif" x="20" y="70.8990398765564" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2052">80k</tspan><title>80k</title></text><text id="SvgjsText2054" font-family="Helvetica, Arial, sans-serif" x="20" y="110.2980797531128" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2055">60k</tspan><title>60k</title></text><text id="SvgjsText2057" font-family="Helvetica, Arial, sans-serif" x="20" y="149.6971196296692" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2058">40k</tspan><title>40k</title></text><text id="SvgjsText2060" font-family="Helvetica, Arial, sans-serif" x="20" y="189.0961595062256" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2061">20k</tspan><title>20k</title></text><text id="SvgjsText2063" font-family="Helvetica, Arial, sans-serif" x="20" y="228.495199382782" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2064">0k</tspan><title>0k</title></text></g></g><g id="SvgjsG1892" class="apexcharts-inner apexcharts-graphical" transform="translate(52.4666748046875, 30)"><defs id="SvgjsDefs1891"><linearGradient id="SvgjsLinearGradient1895" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1896" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop><stop id="SvgjsStop1897" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop><stop id="SvgjsStop1898" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop></linearGradient><clipPath id="gridRectMaskwwzio083"><rect id="SvgjsRect1900" width="488.5333251953125" height="196.99519938278198" x="-2" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskwwzio083"></clipPath><clipPath id="nonForecastMaskwwzio083"></clipPath><clipPath id="gridRectMarkerMaskwwzio083"><rect id="SvgjsRect1901" width="488.5333251953125" height="200.99519938278198" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><linearGradient id="SvgjsLinearGradient1907" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1908" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1909" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1910" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1913" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1914" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1915" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1916" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1919" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1920" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1921" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1922" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1925" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1926" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1927" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1928" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1931" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1932" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1933" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1934" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1937" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1938" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1939" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1940" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1943" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1944" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1945" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1946" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1949" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1950" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1951" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1952" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1955" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1956" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1957" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1958" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1961" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1962" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1963" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1964" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1967" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1968" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1969" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1970" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient><linearGradient id="SvgjsLinearGradient1973" x1="0" y1="0" x2="0" y2="1"><stop id="SvgjsStop1974" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="0"></stop><stop id="SvgjsStop1975" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop><stop id="SvgjsStop1976" stop-opacity="1" stop-color="rgba(72,127,255,1)" offset="1"></stop></linearGradient></defs><rect id="SvgjsRect1899" width="9.286888732910157" height="196.99519938278198" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1895)" class="apexcharts-xcrosshairs" y2="196.99519938278198" filter="none" fill-opacity="0.9"></rect><line id="SvgjsLine1983" x1="0" y1="197.99519938278198" x2="0" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1984" x1="40.377777099609375" y1="197.99519938278198" x2="40.377777099609375" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1985" x1="80.75555419921875" y1="197.99519938278198" x2="80.75555419921875" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1986" x1="121.13333129882812" y1="197.99519938278198" x2="121.13333129882812" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1987" x1="161.5111083984375" y1="197.99519938278198" x2="161.5111083984375" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1988" x1="201.88888549804688" y1="197.99519938278198" x2="201.88888549804688" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1989" x1="242.26666259765625" y1="197.99519938278198" x2="242.26666259765625" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1990" x1="282.6444396972656" y1="197.99519938278198" x2="282.6444396972656" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1991" x1="323.022216796875" y1="197.99519938278198" x2="323.022216796875" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1992" x1="363.3999938964844" y1="197.99519938278198" x2="363.3999938964844" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1993" x1="403.77777099609375" y1="197.99519938278198" x2="403.77777099609375" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1994" x1="444.1555480957031" y1="197.99519938278198" x2="444.1555480957031" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine1995" x1="484.5333251953125" y1="197.99519938278198" x2="484.5333251953125" y2="203.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-xaxis-tick"></line><g id="SvgjsG1979" class="apexcharts-grid"><g id="SvgjsG1980" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine1997" x1="0" y1="39.399039876556394" x2="484.5333251953125" y2="39.399039876556394" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1998" x1="0" y1="78.79807975311279" x2="484.5333251953125" y2="78.79807975311279" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine1999" x1="0" y1="118.19711962966917" x2="484.5333251953125" y2="118.19711962966917" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2000" x1="0" y1="157.59615950622558" x2="484.5333251953125" y2="157.59615950622558" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line></g><g id="SvgjsG1981" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine2003" x1="0" y1="196.99519938278198" x2="484.5333251953125" y2="196.99519938278198" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line><line id="SvgjsLine2002" x1="0" y1="1" x2="0" y2="196.99519938278198" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line></g><g id="SvgjsG1902" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG1903" class="apexcharts-series" rel="1" seriesName="Sales" data:realIndex="0"><path id="SvgjsPath1912" d="M 15.545444183349609 196.99619938278198 L 15.545444183349609 37.55027990741732 C 15.545444183349609 33.55027990741732 19.54544418334961 29.550279907417316 23.54544418334961 29.550279907417316 L 23.54544418334961 29.550279907417316 C 24.188888549804688 29.550279907417316 24.832332916259766 33.55027990741732 24.832332916259766 37.55027990741732 L 24.832332916259766 196.99619938278198 z " fill="url(#SvgjsLinearGradient1907)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 15.545444183349609 196.99619938278198 L 15.545444183349609 37.55027990741732 C 15.545444183349609 33.55027990741732 19.54544418334961 29.550279907417316 23.54544418334961 29.550279907417316 L 23.54544418334961 29.550279907417316 C 24.188888549804688 29.550279907417316 24.832332916259766 33.55027990741732 24.832332916259766 37.55027990741732 L 24.832332916259766 196.99619938278198 z " pathFrom="M 15.545444183349609 196.99619938278198 L 15.545444183349609 196.99619938278198 L 24.832332916259766 196.99619938278198 L 24.832332916259766 196.99619938278198 L 24.832332916259766 196.99619938278198 L 24.832332916259766 196.99619938278198 L 24.832332916259766 196.99619938278198 L 15.545444183349609 196.99619938278198 z" cy="29.549279907417315" cx="55.923221282958984" j="0" val="85000" barHeight="167.44591947536466" barWidth="9.286888732910157"></path><path id="SvgjsPath1918" d="M 55.923221282958984 196.99619938278198 L 55.923221282958984 67.0995598148346 C 55.923221282958984 63.099559814834606 59.923221282958984 59.0995598148346 63.923221282958984 59.0995598148346 L 63.923221282958984 59.0995598148346 C 64.56666564941406 59.0995598148346 65.21011001586913 63.099559814834606 65.21011001586913 67.0995598148346 L 65.21011001586913 196.99619938278198 z " fill="url(#SvgjsLinearGradient1913)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 55.923221282958984 196.99619938278198 L 55.923221282958984 67.0995598148346 C 55.923221282958984 63.099559814834606 59.923221282958984 59.0995598148346 63.923221282958984 59.0995598148346 L 63.923221282958984 59.0995598148346 C 64.56666564941406 59.0995598148346 65.21011001586913 63.099559814834606 65.21011001586913 67.0995598148346 L 65.21011001586913 196.99619938278198 z " pathFrom="M 55.923221282958984 196.99619938278198 L 55.923221282958984 196.99619938278198 L 65.21011001586913 196.99619938278198 L 65.21011001586913 196.99619938278198 L 65.21011001586913 196.99619938278198 L 65.21011001586913 196.99619938278198 L 65.21011001586913 196.99619938278198 L 55.923221282958984 196.99619938278198 z" cy="59.0985598148346" cx="96.30099838256837" j="1" val="70000" barHeight="137.89663956794737" barWidth="9.286888732910157"></path><path id="SvgjsPath1924" d="M 96.30099838256837 196.99619938278198 L 96.30099838256837 126.1981196296692 C 96.30099838256837 122.1981196296692 100.30099838256837 118.1981196296692 104.30099838256837 118.1981196296692 L 104.30099838256837 118.1981196296692 C 104.94444274902344 118.1981196296692 105.58788711547852 122.1981196296692 105.58788711547852 126.1981196296692 L 105.58788711547852 196.99619938278198 z " fill="url(#SvgjsLinearGradient1919)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 96.30099838256837 196.99619938278198 L 96.30099838256837 126.1981196296692 C 96.30099838256837 122.1981196296692 100.30099838256837 118.1981196296692 104.30099838256837 118.1981196296692 L 104.30099838256837 118.1981196296692 C 104.94444274902344 118.1981196296692 105.58788711547852 122.1981196296692 105.58788711547852 126.1981196296692 L 105.58788711547852 196.99619938278198 z " pathFrom="M 96.30099838256837 196.99619938278198 L 96.30099838256837 196.99619938278198 L 105.58788711547852 196.99619938278198 L 105.58788711547852 196.99619938278198 L 105.58788711547852 196.99619938278198 L 105.58788711547852 196.99619938278198 L 105.58788711547852 196.99619938278198 L 96.30099838256837 196.99619938278198 z" cy="118.19711962966919" cx="136.67877548217774" j="2" val="40000" barHeight="78.79807975311279" barWidth="9.286888732910157"></path><path id="SvgjsPath1930" d="M 136.67877548217774 196.99619938278198 L 136.67877548217774 106.498599691391 C 136.67877548217774 102.498599691391 140.67877548217774 98.498599691391 144.67877548217774 98.498599691391 L 144.67877548217774 98.498599691391 C 145.3222198486328 98.498599691391 145.96566421508788 102.498599691391 145.96566421508788 106.498599691391 L 145.96566421508788 196.99619938278198 z " fill="url(#SvgjsLinearGradient1925)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 136.67877548217774 196.99619938278198 L 136.67877548217774 106.498599691391 C 136.67877548217774 102.498599691391 140.67877548217774 98.498599691391 144.67877548217774 98.498599691391 L 144.67877548217774 98.498599691391 C 145.3222198486328 98.498599691391 145.96566421508788 102.498599691391 145.96566421508788 106.498599691391 L 145.96566421508788 196.99619938278198 z " pathFrom="M 136.67877548217774 196.99619938278198 L 136.67877548217774 196.99619938278198 L 145.96566421508788 196.99619938278198 L 145.96566421508788 196.99619938278198 L 145.96566421508788 196.99619938278198 L 145.96566421508788 196.99619938278198 L 145.96566421508788 196.99619938278198 L 136.67877548217774 196.99619938278198 z" cy="98.49759969139099" cx="177.05655258178712" j="3" val="50000" barHeight="98.49759969139099" barWidth="9.286888732910157"></path><path id="SvgjsPath1936" d="M 177.05655258178712 196.99619938278198 L 177.05655258178712 86.7990797531128 C 177.05655258178712 82.7990797531128 181.05655258178712 78.7990797531128 185.05655258178712 78.7990797531128 L 185.05655258178712 78.7990797531128 C 185.6999969482422 78.7990797531128 186.34344131469726 82.7990797531128 186.34344131469726 86.7990797531128 L 186.34344131469726 196.99619938278198 z " fill="url(#SvgjsLinearGradient1931)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 177.05655258178712 196.99619938278198 L 177.05655258178712 86.7990797531128 C 177.05655258178712 82.7990797531128 181.05655258178712 78.7990797531128 185.05655258178712 78.7990797531128 L 185.05655258178712 78.7990797531128 C 185.6999969482422 78.7990797531128 186.34344131469726 82.7990797531128 186.34344131469726 86.7990797531128 L 186.34344131469726 196.99619938278198 z " pathFrom="M 177.05655258178712 196.99619938278198 L 177.05655258178712 196.99619938278198 L 186.34344131469726 196.99619938278198 L 186.34344131469726 196.99619938278198 L 186.34344131469726 196.99619938278198 L 186.34344131469726 196.99619938278198 L 186.34344131469726 196.99619938278198 L 177.05655258178712 196.99619938278198 z" cy="78.7980797531128" cx="217.4343296813965" j="4" val="60000" barHeight="118.19711962966917" barWidth="9.286888732910157"></path><path id="SvgjsPath1942" d="M 217.4343296813965 196.99619938278198 L 217.4343296813965 106.498599691391 C 217.4343296813965 102.498599691391 221.4343296813965 98.498599691391 225.4343296813965 98.498599691391 L 225.4343296813965 98.498599691391 C 226.07777404785156 98.498599691391 226.72121841430663 102.498599691391 226.72121841430663 106.498599691391 L 226.72121841430663 196.99619938278198 z " fill="url(#SvgjsLinearGradient1937)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 217.4343296813965 196.99619938278198 L 217.4343296813965 106.498599691391 C 217.4343296813965 102.498599691391 221.4343296813965 98.498599691391 225.4343296813965 98.498599691391 L 225.4343296813965 98.498599691391 C 226.07777404785156 98.498599691391 226.72121841430663 102.498599691391 226.72121841430663 106.498599691391 L 226.72121841430663 196.99619938278198 z " pathFrom="M 217.4343296813965 196.99619938278198 L 217.4343296813965 196.99619938278198 L 226.72121841430663 196.99619938278198 L 226.72121841430663 196.99619938278198 L 226.72121841430663 196.99619938278198 L 226.72121841430663 196.99619938278198 L 226.72121841430663 196.99619938278198 L 217.4343296813965 196.99619938278198 z" cy="98.49759969139099" cx="257.81210678100587" j="5" val="50000" barHeight="98.49759969139099" barWidth="9.286888732910157"></path><path id="SvgjsPath1948" d="M 257.81210678100587 196.99619938278198 L 257.81210678100587 126.1981196296692 C 257.81210678100587 122.1981196296692 261.81210678100587 118.1981196296692 265.81210678100587 118.1981196296692 L 265.81210678100587 118.1981196296692 C 266.45555114746094 118.1981196296692 267.098995513916 122.1981196296692 267.098995513916 126.1981196296692 L 267.098995513916 196.99619938278198 z " fill="url(#SvgjsLinearGradient1943)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 257.81210678100587 196.99619938278198 L 257.81210678100587 126.1981196296692 C 257.81210678100587 122.1981196296692 261.81210678100587 118.1981196296692 265.81210678100587 118.1981196296692 L 265.81210678100587 118.1981196296692 C 266.45555114746094 118.1981196296692 267.098995513916 122.1981196296692 267.098995513916 126.1981196296692 L 267.098995513916 196.99619938278198 z " pathFrom="M 257.81210678100587 196.99619938278198 L 257.81210678100587 196.99619938278198 L 267.098995513916 196.99619938278198 L 267.098995513916 196.99619938278198 L 267.098995513916 196.99619938278198 L 267.098995513916 196.99619938278198 L 267.098995513916 196.99619938278198 L 257.81210678100587 196.99619938278198 z" cy="118.19711962966919" cx="298.18988388061524" j="6" val="40000" barHeight="78.79807975311279" barWidth="9.286888732910157"></path><path id="SvgjsPath1954" d="M 298.18988388061524 196.99619938278198 L 298.18988388061524 106.498599691391 C 298.18988388061524 102.498599691391 302.18988388061524 98.498599691391 306.18988388061524 98.498599691391 L 306.18988388061524 98.498599691391 C 306.8333282470703 98.498599691391 307.4767726135254 102.498599691391 307.4767726135254 106.498599691391 L 307.4767726135254 196.99619938278198 z " fill="url(#SvgjsLinearGradient1949)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 298.18988388061524 196.99619938278198 L 298.18988388061524 106.498599691391 C 298.18988388061524 102.498599691391 302.18988388061524 98.498599691391 306.18988388061524 98.498599691391 L 306.18988388061524 98.498599691391 C 306.8333282470703 98.498599691391 307.4767726135254 102.498599691391 307.4767726135254 106.498599691391 L 307.4767726135254 196.99619938278198 z " pathFrom="M 298.18988388061524 196.99619938278198 L 298.18988388061524 196.99619938278198 L 307.4767726135254 196.99619938278198 L 307.4767726135254 196.99619938278198 L 307.4767726135254 196.99619938278198 L 307.4767726135254 196.99619938278198 L 307.4767726135254 196.99619938278198 L 298.18988388061524 196.99619938278198 z" cy="98.49759969139099" cx="338.5676609802246" j="7" val="50000" barHeight="98.49759969139099" barWidth="9.286888732910157"></path><path id="SvgjsPath1960" d="M 338.5676609802246 196.99619938278198 L 338.5676609802246 126.1981196296692 C 338.5676609802246 122.1981196296692 342.5676609802246 118.1981196296692 346.5676609802246 118.1981196296692 L 346.5676609802246 118.1981196296692 C 347.2111053466797 118.1981196296692 347.85454971313476 122.1981196296692 347.85454971313476 126.1981196296692 L 347.85454971313476 196.99619938278198 z " fill="url(#SvgjsLinearGradient1955)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 338.5676609802246 196.99619938278198 L 338.5676609802246 126.1981196296692 C 338.5676609802246 122.1981196296692 342.5676609802246 118.1981196296692 346.5676609802246 118.1981196296692 L 346.5676609802246 118.1981196296692 C 347.2111053466797 118.1981196296692 347.85454971313476 122.1981196296692 347.85454971313476 126.1981196296692 L 347.85454971313476 196.99619938278198 z " pathFrom="M 338.5676609802246 196.99619938278198 L 338.5676609802246 196.99619938278198 L 347.85454971313476 196.99619938278198 L 347.85454971313476 196.99619938278198 L 347.85454971313476 196.99619938278198 L 347.85454971313476 196.99619938278198 L 347.85454971313476 196.99619938278198 L 338.5676609802246 196.99619938278198 z" cy="118.19711962966919" cx="378.945438079834" j="8" val="40000" barHeight="78.79807975311279" barWidth="9.286888732910157"></path><path id="SvgjsPath1966" d="M 378.945438079834 196.99619938278198 L 378.945438079834 86.7990797531128 C 378.945438079834 82.7990797531128 382.945438079834 78.7990797531128 386.945438079834 78.7990797531128 L 386.945438079834 78.7990797531128 C 387.58888244628906 78.7990797531128 388.23232681274413 82.7990797531128 388.23232681274413 86.7990797531128 L 388.23232681274413 196.99619938278198 z " fill="url(#SvgjsLinearGradient1961)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 378.945438079834 196.99619938278198 L 378.945438079834 86.7990797531128 C 378.945438079834 82.7990797531128 382.945438079834 78.7990797531128 386.945438079834 78.7990797531128 L 386.945438079834 78.7990797531128 C 387.58888244628906 78.7990797531128 388.23232681274413 82.7990797531128 388.23232681274413 86.7990797531128 L 388.23232681274413 196.99619938278198 z " pathFrom="M 378.945438079834 196.99619938278198 L 378.945438079834 196.99619938278198 L 388.23232681274413 196.99619938278198 L 388.23232681274413 196.99619938278198 L 388.23232681274413 196.99619938278198 L 388.23232681274413 196.99619938278198 L 388.23232681274413 196.99619938278198 L 378.945438079834 196.99619938278198 z" cy="78.7980797531128" cx="419.32321517944337" j="9" val="60000" barHeight="118.19711962966917" barWidth="9.286888732910157"></path><path id="SvgjsPath1972" d="M 419.32321517944337 196.99619938278198 L 419.32321517944337 145.89763956794738 C 419.32321517944337 141.89763956794738 423.32321517944337 137.89763956794738 427.32321517944337 137.89763956794738 L 427.32321517944337 137.89763956794738 C 427.96665954589844 137.89763956794738 428.6101039123535 141.89763956794738 428.6101039123535 145.89763956794738 L 428.6101039123535 196.99619938278198 z " fill="url(#SvgjsLinearGradient1967)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 419.32321517944337 196.99619938278198 L 419.32321517944337 145.89763956794738 C 419.32321517944337 141.89763956794738 423.32321517944337 137.89763956794738 427.32321517944337 137.89763956794738 L 427.32321517944337 137.89763956794738 C 427.96665954589844 137.89763956794738 428.6101039123535 141.89763956794738 428.6101039123535 145.89763956794738 L 428.6101039123535 196.99619938278198 z " pathFrom="M 419.32321517944337 196.99619938278198 L 419.32321517944337 196.99619938278198 L 428.6101039123535 196.99619938278198 L 428.6101039123535 196.99619938278198 L 428.6101039123535 196.99619938278198 L 428.6101039123535 196.99619938278198 L 428.6101039123535 196.99619938278198 L 419.32321517944337 196.99619938278198 z" cy="137.89663956794737" cx="459.70099227905274" j="10" val="30000" barHeight="59.09855981483459" barWidth="9.286888732910157"></path><path id="SvgjsPath1978" d="M 459.70099227905274 196.99619938278198 L 459.70099227905274 106.498599691391 C 459.70099227905274 102.498599691391 463.70099227905274 98.498599691391 467.70099227905274 98.498599691391 L 467.70099227905274 98.498599691391 C 468.3444366455078 98.498599691391 468.9878810119629 102.498599691391 468.9878810119629 106.498599691391 L 468.9878810119629 196.99619938278198 z " fill="url(#SvgjsLinearGradient1973)" fill-opacity="1" stroke-opacity="1" stroke-linecap="round" stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskwwzio083)" pathTo="M 459.70099227905274 196.99619938278198 L 459.70099227905274 106.498599691391 C 459.70099227905274 102.498599691391 463.70099227905274 98.498599691391 467.70099227905274 98.498599691391 L 467.70099227905274 98.498599691391 C 468.3444366455078 98.498599691391 468.9878810119629 102.498599691391 468.9878810119629 106.498599691391 L 468.9878810119629 196.99619938278198 z " pathFrom="M 459.70099227905274 196.99619938278198 L 459.70099227905274 196.99619938278198 L 468.9878810119629 196.99619938278198 L 468.9878810119629 196.99619938278198 L 468.9878810119629 196.99619938278198 L 468.9878810119629 196.99619938278198 L 468.9878810119629 196.99619938278198 L 459.70099227905274 196.99619938278198 z" cy="98.49759969139099" cx="500.0787693786621" j="11" val="50000" barHeight="98.49759969139099" barWidth="9.286888732910157"></path><g id="SvgjsG1905" class="apexcharts-bar-goals-markers" style="pointer-events: none"><g id="SvgjsG1911" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1917" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1923" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1929" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1935" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1941" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1947" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1953" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1959" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1965" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1971" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g><g id="SvgjsG1977" className="apexcharts-bar-goals-groups" class="apexcharts-hidden-element-shown" clip-path="url(#gridRectMarkerMaskwwzio083)"></g></g><g id="SvgjsG1906" class="apexcharts-bar-shadows apexcharts-hidden-element-shown" style="pointer-events: none"></g></g><g id="SvgjsG1904" class="apexcharts-datalabels apexcharts-hidden-element-shown" data:realIndex="0"></g></g><g id="SvgjsG1982" class="apexcharts-grid-borders"><line id="SvgjsLine1996" x1="0" y1="0" x2="484.5333251953125" y2="0" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2001" x1="0" y1="196.99519938278198" x2="484.5333251953125" y2="196.99519938278198" stroke="#d1d5db" stroke-dasharray="4" stroke-linecap="butt" class="apexcharts-gridline"></line><line id="SvgjsLine2044" x1="0" y1="197.99519938278198" x2="484.5333251953125" y2="197.99519938278198" stroke="#e0e0e0" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt"></line></g><line id="SvgjsLine2004" x1="0" y1="0" x2="484.5333251953125" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine2005" x1="0" y1="0" x2="484.5333251953125" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG2006" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG2007" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText2009" font-family="Helvetica, Arial, sans-serif" x="20.188888549804688" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2010">Jan</tspan><title>Jan</title></text><text id="SvgjsText2012" font-family="Helvetica, Arial, sans-serif" x="60.56666564941406" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2013">Feb</tspan><title>Feb</title></text><text id="SvgjsText2015" font-family="Helvetica, Arial, sans-serif" x="100.94444274902344" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2016">Mar</tspan><title>Mar</title></text><text id="SvgjsText2018" font-family="Helvetica, Arial, sans-serif" x="141.3222198486328" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2019">Apr</tspan><title>Apr</title></text><text id="SvgjsText2021" font-family="Helvetica, Arial, sans-serif" x="181.6999969482422" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2022">May</tspan><title>May</title></text><text id="SvgjsText2024" font-family="Helvetica, Arial, sans-serif" x="222.07777404785156" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2025">Jun</tspan><title>Jun</title></text><text id="SvgjsText2027" font-family="Helvetica, Arial, sans-serif" x="262.45555114746094" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2028">Jul</tspan><title>Jul</title></text><text id="SvgjsText2030" font-family="Helvetica, Arial, sans-serif" x="302.8333282470703" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2031">Aug</tspan><title>Aug</title></text><text id="SvgjsText2033" font-family="Helvetica, Arial, sans-serif" x="343.2111053466797" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2034">Sep</tspan><title>Sep</title></text><text id="SvgjsText2036" font-family="Helvetica, Arial, sans-serif" x="383.58888244628906" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2037">Oct</tspan><title>Oct</title></text><text id="SvgjsText2039" font-family="Helvetica, Arial, sans-serif" x="423.96665954589844" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2040">Nov</tspan><title>Nov</title></text><text id="SvgjsText2042" font-family="Helvetica, Arial, sans-serif" x="464.3444366455078" y="225.99519938278198" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan2043">Dec</tspan><title>Dec</title></text></g></g><g id="SvgjsG2065" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG2066" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG2067" class="apexcharts-point-annotations"></g></g></svg><div class="apexcharts-tooltip apexcharts-theme-light"><div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div><div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(0, 143, 251);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div><div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div><div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light"><div class="apexcharts-yaxistooltip-text"></div></div></div></div>
                    </div>
                </div>
            </div>
        </div> 
        <div class="container mt-5">
  <h4 class="fw-bold mb-4">Key Insights & Recommendations</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="insight-card bg-light-green border border-success-subtle">
        <div class="d-flex align-items-start">
          <div class="insight-icon text-green">📈</div>
          <div>
            <h6 class="fw-semibold text-green">Strong Performance</h6>
            <p class="mb-0">Your carbon emissions have decreased by 28.8% compared to last year, exceeding the industry average reduction of 15%.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="insight-card bg-light-orange border border-warning-subtle">
        <div class="d-flex align-items-start">
          <div class="insight-icon text-orange">🎯</div>
          <div>
            <h6 class="fw-semibold text-orange">Areas for Improvement</h6>
            <p class="mb-0">Water consumption intensity is 15% above industry benchmark. Consider implementing water efficiency programs.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="insight-card bg-light-blue border border-primary-subtle">
        <div class="d-flex align-items-start">
          <div class="insight-icon text-blue">👥</div>
          <div>
            <h6 class="fw-semibold text-blue">Supplier Engagement</h6>
            <p class="mb-0">95% of your suppliers are actively reporting ESG metrics, with an average data quality score of 8.7/10.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="insight-card bg-light-purple border border-purple-subtle">
        <div class="d-flex align-items-start">
          <div class="insight-icon text-purple">🏅</div>
          <div>
            <h6 class="fw-semibold text-purple">Recognition Opportunity</h6>
            <p class="mb-0">Your diversity metrics rank in the top 10% of your industry. Consider applying for sustainability awards.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </div>
      </div>
    </div>
   
  </div>

    <!-- footer -->
  <?php echo view('partials/Customerfooter'); ?>

  <!-- JS -->
  <?php echo view('partials/Customerjs'); ?>
<script>
  let table = new DataTable('#dataTable');
</script>

<script>
$(document).ready(function () {
    $("#zohoform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#zohoformbtn").on("click", function () {

    if ($("#zohoform").valid()) {
        // Get form data
        let formData = {
            zoho_client_id: $('#zoho_client_id').val(),
            zoho_client_secret: $('#zoho_client_secret').val(),
            zoho_refresh_token: $('#zoho_refresh_token').val(),
            zoho_refresh_token_book: $('#zoho_refresh_token_book').val(),
            zoho_organization_id: $('#zoho_organization_id').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your Zoho setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-zoho') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                        Swal.fire({
                              title: "Success",
                              text: response.message,
                              icon: "success",
                              timer: 2000,
                            });
                            
                        } else {
                             Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: response.message,
                                   timer: 2000,
                                });
                        }
                },
                error: function() {
                     Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:"Error occurred while submitting the form.",
                               timer: 2000,
                            });
                }
        });
        }
    });
    }
  });
});
</script>

<script>
$(document).ready(function () {
    $("#smtp2goform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#smtp2goformbtn").on("click", function () {

    if ($("#smtp2goform").valid()) {
        // Get form data
        let formData = {
            smtp2go_email: $('#smtp2go_email').val(),
            smtp2go_key: $('#smtp2go_key').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your smtp2go setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-smtp2go') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                        Swal.fire({
                              title: "Success",
                              text: response.message,
                              icon: "success",
                              timer: 2000,
                            });
                            
                        } else {
                             Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: response.message,
                                   timer: 2000,
                                });
                        }
                },
                error: function() {
                     Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:"Error occurred while submitting the form.",
                               timer: 2000,
                            });
                }
        });
        }
    });
    }
  });
});
</script>

<script>
$(document).ready(function () {
    $("#generalsettingform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#generalsettingformbtn").on("click", function () {

    if ($("#generalsettingform").valid()) {
        // Get form data
        let formData = {
            quot_prefix: $('#quot_prefix').val(),
            quote_number_length: $('#quote_number_length').val(),
            dateformat: $('#dateformat').val(),
            default_timezone: $('#default_timezone').val(),
            currency: $('#currency').val(),
            currencysymbol: $('#currency-symbol').val(),
            adminhelpemail: $('#admin-help-email').val(),
            crontime: $('#cron_time').val(),
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your general setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-general') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                        Swal.fire({
                              title: "Success",
                              text: response.message,
                              icon: "success",
                              timer: 2000,
                            });
                            
                        } else {
                             Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: response.message,
                                   timer: 2000,
                                });
                        }
                },
                error: function() {
                     Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:"Error occurred while submitting the form.",
                               timer: 2000,
                            });
                }
        });
        }
    });
    }
  });
});
</script>
<script>
$(document).ready(function () {
    $("#generalsettingformcron").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#generalsettingformbtncron").on("click", function () {

    if ($("#generalsettingformcron").valid()) {
        // Get form data
        let formData = {
            crontime: $('#cron_time').val(),
            <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your cron job setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-general-cron') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                        Swal.fire({
                              title: "Success",
                              text: response.message,
                              icon: "success",
                              timer: 2000,
                            });
                            
                        } else {
                             Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: response.message,
                                   timer: 2000,
                                });
                        }
                },
                error: function() {
                     Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:"Error occurred while submitting the form.",
                               timer: 2000,
                            });
                }
        });
        }
    });
    }
  });
});
</script>

<script>
$(document).ready(function () {
    $("#databaseform").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#databaseformbtn").on("click", function () {

    if ($("#databaseform").valid()) {
        // Get form data
        let formData = {
            database_clear_username: $('#database_clear_username').val(),
            database_clear_password: $('#database_clear_password').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
        title: "Are you sure?",
         text: "You want to update your Clear Database(Except Admin) setting?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
    }).then((result) => {
        if (result.isConfirmed) {
        // AJAX request
        $.ajax({
            url: '<?= base_url('/admin/update-setting-cleardatabase') ?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // Display success or error message
                if (response.status === 'success') {
                        Swal.fire({
                              title: "Success",
                              text: response.message,
                              icon: "success",
                              timer: 2000,
                            });
                            
                        } else {
                             Swal.fire({
                                  icon: "error",
                                  title: "Oops...",
                                  text: response.message,
                                   timer: 2000,
                                });
                        }
                },
                error: function() {
                     Swal.fire({
                              icon: "error",
                              title: "Oops...",
                              text:"Error occurred while submitting the form.",
                               timer: 2000,
                            });
                }
        });
        }
    });
    }
  });
});
</script>

<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.default_timezone').select2();
    });
</script>
 <script>
        const currencyDropdown = document.getElementById("currency");
        const currencySymbol = document.getElementById("currency-symbol");

        currencyDropdown.addEventListener("change", function () {
            const selectedOption = currencyDropdown.options[currencyDropdown.selectedIndex];
            currencySymbol.value = selectedOption.getAttribute("data-symbol");
        });
    </script>
    <script>
     function select_common_option() {
    const common = document.getElementById('common_options').value;

    if (common && common !== '--') {
        const parts = common.trim().split(/\s+/); // Trim + handle extra spaces

       
            const [min, hr, day, month, wkday] = parts;

            document.getElementById('minute').value = min;
            document.getElementById('hour').value = hr;
            document.getElementById('day').value = day;
            document.getElementById('month').value = month;
            document.getElementById('weekday').value = wkday;

            document.getElementById('cron_time').value = parts.join(' ');
        
    }
}

function select_single_option(field) {
    const select = document.getElementById(field + '_options');
    const input = document.getElementById(field);
    const value = select.value;

    if (value && value !== '--') {
        input.value = value;

        // Rebuild full cron time from all 5 inputs
        const cron = [
            document.getElementById('minute').value,
            document.getElementById('hour').value,
            document.getElementById('day').value,
            document.getElementById('month').value,
            document.getElementById('weekday').value
        ].join(' ');

        document.getElementById('cron_time').value = cron;
    }
}


    </script>
    <script>
    $(document).ready(function() {
     $("#sidebar-menu .setting").addClass('open');
     $("#sidebar-menu .setting").addClass('show');
     $("#sidebar-menu .setting").addClass('active-page');
    });
</script>
</body>
</html>