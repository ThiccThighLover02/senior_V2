import getData from "./service.js";

import initializeCalendar from "./calendar.js";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import bootstrap5Plugin from "@fullcalendar/bootstrap5";
$(document).ready(function () {
  let calendarEl = document.getElementById("calendar"); //get DOM element for calendar
  getData("queries/getData.php?method=calendar")
    .then((response) => response.json())
    .then((data) => {
      let events = data.map((item, index) => {
        return {
          title: item.post_title,
          start: `${item.post_date}T${item.time_start}`,
          end: `${item.post_date}T${item.time_end}`
        };
      });
      console.log(events);
      initializeCalendar(calendarEl, {
        aspectRatio: 2,
        plugins: [dayGridPlugin, timeGridPlugin, listPlugin, bootstrap5Plugin],
        initialView: "dayGridMonth",
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,listWeek",
        },
        events: events
      });
    })
    .catch((err) => {
      console.log(err);
    });
});
