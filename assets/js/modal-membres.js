(function ($) {
    "use-strict";

    //wait until DOM is ready
    document.addEventListener("DOMContentLoaded", function (event) {
        // console.log("DOM loaded");
        
        function set_voir_bio_buttond(){
            
        }

        $(document).ready(function($) {
            $('#user-search-form').submit(function(e) {
                e.preventDefault();  // Empêche le rechargement de la page

                var search_query = $('#search_user').val();
                var nonce = $('#user-search-form').find('input[name="user_search_nonce"]').val(); // Récupère le nonce

                if (search_query.length > 0) {
                    $.ajax({
                        // url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        url: rescits_membres_ajax.ajax_url,
                        type: 'GET',
                        data: {
                            action: 'search_users',
                            search_user: search_query,
                            user_search_nonce: nonce  // Envoie le nonce avec la requête
                        },
                        success: function(response) {
                            $('#user-search-results').html(response);
                            $('.default-list-membres').hide();
                            $('.wp-block-heading').hide();
                        }
                    });
                }
            });
        });

        //wait until images, links, fonts, stylesheets, and js is loaded
        window.addEventListener("load", function (e) {

            const smallElements = document.querySelectorAll(".voir-bio");
            const modal = this.document.getElementById("modal-membre");
            const closeModal = this.document.getElementById("close-dialog");
            const overlay = this.document.getElementById("modal-overlay");

            //    var timeline;
            var timeline = gsap.timeline({ paused: true });
            var modalChildren;

            document.addEventListener('click', function (event) {

                if (event.target.matches('.voir-bio')) {
                    // Run your code to open a modal
                    let parent = event.target.closest(".membre-rescits");
                    let modal_content = modal.querySelector(".dialog-content");
                    modal_content.innerHTML = "";
                    modal_content.innerHTML = parent.innerHTML;
                    modalChildren = modal_content.querySelectorAll(".to-up");
                    
                    // overlay.classList.add("open");
                    modal.scrollTop = 0;

                    timeline
                        .to(modal, {
                            display: "block",
                            scrollTop: 0,
                            opacity: 1,
                            duration: 0.3,
                        }) // Fade in modal
                        .to(
                            overlay,
                            { display: "block", opacity: 1, duration: 0.3 },
                            "<"
                        ) // Fade in overlay
                        .from(modalChildren, {
                            y: 50,
                            opacity: 0,
                            stagger: 0.2,
                            duration: 0.5,
                            ease: "power2.out",
                        });

                    timeline.play();
                }
            
                // if (event.target.matches('.close')) {
                //     // Run your code to close a modal
                // }
            
            }, false);

            // Open modal animation
            // smallElements.forEach((element) => {
                
            //     element.addEventListener("click", () => {
                    
            //         let parent = element.closest(".membre-rescits");
            //         let modal_content = modal.querySelector(".dialog-content");

                    // modal_content.innerHTML = "";
                    // modal_content.innerHTML = parent.innerHTML;
                    // modalChildren = modal_content.querySelectorAll(".to-up");
                    
                    // // overlay.classList.add("open");
                    // modal.scrollTop = 0;

                    // timeline
                    //     .to(modal, {
                    //         display: "block",
                    //         scrollTop: 0,
                    //         opacity: 1,
                    //         duration: 0.3,
                    //     }) // Fade in modal
                    //     .to(
                    //         overlay,
                    //         { display: "block", opacity: 1, duration: 0.3 },
                    //         "<"
                    //     ) // Fade in overlay
                    //     .from(modalChildren, {
                    //         y: 50,
                    //         opacity: 0,
                    //         stagger: 0.2,
                    //         duration: 0.5,
                    //         ease: "power2.out",
                    //     });

                    // timeline.play();
            //     },true);
            // });
            closeModal.addEventListener("click", () => {
                const timelineback = gsap.timeline({});

                timelineback
                    .to(modalChildren, {
                        opacity: 0,
                        stagger: 0.1,
                        duration: 0.3,
                        ease: "power2.in",
                    }) // Reverse children animation
                    .to(modal, { opacity: 0, duration: 0.3 }) // Fade out modal
                    .to(overlay, { opacity: 0, duration: 0.3 }) // Fade out overlay
                    .set(modal, { display: "none" }) // Hide modal
                    .set(overlay, { display: "none" }) // Hide modal
                    .then(() => {
                        // Reset the main timeline so it can replay
                        // timeline.seek(0).pause();
                        // timelineback.seek(0).pause();
                        // modalChildren = null;
                    });
            });
            
            
        });
    });
})(jQuery);
