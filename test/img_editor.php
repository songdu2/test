<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>test</title>
	
	
	<script  src="http://code.jquery.com/jquery-latest.min.js"></script>

	<script>		

		$(document).on("contextmenu", "#canvas2", function(e){
			// offset : 이벤트 대상 객체의 상대적 마우스 좌표 (상위 relative 객체 기준)
			// client : 현재 보고있는 화면의 좌표(스크롤 무시)
			// page : 현재 페이지의 좌표
			// screen : 전체 모니터 스크린의 절대 좌표
			e.preventDefault();
			$("#contextMenu").hide();
			$("#contextMenu").css("left", e.clientX+"px");
			$("#contextMenu").css("top", e.clientY+"px");
			$("#contextMenu").show();
		});

		$(document).on("click", function(){
			$("#contextMenu").hide();
		});

		function getImg(idx){
		
			var editBox = document.createElement('div');
			//var imgDiv = document.createElement('div');
			var img = document.createElement('img');		
					
			//imgDiv.style.position = "absolute";
			//imgDiv.style.cursor = "pointer";
			//imgDiv.style.left = 0;
			//imgDiv.style.top = 0;
			//imgDiv.style.zIndex = 1;
			//imgDiv.setAttribute('id',idx);
			//imgDiv.setAttribute('class','img');

			img.src = "./img/"+idx+".jpg";

			editBox.style.position = "absolute";
			editBox.style.cursor = "move";
			editBox.style.left = "50px";
			editBox.style.top = "50px";
			editBox.style.zIndex = 1;
			editBox.style.backgroundColor = "rgb(255,255,255,0)";
			editBox.style.border = "1px dotted #ddd";
			editBox.style.width = img.width + "px";
			editBox.style.height = img.height + "px";


			img.onload = function() {
				var dotSize = 10;
				var dotColor = "#275b89";
				var _zero = "-5px";
				var _1x = (img.width)/2-(dotSize/2)+"px";
				var _2x = (img.width)-(dotSize/2)+"px";
				var _1y = (img.height)/2-(dotSize/2)+"px";
				var _2y = (img.height)-(dotSize/2)+"px";

				var dot1, dot2, dot3, dot4, dot5, dot6, dot7, dot8, dot9;
				for(var i=1; i<10; i++){
					eval("dot"+i+"=document.createElement('span')");
					eval("dot"+i+".style.position='absolute';");
					//eval("dot"+i+".style.display='none';");
					eval("dot"+i+".style.backgroundColor='"+dotColor+"';");
					eval("dot"+i+".style.width='"+dotSize+"px';");
					eval("dot"+i+".style.height='"+dotSize+"px';");
					eval("dot"+i+".setAttribute('class','dot"+i+"')");
					eval("dot"+i+".onclick=resizeDrag();");
					eval("editBox.appendChild(dot"+i+");");
				}

				dot1.style.left = _zero;
				dot1.style.top = _zero;
				dot1.style.cursor = "";

				dot2.style.left = _1x;
				dot2.style.top = _zero;

				dot3.style.left = _2x;
				dot3.style.top = _zero;

				dot4.style.left = _zero;
				dot4.style.top = _1y;

				dot5.style.left = _2x;
				dot5.style.top = _1y;

				dot6.style.left = _zero;
				dot6.style.top = _2y;

				dot7.style.left = _1x;
				dot7.style.top = _2y;

				dot8.style.left = _2x;
				dot8.style.top = _2y;
				
				dot9.style.left = _1x;
				dot9.style.top = "-35px";
			}

			editBox.appendChild(img);
			document.getElementById("canvas2").appendChild(editBox);
			
			editBox.addEventListener('click', function(){ },false);			
			editBox.addEventListener('mousedown', function(e){startDrag(e,this);} ,false);



		}

		// 캔버스 다운로드
		function downImg(){		
			var imgUrl = document.getElementById("canvas1").toDataURL("image/jpeg");
			console.log(imgUrl);

		}

		// 복사

		// 붙여넣기

		function resizeDrag(){
		
		}

		function rotateDrag(){
		
		}

		function moveDrag(){
		
		}

		//처음 이미지가 생성될곳을 지정해 줍니다
		var img_L = 10;
		var img_T = 20;
		var targetObj;

		// 드래그를 시작하는 함수 입니다. 움직였던 좌표에서 처음 드래그를 시작했던 좌표를 빼줍니다. 움직인 좌표를 나타내줍니다
		function startDrag(e, obj){
			targetObj = obj;								// 전역변수에 타겟 obj를 담는다
			var e_obj = window.event? window.event : e;		// 현재 드래그를 시작한 이벤트(마우스 좌표값 정보)객체를 담는다
			img_L = parseInt(obj.style.left.replace('px', '')) - e_obj.clientX;			// 이미지시작좌표에서 이미지에서 마우스 다운 이벤트를 시작한 좌표값의 차이를 구해서 이미지가 마우스를 따라가는 자연스러운 드래그 효과
			img_T = parseInt(obj.style.top.replace('px', '')) - e_obj.clientY;			// 이미지의 절대좌표와 마우스클릭좌표간의 차이
			
			/*
			console.log(getLeft(obj));
			console.log(getTop(obj));
			console.log(e_obj.clientX);
			console.log(e_obj.clientY);
			console.log(img_L);
			console.log(img_T);
			*/
			
			// 드래그 순서 > mousedown > mousemove > mouseup
			document.onmousemove = moveDrag;
			document.onmouseup = stopDrag;
			if(e_obj.preventDefault)e_obj.preventDefault();	// 
		}

		// 이미지를 움직이는 함수입니다 움직였던 위치만큼 처음 이미지가 있던 좌표를 더해줍니다 최종 위치입니다
		function moveDrag(e){
			//console.log("moveDrag");
			var e_obj = window.event? window.event : e;
			var dmvx = parseInt(e_obj.clientX + img_L);
			var dmvy = parseInt(e_obj.clientY + img_T);

			targetObj.style.left = dmvx +"px";
			targetObj.style.top = dmvy +"px";

			if(dmvx + targetObj.style.width <= 1000 && dmvy + targetObj.style.height <= 800){

			}

			return false;
		}

		// 드래그를 멈추는 함수 입니다
		function stopDrag(){
			//console.log("stopDrag");
			document.onmousemove = null;
			document.onmouseup = null;
		}		

		function removeAll(){
			document.getElementById("canvas2").innerHTML = '';
			//document.getElementById("canvas2").removeChild(document.getElementsByName('img'));
		}

	</script>

	<style>

		#canvas2 {width:1200px; height:800px; border: 1px solid black; position:relative; overflow:hidden;}

		#contextMenu {display:none; position:fixed; border: 1px solid #E6E6E6; z-index:1000; background-color:rgb(255,255,255,0.3)}
		#contextMenu div {color:#6E6E6E; padding:2px;}
		#contextMenu div:hover {background-color:#E6E6E6; color:#2E64FE; font-weight:bold;}

		button {background-color:#fff; padding:5px; border:1px solid #6E6E6E; margin:3px 3px 3px 0px;}
		
	</style>

</head>
<body>

	<div id="contextMenu">
		<div>복사</div>
		<div>붙여넣기</div>
		<div>모두삭제</div>
	</div>

	<div style="width:700px;">
		
		<div style="text-align:center;">
			<button onclick="return false;">실행취소</button>
			<button onclick="return false;">다시실행</button>
			<button onclick="return false;">중간저장</button>
			<button onclick="return false;">보관함</button>
			<button onclick="return false;">+</button>
			<button onclick="return false;">-</button>
			<button onclick="return false;">눈금자</button>
			<button onclick="removeAll(); return false;">초기화</button>
		</div>

		<hr>

		<div id="canvas2">

		</div>

		<div>

			<div>
				<button onclick="getImg('img1'); return false;">img1</button>
				<button onclick="getImg('img2'); return false;">img2</button>
			</div>

			<div>
				<input type="text"> <br/>
				<button>글씨만들기</button>
				<button onclick="downImg(); return false;">다운받기</button>
			</div>

			<svg width="100" height="100">
			  <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
			</svg>

		</div>

	</div>

	<!-- <img src="./img/img1.jpg" style="position:absolute; left:30px; top:750px; cursor:pointer; cursor:hand; border:0" onmousedown="startDrag(event, this)"> --> 
</body>
</html>




