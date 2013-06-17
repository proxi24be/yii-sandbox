<div>
    <div class="grid_4"><span class="label">Centre no:</span><br><?php echo $contactInfo->SHORT_DESCRIPTION;?></div>
    <div class="grid_4"><span class="label">Investigator's name:</span><br><?php echo $contactInfo->CONTACT_PERSON;?></div>
    <div class="grid_4 omega"><span class="label">Pathologist:</span><br><?php echo $contactInfo->CONTACT_FORENAME ." ". $contactInfo->CONTACT_LASTNAME;?></div>
    
    <div class="grid_4"><span class="label">Country:</span><br><?php echo $contactInfo->COUNTRY;?></div>
    <div class="grid_4"><span class="label">Investigator's fax no:</span><br><?php echo $contactInfo->FAX_NUMBER;?></div>
    <div class="grid_4 omega"><span class="label">Pathologist phone:</span><br><?php echo $contactInfo->CONTACT_PHONE;?></div>
    
    <div class="grid_4"><span class="label">Town:</span><br><?php echo $contactInfo->ADDRESS_CITY;?></div>
    <div class="grid_4"><span class="label">Investigator's email:</span><br><?php echo $contactInfo->EMAIL;?></div>
    <div class="grid_4 omega"><span class="label">Pathologist fax:</span><br><?php echo $contactInfo->CONTACT_FAX;?></div>
    
    <div class="grid_4"><span class="label">Return address:</span><br><?php echo $contactInfo->ADDRESS_STREET;?></div>
    <div class="grid_4"><span class="label">Name of Hospital:</span><br><?php echo $contactInfo->CENTRE_NAME;?></div>
    <div class="grid_4 omega"><span class="label">Pathologist email:</span><br><?php echo "NA";?></div>
</div>

<table>
    <tbody>
        <tr>
            <td><span class="label">Patient screening n°:</span><br><?php echo "NA";?></td>
            <td><span class="label">Specimen type:</span><br><?php echo $contactInfo->MATERIAL_TYPE;?></td>
            <td><span class="label">Local sample number:</span><br><?php echo $contactInfo->LOCAL_ID;?></td>
        </tr>
        <tr>
            <td><span class="label">Specimen collection date:</span><br><?php echo $contactInfo->COLLECTION_DATE;?></td>
            <td><span class="label">Fixative used:</span><br><?php echo $contactInfo->FIXATIVES;?></td>
            <td><span class="label">Laterality:</span><br><?php echo $contactInfo->LATERALITY;?></td>
        </tr>
    </tbody>
</table>