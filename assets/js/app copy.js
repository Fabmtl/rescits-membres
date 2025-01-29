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
            
            var tl = gsap.timeline();
            tl.from(modal,{
                x: 45,
                duration: 1,
                opacity:0
            });
           

            smallElements.forEach((element) => {
                element.addEventListener("click", () => {
                    
                    let parent = element.closest(".membre-rescits");
                    let modal_content = modal.querySelector(".dialog-content");
                    modal_content.innerHTML = parent.innerHTML;

                    modal.classList.add("open");
                    overlay.classList.add("open");
                    modal.scrollTop = 0
                    this.document.body.classList.add("modal-open");
                    animated_element_on_modal_open(modal_content);
                });
            });
            
            closeModal.addEventListener("click", () => {
                let modal_content = modal.querySelector(".dialog-content");
                modal_content.classList.remove("open");
                this.document.body.classList.remove("modal-open");
                modal.classList.remove("open");
                overlay.classList.remove("open");
            });

            animated_element_on_modal_open = (element) => {
                let children = element.querySelectorAll(".to-up");
                tl.from(
                    children, {
                        ease: "back",
                        opacity: 0,
                        duration: 1,
                        y: 40,
                        stagger: 0.15,
                    },">-0.5"
                );
                tl.play();
                // gsap.from(children, {
                //     ease: "back",
                //     opacity: 0,
                //     duration: 1,
                //     y: 40,
                //     stagger: 0.15,
                // });
            };

        });
    });
})(jQuery);
