<div class="gallery">
    <div class="container">
        <div class="col-xs-12">

            <h1 class="text-center"><?php echo $title; ?></h1>
            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane active" id="tab1" role="tabpanel">

                    <?php
                    $i = 0;
                    $j = 2;
                    foreach ($gallery as $gallery_album) {
                        ?>
                        <div class=" grid view view-eighth">
                            <img src="<?php echo $gallery_album['category_image']; ?>" alt="<?php echo $gallery_album['name']; ?>"/>
                            <div class="mask">
                                <h2>Jeevanacharya</h2>
                                <p><?php echo substr($gallery_album['name'], 0, 100); ?></p>
                                <a href="<?php echo base_url() . 'gallery/' . $gallery_album['slug'].'/'; ?>" class="info">View more</a>
                            </div>
                        </div>
                        <!--                        <div class="col-sm-4 col-xs-12 grid">
                                                    <figure class="effect-apollo">
                                                        <img src="<?php echo $gallery_album['category_image']; ?>" alt="<?php echo $gallery_album['name']; ?>"/>
                                                        <figcaption>
                        
                                                            <p><?php echo $gallery_album['name']; ?></p>
                                                            <a href="<?php echo base_url() . 'gallery/' . $gallery_album['slug'].'/'; ?>">View more</a>
                                                        </figcaption>			
                                                    </figure>
                                                </div>-->

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

            <?php
            $list = $j - 1;
            $numbercount = $list + 1;
            ?>
            <div class="col-xs-12">
                <ul class="pager" role="tablist">
                    <li class="previous pull-left" onclick="goTo(1);"><a href="javascript:void(0);"><span aria-hidden="true">←</span> Previous</a></li>
                    <?php
                    for ($k = 1; $k <= $list; $k++) {
                        ?>
                        <li>
                            <a aria-controls="tab<?php echo $k; ?>" data-toggle="tab" href="#tab<?php echo $k; ?>" role="tab"><?php echo $k; ?></a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="next pull-right" onclick="goTo(2);"><a href="javascript:void(0);">Next <span aria-hidden="true">→</span></a></li>
                </ul>
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
            $('.gallery ul.pager li:eq(0)').attr("class", "pull-left");
        }
        if (number <<?php echo $list; ?>) {
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("onclick", "goTo(" + (number + 1) + ")");
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("class", "next");
        } else {
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("class", "disabled");
            $('.gallery ul.pager li:eq(<?php echo $numbercount; ?>)').attr("class", "pull-right");
        }
    }
    $(document).ready(function () {
        $('.gallery li a').on('click', function (e) {
            goTo((e.target.innerHTML) - 0);
        });
    });
</script>