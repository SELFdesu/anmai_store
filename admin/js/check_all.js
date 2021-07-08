window.onload=function(){
    var all_check=document.getElementById('all_check');
    var check_child=document.getElementsByClassName('check_child');
    var flag=0;
    all_check.onclick=function(){
        for(var i=0;i<check_child.length;i++){
            check_child[i].checked=all_check.checked;
        }
    }

    for(var i=0;i<check_child.length;i++){
        check_child[i].onclick=function(){
            for(var j=0;j<check_child.length;j++){
                if(check_child[j].checked){
                    flag++;
                }
            }
            if(flag==check_child.length){
                all_check.checked=true;
                flag=0;
            }else{
                all_check.checked=false;
                flag=0;
            }
        }
    }

    
}