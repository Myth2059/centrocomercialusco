document.addEventListener('DOMContentLoaded', function() {

const input = document.getElementById("tipoLocal");
const selector = document.getElementById("mainSelection");
// ----->---->------>

input.addEventListener("focus",()=>{
selector.style.display = "block";
});
input.addEventListener("focusout",()=>{
    setTimeout(() => {
        selector.style.display = "none";
    }, 150);

});

// ----->---->------>
var firstCat = document.getElementsByClassName("firstCategory");
var firstArray = Array.from(firstCat);


firstArray.forEach(first =>{
    
    var current = first.getElementsByClassName("firstOption")[0].textContent;
    var options = first.getElementsByClassName("selectOptions");
    var optionsArray = Array.from(options);

    optionsArray.forEach(option => {

        option.addEventListener("click",(e) => {
            console.log("clicked");
            input.value=current + " > " +e.target.textContent;        
        });
    
    });

})




});