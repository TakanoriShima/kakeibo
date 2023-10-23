import { Calendar } from '@fullcalendar/core';
import interactionPlugin from "@fullcalendar/interaction";
import dayGridPlugin from '@fullcalendar/daygrid';
import axios from 'axios';

/* global history */
const show_calendar = () => {
    
    var calendarEl = document.getElementById("calendar");
    
    let month = document.getElementById('now').textContent;
    
    let initial_date = month + '-01';
    
    axios.get("/get_data")
        .then(res => {
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                headerToolbar: {
                  start: '',
                  center: '',
                  end: ''
                },
                navLinks: true,
                selectable: true,
                initialDate: initial_date,
                events: res['data']['records'],
                eventClick: function(info) {
                    var eventUrl = '/records/' + info.event.id;
                    window.location.href = eventUrl;
                }
            });
    
        // カレンダー描画関数
        function renderCalendar(month) {
            axios.get(`/records?month=${month}`)
                .then(response => {
                    calendar.removeAllEvents(); // イベントをクリア
                    calendar.addEventSource(response.data.records); // イベントを追加
                    calendar.gotoDate(month + '-01'); // カレンダーを指定月に移動
                })
                .catch(error => {
                    console.error(error);
                });
        }                                                                                               
        calendar.render();
    })
    .catch(error => {
        console.log(error);
    });
}    


show_calendar();