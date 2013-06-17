<link type="text/css" href="css/pdf.css" rel="Stylesheet" />
<page backtop="150px" backbottom="100px" backleft="20mm" backright="20mm">
	<page_header id="HEADER">
	        <h3>BrEAST Biological Sample Tracking System</h3>
	        <h3 style="vertical-align: middle">APHINITY STUDY <img src="images/aphinity_logo.png" style="width: 10mm"> </h3>
	</page_header>

	<h4>Account number: 477010</h4>
	<h4>Request shipment date: <?php echo date('d-M-Y');?></h4>
	<p>Dear Sir or Madam,</p>

	<p>Please find hereafter the list of biological samples that you will need to pick up at location: </p>
	
	<!-- location address -->
	<ul>
		<li><?php echo $centreInformation->INSTITUTION ; ?></li>
		<li><?php echo $centreInformation->ADDRESS ; ?></li>
		<li><?php echo $centreInformation->ZIP_CODE ." ". $centreInformation->CITY; ?></li>
		<li><?php echo $centreInformation->COUNTRY ; ?></li>
		<li><?php echo "Phone: ". $centreInformation->PHONE ;?></li>
		<li><?php 
				$fax = empty($centreInformation->FAX)? "NA" : $centreInformation->FAX;
				echo "Fax: " . $fax ;?></li>
	</ul>

	<!-- study repository address-->

    <?php if ('china'==strtolower($centreInformation->COUNTRY)):?>
        <p>These samples should be shipped at -70° C on dry ice.</p>
        <p>The samples should be shipped to:</p>
        <ul>
            <li>Yong Zhang</li>
            <li>Quintiles Medical Research and Development(Beijing) Ltd.</li>
            <li>Unit 901-919, Office Tower 3, Sun Dong An Plaza</li>
            <li>138 Wangfujing Ave, Dongcheng District, Beijing 100006, China</li>
            <li>Tel: + 8610 59117923</li>
            <li>Fax: + 8610 59117992</li>
            <li>Opening hours: Mon-Fri, 09h00-17h00</li>
        </ul>
    <?php else: ?>
        <p>The samples should be shipped to:</p>
        <ul>
            <li>Tim Rackham</li>
            <li>Specimen Services (GATE F)</li>
            <li>B & C Group s.a.</li>
            <li>Watson and Crick Hill </li>
            <li>Rue Granbonpré 11</li>
            <li>B-1348 Mont-Saint-Guibert</li>
            <li>Belgium</li>
            <li>Tel.:+32(0)10 238 858</li>
            <li>Fax.:+32(0)10 238 851</li>
            <li>Opening hours: Mon-Fri, 08h00-16h00</li>
        </ul>
    <?php endif;?>

	<p>Kind regards,</p>
	<p>BrEAST Translational Research Coordinator</p>
	<p>On behalf of BIG</p>

	<page_footer id="FOOTER">
	    <table class="page_footer">
            <tr>
                <td style="width: 33%; text-align: left;">Document created on <?php echo date('d-M-Y');?></td>
                <td style="width: 34%; text-align: center"><img src="images/breast_logo.gif" style="width:35mm"></td>
                <td style="width: 33%; text-align: right">page [[page_cu]]/[[page_nb]]</td>
            </tr>
        </table>
	</page_footer>

</page>

<page pageset="old">

	<h4>The following samples must be collected and shipped to the study repository</h4>
	<?php

		$this->widget("application.components.HtmlTable", array (
		    'th'=> array ("BIOTRACKING SAMPLE ID" ,"SAMPLE NUMBER","PATIENT NUMBER","SAMPLE TYPE"),
		    'data'=> $activeRecords,
		    'td'=> $td,
		    ));
	?>
	<p style="text-align:right">Total samples to collect: <strong><?php echo $totalSample;?> </strong></p>
</page pageset="old">
