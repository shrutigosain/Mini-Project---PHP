<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">

            html, body {
                background-color: #F9F9F9;
                font-family: Open Sans, sans-serif;
            }

            .avatar{
                width:80px;
                position: absolute;
                top: -50px;
                left: calc(50% - 35px);
            }

            .error {
                color: #FF0000;
                font-size: 13px;
            }

            .form-outline{
                background-color: #fff;
                border: 3px solid #eee;
                box-shadow: 1px 1px 4px #eee;
                padding: 40px 40px 0px 40px;
                width: 300px;
                height: auto;
                border-radius: 3px;
                top: 53%;
                left: 50%;
                position: absolute;
                transform: translate(-50%,-50%);
            }

            .form-inline input {
              margin: 5px 10px 5px 0;
              padding: 10px;
              background-color: #fff;
              border: 1px solid #8E8E93;
              align: center;
              width :100%;
            }

            .form-inline input[type="password"],input[type="text"]{
                border: 1px solid #e0e0e0;
                border-radius: 3px;
                color: #4a4a4a;
                box-sizing: border-box;
            }

            .form-inline input[type="submit"]{
                margin-top: 20px;
                font-size: 15px;
                color: white;
                background-color: #FF5722;
                border-color: #ff5722;
                border-radius: 3px;

            }

            .password {
                position:relative;
            }

            .pass-img {
                height:17px;
                position:absolute;
                right:2px;
                top:15px;
            }

            select:focus, input:focus{
                outline: none;
                border:1px solid #8E8E93;
            }

            select{
                margin: 5px 10px 5px 0;
                padding: 10px;
                background-color: #fff;
                border: 1px solid #e0e0e0;
                align: center;
                width: 100%;
            }



        </style>
    </head>

    <?php
        $name = "";
        $password = "";
        $cnf_password = "";
        $gstin = "";
        $username = "";
        $nameErr = "";
        $usernameErr = "";
        $passwordErr = "";
        $cnf_passwordErr = "";
        $locationErr = "";
        $gstinErr = "";

        $passwordErrShow = "";
        $cnf_passwordErrShow = "";


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Username
            if (empty($_POST["username"]))
              $usernameErr = "* Username is required";
            else
              $username = test_input($_POST["username"]);

            // Password
            if (empty($_POST["password"]))
              $passwordErr = "* Password is required";
            else
              $password = test_input($_POST["password"]);

            if (empty($_POST["cnf_password"]))
                $cnf_passwordErr = "* Password is required";
            else
                $cnf_password = test_input($_POST["cnf_password"]);

            // Name
            if (empty($_POST["name"]))
                $nameErr = "* Name is required";
            else
                $name = test_input($_POST["name"]);

            // Location
            $location = $_POST['locations'];

            if ($location == "Empty")
                $locationErr = "* Select Correct Location";

            //GSTIN
            if (empty($_POST["gstin"]))
                $gstinErr = "* GSTIN Number is required";
            else
                $gstin = test_input($_POST["gstin"]);

        }


        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
        }


        if (isset($_POST['submit'])) {

            // Validate password
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            $number    = preg_match('@[0-9]@', $password);
            $specialChars = preg_match('@[^\w]@', $password);

            if (strlen($password) < 8)
                $passwordErr = "* Password should be minimum 8 characters.";
            elseif (!$uppercase)
                $passwordErr = "* Include at least one upper case letter.";
            elseif (!$lowercase)
                $passwordErr = "* Include at least one lower case letter.";
            elseif (!$number)
                $passwordErr = "* Include at least one number.";
            elseif (!$specialChars)
                $passwordErr = "* Include at least one special character.";
            elseif (strcmp($cnf_password, $password)!=0)
                $cnf_passwordErr = "* Passwords do not match.";
            elseif (strcmp($cnf_password, $password)==0)
                $passwordErr = "";

            // GST
            $pattern = "/[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[0-9]{1}[A-Z]{1}[0-9]{1}/";
            $check = preg_match($pattern, $gstin);

            if (!$check)
                $gstinErr = "* Enter Valid GST Number";

            if(!filter_var($username, FILTER_VALIDATE_EMAIL))
                $usernameErr = "* Invalid Username";


            // redirect to new page
            if ($passwordErr=="" && $cnf_passwordErr=="" && $gstinErr=="" && $usernameErr=="" && $locationErr=="" && $nameErr==""){
                header('Location: http://localhost/WP2/Mini%20Project/cookie.php?name='.$name.'&username='.$username.'&location='.$location);
                exit();
            }
        }
     ?>

    <body>
        <div style="text-align: center;">
            <span style="font-size:30px;">Musical Hands</span><br>
        </div>

        <div class="form-outline">
            <div style="text-align: center;">
                <span style="font-size:20px;">Seller Signup</span>
            </div>
            <br>

            <img src="avatar.png" class="avatar">
            <form method="post" class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <input type="text" name="name" placeholder="Company/Business name" value="<?php echo $name;?>"><br>
                <span class="error"><?php echo $nameErr;?> </span> <br>

                <input type="text" name="username" placeholder="Email Id" value="<?php echo $username;?>"><br>
                <span class="error"><?php echo $usernameErr;?> </span> <br>

                <div class="password">
                    <input type="password" name="password" placeholder="Password" id="pass" value="<?php echo $password;?>">
                    <img class="pass-img" src="eye1.png" alt="" id="eye_img" onclick="myFunction()">
                </div>

                <span class="error"><?php echo $passwordErr;?></span> <br>
                <input type="password" name="cnf_password" placeholder="Confirm Password" value="<?php echo $cnf_password;?>"><br>
                <span class="error"><?php echo $cnf_passwordErr;?> </span> <br>

                <select name="locations" style="color:#757575">
                  <option value="Empty"> --- Select Location ---</option>
                  <option value="Mumbai">Mumbai</option>
                  <option value="Pune">Pune</option>
                  <option value="Delhi">Delhi</option>
                  <option value="Banglore">Banglore</option>
                  <option value="Chennai">Chennai</option>
                  <option value="Kolkata">Kolkata</option>
                </select> <br>
                <span class="error"><?php echo $locationErr;?> </span> <br>

                <input type="text" name="gstin" placeholder="GSTIN Number" value="<?php echo $gstin;?>"><br>
                <span class="error">  <?php echo $gstinErr;?> </span>

                <input type="submit" name="submit" value="Sign Up">
                <br><br>
            </form>
        </div>


        <script>
            function myFunction() {
              var x = document.getElementById("pass");
              if (x.type === "password")
                x.type = "text";
              else
                x.type = "password";


              var img = document.getElementById("eye_img");
              if (img.getAttribute('src') == "eye1.png")
                img.src = "eye2.png";
              else
                img.src = "eye1.png";

            }
        </script>
    </body>
</html>
