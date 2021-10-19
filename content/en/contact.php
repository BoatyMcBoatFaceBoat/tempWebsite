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
    'a' => array('2022') // calculate this!
  ),
  array(
    'q' => 'What year is last year (yyyy)?',
    'a' => array('2020') // calculate this!
  ),
  array(
    'q' => 'In the Peanuts cartoon, what is the name of the dog?',
    'a' => array('Snoopy') // here and everywhere ignore case
  ),
  array(
    'q' => 'The official language of France is ...?',
    'a' => array('French')
  ),
  array(
    'q' => 'King Arthur\'s castle is called ...?',
    'a' => array('Camelot')
  )
);
$captchaIndex = rand(0, count($captcha) - 1);
$_SESSION[$token]['captcha_answer'] = $captcha[$captchaIndex]['a'];
?>
<div>
  <h1>Contact</h1>
  <div class="contact flowText">
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

      <p>
        <input type="submit" value="Send"/>
      </p>
    </form>
  </div>
</div>