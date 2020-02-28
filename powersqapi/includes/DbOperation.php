<?php

class DbOperation
{
    //Database connection link
    private $con;

    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';

        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();

        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }

    /*
    * The create operation
    * When this method is called a new record is created in the database
    */
    function createProduct($model, $brand, $category, $producttype, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start, $price2_end,
                           $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
                           $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio,
                           $feature_picture, $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description){
        $stmt = $this->con->prepare("INSERT INTO products (model,brand,category,product,upc,title,cost,price,price_before,price1,price1_start,price1_end,price2,price2_start,price2_end,discontinued,
        size,technology,dimension_withstand,dimension_withoutstand,dimension_stand,dimension_package,weight,weight_stand,weight_package,releasedate,feature_display_resolution,feature_display_type,
        feature_display_refreshrate,feature_display_backlight,feature_display_more,feature_assistant,feature_audio,feature_picture,feature_connectivity,feature_mounting,feature_ports,feature_power,warranty, description) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssddddssdssissssssdddsssssssssssssss", $model, $brand, $category, $producttype, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start,
            $price2_end, $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
            $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio, $feature_picture,
            $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description);
        if($stmt->execute())
            return true;
        return false;
    }

    /*
    * The read operation
    * When this method is called it is returning all the existing record of the database
    */
    function getProducts(){
        $stmt = $this->con->prepare("SELECT id, model,brand,category,product,upc,title,cost,price,price_before,price1,price1_start,price1_end,price2,price2_start,price2_end,discontinued,
        size,technology,dimension_withstand,dimension_withoutstand,dimension_stand,dimension_package,weight,weight_stand,weight_package,releasedate,feature_display_resolution,feature_display_type,
        feature_display_refreshrate,feature_display_backlight,feature_display_more,feature_assistant,feature_audio,feature_picture,feature_connectivity,feature_mounting,feature_ports,feature_power,warranty FROM products");
        $stmt->execute();
        $stmt->bind_result($id, $model, $brand, $category, $producttype, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start,
            $price2_end, $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
            $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio, $feature_picture,
            $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty);

        $products = array();

        while($stmt->fetch()){
            $product  = array();
            $product['id'] = $id;
            $product['model'] = $model;
            $product['brand'] = $brand;
            $product['category'] = $category;
            $product['product'] = $producttype;
            $product['upc'] = $upc;
            $product['title'] = $title;
            $product['cost'] = $cost;
            $product['price'] = $price;
            $product['price_before'] = $price_before;
            $product['price1'] = $price1;
            $product['price1_start'] = $price1_start;
            $product['price1_end'] = $price1_end;
            $product['price2'] = $price2;
            $product['price2_start'] = $price2_start;
            $product['price2_end'] = $price2_end;
            $product['discontinued'] = $discontinued;
            $product['size'] = $size;
            $product['technology'] = $technology;
            $product['dimension_withstand'] = $dimension_withstand;
            $product['dimension_withoutstand'] = $dimension_withoutstand;
            $product['dimension_stand'] = $dimension_stand;
            $product['dimension_package'] = $dimension_package;
            $product['weight'] = $weight;
            $product['weight_stand'] = $weight_stand;
            $product['weight_package'] = $weight_package;
            $product['releasedate'] = $releasedate;
            $product['feature_display_resolution'] = $feature_display_resolution;
            $product['feature_display_type'] = $feature_display_type;
            $product['feature_display_refreshrate'] = $feature_display_refreshrate;
            $product['feature_display_backlight'] = $feature_display_backlight;
            $product['feature_display_more'] = $feature_display_more;
            $product['feature_assistant'] = $feature_assistant;
            $product['feature_audio'] = $feature_audio;
            $product['feature_picture'] = $feature_picture;
            $product['feature_connectivity'] = $feature_connectivity;
            $product['feature_mounting'] = $feature_mounting;
            $product['feature_ports'] = $feature_ports;
            $product['feature_power'] = $feature_power;
            $product['warranty'] = $warranty;

            array_push($products, $product);
        }

        return $products;
    }

    /*
    * The read operation by if
    * When this method is called it is returning  the existing record found by id of the database
    */
    function getProductById($id){
        $stmt = $this->con->prepare("SELECT id, model,brand,category,product,upc,title,cost,price,price_before,price1,price1_start,price1_end,price2,price2_start,price2_end,discontinued,
        size,technology,dimension_withstand,dimension_withoutstand,dimension_stand,dimension_package,weight,weight_stand,weight_package,releasedate,feature_display_resolution,feature_display_type,
        feature_display_refreshrate,feature_display_backlight,feature_display_more,feature_assistant,feature_audio,feature_picture,feature_connectivity,feature_mounting,feature_ports,feature_power,warranty, description  FROM products WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($id, $model, $brand, $category, $producttype, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start,
            $price2_end, $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
            $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio, $feature_picture,
            $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description);

        $products = array();

        while($stmt->fetch()){
            $product  = array();
            $product['id'] = $id;
            $product['model'] = $model;
            $product['brand'] = $brand;
            $product['category'] = $category;
            $product['product'] = $producttype;
            $product['upc'] = $upc;
            $product['title'] = $title;
            $product['cost'] = $cost;
            $product['price'] = $price;
            $product['price_before'] = $price_before;
            $product['price1'] = $price1;
            $product['price1_start'] = $price1_start;
            $product['price1_end'] = $price1_end;
            $product['price2'] = $price2;
            $product['price2_start'] = $price2_start;
            $product['price2_end'] = $price2_end;
            $product['discontinued'] = $discontinued;
            $product['size'] = $size;
            $product['technology'] = $technology;
            $product['dimension_withstand'] = $dimension_withstand;
            $product['dimension_withoutstand'] = $dimension_withoutstand;
            $product['dimension_stand'] = $dimension_stand;
            $product['dimension_package'] = $dimension_package;
            $product['weight'] = $weight;
            $product['weight_stand'] = $weight_stand;
            $product['weight_package'] = $weight_package;
            $product['releasedate'] = $releasedate;
            $product['feature_display_resolution'] = $feature_display_resolution;
            $product['feature_display_type'] = $feature_display_type;
            $product['feature_display_refreshrate'] = $feature_display_refreshrate;
            $product['feature_display_backlight'] = $feature_display_backlight;
            $product['feature_display_more'] = $feature_display_more;
            $product['feature_assistant'] = $feature_assistant;
            $product['feature_audio'] = $feature_audio;
            $product['feature_picture'] = $feature_picture;
            $product['feature_connectivity'] = $feature_connectivity;
            $product['feature_mounting'] = $feature_mounting;
            $product['feature_ports'] = $feature_ports;
            $product['feature_power'] = $feature_power;
            $product['warranty'] = $warranty;
            $product['description'] = $description;


            array_push($products, $product);
        }

        return $products;
    }

    /*
    * The update operation
    * When this method is called the record with the given id is updated with the new given values
    */
    function updateProduct($id, $model, $brand, $category, $product, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start, $price2_end,
                           $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
                           $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio,
                           $feature_picture, $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description){
        $stmt = $this->con->prepare("UPDATE products SET model = ?, brand = ?, category = ?, product = ?, upc = ?, title = ?, cost = ?, price = ?, price_before = ?, price1 = ?, 
price1_start = ?, price1_end = ?, price2 = ?, price2_start = ?, price2_end = ?, discontinued = ?, size = ?, technology = ?, dimension_withstand = ?, dimension_withoutstand = ?, dimension_stand = ?, 
dimension_package = ?, weight = ?, weight_stand = ?, weight_package = ?, releasedate = ?, feature_display_resolution = ?, feature_display_type = ?, feature_display_refreshrate = ?, feature_display_backlight = ?, 
feature_display_more = ?, feature_assistant = ?, feature_audio = ?, feature_picture = ?, feature_connectivity = ?, feature_mounting = ?, feature_ports = ?, feature_power = ?, warranty = ?, description = ? WHERE id = ?");
        $stmt->bind_param("ssssssddddssdssissssssdddsssssssssssssssi", $model, $brand, $category, $product, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start, $price2_end,
            $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
            $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio,
            $feature_picture, $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description, $id);
        if($stmt->execute())
            return true;
        return false;
    }


    /*
    * The delete operation
    * When this method is called record is deleted for the given id
    */
    function deleteProduct($id){
        $stmt = $this->con->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        if($stmt->execute())
            return true;

        return false;
    }



    function getProductByModel($model){
        $stmt = $this->con->prepare("SELECT id, model,brand,category,product,upc,title,cost,price,price_before,price1,price1_start,price1_end,price2,price2_start,price2_end,discontinued,
        size,technology,dimension_withstand,dimension_withoutstand,dimension_stand,dimension_package,weight,weight_stand,weight_package,releasedate,feature_display_resolution,feature_display_type,
        feature_display_refreshrate,feature_display_backlight,feature_display_more,feature_assistant,feature_audio,feature_picture,feature_connectivity,feature_mounting,feature_ports,feature_power,warranty, description  FROM products WHERE model = ?");
        $stmt->bind_param("s",$model);
        $stmt->execute();
        $stmt->bind_result($id, $model, $brand, $category, $producttype, $upc, $title, $cost, $price, $price_before, $price1, $price1_start, $price1_end, $price2, $price2_start,
            $price2_end, $discontinued, $size, $technology, $dimension_withstand, $dimension_withoutstand, $dimension_stand, $dimension_package, $weight, $weight_stand, $weight_package, $releasedate,
            $feature_display_resolution, $feature_display_type, $feature_display_refreshrate, $feature_display_backlight, $feature_display_more, $feature_assistant, $feature_audio, $feature_picture,
            $feature_connectivity, $feature_mounting, $feature_ports, $feature_power, $warranty, $description);

        $products = array();

        while($stmt->fetch()){
            $product  = array();
            $product['id'] = $id;
            $product['model'] = $model;
            $product['brand'] = $brand;
            $product['category'] = $category;
            $product['product'] = $producttype;
            $product['upc'] = $upc;
            $product['title'] = $title;
            $product['cost'] = $cost;
            $product['price'] = $price;
            $product['price_before'] = $price_before;
            $product['price1'] = $price1;
            $product['price1_start'] = $price1_start;
            $product['price1_end'] = $price1_end;
            $product['price2'] = $price2;
            $product['price2_start'] = $price2_start;
            $product['price2_end'] = $price2_end;
            $product['discontinued'] = $discontinued;
            $product['size'] = $size;
            $product['technology'] = $technology;
            $product['dimension_withstand'] = $dimension_withstand;
            $product['dimension_withoutstand'] = $dimension_withoutstand;
            $product['dimension_stand'] = $dimension_stand;
            $product['dimension_package'] = $dimension_package;
            $product['weight'] = $weight;
            $product['weight_stand'] = $weight_stand;
            $product['weight_package'] = $weight_package;
            $product['releasedate'] = $releasedate;
            $product['feature_display_resolution'] = $feature_display_resolution;
            $product['feature_display_type'] = $feature_display_type;
            $product['feature_display_refreshrate'] = $feature_display_refreshrate;
            $product['feature_display_backlight'] = $feature_display_backlight;
            $product['feature_display_more'] = $feature_display_more;
            $product['feature_assistant'] = $feature_assistant;
            $product['feature_audio'] = $feature_audio;
            $product['feature_picture'] = $feature_picture;
            $product['feature_connectivity'] = $feature_connectivity;
            $product['feature_mounting'] = $feature_mounting;
            $product['feature_ports'] = $feature_ports;
            $product['feature_power'] = $feature_power;
            $product['warranty'] = $warranty;
            $product['description'] = $description;


            array_push($products, $product);
        }

        return $products;
    }
}