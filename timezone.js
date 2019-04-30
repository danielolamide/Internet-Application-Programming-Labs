$(document).ready(() => {
  const offset = new Date().getTimezoneOffset();
  const timestamp = new Date().getTime();

  // convert to UTC
  const utcTimestamp = timestamp + 60000 * offset;
  $('#time_zone_offset').val(offset);
  $('#utc_timestamp').val(utcTimestamp);
});
