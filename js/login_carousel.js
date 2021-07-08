addEventListener('load', function() {
	var carLInner = document.getElementById('carLInner');
	var but = document.getElementsByClassName('button');
	var leftShift = document.getElementsByClassName('leftShift')[0];
	var rightShift = document.getElementsByClassName('rightShift')[0];
	var width = 0;
	var lWidth;
	var timer;
	var flag = 0;
	// 左下角按钮切换开始
	for (var i = 0; i < 5; i++) {
		but[i].setAttribute('index', i);
	}
	for (var i = 0; i < 5; i++) {
		but[i].onmouseover = function() {
			clearInterval(timer);
			width = this.getAttribute('index') * -650
			carLInner.style.left = width + 'px'
			timer = setInterval(carousel, 5000);
		}
	}
	// 左下角按钮切换结束
	
	// 左右切换按钮开始
	leftShift.onclick = function() {
		if (width == 0) {
			clearInterval(timer);
			width = -2600;
			carLInner.style.left = width + 'px';
			timer = setInterval(carousel, 5000);
		} else {
			clearInterval(timer);
			width += 650;
			carLInner.style.left = width + 'px';
			timer = setInterval(carousel, 5000);
		}

	}
	rightShift.onclick = function() {
		if (width == -2600) {
			clearInterval(timer);
			width = 0;
			carLInner.style.left = width + 'px';
			timer = setInterval(carousel, 5000);
		} else {
			clearInterval(timer);
			width -= 650;
			carLInner.style.left = width + 'px';
			timer = setInterval(carousel, 5000);
		}

	}
	// 左右切换按钮结束
	
	// 轮播自动切换开始
	timer = setInterval(carousel, 3000);

	function carousel() {
		width -= 650
		if (width == -3250) {
			width = 0;
		}
		carLInner.style.left = width + 'px';
	}
	setInterval(listener, 20);
	// 轮播自动切换结束
	
	// 左下角圆圈与播放中图片对应监听
	function listener() {
		switch (width) {
			case 0:
				for (var i = 0; i < 5; i++) {
					but[i].style.backgroundColor = 'rgba(255,255,255,1)';
				};
				but[0].style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
				break;
			case -650:
				for (var i = 0; i < 5; i++) {
					but[i].style.backgroundColor = 'rgba(255,255,255,1)';
				};
				but[1].style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
				break;
			case -1300:
				for (var i = 0; i < 5; i++) {
					but[i].style.backgroundColor = 'rgba(255,255,255,1)';
				};
				but[2].style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
				break;
			case -1950:
				for (var i = 0; i < 5; i++) {
					but[i].style.backgroundColor = 'rgba(255,255,255,1)';
				};
				but[3].style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
				break;
			case -2600:
				for (var i = 0; i < 5; i++) {
					but[i].style.backgroundColor = 'rgba(255,255,255,1)';
				};
				but[4].style.backgroundColor = 'rgba(0, 0, 0, 0.6)';
				break;
		}
	}
})
