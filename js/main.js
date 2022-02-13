
// GLOBEL - TOP NAV
const menu = document.getElementById('hamburger-1');
menu.addEventListener('click', function () {
    menu.classList.toggle('is-active');
});

// INDEX - HERO
const isSlider = document.querySelector('.hero-slider');
if(isSlider){
    // const text = document.querySelector('.hero-text');
    // text.style.opacity = 0;

    var slider = tns({
        container: '.hero-slider',
        mode: 'gallery',
        items: 1,
        speed: 600,
        autoplay: true,
        autoplayButtonOutput: false,
        controls: false,
        swipeAngle: false
    });

    // INDEX - LOADING
    // window.onload = function() {
    //     const poem = document.querySelector('.hero-text__wording');
    //     const name = document.querySelector('.hero-text__sign');

    //     poem.classList.add('animate__animated', 'animate__fadeIn');
    //     name.classList.add('animate__animated', 'animate__fadeIn', 'animate__delay-1s');

    //     text.style.opacity = 1;
    // }
}

// ARTICLETYPE - ACCRODING
const isBtnArrow = document.querySelector('.btn-style__arrow');
if(isBtnArrow){
    isBtnArrow.addEventListener('click', () => { 
        isBtnArrow.classList.toggle('active'); 
        document.querySelector('.close-wrap').classList.toggle('active');
    });
}

// ARTICLETYPE - DEMO
const isArticletype = document.querySelector('.jsArticletype');
if(isArticletype){
    const bookLink = document.querySelectorAll('.book-wrap__link');
    for(let i = 0; i<bookLink.length; i++){
        bookLink[i].addEventListener('click', function(el){
            document.querySelector('.jsArticletype').classList.add("d-none");
            document.querySelector('.jsArticletypePage').classList.remove("d-none");
        })
    }
}

// VIDEOTYPES
const isVideoMenu = document.querySelector('.inside-menu');
if(isVideoMenu) {
    const videoLink = document.querySelectorAll('.inside-menu__wrap');
    for(let i = 0; i<videoLink.length; i++){
        videoLink[i].querySelector(".inside-menu__link").addEventListener('click', function(el){
            this.parentElement.classList.toggle("active");
        })
    }


}

// VIDEOTYPES - MODAL
const isVideotypes = document.getElementById('videoModal');
if(isVideotypes) {
    const ytURL = 'https://www.youtube.com/embed/';
    const modalIframe = isVideotypes.getElementsByTagName('iframe')[0];

    isVideotypes.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-bs-video');
        
        const modalTitle = isVideotypes.querySelector('.modal-title');

        modalTitle.textContent = button.innerHTML;
        modalIframe.setAttribute('src', ytURL + url);
    });

    isVideotypes.addEventListener('hidden.bs.modal', function (event) {
        modalIframe.setAttribute('src', '');
    });
}

// MEMBER - MSG MODAL
const isMsg = document.getElementById('msgModal');
if(isMsg) {
    const msgBox = isMsg.querySelector('.jsMsgModalWrap');

    isMsg.addEventListener('show.bs.modal', function (event) {
        const msg = event.relatedTarget;
        const user = msg.querySelector('.msg-wrap__msg .truncate');
        const adm = msg.querySelector('.msg-wrap__reply .truncate');

        let masgTxt = `
        <div class="msg-wrap__msg">
            <p class="msg-wrap__time">${user.getAttribute('data-bs-msgtime')}</p>
            <div class="txt">${user.innerHTML}</div>
        </div>
        <div class="msg-wrap__reply">
            <p class="msg-wrap__time">${adm.getAttribute('data-bs-msgtime')}</p>
            <div class="txt">${adm.innerHTML}</div>
        </div>
        `

        msgBox.innerHTML = masgTxt;
    });
}