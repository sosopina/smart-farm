function btnAction(){
const user=document.getElementById("username");
const pass=document.getElementById("password");
if(user.value=="admin" && pass.value=="admin"){
document.getElementById("logbtn").style.display="none";
document.querySelector('.success').style.display="block";
setTimeout(btnAction, 5000);
let ref=window.location.href.toString();
newhref=ref.replace("index.php","home.php");
window.location.replace(newhref);
}
else{
    document.getElementById("logbtn").style.display="none";
    document.querySelector('.wrong').style.display="block";

}
}
function out(){
    const out=document.getElementById("out");
   window.location.replace("index.php");
}


