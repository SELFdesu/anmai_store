window.onload=function(){
	var week=document.getElementById('weekInner');
	var day=document.getElementById('day');
	var year=document.getElementById('year');
	var weekNum;
	var weekStr;
	var yearNum;
	var monthNum;
	var dateStr;
	
	var date=new Date();
	
	weekNum=date.getDay();
	switch(weekNum){
		case 0:weekStr='周日';break;
		case 1:weekStr='周一';break;
		case 2:weekStr='周二';break;
		case 3:weekStr='周三';break;
		case 4:weekStr='周四';break;
		case 5:weekStr='周五';break;
		case 6:weekStr='周六';break;
	}
	week.innerText=weekStr;
	
	day.innerText=date.getDate();
	
	yearNum=date.getFullYear();
	monthNum=date.getMonth()+1;
	dateStr=yearNum+'年'+monthNum+'月';
	year.innerText=dateStr;
}