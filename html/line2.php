<?php
include("./pChar/class/pData.class.php");
include("./pChar/class/pDraw.class.php");
include("./pChar/class/pImage.class.php");

/* Create and populate the pData object */
$MyData = new pData();  
$MyData->addPoints(array(4,12,15,8,5,4),"Probe 1");
$MyData->addPoints(array("Jan","Feb","Mar","Apr","May","Jun"),"Labels");
$MyData->setSerieDescription("Labels","Months");
$MyData->setAbscissa("Labels");
$MyData->setSerieWeight("Probe 1",2);
/* Create the pChart object */
$myPicture = new pImage(700,230,$MyData);

/* Draw the background */
$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

/* Overlay with a gradient */
$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50);
$myPicture->drawGradientArea(0,0,700,230,DIRECTION_VERTICAL,$Settings);
$myPicture->drawGradientArea(0,0,700,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>80));

/* Add a border to the picture */
$myPicture->drawRectangle(0,0,699,229,array("R"=>0,"G"=>0,"B"=>0));
/* Write the chart title */ 
$myPicture->setFontProperties(array("FontName"=>"./pChar/fonts/Forgotte.ttf","FontSize"=>11));
$myPicture->drawText(155,55,"Class Registration Tracking Chart",array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

/* Draw the scale and the 1st chart */
$myPicture->setGraphArea(60,60,670,190);
$myPicture->drawFilledRectangle(60,60,670,190,array("R"=>255,"G"=>255,"B"=>255,"Surrounding"=>-200,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"./pChar/fonts/pf_arma_five.ttf","FontSize"=>12));
$myPicture->drawScale(array("DrawSubTicks"=>TRUE));
$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->drawSplineChart();
$myPicture->setShadow(FALSE);


$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));
$myPicture->setFontProperties(array("FontName"=>"./pChart/fonts/Forgotte.ttf","FontSize"=>11));

$myPicture->autoOutput("pictures/example.drawLabel.png");
