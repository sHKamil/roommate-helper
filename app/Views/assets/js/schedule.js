var date = new Date();
var ad = $('#actual_date');
var day = date.getDate();
ad.text(date.getDate()+"."+date.getMonth()+"."+date.getFullYear());


// var data = JSON.parse(getCookie('date_package'));
console.log(getCookie("date_package"));
// console.log($date_package);

function getCookie(name) {
    const pattern = RegExp(name + "=.[^;]*");
    const matched = document.cookie.match(pattern);
    if (matched) {
      const cookie = matched[0].split('=');
      return cookie[1];
    }
    return null;
  }