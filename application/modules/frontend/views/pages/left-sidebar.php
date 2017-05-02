<?php
if (!empty($blocks['inner_top'])) {
    echo $blocks['inner_top'];
}
?>
<div class="clearfix"></div>
<div class="left-siderbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?php
                if (!empty($cms['page_description'])) {
                    echo $cms['page_description'];
                }
                ?>
                <?php
                $urlencode_address = urlencode($available_location);
                ?>
                
            </div>
            
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
				<?php
                if (!empty($blocks['inner_right'])) {
                    echo $blocks['inner_right'];
                }
				
                ?>
                
            </div>
            
        </div>
    </div>
    
</div>

<iframe class="contact_map" src="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en-&amp;geocode=&amp;abauth=52846723_CvfcNinFxxGfLf9q73NnFIgoyE&amp;authuser=0&amp;q=<?php echo $urlencode_address; ?>&amp;aq=0&amp;oq=svas&amp;vps=2&amp;jsv=469e&amp;sll=10.084754,78.77966&amp;sspn=0.002696,0.004699&amp;vpsrc=6&amp;num=10&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>


<div class="clearfix"></div>

<div class="line_content">
<hr /></div>
<?php
if (!empty($blocks['inner_bottom'])) {
    echo $blocks['inner_bottom'];
}
?>
<div class="clearfix"></div>
<?php 
if(!empty($blocks['content_newsletter'])){
echo $blocks['content_newsletter']; 
}
?>
