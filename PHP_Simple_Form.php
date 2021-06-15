<html>
  <style>
  .error
  {
    color : #FF0000;
  }

  .backgroundC
  {
    background : #90AFC5;
  }
  </style>
  <body class = "backgroundC">
    <?php
     $nameErr = $emailErr = $phoneErr = $messageErr =  "";
     $name = $email = $phone = $message =  "";
     function get_input($data)
     {
      $data = trim($data);
      $data = stripcslashes($data);
      $data = htmlspecialchars ($data);
      return $data;
     }

     if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (empty($_POST["fname"])) $nameErr = "*Name is required";
      else $name = get_input($_POST["fname"]);

      if (empty($_POST["message"])) $messageErr = "*Message is required";
      else $message = get_input($_POST["message"]);

      if(empty($_POST["email"]) && empty($_POST["phone"]))
      {
        $emailErr = "*Email is required";
        $phoneErr = "*Phone is required";
      }
      else
      {
        if(empty($_POST["email"]))
        {
          $phone = get_input($_POST["phone"]);
        }
        else if(empty($_POST["phone"]))
        {
          $email = get_input($_POST["email"]);
        }
        else
        {
          $phone = get_input($_POST["phone"]);
          $email = get_input($_POST["email"]);
        }
      }
    }
    ?>
    <h1>Επικοινωνία</h1>
  
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($messageErr) && empty($phoneErr) && empty($emailErr) )
    {
      echo "Dear " . $name . ",";
      echo  "<br> <br>";
      echo  "Your messgae has been saved with <br> the following content: <br>";
      echo  "&nbsp >" . $message;
      echo  "<br> <br>";
      echo  "We will contact through email: " . $email . " <br> or phone: " . $phone;
    }
    else
    {
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        Όνομα:
        <div> 
          <input type = "text" name = "fname" value = <?php echo $name; ?>>
          <span class = "error"><?php echo $nameErr;?></span>
        </div>
        Email:
        <div> 
          <input type = "text" name = "email" value = <?php echo $email; ?>>
          <span class = "error"><?php echo $emailErr;?></span>
        </div>

        Τηλέφωνο:
        <div> 
          <input type = "text" name = "phone" value = <?php echo $phone; ?>>
          <span class = "error"><?php echo $phoneErr;?></span>
        </div>

        Το μήνυμα σας:
        <div> 
          <textarea name = "message" rows = "5" cols = "20"><?php echo $message; ?></textarea>
          <span class = "error"><?php echo $messageErr;?></span>
        </div>
        <br>
        <input type ="submit" name ="submit" value ="Αποστολή">
    </form>
    <?php 
    }
    ?>
  </body>
</html>

