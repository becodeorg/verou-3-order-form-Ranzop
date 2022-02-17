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
echo $totalValue;
print_r($parties);




// this code can access the nested array; because of the print_r. 

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






function validate()
{
    // This function will send a list of invalid fields back
    return [];
}

function handleForm()
{
    // TODO: form related tasks (step 1)

    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check
$formSubmitted = false;
if ($formSubmitted) {
    handleForm();
}

require 'form-view.php';