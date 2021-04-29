let bg1 = document.querySelector('.bg_home_menu'),
    bg2 = document.querySelector('.fader')
    timeout = 250;

$(".chiens").hover(() => {
    bg2.setAttribute('src', '../images/front/chien2.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/chien2.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".chats").hover(() => {
    bg2.setAttribute('src', '../images/front/chat2.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/chat2.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".oiseaux").hover(() => {
    bg2.setAttribute('src', '../images/front/bird3.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/bird3.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".rongeurs").hover(() => {
    bg2.setAttribute('src', '../images/front/rongeur1.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/rongeur1.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".poissons").hover(() => {
    bg2.setAttribute('src', '../images/front/fish1.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/fish1.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".reptiles-co").hover(() => {
    bg2.setAttribute('src', '../images/front/reptil1.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/reptil1.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});

$(".animalerie-3-0").hover(() => {
    bg2.setAttribute('src', '../images/front/space1.jpg');
    bg2.style.opacity = '100%';

    setTimeout(() => {
        bg1.setAttribute('src', '../images/front/space1.jpg');
        bg2.style.opacity = '0%';
    }, timeout)
});
