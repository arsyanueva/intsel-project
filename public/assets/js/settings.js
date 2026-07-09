(function($) {
  'use strict';
  $(function() {
    $(".nav-settings").on("click", function() {
      $("#right-sidebar").toggleClass("open");
    });
    $(".settings-close").on("click", function() {
      $("#right-sidebar,#theme-settings").removeClass("open");
    });

    $("#settings-trigger").on("click" , function(){
      $("#theme-settings").toggleClass("open");
    });

    //background constants
    var navbar_classes = "navbar-danger navbar-success navbar-warning navbar-dark navbar-light navbar-primary navbar-info navbar-pink";
    var sidebar_classes = "sidebar-light sidebar-dark";
    var $body = $("body");
    var $html = $("html");

    function setThemeAttribute(mode) {
      if (mode === 'dark') {
        $html.attr('data-bs-theme', 'dark');
      } else {
        $html.attr('data-bs-theme', 'light');
      }
    }

    function applyThemeMode(mode) {
      if (mode === 'dark') {
        $body.addClass('dark-mode');
        $body.removeClass(sidebar_classes).addClass('sidebar-dark');
        $('.navbar').removeClass(navbar_classes).addClass('navbar-dark');
        setThemeAttribute('dark');
      } else {
        $body.removeClass('dark-mode');
        $body.removeClass(sidebar_classes).addClass('sidebar-light');
        $('.navbar').removeClass(navbar_classes).addClass('navbar-light');
        setThemeAttribute('light');
      }

      updateThemeToggleText();
    }

    function updateThemeToggleText() {
      if ($body.hasClass('dark-mode')) {
        $('#theme-toggle').text('Light Mode');
      } else {
        $('#theme-toggle').text('Dark Mode');
      }
    }

    var savedThemeMode = localStorage.getItem('themeMode');
    var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedThemeMode === 'dark' || (!savedThemeMode && prefersDark)) {
      applyThemeMode('dark');
    } else {
      applyThemeMode('light');
    }

    $('#theme-toggle').on('click', function() {
      var newMode = $body.hasClass('dark-mode') ? 'light' : 'dark';
      localStorage.setItem('themeMode', newMode);
      applyThemeMode(newMode);
    });

    //sidebar backgrounds
    $("#sidebar-light-theme").on("click" , function(){
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-light");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
    });
    $("#sidebar-dark-theme").on("click" , function(){
      $body.removeClass(sidebar_classes);
      $body.addClass("sidebar-dark");
      $(".sidebar-bg-options").removeClass("selected");
      $(this).addClass("selected");
    });


    //Navbar Backgrounds
    $(".tiles.primary").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-primary");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.success").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-success");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.warning").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-warning");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.danger").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-danger");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.light").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-light");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.info").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-info");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.dark").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".navbar").addClass("navbar-dark");
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.default").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });
    $(".tiles.default").on("click" , function(){
      $(".navbar").removeClass(navbar_classes);
      $(".tiles").removeClass("selected");
      $(this).addClass("selected");
    });

    $(".color-theme.default").click(function(){
      $(".color-theme.default").attr({
        "href" : "https://www.bootstrapdash.com/demo/star-admin2-pro/template/demo/vertical-default-light/index.html",
        "title" : "Light"
      });
    });
    $(".color-theme.dark").click(function(){
      $(".color-theme.dark").attr({
        "href" : "https://www.bootstrapdash.com/demo/star-admin2-pro/template/demo/vertical-default-dark/index.html",
        "title" : "Dark"
      });
    });
    $(".color-theme.brown").click(function(){
      $(".color-theme.brown").attr({
        "href" : "https://www.bootstrapdash.com/demo/star-admin2-pro/template/demo/vertical-default-brown/index.html",
        "title" : "Brown"
      });
    });
  });
})(jQuery);
