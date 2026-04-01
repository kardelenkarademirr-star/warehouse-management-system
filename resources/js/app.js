import './bootstrap'; 

import Swal from 'sweetalert2';
window.Swal = Swal; 

document.addEventListener("DOMContentLoaded", function() {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    sidebarToggle.addEventListener("click", function() {
        sidebar.classList.toggle("collapsed");
    });
});
