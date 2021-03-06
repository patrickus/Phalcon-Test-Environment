<?php



define("ENCRYPTION_KEY", "!@#$%^&*");



/**

 * Returns an encrypted & utf8-encoded

 */

function encrypt($pure_string, $encryption_key) 

{

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);

    return $encrypted_string;

}



/**

 * Returns decrypted original string

 */

function decrypt($encrypted_string, $encryption_key) 

{

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);

    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);

    return $decrypted_string;

}



$message = '';

$code = '';



$string = "This is the original data string!";





if(isset($_POST['to_code']))

{

	$code = base64_encode(encrypt($_POST['message'], ENCRYPTION_KEY));

	$message = $_POST['message'];

}

elseif(isset($_POST['to_text']))

{

	$message = decrypt(base64_decode($_POST['code']), ENCRYPTION_KEY);

	$code = $_POST['code'];

}





?>



<form method="post" action="test.php">

Your message:<br/>

<textarea name="message"><?PHP echo $message; ?></textarea>

<input type="submit" name="to_code" value="To code"/>

<br/>

Code:<br/>

<textarea name="code"><?PHP echo $code; ?></textarea>

<input type="submit" name="to_text" value="To text" />

</form>






