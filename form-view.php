<?php // This file is mostly containing things for your view / html ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <title>Party Catalogue</title>
</head> 
<?php if ($emailPopup = true) { ?>
<div class="alert alert-warning" role="alert">
  You didn't fill in the form correctly, please review your input.
</div>
<?php } ?>
<div class="container">
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <?php /*
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    */ ?>
    <form method="get">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control"/>
                <span class="error"><?php echo $emailError; ?></span>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input type="text" name="street" id="street" class="form-control">
                    <span class="error"><?php echo $streetError; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetNumber">Street number:</label>
                    <input type="text"  name="streetNumber" class="form-control">
                    <span class="error"><?php echo $streetNumberError; ?></span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" class="form-control">
                    <span class="error"><?php echo $cityError; ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input type="text" id="zipcode" name="zipcode" class="form-control">
                    <span class="error"><?php echo $zipcodeError; ?></span>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <hr>
            <legend>Products</legend>
            <hr>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" name="order" id="order" class="btn btn-primary">Order!</button>
    </form>

    <footer> <?php if ($totalValue < 0) { ?> You didn't order anything yet. <?php } ?> <?php if (isset($_GET['street'],$_GET['streetNumber'],$_GET['city'],$_GET['zipcode'])) { ?> 
    Your order has been received. <br>
    <hr>
    <br>
    This is your order, <?= $_GET['email'] ?>
    It will be delivered to you address: <?=$_GET['street']?>, number: <?=$_GET['streetNumber']?> <br>
    In <?=$_GET['city'] ?>, <?=$_GET['zipcode']?>. <?php } ?>
    <?php if ($totalValue > 0) { ?> You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in parties. <?php } ?> </footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
<script src="script.js"></script>
</body>
</html>
