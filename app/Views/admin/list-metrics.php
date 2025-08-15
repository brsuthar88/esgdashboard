<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>VSME Dashboard - ESG Reporting Platform</title>

<!-- css -->
<?php echo view('admin/partials/admincss'); ?>
<style type="text/css">
.bordered-table thead tr th,.bordered-table tbody tr td{font-size:14px;}
</style>
</head>
<body>

<!-- Sidebar -->
<?php echo view('admin/partials/adminsidebar', ['admindata' => $admindata]); ?>
  <div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
      <h6 class="fw-semibold mb-0">Metrics Configuration</h6>
      <ul class="d-flex align-items-center gap-2">
        <li class="fw-medium"> <a href="/admin" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard  </a> </li>
        <li>-</li>
        <li class="fw-medium">Metrics</li>
      </ul>
    </div>

<!-- Modal Structure -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title fw-bold">Configure Thresholds</h5>
      <button type="button" class="btn-close"></button>
    </div>
    <div class="modal-body">
      <h6 class="mb-3">Scope 1 Emissions</h6>
      <p class="text-muted">Configure threshold ranges for performance evaluation</p>

      <div class="row g-3 mb-4">
        <!-- Good Performance -->
        <div class="col-md-4">
          <div class="border rounded p-3 bg-light border-success">
            <h6 class="text-success fw-semibold">Good Performance</h6>
            <div class="mb-2">
              <label class="form-label">Minimum Value</label>
              <input type="number" class="form-control" placeholder="Leave empty for no range">
            </div>
            <div>
              <label class="form-label">Maximum Value</label>
              <input type="number" class="form-control" value="1000">
            </div>
          </div>
        </div>

        <!-- Warning Level -->
        <div class="col-md-4">
          <div class="border rounded p-3 bg-light border-warning">
            <h6 class="text-warning fw-semibold">Warning Level</h6>
            <div class="mb-2">
              <label class="form-label">Minimum Value</label>
              <input type="number" class="form-control" value="1000">
            </div>
            <div>
              <label class="form-label">Maximum Value</label>
              <input type="number" class="form-control" value="2000">
            </div>
          </div>
        </div>

        <!-- Critical Level -->
        <div class="col-md-4">
          <div class="border rounded p-3 bg-light border-danger">
            <h6 class="text-danger fw-semibold">Critical Level</h6>
            <div class="mb-2">
              <label class="form-label">Minimum Value</label>
              <input type="number" class="form-control" value="2000">
            </div>
            <div>
              <label class="form-label">Maximum Value</label>
              <input type="number" class="form-control" placeholder="Leave empty for no range">
            </div>
          </div>
        </div>
      </div>

      <!-- Preview Panel -->
      <div class="bg-light p-3 rounded mb-4">
        <h6 class="mb-2">Preview</h6>
        <span class="badge bg-success me-2">Good: ≤ 1000 tCO2e</span>
        <span class="badge bg-warning text-dark me-2">Warning: 1000 - 2000 tCO2e</span>
        <span class="badge bg-danger-subtle text-danger">Critical: ≥ 2000 tCO2e</span>
      </div>
    </div>

    <div class="modal-footer">
      <button class="btn btn-outline-secondary">Cancel</button>
      <button class="btn btn-primary">Save Thresholds</button>
    </div>
  </div>
