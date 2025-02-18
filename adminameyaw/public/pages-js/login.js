$(document).ready(function() {

    $('#myclock').thooClock({
        size: 300,
        sweepingMinutes: true,
        sweepingSeconds: true,
        showNumerals: true,
        brandText: 'JODABRI',
        brandText2: 'Ghana',
        onEverySecond: function() {
            //callback that should be fired every second
            //console.log(new Date().getSeconds());
        }
    });

});