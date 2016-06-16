<?php

$month_name= 5;

$year_name=2015;

 $monthly= "$year_name-$month_name-15";

 $hi= date('M', strtotime($monthly));

 echo $hi;