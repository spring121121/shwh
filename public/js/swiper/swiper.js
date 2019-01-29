var swiper = new Swiper('.swiper-addone', {
    loop : true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    }
});
var swiper = new Swiper('.swiper-addtwo', {
    loop : true,
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    }
});
var swiper = new Swiper('.swiper-addthree', {
    loop : true,
    autoplay: {
        delay: 7000,
        disableOnInteraction: false,
    }
});
var swiper = new Swiper('.swiper-add', {
    loop : true,
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
});

var swiper = new Swiper('.swiper-addList', {
    // loop : true,
    spaceBetween:5,
    slidesPerView:1.4,
    // centeredSlides: true,
    // autoplay: {
    //     delay: 5000,
    //     disableOnInteraction: false,
    // },

});