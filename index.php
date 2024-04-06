<?php

    include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Neo Mobile</title>

    <link rel="stylesheet" href="bootstrap.css" />
  </head>
  <body>
    <!-- navbar -->
    <?php include "header.php"; ?>
    <!-- navbar -->

    <!-- contect -->
    <div class="container">
      <div class="row">

        
    <!-- header -->
    <div class="container">

      <!-- header body  -->
      <div class="row mt-3 mb">
        <!-- logo -->
        <div class="col-12 col-lg-2 d-flex justify-content-center">
            <img class="header-img" src="resource/logo.webp" alt="logo">
        </div>
        <!-- logo -->
            
        <!-- search -->
        <div class="col-12 col-lg-10 mt-4 offset-1 offset-lg-0">
            <input class="search-bar w-50" type="search" autocomplete="mobile" placeholder="Search with model">
            <input type="submit" value="Search" class="search-btn float-end">
            <input type="submit" value="Advanced Search" class="ad-search-btn d-block w-100">
        </div>
        <!-- search -->
      </div>
      <!-- header body  -->
    </div>
    

        <!-- carousal -->
        <div class="col-12">
          <div class="row">
            <div
              id="carouselExampleAutoplaying"
              class="carousel slide"
              data-bs-ride="carousel"
            >
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img
                    src="resource/Ads/a1.jpg"
                    class="img-thumbnail w-100"
                    style="height: 350px;"
                    alt="advertiesment"
                  />
                </div>
                <?php

                $post_rs = Database::search("SELECT * FROM `advertiesment` ");
                $num_rs  = $post_rs->
                num_rows; for ($i=0; $i < $num_rs; $i++) { $post_data =
                $post_rs->fetch_assoc(); ?>
                <div class="carousel-item">
                  <img
                    src="resource/Ads/<?php echo $post_data['post']; ?>"
                    class="img-thumbnail w-100"
                    style="height: 350px;"
                    alt="advertiesment"
                  />
                </div>
                <?php
                }
              ?>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleAutoplaying"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
        <!-- carousal -->
      </div>
    </div>
    <!-- contect -->

    <!-- content -->
    <div class="container mb-5">
      <div class="row">
          <?php

                $products = Database::search("SELECT * FROM `product` ");
                $product_num = $products->num_rows;

                for ($i=0; $i < $product_num; $i++) { 
                  $product = $products->fetch_assoc();
                  $pid = $product['id'];

                  if ($product['qty'] > 0) {
          ?>
                  <?php

                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '". $product['id'] ."' ");
                    $img    = $img_rs->fetch_assoc();

                    $modals  = Database::search("SELECT * FROM `model` WHERE `id` = '". $product['model_id'] ."'  ");
                    $modal   = $modals->fetch_assoc();

                  ?>

                    <div class="col-12 col-md-4 col-lg-3 p-2">
                      <div class="d-flex justify-content-center">
                        <img
                          src="resource/products/<?php echo $img['img']; ?>"
                          style="height: 250px;"
                          alt=""
                        />
                      </div>
                      <h6 class="text-center fw-bold">Rs <?php echo $product['price'] ?></h6>
                      <h6 class="text-center fw-bold"><?php echo $modal['model']; ?></h6>
                      <div class="d-flex justify-content-center">
                        <button
                          class="btn"
                          style="background-color: rgb(106, 198, 211); color: white;"
                          onclick="singleProduct(<?php echo $pid; ?>);"
                        >
                          Learn More
                        </button>
                      </div>
                    </div>
                  <?php
                    } else {
                  ?>
                        <div class="col-12 col-md-4 col-lg-3 p-2">
                          <div class="d-flex justify-content-center">
                            <img
                              src="resource/products/<?php echo $img['img']; ?>"
                              style="height: 250px;"
                              alt=""
                            />
                          </div>
                          <h6 class="text-center fw-bold">Pending</h6>
                          <h6 class="text-center fw-bold"><?php echo $modal['model']; ?></h6>
                          <div class="d-flex justify-content-center">
                            <button
                              class="btn btn-danger disabled"
                            >
                              Out Of stock
                            </button>
                          </div>
                        </div>
                  <?php
                    }
                  }
                  ?>
        </div>
      </div>
    </div>
    <!-- content -->

    <!-- footer -->
    <?php  include "footer.php";?>
    <!-- footer -->


    <script src="script.js"></script>
  </body>
</html>
