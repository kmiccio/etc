<?php
            session_start();
            // DEFINE VARAIBLE DE SESSION
            if(isset($_GET["id"])){
                    $_SESSION['userSession'] = $_GET["id"];
            }
            if(isset($_GET["token"])){
                   $_SESSION['token'] = $_GET["token"];
            }
            // SE DEFINE IDIOMA DEL LOGIN => login.php?language=es
            if(isset($_GET["language"])){
                $language = $_GET["language"];
          
                if( strlen($language) == 0 ){
                    $language = "default"; /* <?php echo $language; ?> */ 
                    $_SESSION['language'] = "default";
                }else{
                    $_SESSION['language'] = $_GET["language"];
                }
    
            }else{
                    $language = "default"; /* <?php echo $language; ?> */  
                    $_SESSION['language'] = "default";
            }
            // SI LAS VARIABLES DE SESSION EXISTEN ENVIA A LA PAGINA DE EXITO
            if (isset($_SESSION['userSession'])!="") {
                    header("Location: index.php");
                    exit;
            }
            // DEFAULT LANGUAGE
            if( $language == "es" || $language == "default"){
                $titleText = "Title | Login"; /* <?php echo $titleText; ?> */
                $panelTitleText = "Ingreso usuarios registrados"; /* <?php echo $panelTitleText; ?> */
                $validEmailText = '"Ingresa un Email valido"'; /* <?php echo $validEmailText; ?> */
                $requiredText = '"Requerido"'; /* <?php echo $requiredText; ?> */
                $loginText = "Ingresar"; /* <?php echo $loginText; ?> */
                $lostPasswordText = "Recuperar Pasword"; /* <?php echo $lostPasswordText; ?> */
                $signupText = "Registrate"; /* <?php echo $signupText; ?> */         
                $errorText = "<label id='errorLabel'><font color='red'>Usuario no existe o password incorrecto</font></label>";  /* <?php echo $errorText; ?> */   
            }
            // OPTIONAL LANGUAGE ADD HERE
            if( $language == "en"){
                $titleText = "Title | Login";
                $panelTitleText = "Login";
                $validEmailText = '"Must be a valid email"';
                $requiredText = '"Required"';
                $loginText = "Login";
                $lostPasswordText = "Forgot Password?";
                $signupText = "Sign Up";
                $errorText = "<label id='errorLabel'><font color='red'>User don't exist or wrong password</font></label>";
            }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $titleText; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <!-- PAGE CONTAINER -->
    <div class="container">
        <!--  LOGIN CONTAINER -->
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <!-- FORM TITTLE -->
                    <div class="panel-heading">
                        <h3 class="panel-title"> <?php echo $panelTitleText; ?> </h3>
                    </div>
                    <!-- END FORM TITTLE -->

                    <!-- LOGIN FORM-->
                    <div class="panel-body">
                        <form role="form" novalidate id="form_login">
                            <fieldset>
                                <div class="form-group">
                                    <div class="control-group" id="errorText"> 
                                        <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" data-validation-email-message=<?php echo $validEmailText; ?> data-validation-required-message=<?php echo $requiredText; ?> required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <div class="control-group">   
                                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" 
                                        data-validation-required-message=<?php echo $requiredText; ?> required>
                                        <p class="help-block"></p>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-lg btn-success btn-block"><?php echo $loginText; ?>
                                    <i class="icon-ok icon-white"></i>
                                    </button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- EN LOGIN FORM -->
                </div>
            </div>
        </div>
        <!-- END LOGIN CONTAINER
         -->
        <!-- FORGOT & SIGNUP -->
        <div class="col-md-4 col-md-offset-4">
            <span class="pull-left">
            <a href="passwordRecovery.php?language=<?php echo $language; ?>"><?php echo $lostPasswordText; ?></a> 
            </span>
            <span class="pull-right">
                <a href="signup.php?language=<?php echo $language; ?>"><?php echo $signupText; ?></a>
            </span> 
        </div>
        <!-- END FORGOT & SIGNUP -->
    </div>
    <!-- END PAGE CONTAINER -->

    <!-- SCRIPTS -->
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqBootstrapValidation/1.3.7/jqBootstrapValidation.min.js"></script>
    <script>
                $("#form_login").find("input,textarea,select").jqBootstrapValidation({
                        preventSubmit: true,
                        submitError: function($form, event, errors) {
                            // alert("mall2")
                            // Here I do nothing, but you could do something like display 
                            // the error messages to the user, log, etc.
                        },
                        submitSuccess: function($form, event) {
                            // alert("OK");
                            event.preventDefault();
                            var email = $("#email").val();
                            var upass = $("#password").val();
                            // alert(email + " " + upass);

                            $.post("PATH/TO/systemLogin.php",{ type : "login", email : email, password : upass},function (data) {
                                // console.log(data);
                                if(data.status == 2){
                                    // alert(data.info);
                                    // location.reload();
                                    var url = window.location.href;    
                                    if (url.indexOf('?') > -1){
                                       url += '&id=' + data.id + '&token=' + data.token;
                                    }else{
                                       url += '?id=' + data.id + '&token=' + data.token;
                                    }
                                    window.location.href = url;
                                }

                                if(data.status == 99){
                                    // alert(data.error);
                                    $("#errorLabel").remove();
                                    $("<?php echo $errorText; ?>").prependTo("#errorText");
                               }
                            }); 
                        },
                        filter: function() {
                            return $(this).is(":visible");
                        } 
                    }
                );

    </script>
    <!-- END SCRIPTS -->
</body>

</html>
