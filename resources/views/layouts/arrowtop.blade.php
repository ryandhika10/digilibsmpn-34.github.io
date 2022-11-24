<button class="to-top" id="to-top">
    <i class="fa-solid fa-chevron-up"></i>
</button>

<script>
    const toTop = document.querySelector("#to-top");
    window.onscroll = function() {myFunction()};

    function myFunction() {
        if (document.documentElement.scrollTop > 100) {
            document.getElementById("to-top").className = "to-top active";
        } else {
            document.getElementById("to-top").className = "to-top";
        }
    }
    toTop.addEventListener("click", function(){
        window.scrollTo(0,0);
    })
</script>