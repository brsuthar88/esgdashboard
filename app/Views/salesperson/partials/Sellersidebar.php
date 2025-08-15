 <?php
// Load the session service
$session = \Config\Services::session();

// Check if the user is logged in
$isLoggedIn = $session->get('isLoggedInseller');

if (!$isLoggedIn) {
    // Set a flash message and redirect
    $session->setFlashdata('msg', 'Logged out due to inactivity.');
    header('Location: /seller/login'); // Redirect to login page
    exit; // Make sure to exit after redirect
}
if ($GLOBALS['defaulttimezone']) {
    date_default_timezone_set($GLOBALS['defaulttimezone']);  // Set the timezone dynamically
} else {
    // Fallback to a default timezone if not found
    date_default_timezone_set('UTC');
}
?>

 <aside class="sidebar">
  <button type="button" class="sidebar-close-btn">
  <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
  </button>
  <div> <a href="/supplier" class="sidebar-logo"> <img src="<?= base_url('assets/images/logo.png');?>" alt="site logo" class="light-logo"> <img src="<?= base_url('assets/images/logo-light.png');?>" alt="site logo" class="dark-logo"> <img src="<?= base_url('assets/images/logo-icon.png');?>" alt="site logo" class="logo-icon"> </a> </div>
  <div class="sidebar-menu-area">
    <ul class="sidebar-menu" id="sidebar-menu">
      <li class="<?= uri_string() == 'supplier' ? 'active-main' : '' ?>"> <a href="/supplier">
        <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
        <span>Dashboard </span> </a> </li>
     <!-- <li class="dropdown quotation"> <a href="javascript:void(0)">
        <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
        <span>My Metrics</span> </a>
        <ul class="sidebar-submenu quotationsub">
          <li class="quotationlist"> <a href="/seller/list-Entry"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Data Entry</a> </li>
          <li class="quotationadd"> <a href="/seller/add-metric"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Add Metrics</a> </li>
        </ul>
      </li>
   
      
    <li class="<?= uri_string() == 'seller/evidence' ? 'active-main' : '' ?>"> <a href="/seller/evidence">
        <iconify-icon icon="mdi:shield" class="menu-icon"></iconify-icon>
        <span>Evidence Files</span> </a> </li>
        
     <li class="dropdown report"> <a href="javascript:void(0)">
		<iconify-icon icon="mdi:file-chart" class="menu-icon"></iconify-icon>
        <span>Reports</span> </a>
        <ul class="sidebar-submenu usersub">
          <li class="reportlist"> <a href="/seller/list-report"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>Reports</a> </li>
        </ul>
      </li>
      
	
		 <li class="<?= uri_string() == 'seller/setting' ? 'active-main' : '' ?>"> <a href="/seller/setting">
        <iconify-icon icon="hugeicons:settings-02" class="menu-icon"></iconify-icon>
        <span>Setting</span> </a> </li>-->
		
    </ul>
  </div>
</aside>
<main class="dashboard-main">
  <div class="navbar-header">
    <div class="row align-items-center justify-content-between">
      <div class="col-auto">
        <div class="d-flex flex-wrap align-items-center gap-4">
          <button type="button" class="sidebar-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon text-2xl non-active"></iconify-icon>
          <iconify-icon icon="iconoir:arrow-right" class="icon text-2xl active"></iconify-icon>
          </button>
          <button type="button" class="sidebar-mobile-toggle">
          <iconify-icon icon="heroicons:bars-3-solid" class="icon"></iconify-icon>
          </button>
        </div>
      </div>
      <div class="col-auto">
        <div class="d-flex flex-wrap align-items-center gap-3">
          <button type="button" data-theme-toggle class="w-40-px h-40-px bg-neutral-200 rounded-circle d-flex justify-content-center align-items-center"></button>
          <div class="dropdown">
            <button class="d-flex justify-content-center align-items-center rounded-circle" type="button" data-bs-toggle="dropdown"> <img src="<?= base_url('assets/images/user.png');?>" alt="image" class="w-40-px h-40-px object-fit-cover rounded-circle"> </button>
            <div class="dropdown-menu to-top dropdown-menu-sm">
              <div class="py-12 px-16 radius-8 bg-primary-50 mb-16 d-flex align-items-center justify-content-between gap-2">
                <div>
                  <h6 class="text-lg text-primary-light fw-semibold mb-2"><?=$sellerdata['email'];?></h6>
                  <span class="text-secondary-light fw-medium text-sm">Supplier</span> </div>
                <button type="button" class="hover-text-danger">
                <iconify-icon icon="radix-icons:cross-1" class="icon text-xl"></iconify-icon>
                </button>
              </div>
              <!--<ul class="to-top-list">
                <li> <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-primary d-flex align-items-center gap-3" href="/supplier/view-profile">
                  <iconify-icon icon="solar:user-linear" class="icon text-xl"></iconify-icon>
                  My Profile</a> </li>-->
                <li> <a class="dropdown-item text-black px-0 py-8 hover-bg-transparent hover-text-danger d-flex align-items-center gap-3" onclick="logout()">
                  <iconify-icon icon="lucide:power" class="icon text-xl"></iconify-icon>
                  Log Out</a> </li>
              </ul>
            </div>
          </div>
          <!-- Profile dropdown end --> 
        </div>
      </div>
    </div>
  </div>