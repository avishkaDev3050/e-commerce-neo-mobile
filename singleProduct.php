<?php

    include "connection.php";
    $pId = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="bootstrap.css">
</head>
<body class="overflow-x-hidden p-0 m-0">

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container-fluid">
        <div class="row">

        <!-- product image -->
        <div class="col-12 col-lg-6 p-5 d-flex justify-content-center">
            <div class="row">

            <?php
                if (isset($_GET['id'])) {
                    $pId = $_GET['id'];

                    $p_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '". $pId ."' ");
                    $p_img    = $p_img_rs->fetch_assoc();
            ?>
            
                <img src="resource/products/<?php echo $p_img['img']; ?>" alt="product image">
            
            <?php
                }
            ?>

            </div>
        </div>
        <!-- product image -->

        <!-- product details -->
        <div class="col-12 col-lg-6 p-5">
            <div class="row">

                <?php
                    $product_details = Database::search("SELECT * FROM `product` WHERE `id` = '". $pId ."' ");
                    $data = $product_details->fetch_assoc();

                    $brands = Database::search("SELECT * FROM `brand` WHERE `id` = '". $data['brand_id'] ."'");
                    $brand  = $brands->fetch_assoc();

                    $models = Database::search("SELECT * FROM `model` WHERE `id` = '". $data['model_id'] ."' ");
                    $model = $models->fetch_assoc();
                ?>

                <p style="font-size: 20px"><a href="index.php" class="text-decoration-none link-dark fw-bold opacity-50">Home / </a><?php echo $model['model'] ?></p>
                <h1 style="font-size: 45px" class="fw-bold"><?php echo $brand['brand'] . $model['model'] ?></h1>
                <h2 style="font-size: 40px" class="fw-bold opacity-75 mt-3">RS <?php echo $data['price'] ?></h2>
                <labe class="mt-3" style="font-size: 28px">Quantity</label>
                <input type="number" class="fs-5 p-2" style="width: 10%" value="1" id="qty">
                <h5>Avilable <?php echo $data['qty'] ?></h5>
                <labe class="mt-5" style="font-size: 28px">Select a color</label>
                <select id="color" class="form-select">

                    <option value="0">Select a color</option>

                    <?php
                        $color_id_rs = Database::search("SELECT * FROM `product_has_color` WHERE `product_id` = '". $pId ."' ");
                        $color_num = $color_id_rs->num_rows;

                        for ($i=0; $i < $color_num; $i++) { 
                            $color_data = $color_id_rs->fetch_assoc();

                            $colors_rs = Database::search("SELECT * FROM `color` WHERE `id` = '". $color_data['color_id'] ."' ");
                            $color = $colors_rs->fetch_assoc();
                    ?>
                                <option value="<?php echo $color['id'] ?>"><?php echo $color['color'] ?></option>
                    <?php
                            
                        }
                    ?>
                </select>
                <h3 class="fw-bold mt-3">Description</h3>
                <p class="fw-bold opacity-50 fs-5">
                    <?php echo $data['description']; ?>
                </p>

                <div class="col-12 d-flex gap-1 mt-5">
                    <button class="w-50 btn p-2 text-white fw-bold fs-5" style="background-color: rgb(92,184,227);" onclick="buyNow(<?php echo $pId ?>);">Buy Now</button>
                    <button class="w-50 btn p-2 text-white fw-bold fs-5" style="background-color: hsl(22,77%,56%);" onclick="addToCart(<?php echo $pId; ?>);">Add To Cart</button>
                </div>

                <button class="w-100 mt-2 btn p-2 fw-bold fs-5" onclick="addToWishList(<?php echo $pId ?>);"><img style="width: 20px; margin-right: 10px" src="resource/heart.png" alt="wish list icon">Add To Wish List</button>

            </div>
        </div>
        <!-- product details -->

        
    <!-- Modal -->
    <div class="modal fade" id="msg-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Messege</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="msg-body">
            
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ok</button>
            </div>
        </div>
    </div>
    </div>
    <!-- Modal -->

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->

    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>
</html>



