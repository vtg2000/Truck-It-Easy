function hideloc() {
  // console.log('i ran')

  document.getElementById('location').hidden = true;
  document.getElementById('goods').hidden = false;
  document.getElementById('goods').className = "animate-reveal animate-first";

}

function hidegoods() {
  // console.log('i ran')

  document.getElementById('goods').hidden = true;
  document.getElementById('truck').hidden = false;
  document.getElementById('truck').className = "animate-reveal animate-first";

}