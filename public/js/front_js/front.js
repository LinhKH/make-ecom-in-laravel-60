//Bootsshop-----------------------//
$(document).ready(function () {
    /* carousel of home page animation */
    $('#myCarousel').carousel({
        interval: 4000
    })
    $('#featured').carousel({
        interval: 4000
    })
    $(function () {
        $('#gallery a').lightBox();
    });

    $('.subMenu > a').click(function (e) {
        e.preventDefault();
        var subMenu = $(this).siblings('ul');
        var li = $(this).parents('li');
        var subMenus = $('#sidebar li.subMenu ul');
        var subMenus_parents = $('#sidebar li.subMenu');
        if (li.hasClass('open')) {
            if (($(window).width() > 768) || ($(window).width() < 479)) {
                subMenu.slideUp();
            } else {
                subMenu.fadeOut(250);
            }
            li.removeClass('open');
        } else {
            if (($(window).width() > 768) || ($(window).width() < 479)) {
                subMenus.slideUp();
                subMenu.slideDown();
            } else {
                subMenus.fadeOut(250);
                subMenu.fadeIn(250);
            }
            subMenus_parents.removeClass('open');
            li.addClass('open');
        }
    });
    var ul = $('#sidebar > ul');
    $('#sidebar > a').click(function (e) {
        e.preventDefault();
        var sidebar = $('#sidebar');
        if (sidebar.hasClass('open')) {
            sidebar.removeClass('open');
            ul.slideUp(250);
        } else {
            sidebar.addClass('open');
            ul.slideDown(250);
        }
    });

    // Customs Front Js here :^^
    $(".clslistView").click(function () {
        $("#myTab .clslistView").addClass('btn-primary');
        $("#myTab .clsblockView").removeClass('btn-primary');
    });

    $(".clsblockView").click(function () {
        $("#myTab .clsblockView").addClass('btn-primary');
        $("#myTab .clslistView").removeClass('btn-primary');
    });

    // pagination listing.blade.php
    $(document).on('click', '.pagination a', function (event) {
        var slug = event.target.attributes[1]['baseURI'].split('/');
        slug = slug.splice(-1).pop()
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page,slug);
    });

    function fetch_data(page=null,slug=null) {
        $.ajax({
            url: "/pagination/fetch_data?page=" + page + '&slug='+slug,
            success: function (data) {
                $('#table_data').html(data);
            }
        });
    }
});
