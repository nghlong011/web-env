import "./bootstrap";
import GLightbox from "glightbox";
import "glightbox/dist/css/glightbox.min.css";
import Alpine from "alpinejs";

document.addEventListener("DOMContentLoaded", function () {
    GLightbox({ selector: ".glightbox" });
});

window.Alpine = Alpine;
Alpine.start();