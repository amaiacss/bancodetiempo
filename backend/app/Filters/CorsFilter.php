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
       // echo '<pre>'; print_r( $_SERVER ); exit();
       // header('Access-Control-Allow-Origin: *');
      //  header("Access-Control-Allow-Methods: GET, POST, PATCH, OPTIONS, PUT, DELETE");
    //    header("Access-Control-Allow-Headers: *");
        // if(array_key_exists('HTTP_ORIGIN', $_SERVER)) {
        //     $origin = $_SERVER['HTTP_ORIGIN'];
        // } else if(array_key_exists('HTTP_REFERER', $_SERVER)) {
        //     $origin = $_SERVER['HTTP_REFERER'];
        // } else if(array_key_exists('HTTP_HOST', $_SERVER)) {
        //     $origin = $_SERVER['HTTP_HOST'];
        // } else {
        //     $origin = $_SERVER['REMOTE_ADDR'];
        // }

        // $allowed_domains = array(
        //     'http://localhost:4200'
        //     // TODO: añadir la url del servidor 
        // );

        // if(in_array($origin, $allowed_domains)) {
        //     header('Access-Control-Allow-Origin: ' . $origin);
        // }

        // header("Access-Control-Allow-Headers: Origin, X-API-KEY, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Headers, Authorization, observe, enctype, Content-Length, X-Csrf-Token");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, PATCH");
        // header("Access-Control-Max-Age: 3600");
        // header("content-type: application/json; charset=utf-8");
        // $method = $_SERVER['REQUEST_METHOD'];
        // if ($method == "OPTIONS") {
        //     header("HTTP/1.1 200 OK CORS");
        //     die();
        // }  
        

        // Allow from any origin
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
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