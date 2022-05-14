@extends('layouts.app')
    
@section('content')
    <div class="page">
        <header class="header">
            <div class="logo"><img src="/elitenftcourse/images/logo.svg" alt="Elite NFT Course"></div>
            <nav class="menu">
                <ul>
                    <li><a href="#welcome">Welcome</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#packages">Packages</a></li>
                    <li><a href="#faq">FAQ</a></li>
                    <li><a href="#market">Market Activity</a></li>
                    <li><a href="#contacts">Contacts</a></li>
                </ul>
            </nav>
            <a href="#login" class="auth">
                <svg width="14" height="15" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M2.832 4.667v1.666h-.833C1.079 6.333.332 7.08.332 8v5c0 .92.746 1.667 1.667 1.667h10c.92 0 1.666-.746 1.666-1.667V8c0-.92-.746-1.667-1.666-1.667h-.834V4.667a4.167 4.167 0 0 0-8.333 0Zm1.667 0a2.5 2.5 0 1 1 5 0v1.666h-5V4.667Z" fill="currentColor"/></svg>
            </a>
        </header>
        <div class="intro" id="welcome">
            <h1><span class="u1">Get ready</span> to discover the world of neverending <span class="u2">earning</span> <span class="u3">opportunities</span> with NFTs!</h1>
            <a class="btn" href="#purchase">Purchase</a>

        </div>
        <div class="promo" id="about">
            <div class="wrapper">
                <div class="promo__item">
                    <span class="promo__item-title promo__item-title_u1">No hesitations</span>
                    <div class="promo__item-text promo__item-text1">Probably, there’s no one that hasn’t heard about the NFT’s. Thousands of success stories with<br> seven figures on headlines only draw attention to this revolutionary blockchain-based<br> technology. But, wait, or are you still the
                        one that is not aware yet? If your answer is “yes,”<br> you’ve come at the right time at the right place.</div>
                </div>
                <div class="promo__item">
                    <span class="promo__item-title promo__item-title_u2">Just get started</span>
                    <div class="promo__item-text promo__item-text2">Meanwhile, the fuss about NFTs only gets stronger every day. But what’s the secret of its overwhelming popularity? What stays behind the phenomena of non-fungible (that’s how it is officially called, btw) token? How does it work, and
                        how can you buy it? How can you create NFT? How to choose the right NFT marketplace and invest profitably?</div>
                </div>
                <div class="promo__item">
                    <span class="promo__item-title promo__item-title_u3">Right now</span>
                    <div class="promo__item-text promo__item-text3">You’ll get answers to these and dozens of other essential questions on our trustworthy,<br> expert, and efficient NFT course. If you’re a newcomer, don’t worry, as the course was<br> created by the best NFT trading professionals and
                        industry leaders specifically for you. <br><br>Following our suggested pieces of advice and structured content, you’ll learn how to make<br> a profit from NFTs, boost your bank account, and discover a new stream of income that
                        will
                        <br> lead you to the financial freedom you’ve ever dreamed of.</div>
                </div>
            </div>
        </div>
        <div class="features">
            <div class="wrapper">
                <h2>In our course <span class="u4">you’ll learn:</span></h2>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-6 hh">
                        <div class="features__img features__img1"><img src="/elitenftcourse/images/icon-nft.png" alt="What is NFT?"></div>
                        <div class="features__text features__text1">What is an NFT?</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="features__img features__img2"><img src="/elitenftcourse/images/icon-howis.png" alt="How does it work?"></div>
                        <div class="features__text features__text2">How does it work?</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="features__img features__img3"><img src="/elitenftcourse/images/icon-advantages.png" alt="What are the advantages of NFT?"></div>
                        <div class="features__text features__text3">What are the advantages<br> of NFT?</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="features__img features__img4"><img src="/elitenftcourse/images/icon-howto.png" alt="How to create one?"></div>
                        <div class="features__text features__text4">How to create one?</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="features__img features__img5"><img src="/elitenftcourse/images/icon-marketplace.png" alt="How to choose an NFT marketplace?"></div>
                        <div class="features__text features__text5">How to choose an NFT marketplace?</div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <div class="features__img features__img6"><img src="/elitenftcourse/images/icon-tips.png" alt="Efficient tips for NFT sale"></div>
                        <div class="features__text features__text6">Efficient tips for NFT sale</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="apes"></div>

        @if ($packages->count() > 0)
            <div class="packages" id="packages">
                <div class="wrapper">
                    <h2>Take a <span class="u5">look</span> and <span class="u6">choose</span> one</h2>
                    <p class="packages__subtitle">Of the four packages that ideally fit your needs, level of knowledge, and requirements.</p>
                    <div class="packages__list">

                        @foreach ($packages as $package)
                            <div class="packages__item packages__item_beginner">
                                <div class="packages__img">
                                    <img src="/uploads/images/packages/preview/{{ $package->preview }}" alt="{{ $package->name }}">
                                </div>
                                <div class="packages__info">
                                    <div class="packages__title">{{ $package->name }}</div>
                                    @if (!empty($package->subtitle))
                                        <div class="packages__target">{{ $package->subtitle }}</div>
                                    @endif

                                    @php
                                        $сontent_list = explode(',', $package->сontent_list);
                                        $extra_сontent_list = explode(',', $package->extra_сontent_list);
                                    @endphp
                                    @if (!empty($сontent_list))
                                        <div class="packages__content">
                                            @foreach ($сontent_list as $item)
                                                <span>{{ $item }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (!empty($extra_сontent_list))
                                        <div class="packages__content-extra">
                                            @foreach ($extra_сontent_list as $item)
                                                <span>{{ $item }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="packages__price">
                                    <div class="packages__price-current">${{ (floatval($package->discount) == 0) ? $package->price : $package->discount }}</div>
                                    <div>
                                        <a class="btn btn_small" data-package_id = "{{ $package->id }}" href="#buy_package">Purchase</a>
                                    </div>
                                    @if (!empty($package->discount))
                                        <div class="packages__price-old">Old Price ${{ $package->price }}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        @endif

        <div class="benefits">
            <div class="wrapper">
                <h2>So, <span class="u7">what’s</span> in it for you?</h2>
                <div class="benefits__list">
                    <div class="benefits__item">
                        <div class="benefits__item-title">eBook</div>
                        <div class="benefits__item-text">Get your electronic version of the Book about NFT covering all necessary aspects. What is NFT, and how does it work? What are the benefits of NFTs, and how to create one? Learn more about the profitable NFT trading tips and pitfalls
                            to avoid within our efficient, easy-to-navigate, and comprehend eBook!
                        </div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Account Manager</div>
                        <div class="benefits__item-text">We will assign a personal manager to you. Whatever your question is, he will assist you with answering your questions. He will be your private guide on how to study our course or how to utilize the website, as well as how to generate
                            money from the NFT world.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Knowledge Checks</div>
                        <div class="benefits__item-text">Our professional team will check your knowledge and provide you with a detailed description of your strong and weak sides. After that, the learning process never stops!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Presentations</div>
                        <div class="benefits__item-text">Our customers have access to presentations materials of our NFT course. The content is conveniently structured and presented with appealing visuals and design.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Personal tracking sheet</div>
                        <div class="benefits__item-text">Will give a simple yet effective track sheet to allow you to keep track of all of your transactions, holdings, earnings, and data from your trades in one place. Available from the third package. </div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Personal Study Time</div>
                        <div class="benefits__item-text">Get the most out of your personal lessons with professional flippers. Learn from the best to be the best!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Daily Market News</div>
                        <div class="benefits__item-text">Stay one step ahead with our daily news from the galaxy of NFTs. Join our telegram community and get instantly informed!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Social trading track</div>
                        <div class="benefits__item-text">We will introduce our customers to experienced and skillful traders and flippers so that they can see what they are purchasing and copy their strategy. Available from the second package. </div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Video lessons</div>
                        <div class="benefits__item-text">As our customer, you will have instant access to video tutorials of our course. So, learn in a fast, entertaining, and easy way!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">NFT Rewards</div>
                        <div class="benefits__item-text">Receive your NFT like a gift and a sign of our respect and appreciation. There can’t be better proof of our unlimited love for our clients. </div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Crypto Calendar</div>
                        <div class="benefits__item-text">Learn more about upcoming and exciting NFT projects with our Crypto Calendar. Then, all you need is to ride the wave!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Metaverse introduction</div>
                        <div class="benefits__item-text">Our account manager will introduce you to the metaverse, tell you about applications for NFT, and show you how to adapt to the world of earning money in the metaverse.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">NFT Glossary Terms</div>
                        <div class="benefits__item-text">You might get lost in the galaxy of NFTs. But don’t worry, as we will provide you with all NFT glossary terms and even more!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Crypto Staking fundamentals 1on1</div>
                        <div class="benefits__item-text">The presentation by an experienced blockchain enthusiast will explain how to stake your cryptocurrency and will provide you with alternative and unique staking options for the NFT.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Support in entering the NFT world</div>
                        <div class="benefits__item-text">Get your complete guidance and assistance throughout the whole procedure, from setting up a wallet to selling NFTs and withdrawing your earnings at the bank!</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Personal strategy build</div>
                        <div class="benefits__item-text">While collaborating with you, your personal analyst/flipper will develop your personal plan that will meet your goals and talents both short and long term, allowing you to make revenue while also establishing a solid basis in the
                            NFT world.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Discount on different NFT projects</div>
                        <div class="benefits__item-text">Get your discount on various NFT projects.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Daily Market Research</div>
                        <div class="benefits__item-text">Your personal analyst/flipper will provide daily market analysis tailored to your specific needs.</div>
                    </div>
                    <div class="benefits__item">
                        <div class="benefits__item-title">Market Signals</div>
                        <div class="benefits__item-text">We send out alerts and notifications to our clients by email and through our website. Available for all packages.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="faq" id="faq">
            <div class="wrapper">
                <h2><span class="u8">FAQ</span></h2>
                <div class="faq__list">
                    <div class="faq__item">
                        <h3 class="faq__title">Is your course suitable for beginners?</h3>
                        <div class="faq__text-wrap">
                            <p class="faq__text">Once the payment is received, you’ll get instant access to all of the content. You’ll be immediately notified via email.</p>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__title">How can I receive the materials?</h3>
                        <div class="faq__text-wrap">
                            <p class="faq__text">Once the payment is received, you’ll get instant access to all of the content. You’ll be immediately notified via email.</p>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__title">When will I be able to see the results?</h3>
                        <div class="faq__text-wrap">
                            <p class="faq__text">Once the payment is received, you’ll get instant access to all of the content. You’ll be immediately notified via email.</p>
                        </div>
                    </div>
                    <div class="faq__item">
                        <h3 class="faq__title">Is it enough to make a profit with NFT? </h3>
                        <div class="faq__text-wrap">
                            <p class="faq__text">Once the payment is received, you’ll get instant access to all of the content. You’ll be immediately notified via email.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($market_activity->count() > 0)
            <div class="market" id="market">
                <div class="wrapper">
                    <h2><span class="u9">Market</span> Activity</h2>
                    <p class="market__subtitle">While you are waiting for a miracle, others are raising money on successful collections. </p>
                    <div class="market__list">
                        <div class="row">

                            @foreach ($market_activity as $key => $item)
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="market__item card">
                                        <div class="market__item-number">{{ $loop->iteration }}</div>
                                        <div class="market__item-pic">
                                            <img src="/uploads/images/MarketActivity/preview/{{ $item->preview }}" alt="{{ $item->name }}">
                                        </div>
                                        <div class="market__item-data">
                                            <div class="market__item-name">{{ $item->name }}</div>
                                            <div class="market__item-floor">
                                                Floor price:
                                                <span>
                                                    <img src="/uploads/images/MarketActivity/icons_coin/{{ $item->icon_coin }}" alt="Floor price">
                                                    {{ number_format(floatval($item->floor_price), 2, '.', ',') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="market__item-activity">
                                            <div class="market__item-state 
                                                @if (floatval($item->shift) > 0)
                                                    market__item-state_up
                                                @elseif (floatval($item->shift) < 0)
                                                    market__item-state_down
                                                @endif
                                            ">
                                                {{ number_format(floatval($item->shift), 2, '.', ',') }}%
                                            </div>
                                            <div class="market__item-volume">
                                                <img src="/uploads/images/MarketActivity/icons_coin/{{ $item->icon_coin }}" alt="Volume"> {{ number_format(intval($item->volume), 0, ',', ',') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="contacts" id="contacts">
            <div class="wrapper">
                <h2><span class="u10">Contacts</span></h2>
                <div class="contacts__list">
                    <div class="contacts__item">
                        <div class="contacts__item-pic">
                            <img src="/elitenftcourse/images/icon-telegram.png" alt="">
                        </div>
                        <div class="contacts__item-label">
                            Telegram:
                        </div>
                        <div class="contacts__item-link">
                            <a href="#">@master_nft</a>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item-pic">
                            <img src="/elitenftcourse/images/icon-whatsapp.png" alt="">
                        </div>
                        <div class="contacts__item-label">
                            WhatsApp:
                        </div>
                        <div class="contacts__item-link">
                            <a href="#">@master_nft</a>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item-pic">
                            <img src="/elitenftcourse/images/icon-viber.png" alt="">
                        </div>
                        <div class="contacts__item-label">
                            Viber:
                        </div>
                        <div class="contacts__item-link">
                            <a href="#">@master_nft</a>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item-pic">
                            <img src="/elitenftcourse/images/icon-phone.png" alt="">
                        </div>
                        <div class="contacts__item-label">
                            Phone:
                        </div>
                        <div class="contacts__item-link">
                            <a href="#">+1 348 399 33 000</a>
                        </div>
                    </div>
                    <div class="contacts__item">
                        <div class="contacts__item-pic">
                            <img src="/elitenftcourse/images/icon-email.png" alt="">
                        </div>
                        <div class="contacts__item-label">
                            Email:
                        </div>
                        <div class="contacts__item-link">
                            <a href="#">info@nftmaster.com</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-cnt">
                <div class="wrapper">
                    <div class="footer__logo">
                        <img src="/elitenftcourse/images/footer-logo.svg" alt="Elite NFT Course">
                    </div>
                    <div class="footer__links">
                        <a href="#terms">Terms &amp; Conditions</a>
                        <a href="#privacy">Privacy Policy</a>
                    </div>
                    <div class="footer__copy">© 2022 Elite NFT Course<br>All Rights Reserved - 2022</div>
                </div>
            </div>
        </footer>
    </div>

    {{-- PopUp --}}
    @include('layouts.popup.purchase')
    @include('layouts.popup.login')

    {{ HTML::script('/elitenftcourse/js/ajax-form.js') }}

@endsection