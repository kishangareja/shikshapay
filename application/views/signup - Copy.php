<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Shiksha Pay for Fee Collection">
        <meta name="keywords" content="shikshpay, fee collection">
        <title>Shiksha Pay</title>
        <!--<link rel="icon" type="image/png" href="https://zerodha.com/static/images/favicon.png">-->
        <link href="<?= base_url('assets/frontend/fonts.css'); ?>" rel="stylesheet" type="text/css">
        <link type="text/css" rel="stylesheet" href="<?= base_url('assets/frontend/main.css'); ?>">

        <!-- [head] -->
    </head>
    <!-- <body class=coin-banner-active> -->
    <body>
        <nav id="nav2" class="navbar">
            <div class="row container nav-responsive">
                <div class="three columns relative-section">
                    <a href="#">
                        Shiksha Pay 
                    </a> 
                </div>
                <div class="nine columns nav-active">
                    <ul class="navbar-links">
                        <li class="hide-on-small">
                            <a id="nav_acop" href="<?= base_url('signup'); ?>">Open an account</a>
                        </li>
                        <li class="hide-on-small">
                            <a href="#">Home</a>
                        </li>
                        <li class="hide-on-small">
                            <a href="#">About</a>
                        </li>
                        <li class="hide-on-small">
                            <a href="#">Contact</a>
                        </li>
                        <li class="hide-on-small">
                            <a href="#">Help & Support</a>
                        </li>
                    </ul>
                </div><!-- nav items //-->
            </div>
        </nav>

        <div class="account-open-sections acop-landing grey-back">
            <div class="mini-container">
                <div class="row">
                    <div class="five columns account-illus text-center">
                        <img style="width: 74%;" src="<?= base_url('assets/frontend/img/logo.png'); ?>" alt="">
                    </div>
                    <div class="seven columns center-on-mobile">
                        <form class="open-account-form-quick" id="zlm_add_lead" method="post" action="">
                            <h2>Open your account now</h2>
                            <p class="error_message" id="open_lead_response"></p>
                            <div class="row">
                                <div class="six columns">
                                    <input type="text" maxlength="40" id="user_name" placeholder="Full name" name="user_name" required="">
                                </div>
                                <div class="six columns">
                                    <input type="text" pattern="\d*" maxlength="15" id="user_mobile" placeholder="Mobile" name="user_mobile" required="">
                                </div>
                            </div>
                            <input type="email" maxlength="60" id="user_email" placeholder="Email" name="user_email">
                            <div class="open-account-submit-container">
                                <input type="submit" class="register-user" id="open_account_proceed_form" name="open_account_submit_1" value="Continue to signup"><br>
