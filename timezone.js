$(document).ready(function(){
    var offset = new Date().getTimezoneOffset();
    var timeStamp = new Date().getTime();
    var utc_timeStamp = timeStamp + (60000*offset);
    $('#time_zone_offset').val(offset);
    $('#utc_timestamp').val(utc_timeStamp);
})