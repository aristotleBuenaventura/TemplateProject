
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
<div class="container my-5">
<div class="row">
    <div class="col-12">
        <div id="events" class="event-list owl-carousel owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                <?php
                    $select_products = mysqli_query($conn, "SELECT * FROM `products` where category not in ('Upcoming Release')");
                    if(mysqli_num_rows($select_products) > 0 ){
                    while($row = mysqli_fetch_assoc($select_products)){
                ?>
                    <div class="owl-item cloned mt-2" >
                        <div class="event-item">
                            <div class="event-schedule">
                            <form action="" method="post">
                                    <button class="button_product" name="product">
                                        <img src="uploaded_img/<?php echo $row['image']; ?>" alt=""  id="product">
                                        <h4 ><?php echo $row['name']; ?></h4>
                                        <div >₱<?php echo number_format($row['price']); ?></div>
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                                        <input type="hidden" name="product_image" value="<?php echo $row['image']; ?>">
                                    </button>
                                </form>
                            </div>    
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
                </div>
            </div>
            <div class="owl-nav">
                <button type="button" role="presentation" class="owl-prev">
                    <div class="owl-nav-wrapper bg-soft-primary">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-chevron-left text-primary">
                            <polyline points="15 18 9 12 15 6"></polyline>
                        </svg>
                    </div>
                </button>
                <button type="button" role="presentation" class="owl-next">
                    <div class="owl-nav-wrapper bg-soft-primary">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-chevron-right text-primary">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </button>
            </div>
            <div class="owl-dots disabled"></div>
        </div>
    </div>
</div>
</div>


<style type="text/css">

.event-list .event-item {
    padding: 1rem 1.9rem;
    margin: 0 0.9375rem 1.875rem 0.9375rem;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
}

.event-list .event-item.featured {
    border: 1.5px solid #68cbd7;
}

.event-list .event-item .event-schedule {
    color: #3c4142;
    margin-bottom: 0.625rem;
}

.event-list .event-item .event-schedule .event-icon {
    stroke-width: 1px;
    width: 1.125rem;
    height: 1.125rem;
    margin: 0.6875rem 1rem 0 0;
}

.event-list .event-item .event-schedule .event-day {
    font-size: 70px;
    font-weight: 200;
    margin-right: 1rem;
    line-height: 100%;
}

.event-list .event-item .event-schedule .event-month-time {
    font-weight: 200;
    font-size: 22px;
    display: flex;
    line-height: 118%;
    flex-direction: column;
    justify-content: center;
}

.event-list .event-item .event-schedule .event-month-time span {
    display: block;
    text-transform: uppercase;
}

.event-list .event-item .event-title {
    display: block;
    margin-bottom: 0.625rem;
    font-weight: 300;
    color: #3c4142;
}

.event-list .event-item .event-title:hover {
    color: #68cbd7;
    text-decoration: none;
}

.event-list .event-item .event-content {
    color: #b1bac5;
    margin-bottom: 0.625rem;
    font-size: 12px;
    font-weight: 300;
}

.event-list .event-item .event-participants {
    padding: 0;
    margin: 0;
}

.event-list .event-item .event-participants .event-user {
    width: 48px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    border: 2px solid #ffffff;
}

.event-list .event-item .event-participants .event-user .event-user-inital {
    font-size: 13px;
    line-height: 100%;
}

.event-list .event-item .event-participants {
    display: flex !important;
}

.event-list .event-item .event-participants .event-user .event-user-pic {
    width: 100%;
    border-radius: 50%;
}

.event-list .event-item .event-participants li + li {
    margin-left: -10px;
}


.event-list .event-item .event-participants {
    flex-direction: row !important;
}
.event-list .event-item .event-participants {
    padding: 0;
    margin: 0;
}

.bg-soft-primary {
    background-color: #dce3fa;
}

.bg-soft-danger {
    background-color: #fedce0;
}

.bg-soft-info {
    background-color: #d7efff;
}

.bg-soft-success {
    background-color: #d1f6f2;
}

.event-list .event-item .event-schedule, .event-list .event-item .event-participants{
    display: flex !important;
}


.owl-prev {
  width: 100px;
  height: 100%;
  position: absolute;
  top: 0;
  margin-left: 0;
  display: block !important;
  background-image: linear-gradient(to right, #F4F7FD, transparent) !important;
}

.owl-prev .owl-nav-wrapper {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.owl-prev .owl-nav-wrapper svg, .owl-prev .owl-nav-wrapper i {
  color: #ffffff;
  width: 20px;
  height: 20px;
}

.owl-next {
  width: 100px;
  height: 100%;
  position: absolute;
  top: 0;
  right: 0;
  display: block !important;
  background-image: linear-gradient(to right, transparent, #F4F7FD) !important;
}

.owl-next .owl-nav-wrapper {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: auto;
}

.owl-next .owl-nav-wrapper svg, .owl-next .owl-nav-wrapper i {
  color: #ffffff;
  width: 20px;
  height: 20px;
}

.owl-dots {
  text-align: center;
  margin-top: .5rem;
}

.owl-dots .owl-dot {
  width: 10px;
  height: 10px;
  border-radius: 100%;
  background: #cbcbcb !important;
  margin-right: 5px;
  display: inline-block;
}

.owl-dots .owl-dot.active {
  background: #757575 !important;
}

.text-primary, .task-list-wrapper .completed .remove {
    color: #4e73e5 !important;
}
</style>

<script type="text/javascript">
(function($) {
    'use strict';
    $(function () {
        //Event carousel
        $("#events").owlCarousel({
            loop:true,
            margin:0,
            responsive:{
                0:{
                    items:1
                },
                768:{
                    items:2
                },
                979:{
                    items:3
                },
                1199:{
                    items:4
                }
            },
            singleItem : true,
            dots: true,
            nav: true,
            navText : ["",""]
        });
        $(".btn-event-show").collapse();
        //Events: Tooltip
        $('.event-user').tooltip({ boundary: 'window' });
        feather.replace();
    });
})(jQuery);
</script>