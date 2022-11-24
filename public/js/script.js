const password = document.querySelector("#password");
const passwordConfirm = document.querySelector("#password-confirm");
const peringatan = document.querySelector("#peringatan");
const icon = document.querySelector("#icon");
const iconConfirm = document.querySelector("#iconConfirm");

password.addEventListener("keyup", function(e){
    if(e.getModifierState("CapsLock")){
        peringatan.style.display = "block";
    }else{
        peringatan.style.display = "none";
    }
});

if (password.classList.contains("is-invalid")){
    icon.style.visibility = "hidden";
} else{
    icon.style.visibility = "visible";
}

icon.addEventListener("click", function() {
    if (password.className == "form-control active") {
        password.setAttribute("type", "text");
        icon.className = "fa-solid fa-eye text-secondary";
        password.className = "form-control";
    } else{
        password.setAttribute("type", "password");
        icon.className = "fa-solid fa-eye-slash text-secondary";
        password.className = "form-control active";
    }
});

iconConfirm.addEventListener("click", function() {
    if (passwordConfirm.className == "form-control active") {
        passwordConfirm.setAttribute("type", "text");
        iconConfirm.className = "fa-solid fa-eye text-secondary";
        passwordConfirm.className = "form-control";
    } else{
        passwordConfirm.setAttribute("type", "password");
        iconConfirm.className = "fa-solid fa-eye-slash text-secondary";
        passwordConfirm.className = "form-control active";
    }
});

passwordConfirm.addEventListener("keyup", function(e){
    if(e.getModifierState("CapsLock")){
        peringatan.style.display = "block";
    }else{
        peringatan.style.display = "none";
    }
});

// var swiper = new Swiper(".mySwiperLogin", {
//         spaceBetween: 30,
//         centeredSlides: true,
//         autoplay: {
//             delay: 2500,
//             disableOnInteraction: false,
//         },
//         pagination: {
//             el: ".swiper-pagination",
//             clickable: true,
//         },
//     });