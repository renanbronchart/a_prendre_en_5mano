$(document).on("ready",function(){var n=n||{};!function(n){var o=function(){"matchMedia"in window&&(window.matchMedia("(min-width:768px)").matches?n.device="desktop":n.device="mobile")},e=function(){console.log("init"),o(),$(window).on("resize",function(){o()}),$(document).on("ready",function(){})};e()}(n)}),$(document).ready(function(){var n=0,o=$("#header").height();$("#header-wrap").height($("#header").height()),$(window).scroll(function(){var e=$(this).scrollTop();e>o&&e>n?$("#header-wrap").slideUp():$("#header-wrap").slideDown(),n=e})}),function(){$(document).on("ready",function(){var n=$("#participation_don").offset().top;$(document).on("scroll",function(){var o=$(window).scrollTop();o>=n-400&&$(".welcome").addClass("on")})})}();