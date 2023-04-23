
<html>
 <head>
  <title>SNMP LTE Router Monitor</title>
  <style>
  table, th, td
    {
      border: 1px solid green;
      padding: 0px;
      border-collapse: collapse;
      vertical-align: middle;
      margin-left: auto;
      margin-right: auto;
      font-size: small;
      font-family: Arial, Helvetica, sans-serif;
    }

  body
    {
    color: green;
    background-color: black;
    }
  </style>

 <link rel="icon" type="image/png" href="RouterMonitor.png"> 

 <meta http-equiv="refresh" content="5">

 </head>

<body>
<?php 
  $session = new SNMP(SNMP::VERSION_2c, "your_router_ip", "your_snmp_password");
  $model = $session->get("1.3.6.1.4.1.10529.5200.1.1.0");
  $freq = $session->get("1.3.6.1.4.1.10529.5200.3.28.0");
  $enbid = $session->get("1.3.6.1.4.1.10529.5200.3.35.0");
  $earfcn = $session->get("1.3.6.1.4.1.10529.5200.4.5.0");
  $pci = $session->get("1.3.6.1.4.1.10529.5200.3.23.0");
  $cellid = $session->get("1.3.6.1.4.1.10529.5200.3.36.0");
  $apn = $session->get("1.3.6.1.4.1.10529.5200.6.1.3.0");
  $status = $session->get("1.3.6.1.4.1.10529.5200.3.37.0");
  $uptime = $session->get("1.3.6.1.4.1.10529.5200.2.1.0");
  $sinr = $session->get("1.3.6.1.4.1.10529.5200.3.11.0");
  $rsrq = $session->get("1.3.6.1.4.1.10529.5200.3.17.0");
  $rsrp = $session->get("1.3.6.1.4.1.10529.5200.3.18.0");
  $rssi = $session->get("1.3.6.1.4.1.10529.5200.3.16.0");
  $dspeed = $session->get("1.3.6.1.4.1.10529.5200.3.6.0");
  $uspeed = $session->get("1.3.6.1.4.1.10529.5200.3.5.0");
  $dtotal = $session->get("1.3.6.1.4.1.10529.5200.3.33.0");
  $utotal = $session->get("1.3.6.1.4.1.10529.5200.3.31.0");
?>
  <table>
    <tr>
     <td colspan=2 style="text-align:center; color:limegreen"><b>SNMP LTE Router Monitor</b></td>
    </tr>
     <td>Last Refresh:</td>
     <td style="text-align:center"><?php echo date("l d M H:i:s");?></td>
    <tr>
     <td>Model:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$model", 8));?></td>
    </tr>
    <tr>
     <td colspan=2 style="text-align:center; color:limegreen"><b>Connection Info</b></td>
    </tr>
    <tr>
     <td>Frequency:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$freq", 8));?></td>
    </tr>
    <tr>
     <td>eNB ID:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$enbid", 8));?></td>
    </tr>
    <tr>
     <td>EARFCN:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$earfcn", 8));?></td>
    </tr>
    <tr>
     <td>PCI:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$pci", 8));?></td>
    </tr>
    <tr>
     <td>Cell ID:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$cellid", 8));?></td>
    </tr>
    <tr>
     <td>APN Name:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$apn", 8));?></td>
    </tr>
    <tr>
     <td>Status:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$status", 8));?></td>
    </tr>
    <tr>
     <td>Uptime:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$uptime", 8));?></td>
    </tr>
    <tr>
     <td colspan=2 style="text-align:center; color:limegreen"><b>Signal Info</b></td>
    </tr>
     <td>SINR:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$sinr", 8))," dB";?></td>
    </tr>
    <tr>
     <td>RSRQ:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$rsrq", 8))," dB";?></td>
    </tr>
    <tr>
     <td>RSRP:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$rsrp", 8))," dBm";?></td>
    </tr>
    <tr>
     <td>RSSI:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$rssi", 8))," dBm";?></td>
    </tr>
     <td colspan=2 style="text-align:center; color:limegreen"><b>Current Speed</b></td>
    </tr>
     <td>Download:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$dspeed", 8));?></td>
    </tr>
    <tr>
     <td>Upload:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$uspeed", 8));?></td>
    </tr>
     <td colspan=2 style="text-align:center; color:limegreen"><b>Total Usage</b></td>
    </tr>
     <td>Download:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$dtotal", 8));?></td>
    </tr>
    <tr>
     <td>Upload:</td>
     <td style="text-align:center"><?php echo str_replace('"','',substr("$utotal", 8));?></td>
    </tr>
  </table>

