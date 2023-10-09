// setDay(getCookie("today"));

// function getCookie(name) {
//   let pattern = RegExp(name + "=[^;]*");
//   const matched = document.cookie.match(pattern);

//   if (matched) {
//     const cookie = matched[0].split('=');
//     let string = cookie[1];
//     pattern = RegExp(/[%22]*/g); // fix needed
//     string = string.replace(pattern,'');
//     return string;
//   }
//   return null;
// }

// function setDay(day) {
//   clearActualDay()
//   const element = document.getElementById('d'+day);
//   element.classList.add('actual_day');
// }

// function clearActualDay() {
//   const elements = document.querySelectorAll('.actual_day');

//   elements.forEach((element) => {
//     element.classList.remove('actual_day');
//   });
// }

setActualDate = () => {
  var date = new Date();
  var ad = $('#actual_date');
  var month = date.getMonth()+1;
  if(month.toString().length === 1) month = '0' + month;
  ad.text(date.getDate()+"."+month+"."+date.getFullYear());
}

setActualDate();
