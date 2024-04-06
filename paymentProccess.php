<?php

    session_start();
    include "connection.php";
    
    if (isset($_SESSION['u'])) {
        if (isset($_POST['id'])) {
            
            $email = $_SESSION['u']['email'];
            $pid   = $_POST['id'];
            $qty   = $_POST['qty'];

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '". $pid ."'");
            $product    = $product_rs->fetch_assoc();
            $price = $product['price'];

            $model = Database::search("SELECT * FROM `model` WHERE `id` = '". $product['model_id'] ."' ");
            $model_name = $model->fetch_assoc();

            $adddress_rs = Database::search("SELECT *  FROM `address` WHERE `user_email` = '". $email ."' ");
            $adddress    = $adddress_rs->fetch_assoc();
            $line_1 = $adddress['line_1'];
            $line_2 = $adddress['line_2'];
            $city_rs = Database::search("SELECT * FROM `city` WHERE `id` = '". $adddress['city_id'] ."' ");
            $city_name  = $city_rs->fetch_assoc();
            
            // $amount = $qty * $price + 5000;
            $amount = 100;
            $merchant_id = "1226423";
            $order_id = uniqid();
            $currency = "LKR";
            $item = $model_name['model'];
            $merchant_secret = "ODA3MzI4NzM3MjY0MjkwOTczNDczNTgzMTI3NjI2ODExMzQxOTM=";
            $fname = $_SESSION['u']['fname'];
            $lname = $_SESSION['u']['lname'];
            $phone = $_SESSION['u']['mobile'];
            $addres = $line_1 . ' ' . $line_2;
            $city = $city_name['city'];
            $country = "Sri Lanka";

            $hash = strtoupper(
                md5(
                    $merchant_id . 
                    $order_id . 
                    number_format($amount, 2, '.', '') . 
                    $currency .  
                    strtoupper(md5($merchant_secret)) 
                )
            );

            $array = [];
            $array["amount"] = $amount;
            $array["merchant_id"] = $merchant_id;
            $array["order_id"] = $order_id;
            $array["currency"] = $currency;
            $array["item"] = $item;
            $array["merchant_secret"] = $merchant_secret;
            $array["fname"] = $fname;
            $array["lname"] = $lname;
            $array["email"] = $email;
            $array["phone"] = $phone;
            $array["addres"] = $addres;
            $array["city"] = $city;
            $array["country"] = $country;
            $array["hash"] = $hash;

            $jsonObj = json_encode($array);
            

                echo $jsonObj;

        }
    }

?>