
'use strict' 
let dollarUSLocale = Intl.NumberFormat('en-US');

let item = document.getElementById("priceFormat");
let price = document.getElementById("priceFormat").textContent;
var num = dollarUSLocale.format(price)
console.log(num);
item.innerHTML = num;

