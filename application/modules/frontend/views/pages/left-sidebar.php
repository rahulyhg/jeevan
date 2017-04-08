<?php
if (!empty($blocks['inner_top'])) {
    echo $blocks['inner_top'];
}
?>
<div class="clearfix"></div>
<div class="left-siderbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php
                if (!empty($cms['page_description'])) {
                    echo $cms['page_description'];
                }
                ?>
                <?php
                $urlencode_address = urlencode($available_location);
                ?>
                <iframe width="100%" height="350" frameborder="0" scrolling="Yes" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en-&amp;geocode=&amp;abauth=52846723_CvfcNinFxxGfLf9q73NnFIgoyE&amp;authuser=0&amp;q=<?php echo $urlencode_address; ?>&amp;aq=0&amp;oq=svas&amp;vps=2&amp;jsv=469e&amp;sll=10.084754,78.77966&amp;sspn=0.002696,0.004699&amp;vpsrc=6&amp;num=10&amp;t=m&amp;z=14&amp;iwloc=A&amp;output=embed"></iframe>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <?php
        if (!empty($blocks['inner_right'])) {
            echo $blocks['inner_right'];
        }
        ?>
    </div>
</div>
</div>
</div>
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
