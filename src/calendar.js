import { Calendar } from "@fullcalendar/core";

function initializeCalendar(selector, conditions = {}){
    let calendar = new Calendar(selector, conditions);
    return calendar.render();
}

export default initializeCalendar;
