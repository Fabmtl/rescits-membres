(function ($) {
    "use-strict";

    //wait until DOM is ready
    document.addEventListener("DOMContentLoaded", function (event) {
        // console.log("DOM loaded");
        //wait until images, links, fonts, stylesheets, and js is loaded
        window.addEventListener("load", function (e) {
            const smallElements = document.querySelectorAll(".voir-bio");
            const modal = this.document.getElementById("modal-membre");
            const closeModal = this.document.getElementById("close-dialog");
            const overlay = this.document.getElementById("modal-overlay");

            const timeline = gsap.timeline({ paused: true });

            // Open modal animation
            timeline
                .to(modal, { display: "flex", opacity: 1, duration: 0.3 }) // Fade in modal
                .from(modalContent.children, {
                    y: 50,
                    opacity: 0,
                    stagger: 0.2,
                    duration: 0.5,
                    ease: "power2.out",
                });

            // Event listeners for modal
            openModalBtn.addEventListener("click", () => {
                timeline.play();
            });
        });
    });
})(jQuery);
