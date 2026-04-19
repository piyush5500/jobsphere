import flatpickr from 'flatpickr';

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("[name='application_deadline']", {
        minDate: "today",
        dateFormat: "Y-m-d",
        enableTime: false,
        allowInput: true,
        clickOpens: true
    });
});