</div>
</div>
    <div class="card basic-data-table scrollclass">
      <div class="card-body">
          <form>
        <table class="table bordered-table mb-0 responsive nowrap" style="width:100%" id="dataTable">
          <thead>
            <tr>
              <th style="width:15%">Indicator</th>
              <th style="width:20%">Description</th>
              <th>Good</th>
              <th style="width:10%">Warning</th>
              <th>Critical</th>
              <th>Data Points</th>
              <th>Last Updated</th>
              <th>Status</th>
              <th style="width:20%">Actions</th>
            </tr>
          </thead>
          <tbody>
                 <tr>
                  <td>
                    <strong>Scope 1 Emissions</strong><br>
                    <span class="badge bg-secondary">Climate</span>
                    <span class="badge bg-primary">tCO2e</span>
                  </td>
                  <td>Direct greenhouse gas emissions from owned or controlled sources</td>
                  <td><span class="badge bg-success">≤ 1000 tCO2e</span></td>
                  <td><span class="badge bg-warning text-dark">1000 - 2000 tCO2e</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≥ 2000 tCO2e</span></td>
                  <td><strong>156</strong></td>
                  <td>15/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>
                     <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button data-bs-toggle="modal" data-bs-target="#myModal"  type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
                </tr>
            
                <!-- Scope 2 Emissions -->
                <tr>
                  <td>
                    <strong>Scope 2 Emissions</strong><br>
                    <span class="badge bg-secondary">Climate</span>
                    <span class="badge bg-primary">tCO2e</span>
                  </td>
                  <td>Indirect greenhouse gas emissions from purchased energy</td>
                  <td><span class="badge bg-success">≤ 800 tCO2e</span></td>
                  <td><span class="badge bg-warning text-dark">800 - 1500 tCO2e</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≥ 1500 tCO2e</span></td>
                  <td><strong>142</strong></td>
                  <td>12/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>
                     <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
                </tr>
            
                <!-- Energy Intensity -->
                <tr>
                  <td>
                    <strong>Energy Intensity</strong><br>
                    <span class="badge bg-secondary">Climate</span>
                    <span class="badge bg-info text-dark">kWh/€</span>
                  </td>
                  <td>Energy consumption per unit of revenue</td>
                  <td><span class="badge bg-success">≤ 2 kWh/€</span></td>
                  <td><span class="badge bg-warning text-dark">2 - 4 kWh/€</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≥ 4 kWh/€</span></td>
                  <td><strong>98</strong></td>
                  <td>10/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>
                    <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
                </tr>
            
                <!-- Water Consumption -->
                <tr>
                  <td>
                    <strong>Water Consumption</strong><br>
                    <span class="badge bg-info text-dark">Water</span>
                    <span class="badge bg-primary">m³</span>
                  </td>
                  <td>Total water consumption across all operations</td>
                  <td><span class="badge bg-success">≤ 10000 m³</span></td>
                  <td><span class="badge bg-warning text-dark">10000 - 20000 m³</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≥ 20000 m³</span></td>
                  <td><strong>87</strong></td>
                  <td>8/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>

                    <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
        
                </tr>
            
                <!-- Water Intensity -->
                <tr>
                  <td>
                    <strong>Water Intensity</strong><br>
                    <span class="badge bg-info text-dark">Water</span>
                    <span class="badge bg-primary">m³/€</span>
                  </td>
                  <td>Water consumption per unit of revenue</td>
                  <td><span class="badge bg-success">≤ 0.5 m³/€</span></td>
                  <td><span class="badge bg-warning text-dark">0.5 - 1 m³/€</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≥ 1 m³/€</span></td>
                  <td><strong>76</strong></td>
                  <td>5/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>

                     <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
               
                </tr>
            
                <!-- Gender Diversity -->
                <tr>
                  <td>
                    <strong>Gender Diversity</strong><br>
                    <span class="badge bg-secondary">Diversity</span>
                    <span class="badge bg-primary">%</span>
                  </td>
                  <td>Percentage of female employees in workforce</td>
                  <td><span class="badge bg-success">≥ 45%</span></td>
                  <td><span class="badge bg-warning text-dark">30 - 45%</span></td>
                  <td><span class="badge bg-danger-subtle text-danger">≤ 30%</span></td>
                  <td><strong>124</strong></td>
                  <td>3/1/2024</td>
                  <td class="text-success"><span class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Active</span></td>
              
                    <td><div class="d-flex align-items-center gap-10 justify-content-center"><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-info" data-bs-title="View"><button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#viewuserchangeModal" data-value="9"><i class="fas fa-eye" aria-hidden="true"></i></button></a><a data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-success" data-bs-title="Edit"><button type="button" class="bg-success-focus bg-hover-success-200 text-success-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="modal" data-bs-target="#editusermodal" data-value="9"><i class="fas fa-pencil" aria-hidden="true"></i></button></a><button type="button" onclick="deleteusers(9)" class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-title="Delete"><i class="fas fa-trash" aria-hidden="true"></i></button></div><input type="hidden" value="Havells" id="fname9"><input type="hidden" value="Lighting" id="lname9"><input type="hidden" value="havells.lighting@gmail.com" id="email9"><input type="hidden" value="1234567890" id="phone9"><input type="hidden" value="Havells Lighting Admin" id="description9"></td>
                  
                </tr>
          </tbody>
        </table>
        </form>
      </div>
    </div>
  </div>

