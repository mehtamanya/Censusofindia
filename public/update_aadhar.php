<?php
// Include Firebase SDK



require_once 'firebase-php/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/path/to/serviceAccountKey.json');
$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();

// Get Aadhar number from form
$aadhar = $_POST['aadhar'];

// Query Firebase to fetch user details based on Aadhar number
$userRef = $database->getReference('Census Entry')->orderByChild('aadharNo')->equalTo($aadhar)->getSnapshot();

// Check if user exists
if ($userRef->exists()) {
    // User exists, fetch user data
    $userData = $userRef->getValue();

    // Populate form fields with user data
    // For example:
    $name = $userData['name'];
    $headOfFamily = $userData['headOfFamily'];
    // Populate other fields similarly...

    // Now you can use these variables to populate the form fields in your HTML
} else {
    // User not found, handle error or display a message
}
?>
