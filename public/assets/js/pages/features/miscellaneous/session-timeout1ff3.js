"use strict";

var KTSessionTimeoutDemo = function () {
    var initDemo = function () {
        $.sessionTimeout({
            title: 'Session Timeout Notification',
            message: 'Your session is about to expire.',
            keepAliveUrl: HOST_URL + '/api/session-timeout/keepalive.php',
            redirUrl: urlroot + '/auth/login', // Updated redirect URL
            logoutUrl: urlroot + '/auth/login', // Updated logout URL
            warnAfter: 1020000, //warn after 120 seconds
            redirAfter: 1035000, //redirect after 135 seconds
            ignoreUserActivity: false,
            countdownMessage: 'Redirecting in {timer} seconds.',
            countdownBar: true
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            initDemo();
        }
    };
}();

jQuery(document).ready(function() {
    KTSessionTimeoutDemo.init();
});
