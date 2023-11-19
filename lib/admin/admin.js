document.addEventListener("DOMContentLoaded",function(){
    var spanL = document.getElementById("spanL");
    var spanU = document.getElementById("spanU");
    var containerDiv = document.getElementById("contAdmin");
    
    spanL.addEventListener("click",function(){
        containerDiv.style.transform = "translateX(-432px)";
    });

    spanU.addEventListener("click",function(){
        containerDiv.style.transform = "translateX(0px)";
    });
})