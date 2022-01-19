<?php
										$batdau=$xuatphat;
										$batdau2=$xuatphat;
										$thoigian1tuyen = 0;
										while ($batdau != $ketthuc)
										{	
											$caulenhtimtramke="select distinct tramke from danhsachtramke where matram ='".$batdau."' and matuyen='".$matuyen1."'";
											$ketquatimtramke= mysqli_query($conn,$caulenhtimtramke) or die ("không thực hiện được câu lệnh");;
											while ($rowrttg1tuyen= mysqli_fetch_array($ketquatimtramke))
											{
												$caulenhtongthoigian1tuyen= "select SUM(thoigian) AS ThoiGian from danhsachtramke where matram='".$batdau."' and tramke='".$rowrttg1tuyen['tramke']."' and matuyen='".$matuyen1."'";
												$ketquatongthoigian1tuyen= mysqli_query($conn,$caulenhtongthoigian1tuyen)or die ("không thực hiện được câu lệnh");
												while ($rowtongthoigian= mysqli_fetch_array($ketquatongthoigian1tuyen))
												{								
													$thoigian1tuyen = $thoigian1tuyen + (int)$rowtongthoigian['ThoiGian'];
												}
												$batdau=$rowrttg1tuyen['tramke'];
											}
										}
										echo $thoigian1tuyen; echo $xuatphat; echo $batdau;
										$thoigian2tuyen = 0;
										while ($batdau != $ketthuc)
										{	
											$caulenhtimtramke2="select distinct tramke from danhsachtramke where matram ='".$batdau."' and matuyen='".$matuyen2."'";
											$ketquatimtramke2= mysqli_query($conn,$caulenhtimtramke2) or die ("không thực hiện được câu lệnh");;
											while ($rowrttg2tuyen= mysqli_fetch_array($ketquatimtramke2))
											{
												$caulenhtongthoigian2tuyen= "select SUM(thoigian) AS ThoiGian from danhsachtramke where matram='".$batdau."' and tramke='".$rowrttg2tuyen['tramke']."' and matuyen='".$matuyen2."'";
												$ketquatongthoigian2tuyen= mysqli_query($conn,$caulenhtongthoigian2tuyen)or die ("không thực hiện được câu lệnh");
												while ($rowtongthoigian2= mysqli_fetch_array($ketquatongthoigian2tuyen))
												{								
													$thoigian2tuyen = $thoigian2tuyen + (int)$rowtongthoigian2['ThoiGian'];
												}
												$batdau=$rowrttg2tuyen['tramke'];
											}
										}
										echo $thoigian2tuyen;
										$tong = $thoigian2tuyen + $thoigian1tuyen;
										echo $tong;
										
										?> 


















<!DOCTYPE html>
<html>
      <head>
        <!-- Add Google API Key -->
        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDExyjs9HEnpCx59bgzKJ3TaMiZweYo5Mo&sensor=false">
        </script>
        <script>
          //Khoi tao Map
          function initialize() {
            //Khai bao cac thuoc tinh
            var mapProp = {
              //Tam ban do, quy dinh boi kinh do va vi do
              center:new google.maps.LatLng(13.903569, 109.101894),
              //set default zoom cua ban do khi duoc load
              zoom:5,
              //Dinh nghia type
              mapTypeId:google.maps.MapTypeId.ROADMAP
            };
            //Truyen tham so cho cac thuoc tinh Map cho the div chua Map
            var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
          }
          google.maps.event.addDomListener(window, 'load', initialize);
        </script>
      </head>

      <body>
        <!-- Khai bao the div chua Map -->
        <div id="googleMap" style="width:500px;height:380px;"></div>
      </body>
</html>