<!--                                <p>or</p>
                                <input type="submit" class="register-user button-outlined" id="open_account_callback" name="open_account_submit_2" value="Call me back"><br>-->
                                <a href="#" class="text-tiny">Already started your application? Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row open-account-ad center-on-mobile v-align">
                    <div class="five columns">
                        <h3 class="text-left">Join our growing community of 1+ million traders!</h3>				
                    </div>
                    <div class="seven columns">
                        <p>– The smartest trading technology and platforms</p>
                        <p>– ₹0 equity investments and flat ₹20 intraday trades</p>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <img src="<?= base_url('assets/frontend/img/spacer.gif'); ?>" alt="" height="0" width="0">
            <div class="container">
                <div class="columnsa">
                    <div class="column">
                        <b>Shiksha Pay</b>
                        <div class="desc gap multi-line footer-desc">
                            Shikshapay is the only payments solution in India which allows businesses to accept, process and disburse payments with its product suite. 
                            It gives you access to all payment modes including credit card, debit card, netbanking, UPI and popular wallets including JioMoney, 
                            Mobikwik, Airtel Money, FreeCharge, Ola Money and PayZapp.
                            <div class="line">
                                Manage Your marketplace, automate NEFT/RTGS/IMPS bank transfers, collect recurring payments, 
                                share invoices with customers - all from a single platform. Fast forward your business with Razorpay.
                            </div>

                        </div>
                        <div class="gap double"></div>
                        <p><strong>Subscribe to our newsletter</strong></p>
                        <div class="line">
                            <form class="btn-input active subscribe-form" action="">
                                <input type="email" required="" placeholder="Your email address" name="email">
                                <button class="btn-icon">Subscribe<i class="i-arrow-forward"></i></button>
                            </form>
                        </div><br>
                    </div>
                    <div class="column columnsa big">
                        <div class="column">
                            <ul>
                                <li><strong>Products</strong></li>
                                <li><a href="#">Payment Gateway</a></li>
                                <li><a href="#">Route</a></li>
                                <li><a href="#">Subscriptions</a></li>
                                <li><a href="#">Smart Collect</a></li>
                                <li><a href="#">Invoices</a></li>
                                <li><a href="#">Payment Links</a></li>
                                <li><a href="#">Razorpay Capital<span class="tag">NEW</span></a></li>
                                <li><a href="#">RazorpayX<span class="tag">NEW</span></a></li>
                                <li><a href="#">The X Club<span class="tag">NEW</span></a></li>
                            </ul>
                            <ul>
                                <li><strong>More</strong></li><li><a href="#">Pricing</a></li>
                                <li><a href="#">Flash Checkout</a></li>
                                <li><a href="#">Checkout Demo</a></li>
                                <li><a href="#">BharatQR</a></li>
                                <li><a href="#">UPI</a></li>
                                <li><a href="#">ePOS</a></li>
                                <li><a href="#">eCOD</a></li>
                            </ul>
                        </div>
                        <div class="column">
                            <ul>
                                <li><strong>Developers</strong></li>
                                <li><a href="#" target="_blank">Docs</a></li>
                                <li><a href="#">Integrations</a></li>
                                <li><a href="#" target="_blank">API Reference</a></li>
                            </ul>
                            <ul>
                                <li><strong>Resources</strong></li>
                                <li><a href="#">Blog</a></li>
                                <li><a href="#">Customer Stories</a></li>
                                <li><a href="#">Events</a></li>
                                <li><a href="#">Chargeback Guide</a></li>
                                <li><a href="#">Settlement Guide</a></li>
                            </ul>
                        </div>
                        <div class="column">
                            <ul>
                                <li><strong>Company</strong></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Careers<span class="tag">We're hiring!</span></a></li>
                                <li><a href="#">T&amp;C</a></li>
                                <li><a href="#">Privacy</a></li>
                                <li><a href="#">Responsible Disclosure</a></li>
                            </ul>
                            <ul>
                                <li><strong>Help &amp; Support</strong></li>
                                <li><a href="#" data-lytics="click" data-lytics-category="Website - Footer" data-lytics-action="Click - Support">Support</a></li>
                                <li><a href="#" data-lytics="click" data-lytics-category="Website - Footer" data-lytics-action="Click - Raise a request">Raise a request</a></li>
                                <li><a href="#" data-lytics="click" data-lytics-category="Website - Footer" data-lytics-action="Click - Track refund status">Track refund status</a></li>
                                <li><a href="#" data-lytics="click" data-lytics-category="Website - Footer" data-lytics-action="Click - File a grievance">File a grievance</a></li>
                                <li><a href="#" data-lytics="click" data-lytics-category="Website - Footer" data-lytics-action="Click - Knowledge base">Knowledge base</a></li>
                            </ul>
                            <ul>
                                <li><strong>Find us online</strong></li>
                                <li class="social-links">
                                    <a href="#" target="_blank">
                                        <div class="social facebook"></div>
                                    </a>
                                    <a href="#" target="_blank">
                                        <div class="social twitter"></div>
                                    </a>
                                    <a href="#" target="_blank">
                                        <div class="social instagram"></div>
                                    </a>
                                    <a href="#" target="_blank">
                                        <div class="social github"></div>
                                    </a>
                                    <a href="#" target="_blank">
                                        <div class="social linkedin"></div>
                                    </a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <div class="copyright">© <?= PROJECT_NAME . ' ' . date('Y'); ?><br>All Rights Reserved</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>