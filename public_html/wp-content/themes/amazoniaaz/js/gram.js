$( window ).resize(function() {
    if($(window).width() <=768) $('.pic-3d').addClass("center-block");
    else $('.pic-3d').removeClass("center-block");
});

$( window ).resize(function() {
    if($(window).width() <=991) $('.post-module').addClass("center-block");
    else $('.post-module').removeClass("center-block");
});


var sBrowser, sUsrAg = navigator.userAgent;

if(sUsrAg.indexOf("Chrome") > -1) {
    sBrowser = "Google Chrome";
} else if (sUsrAg.indexOf("Safari") > -1) {
    $('.come-right-motion').addClass('safaribrowser');
} else if (sUsrAg.indexOf("Opera") > -1) {
    sBrowser = "Opera";
} else if (sUsrAg.indexOf("Firefox") > -1) {
    sBrowser = "Mozilla Firefox";
} else if (sUsrAg.indexOf("MSIE") > -1) {
    sBrowser = "Microsoft Internet Explorer";
}



