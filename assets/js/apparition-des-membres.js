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
                        duration: 1,
                        stagger: 0.15,
                        overwrite: true,
                    });
                },
            });

        });
    });
})(jQuery);
