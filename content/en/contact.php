
<div class="contact">
  <?php session_start();
  $success = false;
if (!empty($_POST['token'])) {
  if (!empty($_SESSION[$_POST['token']]) && !empty($_POST['captcha']) && !empty($_SESSION[$_POST['token']]['captcha_answer'])) {
    $captcha = $_POST['captcha'];
    $captcha = strtolower($captcha);
    if (in_array($captcha, $_SESSION[$_POST['token']]['captcha_answer'])) {
      $sent = mail($_SERVER['SERVER_ADMIN'],
        ':>hlt: ' . htmlspecialchars($_POST['subject']),
        htmlspecialchars(str_replace("\n.", "\n..", $_POST['message'])),
        'From: ' . htmlspecialchars($_POST['email']) . "\r\n" .
        'X-Mailer: PHP/' . phpversion());
      $success = true;
    }
    if ($success) {
      ?>
            Thank you. We have received your message and
          will respond quickly.
      <?php
      session_destroy();
    } else {
      $error = 'The security question was answered incorrectly.';
    }
  }
}
if(!$success) {
  $rand_token = openssl_random_pseudo_bytes(16);
  $token = bin2hex($rand_token);
//$_SESSION['token'] = $token;

  $captcha = array(
    array(
      'q' => 'How many ears does a rabbit have?',
      'a' => array('2', 'two')
    ),
    array(
      'q' => 'What color besides blue and white is in the UK and US flags?',
      'a' => array('red')
    ),
    array(
      'q' => 'What year is next year (yyyy)?',
      'a' => array(date('Y') + 1)
    ),
    array(
      'q' => 'What year is last year (yyyy)?',
      'a' => array(date('Y') - 1)
    ),
    array(
      'q' => 'In the Peanuts cartoon, what is the name of the dog?',
      'a' => array('snoopy') // here and everywhere ignore case
    ),
    array(
      'q' => 'The official language of France is ...?',
      'a' => array('french')
    ),
    array(
      'q' => 'King Arthur\'s castle is called ...?',
      'a' => array('camelot')
    )
  );
  $captchaIndex = rand(0, count($captcha) - 1);
  $_SESSION[$token]['captcha_answer'] = $captcha[$captchaIndex]['a'];
  ?>
      <div class="form">
        <h1>Contact</h1>
        <!-- <div class="contact flowText"> -->
        <form action="" method="post">
            <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
          <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
            <p>Your name </p>
            <input type="text" name="name" required="required" value="<?php
            if(!empty($_POST['name'])) {
              echo $_POST['name'];
            }
            ?>"/>
            <p>E-mail address</p>
            <input type="email" name="email" required="required" value="<?php
            if(!empty($_POST['email'])) {
              echo $_POST['email'];
            }
            ?>"/>
            <p>Subject</p>
            <input type="text" name="subject" required="required" value="<?php
            if(!empty($_POST['subject'])) {
              echo $_POST['subject'];
            }
            ?>"/>
            <p>Your message</p>
            <textarea name="message" rows="8" cols="35" required="required"><?php
            if(!empty($_POST['message'])) {
              echo $_POST['message'];
            }
            ?></textarea>
            <p><?php echo $captcha[$captchaIndex]['q']; ?> </p>
            <input type="text" name="captcha" required="required" 
                placeholder="just to check if you are a robot" <?php if(!empty($error)) {
                echo 'class= "error" ';
              } 
              ?>/>
              <?php if(!empty($error)) {
                echo '<p class="error">' . $error . '</p>';
              } 
              ?>
            <input class="btn" type="submit" value="Send"/>
        </form>
      </div>
      <div class="extra">
        <!-- <p> <?php echo $company; ?> is a trademark of Van den Heuvel HLT Consultancy.</p>
        <p> Our office is in Malden near Nijmegen.</p>
        <p> Our KvK identification is 09205757. Theo van den Heuvel is the owner and manager.</p> -->
        <p class="icon-p">
          <img class="icon" src="<?php echo $prefix ?>/media/home_icon.png" alt="home icon">
          Rijksweg 112, 
          6581 ER Malden,            
          Netherlands
        </p>
        <a href="tel:+31625492788">
            <img class="icon" src="<?php echo $prefix ?>/media/telephone_icon.png" alt="telephone icon">
            +31625492788
        </a>
      </div>
  <?php
}
?>
</div>