<div class="gallery">
    <div class="container">
        <div class="col-xs-12">
			<h1 class="text-center"><em><?php echo $title; ?></em></h1>
            <p>Shri Kumaran Swami Gurujee is a Visionary and a spiritual leader, who dedicated himself to serve the mankind. With his uncommon spiritual gifts and extrasensory power he transforms his devotees spiritually, mentally and physically stronger, </p>
            <!-- Tab panes -->
            <div class="tab-content">
				                <div class="tab-pane active" id="tab1" role="tabpanel">


                    <?php
                    $i = 0;
                    $j = 2;
                    foreach ($gallery as $gallery_album) {
                        ?>
                        <div class="col-lg-4 gallery_box">
                        
                            <div class=" grid view view-first">
                                <img src="<?php echo $gallery_album['category_image']; ?>" alt="<?php echo $gallery_album['name']; ?>"/>
                                <div class="mask">
                                    
                                    <a href="<?php echo base_url() . 'gallery/' . $gallery_album['slug'].'/'; ?>" class="info">
                                    <img src="<?php echo media_url().'gallery_icon.png' ?>"><br>
                                    View All</a>
                                </div>
                                
                            </div>
                            <h4><small>Jeevanacharya</small></h4>
                            <h4><strong><?php echo substr($gallery_album['name'], 0, 30); ?></strong></h4>
                            <p><?php echo substr($gallery_album['description'], 0, 100); ?></p>
                           
                        </div>
      

                        <?php
                        $i++;
                        if ($i % 6 == 0) {
                            echo '</div><div class="tab-pane" id="tab' . $j . '" role="tabpanel">';
                            $j++;
                        }
                    }
                    ?>

                </div>

            </div>

            
            <div class="col-xs-12">
            <?php
            if(count($gallery) > 6) :
            
            $list = $j - 1;
            $numbercount = $list + 1;
            ?>
                <ul class="pager" role="tablist">
                    <li class="previous" onclick="goTo(1);"><a href="javascript:void(0);"><span aria-hidden="true"><?php echo '<<< &nbsp;&nbsp;'; ?></span>  Previous</a></li>
                    <?php
                    for ($k = 1; $k <= $list; $k++) {
                        ?>
                        <li>
                            <a aria-controls="tab<?php echo $k; ?>" data-toggle="tab" href="#tab<?php echo $k; ?>" role="tab"><?php echo $k; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="next" onclick="goTo(2);"><a href="javascript:void(0);">Next <span aria-hidden="true"><?php echo '&nbsp;&nbsp; >>>'; ?></span></a></li>
                </ul>
                <?php endif; ?>
            </div>
			
        </div>
    </div>
</div>

<script>
    $('.gallery ul.pager li:nth-of-type(2)').addClass('active');

    function goTo(number) {

        $('.gallery ul.pager li:eq(' + number + ') a').tab('show');
        upgradePreNext(number);
    }
    function upgradePreNext(number) {

        if (number > 1) {
            $('.gallery ul.pager li:eq(0)').attr("onclick", "goTo(" + (number - 1) + ")");
            $('.gallery ul.pager li:eq(0)').attr("class", "previous");
        } else {
            $('.gallery ul.pager li:eq(0)').attr("class", "disabled");
        }
        if (number <<?php echo $list; ?>) {
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("onclick", "goTo(" + (number + 1) + ")");
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("class", "next");
        } else {
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("class", "disabled");
        }
    }
    $(document).ready(function () {
        $('.gallery li a').on('click', function (e) {
            goTo((e.target.innerHTML) - 0);
        });
    });
</script>