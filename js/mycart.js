window.onload=function(){
	var all_check=document.getElementsByClassName('all_checkbox');
	var son_check=document.getElementsByClassName('son_check');

	var check_price=document.getElementById('check_price');

	var product_price=document.getElementsByClassName('product_price');
	var product_num=document.getElementsByClassName('product_num');

	var checked_pro_sub=[];
	var checked_pro_sub_res=[];
	var allprice=0;

		all_check[0].onclick=function(){
			if(all_check[0].checked){
				all_check[0].checked=true;
				all_check[1].checked=true;
				for(var j=0;j<son_check.length;j++){
					son_check[j].checked=true;
				}
				check_num.innerText=son_check.length;

				for(var k=0;k<son_check.length;k++){
					allprice+=Number(product_price[k].innerText)
				}
				check_price.innerText=allprice;
			}
			else{
				all_check[0].checked=false;
				all_check[1].checked=false;
				for(var j=0;j<son_check.length;j++){
					son_check[j].checked=false;
				}
				check_num.innerText=0;

				allprice=0;
				check_price.innerText=allprice;
			}
		}

		all_check[1].onclick=function(){
			if(all_check[1].checked){
				all_check[0].checked=true;
				all_check[1].checked=true;
				for(var j=0;j<son_check.length;j++){
					son_check[j].checked=true;
				}
				check_num.innerText=son_check.length;
				for(var k=0;k<son_check.length;k++){
					allprice+=Number(product_price[k].innerText)
				}
				check_price.innerText=allprice;
			}
			else{
				all_check[0].checked=false;
				all_check[1].checked=false;
				for(var j=0;j<son_check.length;j++){
					son_check[j].checked=false;
				}
				check_num.innerText=0;

				allprice=0;
				check_price.innerText=allprice;
			}
		}

		
		var son_check_flag=0;
		for(var i=0;i<son_check.length;i++){
			son_check[i].onclick=function(){
				for(var j=0;j<son_check.length;j++){
					if(son_check[j].checked){
						son_check_flag++;

						//计算总金额记录选中下标
						checked_pro_sub.push(j);
					}
				}

				//计算总金额记录选中下标
				checked_pro_sub_res=checked_pro_sub;
				checked_pro_sub=[];
				price_amount(checked_pro_sub_res);

				check_num.innerText=son_check_flag;

				if(son_check_flag==son_check.length){
					all_check[0].checked=true;
					all_check[1].checked=true;
					son_check_flag=0;
				}else{
					all_check[0].checked=false;
					all_check[1].checked=false;
					son_check_flag=0;
				}
			}
		}

		var pro_num_arr=[];
		var pro_price_arr=[];
		for(var i=0;i<product_num.length;i++){
			pro_num_arr.push(product_num[i].innerText);
			pro_price_arr.push(product_price[i].innerText);
		}


		function price_amount(checked_pro_sub_res){
			for(var i=0;i<checked_pro_sub_res.length;i++){
				allprice+=Number(product_price[checked_pro_sub_res[i]].innerText)
			}
			check_price.innerText=allprice;
			allprice=0;
		}


}