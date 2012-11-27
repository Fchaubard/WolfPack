require 'src/facebook.php';

// Create our Application instance (replace this with your appId and secret).
$facebook = new Facebook(array(
  'appId'  => '210452582423240',
  'secret' => 'e6c1416257d02ed499a5cdbdc31f4a13',
));

// Get User ID
$uid = $facebook->getUser();

