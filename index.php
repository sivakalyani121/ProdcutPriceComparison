<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Website with Login & Registration Form</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <style>
    .about_us_content {
      padding: 50px 20px; 
      background-color:white; 
      text-align: center; 
    }

    .home {
      min-height: 100vh; 
      padding-bottom: 100px; 
    }

    .google-login-container {
      margin-top: 20px;
    }

    .google-login-btn {
      display: inline-block;
      text-decoration: none;
      padding: 10px 20px;
      background-color: #7d2ae8; 
      color: white;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .google-login-btn:hover {
      background-color: #3c78dc; 
    }

    .google-login-btn .icon {
      margin-right: 10px;
    }

    .google-login-btn svg {
      fill: white;
      width: 1em;
      height: 1em;
    }
  </style>
</head>
<body>
  <header class="header">
    <nav class="nav">
      <a href="#" class="nav_logo">PriceHive</a>
      <ul class="nav_items">
        <li class="nav_item">
          <a href="#about_us" class="nav_link">About Us</a>
          <a href="#" class="nav_link" id="open-feedback-popup">Feedback</a>
        </li>
      </ul>
      <button class="button" id="form-open">Login</button>
    </nav>
  </header>

  <section class="home">
    <div class="form_container">
      <i class="uil uil-times form_close"></i>
      <div class="form login_form">
        <form action="server.php" method="post">
          <h2>Login</h2>
          <div class="input_box">
            <input type="email" name="email" placeholder="Enter your email" required>
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="password" placeholder="Enter your password" required>
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <button type="submit" name="login" class="button">Login Now</button>
          <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
          <div class="google-login-container" style="display: flex; justify-content: center;">
       <a href="google-oauth.php" class="google-login-btn">
        <span class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
      </svg>
    </span>
    <span style="color: white; font-weight: bold;">Login with Google</span>
  </a>
</div>
<p id="error-message" style="color: red;"></p>
</form>
      </div>
      <div class="form signup_form">
        <form action="server.php" method="post" id="signup-form">
          <h2>Signup</h2>
          <?php
        if(isset($errors) && count($errors) > 0) {
            foreach($errors as $error) {
                echo '<p style="color: red;">' . $error . '</p>';
            }
        }
        ?>
          <div class="input_box">
            <i class="uil uil-user name"></i>
            <input type="text" name="name" placeholder="Enter your Name" required>
          </div>
          <div class="input_box">
            <input type="email" name="email" placeholder="Enter your email" required>
            <i class="uil uil-envelope-alt email"></i>
          </div>
          <div class="input_box">
            <input type="password" name="password" placeholder="Create password" required>
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <div class="input_box">
            <input type="password" name="password_confirm" placeholder="Confirm password" required>
            <i class="uil uil-lock password"></i>
            <i class="uil uil-eye-slash pw_hide"></i>
          </div>
          <button type="submit" name="signup" class="button">Signup Now</button>
          <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          <div class="google-login-container" style="display: flex; justify-content: center;">
  <a href="google-oauth.php" class="google-login-btn">
    <span class="icon">
      <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 488 512">
        <path d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z"/>
      </svg>
    </span>
    <span style="color: white; font-weight: bold;">Signup with Google</span>
  </a>
</div>
        </form>
      </div>
    </div>
  </section>

  <section id="about_us" class="about_us_content">
    <h2>About Us</h2>
    <p>PriceHive helps you find the best prices for the products 
      you want by comparing them across different online stores. 
      With us, you can quickly search for any item and see where 
      it's available and at what price. 
      We make it easy for you to make smart shopping choices and save money.</p>
  </section>
  <div id="feedback-popup" class="feedback-popup">
  <div class="feedback-form-container">
    <form action="feedback_server.php" method="post">
      <h2 class="feedback-heading">Feedback</h2>
      <div class="input_box feedback-input">
        <input type="email" name="email" placeholder="Your Email" required>
      </div>
      <div class="input_box feedback-input">
        <textarea name="feedback" placeholder="Your Feedback" required></textarea>
      </div>
      <button type="submit" name="submit_feedback" class="button feedback-submit">Submit Feedback</button>
    </form>
    <button id="close-feedback-popup" class="close-button">Close</button>
  </div>
</div>

  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const home = document.querySelector(".home");
      home.classList.add("show");
    });
  </script>
    <?php if (isset($_SESSION['success'])): ?>
      window.location.href = 'tickbox.html';
    <?php endif; ?>
  </script>
  <script>
    var errorMessages = <?php echo json_encode($errors); ?>;
    var errorMessageElement = document.getElementById("error-message");
    if (Object.keys(errorMessages).length > 0) {
        var errorMessageHtml = "";
        for (var key in errorMessages) {
            errorMessageHtml += errorMessages[key] + "<br>";
        }
        errorMessageElement.innerHTML = errorMessageHtml;
    } else {
        errorMessageElement.innerHTML = "";
    }
</script>
</body>
</html>

