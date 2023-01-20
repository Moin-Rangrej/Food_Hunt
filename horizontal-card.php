<?php
include("connection.php");
extract($_REQUEST);
session_start();

if(isset($vendor_id))
{
$vid= $vendor_id;
}
else
{
	header("location:horizontal-card.php");
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Horizontal Card</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Food Order Card UI Design</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	<link rel="stylesheet" type="text/css" href="css1/style.css"/>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </head>
  <body>    
    <!-- <div class="container mt-4">
        <div class="card mt">
            <div class="row">
                <div class="col-md-3">
                    <img src="images/food2.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-8">
                     <h2 class="card-title mt-3">Yummy Burger</h2>
                     <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                         Voluptas alias esse eum voluptatibus nesciunt corporis animi.
                          Consequuntur nisi repellat eius eum numquam autem.
                           Voluptas voluptatibus, magni deserunt quisquam eveniet enim.
                        </p>    
                      <button class="btn btn-success"></button>  
                </div>
            </div>
        </div>
    </div> -->

    <section class="main-content">
      <div class="container">
        <h1 class="text-center text-uppercase">Food Order Card</h1>
        <br>
        <br>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="food-card food-card--vertical bg-white rounded-lg overflow-hidden mb-4 shadow">
              <div class="food-card_img position-relative">
                <img src="images/food3.jpg" alt="">
                <a href="#!"><i class="far fa-heart"></i></a>
              </div>
              <div class="food-card_content">
                <div class="food-card_title-section overflow-hidden">
                  <h4 class="food-card_title"><a href="#!" class="text-dark">Double Cheese Potato Burger</a></h4>
                  <div class="d-flex justify-content-between">
                    <a href="#!" class="food-card_author">Burger</a>
                    <div class="rating-box">
                      <div class="rating-stars d-inline-block position-relative mr-2">
                        <img src="images/grey-star.svg" alt="">
                        <div class="filled-star" style="width:76%"></div>
                      </div>
                      <a href="#!" class="text-muted"><small>2,144 Reviews</small></a>
                    </div>
                  </div>
                </div>
                <div class="food-card_bottom-section">
                  <div class="d-flex justify-content-between"> 
                    <div><span class="fa fa-fire"></span> 220 - 280 Kcal</div>
                    <div>
                      <span class="badge badge-success">Veg</span>
                    </div>
                  </div>
                  <hr>
                  <div class="d-flex justify-content-between">
                    <div class="food-card_price">
                      <span>5.99$</span>
                    </div>
                    <div class="food-card_order-count">
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <button class="btn btn-outline-secondary minus-btn" type="button" id="button-addon1"><i class="fa fa-minus"></i></button>
                        </div>
                        <input type="text" class="form-control input-manulator" placeholder="" aria-label="Example text with button addon"
                          aria-describedby="button-addon1" value="0">
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary add-btn" type="button" id="button-addon1"><i class="fa fa-plus"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>							
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </body>
</html>