jQuery,document.addEventListener("DOMContentLoaded",(function(t){gsap.registerPlugin(ScrollTrigger),window.addEventListener("load",(function(t){const e=gsap.utils.toArray(".membre-rescits");gsap.set(e,{y:50,opacity:0}),ScrollTrigger.batch(".membre-rescits",{batchMax:3,start:"top 80%",end:"bottom 20%",onEnter:t=>{gsap.to(t,{y:0,opacity:1,duration:.6,stagger:.3,overwrite:!0})}})}))}));