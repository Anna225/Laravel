<!-- footer -->
<footer class="site-footer">
    <div class="footer-big">
        <!-- start .container -->
        <div class="container">
            <div class="row">

                <!-- end /.col-md-4 -->
                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu footer-menu--1">
                            <h4 class="footer-widget-title">Quick links </h4>
                            <ul>
                                <li>
                                    <a href="{{ route('page', 'about-us') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('page', 'terms-and-conditions') }}">Terms and Conditions</a>
                                </li>
                                <li>
                                    <a href="{{ route('page', 'privacy-and-policy') }}">Privacy and Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('page', 'refund-policy') }}">Refund Policy</a>
                                </li>
                                <li>
                                    <a href="{{ route('page', 'faq') }}">FAQ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu">
                            <h4 class="footer-widget-title">COURSES</h4>
                            <ul>
                                <li>
                                    @if ( ! Auth::guard()->check() )
                                        <a href="{{ route('register', ['service' => 1]) }}">
                                            {{ getServiceDetail(1, 'name') }}
                                        </a>
                                    @elseif( ! isSubscribed( 1 ))
                                        <a href="{{ route('subscribe', 1 ) }}">
                                            {{ getServiceDetail(1, 'name') }}
                                        </a>
                                    @elseif( isSubscribed( 1 )->status == 'subscribed' )
                                        <a href="{{ route("training_chapters") }}">
                                            {{ getServiceDetail(1, 'name') }}
                                        </a>
                                    @else
                                        <a href="{{ route('subscribe', 1 ) }}">
                                            {{ getServiceDetail(1, 'name') }}
                                        </a>
                                    @endif
                                </li>
                                <li>
                                    @if ( ! Auth::guard()->check() )
                                        <a href="{{ route('register', ['service' => 2]) }}"> {{ getServiceDetail(2, 'name') }} </a>
                                    @elseif( ! isSubscribed( 2 ))
                                        <a href="{{ route('subscribe', 2 ) }}"> {{ getServiceDetail(2, 'name') }} </a>
                                    @elseif( isSubscribed( 2 )->status == 'subscribed' )
                                        <a href="{{ route("schedule", 2 ) }}"> {{ getServiceDetail(2, 'name') }} </a>
                                    @else
                                        <a href="{{ route('subscribe', 2 ) }}"> {{ getServiceDetail(2, 'name') }} </a>
                                    @endif
                                </li>
                                <li>
                                    @if ( ! Auth::guard()->check() )
                                        <a href="{{ route('register', ['service' => 3]) }}"> {{ getServiceDetail(3, 'name') }} </a>
                                    @elseif( ! isSubscribed( 3 ))
                                        <a href="{{ route('subscribe', 3 ) }}"> {{ getServiceDetail(3, 'name') }} </a>
                                    @elseif( isSubscribed( 3 )->status == 'subscribed' )
                                        <a href="{{ route("schedule", 3) }}"> {{ getServiceDetail(3, 'name') }} </a>
                                    @else
                                        <a href="{{ route('subscribe', 3 ) }}"> {{ getServiceDetail(3, 'name') }} </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="footer-widget">
                        <div class="footer-menu no-padding">
                            <h4 class="footer-widget-title">contact Us</h4>
                            <ul class="no-disc">
                                <li>
                                    @if ( getMetaValue('public_address') )
                                        <p><img src="{{ asset('images/map.png') }}">{{ getMetaValue('public_address') }}</p>
                                    @endif
                                </li>
                                <li>
                                    @if ( getMetaValue('public_phone') )
                                        <a href="tel:{{ getMetaValue('public_phone') }}"><img src="{{ asset('images/call.png') }}">{{ getMetaValue('public_phone') }}</a>
                                    @endif
                                </li>
                                <li>
                                    @if ( getMetaValue('public_email') )
                                        <a href="mailto:{{ getMetaValue('public_email') }}"><img src="{{ asset('images/mail.png') }}">{{ getMetaValue('public_email') }}</a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mini-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-left">
                    <div>
                        <p>Copyright ©{{ date('Y') }} Securtac Protection Services Inc.All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-md-6 soc-links text-right">
                    @if ( getMetaValue('instagram_link') )
                        <a target="_blank" href="{{ getMetaValue('instagram_link') }}">
                            <img src="{{ asset('images/insta.png') }}">
                        </a>
                    @endif

                    @if ( getMetaValue('facebook_link') )
                        <a target="_blank" href="{{ getMetaValue('facebook_link') }}">
                            <img src="{{ asset('images/facebook.png') }}">
                        </a>
                    @endif

                    @if ( getMetaValue('linkedin_link') )
                        <a target="_blank" href="{{ getMetaValue('linkedin_link') }}">
                            <img src="{{ asset('images/linkdin.png') }}">
                        </a>
                    @endif

                    @if ( getMetaValue('twitter_link') )
                        <a target="_blank" href="{{ getMetaValue('twitter_link') }}">
                            <img src="{{ asset('images/twitter.png') }}">
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</footer>
<div id="siteNoticeBar"></div>