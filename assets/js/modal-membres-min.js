!function($){document.addEventListener("DOMContentLoaded",(function(e){$(document).ready((function($){$("#user-search-form").submit((function(e){e.preventDefault();var t=$("#search_user").val(),o=$("#user-search-form").find('input[name="user_search_nonce"]').val();t.length>0&&$.ajax({url:rescits_membres_ajax.ajax_url,type:"GET",data:{action:"search_users",search_user:t,user_search_nonce:o},success:function(e){$("#user-search-results").html(e),$(".default-list-membres").hide(),$(".wp-block-heading").hide()}})}))})),window.addEventListener("load",(function(e){document.querySelectorAll(".voir-bio");const t=this.document.getElementById("modal-membre"),o=this.document.getElementById("close-dialog"),n=this.document.getElementById("modal-overlay");var a,r=gsap.timeline({paused:!0});document.addEventListener("click",(function(e){if(e.target.matches(".voir-bio")){let o=e.target.closest(".membre-rescits"),i=t.querySelector(".dialog-content");i.innerHTML="",i.innerHTML=o.innerHTML,a=i.querySelectorAll(".to-up"),t.scrollTop=0,r.to(t,{display:"block",scrollTop:0,opacity:1,duration:.3}).to(n,{display:"block",opacity:1,duration:.3},"<").from(a,{y:50,opacity:0,stagger:.2,duration:.5,ease:"power2.out"}),r.play()}}),!1),o.addEventListener("click",(()=>{gsap.timeline({}).to(a,{opacity:0,stagger:.1,duration:.3,ease:"power2.in"}).to(t,{opacity:0,duration:.3}).to(n,{opacity:0,duration:.3}).set(t,{display:"none"}).set(n,{display:"none"}).then((()=>{}))}))}))}))}(jQuery);