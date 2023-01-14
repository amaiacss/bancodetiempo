<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\config\Services;

class CorsFilter implements FilterInterface {

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {
        
    }

    public function before(RequestInterface $request, $arguments = null) {       

        if(array_key_exists('HTTP_ORIGIN', $_SERVER)) {
            $origin = $_SERVER['HTTP_ORIGIN'];
        } else if(array_key_exists('HTTP_REFERER', $_SERVER)) {
            $origin = $_SERVER['HTTP_REFERER'];
        } else if(array_key_exists('HTTP_HOST', $_SERVER)) {
            $origin = $_SERVER['HTTP_HOST'];
        } else {
            $origin = $_SERVER['REMOTE_ADDR'];
        }

        $allowed_domains = array(
            'https://bt-app-eus.web.app',
            'http://localhost:4200'
        );

        if(in_array($origin, $allowed_domains)) {
            header('Access-Control-Allow-Origin: ' . $origin);

            header("Access-Control-Allow-Headers: Origin, X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers, Authorization, observe, enctype, Content-Length, X-Csrf-Token");
            header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, PATCH, OPTIONS");
            header("Access-Control-Max-Age: 3600");
            header('content-type: application/json; charset=utf-8');
        } else {
            die('no permission');
        }
        
        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                    header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

    }    
}