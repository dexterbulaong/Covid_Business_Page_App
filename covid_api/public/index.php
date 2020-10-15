<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../includes/DbOperations.php';


$app = AppFactory::create();
/*added*/
$app->setBasePath("/covid_api/public");
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware(true,true,true);

/* 
    endpoint: createuser
    parameters: user_email, user_password, first_name, last_name
    method: POST
*/
$app->post('/createuser', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('user_email', 'user_password', 'first_name', 'last_name'), $response)) {
        $request_data = $request->getParsedBody();

        $user_email = $request_data['user_email'];
        $user_password = $request_data['user_password'];
        $first_name = $request_data['first_name'];
        $last_name = $request_data['last_name'];

        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);


        $db - new DbOperations;

        $result = $db->createUser($user_email, $hash_password, $first_name, $last_name);

        if($result == USER_CREATED) {
            $message = array();
            $message['error'] = false;
            $message['message'] = 'User created successfully';
            /*added to line*/
            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(201);
        }
        else if($result == USER_FAILURE) {
            $message = array();
            $message['error'] = true;
            $message['message'] = 'Some error occurred';
            /*added to line*/
            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);
        }
        else if($result == USER_EXISTS) {
            $message = arrray();
            $message['error'] = true;
            $message['message'] = 'User already exists';
            /*added to line*/
            $response->getBody()->write(json_encode($message));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);
        }

    }
});

function haveEmptyParameters($required_params, $response) {
    $error = false;
    $error_params = '';
    $request_params = $_REQUEST;

    foreach($required_params as $param) {
        if(!isset($request_params[$param]) || strlen($request_params[$param]) <= 0) {
            $error = true;
            $error_params .= $param . ', ';
        }
    }
    if ($error) {
        $error_detail = array();
        $error_detail['error'] = true;
        $error_detail['message'] = 'Required parameters ' . substr($error_params, 0, -2) . 'are missing or empty';
        /*added to line*/
        $response->getBody()->write(json_encode($error_detail));
    }
    return $error;
}

$app->run();

?>