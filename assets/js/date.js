/* Подставление в кнопки с временем сегодняшние, завтрашние даты*/

var d = new Date()

today = d.toISOString().slice(0,10);
today = today.replace(/(\d+)-(\d+)-(\d+)/,"$3-$2-$1")

d.setDate(d.getDate() + 1)
tommorow = d.toISOString().slice(0,10);
tommorow = tommorow.replace(/(\d+)-(\d+)-(\d+)/,"$3-$2-$1")
var d = new Date()
d.setDate(d.getDate() + 2)
aftomorrow = d.toISOString().slice(0,10);
aftomorrow = aftomorrow.replace(/(\d+)-(\d+)-(\d+)/,"$3-$2-$1")
document.getElementById("today_value").value='.' + today;
document.getElementById("tomorrow_value").value='.' + tommorow;
document.getElementById("aftomorrow_value").value='.' + aftomorrow;


/* Добавление класса со времением  */
const mixer = document.querySelector('#Content');
const dateSpans = document.querySelectorAll('.event_date');
dateSpans.forEach(el => {
  let className = el.textContent.replaceAll('.', '-');
  el.closest('.popup-link') ? el.closest('.popup-link').classList.add(className) : null;
})

dateSpans.forEach(el => {
  let className = el.textContent.replaceAll('.', '-');
  el.closest('.popup-link') ? el.closest('.popup-link').classList.add(className) : null;
})
var d = new Date()
// Добавление в кнопку сегодня даты

/* функция добавления ведущих нулей */
/* (если число меньше десяти, перед числом добавляем ноль) */
function zero_first_format(value)
{
    if (value < 10)
    {
          value='0'+value;
    }
    return value;
}

      /* функция получения текущей даты и времени */
      function date_time()
      {
         var day = zero_first_format(d.getDate());
         var month = zero_first_format(d.getMonth()+1);
         return "Сегодня"+", "+day+"."+month;
      }

      /* функция получения текущей даты и времени */
      function date_time_tomorrow()
      {
         var current_datetime = new Date();
         current_datetime = new Date(current_datetime.getTime() + (24 * 60 * 60 * 1000));
         var day = zero_first_format(current_datetime.getDate());
         var month = zero_first_format(current_datetime.getMonth()+1);
         return "Завтра"+", "+ day+"."+month;
      }
      function date_time_aftomorrow()
      {
         var current_datetime = new Date();
         current_datetime = new Date(current_datetime.getTime() + (48 * 60 * 60 * 1000));
         var day = zero_first_format(current_datetime.getDate());
         var month = zero_first_format(current_datetime.getMonth()+1);
         return "Послезавтра"+", "+ day+"."+month;
      }


      document.getElementById('current_date_time_block_today').innerHTML = date_time();
      document.getElementById('current_date_time_block_tomorrow').innerHTML = date_time_tomorrow();
      document.getElementById('current_date_time_block_aftomorrow').innerHTML = date_time_aftomorrow();
/* =========================== */
/* ===== Выпадающий список ===== */

$(".spoiler_title").click(function() {
   var container = $(this).parents(".spoiler_wrap");
   var answer = container.find(".spoiler_content");
   var trigger = container.find(".arrow-t");

   answer.slideToggle(200);

   if (trigger.hasClass("arrow-b")) {
       trigger.removeClass("arrow-b");
   } else {
       trigger.addClass("arrow-b");
   }
   if (container.hasClass("expanded")) {
       container.removeClass("expanded");
   } else {
       container.addClass("expanded");
   }
});