<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <style>
            .pink_text{
                color: #F0848B;
                text-align:center;
            }
            .manual_text{
                text-align:center;
            }
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
            .btn-realm {
                background: #F0848B;
                color: #ffffff;
                margin-left: 20px;
                margin-right: 20px;
                margin-top: 3px;
                width: 300px;
            }
            .centered-text {
                text-align:center;
            }    
            IMG.displayed {
                display: block;
                margin-left: auto;
                margin-right: auto; 
            }

        </style>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        
        <div class="container">
            
        <h3>Simple date conversion</h3>
        <p> It supports only date formats listed below  
            (<a href="http://php.net/manual/en/datetime.createfromformat.php">
                meaning of symbols (i, m, O etc) is explained here - it's used in php
            </a>)<p>
                
        <?php
        require './dateTest.php';
        foreach ($formats as $format)
        {
           echo "$format<br>";
        }
        ?>
        <h3>Advanced date conversion</h3>
        
        <p> It uses php's <a href="http://php.net/manual/en/function.strtotime.php"><code>strtotime</code></a> method to guess if string is a date (time & date).<p>
        <p> Thanks to that it supports a lot of formats. But it also treats string like <b><i>now</i></b> or <b><i>1 week</i></b> as date. <b>So be careful.</b>
</div>
    </body>
</html>
