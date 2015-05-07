<div class="heading">Dashboard:</div>
<div class="dashboard_area">
    <div class="dashboard_area_l">
        <!--creator area-->
        <div class="creator_area">
            <div class="creator_blog">
                <div class="creator_blog_content_bg">
                    <div class="creator_blog_content">
                        <h5>Welcome Back</h5>
                        <div class="creator_name">Bemmy Bob</div>
                        <div class="creator_type">Creator</div>
                    </div>
                </div>
                <div class="creator_blog_img_bg">
                    <div class="creator_blog_img_area"><?php echo $this->Html->image('/images/creator_blog_img.jpg'); ?></div>
                </div>
            </div>
        </div>
        <!--creator area ends-->
        <!--icons area-->
        <div class="icons_area">
            <!--icons-->
            <div class="icons_bg">
                <?php
                if($this->Html->getLoggedInUserStatus() == 'creator'){
                    $action = 'registration';
                } else {
                    $action = 'creator';
                }
                ?>
                <div class="icon_img"><a href="<?php echo $this->Html->url(array('controller' => 'eeps','action' => $action)); ?>"><?php echo $this->Html->image('/images/register_an_app.png'); ?></a></div>
                <div class="icon_text"><a href="<?php echo $this->Html->url(array('controller' => 'eeps','action' => $action)); ?>">Register an <br />
                        Eep</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/receive_an_app.png'); ?></div>
                <div class="icon_text"><a href="">Receive an <br />
                        Eep</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg last_icon">
                <div class="icon_img"><?php echo $this->Html->image('/images/transfer_an_app.png'); ?></div>
                <div class="icon_text"><a href="">Transfer an <br />
                        Eep</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/eep-name-change.png'); ?></div>
                <div class="icon_text"><a href="">Eep Name <br />
                        Change </a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/my-eep-icon.png'); ?></div>
                <div class="icon_text"><a href="">My <br />
                        Eeps</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg last_icon">
                <div class="icon_img"><?php echo $this->Html->image('/images/linage_chart_icon.png'); ?></div>
                <div class="icon_text"><a href="">Lineage <br />
                        Chart </a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/games_icon.png'); ?></div>
                <div class="icon_text"><a href="">Games </a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/forums_icon.png'); ?></div>
                <div class="icon_text"><a href="">Forums</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg last_icon">
                <div class="icon_img"><?php echo $this->Html->image('/images/store_icon.png'); ?></div>
                <div class="icon_text"><a href="">Store </a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/find-melldian-icon.png'); ?></div>
                <div class="icon_text"><a href="">Find Medallions <br />
                        &amp; Power Ups</a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg">
                <div class="icon_img"><?php echo $this->Html->image('/images/winner-circle.png'); ?></div>
                <div class="icon_text"><a href=""> Winners <br />
                        Circle </a></div>
            </div>
            <!--icons ends-->
            <!--icons-->
            <div class="icons_bg last_icon">
                <div class="icon_img"><?php echo $this->Html->image('/images/faq-icon.png'); ?></div>
                <div class="icon_text"><a href="">FAQs </a></div>
            </div>
            <!--icons ends-->
        </div>
        <!--icons area ends-->
    </div>
    <div class="dashboard_area_r">
        <div class="data_box_area clearfix">
            <ul>
                <li><span>Owner’s Level -</span>  Silver</li>
                <li><span>Creator’s Level -</span>  Diamond</li>
                <li><span># of Eeps™ Owned - </span>  156</li>
                <li><span># of Eeps™ Created -</span>  295</li>
                <li><span>Total Value of All Eeps™ Owned </span>  1652</li>
            </ul>
        </div>
        <!--top 20 post area-->
        <div class="top_post_area">
            <div class="top_post_heading_bg">Top 20 posts </div>
            <div class="top_post_content_bg" style="overflow: scroll;">
                <div class="top_post_content">
                    <ul id="ticker_02" class="ticker">
                        <li>
                            <h6><a href="">Duis sollicitudin volutpat vehicula.</a></h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        <li>
                            <h6><a href="">Duis sollicitudin volutpat vehicula.</a></h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>


                        <li>
                            <h6><a href="">Duis sollicitudin volutpat vehicula.</a></h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        
                        
                        <li>
                            <h6><a href="">Duis sollicitudin volutpat vehicula.</a></h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        
                        <li>
                            <h6><a href="">Duis sollicitudin volutpat vehicula.</a></h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>



                    </ul>
                    <div id="lastPostsLoader"></div>
                </div>
            </div>
        </div>
        <!--top 20 post area-->
        <!--most recent posts-->
        <div class="most_recent_posts">
            <div class="most_recent_posts_heading_bg">10 most recent posts</div>
            <div class="most_recent_posts_content_bg" style="overflow: scroll;">
                <div class="most_recent_posts_content">
                    <ul>
                        <li>
                            <h6>Duis sollicitudin volutpat vehicula.</h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        <li>
                            <h6>Duis sollicitudin volutpat vehicula.</h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        <li class="last_post">
                            <h6>Duis sollicitudin volutpat vehicula.</h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        <li class="last_post">
                            <h6>Duis sollicitudin volutpat vehicula.</h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                        <li class="last_post">
                            <h6>Duis sollicitudin volutpat vehicula.</h6>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam at est at est viverra. </li>
                    </ul>


                </div>
            </div>
        </div>
        <!--most recent posts ends-->
        <!--social icons area-->
        <div class="social_icons_area">
            <ul>
                <li><a href="" class="fb">Faceboox</a></li>
                <li><a href="" class="tw">Twitter</a></li>
                <li><a href="" class="gp">G+</a></li>
                <li><a href="" class="in">Linked in</a></li>
                <li><a href="" class="yt">Youtube</a></li>
                <li><a href="" class="pt">Pinterest</a></li>
            </ul>
        </div>
        <!--social icons area-->

    </div>
    <div class="clear"></div>
</div>