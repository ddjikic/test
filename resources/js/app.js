import './bootstrap';
import Chart from 'chart.js/auto';
import DateRangePicker from 'flowbite-datepicker/DateRangePicker';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const dateRangePickerEl = document.getElementById('dateRangePickerId');
new DateRangePicker(dateRangePickerEl, {
    autohide: true,
    beforeShowDay: null,
    beforeShowDecade: null,
    beforeShowMonth: null,
    beforeShowYear: null,
    calendarWeeks: false,
    clearBtn: false,
    dateDelimiter: ',',
    datesDisabled: [],
    daysOfWeekDisabled: [],
    daysOfWeekHighlighted: [],
    defaultViewDate: undefined, // placeholder, defaults to today() by the program
    disableTouchKeyboard: false,
    format: 'dd/mm/yyyy',
    language: 'en_UK',
    maxDate: null,
    maxNumberOfDates: 1,
    maxView: 3,
    minDate: null,
    nextArrow: '<svg class="w-4 h-4 rtl:rotate-180 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/></svg>',
    orientation: 'auto',
    pickLevel: 0,
    prevArrow: '<svg class="w-4 h-4 rtl:rotate-180 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/></svg>',
    showDaysOfWeek: true,
    showOnClick: true,
    showOnFocus: true,
    startView: 0,
    title: '',
    todayBtn: false,
    todayBtnMode: 0,
    todayHighlight: false,
    updateOnBlur: true,
    weekStart: 1,
});
new Chart(document.getElementById("Visits_per_day"), {
    type : 'line',
    data : {
        labels :Vdays,
        datasets : [
            {
                data : visitsPerDay,
                label : "Visits",
                borderColor : "#3cba9f",
                fill : false
            }]
    },
    options : {
        title : {
            display : true,
            text : 'Visits per day'
        }
    }
});

new Chart(document.getElementById("os_distribution"), {
    type : 'pie',
    data : {
        labels:OSNames,
        datasets: [{
            label: 'Visits',
            data: OSValues,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    },
    options : {
        title : {
            display : true,
            text : 'Os distribution'
        }
    }
});
new Chart(document.getElementById("browser_distribution"), {
    type : 'pie',
    data : {
        labels:browsers,
        datasets: [{
            label: 'Visits',
            data: browsersValues,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    },
    options : {
        title : {
            display : true,
            text : 'Os distribution'
        }
    }
});
