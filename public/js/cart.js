let cart_wrapper = document.querySelector('.cart-wrapper'),
    cart = document.querySelector('.cart');

cart.addEventListener('click', () => {
    cart_wrapper.hasAttribute('hidden') ?
        cart_wrapper.removeAttribute('hidden') : cart_wrapper.setAttribute('hidden', "");
});
