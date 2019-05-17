/* eslint-disable no-restricted-globals */

// ? notify template
function notify(icon, type, message, url, align) {
  // Create notification
  $.notify(
    {
      // options
      icon: icon || '',
      message,
      url: url || ''
    },
    {
      // settings
      element: 'body',
      type: type || 'info',
      allow_dismiss: true,
      newest_on_top: true,
      showProgressbar: false,
      placement: {
        from: 'top',
        align: align || 'right'
      },
      mouse_over: 'pause',
      offset: 20,
      spacing: 10,
      z_index: 1033,
      delay: 6000,
      template:
        '<div data-notify="container" class="notification col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
        '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
        '<span data-notify="icon"></span> ' +
        '<span data-notify="title">{1}</span> ' +
        '<span data-notify="message">{2}</span>' +
        '<div class="progress" data-notify="progressbar">' +
        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
        '</div>' +
        '<a href="{3}" target="{4}" data-notify="url"></a>' +
        '</div>',
      animate: {
        enter: 'animated fadeIn',
        exit: 'animated fadeOutDown'
      },
      onShow() {
        this.css({ width: 'auto', height: 'auto' });
      }
    }
  );
}

// ? fetch users active api key
function fetchActiveKey() {
  const apiKeyHolder = $('#current-api-key');
  const userId = apiKeyHolder.data('user-id');

  $.ajax({
    url: `${baseURL}/api/v1/main/index`,
    type: 'POST',
    data: {
      call: {
        method: 'get_active_api_key',
        args: [userId]
      }
    },
    dataType: 'json'
  }).done(response => {
    if (response.status) {
      const apiKey = response.body.api_key;

      if (apiKey !== null) {
        apiKeyHolder.removeClass('d-none');
        apiKeyHolder.html(response.body.api_key);
      } else if (!apiKeyHolder.hasClass('d-none'))
        apiKeyHolder.addClass('d-none').html('');
    }
  });
}

$(document).ready(() => {
  // ? init active key
  fetchActiveKey();

  // ? Generate api key
  $('#btn-api-key').on('click', event => {
    const apiKeyHolder = $('#current-api-key');

    // eslint-disable-next-line no-alert
    const proceed = confirm('You are about to generate a new API KEY');
    if (!proceed) return;
    const _this = event.target;
    const userId = $(_this).data('user-id');
    let apiKey = '';

    $.ajax({
      url: `${baseURL}/api/v1/main/index`,
      type: 'POST',
      data: {
        call: {
          method: 'generate_api_key',
          args: [64]
        }
      },
      dataType: 'json'
    }).then(generateRes => {
      if (generateRes.status) {
        apiKey = generateRes.body.api_key;
        $.ajax({
          url: `${baseURL}/api/v1/main/index`,
          type: 'POST',
          data: {
            call: {
              method: 'save_api_key',
              args: [apiKey, userId]
            }
          },
          dataType: 'json'
        }).done(response => {
          if (response.status) {
            if (apiKeyHolder.hasClass('d-none'))
              apiKeyHolder.removeClass('d-none');
            apiKeyHolder.html(apiKey);
          }
          const type = response.status ? 'success' : 'danger';
          notify('', type, response.body.transaction_msg);
        });
      } else {
        notify('', 'danger', generateRes.body.transaction_msg);
      }
    });
  });
});
