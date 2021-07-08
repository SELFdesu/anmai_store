window.onload=function(){
	var introduce_title=document.getElementsByClassName('introduce_title')[0];
	var evaluate_title=document.getElementsByClassName('evaluate_title')[0];
	var introduce_content=document.getElementsByClassName('introduce_content')[0];
	var evaluate_content=document.getElementsByClassName('evaluate_content')[0];

	introduce_title.style.borderBottom='3px solid black';
	introduce_title.onclick=function(){
		introduce_content.style.display='block';
		introduce_title.style.borderBottom='3px solid black';
		
		evaluate_content.style.display='none';
		evaluate_title.style.borderBottom='none';
	}
	
	evaluate_title.onclick=function(){
		evaluate_content.style.display='block';
		evaluate_title.style.borderBottom='3px solid black';
		
		introduce_content.style.display='none';
		introduce_title.style.borderBottom='none';
	}
	
}