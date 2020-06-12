<?php
    require_once './db/DBConnector.php';
    require_once './models/Sale.php';


    $salesResult = Sale::select();
    $sales =[];
    if ($salesResult['result']){
        $sales = $salesResult['data'];
    }
    $salesSumResult = Sale::sumPrices();
    $sum = 0;
    if ($salesSumResult ['result']){
        $sum= round($salesSumResult ['data']['sumPrices'],2);
    }
?>
<!DOCTYPE html>

<!--[if lt IE 7]>
<html class="lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->

<html>

    <!--<![endif]-->
    <!-- Head -->
    <head>

        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Title -->
        <title>home</title>
        <!-- Short-Cut Icon -->
        <link rel="shortcut icon" href="#"/>
        <!-- Google Web Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <!-- Font Awesome Version - 4.5.0 -->
        <link href="css/font-awesome.min.css" rel="stylesheet" media="all">
        <!-- Bootstrap Style Sheet Version - 3.3.6 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="all">
        <!-- Animation Style Sheet Version - 3.5.0  -->
        <link href="css/animate.min.css" rel="stylesheet" media="all">
        <!-- my style -->
        <link href="css/mystyle.css" rel="stylesheet"/>
        <!-- my style responsive -->
        <link href="css/responsive.css" rel="stylesheet"/>
        <style>
        </style>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="./index.php"">Rexx</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="./index.php"">Home <span class="sr-only">(current)</span></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <table class="table table-striped">
                <thead>
                <tr>
                    <td>Customer Name</td>
                    <td>Product Name</td>
                    <td>Price</td>
                    <td></td>
                </tr>
                <tr>
                    <form method="GET" action="./index.php">
                        <td>
                            <input name="customer_name" type="text" class="form-control">
                        </td>
                        <td>
                            <input name="product_name" type="text" class="form-control">
                        </td>
                        <td>
                            <input name="price" type="text" class="form-control">
                        </td>
                        <td>
                            <button class="btn btn-primary">Search <i class="fa fa-search"></i></button>
                        </td>
                    </form>
                </tr>
                </thead>
                <tbody>
                <?php
                    foreach ($sales as $sale){ ?>
                    <tr>
                        <td><?php echo $sale['customer_name'] ; ?></td>
                        <td><?php echo $sale['product_name'] ; ?></td>
                        <td><?php echo $sale['price'] ; ?></td>
                    </tr>
                <?php } ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td><span id="total_price">Total Price: </span><?php echo $sum; ?></td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- jQuery Version - 1.12.3 -->
        <script src="js/jquery-1.12.3.min.js"></script>
        <!-- Bootstrap JS File Version - 3.3.6 -->
        <script src="js/bootstrap.min.js"></script>
        <!-- my plugin -->
        <script src="js/myplugin.js"></script>
        <!-- nice scroll library -->
        <script src="js/jquery.nicescroll.min.js"></script>
        <!-- wow library -->
        <script src="js/wow.min.js"></script>
        <!-- trigger wow library -->
        <script>
            new WOW().init();
        </script>
    </body>

</html>
<!-- End -->