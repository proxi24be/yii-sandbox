<?php
    $baseUrl= Yii::app()->request->baseUrl;
    $assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('webroot.javascript.nivo-slider'));
?>

<link rel="stylesheet" type="text/css" href="<?php echo $assetsUrl ;?>/themes/default/default.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $assetsUrl ;?>/nivo-slider.css"/>
<script type="text/javascript" src="<?php echo $assetsUrl ;?>/jquery.nivo.slider.pack.js"></script>

<style>

    div.news h6
    {
        margin-bottom: 0px;
        padding-bottom: 0px;;
    }
    div.news p.published
    {
        margin-top:0px;
        padding-top:0px;
    }

    div#hero-carousel
    {
        margin-top:-20px;
    }

    .carousel 
    {
        margin-bottom: 60px;
    }

    .carousel .container 
    {
        position: relative;
        z-index: 9;
    }

    .carousel-control 
    {
        height: 80px;
        margin-top: 0;
        font-size: 120px;
        text-shadow: 0 1px 1px rgba(0,0,0,.4);
        background-color: transparent;
        border: 0;
        z-index: 10;
    }

    .carousel .item 
    {
        height: 500px;
    }
    .carousel img 
    {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 500px;
    }

    .carousel-caption
    {
        background-color: transparent;
        position: static;
        max-width: 550px;
        padding: 0 20px;
        margin-top: 200px;
    }
    .carousel-caption h1,
    .carousel-caption .lead 
    {
        margin: 0;
        line-height: 1.25;
        color: #fff;
        text-shadow: 0 1px 1px rgba(0,0,0,.4);
    }
    .carousel-caption .btn 
    {
        margin-top: 10px;
    }

</style>


<div class="container">
    <div class="row">

        <div class="span8">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                    <img  src="<?php echo $baseUrl ; ?>/images/top_slider.png"  data-thumb="<?php echo $baseUrl ; ?>/images/top_slider.png" alt="" title ="Breast european adjuvant study team" data-transition="slideInLeft"/> 
                </div>
            </div>
        </div>

        <div class="span4 news">
            <p><b>Latest News</b>(<a href="<?php echo Yii::app()->createAbsoluteUrl('news/show')?>">read more</a>)</p>
            <div class="well">
                <?php  $this->widget("NewsWidget"); ?>
            </div>
        </div>
        
        <div class="span8" style="text-align:justify">

        Recent rapid advances in breast cancer research have created a need for large-scale, independent, multi-phase clinical trials designed to evaluate the efficacy and side effects of potential 
        new drug therapies, not only over the short-term but also for many years after patients are diagnosed and treated. <br/>
        <br/>
        The Breast Adjuvant Study Team (BrEAST) was established by Dr Martine Piccart in 1997 at Belgium’s world-renowned cancer centre, Institut Jules Bordet, to design, implement 
        and conduct large phase II and III adjuvant breast cancer clinical trials. From the beginning, BrEAST has been closely linked to the Breast International Group (BIG; 
        <a href="http://www.breastinternationalgroup.org">www.breastinternationalgroup.org</a>).
        BIG was founded in 1999 by Dr Piccart and other like-minded breast cancer opinion-leaders in Europe, who were inspired by the way North American research groups conducted large, academically-driven 
        clinical trials. BIG’s  unique network, now extending well beyond Europe,  has enabled expertise and resources to be pooled more effectively to avoid duplicating research efforts. By bringing 
        together a global community of academic breast cancer research groups and their specialists to share the latest information on the progress of trials and independently verified data on new 
        drug therapies, it represents a leading force in breast cancer research today.<br/>
        <br/>
        Due to the high cost of clinical trials, earlier studies led exclusively by pharmaceutical companies tended to be either smaller in scale and conducted over shorter time periods, 
        or to lack scientific robustness with regard to the types of questions asked. Working in collaboration with BrEAST, pharmaceutical companies and other partners can now run much larger,
        global trials in which patients can be followed-up for 5, 10 or even  more years after completing therapy, greatly enhancing the level of knowledge available about a particular treatment. 
        Data collected in these clinical trials are analysed by academics working independently from the pharmaceutical partners, leading to a “win-win” situation for oncologists, research scientists, 
        the pharmaceutical industry and, most importantly, for patients. <br/>
        <br/>
        By being located at Institut Jules Bordet, which is highly specialised in treating breast cancer, BrEAST staff members have the opportunity to keep up-to-date with the 
        latest medical practice. Since 1997, BrEAST has grown from an original staff of 7 to almost 50 today, and it manages complex trials involving more than 15.000 patients 
        in over 40 countries. BrEAST’s trial portfolio includes three large phase III adjuvant trials and several smaller, randomised phase II neo-adjuvant trials.<br/>

        <br/><br/>
        <a href="<?php echo Yii::app()->createUrl('site/breast');?>"><u><b>Get more information</b></u></a>
        </div>

        <div class="span3 offset1" >
            <img  src="<?php echo Yii::app()->request->baseUrl; ?>/images/bordet1.jpg"/>
            <p style="text-align: center">Jules Bordet Institute</p>
        </div>

    </div>
</div>


<script type="text/javascript">

$('#slider').nivoSlider({
        animSpeed: 500, // Slide transition speed
        pauseTime: 35000
    });

</script>