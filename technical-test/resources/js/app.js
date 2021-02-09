require('./bootstrap');

import flatpickr from "flatpickr";

window.onload = function() {
    flatpickr("#invoice_date_from", {});
    flatpickr("#invoice_date_to", {});
};
