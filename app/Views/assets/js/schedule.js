var date = new Date();
var ad = $('#actual_date');
var day = date.getDate();
ad.text(date.getDate()+"."+date.getMonth()+"."+date.getFullYear());


console.log(day);