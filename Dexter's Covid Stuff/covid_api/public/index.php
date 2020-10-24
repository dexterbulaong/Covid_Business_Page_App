<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../includes/DbOperations.php';


$app = AppFactory::create();
$app->addBodyParsingMiddleware();
/*added*/
$app->setBasePath("/covid_api/public");
$app->addErrorMiddleware(true,true,true);

/* 
    endpoint: createuser
    parameters: user_email, user_password, business_name
    method: POST
*/
$app->post('/createuser', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('user_email', 'user_password', 'business_name'), $request, $response)) {
        $request_data = $request->getParsedBody();

        $user_email = $request_data['user_email'];
        $user_password = $request_data['user_password'];
        $business_name = $request_data['business_name'];

        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);


        $db = new DbOperations;

        $result = $db->createUser($user_email, $hash_password, $business_name);

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
            $message = array();
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

$app->post('/userlogin', function(Request $request, Response $response){
    if(!haveEmptyParameters(array('user_email', 'user_password'), $request, $response)){
        $request_data = $request->getParsedBody();
        $user_email = $request_data['user_email'];
        $user_password = $request_data['user_password'];

        $db = new DbOperations;

        $result = $db->userLogin($user_email, $user_password);

        if($result == USER_AUTHENTICATED) {

            $user = $db->getUserByEmail($user_email);
            $response_data = array();

            $response_data['error'] = false;
            $response_data['message'] = 'Login Successful';
            $response_data['user'] = $user;

            $response->getBody()->write(json_encode($response_data));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);

        }
        else if($result == USER_NOT_FOUND) {
            $response_data = array();

            $response_data['error'] = true;
            $response_data['message'] = 'User not found';

            $response->getBody()->write(json_encode($response_data));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
        }
        else if($result == USER_PASSWORD_DOES_NOT_MATCH) {
            $response_data = array();

            $response_data['error'] = true;
            $response_data['message'] = 'Invalid password';

            $response->getBody()->write(json_encode($response_data));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
        }


    }

    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(422);

});

$app->get('/allusers', function(Request $request, Response $response) {
    $db = new DbOperations;

    $users = $db->getAllUsers();

    $response_data = array();

    $response_data['error'] = false;
    $response_data['users'] = $users;

    $response->getBody()->write(json_encode($response_data));

    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
    
});

/* not working needs to be looked at */
$app->put('/updateuser/{business_id}', function(Request $request, Response $response, array $args) {
    $business_id = $args['business_id'];
    if(!haveEmptyParameters(array('user_email', 'business_name'), $request, $response)) {
        $request_data = $request->getParsedBody();

        $user_email = $request_data['user_email'];
        $business_name = $request_data['business_name'];
        
        $db = new DbOperations;

        if($db->updateUser($user_email, $business_name, $business_id)) {
            $response_data = array();
            $response_data['error'] = false;
            $response_data['message'] = 'User Update Successful';
            $user = $db->getUserByEmail($user_email);
            $response_data['user'] = $user;

            $response->getBody()->write(json_encode($response_data));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
        }
        else {
            $response_data = array();
            $response_data['error'] = true;
            $response_data['message'] = 'Please try again later';
            $user = $db->getUserByEmail($user_email);
            $response_data['user'] = $user;

            $response->getBody()->write(json_encode($response_data));

            return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);
        }
        
    }
    return $response
                        ->withHeader('Content-type', 'application/json')
                        ->withStatus(200);

});

$app->put('/updatepassword', function(Request $request, Response $response){

    if(!haveEmptyParameters(array('currentpassword', 'newpassword', 'user_email'), $request, $response)){
        
        $request_data = $request->getParsedBody(); 

        $currentpassword = $request_data['currentpassword'];
        $newpassword = $request_data['newpassword'];
        $user_email = $request_data['user_email']; 

        $db = new DbOperations; 

        $result = $db->updatePassword($currentpassword, $newpassword, $user_email);

        if($result == PASSWORD_CHANGED){
            $response_data = array(); 
            $response_data['error'] = false;
            $response_data['message'] = 'Password Changed';
            $response->getBody()->write(json_encode($response_data));

            return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);

        }else if($result == PASSWORD_DOES_NOT_MATCH){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'You have given the wrong password';
            $response->getBody()->write(json_encode($response_data));

            return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }else if($result == PASSWORD_NOT_CHANGED){
            $response_data = array(); 
            $response_data['error'] = true;
            $response_data['message'] = 'Some error occurred';
            $response->getBody()->write(json_encode($response_data));

            return $response
                            ->withHeader('Content-type', 'application/json')
                            ->withStatus(200);
        }
    }

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(422);  
});
# delete operation
$app->delete('/deleteuser/{business_id}', function(Request $request, Response $response, array $args){
    $business_id = $args['business_id'];
    $db = new DbOperations;

    $response_data = array();

    if($db->deleteUser($business_id)) {
        $response_data['error'] = false;
        $response_data['message'] = 'User has been deleted';
    }
    else {
        $response_data['error'] = true;
        $response_data['message'] = 'Please try again later';
    }

    $response->getBody()->write(json_encode($response_data));

    return $response
        ->withHeader('Content-type', 'application/json')
        ->withStatus(200);
});

function haveEmptyParameters($required_params, $request, $response) {
    $error = false;
    $error_params = '';
    $request_params = $request->getParsedBody();

    foreach($required_params as $param) {
        if(!isset($request_params[$param]) || strlen($request_params[$param]) <= 0) {
            $error = true;
            $error_params .= $param . ', ';
        }
    }
    if ($error) {
        $error_detail = array();
        $error_detail['error'] = true;
        $error_detail['message'] = 'Required parameters ' . substr($error_params, 0, -2) . ' are missing or empty';
        /*added to line*/
        $response->getBody()->write(json_encode($error_detail));
    }
    return $error;
}

$app->run();

?>