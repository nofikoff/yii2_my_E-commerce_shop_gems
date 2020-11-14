$(document).ready(function () {

    if ($('.sel').length) {
        $('.sel').selectbox();
    }
    ;

    $('.mainMenu li').first().addClass('fLi');
    $('.mainMenu li').last().addClass('lLi');

    if ($('#sl').length) {
        $('#sl').carouFredSel({
            auto: false,
            prev: '#prev',
            next: '#next',
            scroll: {
                duration: 800,

                onBefore: function () {
                    $(this).delay(400),
                        $('.txtSlid').stop(true).animate({bottom: '-60px'}, 300);
                },
                onAfter: function () {
                    $('.txtSlid').stop(true).animate({bottom: '0'}, 300);
                }
            },
            pagination: '#pagin'
        });
    }
    ;

    $("head").append("<link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' />");
    $("head").append("<link rel='stylesheet' type='text/css' href='https://gems.ua/css/drift-basic.css' />");
    $("head").append("<link rel='stylesheet' type='text/css' href='https://gems.ua/css/font-ico-min.css' />");

    if ($('#newSl').length) {
        $('#newSl').slick({
            dots: false,
            infinite: true,
            speed: 300,
            prevArrow : '#nPrev',
            nextArrow : '#nNext',
            slidesToShow: 6,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ],
            adaptiveHeight: true
        })
    }
    ;

    $(window).load(function () {
        $('.stoneBlock').each(function () {
            var stI = $(this).children('.stoneImg');
            stI.css({
                marginTop: -((stI.height() / 2) - 5)
            })
        })
    })

    if ($('.tabs').length) {
        $('.tabs').liTabs({
            duration: 500,
            effect: 'hSlide'
        });
    }
    ;

    if ($('.tabs2').length) {
        $('.tabs2').liTabs({
            duration: 500,
            block: true
        });
    }
    ;


    $('.catalogList .catalogBlock:nth-child(5n)').addClass('cB_right');

    var flag = true;
    $('.sticky-filter').on('click', function () {
        if (flag == true) {
            flag = false;
            $('.filterCat').addClass('turn').stop(true).css( "width", "300px" );
            $('.sticky-filter').css( "display", "none" );
            $('.leftBlock').animate({left: 30}, 400);
        }
    });
    var sticky = new Sticky('#sticky-filter');
    $('.filterBtn').on('click', function () {
        if (flag == false) {
            flag = true;
            $('.sticky-filter').css( "display", "block" );
            $(this).parent().removeClass('turn').stop(true).css( "width", "40px" );
            $('.leftBlock').animate({left: -300}, 400);
        }
    })

    $("select[multiple] option").mousedown(function () {
        var $self = $(this);
        if ($self.attr("selected"))
            $self.attr("selected", "");
        else
            $self.attr("selected", "selected");
        return false;
    });

    $('.fCut').click(function () {
        $(this).parent('div').children('.fCut').removeClass('act');
        if ($(this).hasClass('act')) {
            $(this).removeClass('act');
        } else {
            if ($(this).hasClass('dis')) {

            } else {
                $(this).addClass('act');
            }
        }
    });

    $('.clearBtn').click(function () {
        $(this).parent().children('.mSel').children('option').each(function () {
            $(this).removeAttr("selected");
        });

        $(this).parent().children('.filterCut').children('.fCut').each(function () {
            $(this).removeClass("act");
        });

        $(this).parent().children('.filterZodiac').children('.fCut').each(function () {
            $(this).removeClass("act");
        })
    });




    if ($('#slider').length) {

        var value1 = $(".ftL span").text();
        var value2 = $(".ftR span").text();
        var div = $("div#slider");

        $('#slider').slider({
            orientation: "horizontal",
            range: true,
            min: 0,
            max: div.data("max"),

            values: [value1, value2],
            slide: function (event, ui) {


                $(".ftL span").text(ui.values[0]);
                $('.ftL input').val(ui.values[0]);

                $(".ftR span").text(ui.values[1]);
                $('.ftR input').val(ui.values[1]);


            }
        });
    }
    ;

    $('.switch').on('mousedown', function () {
        if ($(this).hasClass('hand')) {
            $(this).removeClass('hand');
            $(this).prev().addClass('act');
            $(this).next().removeClass('act');
        } else {
            $(this).addClass('hand');
            $(this).prev().removeClass('act');
            $(this).next().addClass('act');
        }
    });

    if ($('#abSt').length) {
        $('#abSt').slick({
            dots: false,
            infinite: true,
            speed: 300,
            prevArrow : '#abPrev',
            nextArrow : '#abNext',
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
            ],
            adaptiveHeight: true
        })
    }
    ;

    if ($('#thumbs').length) {
        $('#slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '#thumbs'
        });
        $('#thumbs').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            prevArrow : '.tPrev',
            nextArrow : '.tNext',
            asNavFor: '#slider-single',
            dots: false,
            focusOnSelect: true
        });

    }
    ;

    $('.tovarSliderMain').mouseenter(function() {
        $('#easy_zoom').css("display", "block");
    });
    $('.tovarSliderMain').mouseleave(function() {
        $('#easy_zoom').css("display", "none");
    });

    var thumbs = document.querySelectorAll('.jqzoom');
    var para = document.querySelector('#easy_zoom');

    for (var i = 0, len = thumbs.length; i < len; i++) {
        var thumb = thumbs[i];

        new Drift(thumb, {
            paneContainer: document.querySelector('#easy_zoom'),
            containInline: true,
            hoverBoundingBox: true
        });
    }

    // удаляем заглушку чтбы карусель не разлетьася
    $('div.topDivTempInvisible').removeClass("topDivTempInvisible");


    $(".youtube").each(function() {
        // Based on the YouTube ID, we can easily find the thumbnail image
        $(this).css('background-image', 'url(http://i.ytimg.com/vi/' + this.id + '/sddefault.jpg)');

        // Overlay the Play icon to make it look like a video player
        $(this).append($('<div/>', {'class': 'play'}));

        $(document).delegate('#'+this.id, 'click', function() {
            // Create an iFrame with autoplay set to true
            var iframe_url = "https://www.youtube.com/embed/" + this.id + "?autoplay=1&autohide=1";
            if ($(this).data('params')) iframe_url+='&'+$(this).data('params');

            // The height and width of the iFrame should be the same as parent
            var iframe = $('<iframe/>', {'frameborder': '0', 'src': iframe_url, 'width': $(this).width(), 'height': $(this).height() })

            // Replace the YouTube thumbnail with YouTube HTML5 Player
            $(this).replaceWith(iframe);
        });
    });
});