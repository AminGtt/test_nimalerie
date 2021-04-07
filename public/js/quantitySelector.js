const selectors = document.querySelectorAll('.quantitySelectorOnCard') + document.querySelectorAll('.quantitySelectorOnDetails'),
    more = document.querySelectorAll('.qtyMore'),
    less = document.querySelectorAll('.qtyLess'),
    qty = document.querySelectorAll('.qty'),
    subs = document.querySelectorAll('.submit_cart_btn'),
    prices = document.querySelectorAll(".price"),
    productIds = document.querySelectorAll('.productId');

for (let i = 0; i < selectors.length; i++){

    if (more[i]){
        more[i].addEventListener('click', () => {
            qty[i].innerHTML++;
        })
    }

    if (less[i]){
        less[i].addEventListener('click', () => {
            if (qty[i].innerHTML > 1) {
                qty[i].innerHTML--;
            }
        })
    }

    if (subs[i]){
        subs[i].addEventListener('click', () => {

            // deleteCookie('Total');
            // deleteCookie('Quantity');

            let wantedQty = qty[i].innerHTML,
                singlePrice = parseFloat(prices[i].innerHTML),
                total = singlePrice * wantedQty,
                productId = productIds[i].innerHTML;

            total = total.toFixed(2);


            setCookie('TotalPerArticle', total);
            setCookie('ProductId', productId);
            setCookie('Quantity', wantedQty);
            location.reload();
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
