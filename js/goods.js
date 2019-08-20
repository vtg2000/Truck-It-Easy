
let check = []
let slider = []
let output = []




let num_rows = parseInt(document.getElementById('numrow').value) 
console.log(num_rows)
for( let i = 1; i < num_rows + 1   ; i++)
{
  check[i] = document.getElementById("mycheck"+i);
  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);  
  console.log(i)  
  check[i].onclick=()=>
  {
    console.log('hii')
    slider[i].hidden ?
    (slider[i].hidden = false )
    : (slider[i].hidden = true, output[i].innerHTML = '0');

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


for( let i = 1; i <  num_rows + 1  ; i++)
{
  slider[i] = document.getElementById("myRange"+i);
  output[i] = document.getElementById("demo"+i);
  output[i].innerHTML = slider[i].value;
  slider[i].onchange = (e) => 
  {
    console.log(i)
    output[i].innerHTML = e.target.value
  }
}