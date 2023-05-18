var eyes = document.getElementsByClassName("eyes");
var pass = document.getElementById("password");

function hideEye(element){
    eyes[0].classList.toggle("d-none");
    eyes[1].classList.toggle("d-none");
    if (pass.type === "password") {
        pass.type = "text";
      } else {
        pass.type = "password";
      }
}