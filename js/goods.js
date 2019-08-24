
let check = []
let slider = []
let output = []

let something = document.getElementsByClassName('rowid')

for( let j = 0; j < something.length; j++)
{
  let i = something[j].value

  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);
  output[i].innerHTML = slider[i].value;
  slider[i].onchange = (e) => 
  {
    console.log(i)
    output[i].innerHTML = e.target.value
    if(slider[i].value == 0)
    {
      check[i].checked = false;
      slider[i].hidden = true;
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
      if(checkedOne)
    {
      document.getElementById('goods_submit').disabled = false;
      document.getElementById('goods_submit').style.backgroundColor = 'green';
    }
    else{
      document.getElementById('goods_submit').disabled = true;
      document.getElementById('goods_submit').style.backgroundColor = 'grey';
    }
    }
  }
}


for( let j = 0; j < something.length; j++)
{
  let i = something[j].value
  check[i] = document.getElementById("mycheck"+i);
  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);  
  console.log(i)  
  check[i].onclick=()=>
  {
    console.log('hii')
    slider[i].hidden ?
    (slider[i].hidden = false, slider[i].value = 1 )
    : (slider[i].hidden = true,  slider[i].value = 0);
    
    output[i].innerHTML = slider[i].value;
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
    
    if(checkedOne)
    {
      document.getElementById('goods_submit').disabled = false;
      document.getElementById('goods_submit').style.backgroundColor = 'green';
    }
    else{
      document.getElementById('goods_submit').disabled = true;
      document.getElementById('goods_submit').style.backgroundColor = 'grey';
    }
      
    }
}

