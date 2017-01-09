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
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/fork-me-icon.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <span id="forkongithub"><a href="https://github.com/tomasz-m/realmGenerator" target="_blank">Fork<br>me on<br>GitHub</a></span>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <nav class="navbar navbar-default navbar-fixed-top navbar-theme" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><b>realm</b> generator</a>
                </div>
                <div class="navbar-right">
                    <a class="navbar-text" href="about.html">About</a>
                </div>

            </div>
        </nav>

        <div style="padding-bottom: 0"class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <h1>Hello, lazy programmer!</h1>
                        <p>Here you can create files for <a href="http://realm.io" class="pink_text" target="_blank"><b>Realm</b></a> database for your android project with a <b>
                                single click</b> <br></p>
                        <p>You just need a JSON which describes the structure of your data.&nbsp;<br /> </p>

                        <br>
                        <div class="thumbnail pink_text">
                            <h4>Note</h4>
                            I've recently added <b>ObjectiveC</b> and <b>React Native</b> support. I'm not working with those language so I'm not sure if everything works fine 
                            and meets good standards. I'll be grateful for any feedback.<br>
                        </div>
                    </div>
                    <div class="col-md-2 side_text">
                        Tools that you might also find useful:<br>
                        <a class="btn btn-default side_text" role="button" target="blank" href="http://tomaszminiach.info/compareJsons/"
                           style="width: 130px; margin: 4px">
                            compare JSONs</a>
                        <a class="btn btn-default side_text" role="button" target="blank" href="http://tomaszminiach.info/pureJson/"
                           style="width: 130px; margin: 4px">
                            clear JSON</a>

                    </div> 
                </div>
            </div>
            <svg style="margin-top: -20" viewBox="0 0 1000 100">
            <path d="M 0 100 q 300 -120 1000 -20" stroke="#F25192"
                  stroke-width="2" fill="none" />
            <path d="M 0 90 q 100 -70 1000 -50" stroke="#FCC397"
                  stroke-width="2" fill="none" />
            <path d="M 0 70 q 400 -20 1000 -50" stroke="#D34CA3"
                  stroke-width="2" fill="none" />
            <path d="M 0 20 q 400 80 1000 20" stroke="#FC9F95"
                  stroke-width="2" fill="none" />  
            </svg>
        </div>

        <div class="container">

            <h2>Paste JSON here: </h2>
            <p><textarea id="inputArea" class="form-control" rows="12"  required></textarea></p>
            <div class="span12 centered-text">


                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="systems" value="ReactNative">
                        React Native <i>TEST</i></label>
                    <label class="btn btn-default active">
                        <input checked type="radio" name="systems" value="Android">
                        Android</label>
                    <label class="btn btn-default">
                        <input type="radio" name="systems" value="Swift">
                        Swift</label>
                    <label class="btn btn-default">
                        <input type="radio" name="systems" value="ObjectiveC">
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
                <div id="infoForAndroid" class="thumbnail">
                    
                    <h5>
                        If you are using GSON in your android project:
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
                    
                   
                    
                    <h5>Other:</h5>
                    <p>You can add Primary Key if you add <code>@</code> to a field name 
                        <i> (for example <code> "@Id":2 </code>)</i>.
                        It will also generate <code>equals</code> method (added by <a href="https://github.com/gotev">gotev<a>)</p>
                    
                    
                    <p>Package name
                        <input id="packageName" type="text" placeholder="com.android.example">
                        (its <u>optional</u> because Android Studio can add it automatically)
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
                        <h2 class="pink_text-cener">1</h2>
                        <p class="manual_text">Design a structure of your data in JSON. Or just get it from web service developer.</p>
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text-cener">2</h2>
                        <p class="manual_text">Use this website to generate java code.</p>                    
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text-cener">3</h2>
                        <p class="manual_text">Copy code to java class or download (and unzip) files and copy them <i>directly*</i> to Android Studio.</p>
                        <p class="manual_text"><i>* this will add package name automatically</i></p>
                    </div>
                    <div class="col-md-3">
                        <h2 class="pink_text-cener">4</h2>
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
            $('input:radio[name="systems"]').change(
            function(){
                if ($(this).is(':checked') && $(this).val() == 'Android') {
                    $("#infoForAndroid").show();
                }else{
                    $("#infoForAndroid").hide();
                }
            });
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
                                var exraMsg ="";
                                if(package.length > 0){
                                    exraMsg = "&packageName=" + package;
                                }
                                xmlhttp.send("tofile=1&json=" + encodeURIComponent(str) + "&system=" + selectedSystem + "&detectDateMode=" + detectDate
                                        + "&addSerializedNames=" + includeAnnotations
                                        + exraMsg);
                            }
                        }
        </script>
    </body>
</html>
