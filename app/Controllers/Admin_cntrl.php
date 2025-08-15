<?php namespace App\Controllers;

use App\Models\Admin_mdl;
use CodeIgniter\Controller;
use Config\Services;
use CodeIgniter\HTTP\IncomingRequest;
use \Hermawan\DataTables\DataTable;
use App\Models\ZohoInventoryModel;

helper('zoho_helper');

class Admin_cntrl extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();

    }

    public function index()
    {
        
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $TotalQuotation = $model->countStatus('all');
            $PendingQuotation = $model->countStatus('pending');
            $AcceptedQuotation = $model->countStatus('accept');
            $InvoicedQuotation = $model->countStatus('invoice');
            $RejectedQuotation = $model->countStatus('rejected');
            $TotalQuotationcount = 0;
            $PendingQuotationcount = 0;
            $AcceptedQuotationcount = 0;
            $InvoicedQuotationcount = 0;
            $RejectedQuotationcount = 0;
            if (isset($TotalQuotation[0]['count'])) {
                $TotalQuotationcount = $TotalQuotation[0]['count'];
            }
            if (isset($PendingQuotation[0]['count'])) {
                $PendingQuotationcount = $PendingQuotation[0]['count'];
            }
            if (isset($AcceptedQuotation[0]['count'])) {
                $AcceptedQuotationcount = $AcceptedQuotation[0]['count'];
            }
            if (isset($InvoicedQuotation[0]['count'])) {
                $InvoicedQuotationcount = $InvoicedQuotation[0]['count'];
            }
            if (isset($RejectedQuotation[0]['count'])) {
                $RejectedQuotationcount = $RejectedQuotation[0]['count'];
            }
            $getGraph = $model->getgraphdata();
            $DailyLogin = $model->getDailyLogin();
            $perdaydata = $model->getperdaydata();
            $perdaydata = implode(', ', $perdaydata);
            $CustomerLoginByDay = $model->getdaynumberonly();
            $todaycollection = $model->gettodaycollection();
            $weekbycollection = $model->getweekbycollection();

            $totalcustomer = $model->getcustomertotal();
            $totalcustomerdata = 0;
            if (isset($totalcustomer[0]['count'])) {
                $totalcustomerdata = $totalcustomer[0]['count'];
            }
            $totalcollection = $model->gettotalcollection();
            $totalcollectiondata = 0;
            if (isset($totalcollection)) {
                $totalcollectiondata = $totalcollection;
            }

            $totalaceptcollection = $model->gettotalaceptcollection();
            $totalaceptcollectiondata = 0;
            if (isset($totalaceptcollection)) {
                $totalaceptcollectiondata = $totalaceptcollection;
            }

            $totalseller = $model->getsellertotal();
            $totalsellerdata = 0;
            if (isset($totalseller[0]['count'])) {
                $totalsellerdata = $totalseller[0]['count'];
            }

            $totaluser = $model->getusertotal();
            $totaluserdata = 0;
            if (isset($totaluser[0]['count'])) {
                $totaluserdata = $totaluser[0]['count'];
            }

            $countstatus = ['TotalQuotation' => $TotalQuotationcount, 'PendingQuotation' => $PendingQuotationcount, 'AcceptedQuotation' => $AcceptedQuotationcount, 'InvoicedQuotation' => $InvoicedQuotationcount, 'RejectedQuotation' => $RejectedQuotationcount, 'totalcustomers' => $totalcustomerdata, 'totalcollections' => $totalcollectiondata, 'totalaceptcollection' => $totalaceptcollectiondata, 'totalseller' => $totalsellerdata, 'totaluserdata' => $totaluserdata];
            $dataview = ['admindata' => $data, 'statuscountquotation' => $countstatus, 'graphdata' => $getGraph, 'dailylogin' => $DailyLogin, 'perdaydata' => $perdaydata, 'CustomerLoginByDay' => $CustomerLoginByDay, 'todaycollection' => $todaycollection, 'weekbycollection' => $weekbycollection];

            return view('/admin/dashboard', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function login()
    {
        return view('/admin/sign-in'); // Load the login view
    }

    public function auth()
    {
        $session = session();
        $model = new Admin_mdl();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data1 = $model->where('status', 1)->first();
        if (!$email || !$password) {
            logAction('admin', 0,'failed', 'admin login', ['reason' => 'All fields are empty.']);
            return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            logAction('admin', 0,'failed', 'admin login', ['reason' => 'Enter a valid email address.','email'=>$email]);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
        }

        if ($data1) {
            $data = $model->where('email', $email)->where('delete_status', '0')->first();

            if ($data) {
                $pass = $data['password'];
                $verify_pass = password_verify($password, $pass);

                if ($verify_pass) {
                    $session->set('adminId', $data['admin_id']);
                    $session->set('isLoggedInadmin', true);

                    $session->setFlashdata('success', 'Login successful.');
                    logAction('admin', $data['admin_id'],'success', 'admin login', ['reason' => 'Login successful.','email'=>$email]);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Login successful.']);

                } else {
                    logAction('admin', $data['admin_id'],'failed', 'admin login', ['reason' => 'Incorrect password.','email'=>$email,'password'=>$password]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Incorrect password.']);
                }
            } else {
                logAction('admin', 0,'failed', 'admin login', ['reason' => 'Email not found.','email'=>$email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email not found.']);

            }
        } else {
            logAction('admin',0,'failed', 'admin login', ['reason' => 'Your account inctive.','email'=>$email]);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Your account inctive.Please contact to support.']);
        }
    }

    public function viewprofile()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $dataview = ['admindata' => $data];
            return view('/admin/view-profile', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }
    
    public function setting()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $settingdata1 = $model->getZohoAccess();
            $settingdata=array();
            foreach ($settingdata1 as $zohodata) {
                $settingdata[$zohodata['key_name']] = $zohodata['value'];
            }
            $dataview = ['admindata' => $data, 'settingdata' => $settingdata];
            return view('/admin/setting', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function adminprofileupdate()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desc = $this->request->getVar('desc');
            if (!$fname || !$email || !$lname || !$number || !$desc) {
                logAction('admin', $admin_id,'failed', 'admin profile update', ['reason' => 'All fields are empty.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin', $admin_id,'failed', 'admin profile update', ['reason' => 'Enter a valid email address.','email'=>$email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->where('email', $email)->where('admin_id !=', $admin_id)->first();

            if ($existingUser) {
                logAction('admin', $admin_id,'failed', 'admin profile update', ['reason' => 'This email is already registered.','email'=>$email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $updateSuccessful = $model->update($admin_id, ['first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);

            if (!$updateSuccessful) {
                logAction('admin', $admin_id,'failed', 'admin profile update', ['reason' => 'Profile update failed.','email'=>$email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Profile update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin profile update', ['reason' => 'Profile updated successfully.','first_name' => $fname, 'last_name' => $lname, 'email' => $email, 'phone_number' => $number, 'description' => $desc]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Profile updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin profile update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminprofileupdatepass()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $yourpassword = $this->request->getVar('yourpassword');
            $confirmpassword = $this->request->getVar('confirmpassword');
            if (!$yourpassword || !$confirmpassword) {
                 logAction('admin', $admin_id,'failed', 'admin password update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                 logAction('admin', $admin_id,'failed', 'admin password update', ['reason' => 'New password and confirm password do not match.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);
            $updateSuccessful = $model->update($admin_id, ['password' => $newpassword]);

            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin password update', ['reason' => 'Password update failed.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin password update', ['reason' => 'Password updated successfully.','password' => $yourpassword,'confirmpassword' => $confirmpassword]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin password update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function listquotation()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $dataview = ['admindata' => $data];
            return view('/admin/list-companies', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function viewquote($id)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $listquotationdata = $model->getadminidquotation($id);
            $dataview = ['admindata' => $data, 'itemdata' => $listquotationdata];
            return view('/admin/view-quote', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function generate_pdf($id)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $listquotationdata = $model->getadminidquotation($id);
            $dataview = ['admindata' => $data, 'itemdata' => $listquotationdata];
            $html = view('/admin/view-quote-new', $dataview);
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
            return redirect()->to('/admin/login');
        }
    }

    public function sendListEmail($ids)
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $listquotationdata = $model->getadminidquotation($ids);
            $dataview = ['admindata' => $data, 'itemdata' => $listquotationdata];
             $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $html = view('/admin/view-quote-new', $dataview);

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
                 logAction('admin', $admin_id,'failed', 'admin send list mail', ['reason' => 'Something Wrong.','quotation'=>$ids]);
                return redirect()->to('/admin/list-quotation/');
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                 logAction('admin', $admin_id,'success', 'admin send list mail', ['reason' => 'Check your mailbox.','quotation'=>$ids]);
                return redirect()->to('/admin/list-quotation/');

            }
            curl_close($ch);

        } else {
            return redirect()->to('/admin/login');
        }

    }

    public function sendEmail($ids)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $listquotationdata = $model->getadminidquotation($ids);
             $filename = 'Quote' . $listquotationdata['mainquot'][0]['quotation_number'] . '.pdf';
            $dataview = ['admindata' => $data, 'itemdata' => $listquotationdata];
            $html = view('/admin/view-quote-new', $dataview);

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
                 logAction('admin', $admin_id,'failed', 'admin send mail', ['reason' => 'Mail sending failed.','quotation'=>$ids]);
                return redirect()->to('/admin/view-quote/' . $ids);
            } else {
                $session = \Config\Services::session();
                $session->setFlashdata('success', 'Check your mailbox.');
                logAction('admin', $admin_id,'success', 'admin send mail', ['reason' => 'Check your mailbox.','quotation'=>$ids]);
                return redirect()->to('/admin/view-quote/' . $ids);
            }
            curl_close($ch);

        } else {
            return redirect()->to('/admin/login');
        }

    }

    public function savestatusquotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $quoteID = $this->request->getVar('quoteID');
            $Status = $this->request->getVar('Status');
            $date = date('Y-m-d H:i:s');
            $comment=$this->request->getVar('comment');
            /*$db = db_connect();
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
                    $newComment[$Status]['role'] ="Admin";
                } else {
                    // Add the new status to the existing comments array
                    $newComment[$Status] = ['comment' => $comment, 'date' => $date, 'username' => $data['first_name']." ".$data['last_name'], 'role' => 'Admin'];
                }
            } else {
                // If no previous comment, create a new array
                $newComment = [$Status => ['comment' => $comment, 'date' => $date,'username' => $data['first_name']." ".$data['last_name'], 'role' => 'Admin']];
            }
            
            // Prepare the data to save
            $datas = [
                'quotation_id' => $quoteID, // Quotation ID
                'status' => $Status,        // New status
                'comment' => json_encode($newComment), // Convert updated comment to JSON
            ];
            
            // Update the status in the database
            $saveqstatusquotation = $model->updatestatus($datas);
            
            if (!$saveqstatusquotation) {
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
                'role' => 'Admin'
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
                 logAction('admin', $admin_id,'failed', 'admin save status quotation', ['reason' => 'Status update failed.',$datas]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status update failed. Please try again.']);
            } else {
                 logAction('admin', $admin_id,'success', 'admin save status quotation', ['reason' => 'Status updated successfully.',$datas]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Status updated successfully.']);
            }

        } else {
             logAction('admin', 0,'failed', 'admin save status quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminviewquotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $customer = $model->getallcustomer();
            $dataview = ['admindata' => $data, 'customer' => $customer];
            return view('/admin/add-companies', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function getcustomerdetailwithitem()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
            $customerId = $this->request->getVar('customerId');
            $customer = $model->getcustomerbyid($customerId);
            $categories = $model->getCustomerCategories($customer[0]['customer_category_id']);
            $seller = $model->getsellerbyidwithdel($customer[0]['sales_person_id']);
     

            if (empty($seller)) {
                $itemlist = "errorseller";
            } else {
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
                    /* ->where('item_id', $yourItemId);*/
                    // Execute the query and get the result set
                    $items = $builder->get()->getResultArray();
                    
                    foreach ($items as $itemsdt) {
                        $itemdata['item_id'] = $itemsdt['item_id'];
                        $itemdata['item_name'] = $itemsdt['item_name'];
                        $itemdata['unit'] = $itemsdt['unit'];
                        $itemdata['description'] = $itemsdt['description'];
                        $itemdata['rate'] = $itemsdt['rate'];
                        $itemdata['stocks'] = $itemsdt['stocks'] ?? 0;
                        //$key = 'rate_' . $categories[0]['pricebook_id'];
                        //$itemdata['pricebook_rate'] = $itemsdt[$key];
                        
                        $decodedRateCate = json_decode($itemsdt['rate_cate'], true);  // Decode the rate_cate JSON field into an array
                        $pricebookId = $categories[0]['pricebook_id'];  // Get the pricebook_id for the customer
                        $pricebookRate = $decodedRateCate[$pricebookId] ?? 0;  // Access the rate using pricebook_id, default to 0 if not found
                        $itemdata['pricebook_rate'] = $pricebookRate;
                        $itemdata['sku'] = $itemsdt['sku'];
                         $itemdata['cf_sheet'] = $itemsdt['cf_sheet'];
                        $itemlist[] = $itemdata;
                    }

                } 
            
            if (empty($seller)) {
                $seller = "";
            } else {
                $seller = $seller[0];
            }

            $dataview = ['admindata' => $data, 'customer' => $customer[0], 'sellerdata' => $seller, 'categories' => $categories[0], 'itemlist' => $itemlist];
            
            return $this->response->setJSON($dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function adminsavequotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $admindata = $model->where('admin_id', $admin_id)->first();
            $customer_id = $this->request->getVar('customerid');
            $data = $model->getcustomerbyid($customer_id);
            $categories = $model->getCustomerCategories($data[0]['customer_category_id']);
            $seller = $model->getsellerbyid($data[0]['sales_person_id']);
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'customer_id' => $customer_id,
                    'sales_person_id' => $data[0]['sales_person_id'],
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
                    logAction('admin',$admin_id,'failed', 'admin save quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }
                logAction('admin',$admin_id,'success', 'admin save quotation', ['reason' => 'Quotation saved successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation saved successfully.']);

            } else {
                logAction('admin',$admin_id,'failed', 'admin save quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed.']);
            }

        } else {
             logAction('admin', 0,'failed', 'admin save quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavesendquotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $admindata = $model->where('admin_id', $admin_id)->first();
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'customer_id' => $customer_id,
                    'sales_person_id' => $data[0]['sales_person_id'],
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
                     logAction('admin',$admin_id,'failed', 'admin save and send quotation', ['reason' => 'Address update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Address update failed. Please try again.']);
                }

                $listquotationdata = $model->getadminidquotation($savequotation);
                $quonumber="Quote".$listquotationdata['mainquot'][0]['quotation_number'];
                $dataview = ['admindata' => $admindata, 'itemdata' => $listquotationdata];
                $html = view('/admin/view-quote-new', $dataview);

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
                $toemial = $data[0]["email"];

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Havells Lighting\",\n  \"html_body\": \" <b>Quote Invoice</b><br></br>Havells Lighting LLC<br></br>111 Preamble CT<br></br>Anderson South Carolina 29621<br></br>8554283557<br></br>www.havellslighting.com\",\n\t\"attachments\": [\n    {\n      \"filename\": \"$quonumber.pdf\",\n      \"fileblob\": \"$fileoutput\",\n      \"mimetype\": \"application/pdf\"\n   \t}\n\t]\n  \n}\n");

                $headers = array();
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
                $headers[] = 'Accept: application/json';
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $result = curl_exec($ch);
                if (curl_errno($ch)) {
                    logAction('admin',$admin_id,'failed', 'admin save and send quotation', ['reason' => 'Mail sending failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Mail sending failed. Please contact the administrator.']);
                } else {
                    logAction('admin',$admin_id,'success', 'admin save and send quotation', ['reason' => 'Quotation saved successfully. Check your mailbox','Quotation'=>$datas,'Quotation item'=>$datasitem]);
                    return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation sent and saved successfully. Check your mailbox.']);

                }
                curl_close($ch);

            } else {
                 logAction('admin', $admin_id,'failed', 'admin save and send quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed..']);
            }

        } else {
            logAction('admin', 0,'failed', 'admin save and send quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavedownquotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $admindata = $model->where('admin_id', $admin_id)->first();
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'customer_id' => $customer_id,
                    'sales_person_id' => $data[0]['sales_person_id'],
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
                    logAction('admin',$admin_id,'failed', 'admin save and download quotation', ['reason' => 'Quotation update failed.']);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation update failed. Please try again.']);
                }

                $listquotationdata = $model->getadminidquotation($savequotation);
                $quonumber="Quote".$listquotationdata['mainquot'][0]['quotation_number'];
                $dataview = ['admindata' => $admindata, 'itemdata' => $listquotationdata];
                $html = view('/admin/view-quote-new', $dataview);
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
                logAction('admin',$admin_id,'success', 'admin save and download quotation', ['reason' => 'Quotation sent and downloaded successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);

                    // Return success message in JSON
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'Quotation saved and downloaded successfully. Check your download folder.',
                        'downloadUrl' => 'https://partner.havellslighting.com/' . $filePath,
                    ]);

                } catch (Exception $e) {
                    // Handle error and return a JSON response
                    logAction('admin',$admin_id,'failed', 'admin save and download quotation', ['reason' => 'Failed to save PDF: ' . $e->getMessage()]);
                    return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save PDF: ' . $e->getMessage()]);

                }
                logAction('admin',$admin_id,'success', 'admin save and download quotation', ['reason' => 'Quotation save successfully.','Quotation'=>$datas,'Quotation item'=>$datasitem]);

                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Quotation saved successfully.',
                ]);

            } else {
                logAction('admin', $admin_id,'failed', 'admin save and download quotation', ['reason' => 'Zoho authentication failed.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho authentication failed..']);
            }

        } else {
             logAction('admin', 0,'failed', 'admin save and download quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsaveprintquotation()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $admindata = $model->where('admin_id', $admin_id)->first();
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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

                        $itemlist[] = $itemdata;
                        $totalprice += $qty * $ratenew;
                    }

                }
                $datas = array(
                    'customer_id' => $customer_id,
                    'sales_person_id' => $data[0]['sales_person_id'],
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
                $listquotationdata = $model->getadminidquotation($savequotation);

                $dataview = ['admindata' => $admindata, 'itemdata' => $listquotationdata];
                $html = view('/admin/view-quote-new', $dataview);

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

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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
            $warehouses = zoho_get_warehouses($accessToken, $organization_id);
                   //print_r($warehouses);  
                
            $dataview = ['admindata' => $data,'categories'=>$result,'warehouses'=>$warehouses];
            return view('/admin/inventory', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function deleteQuotation()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $quoteID = $this->request->getVar('quoteID');
            $quotation = $model->deleteQuotationadmin($quoteID);
            if (!$quotation) {
                 logAction('admin',$admin_id,'failed', 'admin delete quotation', ['reason' => 'Quotation deletion failed.','quoteID'=>$quoteID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Quotation deletion failed. Please try again.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin delete quotation', ['reason' => 'Quotation deleted successfully.','quoteID'=>$quoteID]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Quotation deleted successfully.']);

            }

        } else {
             logAction('admin',0,'failed', 'admin delete quotation', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function deleteCustomer()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $custID = $this->request->getVar('custID');
            $chekquotation = $model->checkquotationbycust($custID);
            if ($chekquotation == 'false') {
                 logAction('admin',$admin_id,'failed', 'admin delete customer', ['reason' => 'Customer deletion failed. This customer is associated with a quotation and cannot be removed.','custID'=>$custID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Customer deletion failed. This customer is associated with a quotation and cannot be removed.']);
            }
            $quotation = $model->deleteCustomeradmin($custID);
            if (!$quotation) {
                logAction('admin',$admin_id,'failed', 'admin delete customer', ['reason' => 'Customer deletion failed.','custID'=>$custID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Customer deletion failed. Please try again.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin delete customer', ['reason' => 'Customer deleted successfully.','custID'=>$custID]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Customer deleted successfully.']);

            }

        } else {
              logAction('admin',0,'failed', 'admin delete customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function autologincustomer()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $custID = $this->request->getVar('custID');
            $customer = $model->getcustomerwithcatebyid($custID);

            if ($customer) {
                    $customer_id = $session->get('customerId');
                    $session->remove(['customerId', 'isLoggedIn']);
                    $session->set('customerId', $customer[0]['customer_id']);
                    $session->set('isLoggedIn', true);

                 logAction('admin',$custID,'success', 'customer auto login', ['reason' => 'Customer auto login successful.', 'custID'=>$custID]);
                  return $this->response->setJSON(['status' => 'success', 'message' => 'Customer auto login successfully.']);
            }
            else{
                logAction('admin',$custID,'success', 'customer auto login', ['reason' => 'customer auto login failed.', 'custID'=>$custID]);
                  return $this->response->setJSON(['status' => 'error', 'message' => 'Customer auto login failed. Please try again.']);
            }
            
        }
                 
    }
    
     public function autologinseller()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $saleID = $this->request->getVar('saleID');
            $getseller = $model->getsellerbyidwithdel($saleID);

            if ($getseller) {
                    $session->remove(['sellerId', 'isLoggedInseller']);
                     $session->set('sellerId', $getseller[0]['sales_person_id']);
                    $session->set('isLoggedInseller', true);

                 logAction('admin',$saleID,'success', 'sales person auto login', ['reason' => 'Sales Person auto login successful.', 'saleID'=>$saleID]);
                  return $this->response->setJSON(['status' => 'success', 'message' => 'Seller Person auto login successfully.']);
            }
            else{
                logAction('admin',$saleID,'success', 'sales person auto login', ['reason' => 'sales person auto login failed.', 'saleID'=>$saleID]);
                  return $this->response->setJSON(['status' => 'error', 'message' => 'Sales Person auto login failed. Please try again.']);
            }
            
        }
                 
    }
    public function deleteperson()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $saleID = $this->request->getVar('saleID');
            $sellerdel = $model->deleteselleradmin($saleID);
            if (!$sellerdel) {
                 logAction('admin',$admin_id,'failed', 'admin delete person', ['reason' => 'Salesperson deletion failed.','saleID'=>$saleID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Salesperson deletion failed. Please try again.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin delete person', ['reason' => 'Salesperson deleted successfully.','saleID'=>$saleID]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Salesperson deleted successfully.']);

            }

        } else {
             logAction('admin',0,'failed', 'admin delete person', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function deleteuser()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $userID = $this->request->getVar('userID');
            $userdel = $model->deleteuseradmin($userID);
            if (!$userdel) {
                logAction('admin',$admin_id,'failed', 'admin delete user', ['reason' => 'User deletion failed.','userID'=>$userID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'User deletion failed. Please try again.']);
            } else {
                
                logAction('admin',$admin_id,'success', 'admin delete user', ['reason' => 'User deleted successfully.','userID'=>$userID]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'User deleted successfully.']);

            }

        } else {
            logAction('admin',0,'failed', 'admin delete user', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function deleteCategories()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $cateID = $this->request->getVar('cateID');

            $chekquotation = $model->checkcustomercate($cateID);
            if ($chekquotation == 'false') {
                logAction('admin',$admin_id,'failed', 'admin delete categories', ['reason' => 'Category deletion failed. This category is associated with a customer and cannot be removed','cateID'=>$cateID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category deletion failed. This category is associated with a customer and cannot be removed.']);
            }
            $quotation = $model->deleteCategoriesadmin($cateID);
            if (!$quotation) {
                 logAction('admin',$admin_id,'failed', 'admin delete categories', ['reason' => 'Category deletion failed.','cateID'=>$cateID]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category deletion failed. Please try again.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin delete categories', ['reason' => 'Category deleted successfully.','cateID'=>$cateID]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Category deleted successfully.']);
            }

        } else {
             logAction('admin',0,'failed', 'admin delete categories', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function listcustomer()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $custocate = $model->getcustomercate();
            $getseller = $model->getallsellerwithdel();
            $dataview = ['admindata' => $dataadmin, 'custocate' => $custocate, 'seller' => $getseller];
            return view('/admin/list-metrics', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function listperson()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $dataview = ['admindata' => $dataadmin];
            return view('/admin/list-report', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function listuser()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $dataview = ['admindata' => $dataadmin];
            return view('/admin/list-user', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function addcustomerbyadmin()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $custocate = $model->getcustomercate();
            $getseller = $model->getallsellerwithdel();
            $dataview = ['admindata' => $dataadmin, 'custocate' => $custocate, 'seller' => $getseller];
            return view('/admin/add-metrics', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function addpersonbyadmin()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $dataview = ['admindata' => $dataadmin];
            return view('/admin/add-person', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function adduserbyadmin()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $getcompany = $model->getallcompanhywithcvr();
            $dataview = ['admindata' => $dataadmin,'getcompany'=>$getcompany];
            return view('/admin/add-user', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

   public function addcompanybyadmin()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $getcompany = $model->getallcompanhywithcvr();
            $dataview = ['admindata' => $dataadmin,'getcompany'=>$getcompany];
            return view('/admin/add-user', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }
    public function adminsavecustomer()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $depart = $this->request->getVar('depart');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');
            $sellerid = $this->request->getVar('sellerid');

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
                logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                 logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Category is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$sellerid) {
                logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Saller fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Saller fields are required.']);
            }
            if (!$destatus) {
                 logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Status is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                 logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplication($email);
            if ($existingUser) {
                 logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $destatus,
                'sales_person_id' => $sellerid,
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
                'created_by_user' => 'admin',
                'created_by_userid' => $admin_id,
            );

            $insertSuccessful = $model->insertcustomerdata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save customer', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin save customer', ['reason' => 'Customer added successfully.', 'data' => $datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Customer added successfully.']);
        } else {
            logAction('seller',0,'failed', 'seller save customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsaveperson()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desig = $this->request->getVar('desig');
            $desc = $this->request->getVar('desc');

            if (!$fname) {
                logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                  logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                  logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$number) {
                  logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'Phone Number fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Phone Number fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                  logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationseller($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }
            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $desig,
                'company_id' => 1,
                'created_by_userid' => $admin_id,
            );

            $insertSuccessful = $model->insertpersondata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save person',  ['reason' => 'Data update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'failed', 'admin save person', ['reason' => 'Salesperson updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Salesperson added successfully.']);
        } else {
            logAction('admin',0,'failed', 'admin save person', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsaveuser()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desig = $this->request->getVar('desig');
            $desc = $this->request->getVar('desc');

            if (!$fname) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$number) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'Phone Number fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Phone Number fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationuser($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'company_id' => 1,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $desig,
            );

            $insertSuccessful = $model->insertuserdata($datasitem);
            if (!$insertSuccessful) {
                 logAction('admin',$admin_id,'failed', 'admin save user', ['reason' => 'Data insertion failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
             logAction('admin',$admin_id,'success', 'admin save user', ['reason' => 'User added successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully.']);
        } else {
             logAction('admin',0,'failed', 'admin save user', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavecomapnymanager()
{
    if ($this->session->has('isLoggedInadmin')) {
        $session = session();
        $model = new Admin_mdl();
        $admin_id = $session->get('adminId');
        $dataadmin = $model->where('admin_id', $admin_id)->first();

        // Get input values
        $fname       = $this->request->getVar('fname');
        $email       = $this->request->getVar('email');
        $company_name  = $this->request->getVar('cnames');
        $permissions = $this->request->getVar('permissions'); // array from frontend

        // Validation
        if (!$fname) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Full name is required.']);
        }
        if (!$email) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Email field is required.']);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
        }

        // Check duplicate email
        $existingUser = $model->checkemailduplicationmanager($email);
        if ($existingUser) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
        }
        $yourpassword = $fname . "@" . rand();
        $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);
        // Prepare data for insert
        $datasitem = [
            'name'  => $fname,
            'email'       => $email,
            'password' => $newpassword,
            'company'  => $company_name,
            'permission' => json_encode($permissions), // store permissions as JSON
        ];

        // Insert
        $insertSuccessful = $model->insertcomanymanagerdata($datasitem);
        if (!$insertSuccessful) {
           
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
        }
        $suppliers = $this->request->getVar('suppliers');
       $db = db_connect();
        $mailResults = [];
        
        foreach ($suppliers as $supplier_id) {
            $getcompany = $model->getallcompanhybyid($supplier_id);
            $yourpassword1 = $getcompany[0]['cvr'] . "@" . rand();
            $newpassword1 = password_hash($yourpassword1, PASSWORD_BCRYPT);
            
            $db->table('supplier')->insert([
                'parent_id'  => $insertSuccessful,
                'email' => $getcompany[0]['email'],
                'password'  => $newpassword1,
                'cvr' => $getcompany[0]['cvr'],
                'company'=> $getcompany[0]['company_name'],
            ]);
            
            $to1 = $getcompany[0]['email']; // recipient email
            $subject1 = "Your Supplier Account Details";
        
            $user_email1 = $getcompany[0]['email'];
            $user_password1 = $yourpassword1;
        
            $message1 = "
            Hello,
            
            Your Supplier account has been created.
            
            Email: $user_email1
            Password: $user_password1
            
            Please login to verify your account.
            
            Thanks,
            VSME Dashboard - ESG Reporting Platform";
        
            $headers1 = "From: no-reply@vyanainfosys.in\r\n";
            $headers1 .= "Reply-To: support@vyanainfosys.in\r\n";
            $headers1 .= "X-Mailer: PHP/" . phpversion();
        
            if (mail($to1, $subject1, $message1, $headers1)) {
                $mailResults[] = "Supplier email sent to $user_email1";
            } else {
                $mailResults[] = "Failed to send supplier email to $user_email1";
            }
        }
        
        // Send parent company email
        $to = $email; // recipient email
        $subject = "Your Account Details";
        
        $user_email = $email;
        $user_password = $yourpassword;
        
        $message = "
        Hello,
        
        Your account has been created.
        
        Email: $user_email
        Password: $user_password
        
        Please change your password after logging in.
        
        Thanks,
        VSME Dashboard - ESG Reporting Platform";
        
        $headers = "From: no-reply@vyanainfosys.in\r\n";
        $headers .= "Reply-To: support@vyanainfosys.in\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();
        
        if (mail($to, $subject, $message, $headers)) {
            $mailResults[] = "Parent company email sent to $user_email";
        } else {
            $mailResults[] = "Failed to send parent company email to $user_email";
        }
        
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Process completed.',
            'mail_results' => $mailResults,
        ]);
    }

}

     public function adminsavecompanies()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $cname = $this->request->getVar('cname');
            $email = $this->request->getVar('email');
            $location = $this->request->getVar('location');

            if (!$cname) {
                logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'Company name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Company name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$location) {
                logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'Locations fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Locations fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationuser($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'company_name' => $cname,
                'email' => $email,
                'address' => $location
            );

            $insertSuccessful = $model->insertcomapanydata($datasitem);
            if (!$insertSuccessful) {
                 logAction('admin',$admin_id,'failed', 'admin save companies', ['reason' => 'Data insertion failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
             logAction('admin',$admin_id,'success', 'admin save companies', ['reason' => 'Company added successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Company added successfully.']);
        } else {
             logAction('admin',0,'failed', 'admin save companies', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    public function adminupdatecustomer()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $customerid = $this->request->getVar('customerid');
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $depart = $this->request->getVar('depart');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');
            $sellerid = $this->request->getVar('sellerid');
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
                 logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Invalid customer id.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid customer.']);
            }

            if (!$fname) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'First name is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Last name is required.', 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Email fields are required.','id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Category is required.','id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$destatus) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Status is required.','id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Invalid email address.', 'email' => $email, 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }
            $datasitema = array(
                'customerid' => $customerid,
                'email' => $email);
            $existingUser = $model->checkemailduplicationbyid($datasitema);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'This email is already registered.', 'email' => $email, 'id' => $customerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'customerid' => $customerid,
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'sales_person_id' => $sellerid,
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
                'created_by_user' => 'admin',
                'created_by_userid' => $admin_id,
            );

            $insertSuccessful = $model->updatecustomerdata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin update customer', ['reason' => 'Data update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin update customer', ['reason' => 'Customer updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Customer updated successfully.']);
        } else {
             logAction('admin',0,'failed', 'admin update customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminupdateperson()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');
            $sellerid = $this->request->getVar('sellerid');

            if (!$sellerid) {
                logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'Sales Person are Not valid.',"personID"=>$sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Sales Person are Not valid.']);
            }

            if (!$fname) {
                  logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'First name is required.',"personID"=>$sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'Last name is required.',"personID"=>$sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'Email fields are required.',"personID"=>$sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'Invalid email address.', 'email' => $email, 'personID' => $sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

      

            $datasitema = array(
                'sales_person_id' => $sellerid,
                'email' => $email);
            $existingUser = $model->checkemailduplicationbyseller($datasitema);

            if ($existingUser) {
                 logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'This email is already registered.', 'email' => $email, 'personID' => $sellerid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'sales_person_id' => $sellerid,
                'status' => $destatus,
            );

            $insertSuccessful = $model->updatepersondata($datasitem);
            if (!$insertSuccessful) {
                 logAction('admin',$admin_id,'failed', 'admin update person', ['reason' => 'Data insertion failed.', $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin update person', ['reason' => 'Sales Person updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Sales Person Update successfully!']);
        } else {
             logAction('admin',0,'failed', 'admin update person', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminupdateuser()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $destatus = $this->request->getVar('destatus');
            $desc = $this->request->getVar('desc');
            $adminid = $this->request->getVar('adminid');

            if (!$adminid) {
                 logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'Invalid user.', 'id' => $adminid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid user.']);
            }

            if (!$fname) {
                 logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'First name is required.', 'id' => $adminid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                 logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'Last name is required.', 'id' => $adminid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                 logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'Email fields are required.', 'id' => $adminid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }
            $datasitema = array(
                'admin_id' => $adminid,
                'email' => $email);
            $existingUser = $model->checkemailduplicationbyUser($datasitema);

            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'phone_number' => $number,
                'description' => $desc,
                'admin_id' => $adminid,
                'status' => $destatus,
            );

            $updateSuccessful = $model->updateuserdata($datasitem);
            if (!$updateSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin update user', ['reason' => 'Data insertion failed.', $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin update user', ['reason' => 'User updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'User Update successfully!']);
        } else {
             logAction('admin',0,'failed', 'admin update user', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavesendcustomer()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $sellerid = $this->request->getVar('sellerid');
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
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$depart) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Category is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category is required.']);
            }
            if (!$sellerid) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Sales Person fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Sales Person fields are required.']);
            }
            if (!$destatus) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Status is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Status is required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplication($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }
            $yourpassword = $fname . "@" . rand();
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'sales_person_id' => $sellerid,
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
                'created_by_user' => 'admin',
                'created_by_userid' => $admin_id,
            );

            $insertSuccessful = $model->insertcustomerdata($datasitem);
            if (!$insertSuccessful) {
                  logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
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
                 logAction('admin',$admin_id,'failed', 'admin save and send customer', ['reason' => 'Something went wrong.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin save and send customer', ['reason' => 'Customer added successfully.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Customer added successfully.']);

            }
            curl_close($ch);

        } else {
            logAction('seller',0,'failed', 'seller save and send customer', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavesendperson()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desig = $this->request->getVar('desig');
            $desc = $this->request->getVar('desc');

            if (!$fname) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$number) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Phone Number fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Phone Number fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationseller($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }
            $yourpassword = $fname . "@" . rand();
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'company_id' => 1,
                'email' => $email,
                'password' => $newpassword,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $desig,
            );

            $insertSuccessful = $model->insertpersondata($datasitem);
            if (!$insertSuccessful) {
                 logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
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
                logAction('admin',$admin_id,'failed', 'admin save and send person', ['reason' => 'Something went wrong.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin save and send person', ['reason' => 'Salesperson added successfully.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Salesperson added successfully.']);

            }
            curl_close($ch);

        } else {
            logAction('admin',0,'failed', 'admin save and send person', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavesenduser()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $fname = $this->request->getVar('fname');
            $lname = $this->request->getVar('lname');
            $email = $this->request->getVar('email');
            $number = $this->request->getVar('number');
            $desig = $this->request->getVar('desig');
            $desc = $this->request->getVar('desc');

            if (!$fname) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'First name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'First name is required.']);
            }
            if (!$lname) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Last name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Last name is required.']);
            }
            if (!$email) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Email fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Email fields are required.']);
            }
            if (!$number) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Phone Number fields are required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Phone Number fields are required.']);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Invalid email address.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Enter a valid email address.']);
            }

            $existingUser = $model->checkemailduplicationuser($email);
            if ($existingUser) {
                logAction('admin',$admin_id,'failed', 'admin save and send user',  ['reason' => 'This email is already registered.', 'email' => $email]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This email is already registered.']);
            }
            $yourpassword = $fname . "@" . rand();
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'first_name' => $fname,
                'last_name' => $lname,
                'company_id' => 1,
                'email' => $email,
                'password' => $newpassword,
                'phone_number' => $number,
                'description' => $desc,
                'status' => $desig,
            );

            $insertSuccessful = $model->insertuserdata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Data insertion failed.', 'data' => $datasitem]);
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
                 logAction('admin',$admin_id,'failed', 'admin save and send user', ['reason' => 'Something went wrong.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                 logAction('admin',$admin_id,'success', 'admin save and send user', ['reason' => 'User added successfully.', 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'User added successfully.']);

            }
            curl_close($ch);
        } else {
             logAction('admin',0,'failed', 'admin save and send user', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavepassword()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $yourpassword = $this->request->getVar('password');
            $confirmpassword = $this->request->getVar('cpassword');
            $customer_id = $this->request->getVar('customerid');

            if (!$yourpassword || !$confirmpassword) {
                logAction('admin',$admin_id,'failed', 'admin save password', ['reason' => 'All fields must be filled in.','id'=>$customer_id]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                logAction('admin',$admin_id,'failed', 'admin save password', ['reason' => 'New password and confirm password do not match.','id'=>$customer_id,'yourpassword'=>$yourpassword,'confirmpassword'=>$confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'customer_id' => $customer_id,
                'password' => $newpassword,
            );

            $updateSuccessful = $model->updatepassword($datasitem);

            if (!$updateSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save password', ['reason' => 'Password update failed.','id'=>$customer_id,'yourpassword'=>$yourpassword,'confirmpassword'=>$confirmpassword]);
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
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Password Update By Admin\",\n  \"html_body\": \"<p>Dear $fname</p><br>If you have any questions, feel free to reach out to us anytime.<br>Best regards Havells Lighting Team<br>Username:<b>$email</b><br>Password:<b>$yourpassword</b>\"\n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                 logAction('admin',$admin_id,'failed', 'admin save password', ['reason' => 'Mail Not Send!','id'=>$customer_id,'email'=>$toemial,$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Mail Not Send!']);
            } else {
                logAction('admin',$admin_id,'success', 'admin save password', ['reason' => 'Password updated successfully.','id'=>$customer_id,$datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);
            }
            curl_close($ch);

        } else {
            logAction('admin',0,'failed', 'admin save password', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavepasswordperson()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $yourpassword = $this->request->getVar('password');
            $confirmpassword = $this->request->getVar('cpassword');
            $seller_id = $this->request->getVar('sellerid');

            if (!$yourpassword || !$confirmpassword) {
                     logAction('admin',$admin_id,'failed', 'admin save password person', ['reason' => 'All fields must be filled in.','id'=>$seller_id]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                logAction('admin',$admin_id,'failed', 'admin save password person', ['reason' => 'New password and confirm password do not match.','id'=>$seller_id,'yourpassword'=>$yourpassword,'confirmpassword'=>$confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'sales_person_id' => $seller_id,
                'password' => $newpassword,
            );

            $updateSuccessful = $model->updatepasswordperson($datasitem);

            if (!$updateSuccessful) {
              logAction('admin',$admin_id,'failed', 'admin save password person', ['reason' => 'Password update failed.', 'id'=>$seller_id,'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }

            $getseller = $model->getsellerbyid($seller_id);
            $email = $getseller[0]['email'];
            $fname = $getseller[0]['first_name'];
            $toemial = $email;

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

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Password Update By Admin\",\n  \"html_body\": \"<p>Dear $fname</p><br>If you have any questions, feel free to reach out to us anytime.<br>Best regards Havells Lighting Team<br>Username:<b>$email</b><br>Password:<b>$yourpassword</b>\"\n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
                 logAction('admin',$admin_id,'failed', 'admin save password person', ['reason' => 'Something went wrong.','id'=>$seller_id, 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin save password person',  ['reason' => 'Password updated successfully.', 'id'=>$seller_id,'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);

            }
            curl_close($ch);

        } else {
            logAction('admin',0,'failed', 'admin save password person', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function adminsavepassworduser()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $yourpassword = $this->request->getVar('password');
            $confirmpassword = $this->request->getVar('cpassword');
            $adminid = $this->request->getVar('adminid');

            if (!$yourpassword || !$confirmpassword) {
                logAction('admin',$admin_id,'failed', 'admin save password user', ['reason' => 'All fields must be filled in.','id'=>$adminid]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }

            if ($yourpassword != $confirmpassword) {
                logAction('admin',$admin_id,'failed', 'admin save password user', ['reason' => 'New password and confirm password do not match.','id'=>$adminid,'yourpassword'=>$yourpassword,'confirmpassword'=>$confirmpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'New password and confirm password do not match.']);
            }
            $newpassword = password_hash($yourpassword, PASSWORD_BCRYPT);

            $datasitem = array(
                'admin_id' => $adminid,
                'password' => $newpassword,
            );

            $updateSuccessful = $model->updatepassworduser($datasitem);

            if (!$updateSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save password user', ['reason' => 'Password update failed.', 'id'=>$adminid,'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
            }
            $getadmin = $model->getuserbyid($adminid);
            $email = $getadmin[0]['email'];
            $fname = $getadmin[0]['first_name'];
            $toemial = $email;

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

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "\n{\n  \"sender\": \"$smtp2email\",\n  \"to\": [\n    \"$toemial\"\n  ],\n  \"subject\": \"Password Update By Admin\",\n  \"html_body\": \"<p>Dear $fname</p><br>If you have any questions, feel free to reach out to us anytime.<br>Best regards Havells Lighting Team<br>Username:<b>$email</b><br>Password:<b>$yourpassword</b>\"\n}\n");

            $headers = array();
            $headers[] = 'Content-Type: application/json';
            $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
            $headers[] = 'Accept: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);

            if (curl_errno($ch)) {
               logAction('admin',$admin_id,'failed', 'admin save password user', ['reason' => 'Something went wrong.','id'=>$adminid, 'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Something went wrong.']);
            } else {
                logAction('admin',$admin_id,'success', 'admin save password user',  ['reason' => 'Password updated successfully.', 'id'=>$adminid,'data' => $datasitem]);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Password updated successfully.']);

            }
            curl_close($ch);
        } else {
            logAction('admin',0,'failed', 'admin save password user', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function editcustomer($ids)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $customer = $model->getcustomerwithcatebyid($ids);
            $custocate = $model->getcustomercate();
            $getseller = $model->getallsellerwithdel();
            $dataview = ['admindata' => $dataadmin, 'customerdata' => $customer[0], 'custocate' => $custocate, 'seller' => $getseller];
            return view('/admin/edit-customer', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }
    
    public function getCustomerData()
    {
      if ($this->session->has('isLoggedInadmin')) {
        $customer_id = $this->request->getPost('customer_id');
    
        $userModel = new Admin_mdl();
        $getcustomer = $userModel->getcustomerwithcatebyid($customer_id);
        if ($getcustomer) {
            return $this->response->setJSON(['success' => true, 'data' => $getcustomer[0]]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
        } else {
                return redirect()->to('/admin/login');
            }
    }

    public function editperson($ids)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $getseller = $model->getsellerbyidwithdel($ids);
            if (empty($getseller)) {
                $getsellers = "error";
            } else {
                $getsellers = $getseller[0];
            }
            $dataview = ['admindata' => $dataadmin, 'seller' => $getsellers];
            return view('/admin/edit-person', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }
    
    public function getPersonData()
    {
        if ($this->session->has('isLoggedInadmin')) {
        $seller_id = $this->request->getPost('seller_id');
    
        $Model = new Admin_mdl();
        $getseller = $Model->getsellerbyidwithdel($seller_id);
        if ($getseller) {
            return $this->response->setJSON(['success' => true, 'data' => $getseller[0]]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Person not found']);
        }
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function edituser($ids)
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $getadmin = $model->getuserbyidwithdel($ids);
       
            if (empty($getadmin)) {
                $getadmins = "error";
            } else {
                $getadmins = $getadmin[0];
            }
            $dataview = ['admindata' => $dataadmin, 'userlist' => $getadmins];
            return view('/admin/edit-user', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }
    
    public function getUserData()
    {
      if ($this->session->has('isLoggedInadmin')) {
        $admin_id = $this->request->getPost('admin_id');
    
        $userModel = new Admin_mdl();
        $userData = $userModel->where('admin_id', $admin_id)->first();
        $getadmin = $userModel->getuserbyidwithdel($admin_id);
        if ($getadmin) {
            return $this->response->setJSON(['success' => true, 'data' => $getadmin[0]]);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'User not found']);
        }
    } else {
            return redirect()->to('/admin/login');
        }
    }
    
    


    public function adminforgotpassword()
    {
        return view('/admin/forgot-password');
    }

    public function adminsendpassword()
    {

        $email = $this->request->getPost('email');
        if (!$email) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email fields are required.');
            logAction('admin',0,'failed', 'admin forgot password', ['reason' => 'Email fields are required.']);
            return redirect()->to('/admin/forgot-password');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Enter a valid email address.');
            logAction('admin',0,'failed', 'admin forgot password', ['reason' => 'Invalid email address.', 'email' => $email]);
            return redirect()->to('/admin/forgot-password');
        }
        // Check if the email exists in the database
        $model = new Admin_mdl();
        $user = $model->where('email', $email)->where('delete_status', '0')->first();

        if ($user) {
            // Generate a reset token
            $token = bin2hex(random_bytes(50)); // You can use a more secure method
            $expiresAt = date('Y-m-d H:i:s', time() + 3600); // Token expires in 1 hour

            // Store the token and expiration date in the database

            $updateSuccessful = $model->update($user['admin_id'], ['reset_token' => $token, 'reset_token_expiry' => $expiresAt]);

            // Send the reset link via email
            $this->_send_reset_email($email, $token);

            $session = \Config\Services::session();
            $session->setFlashdata('success', 'Check your email for the reset link.');
            logAction('admin',0,'success', 'admin forgot password', ['reason' => 'Check your email for the reset link.', 'email' => $email]);
            return redirect()->to('/admin/login');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Email address not found.');
            logAction('admin',0,'failed', 'admin forgot password', ['reason' => 'Email address not found.', 'email' => $email]);
            return redirect()->to('/admin/forgot-password');
        }

    }

    private function _send_reset_email($email, $token)
    {
        $model = new Admin_mdl();
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
        $resetLink = site_url('/admin/reset-password/' . $token);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://api.smtp2go.com/v3/email/send');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "sender" => $smtp2email,
            "to" => [$toemial],
            "subject" => "Password Reset Request From Havells Lighting",
            "html_body" => "Click <a href=\"$resetLink\">here</a> to reset your password."
        ]));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'X-Smtp2go-Api-Key: ' . $smtp2gokey;
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            logAction('admin',0,'failed', 'admin reset password', ['reason' => 'Error:' . curl_error($ch), 'token' => $token]);
            echo 'Error:' . curl_error($ch);

        }
        curl_close($ch);

    }

    public function adminresetlink($token = null)
    {
        if (!$token) {
            return redirect()->to('/admin/forgot-password');
        }

        // Validate the token and check its expiry
        $Model = new Admin_mdl();
        $Customer = $Model->where('reset_token', $token)->first();

        if ($Customer && strtotime($Customer['reset_token_expiry']) > time()) {
            // Token is valid, show password reset form
            return view('/admin/reset-password', ['token' => $token]);
        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
             logAction('admin',0,'failed', 'admin reset password', ['reason' => 'Invalid or expired token.', 'token' => $token]);
            return redirect()->to('/admin/forgot-password');
        }
    }

    public function adminresetpasswordprocess()
    {

        $token = $this->request->getPost('token');
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');
        if (!$password || !$cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'All fields must be filled in.');
            logAction('admin',0,'failed', 'admin reset password', ['reason' => 'all fields must be filled in.','token'=>$token]);
            return redirect()->to('/admin/reset-password/' . $token);
        }

        if ($password != $cpassword) {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'New password and confirm password do not match.');
            logAction('admin',0,'failed', 'admin reset password', ['reason' => 'New password and confirm password do not match.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
            return redirect()->to('/admin/reset-password/' . $token);
        }

        // Validate token and check its expiry
        $Model = new Admin_mdl();
        $Customer = $Model->where('reset_token', $token)->first();

        if ($Customer && strtotime($Customer['reset_token_expiry']) > time()) {

            $newpassword = password_hash($password, PASSWORD_BCRYPT);
            $updateSuccessful = $Model->update($Customer['admin_id'], ['password' => $newpassword, 'reset_token' => null, 'reset_token_expiry' => null]);
            if (!$updateSuccessful) {
                logAction('admin',$Customer['admin_id'],'failed', 'admin reset password', ['reason' => 'Password update failed.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Password update failed. Please try again.']);
                $session = \Config\Services::session();
                $session->setFlashdata('msg', 'Password update failed. Please try again.');
                return redirect()->to('/admin/reset-password/' . $token);
            }

            $session = \Config\Services::session();
            $session->setFlashdata('success', 'Password updated successfully.');
            logAction('admin',$Customer['admin_id'],'success', 'admin reset password', ['reason' => 'Password updated successfully.','token'=>$token,'password'=>$password,'confirmpassword'=>$cpassword]);
            return redirect()->to('/admin/login/');

        } else {
            $session = \Config\Services::session();
            $session->setFlashdata('msg', 'Invalid or expired token.');
            logAction('admin',0,'failed', 'admin reset password', ['reason' => 'Invalid or expired token.','token'=>$token]);
            return redirect()->to('/admin/forgot-password');
        }
    }

    public function listcategories()
    {

        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $data = $model->where('admin_id', $admin_id)->first();
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
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
                $apiselectcat="";
                if ($accessToken) {
                    $apiselectcat = zoho_get_pricebooks($accessToken, $organization_id);
                }
            
            $dataview = ['admindata' => $data,'apiselectcat'=>$apiselectcat];
            return view('/admin/category', $dataview);
        } else {
            return redirect()->to('/admin/login');
        }
    }

    public function adminsavecategories()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $cnameid = $this->request->getVar('cid');
            $cname1 = $this->request->getVar('cname');
            $cname = trim($cname1);
            $desig = $this->request->getVar('desig');
            $desc = $this->request->getVar('desc');

            if (!$cname) {
                logAction('admin',$admin_id,'failed', 'admin save categories', ['reason' => 'Category name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category name is required.']);
            }

            $existingcate = $model->checkcateduplication($cnameid);
            if ($existingcate) {
                logAction('admin',$admin_id,'failed', 'admin save categories', ['reason' => 'This category name is already in use.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This category name is already in use.']);
            }

            $datasitem = array(
                'pricebook_id' => $cnameid,
                'category_name' => $cname,
                'status' => $desig,
                'desc' => $desc,
            );

            $insertSuccessful = $model->insertcategoriesdata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin save categories', ['reason' => 'Data insertion failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin save categories', ['reason' => 'Categories added successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Categories added successfully.', 'id' => $insertSuccessful]);
        } else {
            logAction('admin',0,'failed', 'admin save categories', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }

    public function admincateedit()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $dataadmin = $model->where('admin_id', $admin_id)->first();
            $cname2 = $this->request->getVar('cname1');
            $cname1 = trim($cname2);
            $desig1 = $this->request->getVar('desig1');
            $desc1 = $this->request->getVar('desc1');
            $modalValue = $this->request->getVar('modalValue');

            if (!$cname1) {
                logAction('admin',$admin_id,'failed', 'admin update categories', ['reason' => 'Category name is required.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Category name is required.']);
            }

            $datasitema = array(
                'customer_category_id' => $modalValue,
                'category_name' => $cname1);
            $existingcate = $model->checkcateduplicationbyid($datasitema);
            if ($existingcate) {
                logAction('admin',$admin_id,'failed', 'admin update categories', ['reason' => 'This category name is already in use.','cname1'=>$cname1]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'This category name is already in use.']);
            }

            $datasitem = array(
                'category_name' => $cname1,
                'status' => $desig1,
                'desc' => $desc1,
                'modalValue' => $modalValue,

            );

            $insertSuccessful = $model->updatecategoriesdata($datasitem);
            if (!$insertSuccessful) {
                logAction('admin',$admin_id,'failed', 'admin update categories', ['reason' => 'Data insertion failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Data insertion failed. Please try again.']);
            }
            logAction('admin',$admin_id,'success', 'admin update categories', ['reason' => 'Categories added successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Categories added successfully.']);
        } else {
            logAction('admin',0,'failed', 'admin update categories', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function datatablelistquotation()
   {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
        $request = service('request');
        $db = db_connect();
        $builder = $db->table('quotation')
            ->select('
                quotation.quotation_id, 
                quotation.quotation_number, 
                quotation.sales_person_id, 
                quotation.created_at AS quotation_created_at, 
                quotation.grand_total, 
                quotation.status, 
                 quotation.comment, 
                CONCAT(customer.first_name, " ", customer.last_name) AS customer_name, 
                 customer_category.category_name
            ')
            ->join('customer', 'customer.customer_id = quotation.customer_id')
            ->join('customer_category', 'customer_category.customer_category_id = customer.customer_category_id')
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
            return redirect()->to('/admin/login');
        }
    }

   public function datatablelistcustomer()
   {
    if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
        $request = service('request');
        $db = db_connect();
        $builder = $db->table('customer')
            ->select('
                customer.customer_id, 
                customer.customer_category_id, 
                customer.sales_person_id, 
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
            ->join('sales_person', 'sales_person.sales_person_id = customer.sales_person_id', 'left')
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
                'sales_person.first_name',
                'sales_person.last_name',
                 'CONCAT(sales_person.first_name, " ", sales_person.last_name)',
                'customer.status'
               
            ])
            ->toJson(true);
        } else {
            return redirect()->to('/admin/login');
        }
    }

   public function datatablelistperson()
   {
    if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $request = service('request');
            $db = db_connect();

            
          $builder = $db->table('sales_person sp')
            ->select('sp.first_name, sp.last_name, sp.email, sp.phone_number, sp.description, sp.status, sp.sales_person_id, CONCAT(sp.first_name, " ", sp.last_name) as sales_person_name, COUNT(c.customer_id) as customer_count')
            ->join('customer c', 'sp.sales_person_id = c.sales_person_id', 'left')
            ->where('sp.delete_status !=', '1')
            ->groupBy('sp.first_name, sp.last_name, sp.email, sp.phone_number, sp.description, sp.status, sp.sales_person_id')
            ->orderBy('sp.sales_person_id', 'DESC');
        
        return DataTable::of($builder)
            ->addNumbering()
            ->setSearchableColumns([
                'sp.first_name',           
                'sp.last_name',            
                'sp.email',                
                'sp.phone_number',
                'CONCAT(sp.first_name, " ", sp.last_name)', // Enable searching by full name
                'sp.status',
            ])
           
            ->toJson(true);

        } else {
            return redirect()->to('/admin/login');
        }
    }

   public function datatableinventory()
   {
      if (session()->has('isLoggedInadmin')) {
        $session = session();
        $admin_id = $session->get('adminId');

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
                'cf_sheet',
                'stock',
                'warehouse_detail',
            ]);

       return DataTable::of($builder)
    ->addNumbering()
    ->setSearchableColumns([
        'item_name',
        'sku',
        'description',
        'stocks',
        'unit',
        'rate',
         'stock'
    ])
    ->edit('warehouse_detail', function ($row) {
    $json = html_entity_decode($row->warehouse_detail);
    $decoded = json_decode($json ?? '{}', true);
    if (!is_array($decoded)) {
        log_message('error', 'Invalid JSON in stock_by_warehouse: ' . $json);
        $decoded = [];
    }
    return (object) $decoded;
})
   ->edit('rate_cate', function ($row) {
    $json = html_entity_decode($row->rate_cate);
    $decoded = json_decode($json ?? '{}', true);
    if (!is_array($decoded)) {
        log_message('debug', 'Invalid JSON: ' . $json);
        $decoded = [];
    }

    return (object) $decoded;
})

    ->toJson(true);
    } else {
        return redirect()->to('/admin/login');
    }

   } 
   
public function datatablecompany()
{
    if ($this->session->has('isLoggedInadmin')) {
        $db = db_connect();

        $builder = $db->table('company')
            ->select('company.company_id, company.company_name, company.email, company.address, company.created_at, company.updated_at, reportdata.cvr')
            ->join('reportdata', 'reportdata.email = company.email', 'left');

        return DataTable::of($builder)
            ->addNumbering('serial_no')
            ->setSearchableColumns([
                'company.company_name',
                'reportdata.cvr',
                'company.email',
                'company.address',
                'company.created_at'
            ])
            ->toJson(true);

    } else {
        return redirect()->to('/admin/login');
    }
}




public function datatablecompanymanager()
{
    if ($this->session->has('isLoggedInadmin')) {
        $session = session();
        $admin_id = $session->get('adminId');
        $db = db_connect();

        $builder = $db->table('company_manager cm')
            ->select('cm.name, cm.email, cm.company, cm.permission, cm.created_at, cm.cm_id');

        return DataTable::of($builder)
            ->addNumbering('serial_no')
            ->setSearchableColumns([
                'cm.name',
                'cm.email',
                'cm.company',
                'cm.permission',
                'cm.created_at'
            ])
            ->edit('permission', function ($row) {
                $permissions = json_decode($row->permission, true);
                if (is_array($permissions)) {
                    return implode(', ', $permissions); // comma separated
                }
                return $row->permission;
            })
            ->toJson(true);
    } else {
        return redirect()->to('/admin/login');
    }
}





    
  public function datatablelistuser()
   {
    if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $request = service('request');
            $db = db_connect();

       
           $builder = $db->table('admin')
            ->select('first_name, last_name,email,phone_number,description,status, admin_id, CONCAT(first_name, " ",last_name) as full_name')
             ->where('delete_status', '0')
            ->where('admin_id  !=', $admin_id)
            ->orderBy('admin_id', 'DESC');
            
        return DataTable::of($builder)
            ->addNumbering()
            ->setSearchableColumns([
                'first_name',           
                'last_name',            
                'email',                
                'phone_number',
                'CONCAT(first_name, " ",last_name)', // Enable searching by full name
                'status',
            ])
           
            ->toJson(true);

        } else {
            return redirect()->to('/admin/login');
        }
    }
    
   public function datatablelistcategories()
   {
    if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $request = service('request');
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
        
        return DataTable::of($builder)
            ->addNumbering()
            ->setSearchableColumns([
                'category_name',           
                'status',
            ])
           
            ->toJson(true);

        } else {
            return redirect()->to('/admin/login');
        }
    }
    
    public function logout()
    {
        $session = \Config\Services::session();
        $session->remove(['admin_id', 'isLoggedInadmin']);
        $session->setFlashdata('success', 'Logged out successfully.');
        return redirect()->to('/admin/login');
    }
    
    public function cleardatabases()
    {
        return view('/admin/clear_tables_view'); 
    }
    
    public function clearTables()
    {
        // Get username & password from URL query parameters
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $model = new Admin_mdl();
            $Zohoaccess = $model->getZohoAccess();
            $validUsername = "";
            $validPassword = "";
        
            foreach ($Zohoaccess as $zohodata) {
                if ($zohodata['key_name'] == "database_clear_username") {
                    $validUsername = $zohodata['value'];
                }
                 if ($zohodata['key_name'] == "database_clear_password") {
                    $validPassword = $zohodata['value'];
                }
            }


          // Check credentials
        if ($username !== $validUsername || $password !== $validPassword) {
             logAction('admin',0,'failed', 'admin clear database', ['reason' => 'Invalid username or password!','username'=>$username,'password'=>$password]);
            return view('/admin/clear_tables_view', ['message' => 'Invalid username or password!']);
        }

        $db = db_connect();
        $tables = $db->listTables();

        // Disable foreign key checks (for MySQL)
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($tables as $table) {
            if ($table !== 'admin') { // Skip 'admin' table
                $db->query("TRUNCATE TABLE " . $db->escapeIdentifiers($table));
            }
        }

        // Re-enable foreign key checks
        $db->query('SET FOREIGN_KEY_CHECKS=1');
        logAction('admin',0,'success', 'admin clear database', ['reason' => 'All tables except admin have been emptied!','username'=>$username,'password'=>$password]);
        return view('/admin/clear_tables_view', ['message' => 'All tables except admin have been emptied!']);
    }
    
    public function adminupdatesettingzoho()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $zoho_client_id = $this->request->getVar('zoho_client_id');
            $zoho_client_secret = $this->request->getVar('zoho_client_secret');
            $zoho_refresh_token_book = $this->request->getVar('zoho_refresh_token_book');
            $zoho_refresh_token_book = $this->request->getVar('zoho_refresh_token_book');
            $zoho_organization_id = $this->request->getVar('zoho_organization_id');

            if (!$zoho_client_id || !$zoho_client_secret || !$zoho_refresh_token_book || !$zoho_refresh_token_book || !$zoho_organization_id) {
                 logAction('admin', $admin_id,'failed', 'admin zoho setting update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }
             $datasitem = array(
                'zoho_client_id' => $zoho_client_id,
                'zoho_client_secret' => $zoho_client_secret,
                'zoho_refresh_token_book' => $zoho_refresh_token_book,
                'zoho_refresh_token_book' => $zoho_refresh_token_book,
                'zoho_organization_id' => $zoho_organization_id,

            );
            $updateSuccessful = $model->updatesettingdata($datasitem);
            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin zoho setting update', ['reason' => 'Zoho setting update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Zoho setting  update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin zoho setting update', ['reason' => 'Zoho setting updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Zoho setting updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin zoho setting update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function adminupdatesettingsmtp2go()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $smtp2go_email = $this->request->getVar('smtp2go_email');
            $smtp2go_key = $this->request->getVar('smtp2go_key');

            if (!$smtp2go_email || !$smtp2go_key ) {
                 logAction('admin', $admin_id,'failed', 'admin smtp2go setting update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }
             $datasitem = array(
                'smtp2go_email' => $smtp2go_email,
                'smtp2go_key' => $smtp2go_key,

            );
            $updateSuccessful = $model->updatesettingdata($datasitem);
            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin smtp2go setting update', ['reason' => 'smtp2go setting update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'smtp2go setting  update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin smtp2go setting update', ['reason' => 'smtp2go setting updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'smtp2go setting updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin smtp2go setting update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function adminupdatesettinggeneral()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $quot_prefix = $this->request->getVar('quot_prefix');
            $quote_number_length = $this->request->getVar('quote_number_length');
            $dateformat = $this->request->getVar('dateformat');
            $default_timezone = $this->request->getVar('default_timezone');
            $currency = $this->request->getVar('currency');
            $currencysymbol= $this->request->getVar('currencysymbol');
            $adminhelpemail= $this->request->getVar('adminhelpemail');
            $cronTime= $this->request->getVar('crontime');

            if (!$quot_prefix || !$quote_number_length || !$dateformat || !$default_timezone || !$currency || !$currencysymbol || !$adminhelpemail) {
                 logAction('admin', $admin_id,'failed', 'admin general setting update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }
             $datasitem = array(
                'quot_prefix' => $quot_prefix,
                'quote_number_length' => $quote_number_length,
                'dateformat' => $dateformat,
                'default_timezone' => $default_timezone,
                'currency' => $currency,
                'currency-symbol' => $currencysymbol,
                'admin-help-email' => $adminhelpemail,
                'cron_job_time' =>$cronTime,

            );
        if (!$cronTime || !preg_match('/^([\*\d\/,\-]+\s){4}[\*\d\/,\-]+$/', $cronTime)) {
          logAction('admin', $admin_id,'failed', 'admin general setting update', ['reason' => 'Invalid cron time format.']);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid cron time format.']);
        }

        $command = "$cronTime /usr/bin/curl -s 'https://partner1.havellslighting.com/admin/sync-inventorycron'";
        
   
        
        $output = [];
        exec('crontab -l', $output);
        
        // Remove any old `sync-inventory` cron to avoid duplicates
        $output = array_filter($output, function ($line) {
            return !str_contains($line, 'admin/sync-inventory'); // Correct filtering
        });
        
        // Add new cron job
        $output[] = $command;
        
        // Write to a temp file and update crontab
        $tmpFile = tempnam(sys_get_temp_dir(), 'cron');
        file_put_contents($tmpFile, implode(PHP_EOL, $output) . PHP_EOL);
        exec("crontab $tmpFile");
        unlink($tmpFile);
        
            
            $updateSuccessful = $model->updatesettingdata($datasitem);
            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin general setting update', ['reason' => 'General setting update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'General setting update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin general setting update', ['reason' => 'General setting updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'General setting updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin general setting update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function adminupdatesettinggeneralcron()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $cronTime= $this->request->getVar('crontime');
             $datasitem = array(
                'cron_job_time' =>$cronTime,

            );
        if (!$cronTime || !preg_match('/^([\*\d\/,\-]+\s){4}[\*\d\/,\-]+$/', $cronTime)) {
          logAction('admin', $admin_id,'failed', 'admin general setting update', ['reason' => 'Invalid cron time format.']);
            return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid cron time format.']);
        }

        $command = "$cronTime /usr/bin/curl -s 'https://partner1.havellslighting.com/admin/sync-inventorycron'";
        
   
        
        $output = [];
        exec('crontab -l', $output);
        
        // Remove any old `sync-inventory` cron to avoid duplicates
        $output = array_filter($output, function ($line) {
            return !str_contains($line, 'admin/sync-inventory'); // Correct filtering
        });
        
        // Add new cron job
        $output[] = $command;
        
        // Write to a temp file and update crontab
        $tmpFile = tempnam(sys_get_temp_dir(), 'cron');
        file_put_contents($tmpFile, implode(PHP_EOL, $output) . PHP_EOL);
        exec("crontab $tmpFile");
        unlink($tmpFile);
        
            
            $updateSuccessful = $model->updatesettingdata($datasitem);
            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin general setting update', ['reason' => 'General setting update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'General setting update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin general setting update', ['reason' => 'General setting updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'General setting updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin general setting update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function adminupdatesettingcleardatabase()
    {
        if ($this->session->has('isLoggedInadmin')) {
            $session = session();
            $model = new Admin_mdl();
            $admin_id = $session->get('adminId');
            $database_clear_username = $this->request->getVar('database_clear_username');
            $database_clear_password = $this->request->getVar('database_clear_password');


            if (!$database_clear_username || !$database_clear_password) {
                 logAction('admin', $admin_id,'failed', 'admin clear database(except admin) setting update', ['reason' => 'All fields must be filled in.']);
                return $this->response->setJSON(['status' => 'error', 'message' => 'All fields must be filled in.']);
            }
             $datasitem = array(
                'database_clear_username' => $database_clear_username,
                'database_clear_password' => $database_clear_password,

            );
            $updateSuccessful = $model->updatesettingdata($datasitem);
            if (!$updateSuccessful) {
               logAction('admin', $admin_id,'failed', 'admin clear database(except admin) setting update', ['reason' => 'Clear database(except admin) setting update failed.',$datasitem]);
                return $this->response->setJSON(['status' => 'error', 'message' => 'Clear database(except admin) setting update failed. Please try again.']);
            }
            logAction('admin', $admin_id,'success', 'admin clear database(except admin) setting update', ['reason' => 'Clear database(except admin) setting updated successfully.',$datasitem]);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Clear database(except admin) setting updated successfully.']);
        } else {
            logAction('admin', 0,'failed', 'admin clear database(except admin) setting update', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
     public function syncInventory()
    {
        
        if ($this->session->has('isLoggedInadmin')) {
            // Retrieve the Zoho inventory data (similar to what you already have in your code)
            $model = new Admin_mdl();
    
            $Zohoaccess = $model->getZohoAccess();
            
            // Extract Zoho access details
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
    
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
    
            if ($accessToken) {
                $records = zoho_get_records_inventory_seller($accessToken, $organization_id);
                $sellertypes = zoho_get_inventory_price_seller($accessToken, $organization_id);
    
                // Create a new model instance for syncing
                $inventoryModel = new ZohoInventoryModel();
            foreach ($records as $itemsdt) {
                // Initialize itemdata array for each item
                
                $itemsdtd = zoho_get_records_inventory_byid($accessToken, $organization_id, "", $itemsdt['item_id']);

                $warehouse_id = [];
                $warehouse_name = [];
                $warehouse_detail = [];
                
                $warehouse_detail = [];
                $total_stock = 0;

                if (!empty($itemsdtd['warehouses']) && is_array($itemsdtd['warehouses'])) {
                    foreach ($itemsdtd['warehouses'] as $warehouse) {
                        $warehouse_detail[$warehouse['warehouse_id']] = $warehouse['warehouse_available_stock'] ?? 0;
                        $warehouse_id[] = $warehouse['warehouse_id'] ?? '';
                        $warehouse_name[] = $warehouse['warehouse_name'] ?? '';
                        // Optionally sum stock from all warehouses
                        $total_stock += $warehouse['warehouse_available_stock'] ?? 0;
                    }
                }
                $itemdata = [
                    'item_id' => $itemsdt['item_id'],
                    'item_name' => $itemsdt['item_name'],
                    'unit' => $itemsdt['unit'],
                    'description' => $itemsdt['description'],
                    'rate' => $itemsdt['rate'],
                    'stocks' => $itemsdt['available_stock'] ?? 0,
                    'sku' => $itemsdt['sku'],
                    'warehouse_id' => json_encode($warehouse_id),
                    'warehouse_name' => json_encode($warehouse_name),
                    'warehouse_detail' => json_encode($warehouse_detail), // store as JSON string
                    'cf_sheet' => $itemsdt['cf_specificationsheet'] ?? null, // null, not string "null"
                    'stock' => $total_stock ?? 0,
                ];
            
            
                $pricerate=[];
                // Check if the item exists in sellertypes
                if (array_key_exists($itemsdt['item_id'], $sellertypes)) {
                    foreach ($sellertypes[$itemsdt['item_id']] as $key => $values) {
              
            
                        // Add the rate for each key dynamically
                        $pricerate[$key] = $values;
                    }
                } 
            
               $itemdata['rate_cate'] = json_encode($pricerate);
                // Insert or update the item into the database
                $inventoryModel->syncItem($itemdata);
            }
        
                session()->setFlashdata('message', 'Inventory synced successfully!');
            } else {
                session()->setFlashdata('message', 'Zoho authentication failed.');
            }
    
        return redirect()->to('/admin/inventory');
        } else {
            logAction('admin', 0,'failed', 'admin sync inventory', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
    public function syncInventorycli()
    {
        
        if (php_sapi_name() === 'cli' || stripos($this->request->getUserAgent(), 'curl') !== false) {
            // Retrieve the Zoho inventory data (similar to what you already have in your code)
            $model = new Admin_mdl();
    
            $Zohoaccess = $model->getZohoAccess();
            
            // Extract Zoho access details
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
                if ($zohodata['key_name'] == "zoho_refresh_token_book") {
                    $refreshToken = $zohodata['value'];
                }
                if ($zohodata['key_name'] == "zoho_organization_id") {
                    $organization_id = $zohodata['value'];
                }
            }
    
            $accessToken = zoho_authenticate($clientId, $clientSecret, $refreshToken);
    
            if ($accessToken) {
                $records = zoho_get_records_inventory_seller($accessToken, $organization_id);
                $sellertypes = zoho_get_inventory_price_seller($accessToken, $organization_id);
    
                // Create a new model instance for syncing
                $inventoryModel = new ZohoInventoryModel();
    
            foreach ($records as $itemsdt) {
                // Initialize itemdata array for each item
                $itemdata = [
                    'item_id' => $itemsdt['item_id'],
                    'item_name' => $itemsdt['item_name'],
                    'unit' => $itemsdt['unit'],
                    'description' => $itemsdt['description'],
                    'rate' => $itemsdt['rate'],
                    'stocks' => isset($itemsdt['available_stock']) ? $itemsdt['available_stock'] : 0,
                    'sku' => $itemsdt['sku'],
                    'cf_sheet' => isset($itemsdt['cf_specificationsheet']) ? $itemsdt['cf_specificationsheet'] : "null",
                ];
            
            
            
                $pricerate=[];
                // Check if the item exists in sellertypes
                if (array_key_exists($itemsdt['item_id'], $sellertypes)) {
                    foreach ($sellertypes[$itemsdt['item_id']] as $key => $values) {
              
            
                        // Add the rate for each key dynamically
                        $pricerate[$key] = $values;
                    }
                } 
            
               $itemdata['rate_cate'] = json_encode($pricerate);
            
                // Insert or update the item into the database
                $inventoryModel->syncItem($itemdata);
            }
        
                session()->setFlashdata('message', 'Inventory synced successfully!');
            } else {
                session()->setFlashdata('message', 'Zoho authentication failed.');
            }
    
        return redirect()->to('/admin/inventory');
        } else {
            logAction('admin', 0,'failed', 'admin sync inventory cli', ['reason' => 'Logged out due to inactivity.']);
            return $this->response->setJSON(['status' => 'logout', 'message' => 'Logged out due to inactivity.']);
        }
    }
    
}
