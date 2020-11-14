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

    if ($('#newSl').length) {
        $('#newSl').carouFredSel({
            auto: false,
            prev: '#nPrev',
            next: '#nNext',
            scroll: {
                items: 1
            }
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
    $('.filterBtn').on('click', function () {
        if (flag == true) {
            $(this).parent().addClass('turn').stop(true).animate({width: 215}, 400);
            flag = false;
        } else {
            $(this).parent().removeClass('turn').stop(true).animate({width: 40}, 400);
            flag = true;
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
        $('#abSt').carouFredSel({
            auto: false,
            prev: '#abPrev',
            next: '#abNext',
            scroll: {
                items: 1
            }
        })
    }
    ;

    if ($('#tovarSlider').length) {
        $('#thumbs a').each(function (i) {
            $(this).addClass('itm' + i);
            $(this).click(function () {
                $('#tovarSlider').trigger('slideTo', [i, 0, true]);
                return false;
            })
        });

        $('#thumbs a.itm0').addClass('selected');

        $('#tovarSlider').carouFredSel({
            auto: false,
            scroll: {
                items: 1,
                fx: 'uncover',
                duration: 600,
                onBefore: function () {
                    var pos = $(this).triggerHandler('currentPosition');
                    $('#thumbs a').removeClass('selected');
                    $('#thumbs a.itm' + pos).addClass('selected');
                }
            }
        });

        $('#thumbs').carouFredSel({
            direction: 'left',
            infinite: false,
            auto: false,
            prev: '.tPrev',
            next: '.tNext',
            items: 3,
            scroll: {
                items: 1
            }
        });
    }
    ;


    if ($('#tovarSliderItem').length) {
        $('#thumbs a').each(function (i) {
            $(this).addClass('itm' + i);
            $(this).click(function () {
                $('#tovarSliderItem').trigger('slideTo', [i, 0, true]);
                return false;
            })
        });

        $('#thumbs a.itm0').addClass('selected');

        $('#tovarSliderItem').carouFredSel({
            auto: false,
            scroll: {
                items: 1,
                fx: 'uncover',
                duration: 600,
                onBefore: function () {
                    var pos = $(this).triggerHandler('currentPosition');
                    $('#thumbs a').removeClass('selected');
                    $('#thumbs a.itm' + pos).addClass('selected');
                }
            }
        });

        $('#thumbs').carouFredSel({
            direction: 'left',
            infinite: false,
            auto: false,
            prev: '.tPrev',
            next: '.tNext',
            items: 3,
            scroll: {
                items: 1
            }
        });
    }
    ;

    // удаляем заглушку чтбы карусель не разлетьася
    $('div.topDivTempInvisible').removeClass("topDivTempInvisible");


});