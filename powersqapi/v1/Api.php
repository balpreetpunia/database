<?php

//getting the dboperation class
require_once '../includes/DbOperation.php';

//function validating all the paramters are available
//we will pass the required parameters to this function
/*function isTheseParametersAvailable($params){
    //assuming all parameters are available
    $available = true;
    $missingparams = "";

    foreach($params as $param){
        if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
            $available = false;
            $missingparams = $missingparams . ", " . $param;
        }
    }

    //if parameters are missing
    if(!$available){
        $response = array();
        $response['error'] = true;
        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';

        //displaying error
        echo json_encode($response);

        //stopping further execution
        die();
    }
}*/

//an array to display response
$response = array();

//if it is an api call
//that means a get parameter named api call is set in the URL
//and with this parameter we are concluding that it is an api call
if(isset($_GET['apicall'])){

    switch($_GET['apicall']){

        //the CREATE operation
        //if the api call value is 'createproduct'
        //we will create a record in the database
        case 'createproduct':
            //first check the parameters required for this request are available or not
            //isTheseParametersAvailable(array('model', 'brand', 'category', 'product'));

            //check if model already exists
            $dbcheck = new DbOperation();
            if(isset($_POST['model'])){
                $result_check = $dbcheck->getProductByModel($_POST['model']);

                if($result_check) {
                    //record is created means there is no error
                    $response['error'] = true;

                    //in message we have a success message
                    $response['message'] = 'Product already exists';

                    break;
                }
            }

            //creating a new dboperation object
            $db = new DbOperation();

            $_POST['model'] = isset($_POST['model']) ? $_POST['model'] : '';
            $_POST['brand'] = isset($_POST['brand']) ? $_POST['brand'] : '';
            $_POST['category'] = isset($_POST['category']) ? $_POST['category'] : '';
            $_POST['product'] = isset($_POST['product']) ? $_POST['product'] : '';
            $_POST['upc'] = isset($_POST['upc']) ? $_POST['upc'] : '';
            $_POST['title'] = isset($_POST['title']) ? $_POST['title'] : '';
            $_POST['inventory'] = isset($_POST['inventory']) ? $_POST['inventory'] : '';
            $_POST['cost'] = isset($_POST['cost']) ? $_POST['cost'] : '';
            $_POST['price'] = isset($_POST['price']) ? $_POST['price'] : '';
            $_POST['price_before'] = isset($_POST['price_before']) ? $_POST['price_before'] : '';
            $_POST['price1'] = isset($_POST['price1']) ? $_POST['price1'] : '';
            $_POST['price1_start'] = isset($_POST['price1_start']) ? $_POST['price1_start'] : '';
            $_POST['price1_end'] = isset($_POST['price1_end']) ? $_POST['price1_end'] : '';
            $_POST['price2'] = isset($_POST['price2']) ? $_POST['price2'] : '';
            $_POST['price2_start'] = isset($_POST['price2_start']) ? $_POST['price2_start'] : '';
            $_POST['price2_end'] = isset($_POST['price2_end']) ? $_POST['price2_end'] : '';
            $_POST['discontinued'] = isset($_POST['discontinued']) ? $_POST['discontinued'] : '';
            $_POST['size'] = isset($_POST['size']) ? $_POST['size'] : '';
            $_POST['technology'] = isset($_POST['technology']) ? $_POST['technology'] : '';
            $_POST['dimension_withstand'] = isset($_POST['dimension_withstand']) ? $_POST['dimension_withstand'] : '';
            $_POST['dimension_withoutstand'] = isset($_POST['dimension_withoutstand']) ? $_POST['dimension_withoutstand'] : '';
            $_POST['dimension_stand'] = isset($_POST['dimension_stand']) ? $_POST['dimension_stand'] : '';
            $_POST['dimension_package'] = isset($_POST['dimension_package']) ? $_POST['dimension_package'] : '';
            $_POST['weight'] = isset($_POST['weight']) ? $_POST['weight'] : '';
            $_POST['weight_stand'] = isset($_POST['weight_stand']) ? $_POST['weight_stand'] : '';
            $_POST['weight_package'] = isset($_POST['weight_package']) ? $_POST['weight_package'] : '';
            $_POST['releasedate'] = isset($_POST['releasedate']) ? $_POST['releasedate'] : '';
            $_POST['feature_display_resolution'] = isset($_POST['feature_display_resolution']) ? $_POST['feature_display_resolution'] : '';
            $_POST['feature_display_type'] = isset($_POST['feature_display_type']) ? $_POST['feature_display_type'] : '';
            $_POST['feature_display_refreshrate'] = isset($_POST['feature_display_refreshrate']) ? $_POST['feature_display_refreshrate'] : '';
            $_POST['feature_display_backlight'] = isset($_POST['feature_display_backlight']) ? $_POST['feature_display_backlight'] : '';
            $_POST['feature_display_more'] = isset($_POST['feature_display_more']) ? $_POST['feature_display_more'] : '';
            $_POST['feature_assistant'] = isset($_POST['feature_assistant']) ? $_POST['feature_assistant'] : '';
            $_POST['feature_audio'] = isset($_POST['feature_audio']) ? $_POST['feature_audio'] : '';
            $_POST['feature_picture'] = isset($_POST['feature_picture']) ? $_POST['feature_picture'] : '';
            $_POST['feature_connectivity'] = isset($_POST['feature_connectivity']) ? $_POST['feature_connectivity'] : '';
            $_POST['feature_mounting'] = isset($_POST['feature_mounting']) ? $_POST['feature_mounting'] : '';
            $_POST['feature_ports'] = isset($_POST['feature_ports']) ? $_POST['feature_ports'] : '';
            $_POST['feature_power'] = isset($_POST['feature_power']) ? $_POST['feature_power'] : '';
            $_POST['warranty'] = isset($_POST['warranty']) ? $_POST['warranty'] : '';
            $_POST['description'] = isset($_POST['description']) ? $_POST['description'] : '';

            //creating a new record in the database
            $result = $db->createProduct(
                $_POST['model'],
                $_POST['brand'],
                $_POST['category'],
                $_POST['product'],
                $_POST['upc'],
                $_POST['title'],
                $_POST['inventory'],
                $_POST['cost'],
                $_POST['price'],
                $_POST['price_before'],
                $_POST['price1'],
                $_POST['price1_start'],
                $_POST['price1_end'],
                $_POST['price2'],
                $_POST['price2_start'],
                $_POST['price2_end'],
                $_POST['discontinued'],
                $_POST['size'],
                $_POST['technology'],
                $_POST['dimension_withstand'],
                $_POST['dimension_withoutstand'],
                $_POST['dimension_stand'],
                $_POST['dimension_package'],
                $_POST['weight'],
                $_POST['weight_stand'],
                $_POST['weight_package'],
                $_POST['releasedate'],
                $_POST['feature_display_resolution'],
                $_POST['feature_display_type'],
                $_POST['feature_display_refreshrate'],
                $_POST['feature_display_backlight'],
                $_POST['feature_display_more'],
                $_POST['feature_assistant'],
                $_POST['feature_audio'],
                $_POST['feature_picture'],
                $_POST['feature_connectivity'],
                $_POST['feature_mounting'],
                $_POST['feature_ports'],
                $_POST['feature_power'],
                $_POST['warranty'],
                $_POST['description']
            );


            //if the record is created adding success to response
            if($result){
                //record is created means there is no error
                $response['error'] = false;

                //in message we have a success message
                $response['message'] = 'Product addedd successfully';

                //and we are getting all the products from the database in the response
                //$response['products'] = $db->getProducts();
            }else{

                //if record is not added that means there is an error
                $response['error'] = true;

                //and we have the error message
                $response['message'] = 'Some error occurred please try again';
            }

            break;

        //the READ operation
        //if the call is getproducts
        case 'getproducts':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Request successfully completed';
            $response['products'] = $db->getProducts();
            break;

        //the READ by ID operation
        //if the call is getproductbyid
        case 'getproductbyid':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Request successfully completed';
            $response['products'] = $db->getProductById(
                $_GET['id']
            );
            break;

        case 'getproductbymodel':
            $db = new DbOperation();
            $response['error'] = false;
            $response['message'] = 'Request successfully completed';
            $response['products'] = $db->getProductByModel(
                $_GET['model']
            );
            break;

        //the UPDATE operation
        case 'updateproduct':
            //isTheseParametersAvailable(array('model', 'brand', 'category', 'product'));
            $db = new DbOperation();
            $result = $db->updateProduct(
                $_POST['id'],
                $_POST['model'],
                $_POST['brand'],
                $_POST['category'],
                $_POST['product'],
                $_POST['upc'],
                $_POST['title'],
                $_POST['cost'],
                $_POST['price'],
                $_POST['price_before'],
                $_POST['price1'],
                $_POST['price1_start'],
                $_POST['price1_end'],
                $_POST['price2'],
                $_POST['price2_start'],
                $_POST['price2_end'],
                $_POST['discontinued'],
                $_POST['size'],
                $_POST['technology'],
                $_POST['dimension_withstand'],
                $_POST['dimension_withoutstand'],
                $_POST['dimension_stand'],
                $_POST['dimension_package'],
                $_POST['weight'],
                $_POST['weight_stand'],
                $_POST['weight_package'],
                $_POST['releasedate'],
                $_POST['feature_display_resolution'],
                $_POST['feature_display_type'],
                $_POST['feature_display_refreshrate'],
                $_POST['feature_display_backlight'],
                $_POST['feature_display_more'],
                $_POST['feature_assistant'],
                $_POST['feature_audio'],
                $_POST['feature_picture'],
                $_POST['feature_connectivity'],
                $_POST['feature_mounting'],
                $_POST['feature_ports'],
                $_POST['feature_power'],
                $_POST['warranty'],
                $_POST['description']
            );

            if($result){
                $response['error'] = false;
                $response['message'] = 'Product updated successfully';
                //$response['products'] = $db->getProducts();
            }else{
                $response['error'] = true;
                $response['message'] = 'Some error occurred please try again';
            }
            break;

        //the delete operation
        case 'deleteProduct':

            //for the delete operation we are getting a GET parameter from the url having the id of the record to be deleted
            if(isset($_GET['id'])){
                $db = new DbOperation();
                if($db->deleteProduct($_GET['id'])){
                    $response['error'] = false;
                    $response['message'] = 'Product deleted successfully';
                    $response['products'] = $db->getProducts();
                }else{
                    $response['error'] = true;
                    $response['message'] = 'Some error occurred please try again';
                }
            }else{
                $response['error'] = true;
                $response['message'] = 'Nothing to delete, provide an id please';
            }
            break;
    }

}else{
    //if it is not api call
    //pushing appropriate values to response array
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

//displaying the response in json structure

function convert_before_json(&$item, $key)
{
    $item = utf8_encode($item);
}

array_walk_recursive($response, "convert_before_json");
echo json_encode($response);