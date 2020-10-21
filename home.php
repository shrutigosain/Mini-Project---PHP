<!DOCTYPE html>
<html >
    <head>
        <title>Musical Hands</title>

        <!-- CSS only -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

        <style>

            html, body {
                background-color: #F9F9F9;
                font-family: Open Sans, sans-serif;
            }

            .nav-link{
                color: #ff9878 !important;
            }
            .nav-link:hover{
                color: #FF5722 !important;
            }

            .carousel {
              width:850px;
              height:360px;
            }

            .btn-outline-primary{
                color: #FF5722 !important;
                border-color: #FF5722 !important;
            }
            .btn-outline-primary:hover{
                color: #FFF !important;
                background-color: #FF5722 !important;
            }

            .todays_deal {
              width: 130px;
              text-align: center;
              color: #fff;
              background-color: #12B312;
              border-radius: 3px;
              /* transform: rotate(-40deg); */
            }

            /* MODAL */

            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.4);
            }

            /* Modal Content Box */
            .modal-content {
                background-color: #fefefe;
                margin: 4% auto 15% auto;
                border: 1px solid #888;
                width: 30%;
                padding-bottom: 20px;
            }

            .close {
                position: absolute;
                right: 25px;
                top: 0;
                color: #000;
                font-size: 35px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: red;
                cursor: pointer;
            }

            .animate {
                animation: zoom 0.6s
            }

            @keyframes zoom {
                from {
                    transform: scale(0)
                }

                to {
                    transform: scale(1)
                }
            }

            /* Location pin */

            input{
                text-align: center;
                margin-left: 50px;
                margin-right: 50px;
            }

        </style>
    </head>
    <?php session_start(); ?>

    <body>
        <p class="display-4 text-center pt-2">Musical Hands</p>
        <p class="text-center lead" >Start Your Musical Journey here</p>

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light navbar-color">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active ">
                        <a class="nav-link"  href="#">Home <span class="sr-only">(current)</span></a>
                    </li>


                    <?php if(isset($_SESSION['location']) && !empty($_SESSION['location'])){ ?>
                        <li class="nav-item active ">
                            <a class="nav-link" onclick="document.getElementById('modal-wrapper').style.display='block'"> <img src="images/placeholder.png" height="17px;" alt="No "> <?php echo $_SESSION['location']; ?> </a>
                        </li>
                    <?php } ?>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li> -->
                </ul>


                <?php if(!isset($_COOKIE['username'])) { ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup_user.php">Register</a>
                        </li>
                    </ul>
                <?php } else { ?>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logoutcookie.php">Logout</a>
                        </li>

                    </ul>
                <?php } ?>

            </div>
        </nav>

        <!-- Modal -->
        <div id="modal-wrapper" class="modal">
            <form class="modal-content animate" action="location_session.php" method="post">
                <span onclick="document.getElementById('modal-wrapper').style.display='none'" class="close" title="Close PopUp" style="margin-top:15px">&times;</span>
                <h4 style="text-align:center; margin-top:15px;">Enter your Location</h4>

                <br>
                <input type="text" name="location">
                <br>
                <input type="submit" name="submit" value="Save">
            </form>
        </div>

        <!-- Carousel -->
        <div id="carouselExampleIndicators" class="carousel slide ml-auto mr-auto" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="images/guitar.png" alt="First slide" >
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="images/trumpet_1.png" alt="First slide" >
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/keyboard_1.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="images/images_1.png" alt="Third slide">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>

        <!-- Card -->
        <!-- Today's Deal -->
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow ml-5 mt-5 pt-3" style="width: 19rem;">
                    <div class="todays_deal">Today's Deal</div>
                    <img class="card-img-top" src="images/guitar/guitar1.jpg" alt="Card image cap" name="img_scr" value="images/guitar/guitar1.jpg">
                    <div class="card-body">
                        <h5 class="card-title">₹ 17999</h5>
                        <p class="card-text">Gibson, Acoustic Electric Guitar, J-45 Studio -Antique Natural RS4SANN19</p>
                        <a href="#" class="btn btn-outline-primary">Add To Cart</a>
                        <!-- <a href="#" class="btn btn-outline-warning ml-5">Buy Now</a> -->
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow ml-5 mt-5 pt-3" style="width: 19rem;">
                    <div class="todays_deal">Today's Deal</div>
                    <img class="card-img-top" src="images/guitar/guitar2.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">₹ 17700</h5>
                        <p class="card-text">Gibson, Acoustic Electric Guitar, L-00 Studio -Antique Natural LSLSANN19</p>
                        <a href="#" class="btn btn-outline-primary">Add To Cart</a>
                        <!-- <a href="#" class="btn btn-outline-warning ml-5">Buy Now</a> -->
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow ml-5 mt-5 pt-3" style="width: 19rem;">
                    <div class="todays_deal">Today's Deal</div>
                    <img class="card-img-top" src="images/guitar/guitar3.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">₹ 23380</h5>
                        <p class="card-text">Gibson, Acoustic Electric Guitar,Humminbird, Walnut Burst AGHBWBN19</p>
                        <a href="#" class="btn btn-outline-primary">Add To Cart</a>
                        <!-- <a href="#" class="btn btn-outline-warning ml-5">Buy Now</a> -->
                    </div>
                </div>
            </div>


            <div class="col-md-3">
                <div class="card shadow ml-5 mt-5 pt-3" style="width: 19rem;">
                    <div class="todays_deal">Today's Deal</div>
                    <img class="card-img-top" src="images/guitar/guitar4.jpg" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">₹ 47069</h5>
                        <p class="card-text">Epiphone, Electric Guitar, Les Paul Muse-Scarlett Red Metallic ENMLSRMNH1</p>
                        <a href="#" class="btn btn-outline-primary">Add To Cart</a>
                        <!-- <a href="#" class="btn btn-outline-warning ml-5">Buy Now</a> -->
                    </div>
                </div>
            </div>
        </div>

    </body>


    <script type="text/javascript">

        <?php if(!isset($_SESSION['location']) && empty($_SESSION['location'])){ ?>
            window.onload(document.getElementById('modal-wrapper').style.display='block')
        <?php } ?>


        var modal = document.getElementById('modal-wrapper');
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</html>
