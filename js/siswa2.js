var keyword = document.getElementById('kata');
var tombolCari = document.getElementById('tombol-search');
var container = document.getElementById('container');



keyword.addEventListener('keyup',function(){
	var xhr = new XMLHttpRequest();


	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			container.innerHTML = xhr.responseText;
		}
	}


xhr.open("GET","ajax/siswa.php?keyword=" + keyword.value, true);

xhr.send();



});

