window.onload=function(){
    var checkall=document.getElementById('del');
    var checked_child=document.getElementsByClassName('checked_child');
    var flag=0;
    checkall.onclick=function(){
        for(var i=0;i<checked_child.length;i++){
            checked_child[i].checked=checkall.checked;
        }
    }

    for(var i=0;i<checked_child.length;i++){
        checked_child[i].onclick=function(){
            for(var j=0;j<checked_child.length;j++){
                if(checked_child[j].checked){
                    flag++;
                }
            }
            if(flag==checked_child.length){
                checkall.checked=true;
                flag=0;
            }else{
                checkall.checked=false;
                flag=0;
            }
        }
    }
}