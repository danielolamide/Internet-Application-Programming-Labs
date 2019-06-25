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
        '<div data-notify="container" class="notification alert alert-{0}" role="alert">' +
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

$(document).ready(() => {
  const apiKey =
    'h2L4760YcelbsHzLz6mSBf0dHuzztJTGoKZNDBjllfbpsNsElofLNkoVMBh8RR7H';

  // ? Place order
  const placeOrderForm = $('#place-order-form');
  placeOrderForm.on('submit', event => {
    event.preventDefault();
    const dataToSend = placeOrderForm.serializeArray();

    $.ajax({
      url: 'http://localhost/IAP-labs/api/v1/orders/index.php',
      type: 'POST',
      headers: {
        Authorization: `Basic ${apiKey}`
      },
      data: dataToSend,
      dataType: 'json'
    })
      .done(response => {
        const type = response.status ? 'success' : 'danger';
        notify('', type, response.body.transaction_msg);
        placeOrderForm[0].reset();
      })
      .catch(err => {
        notify('', 'warning', 'Could not process request');
        console.log(err);
      });
  });

  // ? Check order status
  const orderStatusForm = $('#order-status-form');
  orderStatusForm.on('submit', event => {
    event.preventDefault();
    const dataToSend = orderStatusForm.serializeArray();

    $.ajax({
      url: 'http://localhost/IAP-labs/api/v1/orders/index.php',
      type: 'GET',
      data: dataToSend,
      headers: {
        Authorization: `Basic ${apiKey}`
      },
      dataType: 'json'
    }).done(response => {
      if (response.status) {
        // ? set table content
        const fields = Object.keys(response.body.order);
        const { order } = response.body;
        
        alert("Order Status: "+ response.body.order.order_status)

      } else {
        notify('', 'danger', response.body.transaction_msg);
        orderStatusForm[0].reset();
      }
    });
  });
});
