// Flat picker js

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#appointment_timePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });

    flatpickr("#appointment_datepicker", {
        enableTime: false,
        noCalendar: false,
        minDate: "today",
        // dateFormat: "d-m-Y",
        // dateFormat: "H:i",
    });
});