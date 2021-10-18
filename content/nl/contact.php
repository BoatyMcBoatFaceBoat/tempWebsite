<?php session_start();
$rand_token = openssl_random_pseudo_bytes(16);
$token = bin2hex($rand_token);
//$_SESSION['token'] = $token;

$captcha =  array(
  array(
    'q' => 'Hoeveel oren heeft een konijn?',
    'a' => array('2', 'twee')
  ),
  array(
    'q' => 'Welke kleur buiten blauw en wit vindt je in de Nederlandse vlag?',
    'a' => array('rood')
  ),
  array(
    'q' => 'Welk jaar is het volgend jaar (yyyy)?',
    'a' => array('2022')
  ),
  array(
    'q' => 'Welk jaar was het afgelopen jaar (yyyy)?',
    'a' => array('2020')
  ),
  array(
    'q' => 'Welk dier verstopt met pasen eieren?',
    'a' => array('haas', 'paashaas')
  ),
  array(
    'q' => 'Ork ork ork, soep een je met een ...?',
    'a' => array('lepel', 'spork')
  ),
  array(
    'q' => 'In de Peanuts-strip, hoe heet de hond?',
    'a' => array('Snoopy')
  ),
  array(
    'q' => 'De officiële taal van Frankrijk is ...?',
    'a' => array('Frans')
  ),
  array(
    'q' => 'Het kasteel van koning Arthur heet ...?',
    'a' => array('Camelot')
  )
);
$captchaIndex = rand(0, count($captcha) - 1);
$_SESSION[$token]['captcha_answer'] = $captcha[$captchaIndex]['a'];
?>
<div class="contact">
  <div class="form">
    <h1> Contact</h1>
    <!-- <div class="contact flowText"> -->
    <form action="xyzzy.php" method="post">
      <!-- <input type="hidden" name="token" value="<?php echo $token; ?>" required="required" /> -->
      <?php echo '<input type="hidden" name="token" value="' . $token . '" required="required" />'; ?>
      <p>Uw naam </p> 
      <input type="text" name="name" required="required" />
      <p>E-mailaddres</p> 
      <input type="email" name="email" required="required" /></p>
      <p>Onderwerp</p> 
      <input type="text" name="subject" required="required" /></p>
      <p>Uw bericht</p> 
      <textarea name="message" rows="8" cols="35" required="required"></textarea></p>
      <p><?php echo $captcha[$captchaIndex]['q']; ?></p>
      <input type="text" name="captcha" required="required" />
    
      <input class="btn" type="submit" value="Verzend"/>
    </form>
  </div>
  <div class="extra">
    <p>Van den Heuvel HLT Consultancy handelt onder de naam Untangle.</p>
    <p>Ons kantoor bevindt zich in Malden vlakbij Nijmegen, in het oude Gemeentehuis.</p>
    <p> Ons KvK-nummer is 09205757. Theo van den Heuvel is de eigenaar.</p>
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


