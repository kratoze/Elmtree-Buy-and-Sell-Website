var loc = window.location.pathname;

//Sidebar functionality
$(document).ready(function() {
  $(".right.sidebar").sidebar("attach events", ".item.menu-trigger");
  //Accordian functionality
  $(".ui.accordion").accordion();

  $(".menu").find("a").each(function() {
    $(this).toggleClass("active", $(this).attr("href") == loc);
  });

  $('.ui.dropdown').dropdown({action: 'select'});

  $('.ui.search').search({});
});
