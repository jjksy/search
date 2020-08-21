<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>여러개 마커에 이벤트 등록하기1</title>
    
</head>
<body>
<div id="map" style="width:100%;height:800px;"></div>

<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=5ce27f8a72f118234352d6cccf1a97db"></script>
<script>
var mapContainer = document.getElementById('map'), // 지도를 표시할 div  
    mapOption = { 
        center: new kakao.maps.LatLng(33.3650575,126.5306794), // 지도의 중심좌표
        level: 8 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
 
// 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 
var positions = [
    {
        content: '<div>제주국제공항</div>', 
        latlng: new kakao.maps.LatLng(33.510418,126.4891647)
    },
    {
        content: '<div>춘심이네</div>', 
        latlng: new kakao.maps.LatLng(33.2647334,126.3683909)
    },
    {
        content: '<div>제인웰빙하우스</div>', 
        latlng: new kakao.maps.LatLng(33.4635488,126.6088612)
    },
    {
        content: '<div>더로맨틱</div>', 
        latlng: new kakao.maps.LatLng(33.4377694,126.6723254)
    },
    {
        content: '<div>세븐일레븐 서귀포 천지연점</div>', 
        latlng: new kakao.maps.LatLng(33.244692,126.5576238)
    },
    {
        content: '<div>제주국제공항 JDC면세점</div>', 
        latlng: new kakao.maps.LatLng(33.5067652,126.4907529)
    }, 
    {
        content: '<div>제주 한화리조트</div>', 
        latlng: new kakao.maps.LatLng(33.448998,126.6352233)
    }, 
    {
        content: '<div>콩마루순두부짬뽕</div>', 
        latlng: new kakao.maps.LatLng(33.4131474,126.2619973)
    },
    {
        content: '<div>제주프리토 한림점</div>', 
        latlng: new kakao.maps.LatLng(33.3892338,126.226614)
    },
    {
        content: '<div>중문 천돈가</div>', 
        latlng: new kakao.maps.LatLng(33.2580305,126.4171532)
    },
    {
        content: '<div>중문의원</div>', 
        latlng: new kakao.maps.LatLng(33.2513769,126.4233353)
    },
    {
        content: '<div>정화약국</div>', 
        latlng: new kakao.maps.LatLng(33.2513769,126.4233353)
    },
    {
        content: '<div>강실장회포차</div>', 
        latlng: new kakao.maps.LatLng(33.2530283,126.5039064)
    },
    {
        content : '<div>믹스믹스</div>',
        latlng : new kakao.maps.LatLng(33.2471981,126.5636958)
    },
    {
        content: '<div>중문골프클럽</div>', 
        latlng: new kakao.maps.LatLng(33.2498513,126.4046103)
    },
    {
        content: '<div>24시뼈다귀탕중문</div>', 
        latlng: new kakao.maps.LatLng(33.2379039,126.4317657)
    },
    {
        content: '<div>혜성마트</div>', 
        latlng: new kakao.maps.LatLng(33.2542117,126.4174701)
    }
  

];

for (var i = 0; i < positions.length; i ++) {
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[i].latlng // 마커의 위치
    });
    

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[i].content // 인포윈도우에 표시할 내용
    });
   

    // 마커에 mouseover 이벤트와 mouseout 이벤트를 등록합니다
    
    // 이벤트 리스너로는 클로저를 만들어 등록합니다 
    // for문에서 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    kakao.maps.event.addListener(marker, 'mouseover', makeOverListener(map, marker, infowindow));
    kakao.maps.event.addListener(marker, 'mouseout', makeOutListener(infowindow));
}

// 인포윈도우를 표시하는 클로저를 만드는 함수입니다 
function makeOverListener(map, marker, infowindow) {
    return function() {
        infowindow.open(map, marker);
    };
}

// 인포윈도우를 닫는 클로저를 만드는 함수입니다 
function makeOutListener(infowindow) {
    return function() {
        infowindow.close();
    };
}


/* 아래와 같이도 할 수 있습니다 */
/*
for (var i = 0; i < positions.length; i ++) {
    // 마커를 생성합니다
    var marker = new kakao.maps.Marker({
        map: map, // 마커를 표시할 지도
        position: positions[i].latlng // 마커의 위치
    });

    // 마커에 표시할 인포윈도우를 생성합니다 
    var infowindow = new kakao.maps.InfoWindow({
        content: positions[i].content // 인포윈도우에 표시할 내용
    });

    // 마커에 이벤트를 등록하는 함수 만들고 즉시 호출하여 클로저를 만듭니다
    // 클로저를 만들어 주지 않으면 마지막 마커에만 이벤트가 등록됩니다
    (function(marker, infowindow) {
        // 마커에 mouseover 이벤트를 등록하고 마우스 오버 시 인포윈도우를 표시합니다 
        kakao.maps.event.addListener(marker, 'mouseover', function() {
            infowindow.open(map, marker);
        });

        // 마커에 mouseout 이벤트를 등록하고 마우스 아웃 시 인포윈도우를 닫습니다
        kakao.maps.event.addListener(marker, 'mouseout', function() {
            infowindow.close();
        });
    })(marker, infowindow);
}
*/
</script>
</body>
</html>