/*
Name: Main Js file for Crypterio Template
Date: 20 January 2019
Themeforest TopHive : https://themeforest.net/user/tophive
*/


'use strict';
jQuery(document).ready(function () {
    jQuery(document).on('click', '.crypt-header i.menu-toggle', function () {
        jQuery('.crypt-mobile-menu').toggleClass('show');
        jQuery(this).toggleClass('open')
    });

    jQuery(document).on('hover', '.crypt-mega-dropdown-toggle', function () {
        jQuery('.crypt-mega-dropdown-menu-block').toggleClass('shown');
    });
    jQuery(document).on('click', '.crypt-mega-dropdown-toggle', function (e) {
        e.preventDefault();
        jQuery('.crypt-mega-dropdown-menu-block').toggleClass('shown');
    });
    jQuery('[data-toggle="tooltip"]').tooltip();

    jQuery('#crypt-tab a').on('click', function (e) {

        e.preventDefault();

        var x = jQuery(this).attr('href');
        jQuery(this).parents().find('.crypt-tab-content .tab-pane').removeClass('active');
        jQuery(this).parents().find('.crypt-tab-content .tab-pane' + x).addClass('active');
    });

    jQuery(document).on('click', '.crypt-coin-select a', function (e) {
        e.preventDefault();
        var div = jQuery(this).attr('href');
        jQuery('.crypt-dash-withdraw').removeClass('d-block').addClass('d-none');
        jQuery(div).removeClass('d-none').addClass('d-block');
    });
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path

    jQuery('ul.crypt-heading-menu > li > a').each(function () {
        if (this.href === path) {
            jQuery(this).parent('li').addClass('active');
        } else {
            jQuery(this).parent('li').removeClass('active');
        }
        jQuery('.crypt-box-menu').removeClass('active');
    });


    if (document.getElementById('crypt-candle-chart')) {
        new TradingView.widget({
            "autosize": true,
            "symbol": JSON.parse(localStorage.getItem('candle-chart-instrument')) ? JSON.parse(localStorage.getItem('candle-chart-instrument'))[window.AuthUser.id] : '',
            "interval": "D",
            "timezone": "Etc/UTC",
            "theme": "Dark",
            "style": "1",
            "locale": "en",
            "toolbar_bg": "rgba(0, 0, 0, 1)",
            "enable_publishing": false,
            "allow_symbol_change": true,
            "container_id": "crypt-candle-chart"
        });
    }


    function pushToast(type = "info", message = "", x = "right", y = "bottom") {
        let theme;
        let icon;
        let rand = "toast_" + Math.floor(Math.random() * 10000 + 1);
        if (type == "danger") {
            theme = "danger";
            icon = '<i class="uil uil-exclamation-octagon mr-2"></i>';
        } else if (type == "warning") {
            theme = "warning";
            icon = '<i class="uil uil-exclamation-triangle mr-2"></i>';
        } else if (type == "success") {
            theme = "success";
            icon = '<i class="uil uil-thumbs-up mr-2"></i>';
        } else {
            theme = "info";
            icon = '<i class="uil uil-info-circle mr-2"></i>';
        }

        $(`
					<div id="${rand}" class="toast bg-${theme}" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000" data-animation="true">
							<div class="toast-header">
									<span class="mr-auto">${icon} ${message}</span>
									<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
					</div>
					`).appendTo(".show-toast-" + x + "-" + y);
								$(`#${rand}`).toast("show");
								setTimeout(function () {
										$(`#${rand}`).remove();
								}, 10000);
    }
});
