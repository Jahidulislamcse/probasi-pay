<div class="footer-area pt_50 pb_80" id="aboutus">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-3 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="footer-item mt_30">
                    <h3>About Us</h3>
                    <p>{{ section('footer_description') }}</p>
                </div>
            </div>
            <div class="col-md-3  wow fadeIn" data-wow-delay="0.3s">
                
            </div>
            <div class="col-md-3 wow fadeIn" data-wow-delay="0.4s">
                
            </div>
            <div class="col-md-3  wow fadeInRight" data-wow-delay="0.2s">
                <div class="footer-item mt_30">
                    <h3>Address</h3>
                    <div class="footer-address-item">
                        <div class="icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="text"><span>
                                <p>{{ @siteInfo()->hq_address }}</p>
                            </span></div>
                    </div>
                    <div class="footer-address-item">
                        <div class="icon"><i class="fas fa-phone-volume"></i></div>
                        <div class="text"><span>
                                <p>{{ @siteInfo()->phone }}</p>
                            </span></div>
                    </div>
                    <div class="footer-address-item">
                        <div class="icon"><i class="far fa-envelope"></i></div>
                        <div class="text"><span>
                                <p>{{ @siteInfo()->email }}</p>
                            </span></div>
                    </div>

                    <ul class="footer-social">
                        <li><a href="{{ section('social_item_1_descritpion') }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="{{ section('social_item_2_descritpion') }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="{{ section('social_item_3_descritpion') }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        <li><a href="{{ section('social_item_4_descritpion') }}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="footer-bottom">
    <div class="container wow fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="copy-text">
                    <p>Copyright {{ date('Y') }}. {{ @siteInfo()->company_name }}. All Rights Reserved.</p>
                </div>


                <div class="footer-bottom-menu">
                    <ul>
                        <li><a href="#">Terms and Conditions</a></li>

                        <li><a href="#">Privacy Policy</a></li>

                    </ul>
                </div>

            </div>

        </div>
    </div>
</div>