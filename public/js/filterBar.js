const mySlider = $( "#slider-range" );

let prices = document.querySelectorAll(".price"),
    minPrice = 1,
    maxPrice = 0,
    minBudget, maxBudget;

for (let price of prices) {
    let parsedPrice = parseFloat(price.innerHTML);

    if (parsedPrice > maxPrice) {
        maxPrice = parsedPrice;
    }
}

mySlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [ minPrice, maxPrice ],
    slide: function( event, ui ) {
        minBudget = Number(expon(ui.values[0])).toFixed(0);
        maxBudget = Number(expon(ui.values[1])).toFixed(0);
        $("#minamount").val(minBudget + "€");
        $("#maxamount").val(maxBudget + "€");
    }
});

$( "#minamount" ).val(minPrice + "€");
$( "#maxamount" ).val(maxPrice + "€");


function expon(val) {
    var minv = Math.log(minPrice);
    var maxv = Math.log(maxPrice);
    var scale = (maxv - minv) / (maxPrice - minPrice);
    return Math.exp(minv + scale * (val - minPrice));
}

// END SLIDER // START ACCORDION
$( "#accordion" ).accordion({
    collapsible: true,
    heightStyle: 'content'
});
// END ACCORDION // START SELECTMENU
$(function() {
    let select = $('#categorie');

    select.selectmenu({
        change: function (event, ui) {}
    });

    select.on('selectmenuchange', (event, ui) => {
        let url = 'https://localhost:8000' + ui.item.value;

        setTimeout(() => {
            document.location.href = url;
        }, 500);
    })
});
// END SELECTMENU
