(function ($) {
    "use-strict";

    //wait until DOM is ready
    document.addEventListener("DOMContentLoaded", function (event) {
        // console.log("DOM loaded");
        //wait until images, links, fonts, stylesheets, and js is loaded
        gsap.registerPlugin(ScrollTrigger); // register the ScrollTrigger plugin

        window.addEventListener("load", function (e) {

            const smallElements = gsap.utils.toArray(".membre-rescits");
            gsap.set(smallElements, {
                y: 50,
                opacity: 0,
            });
            ScrollTrigger.batch(".membre-rescits", {
                batchMax: 3,
                start: "top 80%",
                end: "bottom 20%",
                // markers: true,
                onEnter: (batch) => {
                    gsap.to(batch, {
                        y: 0,
                        opacity: 1,
                        duration: 0.6,
                        stagger: 0.3,
                        overwrite: true,
                    });
                },
            });

            const selectedOption = document.querySelector(".selected-option"); 

            selectedOption.addEventListener("click", function () {
                const optionsContainer = document.querySelector(".options-container");
                const svgIcon = document.querySelector(".svg-icon");
                       optionsContainer.classList.toggle("active");
                       svgIcon.classList.toggle("active");
            });

        });
    });
})(jQuery);
