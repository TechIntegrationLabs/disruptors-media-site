<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>McDonalds-EmployeeDashboard</title>
    @include('employee/partials/head')
</head>
<body>
	@include('employee/partials/header')

        @yield('content')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>	
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/fullcalendar@5.1.0/main.js"></script> -->
	<script type="text/javascript">

// const date = new Date();

// const renderCalendar = () => {
//   date.setDate(1);

//   const monthDays = document.querySelector(".days");

//   const lastDay = new Date(
//     date.getFullYear(),
//     date.getMonth() + 1,
//     0
//   ).getDate();

//   const prevLastDay = new Date(
//     date.getFullYear(),
//     date.getMonth(),
//     0
//   ).getDate();

//   const firstDayIndex = date.getDay();

//   const lastDayIndex = new Date(
//     date.getFullYear(),
//     date.getMonth() + 1,
//     0
//   ).getDay();

//   const nextDays = 7 - lastDayIndex - 1;

//   const months = [
//     "January",
//     "February",
//     "March",
//     "April",
//     "May",
//     "June",
//     "July",
//     "August",
//     "September",
//     "October",
//     "November",
//     "December"
//   ];

//   document.querySelector(".date h1").innerHTML = months[date.getMonth()];

//   document.querySelector(".date p").innerHTML = new Date().toDateString();

//   let days = "";

//   for (let x = firstDayIndex; x > 0; x--) {
//     days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
//   }

//   for (let i = 1; i <= lastDay; i++) {
//     if (
//       i === new Date().getDate() &&
//       date.getMonth() === new Date().getMonth()
//     ) {
//       days += `<div class="today">${i}</div>`;
//     } else {
//       days += `<div>${i}</div>`;
//     }
//   }

//   for (let j = 1; j <= nextDays; j++) {
//     days += `<div class="next-date">${j}</div>`;
//     monthDays.innerHTML = days;
//   }
// };

// document.querySelector(".prev").addEventListener("click", () => {
//   date.setMonth(date.getMonth() - 1);
//   renderCalendar();
// });

// document.querySelector(".next").addEventListener("click", () => {
//   date.setMonth(date.getMonth() + 1);
//   renderCalendar();
// });

// renderCalendar();

// 	</script>
  

// 		<script type="text/javascript">
			
// 			$(document).ready(function() {
// 				  ShowCalendar();
// 				});

// 				var events = [];
// 				var calendarEl = document.getElementById('calendar');
// 				var calendar = new FullCalendar.Calendar(calendarEl, {

// 				    initialView: 'dayGridMonth',

// 				    events: function(info, successCallback, failureCallback ) {
// 				      successCallback(events);
// 				    },

// 				  });

// 				function ShowCalendar() {
// 				  calendar.render();
// 				}

// 				$("#addEvent").on("click", function() {
// 				  events.push({
// 				    title: $("#eventName").val(),
// 				    start: $("#fromDate").val(),
// 				    end: $("#toDate").val()
// 				  });

// 				  calendar.refetchEvents();
// 				});

		</script>

</body>
</html>