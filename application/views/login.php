<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Codeigniter Template</title>

        <!-- Bootstrap -->
        <link href="/themes/default/css/bootstrap.min.css" rel="stylesheet">
        <link href="/themes/default/css/common.css" rel="stylesheet">
        <link href="/themes/default/css/login.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Codeigniter Template</a>
                </div>
                <div class="navbar-collapse collapse">
                </div>
            </div>
        </div>
        <div class="container wrapper">
            <form id="login" class="form-signin" action="/admin/dashboard">
                <h2 class="form-signin-heading">Please sign in</h2>
                <div class="username-div">
                    <input id='account' name='account' type="text" class="form-control" placeholder="Account" autofocus>
                </div>
                <div class="password-div">
                    <input id='password' name='password' type="password" class="form-control" placeholder="Password">
                </div>
                <div><span class="text-danger hidden"></span></div>
                <!--
                <label class="checkbox">
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
                -->
                <button class="btn btn-lg btn-primary" type="button" onclick='login()'>Sign in</button>
            </form>
        </div>
        <footer class="bs-footer" role="contentinfo">
            All Rights Reserved © 2015 ffbli
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/jquery-1.11.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
    </body>
</html>
<script>
$( document ).ready(function() {
    $('#login input').keyup(function( event ) {
        if (event.keyCode == 13) {
            login();
        }
    })
});

function login(){
    $.post("/api/auth/login", $( "#login" ).serialize(), function(data){
        console.log(data);
        if (data.status == "ERROR") {
            $('.text-danger').removeClass('hidden');
            $('.text-danger').html(data.msg);
            $('#account').focus();
        }
        else {
            window.location.href = 'admin/user';
        }
    }, "json");
}
</script>