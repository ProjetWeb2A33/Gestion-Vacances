<?php
include '../../../Controller/HotelC.php';
$hotelC = new HotelC();
$hotelC->deleteHotel($_GET["id"]);
header('Location:listHotels.php');