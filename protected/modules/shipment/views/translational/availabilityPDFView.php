<link type="text/css" href="css/pdf.css" rel="Stylesheet" />
<page backtop="150px" backbottom="100px" backleft="10mm" backright="10mm">
	<page_header id="HEADER">
	        <h3>BrEAST Biological Sample Tracking System</h3>
	        <h3 style="vertical-align: middle">APHINITY STUDY <img src="images/aphinity_logo.png" style="width: 10mm"> </h3>
	</page_header>
        <h4><u><?php echo $reminder;?></u></h4>
	<h4>Request date: <?php echo date('d-M-Y');?></h4>
	<p>Dear Sir or Madam,</p>

	<p>Please find below the list of biological sample(s) that we would like to ship to the central repository.<br />
	Please forward this message to the relevant person(s) within your team.</p>

	<p>It is necessary that you confirm in the Biotracking system if this/these sample(s) can or cannot be sent.<br />
	Please first log into the BrEAST website (https://www.br-e-a-s-t.org) using your user ID and password.  Then click on the BIOTRACKING link and choose the &quot;Request for shipment&quot; menu item in the menu bar.</p>
	<p>If the sample(s) can be sent, please confirm by checking the provided tick box in the <i>Confirm availability</i> field.</p>
	<p>If you are not able to send a sample for any reason (e.g. sample is lost, or accidentally destroyed), please update the <i>sample status</i>, do not tick the box <i>confirm availability</i> and report a comment in the <i>Reason for change</i> field.</p>

	<p>Please consult the user's manual for further details. The manual can be downloaded from the menu bar in the Biotracking system.</p>

	<p>Should you have any questions, please do not hesitate to contact us at breast.translational@bordet.be</p>
	
	<p>Kind regards,
	<br /><br />
	BrEAST Translational Research Coordinator<br />
	on behalf of BIG</p>

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
    <?php 
        if (count($records)>0)
        {
            foreach ($records as $data)
            {
        ?>
    <p style="margin-bottom:0"><label>Patient number:</label><?php echo $data[0]["SCREENING_NUMBER"];?></p>
    <table>
        <tr><td class="label">Kit number assigned at randomisation</td><td><?php echo empty($data[0]["KIT_RANDO"])? "NA" : $data[0]["KIT_RANDO"]; ?></td>
            <td class="label">-</td>
            <td class="label">Kit number used by the site</td><td><?php echo empty($data[0]["KIT_SITE"])? "NA" : $data[0]["KIT_SITE"]; ?></td></tr>
    </table>
	<?php
		$this->widget("application.components.HtmlTable", array (
		    'th'=> array ("BIOTRACKING SAMPLE ID" ,"SAMPLE NUMBER","SAMPLE TYPE","COLLECTION DATE","FIRST REQUEST DATE"),
		    'data'=> $data,
		    'td'=> $td,
		    'id'=> "tableRequestAvailability"
		    ));
                
                echo "<hr>";
            }  //end foreach
        } //end if         
        ?>
    
    <p style="text-align:right">Total samples to confirm: <strong><?php echo $totalSample;?> </strong></p>
</page pageset="old">

