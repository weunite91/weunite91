// $('body').on('onkeypress', '.mobile_valid', function () {
// 	alert();
// });

function isNumber(evt) {
	var iKeyCode = (evt.which) ? evt.which : evt.keyCode
	if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
	    return false;

	return true;
}   

function alphaOnly(event) {
  var key = event.keyCode;
  return ((key >= 65 && key <= 90) || key == 8 ||  key == 32 ||key >= 95 && key <= 122);
};