<template>
    <FullCalendar :options="calendarOptions"></FullCalendar>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    components: {
        FullCalendar
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                editable: true,
                events: async () => {
                    let response = await axios.get('/api/calendar/events');
                    return response.data
                },
                eventDrop: async (info) => {
                    let idResponse = await axios.get('/api/calendar/events');
                    let yeet = idResponse.data;

                    yeet.forEach((item, index) => {
                        axios.post('/api/calendar/update-event', {
                            id: index,
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
                    })
                }
            }
        }
    }
}
</script>
