var STATUS_FAIL = '1';
var STATUS_OK = '2';
function toast(action, tiempo,mensaje)
{
  var bgcolor;

  if(action=='error')
  {
    bgcolor='#db2828';

  }else if(action=='success'){

    bgcolor='#66BB6A';
  }


  $.toast({
    text: mensaje, // Text that is to be shown in the toast

    showHideTransition: 'fade', // fade, slide or plain
    allowToastClose: false, // Boolean value true or false
    hideAfter: tiempo, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
    stack: false, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
    position: 'top-center', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
    textAlign: 'center',  // Text alignment i.e. left, right or center
    loader: false,
    bgColor: bgcolor

  });
}