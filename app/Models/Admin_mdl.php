<?php namespace App\Models;

use CodeIgniter\Model;

class Admin_mdl extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    protected $allowedFields = ['admin_id', 'company_id', 'first_name', 'last_name', 'email', 'password', 'permissions', 'phone_number', 'description', 'status', 'created_at', 'updated_at', 'reset_token', 'reset_token_expiry', 'delete_status'];

    public function countStatus($status)
    {
        $session = session();
        $admin_id = $session->get('adminId');
        if ($status == "all") {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->get()
                ->getResultArray();
        } else {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->where('status', $status)
                ->groupBy('status') // Group by status
                ->get()
                ->getResultArray();
        }
    }

    public function getZohoAccess()
    {
        return $this->db->table('setting')
            ->get()
            ->getResultArray();
    }

    public function getDailyLogin()
    {
        $session = session();
        $seller_id = $session->get('sellerId');

        $subQuery = $this->db->table('customer')->select('COUNT(*)')->getCompiledSelect();
        // Main query
        $builder = $this->db->table('logs');
        $builder->select("ROUND((COUNT(DISTINCT by_user_id) / ($subQuery)) * 100, 2) AS daily_login_percentage");
        $builder->where('DATE(created_at)', date('Y-m-d'));
        $builder->where('by_user', 'customer');
        $query = $builder->get();
        $result = $query->getRow();
        if ($result) {
            return $dailyLoginPercentage = $result->daily_login_percentage;
        } else {
            return 0;
        }
    }

    public function getdaynumberonly()
    {
        $session = session();
        $seller_id = $session->get('sellerId');

        $builder = $this->db->table('logs');
        $builder->select("COUNT(DISTINCT by_user_id) AS daily_login_percentage");
        $builder->where('DATE(created_at)', date('Y-m-d'));
        $builder->where('by_user', 'customer');
        $query = $builder->get();
        $result = $query->getRow();
        if ($result) {
            return $dailyLoginPercentage = $result->daily_login_percentage;
        } else {
            return 0;
        }
    }

    public function getperdaydata()
    {
        $currentyear = date('Y');
        $sqlq = "SELECT
                MONTH(created_date) AS month,
                COUNT(by_user_id) AS customer_logins_per_month
            FROM (
                SELECT DISTINCT by_user_id, DATE(created_at) AS created_date
                FROM logs
                WHERE YEAR(created_at) = $currentyear AND `by_user` = 'customer'
            ) AS daily_logins
            GROUP BY MONTH(created_date)
            ORDER BY month ASC;";

        // Run the query
        $query = $this->db->query($sqlq);
        $result = $query->getResult();

        // Initialize an array to hold login counts for all 12 months
        $monthlyLogins = array_fill(1, 12, 0); // Fill all months (1 to 12) with 0 by default

        // Map query results to the corresponding month
        foreach ($result as $row) {
            $monthlyLogins[$row->month] = $row->customer_logins_per_month;
        }
        $data = [];
        // Output the results
        foreach ($monthlyLogins as $month => $logins) {
            $data[$month] = $logins;
        }
        return $data ? $data : 0;
    }

    public function getgraphdata()
    {

        $months = [
            ['month_number' => 1, 'month_name' => 'January'],
            ['month_number' => 2, 'month_name' => 'February'],
            ['month_number' => 3, 'month_name' => 'March'],
            ['month_number' => 4, 'month_name' => 'April'],
            ['month_number' => 5, 'month_name' => 'May'],
            ['month_number' => 6, 'month_name' => 'June'],
            ['month_number' => 7, 'month_name' => 'July'],
            ['month_number' => 8, 'month_name' => 'August'],
            ['month_number' => 9, 'month_name' => 'September'],
            ['month_number' => 10, 'month_name' => 'October'],
            ['month_number' => 11, 'month_name' => 'November'],
            ['month_number' => 12, 'month_name' => 'December'],
        ];
        $currentyear = date('Y');
        // Fetch quotation data grouped by month
        $builder = $this->db->table('quotation');
        $query = $builder->select("
                MONTH(created_at) AS month_number,
                COUNT(quotation_id) AS total_quotations,
                SUM(CASE WHEN status = 'accept' THEN 1 ELSE 0 END) AS approved_count
            ")
            ->where('YEAR(created_at)', $currentyear)
            ->groupBy('MONTH(created_at)')
            ->get();

        // Initialize results with all months set to 0
        $results = [];
        foreach ($months as $month) {
            $results[$month['month_number']] = [
                'month_name' => $month['month_name'],
                'total_quotations' => 0,
                'approved_count' => 0,
            ];
        }

        // Merge the data from the database query
        foreach ($query->getResultArray() as $row) {
            $results[$row['month_number']] = array_merge($results[$row['month_number']], $row);
        }

        return $results ? $results : 0;
    }

    public function gettodaycollection()
    {
        $totalPrice = $this->db->table('quotation')
            ->selectSum('grand_total', 'total_price') // Select the sum of grand_total and alias it as total_price
            ->where('created_at >=', date('Y-m-d 00:00:00')) // Filter for today
            ->where('created_at <', date('Y-m-d 23:59:59')) // Filter for today (until end of the day)
            ->where('status', 'accept')
            ->get()
            ->getRow(); // Get the result as an object
        // Access the total price
        return $totalPrice->total_price ? $totalPrice->total_price : 0;
    }

    public function getweekbycollection()
    {
        $query = $this->db->query("
             SELECT
                day_names.day_of_week,
                COALESCE(SUM(quotation.grand_total), 0) AS total_collection
            FROM
                (SELECT 'Sun' AS day_of_week UNION
                 SELECT 'Mon' UNION
                 SELECT 'Tue' UNION
                 SELECT 'Wed' UNION
                 SELECT 'Thu' UNION
                 SELECT 'Fri' UNION
                 SELECT 'Sat') AS day_names
            LEFT JOIN quotation
                ON CASE
                        WHEN DAYOFWEEK(quotation.created_at) = 1 THEN 'Sun'
                        WHEN DAYOFWEEK(quotation.created_at) = 2 THEN 'Mon'
                        WHEN DAYOFWEEK(quotation.created_at) = 3 THEN 'Tue'
                        WHEN DAYOFWEEK(quotation.created_at) = 4 THEN 'Wed'
                        WHEN DAYOFWEEK(quotation.created_at) = 5 THEN 'Thu'
                        WHEN DAYOFWEEK(quotation.created_at) = 6 THEN 'Fri'
                        WHEN DAYOFWEEK(quotation.created_at) = 7 THEN 'Sat'
                    END = day_names.day_of_week
                    AND quotation.status = 'accept'
                    AND WEEK(quotation.created_at, 1) = WEEK(CURDATE(), 1)
            GROUP BY day_names.day_of_week
            ORDER BY FIELD(day_names.day_of_week, 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
        ");

        // Fetch the results
        $results = $query->getResult();

        $resultdata = [];
        // Output the results
        foreach ($results as $row) {

            $resultdata[] = [
                'weekname' => $row->day_of_week,
                'totalprice' => $row->total_collection,
            ];
        }
        return $resultdata ? $resultdata : 0;
    }


    public function getadminidquotation($id)
    {

        $data = array();
        $data['mainquot'] = $this->db->table('quotation')
            ->where('quotation_id', $id)
            ->get()
            ->getResultArray();

        $data['customer'] = $this->db->table('customer')
            ->where('customer_id', $data['mainquot'][0]['customer_id'])
            ->get()
            ->getResultArray();

        $data['seller'] = $this->db->table('sales_person')
            ->where('sales_person_id', $data['mainquot'][0]['sales_person_id'])
            ->get()
            ->getResultArray();

        $data['quotitem'] = $this->db->table('quotation_item')
            ->where('quotation_id', $id)
            ->get()
            ->getResultArray();

        return $data;
    }

    public function updatestatus($data)
    {
        return $this->db->table('quotation')
            ->where('quotation_id', $data['quotation_id']) // Filter by the quotation ID
            ->update(['status' => $data['status'],'comment' => $data['comment']]); // Update the status
    }

    public function update_quotation_number($data)
    {
        return $this->db->table('quotation')
            ->where('quotation_id', $data['quotation_id'])
            ->update(['quotation_number' => $data['quotation_number']]);
    }

    public function getallcustomer()
    {
        return $this->db->table('customer')
            ->get()
            ->getResultArray();
    }

    public function getcustomerbyid($customerId)
    {
        return $this->db->table('customer')
            ->where('customer_id', $customerId)
            ->get()
            ->getResultArray();

    }

    public function getsellerbyid($sellerid)
    {
        return $this->db->table('sales_person')
            ->where('sales_person_id', $sellerid)
            ->get()
            ->getResultArray();

    }

    public function getuserbyid($adminid)
    {
        return $this->db->table('admin')
            ->where('admin_id', $adminid)
            ->get()
            ->getResultArray();

    }

    public function gettotalcollection()
    {
        $totalPrice = $this->db->table('quotation')
            ->selectSum('grand_total', 'total_price') // Select the sum of grand_total and alias it as total_price
            ->get()
            ->getRow(); // Get the result as an object
        // Access the total price
        return $totalPrice->total_price ? $totalPrice->total_price : 0;
    }

    public function gettotalaceptcollection()
    {
        $totalPrice = $this->db->table('quotation')
            ->selectSum('grand_total', 'total_price') // Select the sum of grand_total and alias it as total_price
            ->where('status', 'accept')
            ->get()
            ->getRow(); // Get the result as an object
        // Access the total price
        return $totalPrice->total_price ? $totalPrice->total_price : 0;
    }

    public function getCustomerCategories($customer_category_id)
    {
        // Example: Assuming the 'customer_category' table is related by user_id
        return $this->db->table('customer_category')
            ->where('customer_category_id', $customer_category_id)
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }

    public function deleteQuotationadmin($qid)
    {
        $this->db->table('quotation_item')
            ->where('quotation_id', $qid)
            ->delete();

        return $this->db->table('quotation')
            ->where('quotation_id', $qid)
            ->delete();
    }

    public function checkquotationbycust($cid)
    {
        $quotationExists = $this->db->table('quotation')
            ->where('customer_id', $cid)
            ->countAllResults(); // Get the count of rows matching the condition
        if ($quotationExists > 0) {
            // Quotation exists, so do not delete the user
            return 'false'; // Or handle this scenario as needed (e.g., return an error message)
        }

    }

    public function checkcustomercate($cid)
    {
        $quotationExists = $this->db->table('customer')
            ->where('customer_category_id', $cid)
            ->countAllResults();
        if ($quotationExists > 0) {
            return 'false';
        }

    }

    public function checkcustomer($sid)
    {
        $quotationExists = $this->db->table('customer')
            ->where('sales_person_id', $sid)
            ->countAllResults();
        if ($quotationExists > 0) {
            return 'false';
        }

    }

    public function checksellerbyadmin($aid)
    {
        $quotationExists = $this->db->table('sales_person')
            ->where('created_by_userid', $aid)
            ->countAllResults();
        if ($quotationExists > 0) {
            return 'false';
        }

    }

    public function checkcustomerbyadmin($aid)
    {
        $quotationExists = $this->db->table('customer')
            ->where('created_by_user', 'admin')
            ->where('created_by_userid', $aid)
            ->countAllResults();
        if ($quotationExists > 0) {
            return 'false';
        }

    }

    public function deleteCustomeradmin($cid)
    {

        // Proceed to delete the customer if no quotation is found
        $deleted = $this->db->table('customer')
            ->where('customer_id', $cid)
            ->delete();

        return $deleted;

    }

    public function deleteselleradmin($sid)
    {
        $session = session();
        $admin_id = $session->get('adminId');

        return $this->db->table('sales_person')
            ->where('sales_person_id', $sid) // Filter by the quotation ID
            ->update(['delete_by_userid' => $admin_id, 'delete_status' => '1', 'delete_datetime' => date('Y-m-d H:i:s')]); // Update the status

    }

    public function deleteuseradmin($sid)
    {

        $session = session();
        $admin_id = $session->get('adminId');
        return $this->db->table('admin')
            ->where('admin_id', $sid) // Filter by the quotation ID
            ->update(['delete_by_userid' => $admin_id, 'delete_status' => '1', 'delete_datetime' => date('Y-m-d H:i:s')]); // Update the status
    }

    public function deleteCategoriesadmin($cid)
    {
        return $this->db->table('customer_category')
            ->where('customer_category_id', $cid)
            ->delete();

    }

    public function insertquotation($data)
    {
        $Settings_mdl = new Settings_mdl();

        $this->db->table('quotation')->insert($data);
        $quotation_id = $this->db->insertID();

        // START-Generate a quotation number
        $quot_prefix = $Settings_mdl->get_setting_value('quot_prefix');
        $quote_number_length = $Settings_mdl->get_setting_value('quote_number_length');
        $no = sprintf("%0" . $quote_number_length . "d", $quotation_id);
        $quotation_number = $quot_prefix . $no;
        $update_data = [
            'quotation_id' => $quotation_id,
            'quotation_number' => $quotation_number,
        ];
        $this->update_quotation_number($update_data);
        // END-Generate a quotation number

        return $quotation_id;
    }

    public function insertquotatioitem($data)
    {
        $this->db->table('quotation_item')->insert($data);
        return $this->db->insertID();
    }

    public function checkemailduplication($email)
    {
        return $this->db->table('customer')
            ->where('email', $email)
            ->get()
            ->getRow();
    }

    public function checkemailduplicationseller($email)
    {
        return $this->db->table('sales_person')
            ->where('email', $email)
            ->where('delete_status !=', '1')
            ->get()
            ->getRow();
    }
  public function checkemailduplicationmanager($email)
    {
        return $this->db->table('company_manager')
            ->where('email', $email)
            ->get()
            ->getRow();
    }
    public function checkemailduplicationuser($email)
    {
        return $this->db->table('company')
            ->where('email', $email)
            ->get()
            ->getRow();
    }

    public function checkcateduplication($catename)
    {
        return $this->db->table('customer_category')
            ->where('pricebook_id', $catename)
            ->get()
            ->getRow();
    }

    public function checkemailduplicationbyid($data)
    {
        return $this->db->table('customer')
            ->where('email', $data['email'])
            ->where('customer_id !=', $data['customerid'])
            ->get()
            ->getRow();
    }

    public function checkemailduplicationbyseller($data)
    {
        return $this->db->table('sales_person')
            ->where('email', $data['email'])
            ->where('delete_status !=', '1')
            ->where('sales_person_id  !=', $data['sales_person_id'])
            ->get()
            ->getRow();
    }

    public function checkemailduplicationbyUser($data)
    {
        return $this->db->table('admin')
            ->where('email', $data['email'])
            ->where('delete_status !=', '1')
            ->where('admin_id  !=', $data['admin_id'])
            ->get()
            ->getRow();
    }

    public function checkcateduplicationbyid($data)
    {
        return $this->db->table('customer_category')
            ->where('category_name', $data['category_name'])
            ->where('customer_category_id !=', $data['customer_category_id'])
            ->get()
            ->getRow();
    }

    public function getcustomerallwithcate($seller_id)
    {

        return $this->db->table('customer')
            ->join('customer_category', 'customer.customer_category_id = customer_category.customer_category_id') // Adjust column names as needed
            ->where('customer.sales_person_id', $seller_id)
            ->where('customer.status', 1)
            ->where('customer_category.status', 1)
            ->get()
            ->getResultArray();
    }


    public function getcustomerwithcatebyid($data)
    {

        return $this->db->table('customer')
            ->join('customer_category', 'customer.customer_category_id = customer_category.customer_category_id') // Adjust column names as needed
            ->where('customer.customer_id', $data)
            ->where('customer.status', 1)
            ->where('customer_category.status', 1)
            ->get()
            ->getResultArray();
    }

    public function insertcustomerdata($data)
    {
        $this->db->table('customer')->insert($data);
        return $this->db->insertID();
    }

    public function insertpersondata($data)
    {
        $this->db->table('sales_person')->insert($data);
        return $this->db->insertID();
    }

    public function insertuserdata($data)
    {
        $this->db->table('admin')->insert($data);
        return $this->db->insertID();
    }
    public function insertcomapanydata($data)
    {
        $this->db->table('company')->insert($data);
        return $this->db->insertID();
    }
    public function insertcomanymanagerdata($data)
    {
        $this->db->table('company_manager')->insert($data);
        return $this->db->insertID();
    }

    public function insertcategoriesdata($data)
    {
        $this->db->table('customer_category')->insert($data);
        return $this->db->insertID();
    }

    public function updatecategoriesdata($data)
    {
        return $this->db->table('customer_category')
            ->where('customer_category_id ', $data['modalValue']) // Filter by the quotation ID
            ->update(['category_name' => $data['category_name'], 'status' => $data['status'], 'desc' => $data['desc']]);

    }

    public function updatecustomerdata($data)
    {
        return $this->db->table('customer')
            ->where('customer_id', $data['customerid']) // Filter by the quotation ID
            ->update(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'sales_person_id' => $data['sales_person_id'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'description' => $data['description'], 'status' => $data['status'], 'customer_category_id' => $data['customer_category_id'], 'billing_address' => $data['billing_address'], 'billing_city' => $data['billing_city'], 'billing_state' => $data['billing_state'], 'billing_pincode' => $data['billing_pincode'], 'billing_phone_number' => $data['billing_phone_number'], 'shipping_address' => $data['shipping_address'], 'shipping_city' => $data['shipping_city'], 'shipping_state' => $data['shipping_state'], 'shipping_pincode' => $data['shipping_pincode'], 'shipping_phone_number' => $data['shipping_phone_number'], 'created_by_user' => $data['created_by_user'], 'created_by_userid' => $data['created_by_userid']]); // Update the status
    }

    public function updatepersondata($data)
    {
        return $this->db->table('sales_person')
            ->where('sales_person_id', $data['sales_person_id']) // Filter by the quotation ID
            ->update(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'description' => $data['description'], 'status' => $data['status']]); // Update the status
    }

    public function updateuserdata($data)
    {
        return $this->db->table('admin')
            ->where('admin_id', $data['admin_id']) // Filter by the quotation ID
            ->update(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'description' => $data['description'], 'status' => $data['status']]); // Update the status
    }

    public function updatepassword($data)
    {
        return $this->db->table('customer')
            ->where('customer_id', $data['customer_id']) // Filter by the quotation ID
            ->update(['password' => $data['password']]); // Update the status
    }

    public function updatepasswordperson($data)
    {
        return $this->db->table('sales_person')
            ->where('sales_person_id', $data['sales_person_id']) // Filter by the quotation ID
            ->update(['password' => $data['password']]); // Update the status
    }

    public function updatepassworduser($data)
    {
        return $this->db->table('admin')
            ->where('admin_id', $data['admin_id']) // Filter by the quotation ID
            ->update(['password' => $data['password']]); // Update the status
    }

    public function getcustomertotal()
    {
        return $this->db->table('customer')
            ->select("COUNT(*) as count")
            ->get()
            ->getResultArray();
    }

    public function getallcompanhy()
    {
        return $this->db->table('company')
            ->get()
            ->getResultArray();
    }
     public function getallcompanhybyid($ids)
    {
        return $this->db->table('company c')
        ->select('
            c.company_id,
            c.company_name,
            c.email,
            c.address,
            c.created_at,
            r.cvr AS cvr
        ')
        ->join('reportdata r', 'r.email = c.email', 'left') // left join to keep companies without CVR
        ->orderBy('c.created_at', 'DESC')
        ->where('company_id', $ids)
         ->where('r.cvr IS NOT NULL')
        ->where('r.cvr !=', '')
        ->get()
        ->getResultArray();
    }
    public function getallcompanhywithcvr()
    {
        
    return $this->db->table('company c')
        ->select('
            c.company_id,
            c.company_name,
            c.email,
            c.address,
            c.created_at,
             r.email,
            r.cvr AS cvr
        ')
        ->join('reportdata r', 'r.email = c.email', 'left') // left join to keep companies without CVR
        ->where('r.cvr IS NOT NULL')
        ->where('r.cvr !=', '')
        ->groupBy('r.email') // avoid duplicate emails
        ->orderBy('c.created_at', 'DESC')
        ->get()
           ->getResultArray();
    }


    public function getsellertotal()
    {
        return $this->db->table('sales_person')
            ->select("COUNT(*) as count")
            ->where('delete_status !=', '1')
            ->get()
            ->getResultArray();
    }

    public function getusertotal()
    {
        return $this->db->table('admin')
            ->select("COUNT(*) as count")
            ->where('delete_status !=', '1')
            ->get()
            ->getResultArray();
    }

    public function getallseller()
    {

        return $this->db->table('sales_person')
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }

    public function getallsellerwithdel()
    {

        return $this->db->table('sales_person')
            ->where('status', 1)
            ->where('delete_status', '0')
            ->get()
            ->getResultArray();
    }

    public function getsellerbyidwithdel($sellerid)
    {
        return $this->db->table('sales_person')
            ->where('sales_person_id', $sellerid)
            ->where('status', 1)
            ->where('delete_status', '0')
            ->get()
            ->getResultArray();

    }
    
    public function getuserbyidwithdel($ids)
    {
        return $this->db->table('admin')
            ->where('admin_id', $ids)
            ->where('status', 1)
            ->where('delete_status', '0')
            ->get()
            ->getResultArray();

    }

    public function getalluserlist()
    {

        return $this->db->table('admin')
            ->get()
            ->getResultArray();
    }

    public function getcustomercate()
    {

        return $this->db->table('customer_category')
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }
    public function updatesettingdata($data)
    {
        
        $builder = $this->db->table('setting');
    
        foreach ($data as $key => $value) {
            $exists = $builder->where('key_name', $key)->countAllResults();
    
            if ($exists) {
                // Update existing key
                $builder->where('key_name', $key)->update(['value' => $value]);
            } else {
                // Insert new key-value pair
                $builder->insert(['key_name' => $key, 'value' => $value]);
            }
        }

         return true;

    }
    
}
