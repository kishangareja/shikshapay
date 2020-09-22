<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= PROJECT_NAME; ?></title>
        <link rel="icon" href="<?= base_url('assets/frontend/icons/favicon.png'); ?>" type="image/png" sizes="16x16">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="<?= PROJECT_NAME; ?> for Fee Collection">
        <meta name="keywords" content="<?= PROJECT_NAME; ?>, Fee, Collection, Fee Collection">
        <link href="<?= base_url('assets/frontend/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/frontend/css/animate.css'); ?>"> <!-- Resource style -->
        <link rel="stylesheet" href="<?= base_url('assets/frontend/css/owl.carousel.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/frontend/css/owl.theme.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('assets/frontend/css/ionicons.min.css'); ?>"> <!-- Resource style -->
        <link href="<?= base_url('assets/frontend/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <script src="<?= base_url('assets/libs/jquery/jquery/dist/jquery.js'); ?>"></script>
    </head>
    <body>
        <div class="wrapper">
            <!-- Navbar Section -->
            <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
                <div class="container container-s">
                    <a class="navbar-brand" href="<?= base_url(); ?>"><?= PROJECT_NAME; ?></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-right">
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#products">Products</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#features">Features</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#reviews">Reviews</a></li>
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#pricing">Pricing</a></li>
                            <li class="nav-item"><a class="btn-cta nav-link js-scroll-trigger" href="#signup">Sign Up</a></li>
                        </ul>
                    </div>
                </div>
            </nav><!-- Navbar End -->