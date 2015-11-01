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
                    <!--
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    -->
                    <a class="navbar-brand" href="#">Codeigniter Template</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><p class="navbar-text"><?= $account ?> (<a onclick='logout()' class="navbar-link">登出</a>)</p></li>
                    </ul>
                    <!--
                    <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form>
                    -->
                </div>
            </div>
        </div>
        <div class="container-fluid wrapper">
            <div class="row admin-container">
                <div class="col-sm-3 col-md-2 sidebar">
                    <ul class="nav nav-sidebar">
                        <!-- <li class="<?= $sidebar['dashboard'] ?>"><a href="/admin/dashboard"><?= $this->lang->line('home_page') ?></a></li> -->

                        <li class="<?= $sidebar['user'] ?>"><a href="/admin/user"><?= $this->lang->line('user_management') ?></a></li>
                    </ul>
                </div>
                <div class="col-sm-9 col-md-10 main">
                    <?php echo $html_main_content?>
                </div>
            </div>
        </div>
        <footer class="bs-footer" role="contentinfo">
            All Rights Reserved © 2015 ffbli
        </footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/jquery-1.11.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/common.js"></script>
    </body>
</html>
<script>
function logout(){
    $.post("/api/auth/logout", $( "#login" ).serialize(), function(data){
        window.location.href='/login';
    }, "json");
}
</script>
<?php echo $html_js ?>