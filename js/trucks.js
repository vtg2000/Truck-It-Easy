var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var checkedOne = Array.prototype.slice.call(checkboxes);
for(let i=0; i<checkedOne.length; i++)
{
    checkedOne[i].onchange = () => {
        console.log('clickk')
        for(let j=0; j<checkedOne.length; j++)
        {
            if(i !== j)
            {
                console.log(i, j)
                checkedOne[j].checked = false;
            }
            
        }
        if(checkedOne.some(x => x.checked))
    {
      
      document.getElementById('trucks_submit').disabled = false;
      document.getElementById('trucks_submit').style.backgroundColor = 'green';
    }
    else{
      document.getElementById('trucks_submit').disabled = true;
      document.getElementById('trucks_submit').style.backgroundColor = 'grey';
    }

       
     };
}

