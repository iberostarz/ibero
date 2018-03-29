<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Telnet\TelnetClient;
use Psr\Http\Message\{
    ServerRequestInterface as Request,
    ResponseInterface as Response
};

use Exception;

class BeachController extends Controller
{
    
    protected $telnetClient;
    protected $c;

    public function __construct($c)
    {
        $this->telnetClient = new TelnetClient;
        $this->c = $c;
    }
    
    public function index(Request $request, Response $response, $args)
    {
        return $this->c->view->render($response, 'ap/beach/index.twig', [
            'appName' => $this->c->settings['app']['name'],
        ]);
    }

    public function reboot(Request $request, Response $response)
    {
        
       $ip =  $request->getParam('ip');
       //$client = new TelnetClient;
      
       if( @$this->telnetClient->ping($ip)){
           try {
            $this->telnetClient = new TelnetClient($ip);   
            $this->telnetClient->connect($ip);
            $this->telnetClient->login($username='admin', $password='1ber0w1f1');
            return $response->withJson(['message' => 'Rebooting room', 'ip' => $ip]);
           }catch(Exception $e){
            return $response->withJson(['message' => $e->getMessage(), 'ip' => $ip]);
           }
        
       }else {
        return $response->withJson(['message' => 'not online', 'ip' => $ip]);
       }

    }

    public function pingAp(Request $request, Response $response )
    {   
        $telnetClient = new TelnetClient;
        $ip =  $request->getParam('ip');
        $result = $telnetClient->ping($ip, 23, 10);

        if ($result) {
         return $response->withJson(['message' => '1']);
        }else{
         return $response->withJson(['message' => '0']);
        }
       
    }
}