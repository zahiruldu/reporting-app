<?php 
require_once('db.php');


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Monthly Report | Verizone</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css">
      
 <script type="text/javascript" src="js/canvasjs.js"></script>
 <style type="text/css">

 

 </style>
 <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
      text: "Multi-Series Line Chart"  
      },
      data: [
      {        
        type: "line",
        dataPoints: [
        { label: "sat", y: 21 },
        {label: "sun", y: 25},
        { label: "mon", y: 20 },
        { label: "wed", y: 25 },
        { label: "thur", y: 27 },
        { label: "fri", y: 28 }
        
      
        ]
      },
        {        
        type: "line",
        dataPoints: [
        { label: "sat", y: 61 },
        {label: "sun", y: 6},
        { label: "mon", y: 27 },
        { label: "wed", y: 55 },
        { label: "thur", y: 27 },
        { label: "fri", y: 38 }
      
        ]
      },
        {        
        type: "line",
        dataPoints: [
        { label: "sat", y: 41 },
        {label: "sun", y: 15},
        { label: "mon", y: 90 },
        { label: "wed", y: 25 },
        { label: "thur", y: 57 },
        { label: "fri", y: 38 }
      
        ]
      },
        {        
        type: "line",
        dataPoints: [
        { label: "sat", y: 51 },
        {label: "sun", y: 85},
        { label: "mon", y: 80 },
        { label: "wed", y: 25 },
        { label: "thur", y: 37 },
        { label: "fri", y: 308 }
      
        ]
      }
      ]
    });

    chart.render();
  }
  </script>
 <script type="text/javascript" src="js/canvasjs.min.js"></script>



  </head>
  <body>
    
    <div class="container-fluid">



    
    
<div id="chartContainer" style="height: 300px; width: 100%;">
  </div>




      
    </div>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('#example').dataTable();
    $('#hello').dataTable();
    

     } );
    </script>
    <script  src="js/dataTables.bootstrap.js"></script>
    <script  src="js/jquery.dataTables.js"></script>
    <script  src="js/dataTables.tableTools.js"></script>
    
    <script src="js/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#week_start" ).datepicker({
      defaultDate: "-4w",
      changeMonth: false,
      numberOfMonths: 2,
      showWeek: true,
      
    });
   
  });
  </script>

  </body>
</html>