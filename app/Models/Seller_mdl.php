<?php namespace App\Models;

use CodeIgniter\Model;

class Seller_mdl extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 's_id';
    protected $allowedFields = ['s_id', 'email', 'password', 'cvr', 'company_id', 'personalMessage', 'created_at', 'updated_at', 'status'];

    public function countStatus($status)
    {
        $session = session();
        $seller_id = $session->get('sellerId');
        if ($status == "all") {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->where('sales_person_id', $seller_id)
                ->get()
                ->getResultArray();
        } else {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->where('status', $status)
                ->where('sales_person_id', $seller_id)
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
        $subQuery = $this->db->table('customer')
            ->select('COUNT(*)')
            ->where('sales_person_id', $seller_id)
            ->getCompiledSelect();
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
        $builder->select("COUNT(DISTINCT logs.by_user_id) AS daily_login_percentage");
        $builder->join('customer', 'logs.by_user_id = customer.customer_id'); // Join the customer table
        $builder->where('DATE(logs.created_at)', date('Y-m-d'));
        $builder->where('logs.by_user', 'customer');
        $builder->where('customer.sales_person_id', $seller_id); // Optional: Filter for a specific customer if needed
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
        $session = session();
        $seller_id = $session->get('sellerId');
        $currentyear = date('Y');
        $sqlq = "SELECT
                MONTH(l.created_at) AS month,
                COUNT(l.by_user_id) AS customer_logins_per_month
            FROM (
                SELECT DISTINCT by_user_id,created_at, DATE(created_at) AS created_date
                FROM logs
                WHERE YEAR(created_at) = $currentyear AND `by_user` = 'customer'
            )  AS l
            JOIN customer c ON l.by_user_id = c.customer_id
            WHERE c.sales_person_id = $seller_id
            GROUP BY MONTH(l.created_at)
            ORDER BY month ASC";

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

        $session = session();
        $seller_id = $session->get('sellerId');

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
            ->where('sales_person_id', $seller_id)
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

        $session = session();
        $seller_id = $session->get('sellerId');

        $totalPrice = $this->db->table('quotation')
            ->selectSum('grand_total', 'total_price') // Select the sum of grand_total and alias it as total_price
            ->where('created_at >=', date('Y-m-d 00:00:00')) // Filter for today
            ->where('created_at <', date('Y-m-d 23:59:59')) // Filter for today (until end of the day)
            ->where('status', 'accept')
            ->where('sales_person_id', $seller_id)
            ->get()
            ->getRow();

        return $totalPrice->total_price ? $totalPrice->total_price : 0;
    }

    public function getweekbycollection()
    {
        $session = session();
        $seller_id = $session->get('sellerId');
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
                    AND quotation.sales_person_id = $seller_id
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

    public function getSelleridquotation($id)
    {

        $data = array();
        $data['mainquot'] = $this->db->table('quotation')
            ->where('quotation_id', $id['id'])
            ->where('sales_person_id', $id['seller_id'])
            ->get()
            ->getResultArray();

        $data['customer'] = $this->db->table('customer')
            ->where('customer_id', $data['mainquot'][0]['customer_id'])
            ->where('sales_person_id', $id['seller_id'])
            ->get()
            ->getResultArray();

        $data['quotitem'] = $this->db->table('quotation_item')
            ->where('quotation_id', $id['id'])
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

    public function getallcustomer($seller_id)
    {
        return $this->db->table('customer')
            ->where('sales_person_id', $seller_id)
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

    public function getCustomerCategories($customer_category_id)
    {
        // Example: Assuming the 'customer_category' table is related by user_id
        return $this->db->table('customer_category')
            ->where('customer_category_id', $customer_category_id)
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }
    
    public function getdatafromreporttable($formats,$email)
    {
        if (empty($formats)) {
        return [];
    }

    return $this->db->table('reportdata')
        ->select(implode(',', $formats))
        ->limit(1)
         ->where('email', $email)
        ->get()
        ->getResultArray();
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

    public function update_quotation_number($data)
    {
        return $this->db->table('quotation')
            ->where('quotation_id', $data['quotation_id'])
            ->update(['quotation_number' => $data['quotation_number']]);
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

    public function checkemailduplicationbyid($data)
    {
        return $this->db->table('customer')
            ->where('email', $data['email'])
            ->where('customer_id !=', $data['customerid'])
            ->get()
            ->getRow();
    }

    public function getcustomerwithcatebyid($data)
    {

        return $this->db->table('customer')
            ->join('customer_category', 'customer.customer_category_id = customer_category.customer_category_id') // Adjust column names as needed
            ->where('customer.sales_person_id', $data['sales_id'])
            ->where('customer.customer_id', $data['customer_id'])
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

    public function updatecustomerdata($data)
    {
        return $this->db->table('customer')
            ->where('customer_id', $data['customerid']) // Filter by the quotation ID
            ->where('sales_person_id', $data['sales_person_id']) // Filter by the quotation ID
            ->update(['first_name' => $data['first_name'], 'last_name' => $data['last_name'], 'email' => $data['email'], 'phone_number' => $data['phone_number'], 'description' => $data['description'], 'status' => $data['status'], 'customer_category_id' => $data['customer_category_id'], 'billing_address' => $data['billing_address'], 'billing_city' => $data['billing_city'], 'billing_state' => $data['billing_state'], 'billing_pincode' => $data['billing_pincode'], 'billing_phone_number' => $data['billing_phone_number'], 'shipping_address' => $data['shipping_address'], 'shipping_city' => $data['shipping_city'], 'shipping_state' => $data['shipping_state'], 'shipping_pincode' => $data['shipping_pincode'], 'shipping_phone_number' => $data['shipping_phone_number'], 'created_by_user' => $data['created_by_user'], 'created_by_userid' => $data['created_by_userid']]); // Update the status
    }

    public function updatepassword($data)
    {
        return $this->db->table('customer')
            ->where('customer_id', $data['customer_id']) // Filter by the quotation ID
            ->where('sales_person_id', $data['sales_id']) // Filter by the quotation ID
            ->update(['password' => $data['password']]); // Update the status
    }

    public function getcustomercate()
    {

        return $this->db->table('customer_category')
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }
}