<div class="modal fade" id="passwordchangeModal" tabindex="-1" aria-labelledby="passwordchangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Customer Password Change</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
            <form id="myForm">
          <div class="row">
            <div class="col-12 mb-20">
               <div class="mb-20">
              <label for="your-password" class="form-label fw-semibold text-primary-light text-sm mb-8">New Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="your-password" placeholder="Enter New Password*" name="your-password" data-rule-required="true" data-msg-required="Password is required.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#your-password"></span> </div>
            </div>
            <div class="mb-20">
              <label for="confirm-password" class="form-label fw-semibold text-primary-light text-sm mb-8">Confirmed Password <span class="text-danger-600">*</span></label>
              <div class="position-relative">
                <input type="password" class="form-control radius-8" id="confirm-password" name="confirm-password" placeholder="Confirm Password*" data-rule-required="true" data-msg-required="Please confirm your password." data-rule-equalto="#your-password"  data-msg-equalto="Passwords do not match.">
                <span class="toggle-password ri-eye-line cursor-pointer position-absolute end-0 top-50 translate-middle-y me-16 text-secondary-light" data-toggle="#confirm-password"></span> </div>
            </div>
            </div>
          </div>
          <input type="hidden" id="modalValue">
          </form>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="button" id="changepassword" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update Password </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editcustomermodal" tabindex="-1" aria-labelledby="editcustomermodalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuseditcustomermodalLabel">Edit Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
      <form id="myFormedit">
          <div class="card-body p-24 pt-10">
            <div class="row gy-3">
              <div class="mb-20 col-sm-6">
                <label for="fname" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="fname" name="fname" placeholder="Enter First Name" value="<?= isset($customerdata['first_name']) ? htmlspecialchars($customerdata['first_name']) : '' ?>" data-rule-required="true" data-msg-required="First Name is required.">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="lname" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name <span class="text-danger-600">*</span></label>
                <input type="text" class="form-control radius-8" id="lname" name="lname" placeholder="Enter Last Name" value="<?= isset($customerdata['last_name']) ? htmlspecialchars($customerdata['last_name']) : '' ?>" data-rule-required="true" data-msg-required="Last Name is required.">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="email" class="form-label fw-semibold text-primary-light text-sm mb-8">Email <span class="text-danger-600">*</span></label>
                <input type="email" class="form-control radius-8" id="email" name="email" placeholder="Enter Email" value="<?= isset($customerdata['email']) ? htmlspecialchars($customerdata['email']) : '' ?>" data-rule-required="true" data-msg-required="Email is required."  data-rule-email="true" data-msg-email="Enter a valid email address.">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="number" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label>
                <input type="text" class="form-control radius-8" id="number" name="number" placeholder="Enter phone number" value="<?= isset($customerdata['phone_number']) ? htmlspecialchars($customerdata['phone_number']) : '' ?>"  data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890).">
              </div>
              <div class="mb-20 col-sm-6">
                <label for="depart" class="form-label fw-semibold text-primary-light text-sm mb-8">Category <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" id="depart" name="depart" data-rule-required="true" data-msg-required="Category is required.">
                <?php
                foreach ($custocate as $catrow):?>
                 
                    <option value="<?= $catrow['customer_category_id'];?>"><?= $catrow['category_name'];?> </option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="mb-20 col-sm-6">
                <label for="sellerid" class="form-label fw-semibold text-primary-light text-sm mb-8">Sales Person <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" id="sellerid" name="sellerid" data-rule-required="true" data-msg-required="Sales Person is required.">
                   <?php
                    foreach ($seller as $selrow):?>
                   
                        <option value="<?= $selrow['sales_person_id'];?>"><?=$selrow['first_name'];?> <?= $selrow['last_name'];?> </option>
                    <?php  endforeach; ?>
                </select>
              </div>
              <div class="mb-20 col-sm-6">
                <label for="destatus" class="form-label fw-semibold text-primary-light text-sm mb-8">Status <span class="text-danger-600">*</span> </label>
                <select class="form-control radius-8 form-select" id="destatus" name="destatus" data-rule-required="true" data-msg-required="Status is required.">
                  <option value="1" >Active </option>
                  <option value="0" >Inactive </option>
                </select>
              </div>
              <div class="mb-20 col-sm-6">
                <label for="desc" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label>
                <textarea name="#0" class="form-control radius-8" id="desc" placeholder="Write description..."><?= isset($customerdata['description']) ? htmlspecialchars($customerdata['description']) : '' ?></textarea>
              </div>
            </div>
            <div class="row gy-3">
              <div class="col-md-6">
				   <span class="card-title mb-10">Billing Address </span>
                
                <div class="row gy-3">
                 
					   <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" id="bcountry" placeholder="country" value="USA" disabled>
                  </div>
					 <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="baddress" class="form-control radius-8" id="baddress" placeholder="Address"  data-rule-required="true" data-msg-required="Address is required."><?= isset($customerdata['billing_address']) ? htmlspecialchars($customerdata['billing_address']) : '' ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" name="bcity" class="form-control" id="bcity"  placeholder="City" value="<?= isset($customerdata['billing_city']) ? htmlspecialchars($customerdata['billing_city']) : '' ?>" data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" name="bstate" class="form-control" id="bstate"  placeholder="State" value="<?= isset($customerdata['billing_state']) ? htmlspecialchars($customerdata['billing_state']) : '' ?>"  data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" name="bzip" class="form-control" id="bzip"  placeholder="Zip Code" value="<?= isset($customerdata['billing_pincode']) ? htmlspecialchars($customerdata['billing_pincode']) : '' ?>"  data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true" data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                   
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" class="form-control" name="bphone" id="bphone"  placeholder="Phone" value="<?= isset($customerdata['billing_phone_number']) ? htmlspecialchars($customerdata['billing_phone_number']) : '' ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." data-rule-required="true" data-msg-required="Phone is required.">
                   
                  </div>
                 
                 
                </div>
              </div>
              <div class="col-md-6">
                <span class="card-title mb-10">Shipping Address 
					(<a href="#" id="copyAddressBtn" class="text-info-main text-sm">
       
        Copy Billing Address </a>)
					
					
					</span>
                <div class="row gy-3">
					 <div class="col-12">
                    <label class="form-label">Country</label>
                    <input type="text" name="#0" class="form-control" id="scountry" Stateplaceholder="country" value="USA" disabled>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Address <span class="text-danger-600">*</span></label>
                   <textarea name="saddress" class="form-control radius-8" id="saddress" placeholder="Address" data-rule-required="true" data-msg-required="Address is required."><?= isset($customerdata['shipping_address']) ? htmlspecialchars($customerdata['shipping_address']) : '' ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">City <span class="text-danger-600">*</span></label>
                    <input type="text" name="scity" class="form-control" id="scity" placeholder="City" value="<?= isset($customerdata['shipping_city']) ? htmlspecialchars($customerdata['shipping_city']) : '' ?>" data-rule-required="true" data-msg-required="City is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">State <span class="text-danger-600">*</span></label>
                    <input type="text" name="sstate" class="form-control" id="sstate" placeholder="State" value="<?= isset($customerdata['shipping_state']) ? htmlspecialchars($customerdata['shipping_state']) : '' ?>" data-rule-required="true" data-msg-required="State is required.">
                  </div>
					   <div class="col-12">
                    <label class="form-label">Zip Code <span class="text-danger-600">*</span></label>
                    <input type="text" name="szip" class="form-control" id="szip" placeholder="Zip Code" value="<?= isset($customerdata['shipping_pincode']) ? htmlspecialchars($customerdata['shipping_pincode']) : '' ?>" data-msg-rangelength="Please enter a valid 5-digit zip code." data-rule-rangelength="5,5" data-rule-digits="true" data-rule-required="true" data-msg-required="Zip Code is required.">
                  </div>
                  
                  <div class="col-12">
                    <label class="form-label">Phone <span class="text-danger-600">*</span></label>
                   <input type="text" class="form-control" name="sphone" id="sphone" placeholder="Phone" value="<?= isset($customerdata['shipping_phone_number']) ? htmlspecialchars($customerdata['shipping_phone_number']) : '' ?>" data-rule-phoneau="true"  data-msg-phoneau="Please enter a valid phone number (e.g., +1 123 456 7890,1-123-456-7890,(123) 456-7890,123-456-7890,123.456.7890,1234567890)." data-rule-required="true" data-msg-required="Phone is required.">
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" id="customerid" value="<?= isset($customerdata['customer_id']) ? htmlspecialchars($customerdata['customer_id']) : '' ?>">
           
      </div>
      </form>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
        <button type="button" id="submitdata" class="btn btn-primary text-sm px-24 py-12 radius-8"> Update</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="viewcustchangeModal" tabindex="-1" aria-labelledby="passwordchangeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog modal-dialog-centered">
    <div class="modal-content radius-16 bg-base">
      <div class="modal-header py-16 px-24 border border-top-0 border-start-0 border-end-0">
        <h1 class="modal-title fs-5" id="statuschangeModalLabel">Customer Detail</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-24">
          <div class="row" id="custdata">
          </div>
      </div>
      <div class="modal-footer">
        <button data-bs-dismiss="modal" class="border border-danger-600 bg-hover-danger-200 text-danger-600 text-sm px-40 py-11 radius-8"> Close </button>
    </div>
  </div>
