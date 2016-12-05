
function validatePassword()
{
	var x=document.forms["myForm"]["password"].value;
	if (x==null || x=="")
	{
		alert("Password required ");
		return false;
	}
 
 	if(! /[A-Z]/.test(x))
	{
		alert("Password must have a upper character ");
		return false;
	}
	
	if(! /[0-9]/.test(x))
	{
		alert("Password must have a digit ");
		return false;
	}
  
}

var global;

function showModalWin(obj) 
{
 
	var darkLayer = document.createElement('div'); // слой затемнения
		darkLayer.id = 'shadow'; // id чтобы подхватить стиль
        document.body.appendChild(darkLayer); // включаем затемнение
 
    var modalWin = document.getElementById('popupWin'); // находим наше "окно"
        modalWin.style.display = 'block'; // "включаем" его
 
	global = obj; //получаем значение вызывающего функцию элемента*****
	document.getElementById('textarea').value= global.innerHTML; //присваиваем значение 'textarea' *****
 
    darkLayer.onclick = function () {  // при клике на слой затемнения все исчезнет
        darkLayer.parentNode.removeChild(darkLayer); // удаляем затемнение
        modalWin.style.display = 'none'; // делаем окно невидимым
            return false;
        };
}

function setContent()
{
	global.innerHTML=document.getElementById('textarea').value;
}