<?php session_start();
$rand_token = openssl_random_pseudo_bytes(16);
$token = bin2hex($rand_token);
//$_SESSION['token'] = $token;

$captcha =  array(
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
<div class="contact">
  <div class="form">
    <h1>Contact</h1>
    <!-- <div class="contact flowText"> -->
    <form action="xyzzy.php" method="post">
      <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
      <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
      <p>Your name </p> 
      <input type="text" name="name" required="required" />
      <p>E-mail address</p> 
      <input type="email" name="email" required="required" />
      <p>Subject</p> 
      <input type="text" name="subject" required="required" />
      <p>Your message</p>
      <textarea name="message" rows="8" cols="35" required="required"></textarea>
      <p><?php echo $captcha[$captchaIndex]['q']; ?> </p>
      <input type="text" name="captcha" required="required" />

      <input class="btn" type="submit" value="Send"/>
    </form>
  </div>


  <div class="extra">
    <p> <?php echo $company; ?> is a trademark of Van den Heuvel HLT Consultancy.</p>
    <p> Our office is in Malden near Nijmegen.</p>
    <p> Our KvK identification is 09205757. Theo van den Heuvel is the owner and manager.</p>
    <p class="icon-p">
      <img class="icon" src="<?php
        if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
          echo '/tempWebsite';
        }
        ?>/media/home_icon.png" alt="address">  
       Rijksweg 112
    </p>
    <p class="icon-p"> 
      <img class="icon" src="<?php
        if(strpos($_SERVER['REQUEST_URI'], 'tempWebsite') !== false) {
          echo '/tempWebsite';
        }
      ?>/media/telephone_icon.png" alt="address">
      
     +31625492788
    </p>
  </div>
</div>