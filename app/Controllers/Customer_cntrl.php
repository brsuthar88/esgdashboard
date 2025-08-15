<?php namespace App\Controllers;

use App\Models\Customer_mdl;
use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;

helper('zoho_helper');

class Customer_cntrl extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
           
            $dataview = ['customerdata' => $data];

            return view('dashboard', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

    public function login()
    {
        return view('sign-in'); // Load the login view
    }

    public function auth()
    {
        
        $session = session();
        $model = new Customer_mdl();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        if (!$email || !$password) {
            logAction('customer', 0,'failed', 'customer login', ['reason' => 'All fields are empty.']);
            return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            logAction('customer', 0,'failed', 'customer login', ['reason' => 'Invalid email address.', 'email' => $email]);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
        }

    
            $data = $model->where('email', $email)->first();
            if ($data) {
                $pass = $data['password'];
                $verify_pass = password_verify($password, $pass);
                if ($verify_pass) {
                    $session->set('cm_id', $data['cm_id']);
                    $session->set('isLoggedIn', true);
                    $data = $model->where('cm_id', $data['cm_id'])->first();
 return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful.']);
                } else {
                     logAction('customer', 0,'failed', 'Customer login', ['reason' => 'Incorrect password.', 'email' => $email,'password' => $password]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Incorrect password.']);
                }
            } else {
                 logAction('customer', 0,'failed', 'Customer login', ['reason' => 'Email not found.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email not found.']);

            }
      
    }

    public function listquotation()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $request = service('request');
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
           $getsupplier = $model->getallssuppliyeractive($data['email']);
           $getcompany = $model->getallcompanhy();
            $dataview = ['customerdata' => $data,"getcompany"=>$getcompany,'getsupplier'=>$getsupplier];
            return view('list-suppliers', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

   public function datatablelistquotation()
   {
        if ($this->session->has('isLoggedIn')) {
        $session = session();
        $request = service('request');
        $model = new Customer_mdl();
        $cm_id = $session->get('cm_id');
        $db = db_connect();
        $builder = $db->table('quotation')
            ->select('
                quotation.quotation_id, 
                quotation.quotation_number, 
                quotation.sales_person_id, 
                quotation.created_at AS quotation_created_at, 
                quotation.grand_total, 
                quotation.status, 
                CONCAT(sales_person.first_name, " ", sales_person.last_name) AS sales_person_name
            ')
            ->join('sales_person', 'sales_person.sales_person_id = quotation.sales_person_id', 'left')
            ->where('cm_id', $cm_id)
             ->orderBy('quotation.quotation_id', 'DESC');
        
        return DataTable::of($builder)
             ->edit('quotation_created_at', function ($row) {
                $row = (array) $row; // Convert object to array
                return date($GLOBALS['defaultdateformat'], strtotime($row['quotation_created_at']));
            })
            ->setSearchableColumns([
                'quotation.quotation_number',
                'quotation.created_at',
                'quotation.grand_total',
                'quotation.status',
                'sales_person.first_name', // Searchable by sales person's first name
                'sales_person.last_name'  // Searchable by sales person's last name
            ])
            ->toJson(true);




      /*  // Set the table and fields for the quotation model
        $model->setTableAndFields('quotation', ['quotation_id', 'quotation_number', 'sales_person_id', 'created_at', 'grand_total', 'status']);

        $columns = ['quotation_id', 'quotation_number', 'sales_person_id', 'created_at', 'grand_total', 'status'];

        // Get the data from the model
        $data = $model->getDataTables($request, $columns);

        return $this->response->setJSON($data);*/
        } else {
            return redirect()->to('/login');
        }
    }


  
    public function viewprofile()
    {

        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0]];
            return view('view-profile', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

     public function setting()
    {

        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0]];
            return view('/setting', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }
    
     public function analytics()
    {

        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0]];
            return view('/analytics', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }
    
    
    
   public function listperson()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0]];
            return view('list-report', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }
    public function customerprofileupdate()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desc = $this->request->getVar('desc');
            if (!$fname || !$email || !$lname || !$number || !$desc) {
                 logAction('customer',$cm_id,'failed', 'customer profile update', ['reason' => 'All fields are empty.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  logAction('customer', $cm_id,'failed', 'Customer profile update', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->where('email', $email)->where('cm_id !=', $cm_id)->first();

            if ($existingUser) {
                  logAction('customer',$cm_id,'failed', 'Customer profile update', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $updateSuccessful = $model->update($cm_id, ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);

            if (!$updateSuccessful) {
                  logAction('customer', $cm_id,'failed', 'Customer profile update', ['reason' => 'Profile update failed.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Profile update failed. Please try again.']);
            }
              logAction('customer',$cm_id,'success', 'Customer profile update', ['reason' => 'Profile updated successfully.', 'first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
              logAction('customer', 0,'failed', 'Customer profile update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function customerprofileupdatepass()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $yourpassword = $this->request->getVar('yourpassword');
            $confirmpassword = $this->request->getVar('confirmpassword');
            if (!$yourpassword || !$confirmpassword) {
                 logAction('customer',$cm_id,'failed', 'customer profile password update', ['reason' => 'All fields are empty.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                 logAction('customer',$cm_id,'failed', 'customer profile password update', ['reason' => 'New password and confirm password do not match.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);
            $updateSuccessful = $model->update($cm_id, ['password' => $newpassword]);

            if (!$updateSuccessful) {
                logAction('customer',$cm_id,'failed', 'customer profile password update', ['reason' => 'Password update failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }
             logAction('customer',$cm_id,'success', 'customer profile password update', ['reason' => 'Password updated successfully.','password' => $yourpassword]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);
        } else {
            logAction('customer',0,'failed', 'customer profile password update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function customeraddress()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0]];
            return view('address', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

    public function customeraddressupdate()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $billing_address = $this->request->getVar('billing_address');
            $billing_city = $this->request->getVar('billing_city');
            $billing_state = $this->request->getVar('billing_state');
            $billing_pincode = $this->request->getVar('billing_pincode');
            $billing_phone_number = $this->request->getVar('billing_phone_number');

            $shipping_address = $this->request->getVar('shipping_address');
            $shipping_city = $this->request->getVar('shipping_city');
            $shipping_state = $this->request->getVar('shipping_state');
            $shipping_pincode = $this->request->getVar('shipping_pincode');
            $shipping_phone_number = $this->request->getVar('shipping_phone_number');

            if (!$billing_address || !$billing_city || !$billing_state || !$billing_pincode || !$billing_phone_number) {
                logAction('customer',$cm_id,'failed', 'customer address update', ['reason' => 'All billing fields are empty.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All billing fields are required.']);
            }

            if (!$shipping_address || !$shipping_city || !$shipping_state || !$shipping_pincode || !$shipping_phone_number) {
                logAction('customer',$cm_id,'failed', 'customer address update', ['reason' => 'All shipping fields are empty.']);
                return $this->response->setJSON(['status' => 'errors', 'message' => 'All shipping fields are required.']);
            }

            $updateSuccessful = $model->update($cm_id, ['billing_address' => $billing_address, 'billing_city' => $billing_city, 'billing_state' => $billing_state, 'billing_pincode' => $billing_pincode, 'billing_phone_number' => $billing_phone_number, 'shipping_address' => $shipping_address, 'shipping_city' => $shipping_city, 'shipping_state' => $shipping_state, 'shipping_pincode' => $shipping_pincode, 'shipping_phone_number' => $shipping_phone_number]);

            if (!$updateSuccessful) {
                logAction('customer',$cm_id,'failed', 'customer address update', ['reason' => 'Address update failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Address update failed. Please try again.']);
            }
            logAction('customer',$cm_id,'success', 'customer address update', ['reason' => 'Address updated successfully!','billing_address' => $billing_address, 'billing_city' => $billing_city, 'billing_state' => $billing_state, 'billing_pincode' => $billing_pincode, 'billing_phone_number' => $billing_phone_number, 'shipping_address' => $shipping_address, 'shipping_city' => $shipping_city, 'shipping_state' => $shipping_state, 'shipping_pincode' => $shipping_pincode, 'shipping_phone_number' => $shipping_phone_number]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Address updated successfully!']);
        } else {
            logAction('customer',0,'failed', 'customer address update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    public function getfilterdata()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
    
            $formats = $this->request->getPost('formats');
            $startDate = $this->request->getPost('startDate'); // new
            $endDate = $this->request->getPost('endDate');     // new
    
            $listformate = $model->getdatafromreporttable($formats, $cm_id, $startDate, $endDate);
            return $this->response->setJSON($listformate);
        } else {
            return redirect()->to('/login');
        }
    }

    public function customeraddquotation()
    {

        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $getsupplier = $model->getallssuppliyerwithcurrent($cm_id);
            $getcompany = $model->getallcompanhy();
            $dataview = ['customerdata' => $data,"getcompany"=>$getcompany,'getsupplier'=>$getsupplier];
            return view('add-suppliers', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }
    public function checkemailcvr()
    {
        if ($this->session->has('isLoggedIn')) {
            $email = $this->request->getVar('email');
            $model = new Customer_mdl();
            $result = $model->checkemailcvr($email);
    
            if (!empty($result)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'cvr' => $result[0]['cvr'],  // send first record's CVR
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Email not found',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Session expired, please login again.',
            ]);
        }
    }
    
    public function checkcvremail()
    {
        if ($this->session->has('isLoggedIn')) {
            $cvr = $this->request->getVar('cvr');
            $model = new Customer_mdl();
            $result = $model->checkcvremail($cvr);
    
            if (!empty($result)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'email' => $result[0]['email'],  // send first record's email
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'CVR not found',
                ]);
            }
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Session expired, please login again.',
            ]);
        }
    }


    public function customersavequotation()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();

            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $Zohoaccess = $model->getZohoAccess();
            $clientId = "";
            $clientSecret = "";
            $refreshToken = "";
            $organization_id = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "zoho_client_id") {
                    $clientId = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_client_secret") {
                    $clientSecret = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshTokenbook = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
            if ($accessToken) {
                $custtypeprice = zoho_get_inventory_price_type($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $datapost = $this->request->getPost('qtyvalue');
                $itemdata = array();
                $itemlist = array();
                $totalprice = 0;
                $ratenew = 0;
                foreach ($datapost as $dataval) {
                    $slicedata = explode("BHAVIK", $dataval);
                    $qty = $slicedata[0];
                    $ids = str_replace("qty", "", $slicedata[1]);

                    $itemsdt = zoho_get_records_inventory_byid($accessToken, $organization_id, $categories[0]['pricebook_id'], $ids);
                    if (isset($itemsdt['item_id'])) {
                        $itemdata['qtys'] = $qty;
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['sku'] = $itemsdt['sku'];
                        if (isset($custtypeprice[$itemsdt['item_id']])) {
                            $ratenew = $custtypeprice[$itemsdt['item_id']];
                            $itemdata['pricebook_rate'] = $custtypeprice[$itemsdt['item_id']];
                        } else {
                            $ratenew = $itemsdt['rate'];
                            $itemdata['pricebook_rate'] = $itemsdt['rate'];
                        }
                        if (isset($itemsdt['cf_specificationsheet'])) {
                            $itemdata['cf_sheet'] = $itemsdt['cf_specificationsheet'];

                        } else {
                            $itemdata['cf_sheet'] = "null";
                        }

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'cm_id' => $cm_id,
                    'sales_person_id' => $data['sales_person_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data['created_by_user'],
                    'created_by_userid' => $data['created_by_userid'],
                    'address_json' => $data['shipping_address'] . "," . $data['shipping_city'] . "," . $data['shipping_state'] . "," . $data['shipping_pincode'] . "," . $data['shipping_phone_number'],
                );
                
                $savequotation = $model->insertquotation($datas);
                $totals = 0;
                foreach ($itemlist as $dataint) {
                    $totals = $dataint['qtys'] * $dataint['pricebook_rate'];
                    $datasitem = array(
                        'quotation_id' => $savequotation,
                        'item_id' => $dataint['item_id'],
                        'amount' => $dataint['pricebook_rate'],
                        'quantity' => $dataint['qtys'],
                        'total' => $totals,
                        'item_name' => $dataint['item_name'],
                        'item_sku' => $dataint['sku'],
                        'item_description' => $dataint['description'],
                        'item_unit' => $dataint['unit'],
                    );
                    
                   
                    $savequotations = $model->insertquotatioitem($datasitem);
                }

                if (!$savequotation) {
                    logAction('customer',$cm_id,'failed', 'customer save quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }
                 logAction('customer',$cm_id,'success', 'customer save quotation', ['reason' => 'Quotation saved successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation saved successfully.']);

            } else {
                logAction('customer',$cm_id,'failed', 'customer save quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
            logAction('customer',0,'failed', 'customer save quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    
    public function companymanagersendsuppliers()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $email = $this->request->getVar('email');
            $cvr = $this->request->getVar('cvr');
            $cnames = $this->request->getVar('cnames');
            $personalMessage = $this->request->getVar('personalMessage');

           
            if (!$email) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$cvr) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'CVR fields are required.']);
            }
            
             if (!$cnames) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationsupplier($email);
            if ($existingUser) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

             $yourpassword = $cvr . "@" . rand();
        $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);
        // Prepare data for insert
        $datasitem = [
            'email'       => $email,
            'password' => $newpassword,
            'company_id'  => $cnames,
            'cvr'  => $cvr,
            'personalMessage' => $personalMessage, // store permissions as JSON
        ];

            $insertSuccessful = $model->insertsupplierdata($datasitem);
                
                if (!$insertSuccessful) {
                     logAction('company manager',$cm_id,'failed', 'company manager send supplier', ['reason' => 'Supplier save failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Supplier save failed. Please try again.']);
                }
            else {
                $to = $email; // recipient email
            $subject = "Your Supplier Account Details";

// Example credentials
$user_email = $email;
$user_password = $yourpassword;

$message = "
Hello,

Your Supplier account has been created.

Email: $user_email
Password: $user_password

Please change your password after logging in.

Thanks,
VSME Dashboard - ESG Reporting Platform";

$headers = "From: no-reply@vyanainfosys.in\r\n";
$headers .= "Reply-To: support@vyanainfosys.in\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

if (mail($to, $subject, $message, $headers)) {
     logAction('company manager',$cm_id,'success', 'company manager save and send supplier', ['reason' => 'Supplier save and send mail successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Supplier save and send mail successfully.']);
} else {
   logAction('company manager',$cm_id,'failed', 'company manager save and not send supplier', ['reason' => 'Supplier save but not send mail.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully.']);
}
                
            }

        } else {
            logAction('company manager',0,'failed', 'company manager send supplier', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    
    

    public function customersavesendquotation()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $Zohoaccess = $model->getZohoAccess();
            $clientId = "";
            $clientSecret = "";
            $refreshToken = "";
            $organization_id = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "zoho_client_id") {
                    $clientId = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_client_secret") {
                    $clientSecret = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshTokenbook = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
            if ($accessToken) {
                $custtypeprice = zoho_get_inventory_price_type($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $datapost = $this->request->getPost('qtyvalue');
                $itemdata = array();
                $itemlist = array();
                $totalprice = 0;
                $ratenew = 0;
                foreach ($datapost as $dataval) {
                    $slicedata = explode("BHAVIK", $dataval);
                    $qty = $slicedata[0];
                    $ids = str_replace("qty", "", $slicedata[1]);

                    $itemsdt = zoho_get_records_inventory_byid($accessToken, $organization_id, $categories[0]['pricebook_id'], $ids);
                    if (isset($itemsdt['item_id'])) {
                        $itemdata['qtys'] = $qty;
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['sku'] = $itemsdt['sku'];
                        if (isset($custtypeprice[$itemsdt['item_id']])) {
                            $ratenew = $custtypeprice[$itemsdt['item_id']];
                            $itemdata['pricebook_rate'] = $custtypeprice[$itemsdt['item_id']];
                        } else {
                            $ratenew = $itemsdt['rate'];
                            $itemdata['pricebook_rate'] = $itemsdt['rate'];
                        }

                        if (isset($itemsdt['cf_specificationsheet'])) {
                            $itemdata['cf_sheet'] = $itemsdt['cf_specificationsheet'];

                        } else {
                            $itemdata['cf_sheet'] = "null";
                        }
                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'cm_id' => $cm_id,
                    'sales_person_id' => $data['sales_person_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data['created_by_user'],
                    'created_by_userid' => $data['created_by_userid'],
                    'address_json' => $data['shipping_address'] . "," . $data['shipping_city'] . "," . $data['shipping_state'] . "," . $data['shipping_pincode'] . "," . $data['shipping_phone_number'],
                );
                $savequotation = $model->insertquotation($datas);
                $totals = 0;
                foreach ($itemlist as $dataint) {
                    $totals = $dataint['qtys'] * $dataint['pricebook_rate'];
                    $datasitem = array(
                        'quotation_id' => $savequotation,
                        'item_id' => $dataint['item_id'],
                        'amount' => $dataint['pricebook_rate'],
                        'quantity' => $dataint['qtys'],
                        'total' => $totals,
                        'item_name' => $dataint['item_name'],
                        'item_sku' => $dataint['sku'],
                        'item_description' => $dataint['description'],
                        'item_unit' => $dataint['unit'],
                    );
                    $savequotations = $model->insertquotatioitem($datasitem);
                }
                 $listquotationdata = $model->getcm_idquotation($savequotation);
                $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
                if (!$savequotation) {
                     logAction('customer',$cm_id,'failed', 'customer save and send quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }

                $listquotationdata = $model->getcm_idquotation($savequotation);
                $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];

                $html = view('view-quote-new', $dataview);

                // Get the DOMPDF service
                $dompdf = Services::dompdf();
                // Load the HTML content into DOMPDF
                $dompdf->loadHtml($html);

                // Set paper size (optional)
                $dompdf->setPaper('A4', 'portrait');

                // Render the PDF (first pass)
                $dompdf->render();

                // Output the generated PDF (stream to browser)
                // return $dompdf->stream('invoice.pdf');

                $fileoutput = base64_encode($dompdf->output());
                $Zohoaccess = $model->getZohoAccess();
                $smtp2gokey = "";
                $smtp2email = "";
                foreach ($Zohoaccess as $zohodata) {
                    if ($zohodata['key_name'] == "smtp2go_key") {
                        $smtp2gokey = $zohodata['value'];
                    }
                    if ($zohodata['key_name'] == "smtp2go_email") {
                        $smtp2email = $zohodata['value'];
                    }
                }
                $toemial = $data["email"];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Havells Lighting\",\n  \"html_body\": \" <b>Quote Invoice</b><br></br>Havells Lighting LLC<br></br>111 Preamble CT<br></br>Anderson South Carolina 29621<br></br>8554283557<br></br>www.havellslighting.com\",\n\t\"attachments\": [\n    {\n      \"filename\": \"$filename\",\n      \"fileblob\": \"$fileoutput\",\n      \"mimetype\": \"application/pdf\"\n   \t}\n\t]\n  \n}\n");

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
                $headers[] = 'Accept: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    logAction('customer',$cm_id,'failed', 'customer save and send quotation', ['reason' => 'Mail sending failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Mail sending failed. Please contact the administrator.']);
                } else {
                    logAction('customer',$cm_id,'success', 'customer save and send quotation', ['reason' => 'Quotation sent and saved successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation sent and saved successfully. Check your mailbox.']);

                }
                curl_close($ch);

            } else {
                logAction('customer',$cm_id,'failed', 'customer save and send quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
            logAction('customer',0,'failed', 'customer save and send quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }




    public function customersavedownquotation()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $Zohoaccess = $model->getZohoAccess();
            $clientId = "";
            $clientSecret = "";
            $refreshToken = "";
            $organization_id = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "zoho_client_id") {
                    $clientId = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_client_secret") {
                    $clientSecret = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshTokenbook = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
            if ($accessToken) {
                $custtypeprice = zoho_get_inventory_price_type($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $datapost = $this->request->getPost('qtyvalue');
                $itemdata = array();
                $itemlist = array();
                $totalprice = 0;
                $ratenew = 0;
                foreach ($datapost as $dataval) {
                    $slicedata = explode("BHAVIK", $dataval);
                    $qty = $slicedata[0];
                    $ids = str_replace("qty", "", $slicedata[1]);

                    $itemsdt = zoho_get_records_inventory_byid($accessToken, $organization_id, $categories[0]['pricebook_id'], $ids);
                    if (isset($itemsdt['item_id'])) {
                        $itemdata['qtys'] = $qty;
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['sku'] = $itemsdt['sku'];
                        if (isset($custtypeprice[$itemsdt['item_id']])) {
                            $ratenew = $custtypeprice[$itemsdt['item_id']];
                            $itemdata['pricebook_rate'] = $custtypeprice[$itemsdt['item_id']];
                        } else {
                            $ratenew = $itemsdt['rate'];
                            $itemdata['pricebook_rate'] = $itemsdt['rate'];
                        }
                        if (isset($itemsdt['cf_specificationsheet'])) {
                            $itemdata['cf_sheet'] = $itemsdt['cf_specificationsheet'];

                        } else {
                            $itemdata['cf_sheet'] = "null";
                        }

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'cm_id' => $cm_id,
                    'sales_person_id' => $data['sales_person_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data['created_by_user'],
                    'created_by_userid' => $data['created_by_userid'],
                    'address_json' => $data['shipping_address'] . "," . $data['shipping_city'] . "," . $data['shipping_state'] . "," . $data['shipping_pincode'] . "," . $data['shipping_phone_number'],
                );
                $savequotation = $model->insertquotation($datas);
                $totals = 0;
                foreach ($itemlist as $dataint) {
                    $totals = $dataint['qtys'] * $dataint['pricebook_rate'];
                    $datasitem = array(
                        'quotation_id' => $savequotation,
                        'item_id' => $dataint['item_id'],
                        'amount' => $dataint['pricebook_rate'],
                        'quantity' => $dataint['qtys'],
                        'total' => $totals,
                        'item_name' => $dataint['item_name'],
                        'item_sku' => $dataint['sku'],
                        'item_description' => $dataint['description'],
                        'item_unit' => $dataint['unit'],
                    );
                    $savequotations = $model->insertquotatioitem($datasitem);
                }

                if (!$savequotation) {
                     logAction('customer',$cm_id,'failed', 'customer savea and download quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }

                $listquotationdata = $model->getcm_idquotation($savequotation);
                $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];
                 $quonumber="Quote".$listquotationdata['mainquot'][0]['quotation_number'];
                $html = view('view-quote-new', $dataview);
                // Get the DOMPDF service
                $dompdf = Services::dompdf();
                // Load the HTML content into DOMPDF
                $dompdf->loadHtml($html);

                // Set paper size (optional)
                $dompdf->setPaper('A4', 'portrait');

                // Render the PDF (first pass)
                $dompdf->render();

                // Output the generated PDF (stream to browser)
                //return $dompdf->stream('invoice.pdf');

                // Save the PDF to a file
                $output = $dompdf->output();
                  $filePath = "assets/invoicesavedownload/$quonumber.pdf";

                try {
                    file_put_contents($filePath, $output);

                    // Return success message in JSON
                 logAction('customer',$cm_id,'success', 'customer save and download quotation', ['reason' => 'Quotation sent and downloaded successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Quotation saved and downloaded successfully. Check your download folder.',
                        'downloadUrl' => 'https://partner1.havellslighting.com/' . $filePath,
                    ]);

                } catch (Exception $e) {
                    // Handle error and return a JSON response
                     logAction('customer',$cm_id,'failed', 'customer savea and download quotation', ['reason' => 'Failed to save PDF: ' . $e->getMessage()]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save PDF: ' . $e->getMessage()]);

                }
                logAction('customer',$cm_id,'success', 'customer save and download quotation', ['reason' => 'Quotation save successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Quotation saved successfully.',
                ]);

            } else {
               logAction('customer',$cm_id,'failed', 'customer savea and download quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
            logAction('customer',0,'failed', 'customer save and send quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function customersaveprintquotation()
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $Zohoaccess = $model->getZohoAccess();
            $clientId = "";
            $clientSecret = "";
            $refreshToken = "";
            $organization_id = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "zoho_client_id") {
                    $clientId = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_client_secret") {
                    $clientSecret = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshTokenbook = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
            if ($accessToken) {
                $custtypeprice = zoho_get_inventory_price_type($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $datapost = $this->request->getPost('qtyvalue');
                $itemdata = array();
                $itemlist = array();
                $totalprice = 0;
                $ratenew = 0;
                foreach ($datapost as $dataval) {
                    $slicedata = explode("BHAVIK", $dataval);
                    $qty = $slicedata[0];
                    $ids = str_replace("qty", "", $slicedata[1]);

                    $itemsdt = zoho_get_records_inventory_byid($accessToken, $organization_id, $categories[0]['pricebook_id'], $ids);
                    if (isset($itemsdt['item_id'])) {
                        $itemdata['qtys'] = $qty;
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['sku'] = $itemsdt['sku'];
                        if (isset($custtypeprice[$itemsdt['item_id']])) {
                            $ratenew = $custtypeprice[$itemsdt['item_id']];
                            $itemdata['pricebook_rate'] = $custtypeprice[$itemsdt['item_id']];
                        } else {
                            $ratenew = $itemsdt['rate'];
                            $itemdata['pricebook_rate'] = $itemsdt['rate'];
                        }
                        if (isset($itemsdt['cf_specificationsheet'])) {
                            $itemdata['cf_sheet'] = $itemsdt['cf_specificationsheet'];

                        } else {
                            $itemdata['cf_sheet'] = "null";
                        }

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'cm_id' => $cm_id,
                    'sales_person_id' => $data['sales_person_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data['created_by_user'],
                    'created_by_userid' => $data['created_by_userid'],
                    'address_json' => $data['shipping_address'] . "," . $data['shipping_city'] . "," . $data['shipping_state'] . "," . $data['shipping_pincode'] . "," . $data['shipping_phone_number'],
                );
                $savequotation = $model->insertquotation($datas);
                $totals = 0;
                foreach ($itemlist as $dataint) {
                    $totals = $dataint['qtys'] * $dataint['pricebook_rate'];
                    $datasitem = array(
                        'quotation_id' => $savequotation,
                        'item_id' => $dataint['item_id'],
                        'amount' => $dataint['pricebook_rate'],
                        'quantity' => $dataint['qtys'],
                        'total' => $totals,
                        'item_name' => $dataint['item_name'],
                        'item_sku' => $dataint['sku'],
                        'item_description' => $dataint['description'],
                        'item_unit' => $dataint['unit'],
                    );
                    $savequotations = $model->insertquotatioitem($datasitem);
                }
                $listquotationdata = $model->getcm_idquotation($savequotation);
                $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];
                $html = view('view-quote-new', $dataview);

                if (!$savequotation) {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Address update failed. Please try again.']);
                }
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation saved successfully.', 'htmlcode' => $html]);

            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function inventory()
    {

        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $Zohoaccess = $model->getZohoAccess();
            $clientId = "";
            $clientSecret = "";
            $refreshToken = "";
            $organization_id = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "zoho_client_id") {
                    $clientId = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_client_secret") {
                    $clientSecret = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshTokenbook = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
           /* $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
            if ($accessToken) {
                $records = zoho_get_records_inventory($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $custtypeprice = zoho_get_inventory_price_type($accessToken, $organization_id, $categories[0]['pricebook_id']);
                $itemdata = array();
                $itemlist = array();
                $i = 0;
                foreach ($records as $itemsdt) {

                    $itemdata['item_id'] = $itemsdt['item_id'];
                    $itemdata['item_name'] = $itemsdt['item_name'];
                    $itemdata['unit'] = $itemsdt['unit'];
                    $itemdata['description'] = $itemsdt['description'];
                    $itemdata['rate'] = $itemsdt['rate'];
                    if (isset($itemsdt['available_stock'])) {
                        $availableStock = $itemsdt['available_stock'];
                    } else {
                        // Handle the case where the key doesn't exist
                        $availableStock = 0; // Default value, or you can handle it differently
                    }
                    $itemdata['stocks'] = $availableStock;
                    $itemdata['sku'] = $itemsdt['sku'];
                    if (isset($custtypeprice[$itemsdt['item_id']])) {
                        $itemdata['pricebook_rate'] = $custtypeprice[$itemsdt['item_id']];
                    } else {
                        $itemdata['pricebook_rate'] = "null";
                    }
                    if (isset($itemsdt['cf_specificationsheet'])) {
                        $itemdata['cf_sheet'] = $itemsdt['cf_specificationsheet'];

                    } else {
                        $itemdata['cf_sheet'] = "null";
                    }
                    $itemlist[] = $itemdata;
                }

            } else {
                  logAction('customer',$cm_id,'failed', 'customer inventory', ['reason' => 'Zoho authentication failed.']);
                $itemlist = 'Zoho authentication failed.';
            }*/

            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemlist' => ""];
            return view('inventory', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

    public function viewquote($id)
    {
        if ($this->session->has('isLoggedIn')) {
            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $listquotationdata = $model->getcm_idquotation($id);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];
            return view('view-quote', $dataview);
        } else {
            return redirect()->to('/login');
        }
    }

    public function generate_pdf($id)
    {
        if ($this->session->has('isLoggedIn')) {

            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $listquotationdata = $model->getcm_idquotation($id);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];
            $html = view('view-quote-new', $dataview);
            // Get the DOMPDF service
            $dompdf = Services::dompdf();
            // Load the HTML content into DOMPDF
            $dompdf->loadHtml($html);

            // Set paper size (optional)
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF (first pass)
            $dompdf->render();

            // Output the generated PDF (stream to browser)
            $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            return $dompdf->stream($filename);
        } else {
            return redirect()->to('/login');
        }
    }

    public function sendListEmail($ids)
    {

        if ($this->session->has('isLoggedIn')) {

            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $listquotationdata = $model->getcm_idquotation($ids);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];

                $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $html = view('view-quote-new', $dataview);

            // Get the DOMPDF service
            $dompdf = Services::dompdf();
            // Load the HTML content into DOMPDF
            $dompdf->loadHtml($html);

            // Set paper size (optional)
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF (first pass)
            $dompdf->render();

            // Output the generated PDF (stream to browser)
            // return $dompdf->stream('invoice.pdf');

            $fileoutput = base64_encode($dompdf->output());
            $Zohoaccess = $model->getZohoAccess();
            $smtp2gokey = "";
            $smtp2email = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "smtp2go_key") {
                    $smtp2gokey = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "smtp2go_email") {
                    $smtp2email = $zohodata['value'];
                }
            }
            $toemial = $data["email"];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Havells Lighting\",\n  \"html_body\": \" <b>Quote Invoice</b><br></br>Havells Lighting LLC<br></br>111 Preamble CT<br></br>Anderson South Carolina 29621<br></br>8554283557<br></br>www.havellslighting.com\",\n\t\"attachments\": [\n    {\n      \"filename\": \"$filename\",\n      \"fileblob\": \"$fileoutput\",\n      \"mimetype\": \"application/pdf\"\n   \t}\n\t]\n  \n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $session = \Config\Services::session();
                $session->setFlashdata('msg', 'Something Wrong.');
                  logAction('customer',$cm_id,'failed', 'customer send list mail', ['reason' => 'Something wrong.']);
                return redirect()->to('/list-quotation/');
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                 logAction('customer',$cm_id,'success', 'customer send list mail', ['reason' => 'Check your mailbox.','pdf'=>$filename]);
                return redirect()->to('/list-quotation/');

            }
            curl_close($ch);

        } else {
            return redirect()->to('/login');
        }

    }

    public function sendEmail($ids)
    {

        if ($this->session->has('isLoggedIn')) {

            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $categories = $model->getCustomerCategories($data['customer_category_id']);
            $salse_data = $model->getSellerdataCategories($data['sales_person_id']);
            $listquotationdata = $model->getcm_idquotation($ids);
            $dataview = ['customerdata' => $data, 'categories' => $categories[0], 'sellerdata' => $salse_data[0], 'itemdata' => $listquotationdata];

                $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $html = view('view-quote-new', $dataview);

            // Get the DOMPDF service
            $dompdf = Services::dompdf();
            // Load the HTML content into DOMPDF
            $dompdf->loadHtml($html);

            // Set paper size (optional)
            $dompdf->setPaper('A4', 'portrait');

            // Render the PDF (first pass)
            $dompdf->render();

            // Output the generated PDF (stream to browser)
            // return $dompdf->stream('invoice.pdf');

            $fileoutput = base64_encode($dompdf->output());
            $Zohoaccess = $model->getZohoAccess();
            $smtp2gokey = "";
            $smtp2email = "";
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "smtp2go_key") {
                    $smtp2gokey = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "smtp2go_email") {
                    $smtp2email = $zohodata['value'];
                }
            }
            $toemial = $data["email"];

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Havells Lighting\",\n  \"html_body\": \" <b>Quote Invoice</b><br></br>Havells Lighting LLC<br></br>111 Preamble CT<br></br>Anderson South Carolina 29621<br></br>8554283557<br></br>www.havellslighting.com\",\n\t\"attachments\": [\n    {\n      \"filename\": \"$filename\",\n      \"fileblob\": \"$fileoutput\",\n      \"mimetype\": \"application/pdf\"\n   \t}\n\t]\n  \n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $session = \Config\Services::session();
                $session->setFlashdata('msg', 'Mail sending failed. Please contact the administrator.');
                 logAction('customer',$cm_id,'failed', 'customer send mail', ['reason' => 'Mail sending failed.']);
                return redirect()->to('/view-quote/' . $ids);
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                logAction('customer',$cm_id,'success', 'customer send mail', ['reason' => 'Check your mailbox.','pdf'=>$filename]);
                return redirect()->to('/view-quote/' . $ids);

            }
            curl_close($ch);

        } else {
            return redirect()->to('/login');
        }

    }

    public function deletequotation()
    {
        // Check if the ID is provided in the POST data

        if ($this->session->has('isLoggedIn')) {

            $session = session();
            $model = new Customer_mdl();
            $cm_id = $session->get('cm_id');
            $data = $model->where('cm_id', $cm_id)->first();
            $id = $this->request->getPost('id');
            $deletquote = $model->postdeletequotation($id);
            if ($deletquote == 1) {
                logAction('customer',$cm_id,'success', 'customer delete quotation', ['reason' => 'Delete quotation successfully.','quotation'=>$id]);
                return $this->response->setJSON(['status' => 'success']);
            } else {
                logAction('customer',$cm_id,'failed', 'customer delete quotation', ['reason' => 'Delete quotation failed.','quotation'=>$id]);
                return $this->response->setJSON(['status' => 'error']);
            }
        } else {
            return redirect()->to('/login');
        }

    }

    public function customerforgotpassword()
    {
        return view('forgot-password');
    }

    public function customersendpassword()
    {

        $email = $this->request->getPost('email');
        if (!$email) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email fields are required.');
            logAction('customer',0,'failed', 'customer send password', ['reason' => 'Email fields are required.','email'=>$email]);
            return redirect()->to('/forgot-password');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Enter a valid email address.');
            logAction('customer',0,'failed', 'customer send password', ['reason' => 'Enter a valid email addres.','email'=>$email]);
            return redirect()->to('/forgot-password');
        }
        // Check if the email exists in the database
        $model = new Customer_mdl();
        $customer = $model->where('email', $email)->first();

        if ($customer) {
            // Generate a reset token
            $token = bin2hex(random_bytes(50)); // You can use a more secure method
            $expiresAt = date('Y-m-d H:i:s', time() + 3600); // Token expires in 1 hour

            // Store the token and expiration date in the database

            $updateSuccessful = $model->update($customer['cm_id'], ['reset_token' => $token, 'reset_token_expiry' => $expiresAt]);

            // Send the reset link via email
            $this->_send_reset_email($email, $token);

            $session = \Config\Services::session();
            $session->setFlashdata('success', 'Check your email for the reset link.');
            logAction('customer',0,'success', 'customer send password', ['reason' => 'Check your email for the reset link.','email'=>$email]);
            return redirect()->to('/login');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email address not found.');
            logAction('customer',0,'failed', 'customer send password', ['reason' => 'Email address not found.','email'=>$email]);
            return redirect()->to('/forgot-password');
        }

    }

    private function _send_reset_email($email, $token)
    {
        $model = new Customer_mdl();
        $Zohoaccess = $model->getZohoAccess();
        $smtp2gokey = "";
        $smtp2email = "";
        foreach ($Zohoaccess as $zohodata) {
            if ($zohodata['key_name'] == "smtp2go_key") {
                $smtp2gokey = $zohodata['value'];
            }
            if ($zohodata['key_name'] == "smtp2go_email") {
                $smtp2email = $zohodata['value'];
            }
        }

        $toemial = $email;
        $resetLink = site_url('/reset-password/' . $token);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
     curl_setopt($ch, CURLOPT_POSTFIELDS, "
{
  \"sender\": \"$smtp2email\",
  \"to\": [\"$toemial\"],
  \"subject\": \"Password Reset Request From Havells Lighting\",
  \"html_body\": \"Click <a href=\\\"$resetLink\\\">here</a> to reset your password.\"
}
");
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);

        }
        curl_close($ch);

    }

    public function customerresetlink($token = null)
    {
        if (!$token) {
            return redirect()->to('/forgot-password');
        }

        // Validate the token and check its expiry
        $Model = new Customer_mdl();
        $Customer = $Model->where('reset_token', $token)->first();

        if ($Customer && strtotime($Customer['reset_token_expiry']) > time()) {
            // Token is valid, show password reset form
            return view('reset-password', ['token' => $token]);
        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
            logAction('customer',0,'failed', 'customer forgot password', ['reason' => 'Invalid or expired token.','token'=>$token]);
            return redirect()->to('/forgot-password');
        }
    }

    public function customerresetpasswordprocess()
    {

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        if (!$password || !$cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'All fields must be filled in.');
            logAction('customer',0,'failed', 'customer reset password', ['reason' => 'All fields must be filled in.','token'=>$token,'password'=>$password,'cpassword'=>$cpassword]);
            return redirect()->to('/reset-password/' . $token);
        }

        if ($password != $cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'New password and confirm password do not match.');
            logAction('customer',0,'failed', 'customer reset password', ['reason' => 'New password and confirm password do not match.','token'=>$token,'password'=>$password,'cpassword'=>$cpassword]);
            return redirect()->to('/reset-password/' . $token);
        }

        // Validate token and check its expiry
        $Model = new Customer_mdl();
        $Customer = $Model->where('reset_token', $token)->first();

        if ($Customer && strtotime($Customer['reset_token_expiry']) > time()) {

            $newpassword = password_hash($password, PASSWORD_BCRYPT);
            $updateSuccessful = $Model->update($Customer['cm_id'], ['password' => $newpassword, 'reset_token' => null, 'reset_token_expiry' => null]);
            if (!$updateSuccessful) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
                $session = \Config\Services::session();
                $session->setFlashdata('msg', 'Password update failed. Please try again.');
                logAction('customer',0,'failed', 'customer reset password', ['reason' => 'Password update failed.','token'=>$token,'password'=>$password,'cpassword'=>$cpassword]);
                return redirect()->to('/reset-password/' . $token);
            }

            $session = \Config\Services::session();
            $session->setFlashdata('success', 'Password updated successfully.');
            logAction('customer',0,'success', 'customer reset password', ['reason' => 'Password updated successfully.','token'=>$token,'password'=>$password,'cpassword'=>$cpassword]);
            return redirect()->to('/login/');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
            logAction('customer',0,'failed', 'customer reset password', ['reason' => 'Invalid or expired token.','token'=>$token,'password'=>$password,'cpassword'=>$cpassword]);
            return redirect()->to('/forgot-password');
        }
    }
    
    public function datatableinventory()
    {
        if ($this->session->has('isLoggedIn')) {

        $session = session();
        $model = new Customer_mdl();
        $cm_id = $session->get('cm_id');
        $db = db_connect();

        // Get customer info and category
        $data = $model->where('cm_id', $cm_id)->first();
        $categories = $model->getCustomerCategories($data['customer_category_id']);
        $pricebookId = $categories[0]['pricebook_id'];

        // Main query
        $builder = $db->table('inventory')
            ->select([
                'item_id',
                'item_name', 
                'sku',
                'description',
                'stocks',
                'unit', 
                'rate',
                'rate_cate',
                'cf_sheet'
            ]);

        // Return JSON to DataTables
        return DataTable::of($builder)
            ->addNumbering()
       ->add('pricebook_rate', function($row) use ($pricebookId) {
    $decodedStr = html_entity_decode($row->rate_cate); // Decode HTML entities
    $decoded = json_decode($decodedStr, true);

    $rate = (is_array($decoded) && isset($decoded[$pricebookId]))
        ? $decoded[$pricebookId]
        : $row->rate;

    return number_format((float)$rate, 2); // Format to 2 decimal places
})
            ->setSearchableColumns([
                'item_name',
                'sku',
                'description',
                'stocks',
                'unit',
                'rate'
            ])
            ->toJson(true);

    } else {
        return redirect()->to('/login');
    }
}

    public function logout()
    {
        $session = \Config\Services::session();
         $cm_id = $session->get('cm_id');
        $session->remove(['cm_id', 'isLoggedIn']);
        $session->setFlashdata('success', 'Logged out successfully.');
        logAction('customer',$cm_id,'success', 'customer logout', ['reason' => 'Logged out successfully.']);
        return redirect()->to('/login');
    }

}
