import './bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.datepicker').forEach(function (item) {
        flatpickr(item, {
            mode: 'range'
        });

    });

})
