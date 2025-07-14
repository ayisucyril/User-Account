<?php
require_once("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
 
  <title>User Registration In PHP</title>
</head>

<body>
  <div class="container">
    <form action="registration.php" method="post">
      <div class="cont_form">
        <div class="row">
        <div class="col-sm-3">
                  <h1>Registration</h1>
                  <p>Fill up the form with the correct value</p>
                  <hr class="mb-3">
                  <label for="firstname">First Name</label>
                  <input class="form-control" type="text" name = "fname" placeholder = "Enter your first name" required>

                  <label for="firstname">Last Name</label>
                  <input class="form-control" type="text" name = "lname" placeholder = "Enter your last name" required>

                  <label for="email">Email Address</label>
                  <input class="form-control" type="email" name = "email" placeholder = "Enter your email" required>

                  <label for="firstname">Phone Number</label>
                  <input class="form-control" type="text" name = "phone_number" placeholder = "Enter your phone number" required>

                  <label for="firstname">Password</label>
                  <input class="form-control" type="password" name = "password" placeholder = "Enter your password" required>
                  <hr class="mb-3">
                  <input class = "btn btn-primary" type="submit" id ="register" name="create" value = "SIGN UP">
        </div>
        </div>
        

      </div>
     </form>
  </div>
 |<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script>
  $(function(){

    $(`#register`).click(function(){
        
      });
        Swal.fire({
          
          'title' : 'hello world',
          'text': 'This is from Sweet alert2', 
          'type': 'success'
        })
  });
 </script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {

    $fname_input = filter_input(INPUT_POST, 'fname', FILTER_UNSAFE_RAW);
    $lname_input = filter_input(INPUT_POST, 'lname', FILTER_UNSAFE_RAW);
    $email_input = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone_number_input = filter_input(INPUT_POST, 'phone_number', FILTER_UNSAFE_RAW);
    $password_input = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);

    $firstname = null;
    $lastname = null;
    $email = null;
    $phone_number = null;
    $hashed_password = null;

    if ($fname_input !== null && $fname_input !== false) {
        $firstname = htmlspecialchars(trim($fname_input), ENT_QUOTES, 'UTF-8');
    }

    if ($lname_input !== null && $lname_input !== false) {
        $lastname = htmlspecialchars(trim($lname_input), ENT_QUOTES, 'UTF-8');
    }

    if ($email_input !== null && $email_input !== false) {
        $email = filter_var($email_input, FILTER_VALIDATE_EMAIL);
    }

    if ($phone_number_input !== null && $phone_number_input !== false) {
        $phone_number = preg_replace('/[^0-9+]/', '', $phone_number_input);
    }

    if ($password_input !== null && $password_input !== false) {
        $hashed_password = password_hash($password_input, PASSWORD_DEFAULT);
    }

    if ($firstname && $lastname && $email && $phone_number && $hashed_password) {
        echo $firstname . "<br>";
        echo $lastname . "<br>";
        echo $email . "<br>";
        echo $phone_number . "<br>";

        try {
            $sql = "INSERT INTO users (`First name`, `Last name`, `Email`, `Phone number`, `Password`) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $result = $stmt->execute([$firstname, $lastname, $email, $phone_number, $hashed_password]);

            if ($result) {
                echo "Successfully saved";
            } else {
                echo "There were errors while saving the data";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all required fields correctly.";
    }
} else {
    echo "Form not submitted.";
}
?>