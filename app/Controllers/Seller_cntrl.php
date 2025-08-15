<?php namespace App\Controllers;

use App\Models\Seller_mdl;
use CodeIgniter\Controller; 
use Config\Services;  
use \Hermawan\DataTables\DataTable; 

helper('zoho_helper');

class Seller_cntrl extends Controller 
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            
            $dataview = ['sellerdata' => $data];

            return view('/salesperson/dashboard', $dataview);
        } else {
            return redirect()->to('/supplier/login');
        }
    }

    public function login()
    {
        return view('/salesperson/sign-in'); // Load the login view
    }

    public function auth()
    {
        $session = session();
        $model = new Seller_mdl();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        if (!$email || !$password) {
            logAction('seller', 0,'failed', 'seller login', ['reason' => 'All fields are empty.']);
            return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            logAction('seller', 0,'failed', 'seller login', ['reason' => 'Invalid email address.', 'email' => $email]);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
        }

   
            $data = $model->where('email', $email)->first();

            if ($data) {
               
                $pass = $data['password'];
                $verify_pass = password_verify($password, $pass);

                if ($verify_pass) {
                     $model->update($data['s_id'], ['status' => 'accepted']);
                    $session->set('SID', $data['s_id']);
                    $session->set('isLoggedInseller', true);

                    $session->setFlashdata('success', 'Login successful.');
                    logAction('seller',$data['s_id'],'success', 'seller login', ['reason' => 'Login successful.', 'email' => $email]);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful.']);

                } else {
                     logAction('seller',0,'failed', 'seller login', ['reason' => 'Incorrect password.', 'email' => $email]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Incorrect password.']);
                }
            } else {
                 logAction('seller',0,'failed', 'seller login', ['reason' => 'Email not found.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email not found.']);

            }
        
    }
    
    public function getfilterdata()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
           $data = $model->where('s_id', $s_id)->first();
           $formats = $this->request->getPost('formats');
          $listformate = $model->getdatafromreporttable($formats,$data['email']);

        return $this->response->setJSON($listformate);
        } else {
            return redirect()->to('/supplier/login');
        }
        
    }
    
    public function viewprofile()
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $dataview = ['sellerdata' => $data];
            return view('/salesperson/view-profile', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function sellerprofileupdate()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desc = $this->request->getVar('desc');
            if (!$fname || !$email || !$lname || !$number || !$desc) {
                logAction('seller',0,'failed', 'seller profile update', ['reason' => 'all fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('seller', $s_id,'failed', 'seller profile update', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->where('email', $email)->where('s_id !=', $s_id)->first();

            if ($existingUser) {
                logAction('seller', $s_id,'failed', 'seller profile update', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $updateSuccessful = $model->update($s_id, ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);

            if (!$updateSuccessful) {
                logAction('seller', $s_id,'failed', 'seller profile update', ['reason' => 'Profile update failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Profile update failed. Please try again.']);
            }
            logAction('seller',$s_id,'success', 'seller profile update', ['reason' => 'Profile updated successfully.', 'first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
            logAction('seller',0,'failed', 'seller profile update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellerprofileupdatepass()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $yourpassword = $this->request->getVar('yourpassword');
            $confirmpassword = $this->request->getVar('confirmpassword');
            if (!$yourpassword || !$confirmpassword) {
                logAction('seller', $s_id,'failed', 'seller password update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                logAction('seller', $s_id,'failed', 'seller password update', ['reason' => 'New password and confirm password do not match.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);
            $updateSuccessful = $model->update($s_id, ['password' => $newpassword]);

            if (!$updateSuccessful) {
                 logAction('seller', $s_id,'failed', 'seller password update', ['reason' => 'Password update failed.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }
            logAction('seller', $s_id,'success', 'seller password update', ['reason' => 'Password updated successfully.','password' => $yourpassword]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);
        } else {
            logAction('seller',0,'failed', 'seller password update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function listquotation()
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $dataview = ['sellerdata' => $data];
            return view('/salesperson/list-Entry', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function viewquote($id)
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $datasss = array(
                's_id' => $s_id,
                'id' => $id,
            );
            $listquotationdata = $model->getSIDquotation($datasss);
            $dataview = ['sellerdata' => $data, 'itemdata' => $listquotationdata];
            return view('/salesperson/view-quote', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function generate_pdf($id)
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $datasss = array(
                's_id' => $s_id,
                'id' => $id,
            );
            $listquotationdata = $model->getSIDquotation($datasss);
            $dataview = ['sellerdata' => $data, 'itemdata' => $listquotationdata];
            $html = view('/salesperson/view-quote-new', $dataview);
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
            return redirect()->to('/seller/login');
        }
    }

    public function sendListEmail($ids)
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $datasss = array(
                's_id' => $s_id,
                'id' => $ids,
            );
            $listquotationdata = $model->getSIDquotation($datasss);
            $dataview = ['sellerdata' => $data, 'itemdata' => $listquotationdata];
            $html = view('/salesperson/view-quote-new', $dataview);

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
            $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $toemial = $listquotationdata["customer"][0]['email'];
            
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
                logAction('seller', $s_id,'failed', 'seller send list email', ['reason' => 'Something Wrong.','quotation'=>$ids]);
                return redirect()->to('/seller/list-quotation/');
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                  logAction('seller', $s_id,'success', 'seller send list email', ['reason' => 'Check your mailbox.','quotation'=>$ids]);
                return redirect()->to('/seller/list-quotation/');

            }
            curl_close($ch);

        } else {
            return redirect()->to('/seller/login');
        }

    }

    public function sendEmail($ids)
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $datasss = array(
                's_id' => $s_id,
                'id' => $ids,
            );
            $listquotationdata = $model->getSIDquotation($datasss);
            $dataview = ['sellerdata' => $data, 'itemdata' => $listquotationdata];
            $html = view('/salesperson/view-quote-new', $dataview);

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
            $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $toemial = $listquotationdata["customer"][0]['email'];

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
                logAction('seller', $s_id,'failed', 'seller send email', ['reason' => 'Mail sending failed','quotation'=>$ids]);
                return redirect()->to('/seller/view-quote/' . $ids);
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                logAction('seller', $s_id,'success', 'seller send email', ['reason' => 'Check your mailbox','quotation'=>$ids]);
                return redirect()->to('/seller/view-quote/' . $ids);
            }
            curl_close($ch);

        } else {
            return redirect()->to('/seller/login');
        }

    }

    public function savestatusquotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
           $quoteID = $this->request->getVar('quoteID');
            $Status = $this->request->getVar('Status');
            $date = date('Y-m-d H:i:s');
            $comment=$this->request->getVar('comment');
           /* $db = db_connect();
            $existingRecord = $db->table('quotation')
                ->where('quotation_id', $quoteID)
                ->get()
                ->getRowArray();

            $newComment = isset($existingRecord['comment']) ? json_decode($existingRecord['comment'], true) : [];
            
            if (isset($newComment)) {
                if (isset($newComment[$Status])) {
                    // Update the existing comment for the given status
                    $newComment[$Status]['comment'] = $comment;
                    $newComment[$Status]['date'] = $date;
                    $newComment[$Status]['username'] = $data['first_name']." ".$data['last_name'];
                    $newComment[$Status]['role'] ="Seller";
                } else {
                    // Add the new status to the existing comments array
                    $newComment[$Status] = ['comment' => $comment, 'date' => $date,'date' => $date, 'username' => $data['first_name']." ".$data['last_name'], 'role' => 'Seller'];
                }
            } else {
                // If no previous comment, create a new array
                $newComment = [$Status => ['comment' => $comment, 'date' => $date,'date' => $date, 'username' => $data['first_name']." ".$data['last_name'], 'role' => 'Seller']];
            }
             // Prepare the data to save
            $datas = [
                'quotation_id' => $quoteID, // Quotation ID
                'status' => $Status,        // New status
                'comment' => json_encode($newComment), // Convert updated comment to JSON
            ];
            $saveqstatusuotation = $model->updatestatus($datas);
            if (!$saveqstatusuotation) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status update failed. Please try again.']);
            } else {
                return $this->response->setJSON(['status' => 'success', 'message' => 'Status updated successfully.']);

            }*/
             $db = db_connect();
            $existingRecord = $db->table('quotation')
                ->where('quotation_id', $quoteID)
                ->get()
                ->getRowArray();
            
            // Decode existing comments, ensure it's an array
            $newComment = !empty($existingRecord['comment']) ? json_decode($existingRecord['comment'], true) : [];
            
            // Ensure the status exists and is an array
            if (!isset($newComment[$Status]) || !is_array($newComment[$Status])) {
                $newComment[$Status] = [];
            }
            
            // Append the new comment instead of replacing the old one
            $newComment[$Status][] = [
                'comment' => $comment,
                'date' => $date,
                'username' => $data['first_name'] . " " . $data['last_name'],
                'role' => 'Seller'
            ];
            
            // Prepare the data to save
            $datas = [
                'quotation_id' => $quoteID,
                'status' => $Status,
                'comment' => json_encode($newComment, JSON_PRETTY_PRINT) // Convert updated comments to JSON
            ];
            
            // Update the database with the modified JSON
            $saveqstatusquotation = $model->updatestatus($datas);
            
            if (!$saveqstatusquotation) {
                logAction('seller', $s_id,'failed', 'seller save status quotation', ['reason' => 'Status update failed.',$datas]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status update failed. Please try again.']);
            } else {
                 logAction('seller', $s_id,'success', 'seller save status quotation', ['reason' => 'Status updated successfully.',$datas]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Status updated successfully.']);
            }


        } else {
             logAction('seller', 0,'failed', 'seller save status quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellerviewquotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $customer = $model->getallcustomer($s_id);
            $dataview = ['sellerdata' => $data, 'customer' => $customer];
            return view('/salesperson/add-metric', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

  public function listperson()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
     
            $dataview = ['sellerdata' => $data];
            return view('/salesperson/list-report', $dataview);
        } else {
             return redirect()->to('/seller/login');
        }
    }
    
     public function evidence()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $customer = $model->getallcustomer($s_id);
            $dataview = ['sellerdata' => $data, 'customer' => $customer];
            return view('/salesperson/evidence', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }
    public function setting()
    {

         if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
     
           
            $dataview = ['sellerdata' => $data];
            return view('/salesperson/setting', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }
    public function getcustomerdetailwithitem()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $customerId = $this->request->getVar('customerId');
            $customer = $model->getcustomerbyid($customerId);
            $categories = $model->getCustomerCategories($customer[0]['customer_category_id']);
            
                    $itemdata = array();
                    $itemlist = array();
                    $db = db_connect();
                    
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
                    
                    // Execute the query and get the result set
                    $items = $builder->get()->getResultArray();
                    
                    foreach ($items as $itemsdt) {
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['item_name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['stocks'] = $itemsdt['stocks'] ?? 0;
                          $decodedRateCate = json_decode($itemsdt['rate_cate'], true);  // Decode the rate_cate JSON field into an array
                        $pricebookId = $categories[0]['pricebook_id'];  // Get the pricebook_id for the customer
                        $pricebookRate = $decodedRateCate[$pricebookId] ?? 0;  // Access the rate using pricebook_id, default to 0 if not found
                        $itemdata['pricebook_rate'] = $pricebookRate;
                        $itemdata['sku'] = $itemsdt['sku'];
                         $itemdata['cf_sheet'] = $itemsdt['cf_sheet'];
                        $itemlist[] = $itemdata;
                    }

                

            $dataview = ['sellerdata' => $data, 'customer' => $customer[0], 'categories' => $categories[0], 'itemlist' => $itemlist];
            return $this->response->setJSON($dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function sellersavequotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $dataseller = $model->where('s_id', $s_id)->first();
            $customer_id = $this->request->getVar('customerid');
            $data = $model->getcustomerbyid($customer_id);
            $categories = $model->getCustomerCategories($data[0]['customer_category_id']);
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
                    'customer_id' => $customer_id,
                    's_id' => $data[0]['s_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data[0]['created_by_user'],
                    'created_by_userid' => $data[0]['created_by_userid'],
                    'address_json' => $data[0]['shipping_address'] . "," . $data[0]['shipping_city'] . "," . $data[0]['shipping_state'] . "," . $data[0]['shipping_pincode'] . "," . $data[0]['shipping_phone_number'],
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
                    logAction('seller',$s_id,'failed', 'seller save quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }
                logAction('seller',$s_id,'success', 'seller save quotation', ['reason' => 'Quotation saved successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation saved successfully.']);

            } else {
                logAction('seller',$s_id,'failed', 'seller save quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
             logAction('seller', 0,'failed', 'seller save quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellersavesendquotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $salse_data = $model->where('s_id', $s_id)->first();
            $customer_id = $this->request->getVar('customerid');
            $data = $model->getcustomerbyid($customer_id);
            $categories = $model->getCustomerCategories($data[0]['customer_category_id']);
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
                    'customer_id' => $customer_id,
                    's_id' => $data[0]['s_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data[0]['created_by_user'],
                    'created_by_userid' => $data[0]['created_by_userid'],
                    'address_json' => $data[0]['shipping_address'] . "," . $data[0]['shipping_city'] . "," . $data[0]['shipping_state'] . "," . $data[0]['shipping_pincode'] . "," . $data[0]['shipping_phone_number'],
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
                    logAction('seller',$s_id,'failed', 'seller save and send quotation', ['reason' => 'Failed to Quotation.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to Quotation. Please try again later.']);
                }

                $datasss = array(
                    's_id' => $s_id,
                    'id' => $savequotation,
                );
                $listquotationdata = $model->getSIDquotation($datasss);

                $dataview = ['sellerdata' => $salse_data, 'itemdata' => $listquotationdata];
                $html = view('/salesperson/view-quote-new', $dataview);

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
                $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
                $toemial = $data[0]["email"];

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
                    logAction('seller',$s_id,'failed', 'seller save and send quotation', ['reason' => 'Mail sending failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Mail sending failed. Please contact the administrator.']);
                } else {
                    logAction('seller',$s_id,'success', 'seller save and send quotation', ['reason' => 'Quotation saved successfully. Check your mailbox','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation sent and saved successfully. Check your mailbox.']);

                }
                curl_close($ch);

            } else {
                logAction('seller', $s_id,'failed', 'seller save and send quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
             logAction('seller', 0,'failed', 'seller save and send quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellersavedownquotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $salse_data = $model->where('s_id', $s_id)->first();
            $customer_id = $this->request->getVar('customerid');
            $data = $model->getcustomerbyid($customer_id);
            $categories = $model->getCustomerCategories($data[0]['customer_category_id']);
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
                    'customer_id' => $customer_id,
                    's_id' => $data[0]['s_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data[0]['created_by_user'],
                    'created_by_userid' => $data[0]['created_by_userid'],
                    'address_json' => $data[0]['shipping_address'] . "," . $data[0]['shipping_city'] . "," . $data[0]['shipping_state'] . "," . $data[0]['shipping_pincode'] . "," . $data[0]['shipping_phone_number'],
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
                     logAction('seller',$s_id,'failed', 'seller save and download quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }

                $datasss = array(
                    's_id' => $s_id,
                    'id' => $savequotation,
                );
                $listquotationdata = $model->getSIDquotation($datasss);
                 $quonumber="Quote".$listquotationdata['mainquot'][0]['quotation_number'];
                $dataview = ['sellerdata' => $salse_data, 'itemdata' => $listquotationdata];
                $html = view('/salesperson/view-quote-new', $dataview);
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
                logAction('seller',$s_id,'success', 'seller save and download quotation', ['reason' => 'Quotation sent and downloaded successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
               
                    // Return success message in JSON
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Quotation saved and downloaded successfully. Check your download folder.',
                        'downloadUrl' => 'https://partner.havellslighting.com/' . $filePath,
                    ]);

                } catch (Exception $e) {
                    // Handle error and return a JSON response
                     logAction('seller',$s_id,'failed', 'seller save and download quotation', ['reason' => 'Failed to save PDF: ' . $e->getMessage()]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save PDF: ' . $e->getMessage()]);

                }
                logAction('seller',$s_id,'success', 'seller save and download quotation', ['reason' => 'Quotation save successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
               
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Quotation saved successfully.',
                ]);

            } else {
                 logAction('seller', $s_id,'failed', 'seller save and download quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
             logAction('seller', 0,'failed', 'seller save and download quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellersaveprintquotation()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $salse_data = $model->where('s_id', $s_id)->first();
            $customer_id = $this->request->getVar('customerid');
            $data = $model->getcustomerbyid($customer_id);
            $categories = $model->getCustomerCategories($data[0]['customer_category_id']);
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
                    'customer_id' => $customer_id,
                    's_id' => $data[0]['s_id'],
                    'sent' => "0",
                    'sent_datetime' => "",
                    'sub_total' => $totalprice,
                    'tax_amount' => "00.00",
                    'grand_total' => $totalprice,
                    'status' => "pending",
                    'created_by_user' => $data[0]['created_by_user'],
                    'created_by_userid' => $data[0]['created_by_userid'],
                    'address_json' => $data[0]['shipping_address'] . "," . $data[0]['shipping_city'] . "," . $data[0]['shipping_state'] . "," . $data[0]['shipping_pincode'] . "," . $data[0]['shipping_phone_number'],
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
                $datasss = array(
                    's_id' => $s_id,
                    'id' => $savequotation,
                );
                $listquotationdata = $model->getSIDquotation($datasss);

                $dataview = ['sellerdata' => $salse_data, 'itemdata' => $listquotationdata];
                $html = view('/salesperson/view-quote-new', $dataview);

                if (!$savequotation) {
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Address update failed. Please try again.']);
                }
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation saved successfully.', 'htmlcode' => $html]);

            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed..']);
            }

        } else {
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function inventory()
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $salse_data = $model->where('s_id', $s_id)->first();
            $db = db_connect();
            $builder = $db->table('customer_category')
            ->select('
                customer_category_id, 
                category_name, 
                pricebook_id, 
                status, 
                desc,
            ')
            ->orderBy('customer_category_id', 'DESC');
            $result = $builder->get()->getResultArray();
            $dataview = ['sellerdata' => $salse_data, 'categories'=>$result];
            return view('/salesperson/inventory', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function listcustomer()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $custocate = $model->getcustomercate();
            $dataview = ['sellerdata' => $data,'custocate' => $custocate];
       
            return view('/salesperson/list-customers', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function addcustomerbyseller()
    {

        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $custocate = $model->getcustomercate();
            $dataview = ['sellerdata' => $data, 'custocate' => $custocate];
            return view('/salesperson/add-customers', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }

    public function sellersavecustomer()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $depart = $this->request->getVar('depart');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');

            $bcountry = $this->request->getVar('bcountry');
            $baddress = $this->request->getVar('baddress');
            $bcity = $this->request->getVar('bcity');
            $bstate = $this->request->getVar('bstate');
            $bzip = $this->request->getVar('bzip');
            $bphone = $this->request->getVar('bphone');

            $scountry = $this->request->getVar('scountry');
            $saddress = $this->request->getVar('saddress');
            $scity = $this->request->getVar('scity');
            $sstate = $this->request->getVar('sstate');
            $szip = $this->request->getVar('szip');
            $sphone = $this->request->getVar('sphone');

            if (!$fname) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Category is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$destatus) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Status is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplication($email);
            if ($existingUser) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $destatus,
                'customer_category_id' => $depart,
                'billing_address' => $baddress,
                'billing_city' => $bcity,
                'billing_state' => $bstate,
                'billing_pincode' => $bzip,
                'billing_phone_number' => $bphone,
                'shipping_address' => $saddress,
                'shipping_city' => $scity,
                'shipping_state' => $sstate,
                'shipping_pincode' => $szip,
                'shipping_phone_number' => $sphone,
                'created_by_user' => 'sales_person',
                'created_by_userid' => $s_id,
                's_id' => $s_id,
            );

            $insertSuccessful = $model->insertcustomerdata($datasitem);
            if (!$insertSuccessful) {
                logAction('seller',$s_id,'failed', 'seller save customer', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('seller',$s_id,'success', 'seller save customer', ['reason' => 'Customer added successfully.', 'data' => $datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Customer added successfully.']);
        } else {
             logAction('seller',0,'failed', 'seller save customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellerupdatecustomer()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $customerid = $this->request->getVar('customerid');
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $depart = $this->request->getVar('depart');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');

            $bcountry = $this->request->getVar('bcountry');
            $baddress = $this->request->getVar('baddress');
            $bcity = $this->request->getVar('bcity');
            $bstate = $this->request->getVar('bstate');
            $bzip = $this->request->getVar('bzip');
            $bphone = $this->request->getVar('bphone');

            $scountry = $this->request->getVar('scountry');
            $saddress = $this->request->getVar('saddress');
            $scity = $this->request->getVar('scity');
            $sstate = $this->request->getVar('sstate');
            $szip = $this->request->getVar('szip');
            $sphone = $this->request->getVar('sphone');

            if (!$customerid) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Invalid customer id.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid customer.']);
            }

            if (!$fname) {
                
                logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'First name is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Last name is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Email fields are required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Category is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$destatus) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Status is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Invalid email address.', 'email' => $email, 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }
            $datasitema = array(
                'customerid' => $customerid,
                'email' => $email);
            $existingUser = $model->checkemailduplicationbyid($datasitema);
            if ($existingUser) {
                 logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'This email is already registered.', 'email' => $email, 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'customerid' => $customerid,
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $destatus,
                'customer_category_id' => $depart,
                'billing_address' => $baddress,
                'billing_city' => $bcity,
                'billing_state' => $bstate,
                'billing_pincode' => $bzip,
                'billing_phone_number' => $bphone,
                'shipping_address' => $saddress,
                'shipping_city' => $scity,
                'shipping_state' => $sstate,
                'shipping_pincode' => $szip,
                'shipping_phone_number' => $sphone,
                'created_by_user' => 'sales_person',
                'created_by_userid' => $s_id,
                's_id' => $s_id,
            );
            $insertSuccessful = $model->updatecustomerdata($datasitem);
            if (!$insertSuccessful) {
                logAction('seller',$s_id,'failed', 'seller update customer', ['reason' => 'Data update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data update failed. Please try again.']);
            }
            logAction('seller',$s_id,'success', 'seller update customer', ['reason' => 'Customer updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Customer updated successfully.']);
        } else {
            logAction('seller',0,'failed', 'seller update customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellersavesendcustomer()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $depart = $this->request->getVar('depart');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');

            $bcountry = $this->request->getVar('bcountry');
            $baddress = $this->request->getVar('baddress');
            $bcity = $this->request->getVar('bcity');
            $bstate = $this->request->getVar('bstate');
            $bzip = $this->request->getVar('bzip');
            $bphone = $this->request->getVar('bphone');

            $scountry = $this->request->getVar('scountry');
            $saddress = $this->request->getVar('saddress');
            $scity = $this->request->getVar('scity');
            $sstate = $this->request->getVar('sstate');
            $szip = $this->request->getVar('szip');
            $sphone = $this->request->getVar('sphone');

            if (!$fname) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Category is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$destatus) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Status is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplication($email);
            if ($existingUser) {
                 logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }
            $yourpassword = $fname . "@" . rand();
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'password' => $newpassword,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $destatus,
                'customer_category_id' => $depart,
                'billing_address' => $baddress,
                'billing_city' => $bcity,
                'billing_state' => $bstate,
                'billing_pincode' => $bzip,
                'billing_phone_number' => $bphone,
                'shipping_address' => $saddress,
                'shipping_city' => $scity,
                'shipping_state' => $sstate,
                'shipping_pincode' => $szip,
                'shipping_phone_number' => $sphone,
                'created_by_user' => 'sales_person',
                'created_by_userid' => $s_id,
                's_id' => $s_id,
            );

            $insertSuccessful = $model->insertcustomerdata($datasitem);
            if (!$insertSuccessful) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }

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

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Welcome to Our Service\",\n  \"html_body\": \"<p>Dear $fname</p><br><br>Thank you for joining us! We’re excited to have you on board.<br>If you have any questions, feel free to reach out to us anytime.<br>Best regards Havells Lighting Team<br>Username:<b>$email</b><br>Password:<b>$yourpassword</b>\"\n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                logAction('seller',$s_id,'failed', 'seller save and send customer', ['reason' => 'Something went wrong.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                logAction('seller',$s_id,'success', 'seller save and send customer', ['reason' => 'Customer added successfully.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Customer added successfully.']);

            }
            curl_close($ch);

        } else {
            logAction('seller',0,'failed', 'seller save and send customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function sellersavepassword()
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $yourpassword = $this->request->getVar('password');
            $confirmpassword = $this->request->getVar('cpassword');
            $customer_id = $this->request->getVar('customerid');

            if (!$yourpassword || !$confirmpassword) {
                logAction('seller',$s_id,'failed', 'seller save password', ['reason' => 'all fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                logAction('seller',$s_id,'failed', 'seller save password', ['reason' => 'New password and confirm password do not match.','yourpassword'=>$yourpassword,'confirmpassword'=>$confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'customer_id' => $customer_id,
                'password' => $newpassword,
                'sales_id' => $s_id,
            );

            $updateSuccessful = $model->updatepassword($datasitem);

            if (!$updateSuccessful) {
                logAction('seller',$s_id,'failed', 'seller save password', ['reason' => 'Password update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }
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

            $customer = $model->getcustomerbyid($customer_id);
            $email = $customer[0]['email'];
            $fname = $customer[0]['first_name'];
            $toemial = $email;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Password Update By Sales Person\",\n  \"html_body\": \"<p>Dear $fname</p><br>If you have any questions, feel free to reach out to us anytime.<br>Best regards Havells Lighting Team<br>Username:<b>$email</b><br>Password:<b>$yourpassword</b>\"\n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                logAction('seller',$s_id,'failed', 'seller save password', ['reason' => 'Mail Not Send!','email'=>$toemial,$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Mail Not Send!']);
            } else {
                logAction('seller',$s_id,'success', 'seller save password', ['reason' => 'Password updated successfully.',$datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);
            }
            curl_close($ch);
        } else {
             logAction('seller',0,'failed', 'seller save password', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function editcustomer($ids)
    {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $datasitem = array(
                'customer_id' => $ids,
                'sales_id' => $s_id,
            );

            $customer = $model->getcustomerwithcatebyid($datasitem);
            $custocate = $model->getcustomercate();
            $dataview = ['sellerdata' => $data, 'customerdata' => $customer[0], 'custocate' => $custocate];
            return view('/salesperson/edit-customer', $dataview);
        } else {
            return redirect()->to('/seller/login');
        }
    }
    
    public function getCustomerData()
    {
      if ($this->session->has('isLoggedInseller')) {
        $customer_id = $this->request->getPost('customer_id');
        $session = session();
        $model = new Seller_mdl();
        $s_id = $session->get('SID');
         $datasitem = array(
                'customer_id' => $customer_id,
                'sales_id' => $s_id,
            );
        $getcustomer = $model->getcustomerwithcatebyid($datasitem);
        if ($getcustomer) {
            return $this->response->setJSON(['success' => true, 'data' => $getcustomer[0]]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
        } else {
                return redirect()->to('/admin/login');
            }
    }

    public function sellerforgotpassword()
    {
        return view('/salesperson/forgot-password');
    }

    public function sellersendpassword()
    {

        $email = $this->request->getPost('email');
        if (!$email) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email fields are required.');
            logAction('seller',0,'failed', 'seller send password', ['reason' => 'Email fields are required.']);
            return redirect()->to('/seller/forgot-password');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Enter a valid email address.');
            logAction('seller',0,'failed', 'seller send password', ['reason' => 'Enter a valid email address.','email'=>$email]);
            return redirect()->to('/seller/forgot-password');
        }
        // Check if the email exists in the database
        $model = new Seller_mdl();
        $seller = $model->where('email', $email)->where('delete_status', '0')->first();

        if ($seller) {
            // Generate a reset token
            $token = bin2hex(random_bytes(50)); // You can use a more secure method
            $expiresAt = date('Y-m-d H:i:s', time() + 3600); // Token expires in 1 hour

            // Store the token and expiration date in the database

            $updateSuccessful = $model->update($seller['s_id'], ['reset_token' => $token, 'reset_token_expiry' => $expiresAt]);

            // Send the reset link via email
            $this->_send_reset_email($email, $token);

            $session = \Config\Services::session();
            $session->setFlashdata('success', 'Check your email for the reset link.');
            logAction('seller',$seller['s_id'],'success', 'seller send password', ['reason' => 'Check your email for the reset link.','email'=>$email]);
            return redirect()->to('/seller/login');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email address not found.');
             logAction('seller',0,'failed', 'seller send password', ['reason' => 'Email address not found.','email'=>$email]);
            return redirect()->to('/seller/forgot-password');
        }

    }

    private function _send_reset_email($email, $token)
    {
        $model = new Seller_mdl();
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
        $resetLink = site_url('/seller/reset-password/' . $token);
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

    public function sellerresetlink($token = null)
    {
        if (!$token) {
            return redirect()->to('/seller/forgot-password');
        }

        // Validate the token and check its expiry
        $Model = new Seller_mdl();
        $Customer = $Model->where('reset_token', $token)->first();

        if ($Customer && strtotime($Customer['reset_token_expiry']) > time()) {
            // Token is valid, show password reset form
            return view('/salesperson/reset-password', ['token' => $token]);
        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
            logAction('seller',0,'failed', 'seller reset password', ['reason' => 'Invalid or expired token.','token'=>$token]);
            return redirect()->to('/seller/forgot-password');
        }
    }

    public function sellerresetpasswordprocess()
    {

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        if (!$password || !$cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'All fields must be filled in.');
            logAction('seller',0,'failed', 'seller reset password', ['reason' => 'all fields must be filled in.','token'=>$token]);
            return redirect()->to('/seller/reset-password/' . $token);
        }

        if ($password != $cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'New password and confirm password do not match.');
            logAction('seller',0,'failed', 'seller reset password', ['reason' => 'New password and confirm password do not match.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
            return redirect()->to('/seller/reset-password/' . $token);
        }

        // Validate token and check its expiry
        $Model = new Seller_mdl();
        $seller = $Model->where('reset_token', $token)->first();

        if ($seller && strtotime($seller['reset_token_expiry']) > time()) {

            $newpassword = password_hash($password, PASSWORD_BCRYPT);
            $updateSuccessful = $Model->update($seller['s_id'], ['password' => $newpassword, 'reset_token' => null, 'reset_token_expiry' => null]);
            if (!$updateSuccessful) {
                logAction('seller',$seller['s_id'],'failed', 'seller reset password', ['reason' => 'Password update failed.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
                $session = \Config\Services::session();
                $session->setFlashdata('msg', 'Password update failed. Please try again.');
                return redirect()->to('/seller/reset-password/' . $token);
            }

            $session = \Config\Services::session();
            logAction('seller',$seller['s_id'],'success', 'seller reset password', ['reason' => 'Password updated successfully.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
            $session->setFlashdata('success', 'Password updated successfully.');
            return redirect()->to('/seller/login/');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
            logAction('seller',0,'failed', 'seller reset password', ['reason' => 'Invalid or expired token.','token'=>$token]);
            return redirect()->to('/seller/forgot-password');
        }
    }

   public function datatablelistcustomer()
   {
    if ($this->session->has('isLoggedInseller')) {
        $session = session();
        $model = new Seller_mdl();
        $request = service('request');
        $s_id = $session->get('SID');
        $db = db_connect();
        $builder = $db->table('customer')
            ->select('
                customer.customer_id, 
                customer.customer_category_id, 
                customer.s_id, 
                customer.first_name AS cfname, 
                customer.last_name AS clname,
                CONCAT(customer.first_name, " ", customer.last_name) AS customer_name, 
                customer.email, 
                customer.phone_number, 
                customer.status, 
                customer.created_at, 
                customer.updated_at, 
                customer.shipping_address, 
                customer.shipping_city, 
                customer.shipping_state, 
                customer.shipping_pincode, 
                customer.shipping_phone_number,
                customer.billing_address, 
                customer.billing_city, 
                customer.billing_state, 
                customer.billing_pincode,
                customer.billing_phone_number, 
                customer.description, 
                customer_category.category_name, 
                CONCAT(sales_person.first_name, " ", sales_person.last_name) AS sales_person_name
            ')
            ->join('customer_category', 'customer_category.customer_category_id = customer.customer_category_id', 'left')
            ->join('sales_person', 'sales_person.s_id = customer.s_id', 'left')
            ->where('customer.s_id', $s_id)
            ->where('customer.status', 1)
            ->where('customer_category.status', 1)
             ->orderBy('customer.customer_id', 'DESC');
        
        
        return DataTable::of($builder)
        ->addNumbering()
            ->setSearchableColumns([
                'customer.first_name',           // Searchable by Customer First Name
                'customer.last_name',            // Searchable by Customer Last Name
                'customer.email',                // Searchable by Customer Email
                'customer_category.category_name',
                'CONCAT(customer.first_name, " ", customer.last_name)'
               
            ])
            ->toJson(true);
        } else {
            return redirect()->to('/seller/login');
        }
    }
    
   public function datatablelistquotation()
   {
        if ($this->session->has('isLoggedInseller')) {
        $session = session();
        $model = new Seller_mdl();
        $request = service('request');
        $s_id = $session->get('SID');
        $db = db_connect();
        $builder = $db->table('quotation')
            ->select('
                quotation.quotation_id, 
                quotation.quotation_number, 
                quotation.s_id, 
                quotation.created_at AS quotation_created_at, 
                quotation.grand_total, 
                quotation.status, 
                 quotation.comment, 
                CONCAT(customer.first_name, " ", customer.last_name) AS customer_name, 
                 customer_category.category_name
            ')
            ->join('customer', 'customer.customer_id = quotation.customer_id')
            ->join('customer_category', 'customer_category.customer_category_id = customer.customer_category_id')
            ->where('quotation.s_id', $s_id)
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
                'customer_category.category_name',
                'customer.first_name', // Searchable by sales person's first name
                'customer.last_name',  // Searchable by sales person's last name
                'CONCAT(customer.first_name, " ", customer.last_name)'
            ])
            ->toJson(true);


        } else {
            return redirect()->to('/seller/login');
        }
    }
    
    public function autologincustomer()
    {
         if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $data = $model->where('s_id', $s_id)->first();
            $custID = $this->request->getVar('custID');
            $datasitem = array(
                'customer_id' => $custID,
                'sales_id' => $s_id,
            );

            $customer = $model->getcustomerwithcatebyid($datasitem);
            if ($customer) {
                    $session->remove(['customerId', 'isLoggedIn']);
                    $session->set('customerId', $customer[0]['customer_id']);
                    $session->set('isLoggedIn', true);

                 logAction('seller',$custID,'success', 'customer auto login', ['reason' => 'Customer auto login successful.', 'custID'=>$custID]);
                  return $this->response->setJSON(['status' => 'success', 'message' => 'Customer auto login successfully.']);
            }
            else{
                logAction('seller',$custID,'success', 'customer auto login', ['reason' => 'customer auto login failed.', 'custID'=>$custID]);
                  return $this->response->setJSON(['status' => 'error', 'message' => 'Customer auto login failed. Please try again.']);
            }
            
        }
                 
    }
    public function datatableinventory()
   {
        if ($this->session->has('isLoggedInseller')) {
            $session = session();
            $model = new Seller_mdl();
            $s_id = $session->get('SID');
            $db = db_connect();
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
        
            return DataTable::of($builder)
                ->addNumbering()
                ->setSearchableColumns([
                    'item_name',           
                    'sku',            
                    'description',                
                    'stocks',
                    'unit',
                    'rate'
                ])
                   ->edit('rate_cate', function ($row) {
    // Decode HTML entities first
    $json = html_entity_decode($row->rate_cate);

    // Now decode the JSON
    $decoded = json_decode($json ?? '{}', true);

    // Safety check: If decoding fails, return an empty array
    if (!is_array($decoded)) {
        log_message('debug', 'Invalid JSON: ' . $json);
        $decoded = [];
    }

    // Return the decoded object
    return (object) $decoded;
})
                ->toJson(true);
        } else {
            return redirect()->to('/seller/login');
        }

   } 
    
    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove(['s_id', 'isLoggedInseller']);
        $session->setFlashdata('success', 'Logged out successfully.');
        logAction('seller',0,'success', 'seller logout', ['reason' => 'Logged out successfully.']);
        return redirect()->to('/seller/login');
    }
    
    

}
