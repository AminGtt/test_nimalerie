let fill_rotation = 180;
let fix_rotation = fill_rotation*2;

let mainTl = new TimelineMax({paused: true});

$(".step:not(.first) .radial-progress").each(function(i){
    let circle = $(this);
    let line = 	circle.prev('.line').find('.progress');
    let circleFill = circle.find('.fill:not(.fix)');
    let circleMask = circle.find('.mask.full');
    let circleFillMix = circle.find('.fill.fix');

    mainTl.to(line, 0.15, {width: "100%"})
        .to(circle, 0.3, {rotation: "-="+fill_rotation}, "fillCircle-"+i+"")
        .to([circleFill, circleMask], 0.3, {rotation: fill_rotation}, "fillCircle-"+i+"")
        .to(circleFillMix, 0.3, {rotation: fix_rotation}, "fillCircle-"+i+"")
        .set(circleFillMix, {rotation: fix_rotation}, "stopPoint-"+i+"");
});

// A ADAPTER A MES SOUHAITS

$('.step .radial-progress').dblclick(function(){
    if($(this).hasClass('active')){
        return false;
    }

    animateToDefault();

    $('.active').removeClass('active');

    let index = parseInt($(this).attr('data-index'));
    mainTl.tweenTo("stopPoint-"+(index-1)+"", {onComplete: animateToActive, onCompleteParams:[$(this)]});
});

// trigger de l'animation

function animateToActive(el) {
    let index = parseInt(el.attr('data-index')) + 1;
    $('.copy-holder').find(".step-"+index+"").addClass('active');
    el.addClass('active');

    let innerCircle = el.find('.inner-circle');
    let inset = el.find('.inset');
    let circle = el.find('.circle');
    let mask = el.find('.mask');
    let fill = el.find('.fill');
    let number = el.next('p');
    let stepsCopy = $('.copy-holder div.active');

    TweenLite.set(number, {color: "rgb(250,250,250)", fontSize: 46})
    TweenLite.to(innerCircle, 0.15, {scale: 0});
    TweenLite.to(el, 0.3, {scale: 1.3, zIndex: 10, ease: Back.easeOut});
    TweenLite.fromTo(stepsCopy, 0.7, {autoAlpha: 0}, {autoAlpha: 1});
}

function animateToDefault(){
    let mainCircle = $('.radial-progress.active');
    let innerCircle = $('.radial-progress.active').find('.inner-circle');
    let inset = $('.radial-progress.active').find('.inset');
    let number = $('.radial-progress.active').next('p');
    let stepsCopy = $('.copy-holder div');

    TweenLite.to(innerCircle, 0.15, {scale: 1})
    TweenLite.set(number, {color: "rgb(119,119,119)", fontSize: 30});
    TweenLite.to(mainCircle, 0.3, {scale: 1, zIndex: 1, ease: Bounce.easeOut});
    TweenLite.to(stepsCopy, 0.7, {autoAlpha: 0});
}
