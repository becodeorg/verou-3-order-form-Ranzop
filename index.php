<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
/* only a variable of exact type of the “type declaration” will be accepted, 
or a TypeError will be thrown. The only exception to this rule is 
that an integer may be given to a function expecting a float. */



// We are going to use session variables so we need to enable sessions
/* session_start() creates a session or resumes the current one
 based on a session identifier passed via a GET or POST request, or passed via a cookie. */
session_start();

// Use this function when you need to have an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    pre_r($_GET);
    echo '<h2>$_POST</h2>';
    pre_r($_POST);
    echo '<h2>$_COOKIE</h2>';
    pre_r($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    pre_r($_SESSION);
}

whatIsHappening();



function pre_r($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


    $arr = array(1, 2, 3, 4);
foreach ($arr as &$value) {
    $value = $value * 2;
}
// $arr is now array(2, 4, 6, 8)
unset($value); // break the reference with the last element



// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Party for a birthday', 'price' => 250],
    ['name' => 'Party with regular people', 'price' => 200],
    ['name' => 'Underground party with music that scares you away', 'price' => 150],
    ['name' => 'Funk Party; Let\'s get that funk on', 'price' => 300],
    ['name' => 'Disco Party; Can\'t stop the disco madness', 'price' => 300],
    ['name' => 'Hip-Hop Party; Playing the songs we all know', 'price' => 350],
    ['name' => 'Rock Party; Keep on rocking in the free world', 'price' => 200],
    ['name' => 'Art Expo: Is it a cloud, or a bird?', 'price' => 50],
    ['name' => 'Night with live artists', 'price' => 50],
    ['name' => 'Street culture happening: Bboys, live-rap and beatbox', 'price' => 500],
    ['name' => 'Insert random workshop here', 'price' => 25],
    ['name' => 'Movie Night Out!', 'price' => 15]
];


// This function will display the contents of the multidimensional/associative array.
/* foreach($products as $product)
{
 foreach($product as $content)
{
echo $content ;
}

} */

$parties = [];
/* print_r($_GET); */

/* function getParties ($orders) {
for($i =0; $i < count($products); $i++ ) {
    if (!empty($_GET)) {

    print_r($_GET);
    
array_push($orders,
$products[$i]['name'],
$products[$i]['price']);
    }
}
} */

// setting some global variables

global $products, $totalValue;

for ($i = 0; $i < count($products); $i++){
    if(isset($_GET["products"][$i])) {
   $parties[] = $products[$i]["name"];
   $totalValue += $products[$i]["price"];
}
}
/* echo $totalValue;
print_r($parties); */

// This functions prints out all the products in a list (only the name of them).

/* function logProducts ($products) {
    for ($i = 0; $i < count($products); $i++){
    if(isset($_GET["products"][$i])) {
    echo "<ol>";
foreach ($products as $chosenProducts => $chosenProduct) {
    echo "<li>";
    print_r($chosenProduct['name']);
    echo "</li>";
}
echo"</ol>";
}}}
logProducts ($products); */

/* for ($i = 0; $i < count($products); $i++){
    if(isset($_GET["products"][$i])) {
        $partiesChoice[] = $products[$i]["name"];
    }
} */

// print_r($partiesChoice);
// this code can access the nested array; because of the print_r 
//&as opposed to echo, which can only return a string

/* 
print_r($products[1]['name']); */

// ipv die 1 kan je een for loop maken en de correcte $_GET krijgen (want die geven ook een waarde van 1)

/* echo $products['name']; */

/*  if (empty($_GET)) {
}
if (!empty($_GET)) {
    pre_r ($_GET);
} */



/* if (isset($_GET)) {
    echo $products['name'];
} */

// Checking the form validation:

// Step 1: create a function that adapts the input string to be suitable for our server to handle:
    // trim removes white space before and after the string
    // stripslashes removes a backslash from the string (if there are two, it leaves one)
    // htmlspecialchars transforms special HTML entities, so that they are displayed on the browser, but not activated
    // for example, it will show <b>bold</b> but not execute it, it converted it into only 'visual' elements
    // basically, this is setting up the data to be processed by the filter_var function.

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
// Step 2: define as many variables as there is validation, and set their contents to an empty string.

