arr = document.getElementsByClassName('arr')
mystatus = document.getElementsByClassName('mystatus')
now = new Date();

console.log(now)

for (i = 0 ; i < arr.length ; i++)
{
    
myarr = new Date(arr[i].innerHTML.replace('Arrival : ',''))
// console.log(myarr)
console.log(mystatus[i].innerHTML)
if(myarr < now)
{
    console.log('delivered');
    mystatus[i].innerHTML = "Delivered"
    mystatus[i].style.color = 'Green'
}
else
{
    console.log('delivering');
    mystatus[i].innerHTML = "In transit"
    mystatus[i].style.color = 'greenyellow'
}


}
