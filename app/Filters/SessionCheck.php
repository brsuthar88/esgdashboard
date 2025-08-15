<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();

        if (!$session->has('isLoggedIn')) {
            $session->set('isLoggedIn', true);
        }

        // Perform any checks with $session->get('your_variable') if needed
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // This is optional if you need to do something after the request
    }
}



?>