$email = $street = $streetNumber = $city = $zipCode = "";

// Step 3: apply testinput to the input we get from users.
// this returns errors, because the method is GET but, we don't have input yet
// therefore it tries to 'trim' NULL, which gets errors.


/* if (!empty($_GET)) {
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $email = test_input($_GET["email"]);
    $street = test_input($_GET["street"]);
    $streetNumber = test_input($_GET["streetNumber"]);
    $city = test_input($_GET["city"]);
    $zipCode = test_input($_GET["zipCode"]);
} 
} */

// Step 4: add span elements in correct places in html structure
// Step 5: create contents of error messages



/* validate(); */
// !!!! Only run all the validation in the handleForm,
// or, put a listener on the submit button
// You will have to use isset() for the button, 
// !empty will not work.
$emailError ="";
$streetError ="";
$streetNumberError ="";
$cityError ="";
$zipcodeError ="";
$emailPopup = false;

$errorMessageArray = [
    ['message' => '*Please fill in a valid e-mail address', 'target'=> 'email'],
    ['message' => 'The email address is incorrect', 'target'=> 'email'],
    ['message' => '*Please fill in a valid address', 'target'=> 'street'],
    ['message' => "*The given address is incorrect", 'target'=> "street"],
    ['message' => "*Please fill in a valid number", 'target'=> "streetnumber"],
    ['message' => "*This is not a valid number", 'target'=> "streetnumber"],
    ['message' => "*Please fill in a valid city", 'target'=> "city"],
    ['message' => "*This is not a valid city", 'target'=> "city"],
    ['message' => "*Please fill in a valid zipcode", 'target'=> "zipcode"],
    ['message' => "*This is not a valid zipcode", 'target'=> "zipcode"]
];

function checkEmail($x) {
if (isset($_GET["order"])){
    if (empty($_GET["email"])) {
        return true;
       
    } else if ($_GET["email"] == "") {
        $email = test_input($_GET["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
        }}  
        else {
            $email = test_input($_GET["email"]);
    // check if e-mail address is well-formed
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;}}}}

$emailPoPVerification = checkEmail($emailPopup);

function checkStreet($x){
    if (isset($_GET["order"])){
    if (empty($_GET["street"])) {
    return $x = "*Please fill in a valid address";
    } else if ($_GET["street"] == "") {
    $street = test_input($_GET["street"]);
    return $x = "*The given address is incorrect";
} 
        
$streetPoPVerification = checkStreet($streetError);


        if (empty($_GET["streetNumber"])) {
            $streetNumberError = "*Please fill in a valid number";
        } else {
            $streetNumber = test_input($_GET["street"]);
            // checking whether its an integer
            if (!filter_var($streetNumber, FILTER_VALIDATE_INT)){
            $streetError = "*This is not a valid number";
            }
        } 
        if (empty($_GET["city"])) {
            $cityError = "*Please fill in a valid city";
        } else {
            $city = test_input($_GET["street"]);
            $streetError = "*This is not a valid city";
        }  
        if (empty($_GET["zipcode"])) {
            $zipcodeError = "*Please fill in a valid zipcode";
        } else {
            $zipcode = test_input($_GET["zipcode"]);
            if (!filter_var($zipcode, FILTER_VALIDATE_INT)){
            $zipcodeError = "*This is not a valid zipcode";
            }
        }  
        }}


       
        echo $emailPoPVerification;
        echo $zipcodeError;
        
         



/* function checkForm ($x){
    echo $x;
if (isset($_GET["order"])){
    handleForm($x);
}
}
checkForm($emailPopup); */

function handleForm()
{
   
}


    // TODO: form related tasks (step 1)

    // Validation (step 2)
/*     $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
 */

// TODO: replace this if by an actual check
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
};

require 'form-view.php';