<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Realm Generator</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><b>Realm</b> generator</a>
                </div>
                <div class="navbar-right">
                    <a class="navbar-text" href="about.html">About</a>
                </div>

            </div>
        </nav>

        <div class="jumbotron">
            <div class="container">
                <h1>Hello, lazy programmer!</h1>
                <p>Here you can create files for <a href="http://realm.io" style="color:#F0848B" target="_blank"><b>Realm</b></a> database for your android project with a <b>
                        single click</b> <br></p>
                <p>You just need a json which describes the structure of your data.&nbsp;<br /> </p>

                <br>
                <font color="#F0848B">
                <h4>Note</h4>
                There were some changes and on the website and new features are available.
                Everything should work but in case I've missed something 
                you can go to the  <a href="http://realmgenerator.eu/old/">old version</a>.</font>
            </div>
        </div>

        <div class="container">

            <h2>Paste JSON here: </h2>
            <p><textarea id="inputArea" class="form-control" rows="12"  required></textarea></p>
            <div class="span12 centered-text">


                <div class="btn-group" data-toggle="buttons">
                    <label disabled class="btn btn-default">
                        <input disabled type="radio" name="systems" value="ReactNative">
                        React Native</label>
                    <label class="btn btn-default active">
                        <input checked type="radio" name="systems" value="Android">
                        Android</label>
                    <label class="btn btn-default">
                        <input type="radio" name="systems" value="Swift">
                        Swift</label>
                    <label disabled class="btn btn-default">
                        <input disabled type="radio" name="systems" value="ObjectiveC">
                        Objective C</label>
                </div>
                <br><br>
                detect date in text fields <a href="dateConversionInfo.php" target="_blank"> INFO </a> <br>
                <div class="btn-group" data-toggle="buttons">
                    <!--<label>
                      <input id="detectDate" type="checkbox"> detect date in text fields <i>(beta)</i>
                    </label>-->
                    <label class="btn btn-default active">
                        <input checked type="radio" name="dateMode" value="0">
                        don't detect(normal)</label>
                    <label class="btn btn-default">
                        <input type="radio" name="dateMode" value="1">
                        simple mode </label>
                    <label class="btn btn-default">
                        <input disabled type="radio" name="dateMode" value="2">
                        advanced mode</label>
                </div>

                <br><br>
                <div class="thumbnail">
                    <h4>
                        For android project:
                    </h4>
                    <p><strike>Package name
                        <input id="packageName" type="text" placeholder="com.android.example" disabled>
                        (its <u>optional</u> because Android Studio can add it automatically)</strike>
                    </p>

                    <h5>
                        and if you are using GSON in your android project:
                    </h5>
                    <p>
                        <input id="includeAnnotation" type="checkbox"/>
                        add <code>@SerializedName("...")</code> annotations
                    </p>
                    <p>
                        <input id="gsonPrimitives" type="checkbox"/>
                        use classes <code>RealmInt</code> and <code>RealmString</code> for primitive arrays
                        <br>
                        <i>(you need then custom gson adapter like 
                            <a href="https://gist.github.com/jocollet/91d78da9f47922dc26d6" target="blank">this</a>)</i>
                    </p>
                </div>


                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

                <!-- realmgenerator_banner -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-1649995656725299"
                     data-ad-slot="6693669365"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script> 


                <p style="margin: 20px">
                    <a class="btn btn-realm" role="button" onclick="generate()">Generate code to copy (below)</a>
                    OR
                    <a class="btn btn-realm" role="button" onclick="generateZIP()">Generate code as files (ZIP)</a>
                    <br/>
                    <a class="btn btn-realm" role="button" id="download" style="visibility: hidden">DOWNLOAD ZIP</a>
                </p>

            </div>

            <!--<p> <span white-space: pre-wrap id="resultArea"></span></p> -->
            <p><textarea id="resultArea" class="form-control" rows="12"  required></textarea></p>

            <hr>
            <div class="centered-text">
                You can use this website in all its glory for <b>free</b>:). 
                If it helped you or save some of your valuable time and you feal the need to share same pennies then go on;).
                This will probably result in adding of swift and objective C support too.
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_donations">
                    <input type="hidden" name="business" value="makeitsmart.developer@gmail.com">
                    <input type="hidden" name="lc" value="US">
                    <input type="hidden" name="item_name" value="Make It Smart">
                    <input type="hidden" name="no_note" value="0">
                    <input type="hidden" name="currency_code" value="USD">
                    <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                </form>
            </div>


            <footer>
                <a href="mailto:tomasz.miniach@gmail.com"><p>&copy; Me 2015</p></a>
            </footer>
        </div> <!-- /container -->        

        <div class="jumbotron">

            <div class="container">
                <h1>Some help</h1>
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-3">
                        <h2 class="pink_text">1</h2>
                        <p class="manual_text">Design a structure of your data in Json. Or just get it from web service developer.</p>
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text">2</h2>
                        <p class="manual_text">Use this website to generate java code.</p>                    
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text">3</h2>
                        <p class="manual_text">Copy code to java class or download (and unzip) files and copy them <i>directly*</i> to Android Studio.</p>
                        <p class="manual_text"><i>* this will add package name automatically</i></p>
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text">4</h2>
                        <p class="manual_text">Done.</p>
                    </div>
                </div>
            </div>
        </div>

        <!--<IMG class="displayed" src="img/manual.png" class="centerImage" width="800">-->

        <?php
        include 'cleaner.php';
        ?>



        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.js"><\/script>')</script>

        <script src="js/vendor/bootstrap.min.js"></script>

        <script src="js/analitics.js"></script>

        <script>
            function generate() {
                str = document.getElementById("inputArea").value;
                if (str.length == 0) {
                    document.getElementById("resultArea").value = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("resultArea").value = xmlhttp.responseText;
                        }
                    }
                    xmlhttp.open("POST", "processor.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    var selectedSystem = $("input:radio[name ='systems']:checked").val();
                    var detectDate = $("input:radio[name ='dateMode']:checked").val();
                    var detectDate = $("input:radio[name ='dateMode']:checked").val();
                    var includeAnnotations = false;
                    if ($('#includeAnnotation').is(":checked"))
                    {
                        includeAnnotations = true;
                    }
                    var useGsonPrimitives = false;
                    if ($('#gsonPrimitives').is(":checked"))
                    {
                        useGsonPrimitives = true;
                    }
                    xmlhttp.send("json=" + encodeURIComponent(str) + "&system=" + encodeURIComponent(selectedSystem)
                            + "&detectDateMode=" + detectDate + "&addSerializedNames=" + includeAnnotations
                            + "&useGsonPrimitives=" + useGsonPrimitives);

                }

            }
            function generateZIP() {
                str = document.getElementById("inputArea").value;
                document.getElementById("download").style.visibility = "hidden";
                package = document.getElementById("packageName").value;
//                if(package.length == 0){
//                    document.getElementById("packageReminder").style.visibility = "visible";
//                }
                if (str.length == 0) {
                    document.getElementById("resultArea").value = "";
                    return;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200 && xmlhttp.responseText != null) {
                            if (xmlhttp.responseText.trim().substring(0, 6) == './data') {

                                document.getElementById("download").href = xmlhttp.responseText;
                                document.getElementById("download").style.visibility = "visible";
                            } else {
                                document.getElementById("resultArea").value = xmlhttp.responseText;
                            }

                        }
                    }
                    xmlhttp.open("POST", "processor.php", true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    var selectedSystem = $("input:radio[name ='systems']:checked").val();
                    var detectDate = $("input:radio[name ='dateMode']:checked").val();
                    var includeAnnotations = false;
                    if ($('#includeAnnotation').is(":checked"))
                    {
                        includeAnnotations = true;
                    }
                    xmlhttp.send("tofile=1&json=" + encodeURIComponent(str) + "&system=" + selectedSystem + "&detectDateMode=" + detectDate
                            + "&addSerializedNames=" + includeAnnotations);
                }
            }
        </script>
    </body>
</html>
