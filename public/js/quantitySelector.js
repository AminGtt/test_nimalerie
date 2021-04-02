const selectors = document.querySelectorAll('.quantitySelector'),
    more = document.querySelectorAll('.qtyMore'),
    less = document.querySelectorAll('.qtyLess'),
    qty = document.querySelectorAll('.qty'),
    subs = document.querySelectorAll('.card_btn'),
    prices = document.querySelectorAll(".price");

for (let i = 0; i < selectors.length; i++){

    more[i].addEventListener('click', () => {
        qty[i].innerHTML++;
    })

    less[i].addEventListener('click', () => {
        if (qty[i].innerHTML > 1) {
            qty[i].innerHTML--;
        }
    })

    subs[i].addEventListener('click', () => {
        let wantedQty = qty[i].innerHTML,
            singlePrice = parseFloat(prices[i].innerHTML),
            total = singlePrice * wantedQty;

        alert('Quantité voulue ' + wantedQty + ' cela coute ' + total);
        qty[i].innerHTML = 1;
    })

}
