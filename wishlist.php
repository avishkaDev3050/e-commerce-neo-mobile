
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
</head>
<body class="overflow-x-hidden">

    <!-- header -->
    <?php include "header.php"; ?>
    <!-- header -->

    <div class="container-fluid mb-5">
        <div class="row">

            <h3 class="fw-bold text-center mt-3">Watch List</h3>

            <?php

                include "connection.php";

                    $user = Database::search("SELECT * FROM `watch_list` WHERE `email` = '". $_SESSION['u']['email']."' ");
                    $num  = $user->num_rows;

                    if ($num > 0) {
                               
                        for ($i=0; $i < $num; $i++) { 
                            $user_email = $user->fetch_assoc();

                                    
                            $product        = Database::search("SELECT * FROM `product` WHERE `id` = '". $user_email['product_id'] ."' ");
                            $product_data   = $product->fetch_assoc();


                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '". $product_data['id'] ."' ");
                            $img    = $img_rs->fetch_assoc();

                            $modals  = Database::search("SELECT * FROM `model` WHERE `id` = '". $product_data['model_id'] ."'  ");
                            $modal   = $modals->fetch_assoc();

                ?>

                            <div class="col-12 col-md-6 offset-md-3 mt-3">
                                <div class="row">

                                    <div class="col-12 col-md-3">
                                        <img style="width: 200px;" src="resource/products/<?php echo $img['img'] ?>" alt="product image">
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="col-12">
                                            <p class="fw-bold fs-5 mt-4">
                                                <?php echo $modal['model'] ?>
                                            </p>
                                        </div>
                                        <div class="col-12">
                                            <p class="fw-bold fs-6 opacity-75">
                                                <?php echo $product_data['description'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 mt-4">
                                        <p class="fw-bold fs-6">
                                            <?php echo 'Rs' . $product_data['price'] . '.00' ?>
                                        </p>
                                    </div>
                                    <div class="col-12 d-flex gap-1">
                                        <a href="singleProduct.php?id=<?php echo $product_data['id'] ?>" class="w-50 btn p-2 text-white fw-bold fs-5" style="background-color: rgb(92,184,227);">View</a>
                                        <a class="w-50 btn p-2 text-white fw-bold fs-5" style="background-color: hsl(22,77%,56%);" href="removeWishList.php?id=<?php echo $user_email['id']; ?>" onclick="return confirm('Are yoi sure?');">Remove</a>
                                    </div>

                                </div>
                            </div>

                <?php
                        }
                ?>

                <?php
                    } else {
                ?>
                        <div class="col-12" style="margin-top: 100px; height: 300px">
                            <div class="row">
                                <div class="col-12 emptyCart"></div>
                                <div class="col-12 text-center mb-2">
                                    <label class="form-label fs-1 fw-bold">
                                        You have no items in your watch list yet.
                                    </label>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    <a href="index.php" class="btn btn-outline-info fs-3 fw-bold">Start Shopping</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                ?>

        </div>
    </div>

    <!-- footer -->
    <?php include "footer.php"; ?>
    <!-- footer -->


    <script src="bootstrap.js"></script>
</body>
</html>