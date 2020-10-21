<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
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

            .shoppingCart {
                width: 100%;
                margin: 10px auto;
                background: #eee;
                display: flex;
                flex-direction: column;
            }

            .item {
                padding: 10px 10px;
                border: 1px solid #17A2B8;
                border-radius: 5px;
            }

            .description div {
                font-size: 20px;
                color: #000;
            }

            .description div:first-child {
                font-size: 28px;
                color: #000;
            }

            .totalPrice {
                margin-top: 27px;
                font-size: 28px;
            }

            /* .btn {
                margin-top: 40px;
                width: 30px;
                height: 30px;
                border-radius: 5px;
                border: none;
            }

            .remove{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }

            .count {
                margin-top: 20px;
                font-size: 28px;
                padding:15px;
            } */

            .bill{
                width: 100%;
                margin: 10px auto;
                background: #fff;
                display: flex;
                flex-direction: column;
            }

            .nav-link{
                color: #ff9878 !important;
            }
            .nav-link:hover{
                color: #FF5722 !important;
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


    <body>
        <p class="display-4 text-center pt-2">Musical Hands</p>
        <p class="text-center lead" >Your Cart</p>

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light navbar-color">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active ">
                        <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
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

            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
            </div>
        </nav>

        <!-- Cart Strip -->
        <div class="row">
            <div class="col-sm-1">
                <!-- Empty -->
            </div>
            <div class="col-sm-10">
                <div class="shoppingCart ">
                    <div class="item ">
                        <div class="row">
                            <div class="col-sm-1 mt-4" >
                                <div class="remove">
                                    <button class="btn btn-outline-danger" name="button">X</button>
                                </div>
                            </div>

                            <div class="col-sm-4" >
                                <img src="images/drums.jpg" alt="" height="100px">
                                <ImageHelper product={product}/>
                            </div>

                            <div class="col-sm-3">
                                <div class="description">
                                    <div> Music Title </div>
                                    <div class="">Music Description</div>
                                </div>
                            </div>

                            <!-- <div class="col-sm-3 d-flex justify-content-center">
                                <div class="row ">
                                        <button
                                            class="btn"
                                            onClick={() => {
                                                setCount(count-1);
                                                updateCart(product, count-1);
                                                setReload(!reload)  //to reload totalPrice
                                            }}
                                            disabled={count === 1}
                                            >-</button>
                                        <div class="count" >{cardCount}</div>
                                        <button
                                            class="btn"
                                            onClick={() => {
                                                setCount(count+1);
                                                updateCart(product, count+1);
                                                setReload(!reload)
                                            }}
                                            disabled={count === 10}
                                            >+</button>
                                </div>
                            </div> -->

                            <div class="col-sm-2  ">
                                <div class="totalPrice"> 656</div>
                            </div>
                        </div>
                    </div>
                </div>


            <p class="text-center">Bill</p>

            </div>

            <div class="col-sm-1">
                <!-- Empty -->
            </div>

        </div>


    </body>
</html>
