import { Calendar } from '@fullcalendar/core';
import interactionPlugin from '@fullcalendar/interaction';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';

import '@fullcalendar/core/main.css';
import '@fullcalendar/daygrid/main.css';
import '@fullcalendar/timegrid/main.css';

import './index.scss'; // this will create a calendar.css file reachable to 'encore_entry_link_tags'

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar-holder');

    const { eventsUrl } = calendarEl.dataset;

    const calendar = new Calendar(calendarEl, {
        defaultView: 'dayGridMonth=',
        editable: true,
        eventSources: [
            {
                url: eventsUrl,
                method: 'POST',
                extraParams: {
                    filters: JSON.stringify({}),
                },
                failure: () => {
                    // alert("There was an error while fetching FullCalendar!");
                },
            },
        ],
        header: {
            left: 'prev,title,next',
            right: 'timeGridDay',
        },
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin], // https://fullcalendar.io/docs/plugin-index
        timeZone: 'UTC',
    });
    calendar.render();
    setTimeout(() => {
        document.querySelector('.fc-day-grid-container').style.cssText = 'overflow: initial';
    }, 700);
});
