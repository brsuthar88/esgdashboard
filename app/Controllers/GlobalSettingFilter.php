<?php
// app/Filters/GlobalSettingFilter.php

namespace App\Filters;

use App\Models\Settings_mdl;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GlobalSettingFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $settingsModel = new Settings_mdl();
        $GLOBALS['prefix'] = $settingsModel->getGlobalPrefix();
        $GLOBALS['currencysymbol'] = $settingsModel->getGlobalCurrencysymbol();
        $GLOBALS['defaulttimezone'] = $settingsModel->getGlobaldefaulttimezone();
        $GLOBALS['defaultdateformat'] = $settingsModel->getGlobaldefaultdateformat();
    }
    

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after
    }
}
