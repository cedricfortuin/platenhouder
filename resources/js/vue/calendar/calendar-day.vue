<template>
    <FullCalendar :options="calendarOptions"></FullCalendar>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid';

export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                initialView: 'timeGridWeek',
                editable: true,
                events: async () => {
                    let response = await axios.get('/api/calendar/events');
                    return response.data
                },
                eventDrop: async (info) => {
                    let idResponse = await axios.get('/api/calendar/events');
                    let eventId = idResponse["data"][0]["id"];

                    axios.post('/api/calendar/update-event', {
                        id: eventId,
                        date: info.event.start.toLocaleDateString('nl-NL')
                    })
                    .then(response => {
                        if (response.status == 201) {
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error(error)
                    })
                }
            }
        }
    }
}
</script>