<!--
Mini Monitor
<div style="color:grey; font-family:monospace; font-size:large; text-align:center">
<pre>
SINR: <meter id="sinr" value=<?php echo str_replace('"','',substr("$sinr", 8))?> min="-20" max="20"></meter>
RSRQ: <meter id="rsrq" value=<?php echo str_replace('"','',substr("$rsrq", 8))?> min="-20" max="0"></meter>
RSRP: <meter id="rsrp" value=<?php echo str_replace('"','',substr("$rsrp", 8))?> min="-100" max="-70"></meter>
RSSI: <meter id="rssi" value=<?php echo str_replace('"','',substr("$rssi", 8))?> min="-100" max="-40"></meter>
D/L: <?php echo str_replace('"','',substr("$dspeed", 8))?> 
U/L: <?php echo str_replace('"','',substr("$uspeed", 8))?>
</pre>
</div>
-->

<!-- Uncomment to enable gauges

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var sinr_data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          ['SINR',<?php echo str_replace('"','',substr("$sinr", 8))?>]
        ]);

        var rsrq_data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
	  ['RSRQ',<?php echo str_replace('"','',substr("$rsrq", 8))?>]
        ]);

        var rsrp_data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
	  ['RSRP',<?php echo str_replace('"','',substr("$rsrp", 8))?>]
        ]);

        var rssi_data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
	  ['RSSI',<?php echo str_replace('"','',substr("$rssi", 8))?>]
        ]);

        var sinr_options = {
          width: 400, height: 120,
          redFrom: -20, redTo: 0,
          yellowFrom: 0, yellowTo: 10,
	  greenFrom: 10, greenTo: 20,
	  majorTicks: ['-20','-10','0','10','20'],
          minorTicks: 5,
	  min: -20,
	  max: 20
        };

        var rsrq_options = {
          width: 400, height: 120,
          redFrom: -20, redTo: -15,
          yellowFrom: -15, yellowTo: -10,
	  greenFrom: -10, greenTo: 0,
	  majorTicks: ['-20','-15','-10','-5','0'],
          minorTicks: 5,
	  min: -20,
	  max: 0
        };

        var rsrp_options = {
          width: 400, height: 120,
          redFrom: -120, redTo: -100,
          yellowFrom: -100, yellowTo: -90,
	  greenFrom: -90, greenTo: -70,
	  majorTicks: ['-120','-110','-100','-90','-80','-70'],
          minorTicks: 5,
	  min: -120,
	  max: -70
        };

        var rssi_options = {
          width: 400, height: 120,
          redFrom: -100, redTo: -90,
          yellowFrom: -90, yellowTo: -70,
	  greenFrom: -70, greenTo: -40,
	  majorTicks: ['-100','-90','-80','-70','-60','-50','-40'],
          minorTicks: 5,
	  min: -100,
	  max: -40
        };

        var sinr_chart = new google.visualization.Gauge(document.getElementById('sinr_div'));
	var rsrq_chart = new google.visualization.Gauge(document.getElementById('rsrq_div'));
	var rsrp_chart = new google.visualization.Gauge(document.getElementById('rsrp_div'));
	var rssi_chart = new google.visualization.Gauge(document.getElementById('rssi_div'));

        sinr_chart.draw(sinr_data, sinr_options);
	rsrq_chart.draw(rsrq_data, rsrq_options);
	rsrp_chart.draw(rsrp_data, rsrp_options);
	rssi_chart.draw(rssi_data, rssi_options);
      }

   </script>

<div>
 <table>
  <tr>
    <td>
 	<div id="sinr_div"></div>
    </td>
    <td> 
	<div id="rsrq_div"></div>
    </td>
    <td> 
	<div id="rsrp_div"></div>
    </td>
    <td> 
	<div id="rssi_div"></div>
    </td>
  </tr>
 </table>
</div>

 End of gauges -->

 </body>
</html>
