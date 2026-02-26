<?php 

$setting = \App\Setting::first();
$snow = 0; 

?>
<?php if(\Auth::guest()): ?>
<?php $snow = 0;  ?>
<?php endif; ?>
<?php if(\Auth::user() && \Auth::user()->admin != 1): ?>
<?php $snow = 0;  ?>
<?php endif; ?>

<?php $snow = $setting->theme; ?>

<?php if(\Auth::user() && \Auth::user()->ban == 1): ?>
<?php echo $__env->make('errors.ban', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php exit() ?>
<?php endif; ?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($setting->name); ?></title>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <?php echo $setting->meta_tags; ?>

    <link rel="icon" type="image/svg+xml" href="/images/favicon.svg">
    <link rel="apple-touch-icon" sizes="64x64" href="/images/favicon.svg">
    <meta name="msapplication-TileImage" content="/images/favicon.svg">

    <link rel="stylesheet" href="/css/main.css?v=<?php echo e(time()); ?>">

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.2/socket.io.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <?php if($snow == 1): ?>
    <link rel="stylesheet" href="/css/snow.css?v=<?php echo e(time()); ?>">
    <script src="/js/snowfall.jquery.js" type="text/javascript"></script>
    <?php endif; ?>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-scrollbar@latest/simple-scrollbar.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="/js/modal.js" type="text/javascript"></script>
    <script src="/js/ripple.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/ripple.css">

    <script src="/js/countup.js?v=<?php echo e(time()); ?>" type="text/javascript"></script>


    <script
    src="https://hcaptcha.com/1/api.js?render=explicit"
    async
    defer
    ></script>

    <!-- Telegram widget removed - Configure your own bot in .env with TELEGRAM_BOT_NAME and TELEGRAM_AUTH_URL -->

</head> 

<?php echo $__env->make('layouts.colors_systems', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body class="theme--dark">

    <div class="winter" style="display:none;">
        <img src="images/snow/christmas.png" class="winter__bg" alt="">
        <img src="images/snow/christmas.png" class="winter__bg--2" alt="">
        <div class="winter__canvas">
            <canvas width="640" height="480" id="fireworks-canvas"></canvas>
            <canvas width="640" height="480" id="fireworks-canvas2"></canvas>
        </div>
        <div class="winter__wrapper d-flex align-center justify-center flex-column">
            <h3>Choose a gift</h3>
            <div class="winter__wrapper-inner">
                <div class="winter__item" onclick="disable('.winter__item');openWinter(1)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(2)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(3)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(4)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(5)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(6)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(7)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(8)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(9)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(10)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(11)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(12)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(13)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(14)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(15)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
                <div class="winter__item" onclick="disable('.winter__item');openWinter(16)">
                    <div class="winter__front d-flex align-center justify-center">
                        <span></span>
                    </div>
                    <div class="winter__back d-flex align-center justify-center">
                        <span>?</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="winter__snow"></div>
        <div class="winter__snow winter__snow--bottom"></div>
        <div class="winter__snow winter__snow--left"></div>
        <div class="winter__snow winter__snow--right"></div>
    </div>

    
    <div class="mobile-menu d-flex align-center">
        <nav class="mobile-menu__links d-flex align-center justify-space-between">
            <li style="margin-top: 7px;"><a class="btn_active btn_bonus" onclick="load('bonus')"><svg class="icon"><use xlink:href="images/symbols.svg#mobile_promo"></use></svg></a></li>
            <li style="margin-top: 7px;"><a href="#" id="chatBtn"><svg class="icon"><use xlink:href="images/symbols.svg#mobile_chat"></use></svg></a></li>
            <li><a class="btn_active btn_" onclick="load('')"><svg class="icon"><use xlink:href="images/symbols.svg#mobile_game"></use></svg></a></li>
            <li><a rel="popup" data-popup="popup--wallet"><svg class="icon"><use xlink:href="images/symbols.svg#mobile_wallet"></use></svg></a></li>
            <li><a href="#" id="moreBtn"><svg class="icon"><use xlink:href="images/symbols.svg#mobile_menu"></use></svg></a></li>
        </nav>
    </div>
    <div class="mobile-navbar d-flex flex-column">
        <li class="d-flex flex-column">
            <a onclick="$('#moreBtn').click();load('')" href='#'>Home</a>
            <a onclick="$('#moreBtn').click();load('bonus')">Bonuses</a>
            <a onclick="$('#moreBtn').click();load('refs')">Referrals</a>
            <a onclick="$('#moreBtn').click();load('faq')">FAQ</a>
            <a href="#" target="_blank">Support</a>
        </li>
    </div>
    <div class="preloader d-flex align-center justify-center">
        <div class="preloader__lift d-flex align-center justify-center">
            <div class="preloader__lift-container d-flex align-center justify-space-between">
                <div class="preloader__loader">
                   <svg width="120" height="160" viewBox="0 0 120 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M70 0L20 80H50L40 160L100 60H70L80 0H70Z" fill="url(#preloader-gradient)" stroke="#FFD700" stroke-width="2">
                       <animate attributeName="opacity" values="1;0.5;1" dur="1.5s" repeatCount="indefinite"/>
                     </path>
                     <defs>
                       <linearGradient id="preloader-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                         <stop offset="0%" style="stop-color:#FFD700;stop-opacity:1" />
                         <stop offset="50%" style="stop-color:#FFA500;stop-opacity:1" />
                         <stop offset="100%" style="stop-color:#FF6B00;stop-opacity:1" />
                       </linearGradient>
                     </defs>
                   </svg>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <div class="sidebar">
            <div class="sidebar__inner d-flex justify-space-between flex-column">
                <div class="sidebar__top">
                    <div class="sidebar__logotype">
                        <a onclick="load('')" href='#'></a>
                    </div>
                    <div class="sidebar__block sidebar__games  d-flex flex-column justify-center align-center">
                        <?php if($snow == 1): ?>
                        <img class="sidebar__img sidebar__img--1" src="images/snow/confetti/1.png">
                        <img class="sidebar__img sidebar__img--2" src="images/snow/confetti/2.png">
                        <img class="sidebar__img sidebar__img--3" src="images/snow/confetti/3.png">
                        <?php endif; ?>
                        
                        <a href="shoot" class="sidebar__game game_shoot d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg?v=5#hunt"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>CrazyShoot</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>
                        
                        <a onclick="load('x100')" class="sidebar__game game_x100 d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg#x100"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>X100</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>

                        <a onclick="load('x30')" class="sidebar__game  game_x30 d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg#x30"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>X30</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>

                        <a href="crash" class="sidebar__game  game_crash d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg#crash"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>Crash</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>
                        
                      
                        <a onclick="load('dice')" class="sidebar__game game_dice d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg#dice"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>Dice</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>

                        <a onclick="load('mines')" class="sidebar__game game_mines d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg#mines"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>Mines</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>

                        <a onclick="load('coinflip')" class="sidebar__game game_coinflip d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg?v=3#coinflip"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>Coin Flip</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>                  
                        <a onclick="load('keno')" class="sidebar__game game_keno d-flex justify-center align-center">
                            <div class="sidebar__game-center d-flex align-center justify-center align-center">
                                <svg class="icon"><use xlink:href="/images/symbols.svg?v=3#keno"></use></svg>
                            </div>
                            <div class="sidebar__game-name d-flex align-center flex-end">
                                <span>Keno</span>
                            </div>
                            <div class="sidebar__game--hover"></div>
                        </a>                                          

                        


                    </div>
                    <?php if(auth()->guard()->check()): ?>
                    <div class="sidebar__block sidebar__profile d-flex justify-center align-center flex-column">
                        <div class="sidebar__user-avatar" style="background: url(<?php echo e(\Auth::user()->avatar); ?>) no-repeat center center / cover;"></div>
                        
                    </div>
                    <?php endif; ?> 
                </div>
                <!-- Social links removed - Configure your own social media links -->
               
            </div>
        </div>
        <div class="header">
            <div class="wrapper d-flex align-center justify-space-between flex-wrap">
                <nav class="header__links d-flex align-center">
                    <li>
                        <a href="#" onclick="load('')" class="d-flex align-center">
                            <svg class="icon"><use xlink:href="images/symbols.svg#home"></use></svg>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="load('bonus')" class="d-flex align-center">
                            <svg class="icon"><use xlink:href="images/symbols.svg#giveaway"></use></svg>
                            <span>Bonuses</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="load('refs')" class="d-flex align-center">
                            <svg class="icon"><use xlink:href="images/symbols.svg#users"></use></svg>
                            <span>Referrals</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="load('faq')" class="d-flex align-center">
                            <svg class="icon"><use xlink:href="images/symbols.svg#faq"></use></svg>
                            <span>F.A.Q</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank" class="d-flex align-center">
                            <svg class="icon"><use xlink:href="images/symbols.svg#support"></use></svg>
                            <span>Support</span>
                        </a>
                    </li>
                </nav>
                <div class="header__right d-flex align-center">
                    <div class="sidebar__logotype flare">
                        <a href="#" onclick="load('')"></a>
                    </div>

                    <?php if(auth()->guard()->check()): ?>
                    <?php
                    $min_sort = \App\SystemDep::min('sort');
                    ?>
                    <div class="header__user d-flex align-center justify-space-between">
                        <div class="header__user-balance d-flex align-center">
                            <div class="header__user-b d-flex align-center">
                                <span id="balance" onclick="$('.wallet__method--sort-<?php echo e($min_sort); ?>_DEPOSIT').click();$('.wallet__method--Qiwi_WITHDRAW').click()" style="cursor:pointer;" rel="popup" data-popup="popup--wallet"></span>
                                <svg class="icon"><use xlink:href="images/symbols.svg#coins"></use></svg>
                            </div>
                            <div class="header__user-balance-add">
                                <a href="#" onclick="$('.wallet__method--sort-<?php echo e($min_sort); ?>_DEPOSIT').click();$('.wallet__method--Qiwi_WITHDRAW').click()" rel="popup" data-popup="popup--wallet" onclick="return false;" class="btn is-ripples flare d-flex align-center"><span>DEPOSIT</span></a>
                            </div>
                        </div>
                        <div class="header__user-profile d-flex align-center" id="dropdownUser">
                            <svg class="icon"><use xlink:href="images/symbols.svg#user"></use></svg>
                            <div class="header__user-dropdown d-flex flex-column">
                                <a href="#" class="header__user-dropdown--id d-flex align-center">
                                    <span>ID: <b><?php echo e(\Auth::user()->id); ?></b></span>
                                </a>
                                <a href="#" onclick="load('profile')" class="d-flex align-center">
                                    <svg class="icon"><use xlink:href="images/symbols.svg#user"></use></svg>
                                    <span>Profile</span>
                                </a>
                                <a href="#" rel="popup" data-popup="popup--coupon" onclick="return false;" class="d-flex align-center">
                                    <svg class="icon"><use xlink:href="images/symbols.svg#coupon"></use></svg>
                                    <span>Promo Codes</span>
                                </a>

                                <!-- <a href="#" id="darkTheme" onclick="return false;" class="d-flex align-center">
                                    <svg class="icon"><use xlink:href="images/symbols.svg?v=1#dark"></use></svg>
                                    <span>Dark Theme</span>
                                    <em>new</em>
                                </a>
                                <a href="#" id="lightTheme" onclick="return false;" class="d-flex align-center">
                                    <svg class="icon"><use xlink:href="images/symbols.svg?v=1#light"></use></svg>
                                    <span>Light Theme</span>
                                </a> -->
                                
                                <a href="logout" onclick="location.href='logout'" class="d-flex align-center">
                                    <svg class="icon"><use xlink:href="images/symbols.svg#exit"></use></svg>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <a href="#" rel="popup" data-popup="popup--auth" onclick="return false;" class="btn is-ripples btn--blue d-flex align-center flare"><span>LOGIN</span></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <script src="js/script.js?v=<?php echo e(time()); ?>" type="text/javascript"></script>

        <main id="_ajax_content_"><?php echo html_entity_decode($page); ?></main>

        <div class="footer">
            <div class="wrapper d-flex align-center justify-space-between flex-wrap">
                <nav class="footer__links d-flex align-center">
                    <li class="footer__link">
                        <a href="#" onclick="load('terms')">Terms</a>
                    </li>
                    <li class="footer__link">
                        <a href="#" onclick="load('policy')">Privacy Policy</a>
                    </li>
                </nav>
                <div class="footer__text"><span>BLITZ CASINO © ALL RIGHTS RESERVED.</span></div>
            </div>
        </div>
        <?php echo $__env->make('layouts.chat', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="overlayed">

        <?php if(auth()->guard()->guest()): ?>
        <div class="popup popup--auth" style="max-width:350px">
            <div class="popup__title d-flex align-center justify-space-between">
                <span>Login</span>
                <a href="#" class="close d-flex align-center justify-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
                </a>
            </div>
            <div class="popup__content">
                <div class="auth_blocks">
                    <a href="/google_auth" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>GOOGLE</span></a>
                </div>
                
            </div>
        </div>
        
        <?php endif; ?>
       
        <div class="popup popup--crash-info">
            <div class="popup__title d-flex align-center justify-space-between">
                <span>Crash Mode</span>
                <a href="#" class="close d-flex align-center justify-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
                </a>
            </div>
            <div class="popup__content">
                <p>Crash - an online game, and like all online games has disadvantages related to the network</p>
                <div class="text__borders"></div>
                <p>The speed of manual withdrawal execution (the "Withdraw Money" button), the display of the chart on the page, directly depends on the following factors:</p>
                <ol class="show_ul">
                    <li>Your internet connection speed</li>
                    <li>Ping to the server (Latency / Delay)</li>
                    <li>The power of your smartphone or computer (used to process chart data and display it)</li>
                    <li>Response time from our server</li>
                </ol>


                <div class="text__borders"></div>
                <p> 
                    BLITZ CASINO does not guarantee timely execution of manual withdrawal after pressing (the "Withdraw Money" button) and strongly recommends using the automatic withdrawal function (the "Auto-withdraw" field).
                </p>
                <div class="text__borders"></div>
                <p>
                The "Auto-withdraw" function is used on the server side, which reduces the risk of problems related to timely withdrawal by 99.9%</p>
                <br>
                <div class="bx-input">
                    <a onclick="localStorage.setItem('crashAgree', 'true');;$('.close').click()" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>I have read this. Close</span></a>
                </div>

            </div>
        </div>

        <?php if(auth()->guard()->check()): ?>
        <div class="popup popup--demo-add">
            <div class="popup__title d-flex align-center justify-space-between">
                <div class="popup__tabs d-flex align-center">
                    <div class="popup__tab popup__tab--active d-flex align-center">
                        <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                        <span>Demo balance top-up</span>
                    </div>
                    
                </div>
                <a href="#" class="close d-flex align-center justify-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
                </a>
            </div>
            <div class="popup__content">
                <div class="wallet  d-flex align-stretch justify-space-between flex-wrap">



                    <div class="wallet__content d-flex flex-column justify-space-between" style="width:100%">
                        <div class="wallet__content-top">
                           <div class="bx-input d-flex flex-column">
                            <div class="bx-input__input d-flex align-center justify-space-between">
                                <label class="d-flex align-center">Top-up amount:</label>
                                <div class="d-flex align-center">
                                    <input type="text" id="add_balance"  placeholder="0.00">
                                    <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="wallet__content-bottom" style="margin-top:10px;">
                        <div class="wallet__order d-flex justify-space-between align-center">
                            <div class="wallet__txt d-flex flex-column">

                                <b class="d-flex align-center">Total to pay: <span class="d-flex align-center"><b class="">0</b> <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg></span></b>
                            </div>
                            <a onclick="addDemoBalance()" class="btn is-ripples flare btn--blue d-flex align-center"><span>DEPOSIT</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup popup--wallet">
        <div class="popup__title d-flex align-center justify-space-between">
            <div class="popup__tabs d-flex align-center">
                <div class="popup__tab popup__tab--active d-flex align-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                    <span>Deposit</span>
                </div>
                <div class="popup__tab d-flex align-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#minus"></use></svg>
                    <span>Withdrawal</span>
                </div>
                <div class="popup__tab d-flex align-center">
                    <svg class="icon"><use xlink:href="images/symbols.svg#timer"></use></svg>
                    <span>History</span>
                </div>
            </div>
            <a href="#" class="close d-flex align-center justify-center">
                <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
            </a>
        </div>
        <script type="text/javascript">
            function setSystemDep(id){
                $('#systemDep').val(id)
            }
        </script>
        <div class="popup__content">
            <div class="wallet wallet--refill d-flex align-stretch justify-space-between flex-wrap">
                <div class="wallet__methods">
                    <div class="wallet__scroll" ss-container>
                        <?php
                        $systemDeps = \App\SystemDep::orderBy('sort', 'asc')->orderBy('id', 'asc')->where('off', 0)->get();

                        ?>
                        <?php $__currentLoopData = $systemDeps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div onclick="setSystemDep(<?php echo e($s->id); ?>)" class="wallet__method wallet__method--sort-<?php echo e($s->sort); ?>_DEPOSIT wallet__method--<?php echo e($s->id); ?>_DEPOSIT d-flex align-center">
                            <img src="<?php echo e($s->img); ?>">
                            <div class="d-flex flex-column">
                                <span><?php echo e($s->name); ?></span>
                                <b><?php echo e($s->comm_percent); ?>%</b>
                            </div>
                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>

                <input type="hidden" id="systemDep" name="">
                <div class="wallet__content d-flex flex-column justify-space-between">
                    <div class="wallet__content-top">
                        <div class="bx-input d-flex flex-column">
                            <div class="bx-input__input d-flex align-center justify-space-between">                       
                                    <input type="text" style="text-align: left;" id="sumDep" onkeyup="$('.payDep').html($('#sumDep').val())" placeholder="ENTER AMOUNT">
                                    <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                            </div>
                        </div>
                        
                    <div class="x30__bet-placed d-flex align-center justify-space-between payments">
                        <a onclick="$('#sumDep').val((Number($('#sumDep').val()) + 10).toFixed(2));">+10</a>
                        <a onclick="$('#sumDep').val((Number($('#sumDep').val()) + 100).toFixed(2));">+100</a>
                        <a onclick="$('#sumDep').val((Number($('#sumDep').val()) + 1000).toFixed(2));">+1000</a>
                        <a onclick="$('#sumDep').val((Number($('#sumDep').val()) * 2).toFixed(2));">x2</a>
                        <a onclick="$('#sumDep').val(Math.max((Number($('#sumDep').val()) / 2), 1).toFixed(2));">1/2</a>
                    </div> 

                        <div class="bx-input d-flex flex-column">
                            <div class="bx-input__input d-flex align-center justify-space-between">
                                <input type="text" style="text-align: left;" id="promoDep" placeholder="ENTER PROMO CODE">
                            </div>
                        </div>

                        <div class="d-flex align-center justify-space-between">
                            <div class="wallet__txt"><span class="d-flex align-center">Commission: 0%</span></div>
                        </div>
                    </div>
                    <div class="wallet__content-bottom">
                        <div class="wallet__order d-flex justify-space-between align-center">
                            <div class="wallet__txt d-flex flex-column">
                                
                                <b class="d-flex align-center">Total to pay: <span class="d-flex align-center"><b class="payDep">0</b> <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg></span></b>
                            </div>
                            <a onclick="disable(this);goDeposit(this)" class="btn is-ripples flare btn--blue d-flex align-center"><span>DEPOSIT</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                
            </script>
            <script type="text/javascript">
                function setSystemW(id, comm_percent, comm_rub, min_sum){
                    $('#systemW').val(id)
                    $('#min_sum_withdraws').html(min_sum)
                    $('#comm_percent').val(comm_percent)
                    $('#comm_rub').val(comm_rub)
                    updateW()
                }
            </script>
            <div class="wallet wallet--withdraw d-flex align-stretch justify-space-between flex-wrap">
                <div class="wallet__methods">
                    <div class="wallet__scroll" ss-container>
                     <?php
                     $SystemWithraws = \App\SystemWithdraw::all();

                     ?>
                     <?php $__currentLoopData = $SystemWithraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <div onclick="setSystemW(<?php echo e($s->id); ?>, <?php echo e($s->comm_percent); ?>, <?php echo e($s->comm_rub); ?>, <?php echo e($s->min_sum); ?>)" class="W wallet__method wallet__method--<?php echo e($s->name); ?>_WITHDRAW d-flex align-center">
                        <img src="<?php echo e($s->img); ?>">
                        <div class="d-flex flex-column">
                            <span><?php echo e($s->name); ?></span>
                            <b><?php echo e($s->comm_percent); ?>% <?php if($s->comm_rub > 0): ?> + <?php echo e($s->comm_rub); ?>P  <?php endif; ?></b>
                        </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <input type="hidden" id="systemW" name="">
            <input type="hidden" id="comm_rub" name="">
            <input type="hidden" id="comm_percent" name="">
            <div class="wallet__content d-flex flex-column justify-space-between">
                <div class="wallet__content-top">
                    <div class="bx-input d-flex flex-column">
                        <div class="bx-input__input d-flex align-center justify-space-between">
                            
                                <input type="text" style="text-align: left;" id="sum_withdraw" onkeyup="$('#sum_itog_pay').html($('#sum_withdraw').val());updateW()" placeholder="ENTER WITHDRAWAL AMOUNT">
                                <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                            
                        </div>
                    </div>
                    <div class="bx-input d-flex flex-column">
                        <div class="bx-input__input d-flex align-center justify-space-between">
                            <label class="d-flex align-center">Will be credited:</label>
                            <div class="d-flex align-center">
                                <span class="bx-input__text" id="get_withdraw"></span>
                                <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                            </div>
                        </div>
                    </div>
                    <div class="bx-input d-flex flex-column">
                        <div class="bx-input__input d-flex align-center justify-space-between">
                            
                                <input style="text-align: left;"  type="text" id="wallet_withdraw" placeholder="ENTER WALLET DETAILS">
                            
                        </div>
                    </div>
                </div>
                <div class="wallet__content-bottom">
                    <div class="wallet__order d-flex justify-space-between align-center">
                        <div class="wallet__txt d-flex flex-column">
                            <span class="d-flex align-center">Min. withdrawal: &nbsp;<span id="min_sum_withdraws">50</span> <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg></span>
                            <b class="d-flex align-center">To withdraw: <span class="d-flex align-center"><span class="sum_itog_pay" id="sum_itog_pay">100</span> <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg></span></b>
                        </div>
                        <a onclick="disable(this);goWithdraw(this)" class="btn is-ripples flare btn--red d-flex align-center"><span>WITHDRAW</span></a>
                    </div>
                    <div class="wallet__order d-flex justify-space-between align-center">
                        <div class="wallet__txt d-flex flex-column">
                            <span class="d-flex align-center">Maximum bonus withdrawal: &nbsp;<span><?php echo e(in_array($u->status, [0, 1]) ? 300 : ($u->status == 2 ? 500 : ($u->status == 3 ? 600 : ($u->status == 4 ? 750 : ($u->status == 5 ? 1000 : 2000))))); ?></span> <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg></span>
                        </div></div>
                    </div>
                </div>
            </div>
            <?php if(auth()->guard()->check()): ?>
            <div class="wallet wallet--history d-flex flex-column justify-center align-center">
                <div class="wallet__tabs d-flex align-center">
                    <div class="wallet__tab wallet__tab--active d-flex align-center">
                        <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                        <span>Deposits</span>
                    </div>
                    <div class="wallet__tab d-flex align-center">
                        <svg class="icon"><use xlink:href="images/symbols.svg#minus"></use></svg>
                        <span>Withdrawals</span>
                    </div>
                </div>
                <div class="wallet__history wallet__history--refill">
                    <?php
                    $deps = \App\Payment::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(10)->get();

                    ?>

                    <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="wallet__history-item d-flex justify-space-between align-center">
                        <div class="wallet__history-left d-flex align-center">
                         <div class="wallet__method d-flex align-center">
                            <img src="<?php echo e($d->img_system); ?>">
                            <?php
                            $system_dep = \App\SystemDep::where('img', $d->img_system)->first();
                            ?>
                            <span><?php if($system_dep): ?><?php echo e($system_dep->name); ?><?php endif; ?></span>
                        </div>
                        <div class="wallet__history-sum d-flex align-center">
                            <span><?php echo e($d->sum); ?></span>
                            <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                        </div>
                    </div>
                    <div class="wallet__history-status <?php if($d->status == 0): ?> warning <?php else: ?> success <?php endif; ?>">
                        <span><?php if($d->status == 0): ?> Waiting... <?php else: ?> Success <?php endif; ?></span>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



            </div>
            <div class="wallet__history wallet__history--withdraw">

                <?php
                $withdraws = \App\Withdraw::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->limit(10)->get();

                ?>

                <?php $__currentLoopData = $withdraws; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="wallet__history-item d-flex justify-space-between align-center">
                    <div class="wallet__history-left d-flex align-center">
                        <div class="wallet__method d-flex align-center">
                            <img src="<?php echo e($w->img_system); ?>">
                            <?php
                            $system_w = \App\SystemWithdraw::where('img', $w->img_system)->first();
                            ?>
                            <span><?php if($system_w): ?><?php echo e($system_w->name); ?><?php endif; ?></span>
                        </div>
                        <div class="wallet__history-sum d-flex align-center">
                            <span><?php echo e($w->sum); ?></span>
                            <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                        </div>
                    </div>
                    <div id="statusW_<?php echo e($w->id); ?>" class="wallet__history-status  <?php if($w->status == 0): ?> warning <?php elseif($w->status == 2): ?> error <?php elseif($w->status == 1): ?> success  <?php elseif($w->status == 3 || $w->status == 4): ?> warning <?php else: ?> error <?php endif; ?> ">
                        <span ><?php if($w->status == 0): ?> Waiting... (<a onclick="disable(this);canselWithdraw(<?php echo e($w->id); ?>, this)">Cancel</a>)<?php elseif($w->status == 2): ?> Cancelled <?php elseif($w->status == 1): ?> Success  <?php elseif($w->status == 3): ?> Awaiting sending <?php elseif($w->status == 4): ?> Sent <?php else: ?> Error <?php endif; ?></span>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div> 
        </div>


        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php if(auth()->guard()->check()): ?>
<?php if(\Auth::user()->admin == 1): ?>
<div class="popup popup--gokeno">
    <div class="popup__title d-flex align-center justify-space-between">
        <div class="popup__tabs d-flex align-center">
            <div class="popup__tab popup__tab--active d-flex align-center">
                <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                <span>Keno adjustment</span>
            </div>

        </div>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="wallet  d-flex align-stretch justify-space-between flex-wrap">



            <div class="wallet__content d-flex flex-column justify-space-between" style="width:100%">
                <div class="wallet__content-top">
                    <div class="bx-input d-flex  align-stretch justify-space-between ">
                        <div class="bx-input__input d-flex align-center justify-space-between">
                            <label class="d-flex align-center">N-1:</label>
                            <div class="d-flex align-center">
                                <input type="text" id="kenoGo1"   placeholder="0">

                            </div>
                        </div>
                        <div class="bx-input__input d-flex align-center justify-space-between">
                            <label class="d-flex align-center">N-2:</label>
                            <div class="d-flex align-center">
                                <input type="text" id="kenoGo2"   placeholder="0">

                            </div>
                        </div>
                        <div class="bx-input__input d-flex align-center justify-space-between">
                           <label class="d-flex align-center">N-3:</label>
                           <div class="d-flex align-center">
                            <input type="text" id="kenoGo3"   placeholder="0">

                        </div>
                    </div>

                </div>

                <div class="bx-input d-flex  align-stretch justify-space-between ">
                    <div class="bx-input__input d-flex align-center justify-space-between">
                        <label class="d-flex align-center">N-4:</label>
                        <div class="d-flex align-center">
                            <input type="text" id="kenoGo4"   placeholder="0">

                        </div>
                    </div>
                    <div class="bx-input__input d-flex align-center justify-space-between">
                        <label class="d-flex align-center">N-5:</label>
                        <div class="d-flex align-center">
                            <input type="text" id="kenoGo5"   placeholder="0">

                        </div>
                    </div>
                    

                </div>            



            </div>
            <div class="wallet__content-bottom" style="margin-top:10px;">
                <div class="wallet__order d-flex justify-space-between align-center">
                    <div class="wallet__txt d-flex flex-column">

                    </div>
                    <a onclick="kenoGo()" class="btn is-ripples flare btn--blue d-flex align-center"><span>Adjust</span></a>
                </div>
            </div>

            <div class="text__borders"></div>

            <div class="wallet__content-top">
                <div class="bx-input d-flex  align-stretch justify-space-between ">
                    <div class="bx-input__input d-flex align-center justify-space-between">
                        <label class="d-flex align-center">Number:</label>
                        <div class="d-flex align-center">
                            <input type="text" id="kenoBonusNumber"   placeholder="0">

                        </div>
                    </div>
                    <div class="bx-input__input d-flex align-center justify-space-between">
                        <label class="d-flex align-center">X:</label>
                        <div class="d-flex align-center">
                            <input type="text" id="kenoBonusCoeff"   placeholder="0">

                        </div>
                    </div>


                </div>



            </div>
            <div class="wallet__content-bottom" style="margin-top:10px;">
                <div class="wallet__order d-flex justify-space-between align-center">
                    <div class="wallet__txt d-flex flex-column">

                    </div>
                    <a onclick="kenoGoBonus()" class="btn is-ripples flare btn--blue d-flex align-center"><span>Adjust bonus</span></a>
                </div>
            </div>

        </div>
    </div>
</div>
</div>

<script type="text/javascript">
    function kenoGo(){

        $.post('/keno/go',{_token: csrf_token, 
            kenoGo1: $('#kenoGo1').val(),
            kenoGo2: $('#kenoGo2').val(),
            kenoGo3: $('#kenoGo3').val(),
            kenoGo4: $('#kenoGo4').val(),
            kenoGo5: $('#kenoGo5').val(),
            
            
        }).then(e=>{

            if(e.success){      

                notification('success','Success')
            }
            if(e.error){       
                notification('error',e.error)
            }
        }).fail(e=>{
            notification('error',JSON.parse(e.responseText).message)
        })  
    }

    function kenoGoBonus(){

        $.post('/keno/bonusgo',{_token: csrf_token, 
            kenoBonusNumber: $('#kenoBonusNumber').val(),
            kenoBonusCoeff: $('#kenoBonusCoeff').val(),
        }).then(e=>{
            if(e.success){     

                notification('success','Success')
            }
            if(e.error){       
                notification('error',e.error)
            }
        }).fail(e=>{
            notification('error',JSON.parse(e.responseText).message)
        })  
    }
</script>
<?php endif; ?>

<?php endif; ?>




<div class="popup popup--coupon">
    <div class="popup__title d-flex align-center justify-space-between">
        <div class="popup__tabs d-flex align-center">
            <div class="popup__tab popup__tab--active d-flex align-center">
                <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                <span>Promo Code</span>
            </div>

        </div>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="bx-input d-flex align-center justify-space-between promocodeInputBlock">
            <div class="bx-input__input promocodeInput d-flex align-center justify-space-between">
                
                
                    <input type="text" style="text-align: left;" id="promo_name" placeholder="ENTER PROMO CODE">
                    
            </div>

            <a onclick="disable(this);actPromo(this)" class="btn is-ripples flare btn--blue d-flex align-center justify-center promocodeInputBtn"><span>Activate</span></a>

            
        </div>
        <div class="tournier__separate"></div>
        <div class="bx-input">
            <div class="bx-input__create-coupon">
                <div class="bx-input__input d-flex align-center justify-space-between">
                    
                        <input type="text"  style="text-align: left;" id="name_crpromo" placeholder="PROMO CODE">
                   
                </div>
                <div class="bx-input__input d-flex align-center justify-space-between">
                    
                        <input style="text-align: left;"  type="text" id="sum_crpromo" placeholder="AMOUNT">
                        <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                    
                </div>
            </div>
            <div class="bx-input__create-coupon">
                <div class="bx-input__input d-flex align-center justify-space-between">
                    
                        <input type="text" style="text-align: left;" placeholder="NUMBER OF ACTIVATIONS" id="act_crpromo" placeholder="0.00">
                        <svg class="icon money"><use xlink:href="images/symbols.svg#users"></use></svg>
                   
                </div>
                <a onclick="disable(this);createPromoUser(this)" style="height: 55px;" class="btn is-ripples flare btn--red d-flex align-center justify-center" ><span>Create</span></a>
            </div>
            
        </div>
    </div> 
</div>
<div class="popup popup--send">
    <div class="popup__title d-flex align-center justify-space-between">
        <div class="popup__tabs d-flex align-center">
            <div class="popup__tab popup__tab--active d-flex align-center">
                <svg class="icon"><use xlink:href="images/symbols.svg#minus"></use></svg>
                <span>Fund Transfer</span>
            </div>
            <div class="popup__tab d-flex align-center" rel="popup" data-popup="popup--coupon">
                <svg class="icon"><use xlink:href="images/symbols.svg#plus"></use></svg>
                <span>Promo Code</span>
            </div>
        </div>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="bx-input">
            <div class="bx-input__create-coupon">
                <div class="bx-input__input d-flex align-center justify-space-between">
                    <label class="d-flex align-center">Player ID:</label>
                    <div class="d-flex align-center">
                        <input type="text" placeholder="ID">
                    </div>
                </div>
                <div class="bx-input__input d-flex align-center justify-space-between">
                    <label class="d-flex align-center">Amount:</label>
                    <div class="d-flex align-center">
                        <input type="text" placeholder="0.00">
                        <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                    </div>
                </div>
            </div>
            <div class="bx-input__btn d-flex align-center">
                <a href="#" class="btn is-ripples flare btn--blue d-flex align-center"><span>Transfer</span></a>
                <div class="history__user d-flex align-center justify-center" style="margin-left: 10px">
                    <div class="history__user-avatar" style="background: url(https://sun1-47.userapi.com/s/v1/ig2/XpJjGMiNkluJe92SSJXtnBchRcr51JMc6-9JVxZO3ZMbCRjtmbKCjmpTRq_2_0cOZ6dVShhXRrA8i381ORNssVHX.jpg?size=200x200&amp;quality=95&amp;crop=31,8,944,944&amp;ava=1) no-repeat center center / cover;"></div>
                    <span>John Smith</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup popup--promo-history">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Promo Code History</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="wallet__history">
            <div class="wallet__history-item d-flex justify-space-between align-center">
                <div class="wallet__history-left d-flex align-center">
                    <span style="font-weight: 600;margin-right: 20px;">7W8J9K0Q2G2O0A</span>
                    <div class="wallet__history-sum d-flex align-center">
                        <span>2 / 25 </span>
                        <svg class="icon money"><use xlink:href="images/symbols.svg#users"></use></svg>
                    </div>
                </div>
                <div class="wallet__history-status">
                    <span>Remaining: 3 activations</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(auth()->guard()->check()): ?>
<div class="popup popup--tg popup--about">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Telegram</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <p>To link your account, send the following message to our bot:</p>
        <div class="borders"></div>
        <p onclick="copyText(this)" style="text-align:center;width: 100%;font-size:18px;font-weight: 600;">/bind <?php echo e(\Auth::user()->id); ?></p>
        <div class="borders"></div>
        <a onclick="disable(this);checkTgConnect(this)" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Check Link</span></a>
    </div>
</div>
<?php endif; ?>
<div class="popup popup--refill popup--about">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Deposit</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="bx-input">
            <div class="bx-input__input d-flex align-center justify-space-between">
                <label class="d-flex align-center">Account:</label>
                <div class="d-flex align-center">
                    <span class="bx-input__text" id="wallet_pay" onclick="copyText('wallet_pay')">79002224132</span>
                    <a href="#" onclick="copyText('wallet_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
                </div>
            </div> 
        </div>
        <div class="bx-input">
            <div class="bx-input__input d-flex align-center justify-space-between">
                <label class="d-flex align-center">Comment:</label>
                <div class="d-flex align-center">
                    <span class="bx-input__text" id="comment_pay" onclick="copyText('comment_pay')">39618</span>
                    <a href="#" onclick="copyText('comment_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
                </div>
            </div>
        </div>
        <div class="bx-input">
            <div class="bx-input__input d-flex align-center justify-space-between">
                <label class="d-flex align-center">Amount to pay:</label>
                <div class="d-flex align-center">
                    <span class="bx-input__text" id="sum_pay" onclick="copyText('sum_pay')">100</span>
                    <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
                    <a href="#" onclick="copyText('sum_pay')" class="btn btn--blue is-ripples flare d-flex align-center" style="margin-left:5px;"><span>Copy</span></a>
                </div>
            </div>
        </div>
        <div class="bx-input">
            <a id="check_pay"  class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Check Transfer</span></a>
        </div>
        <div class="borders"></div>
        <p>When transferring, you must specify the exact wallet number, amount, and comment. In case of error, money will not be refunded.</p>
    </div>
</div>
<script>
    function copyText(that){
        var $temp = $("<input>"); 
        $("body").append($temp);
        $temp.val($(that).text()).select();
        document.execCommand("copy");
        $temp.remove();

        notification('success', 'Copied!')
    }
</script>
<?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?> 
<script type="text/javascript">
    function  typeChatBan() {
        type = $('#type_chat_ban').val();
        $('#type_ban_2').hide()
        $('#time_chat_ban').val('')
        if(type == 2){
            $('#type_ban_2').show()
        }
    }
</script>
<div class="popup popup--ban popup--about">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Ban</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <input type="hidden" id="chat_id_ban" name="">
    <div class="popup__content">
        <div class="bx-input bx-input--select d-flex flex-column" >
            <label>Ban Reason</label>
            <select class="select" id="why_chat_ban">
                <option value="1">Begging</option>
                <option value="2">Spreading ref codes</option>
                <option value="3">Insult</option>
                <option value="4">Spam</option>
                <option value="5">Promo leak</option>
                <option value="6">PR</option>
                <option value="7">Slander</option>
                <option value="8">Misleading</option>
            </select>
        </div>
        <div class="bx-input bx-input--select d-flex flex-column" >
            <label>Ban Duration</label>
            <select class="select" id="type_chat_ban" onchange="typeChatBan()">
                <option value="1">Forever</option>
                <option value="2">Until specific time</option>
            </select>
        </div>
        <div class="bx-input d-flex flex-column" id="type_ban_2" style="display: none;">
            <div class="bx-input__input d-flex align-center justify-space-between">
                <label class="d-flex align-center">Time:</label>
                <div class="d-flex align-center">
                    <input type="datetime-local" id="time_chat_ban">
                </div>
            </div>
        </div>
        <div class="bx-input">
            <a onclick="banMess()" class="btn btn--red d-flex align-center justify-center is-ripples flare"><span>Ban</span></a>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="popup popup--x30 popup--about">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Mode "x30"</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <p>In this mode, you need to choose a color or colors and place a bet. If you guess the color that comes up, you win.</p>
        <div class="borders"></div>
        <h4>Possible bets:</h4>
        <div class="bets">
            <div class="x30__bet-heading is-ripples flare x2 d-flex align-center justify-space-between">
                <span>X2</span>
                <img src="images/games/x2.svg">
            </div>
            <div class="x30__bet-heading is-ripples flare x3 d-flex align-center justify-space-between">
                <span>X3</span>
                <img src="images/games/x3.svg">
            </div>
            <div class="x30__bet-heading is-ripples flare x5 d-flex align-center justify-space-between">
                <span>X5</span>
                <img src="images/games/x5.svg">
            </div>
            <div class="x30__bet-heading is-ripples flare x7 d-flex align-center justify-space-between">
                <span>X7</span>
                <img src="images/games/x7.svg">
            </div>
            <div class="x30__bet-heading is-ripples flare x14 d-flex align-center justify-space-between">
                <span>X14</span>
                <img src="images/games/x14.svg">
            </div>
            <div class="x30__bet-heading is-ripples flare x30 d-flex align-center justify-space-between">
                <span>X30</span>
                <img src="images/games/x30.svg">
            </div>
        </div>
        <div class="borders"></div>
        <p>Sometimes during the game, a bonus wheel appears. If you win, your bet multiplier increases (from 2x to 7x).</p>
    </div>
</div>

<div class="popup popup--x100 popup--about">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Mode "X100"</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content x100">
        <p>In this mode you choose a color or colors and place a bet. If your color wins, you get a payout.</p>
        <div class="borders"></div>
        <h4>Possible bets:</h4>
        <div class="bets">
            <div class="x30__bet-heading is-ripples flare x2 d-flex align-center justify-space-between">
                <span>X2</span>
                <!-- <img src="images/games/x2.svg"> -->
            </div>
            <div class="x30__bet-heading is-ripples flare x3 d-flex align-center justify-space-between">
                <span>X3</span>
                <!-- <img src="images/games/x3.svg"> -->
            </div>
            <div class="x30__bet-heading is-ripples flare x10 d-flex align-center justify-space-between">
                <span>X10</span>
                <!-- <img src="images/games/x5.svg"> -->
            </div>
            <div class="x30__bet-heading is-ripples flare x15 d-flex align-center justify-space-between">
                <span>X15</span>
                <!-- <img src="images/games/x7.svg"> -->
            </div>
            <div class="x30__bet-heading is-ripples flare x20 d-flex align-center justify-space-between">
                <span>X20</span>
                <!-- <img src="images/games/x14.svg"> -->
            </div>
            <div class="x30__bet-heading is-ripples flare x100 d-flex align-center justify-space-between" >
             <span>X100</span>
             <!-- <img src="images/games/x30.svg"> -->
         </div>
     </div>
     <div class="borders"></div>
     <p>Sometimes during the game, a bonus wheel appears. If you win, your bet multiplier increases up to 4x.</p>
 </div>
</div>
<div class="popup popup--about popup--hits">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Player Ranks</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <table>
            <thead>
                <tr>
                    <td>Status</td>
                    <td>Wagered</td>
                    <td>Bonus</td>
                </tr>
            </thead>
            <tbody id="all_status_table">
                <tr>
                    <td>
                        <span class="user-status wolf">Wolf</span>
                    </td>
                    <td>
                        <span>100</span>
                    </td>
                    <td>
                        <span>10</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status predator">Predator</span>
                    </td>
                    <td>
                        <span>500</span>
                    </td>
                    <td>
                        <span>50</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status premium">Premium</span>
                    </td>
                    <td>
                        <span>1000</span>
                    </td>
                    <td>
                        <span>100</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status alpha">Alpha</span>
                    </td>
                    <td>
                        <span>2500</span>
                    </td>
                    <td>
                        <span>250</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status vip">VIP</span>
                    </td>
                    <td>
                        <span>5000</span>
                    </td>
                    <td>
                        <span>500</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status professional">Pro</span>
                    </td>
                    <td>
                        <span>10000</span>
                    </td>
                    <td>
                        <span>1000</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="user-status legend">Legend</span>
                    </td>
                    <td>
                        <span>50000</span>
                    </td>
                    <td>
                        <span>5000</span>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="borders"></div>
        <p>Status - Your rank level. A higher rank means better rewards and bonuses. Status is based on total wagered amount. When reaching a new status, players receive a bonus in Coins shown in the "Bonus" column.</p>
    </div>
</div>
<div class="popup popup--fair-dice" style="width: 375px;">
    <div class="popup__title d-flex align-center justify-space-between">
        <span>Dice</span>
        <a href="#" class="close d-flex align-center justify-center">
            <svg class="icon"><use xlink:href="images/symbols.svg#close"></use></svg>
        </a>
    </div>
    <div class="popup__content">
        <div class="dice__check d-flex align-center flex-column">
            <div class="dice__check-chance" id="chanse_dice">30 <</div>
            <div class="dice__check-result dice__check-result--lose d-flex align-end">
                <span id="dice_n_1_check">2</span>
                <span id="dice_n_2_check">9</span>
                <b>,</b>
                <span id="dice_n_3_check">4</span>
                <span id="dice_n_4_check">2</span>
            </div>
        </div>
        <div class="mines__check d-flex justify-space-between align-center">
            <div class="mines__check-sum d-flex align-center">
                <span id="dice_bet">2,212</span>
                <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
            </div>
            <span id="dice_coeff">x3.33</span>
            <div class="mines__check-sum mines__check-sum--total d-flex align-center">
                <span id="dice_win">2,212</span>
                <svg class="icon money"><use xlink:href="images/symbols.svg#coins"></use></svg>
            </div>
        </div>
        <div class="popup__fair d-flex flex-column">
            <div class="popup__fair-item d-flex align-start">
                <b>Full string</b>
                <span id="full_dice">18324ufjdfh2ihi[[123,kmjf</span>
            </div>
            <div class="popup__fair-item d-flex align-start">
                <b>Hash</b>
                <span id="hash_dice">17273721fd9f1jf9idmm11fdi231ij1mjidfhysygu8tgkjmsjgmsgu</span>
            </div>
            <div class="popup__fair-item d-flex align-start">
                <b>Salt1</b>
                <span id="salt1_dice">(6dsi2j,j2,f,[][])</span>
            </div>
            <div class="popup__fair-item d-flex align-start">
                <b>Number</b>
                <span id="number_dice">7772381</span>
            </div>
            <div class="popup__fair-item d-flex align-start">
                <b>Salt2</b>
                <span id="salt2_dice">Q7237yhhiw223r</span>
            </div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    var ADMIN_CHAT = ''
    <?php if(auth()->guard()->guest()): ?>
    var USER_AVA = '';
    var USER_ID = 0;
    var ADMIN_CHAT = '';
    <?php else: ?> 

    var USER_ID = <?php echo e(\Auth::user()->id); ?>;
    <?php if(\Auth::user()->admin == 1): ?> 
    var ADMIN_CHAT = '<div class="chat__buttons-admins">\
    <a href="#"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
    <a href="#" rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
    </div>';
    <?php endif; ?>
    <?php endif; ?>
</script>

<script src="js/fireworks.js" type="text/javascript"></script>

<script>

    window.onload = function () {
        var firework = JS_FIREWORKS.Fireworks({
            id : 'fireworks-canvas',
            hue : 120,
            particleCount : 50,
            delay : 0,
            minDelay : 20,
            maxDelay : 40,
            fireworkSpeed : 3,
            fireworkAcceleration : 1.05,
            particleFriction : .95,
            particleGravity : 1.5
        });
        firework.start();
        var firework2 = JS_FIREWORKS.Fireworks({
            id : 'fireworks-canvas2',
            hue : 120,
            particleCount : 50,
            delay : 0,
            minDelay : 20,
            maxDelay : 40,
            fireworkSpeed : 4,
            fireworkAcceleration : 1.05,
            particleFriction : .95,
            particleGravity : 1.5
        });
        firework2.start();
    };

   

    <?php if(auth()->guard()->check()): ?>
    balanceUpdate(0, <?php echo e(\Auth::user()->type_balance == 0 ? \Auth::user()->balance : \Auth::user()->demo_balance); ?>, 1)
    <?php endif; ?>
    $('#btnSmiles').click(function(e) {
        e.preventDefault()
        $('.chat').toggleClass('chat--smiles').removeClass('chat--stickers');
        $('#btnStickers').removeClass('active');
        $(this).toggleClass('active');
    });
    $('#btnStickers').click(function(e) {
        e.preventDefault()
        $('#btnSmiles').removeClass('active');
        $('.chat').toggleClass('chat--stickers').removeClass('chat--smiles');
        $(this).toggleClass('active');
    });
    $('#dropdownUser').click(function(e){
        e.preventDefault()
        $(this).toggleClass('dropdown');
    });
    $(document).on('click', function(e) {
        if (!$(e.target).closest("#dropdownUser").length) {
            $('.header__user-dropdown').parent().removeClass('dropdown');
        }
        e.stopPropagation();
    });

    $(".popup--wallet .popup__content .wallet").not(":first").hide();
    $(".popup--wallet .popup__tab").click(function () {
        if ($(this).hasClass('popup__tab--active')) {

        } else {
            $(".popup--wallet .popup__content .wallet").hide().eq($(this).index()).fadeIn(500);
        }
        $('.popup--wallet .popup__tab.popup__tab--active').removeClass('popup__tab--active');
        $(this).addClass('popup__tab--active');
        return false;
    });

    $('.wallet--refill .wallet__method').click(function(e) {
        e.preventDefault()
        if ($(this).hasClass('active')) {

        } else {
            $('.wallet--refill .wallet__method.wallet__method--active').removeClass('wallet__method--active')
            $(this).addClass('wallet__method--active')
        }
    });

    $('.wallet--withdraw .wallet__method').click(function(e) {
        e.preventDefault()
        if ($(this).hasClass('active')) {

        } else {
            $('.wallet--withdraw .wallet__method.wallet__method--active').removeClass('wallet__method--active')
            $(this).addClass('wallet__method--active')
        }
    });

    $(".popup--wallet .popup__content .wallet__history").not(":first").hide();
    $(".wallet--history .wallet__tab").click(function () {
        if ($(this).hasClass('wallet__tab--active')) {

        } else {
            $(".popup--wallet .popup__content .wallet__history").hide().eq($(this).index()).fadeIn(500);
        }
        $('.wallet--history .wallet__tab.wallet__tab--active').removeClass('wallet__tab--active');
        $(this).addClass('wallet__tab--active');
        return false;
    });


    $('.close').click(function(e) {
        setTimeout(() => {
            $('.overlayed, .popup, body').removeClass('active');
        }, 100)
        $('.overlayed').addClass('animation-closed')
        return false;
    });
    $('.overlayed').click(function(e) {
        var target = e.target || e.srcElement;
        if(!target.className.search('overlay')) {
            setTimeout(() => {
                $('.overlayed, .popup, body').removeClass('active');
            }, 100)
            $('.overlayed').addClass('animation-closed') 
        } 
    }); 
    $(document).ready(function() {
        // captcha_r()
        $(document).on("click","[rel=popup]",function() {

            showPopup($(this).attr('data-popup'));
            return false;
        });

    });

    function showPopup(el) {
        if($('.popup').is('.active')) {
            $('.popup').removeClass('active');  
        }
        $('.overlayed, body, .popup.'+el).addClass('active');
        $('.overlayed').removeClass('animation-closed');
    }



    socket.on('laravel_database_x100Bet',e => {
        e = $.parseJSON(e)
        e = e.data
        class_dop = ''
        if(e.user_id == USER_ID){
            class_dop = 'img_no_blur'
        }
        dopText = ''
        <?php if(auth()->guard()->check()): ?>
        <?php if(\Auth::user()->admin == 1): ?>
        dopText = '<div class="dopPlusBetX100" onclick="getX100Bonus('+e.user_id+', `'+e.img+'`)">Bonus</div>'
        <?php endif; ?>
        <?php endif; ?>
        $('.x100 .x100__bet-users.x'+e.coff).prepend('<div data-user-id='+e.user_id+' class="x30__bet-user d-flex align-center justify-space-between">'+dopText+'\
            <div class="history__user d-flex align-center justify-center">\
            <div class="history__user-avatar '+class_dop+'" style="background: url('+e.img+') no-repeat center center / cover;"></div>\
            <span>'+e.login+'</span>\
            </div>\
            <div class="x30__bet-sum d-flex align-center">\
            <span>'+(Number(e.bet).toFixed(2))+'</span>\
            <svg class="icon money" style="margin-left: 8px;"><use xlink:href="images/symbols.svg#coins"></use></svg>\
            </div>\
            </div>')

        $('span[data-sumBetsX100='+e.coff+']').html((e.sumBets).toFixed(0))
        $('span[data-playersX100='+e.coff+']').html(e.players)

    })


    function chatAdd(data){
        class_dop = ''
        if(data.user_id == USER_ID || data.type_mess != 0){
            class_dop = 'img_no_blur'
        }

        <?php if($setting->theme == 0): ?>
            ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"></div> '
        <?php else: ?>
            ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"><img src="../images/games/cap_new.png?v=1" class="cap_new"></div> '
        <?php endif; ?>

        
        class_mess = 'mess';


        if(data.type_mess == 4){
            class_mess = 'system_mess';
            <?php if($setting->theme == 0): ?>
                        ava = '<div class="chat__msg-avatar '+class_dop+'" ></div>';
                        <?php else: ?>
                            ava = '<div class="chat__msg-avatar '+class_dop+'" ><img src="../images/games/cap_new.png?v=1" class="cap_new"></div>';
                        <?php endif; ?>
        }




        dopAdminText = ''
        <?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>  
        dopAdminText =  '<div class="chat__buttons-admins">\
        <a onclick="deleteMess('+data.id+')"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
        <a onclick="banMessSetId('+data.id+')"  rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px;pointer-events: none"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
        </div>'
        <?php endif; ?>


        $('.chat__messages .ss-wrapper .ss-content').append('<div id="msg_'+data.id+'" class="chat__msg d-flex align-start">\
            '+ava+'\
            <div class="chat__msg-info d-flex flex-column">\
            <b>'+data.time+'</b>\
            <span>'+data.status_mess+' '+data.autor+'</span>\
            <div class="chat__msg-message '+class_mess+'">\
            <span>'+data.content+'</span>\
            </div>\
            '+dopAdminText+'\
            </div>\
            </div>');

        chatScroll() 


    }



    function chatGet(){
        $.post('/chat/get',{_token: csrf_token}).then(e=>{
            if(e.history){
                $('.chat__messages .ss-wrapper .ss-content').html('');
                e.history.forEach((e)=>{
                    data = e


                    class_dop = ''
                    if(data.user_id == USER_ID || data.type_mess != 0){
                        class_dop = 'img_no_blur'
                    }

                    <?php if($setting->theme == 0): ?>
                        ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"></div> '
                    <?php else: ?>
                        ava = '<div class="chat__msg-avatar '+class_dop+'" style="background: url('+data.avatar+') no-repeat center center / cover;"><img src="../images/games/cap_new.png?v=1" class="cap_new"></div> '
                    <?php endif; ?>
                    
                    class_mess = 'mess';


                    if(data.type_mess == 4){
                        class_mess = 'system_mess';
                        <?php if($setting->theme == 0): ?>
                        ava = '<div class="chat__msg-avatar '+class_dop+'" ></div>';
                        <?php else: ?>
                            ava = '<div class="chat__msg-avatar '+class_dop+'" ><img src="../images/games/cap_new.png?v=1" class="cap_new"></div>';
                        <?php endif; ?>
                        
                    }

                    

                    dopAdminText = ''
                    <?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>  
                    dopAdminText =  '<div class="chat__buttons-admins">\
                    <a onclick="deleteMess('+data.id+')"><svg class="icon"><use xlink:href="/images/symbols.svg#close"></use></svg></a>\
                    <a onclick="banMessSetId('+data.id+')"  rel="popup" data-popup="popup--ban"><svg class="icon" style="width: 20px; height: 20px;pointer-events: none"><use xlink:href="/images/symbols.svg#warning"></use></svg></a>\
                    </div>'
                    <?php endif; ?>


                    $('.chat__messages .ss-wrapper .ss-content').prepend('<div id="msg_'+data.id+'" class="chat__msg d-flex align-start">\
                        '+ava+'\
                        <div class="chat__msg-info d-flex flex-column">\
                        <b>'+data.time+'</b>\
                        <span>'+data.status_mess+' '+data.autor+'</span>\
                        <div class="chat__msg-message '+class_mess+'">\
                        <span>'+data.content+'</span>\
                        </div>\
                        '+dopAdminText+'\
                        </div>\
                        </div>');

                    chatScroll()

                })


            } 

        })
    }


    chatGet()


    <?php if(\Auth::user() && (\Auth::user()->admin == 1 or \Auth::user()->admin == 2)): ?>  
    function deleteMess(id){

        $.post('/chat/delete',{_token: csrf_token, id}).then(e=>{
          if(e.success){
            notification('success','Success')
        }else{      
            notification('error',e.mess)
        }
    })
    }
    function banMessSetId(id){
        $('#chat_id_ban').val(id)
    }
    function banMess(){
        why_ban = $('#why_chat_ban').val()
        time_ban = $('#time_chat_ban').val()
        id = $('#chat_id_ban').val()
        $.post('/chat/ban',{_token: csrf_token, id, why_ban, time_ban}).then(e=>{

          if(e.success){
            notification('success','Success')
        }else{    
            notification('error',e.mess)
        }
    })
    }




    <?php endif; ?>  



    activeLinks()


    var captcha_r = function () {
        $('#captcha_reload').html('<div style="width:100%" class="h-captcha" id="captcha"  data-sitekey="952c2020-3e6b-43fe-b941-4659cb499ec7"></div>')
        console.log('hCaptcha is ready.');
        var widgetID = hcaptcha.render('captcha', { sitekey: '952c2020-3e6b-43fe-b941-4659cb499ec7' });
    };
    


</script>


    <?php if(auth()->guard()->check()): ?>
    <?php if(\Auth::user()->id != 0): ?>
    <script type="text/javascript">


        function openWinter(id){
            $.post('/winter/start',{_token: csrf_token, id}).then(e=>{
                undisable('.winter__item')   
                if(e.success){  
                    
                    e.prize.forEach(function(item, i, arr) {
                        $('.winter__item:eq('+i+') .winter__front span').html(item+' ?')

                    })  
                   
                    balanceUpdate(e.lastbalance, e.newbalance)
                    notification('success',e.success)
                    notification('success','? ??in?? ??to?!')

                    $('.winter__item:eq('+(id - 1)+')').addClass('winter__item--active')

                    setTimeout(() => $('.winter__item').addClass('winter__item--active'),1000);

                    setTimeout(() => location.href='/',2000);

                }else{       
                    notification('error',e.mess)
                }
            }).fail(e=>{
                undisable('.winter__item')   
                notification('error',JSON.parse(e.responseText).message)
            })  
        }

       

        socket.on('laravel_database_openNewYear', function(data){
            $('.winter').fadeIn();
        }) 

        socket.on('laravel_database_closeNewYear', function(data){
            $('.winter').fadeOut();
        }) 

    </script>
    

    <?php if(\Auth::user()->newYear == 0 && \App\Setting::first()->newYear == 1): ?>
    <script type="text/javascript">
        $('.winter').fadeIn();
    </script>
    <?php endif; ?>

    <?php endif; ?>

    <script type="text/javascript">
        socket.emit('subscribe', 'roomUser_<?php echo e(\Auth::user()->id); ?>');
    </script>
    <?php endif; ?>






</body>
</html>

<style type="text/css">
    @media(max-width: 475px){
  .toast-top-right{
    margin-top: 60px!important;
  }
}
</style><?php /**PATH C:\Users\maxmi\OneDrive\Documents\Downloads\GoldenX-CASINO-SITE-main\GoldenX-CASINO-SITE-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>