<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= PROJECT_NAME; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('assets/dist/css/AdminLTE.min.css'); ?>">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <style type="text/css" media="screen">
        h3.box-title.page_title {
            float: left;
        }
        a.pull-right.btn.btn-block.btn-primary.btn-flat.add_button {
            width: 15%;
        }
    </style>
    <body class="hold-transition skin-blue sidebar-mini">

        <!-- Content Wrapper. Contains page content -->
        <div class="">
            <!-- Main content -->
            <section class="content">
                <div class="error-page">
                    <h2 class="headline text-red">Access Denied</h2>
                    <div class="error-content">
                        <h3><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h3>
                    </div>
                </div><!-- /.error-page -->
            </section><!-- /.content -->
        </div>
    </body>
</html>