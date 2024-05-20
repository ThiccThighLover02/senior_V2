import initializeCalendar from "./calendar.js";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
$(document).ready(function () {
  let calendarEl = document.getElementById("calendar"); //get DOM element for calendar
  console.log("the calendar goes here");
  initializeCalendar(calendarEl, {
    plugins: [dayGridPlugin, timeGridPlugin, listPlugin],
    initialView: "dayGridMonth",
    headerToolbar: {
      left: "prev,next today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,listWeek",
    },
  });
});
