import { Calendar } from "fullcalendar/index.js";
$(document).ready(function(){

    let calendarEl = $("#calendar");
    let calendar = new Calendar(calendarEl, {
        initialView: "dayGridMonth"
    });

    calendar.render();

});