</div></div>


  <!-- footer -->
  <?php echo view('admin/partials/adminfooter'); ?>

  <!-- JS -->
  <?php echo view('admin/partials/adminjs'); ?>
<script>
      $(document).ready(function () {
          var isMobile = $(window).width() <= 1024; // Detect mobile (adjust as needed)
        $('#dataTable').DataTable({
            responsive: true,
            autoWidth: isMobile,
            searching: true,  // Disable searching on mobile
            columnDefs: [
                { "orderable": false, "targets": [0, -1] } 
            ],
            scrollX: isMobile // Enable scrolling on mobile
        });
    });
</script>

<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Boxed Tooltip
    $(document).ready(function() {
        $('.tooltip-button').each(function () {
            var tooltipButton = $(this);
            var tooltipContent = $(this).siblings('.my-tooltip').html();

            // Initialize the tooltip
            tooltipButton.tooltip({
                title: tooltipContent,
                trigger: 'hover',
                html: true
            });

            // Optionally, reinitialize the tooltip if the content might change dynamically
            tooltipButton.on('mouseenter', function() {
                tooltipButton.tooltip('dispose').tooltip({
                    title: tooltipContent,
                    trigger: 'hover',
                    html: true
                }).tooltip('show');
            });
        });
    });
</script>

<script>
$(document).ready(function () {

$("#myForm").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#changepassword").on("click", function () {

    if ($("#myForm").valid()) {

        // Get form data
        let formData = {
            cpassword: $('#confirm-password').val(),
            password: $('#your-password').val(),
            customerid: $('#modalValue').val(),
             <?=csrf_token()?>: '<?=csrf_hash()?>'
        };

        // AJAX request
        $.ajax({
            url: '<?=base_url('/admin/save-password-customer')?>',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Display success or error message
                if (response.status === 'success') {
                    Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
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
});
</script>

<script>
    // Add event listener for when the modal is shown
document.getElementById('passwordchangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');

    var modalValue = document.getElementById('modalValue');
    modalValue.value=value;
});

</script>

<script>
    // Add event listener for when the modal is shown
document.getElementById('viewcustchangeModal').addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget;

    // Extract value from data-* attribute
    var value = button.getAttribute('data-value');
    var fname=$('#fname'+value).val();
    var lname=$('#lname'+value).val();
    var email=$('#email'+value).val();
    var phone=$('#phone'+value).val();
    var cate=$('#cate'+value).val();
    var seller=$('#seller'+value).val();
    var status=$('#status'+value).val();
    var desc=$('#desc'+value).val();

    var saddress=$('#saddress'+value).val();
    var scity=$('#scity'+value).val();
    var sstate=$('#sstate'+value).val();
    var spincode=$('#spincode'+value).val();
    var sphone=$('#sphone'+value).val();

    var baddress=$('#baddress'+value).val();
    var bcity=$('#bcity'+value).val();
    var bstate=$('#bstate'+value).val();
    var bpincode=$('#bpincode'+value).val();
    var bphone=$('#bphone'+value).val();


     var htmls='<div class="card-body p-24 pt-10"><div class="row gy-3"><div class="mb-20 col-sm-6"><label for="fname5" class="form-label fw-semibold text-primary-light text-sm mb-8">First Name</label><input type="text" disabled class="form-control radius-8" id="fname5" value="'+fname+'"></div><div class="mb-20 col-sm-6"><label for="lname5" class="form-label fw-semibold text-primary-light text-sm mb-8">Last Name </label><input type="text" disabled class="form-control radius-8" id="lname5" value="'+lname+'"></div><div class="mb-20 col-sm-6"> <label for="email5" class="form-label fw-semibold text-primary-light text-sm mb-8">Email</label><input type="email" class="form-control radius-8" value="'+email+'" disabled id="email5"></div><div class="mb-20 col-sm-6"><label for="number5" class="form-label fw-semibold text-primary-light text-sm mb-8">Phone</label><input type="text" class="form-control radius-8" id="number5" disabled value="'+phone+'"></div><div class="mb-20 col-sm-6"><label for="depart5" class="form-label fw-semibold text-primary-light text-sm mb-8">Category</label><input type="text" class="form-control radius-8" id="depart5" disabled value="'+cate+'" disabled></div><div class="mb-20 col-sm-6"><label for="seller5" class="form-label fw-semibold text-primary-light text-sm mb-8">Sales Person</label><input type="text" class="form-control radius-8" id="seller5" value="'+seller+'" disabled></div><div class="mb-20 col-sm-6"> <label for="desig5" class="form-label fw-semibold text-primary-light text-sm mb-8">Status</label><input type="text" class="form-control radius-8" id="desig5" value="'+status+'" disabled></div><div class="mb-20 col-sm-6"><label for="desc5" class="form-label fw-semibold text-primary-light text-sm mb-8">Description</label><textarea name="#0" class="form-control radius-8" id="desc5" disabled>'+desc+'</textarea></div></div><div class="row gy-3"><div class="col-md-6"><span class="card-title mb-10">Billing Address </span><div class="row gy-3"><div class="col-12"><label class="form-label">Country</label> <input type="text" name="#0" class="form-control" id="bcountry"  value="USA" disabled></div><div class="col-12"><label class="form-label">Address</label><textarea name="#0" class="form-control radius-8" id="baddress" disabled>'+baddress+'</textarea></div><div class="col-12"><label class="form-label">City</label><input type="text" name="#0" class="form-control" id="bcity"disabled  value="'+bcity+'" ></div><div class="col-12"><label class="form-label">State</label><input type="text" name="#0" class="form-control" id="bstate"  disabled value="'+bstate+'"></div><div class="col-12"><label class="form-label">Zip Code</label><input type="text" name="#0" class="form-control" id="bzip"  value="'+bpincode+'" disabled></div><div class="col-12"><label class="form-label">Phone</label><input type="text" name="#0" class="form-control" id="bphone" value="'+bphone+'" disabled></div></div></div><div class="col-md-6"><span class="card-title mb-10">Shipping Address</span><div class="row gy-3"><div class="col-12"><label class="form-label">Country</label> <input type="text" name="#0" class="form-control" id="bcountry"  value="USA" disabled></div><div class="col-12"><label class="form-label">Address </label><textarea name="#0" class="form-control radius-8" id="baddress" disabled>'+saddress+'</textarea></div><div class="col-12"><label class="form-label">City</label><input type="text" name="#0" class="form-control" id="bcity" disabled value="'+scity+'" ></div><div class="col-12"><label class="form-label">State</label><input type="text" name="#0" class="form-control" id="bstate"  value="'+sstate+'" disabled></div><div class="col-12"><label class="form-label">Zip Code</label><input type="text" name="#0" class="form-control" id="bzip"  value="'+spincode+'" disabled></div><div class="col-12"><label class="form-label">Phone</label><input type="text" name="#0" class="form-control" id="bphone" disabled value="'+sphone+'"></div></div></div>';
        document.getElementById('custdata').innerHTML=htmls;
});

