const selectors = document.querySelectorAll('.quantitySelectorOnCard') + document.querySelectorAll('.quantitySelectorOnDetails'),
    more = document.querySelectorAll('.qtyMore'),
    less = document.querySelectorAll('.qtyLess'),
    qty = document.querySelectorAll('.qty');

for (let i = 0; i < selectors.length; i++){

    if (more[i]){
        more[i].addEventListener('click', () => {
            qty[i].value++;
        })
    }

    if (less[i]){
        less[i].addEventListener('click', () => {
            if (qty[i].value > 1) {
                qty[i].value--;
            }
        })
    }
}

function setCookie(cookieName, cookieValue) {
    let date = new Date();
    date.setTime(date.getTime() + (24*60*60*1000)); // set expiration to 24hours
    const expires = "expires="+ date.toUTCString();
    document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
}

function deleteCookie(cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/"
}

function getCookie(cookieName) {
    let name = cookieName + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(cookieName, cookieValue) {
    if (getCookie(cookieName) !== '') {
        setCookie();
    } else {
        setCookie();
    }
}
