<link type="text/css" href="css/pdf.css" rel="Stylesheet" />
<page backtop="150px" backbottom="100px" backleft="20mm" backright="20mm">
	<page_header id="HEADER">
	        <h3>BrEAST Biological Sample Tracking System</h3>
	        <h3 style="vertical-align: middle">APHINITY STUDY <img src="images/aphinity_logo.png" style="width: 10mm"> </h3>
	</page_header>

	<h4>Request shipment date: <?php echo date('d-M-Y');?></h4>
	<p>Dear Sir or Madam,</p>

	<p>Please find hereafter the list of biological samples that the courier company will collect at your centre. </p>
	
	<p>The courier company will contact you shortly and inform you about the shipment and collection procedures.</p>

	<p>Kind regards,</p>
	<p>BrEAST Translational Research Coordinator</p>
	<p>on behalf of BIG</p>

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

	<h4>The following samples will be collected by the courrier company and shipped to the study repository</h4>
	<?php

		$this->widget("application.components.HtmlTable", array (
		    'th'=> array ("BIOTRACKING SAMPLE ID" ,"SAMPLE NUMBER","PATIENT NUMBER","SAMPLE TYPE"),
		    'data'=> $activeRecords,
		    'td'=> $td,
		    ));
	?>
	<p style="text-align:right">Total samples to collect: <strong><?php echo $totalSample;?> </strong></p>
</page pageset="old">