</script>
<script>
    function deletecustomer(custID) {
      Swal.fire({
          title: "Are you sure?",
          text: "You want to delete this customer?",
          icon: "warning",
          showCancelButton: true,
             confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
           confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {
            if (result.isConfirmed)
            {
                $.ajax({
                url: '<?=base_url('/admin/delete-customer')?>',
                type: 'POST',
                data: {
                    "custID": custID,
                    <?=csrf_token()?>: '<?=csrf_hash()?>'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                          $('#dataTable').DataTable().ajax.reload(null, false);
                      },
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
</script>
<script>
$(document).ready(function () {
    $.validator.addMethod("phoneau", function (value, element) {
         return this.optional(element) ||/^(?:\+1\s?)?(?:\(?\d{3}\)?[\s.-]?)?\d{3}[\s.-]?\d{4}$/.test(value);
    }, "Please enter a valid phone number.");
  // Initialize validation
$("#myFormedit").validate({
  focusInvalid: true, // Focus the invalid field
  invalidHandler: function (event, validator) {
    // Scroll to the first invalid element
    $('html, body').animate({
      scrollTop: $(validator.errorList[0].element).offset().top - 100 // Adjust offset as needed
    }, 500);
  }
});


  // Attach onclick handler to the button
  $("#submitdata").on("click", function () {

    if ($("#myFormedit").valid()) {
        // Get form data
        let formData = {
            customerid: $('#customerid').val(),
            fname: $('#fname').val(),
            lname: $('#lname').val(),
            email: $('#email').val(),
            number: $('#number').val(),
            depart: $('#depart').val(),
            sellerid: $('#sellerid').val(),
            destatus: $('#destatus').val(),
            desc: $('#desc').val(),
            bcountry: $('#bcountry').val(),
            baddress: $('#baddress').val(),
            bcity: $('#bcity').val(),
            bstate: $('#bstate').val(),
            bzip: $('#bzip').val(),
            bphone: $('#bphone').val(),
            scountry: $('#scountry').val(),
            saddress: $('#saddress').val(),
            scity: $('#scity').val(),
            sstate: $('#sstate').val(),
            szip: $('#szip').val(),
            sphone: $('#sphone').val(),
             <?= csrf_token() ?>: '<?= csrf_hash() ?>'
        };
        
 Swal.fire({
              title: "Are you sure?",
              text: "You want to update this customer?",
              icon: "warning",
               showCancelButton: true,
                  confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
            }).then((result) => {
                if (result.isConfirmed) 
                {
                    // AJAX request
                    $.ajax({
                        url: '<?= base_url('/admin/update-customer') ?>',
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
                                  allowOutsideClick: false,
                                   willClose: () => {
                                      $('#dataTable').DataTable().ajax.reload(null, false);
                          $('#editcustomermodal').modal('hide');
                                  },
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
  };
});
});
</script>
<script>
    document.getElementById('copyAddressBtn').addEventListener('click', function() {
        document.getElementById('saddress').value = document.getElementById('baddress').value;
        document.getElementById('scity').value = document.getElementById('bcity').value;
        document.getElementById('sstate').value = document.getElementById('bstate').value;
        document.getElementById('szip').value = document.getElementById('bzip').value;
        document.getElementById('sphone').value = document.getElementById('bphone').value;
    });
</script>
<script>
$(document).ready(function() {
    // When modal is about to be shown
    $('#editcustomermodal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var customerId = button.data('value'); // Get customer ID

        // AJAX request to fetch customer details
        $.ajax({
            url: "<?= base_url('/admin/getCustomerData') ?>", // Corrected backend route
            type: "POST",
            data: { customer_id: customerId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Populate modal fields with customer data
                    $('#customerid').val(response.data.customer_id);
                    $('#fname').val(response.data.first_name);
                    $('#lname').val(response.data.last_name);
                    $('#email').val(response.data.email);
                    $('#number').val(response.data.phone_number);
                    $('#desc').val(response.data.description);
                    $('#destatus').val(response.data.status);

                    // Populate category dropdown
                    $('#depart').val(response.data.customer_category_id);
                    
                    // Populate sales person dropdown
                    $('#sellerid').val(response.data.sales_person_id);

                    // Populate billing address fields
                    $('#baddress').val(response.data.billing_address);
                    $('#bcity').val(response.data.billing_city);
                    $('#bstate').val(response.data.billing_state);
                    $('#bzip').val(response.data.billing_pincode);
                    $('#bphone').val(response.data.billing_phone_number);

                    // Populate shipping address fields
                    $('#saddress').val(response.data.shipping_address);
                    $('#scity').val(response.data.shipping_city);
                    $('#sstate').val(response.data.shipping_state);
                    $('#szip').val(response.data.shipping_pincode);
                    $('#sphone').val(response.data.shipping_phone_number);
                } else {
                    alert("Customer data not found!");
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: ", error);
            }
        });
    });
});
</script>
<script>
    function logincust(custID) {
      Swal.fire({
          title: "Are you sure?",
          text: "You want to auto login this customer?",
          icon: "warning",
          showCancelButton: true,
             confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
           confirmButtonText: "Yes, Continue it!",
        cancelButtonText: "No, cancel",
        }).then((result) => {
            if (result.isConfirmed)
            {
                $.ajax({
                url: '<?=base_url('/admin/auto-login-customer')?>',
                type: 'POST',
                data: {
                    "custID": custID,
                    <?=csrf_token()?>: '<?=csrf_hash()?>'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                      title: "Success",
                      text: response.message,
                      icon: "success",
                      timer: 2000,
                      allowOutsideClick: false,
                       willClose: () => {
                         window.open('/', '_blank');
                      },
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
</script>
<style>
    #dataTable {
    width: 100% !important;
    table-layout: auto;
}

#dataTable td, #dataTable th {
    white-space: normal; /* Allows text to wrap */
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 100px; /* Adjust column width as needed */
}
#dataTable td:last-child, 
#dataTable th:last-child {
    white-space: normal !important;
    word-wrap: break-word !important;
    overflow-wrap: break-word !important;
    max-width: 150px !important;
}

</style>
<script>
    $(document).ready(function() {
     $("#sidebar-menu .metrics").addClass('open');
     $("#sidebar-menu .metricssub").addClass('show');
     $("#sidebar-menu .metricslist").addClass('active-page');
    });
</script>
</body>
</html>