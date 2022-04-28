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
        <div class="packages" id="packages">
            <div class="wrapper">
                <h2>Take a <span class="u5">look</span> and <span class="u6">choose</span> one</h2>
                <p class="packages__subtitle">Of the four packages that ideally fit your needs, level of knowledge, and requirements.</p>
                <div class="packages__list">
                    <div class="packages__item packages__item_beginner">
                        <div class="packages__img">
                            <img src="/elitenftcourse/images/icon-beginner.png" alt="Beginner">
                        </div>
                        <div class="packages__info">
                            <div class="packages__title">Beginner</div>
                            <div class="packages__target">For those who want to know what is NFT.</div>
                            <div class="packages__content">
                                <span>Video lessons</span>
                                <span>Presentations</span>
                                <span>eBook</span>
                                <span>Crypto Calendar</span>
                                <span>Knowledge Checks</span>
                                <span>Personal tracking sheet</span>
                                <span>Crypto Stacking Fundamentals</span>
                                <span>Support in entering NFT world</span>
                                <span>Metaverse introduction</span>
                                <span>Trading setup</span>
                            </div>
                            <div class="packages__content-extra">
                                <span>EXTRA</span>
                                <span>NFT Reward</span>
                                <span>Intro session with account manager</span>
                            </div>
                        </div>
                        <div class="packages__price">
                            <div class="packages__price-current">$235</div>
                            <div>
                                <a class="btn btn_small" href="#">Purchase</a>
                            </div>
                            <div class="packages__price-old">Old Price $250</div>
                        </div>
                    </div>
                    <!--/packages__item beginner-->
                    <div class="packages__item packages__item_inter">
                        <div class="packages__img">
                            <img src="/elitenftcourse/images/icon-inter.png" alt="inter">
                        </div>
                        <div class="packages__info">
                            <div class="packages__title">Intermediate</div>
                            <div class="packages__target">For those who want to get more info about NFT markets.</div>
                            <div class="packages__content">
                                <span>Video lessons</span>
                                <span>Presentations</span>
                                <span>eBook</span>
                                <span>Crypto Calendar</span>
                                <span>Knowledge Checks</span>
                                <span>Personal tracking sheet</span>
                                <span>Crypto Stacking Fundamentals</span>
                                <span>Support in entering NFT world</span>
                                <span>Metaverse introduction</span>
                                <span>Trading setup</span>
                            </div>
                            <div class="packages__content-extra content-inter">
                                <span>EXTRA</span>
                                <span>NFT Reward</span>
                                <span>Daily Market Research</span>
                                <span>Market Signals</span>
                                <span>5 sessions with account manager</span>
                            </div>
                        </div>
                        <div class="packages__price">
                            <div class="packages__price-current">$475</div>
                            <div>
                                <a class="btn btn_small" href="#">Purchase</a>
                            </div>
                            <div class="packages__price-old">Old Price $550</div>
                        </div>
                    </div>
                    <!--/packages__item Intermediate-->
                    <div class="packages__item packages__item_trade">
                        <div class="packages__img">
                            <img src="/elitenftcourse/images/icon-trade.png" alt="trade">
                        </div>
                        <div class="packages__info">
                            <div class="packages__title">Trade</div>
                            <div class="packages__target">For the people who wants to maximize opportunities and create consistent income.</div>
                            <div class="packages__content">
                                <span>Video lessons</span>
                                <span>Presentations</span>
                                <span>eBook</span>
                                <span>Crypto Calendar</span>
                                <span>Knowledge Checks</span>
                                <span>Personal tracking sheet</span>
                                <span>Crypto Stacking Fundamentals</span>
                                <span>Support in entering NFT world</span>
                                <span>Metaverse introduction</span>
                                <span>Trading setup</span>
                            </div>
                            <div class="packages__content-extra purple">
                                <span>EXTRA</span>
                                <span>2 NFT Reward</span>
                                <span>Daily Market Research</span>
                                <span>Market Signals</span>
                                <span>Account manager once a week</span>
                                <span>Social trading track</span>
                                <span>Pro trader 1on1 meeting</span>
                            </div>
                        </div>
                        <div class="packages__price">
                            <div class="packages__price-current">$950</div>
                            <div>
                                <a class="btn btn_small" href="#">Purchase</a>
                            </div>
                            <div class="packages__price-old">Old Price $1000</div>
                        </div>
                    </div>
                    <!--/packages__item trade-->
                    <div class="packages__item packages__item_elite">
                        <div class="packages__img">
                            <img src="/elitenftcourse/images/icon-elite.png" alt="elite">
                        </div>
                        <div class="packages__info">
                            <div class="packages__title">Elite</div>
                            <div class="packages__target">For those who wants to make big steps in investments yields and holding portfolios.</div>
                            <div class="packages__content">
                                <span>Video lessons</span>
                                <span>Presentations</span>
                                <span>eBook</span>
                                <span>Crypto Calendar</span>
                                <span>Knowledge Checks</span>
                                <span>Personal tracking sheet</span>
                                <span>Crypto Stacking Fundamentals</span>
                                <span>Support in entering NFT world</span>
                                <span>Metaverse introduction</span>
                                <span>Trading setup</span>
                            </div>
                            <div class="packages__content-extra pink">
                                <span>EXTRA</span>
                                <span>Gold NFT Reward</span>
                                <span>Daily Market Research</span>
                                <span>Market Signals</span>
                                <span>Account manager 24/5</span>
                                <span>Social trading track</span>
                                <span>Personal strategy build</span>
                                <span>Pro trader monthly meeting</span>
                            </div>
                        </div>
                        <div class="packages__price">
                            <div class="packages__price-current">$1400</div>
                            <div>
                                <a class="btn btn_small" href="#">Purchase</a>
                            </div>
                            <div class="packages__price-old">Old Price $1500</div>
                        </div>
                    </div>
                    <!--/packages__item elite-->
                </div>
            </div>
        </div>

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


        <div class="market" id="market">
            <div class="wrapper">
                <h2><span class="u9">Market</span> Activity</h2>
                <p class="market__subtitle">While you are waiting for a miracle, others are raising money on successful collections. </p>

                <div class="market__list">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item card">
                                <div class="market__item-number">1</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">2</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">+35.42%</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">3</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_down">-35.43%</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">4</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">5</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">6</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">7</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">8</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">9</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">10</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">11</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="market__item">
                                <div class="market__item-number">12</div>
                                <div class="market__item-pic">
                                    <img src="/elitenftcourse/images/icon-market.png" alt="">
                                </div>
                                <div class="market__item-data">
                                    <div class="market__item-name">Smokin</div>
                                    <div class="market__item-floor">
                                        Floor price:
                                        <span>
                                            <img src="/elitenftcourse/images/icon-eth.svg" alt="Floor price">
                                            2.5
                                        </span>
                                    </div>
                                </div>
                                <div class="market__item-activity">
                                    <div class="market__item-state market__item-state_up">—</div>
                                    <div class="market__item-volume">
                                        <img src="/elitenftcourse/images/icon-eth.svg" alt="Volume"> 5,379,151
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <div class="popup" id="purchase">
        <form id="register" class="ajax-form full_preloader-ajax-form purchase" action="{{ route('registerAction') }}" method="POST">
            @csrf
            <div class="purchase__steps">
                <div step-ajax-form="register" class="purchase__steps-step current">
                    <span>Main Data</span>
                </div>
                <div step-ajax-form="register" class="purchase__steps-step">
                    <span>Blling Information</span>
                </div>
                <div step-ajax-form="register" class="purchase__steps-step">
                    <span>Finish</span>
                </div>
            </div>

            <div class="wrapper">
                <div class="popup__close">
                    <svg width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M7 28C7 11.67 11.67 7 28 7s21 4.67 21 21-4.85 21-21 21S7 44.33 7 28Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.83 22.17 22.17 33.83m11.66 0L22.17 22.17" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                </div>
                <div class="purchase__step current step-ajax-form">
                    <div class="purchase__row row">
                        <div class="col-md-8 col-sm-7 col-xs-12">
                            <div class="purchase__title">Personal Data</div>
                            <div class="purchase__group">
                                <label class="purchase__label">
                                    <span>First Name</span>
                                    <div class="purchase__input_group">
                                        <input name="first_name" class="purchase__input" type="text" placeholder="John" autocomplete="off" required>
                                        <div class="error-text first_name_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Last Name</span>
                                    <div class="purchase__input_group">
                                        <input name="last_name" class="purchase__input" type="text" placeholder="Doe" autocomplete="off" required>
                                        <div class="error-text last_name_error"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="purchase__group">
                                <label class="purchase__label">
                                    <span>Telephone</span>
                                    <div class="purchase__input_group">
                                        <input name="phone" class="purchase__input" type="tel" placeholder="+XX(XXX)XXXXXXXXX" autocomplete="off" required>
                                        <div class="error-text phone_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Email</span>
                                    <div class="purchase__input_group">
                                        <input name="email" class="purchase__input" type="email" placeholder="youremail@mail.com" autocomplete="off" required>
                                        <div class="error-text email_error"></div>
                                    </div>
                                </label>
                            </div>
                            <div class="purchase__group">
                                <label class="purchase__label">
                                    <span>Password</span>
                                    <div class="purchase__input_group">
                                        <input name="password" class="purchase__input" type="password" placeholder="" required autocomplete="new-password">
                                        <div class="error-text password_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Re-password</span>
                                    <div class="purchase__input_group">
                                        <input name="password_confirmation" class="purchase__input" type="password" placeholder="" required autocomplete="off">
                                        <div class="error-text password_confirmation_error"></div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 col-xs-12 d_flex">
                            <div class="purchase__title">Choose Package</div>
                            <div class="purchase__group">
                                <label class="purchase__radio">
                                    <input type="radio" name="package" checked>
                                    <span class="purchase__radio-container">
                                        <i class="purchase__radio-circle"></i>
                                        <span class="purchase__radio-title">Beginner</span>
                                        <span class="purchase__radio-price">$235</span>
                                    </span>
                                </label>
                                <label class="purchase__radio">
                                    <input type="radio" name="package">
                                    <span class="purchase__radio-container">
                                        <i class="purchase__radio-circle"></i>
                                        <span class="purchase__radio-title">Intermediate</span>
                                        <span class="purchase__radio-price">$475</span>
                                    </span>
                                </label>
                                <label class="purchase__radio">
                                    <input type="radio" name="package">
                                    <span class="purchase__radio-container">
                                        <i class="purchase__radio-circle"></i>
                                        <span class="purchase__radio-title">Trade</span>
                                        <span class="purchase__radio-price">$950</span>
                                    </span>
                                </label>
                                <label class="purchase__radio">
                                    <input type="radio" name="package">
                                    <span class="purchase__radio-container">
                                        <i class="purchase__radio-circle"></i>
                                        <span class="purchase__radio-title">Elite</span>
                                        <span class="purchase__radio-price">$1400</span>
                                    </span>
                                </label>
                                <div class="error-text package_error"></div>
                            </div>
                            <button type="submit" class="btn btn_block purchase__btn">Next</button>
                        </div>
                    </div>
                </div>
                <div class="purchase__step step-ajax-form">
                    <div class="purchase__row row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="purchase__title">Billing Information</div>
                            <div class="purchase__group">
                                <label class="purchase__label">
                                    <span>Card Number</span>
                                    <div class="purchase__input_group">
                                        <input name="card_number" class="purchase__input" type="text" placeholder="0000 0000 0000 0000">
                                        <div class="error-text card_number_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Cardholder Name</span>
                                    <div class="purchase__input_group">
                                        <input name="cardholder_name" class="purchase__input" type="text" placeholder="John Doe">
                                        <div class="error-text cardholder_name_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Expire Date</span>
                                    <div class="row-container">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="purchase__input_group">
                                                    <input name="expiration_month" class="purchase__input" type="text" placeholder="Month">
                                                    <div class="error-text expiration_month_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="purchase__input_group">
                                                    <input name="expiration_year" class="purchase__input" type="text" placeholder="Year">
                                                    <div class="error-text expiration_year_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>CVV/CVC</span>
                                    <div class="purchase__input_group">
                                        <input name="cvv" class="purchase__input" type="text" placeholder="Security Code">
                                        <div class="error-text cvv_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>&nbsp;</span>
                                    <div class="row-container">
                                        <button class="btn btn_icon purchase__sbmt" type="submit">
                                            <svg width="26" height="22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.28.67h5.44c1.83 0 3.27 0 4.43.11 1.18.12 2.17.38 3.04.95.69.47 1.28 1.06 1.74 1.75.33.5.56 1.03.7 1.61.11.4.16.6.04.75-.12.16-.34.16-.78.16H1.11c-.44 0-.66 0-.78-.16C.2 5.7.26 5.5.36 5.1c.15-.58.38-1.12.7-1.6a6.33 6.33 0 0 1 1.75-1.76A6.44 6.44 0 0 1 5.85.78C7.01.67 8.45.67 10.28.67ZM17 13.67a1.33 1.33 0 1 0 0 2.66 1.33 1.33 0 0 0 0-2.66ZM19.48 15.99c-.07.16.02.34.19.34a1.33 1.33 0 0 0 0-2.66c-.17 0-.26.18-.2.34a2.66 2.66 0 0 1 0 1.98Z" fill="currentColor"/><path fill-rule="evenodd" clip-rule="evenodd" d="M.8 8c-.37 0-.55 0-.67.12-.11.11-.12.3-.12.65L0 10.94v.12c0 1.82 0 3.27.12 4.42.12 1.19.37 2.17.95 3.04.46.69 1.05 1.28 1.74 1.75.87.57 1.86.83 3.04.95 1.16.11 2.6.11 4.43.11h5.44c1.83 0 3.27 0 4.43-.11a6.44 6.44 0 0 0 3.04-.95 6.33 6.33 0 0 0 1.74-1.75c.58-.87.83-1.85.95-3.04.12-1.15.12-2.6.12-4.42v-.12l-.01-2.17c0-.36 0-.54-.12-.65-.12-.12-.3-.12-.67-.12H.8Zm13.53 7a2.67 2.67 0 0 1 3.58-2.5c.24.08.35.12.42.12s.19-.04.42-.13A2.66 2.66 0 0 1 22.33 15a2.67 2.67 0 0 1-3.58 2.5 1.7 1.7 0 0 0-.42-.12c-.07 0-.18.04-.42.13A2.66 2.66 0 0 1 14.33 15Z" fill="currentColor"/></svg>
                                            Pay
                                        </button>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 d_flex">
                            <div class="purchase__title">Summery</div>
                            <div class="purchase__group">
                                <div class="purchase__summery">
                                    <div class="purchase__summery-data">
                                        <span class="full_name"></span><br> <span class="phone"></span><br> <span class="full_name"></span>
                                    </div>
                                    <div class="purchase__summery-back">
                                        <a href="#prev">Change</a>
                                    </div>
                                    <div class="purchase__summery-package">
                                        <div class="purchase__summery-package-img">
                                            <img src="/elitenftcourse/images/icon-beginner.png" alt="">
                                        </div>
                                        <div class="purchase__summery-package-title">
                                            Beginner
                                        </div>
                                        <div class="purchase__summery-package-price">
                                            $235
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="purchase__step">
                    <div class="purchase__row">
                        <div class="purchase__finish">
                            <div class="purchase__finish-title">Payment Successful</div>
                            <div class="purchase__finish-img">
                                <img src="/elitenftcourse/images/icon-beginner.png" alt="Beginner">
                            </div>
                            <div class="purchase__finish-subtitle">Beginner</div>
                            <div class="purchase__finish-price">$235</div>
                            <div class="purchase__finish-link">
                                <a href="#">Go to Course</a>
                            </div>
                        </div>
                        <div class="purchase__finish">
                            <div class="purchase__finish-title">Payment Error</div>
                            <div class="purchase__finish-img">
                                <img src="/elitenftcourse/images/icon-error.svg" alt="Error">
                            </div>
                            <div class="purchase__finish-link">
                                <a href="#prev">Try Again</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="popup" id="login">
        <form action="{{ route('loginAction') }}" method="POST" class="ajax-form login">
            @csrf
            <div class="wrapper">
                <div class="popup__close">
                    <svg width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M7 28C7 11.67 11.67 7 28 7s21 4.67 21 21-4.85 21-21 21S7 44.33 7 28Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.83 22.17 22.17 33.83m11.66 0L22.17 22.17" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                </div>

                <div class="login__wrapper">
                    <div class="popup__title">Authorization</div>
                    <label class="login__label">
                        <div>Email</div>
                        <input name="email" type="text" class="login__input" placeholder="user@mail.com" required>
                        <div class="error-text email_error"></div>
                    </label>
                    <label class="login__label">
                        <div>Password</div>
                        <input name="password" type="password" class="login__input" placeholder="your password" required>
                        <div class="error-text password_error"></div>
                    </label>
                    <button type="submit" class="btn btn_block login__btn">Login</a>
                </div>
            </div>
        </form>
    </div>

    <div class="popup" id="terms">
        <div class="terms">
            <div class="wrapper">
                <div class="popup__close">
                    <svg width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M7 28C7 11.67 11.67 7 28 7s21 4.67 21 21-4.85 21-21 21S7 44.33 7 28Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.83 22.17 22.17 33.83m11.66 0L22.17 22.17" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                </div>

                <div class="popup__title">Terms & Conditions</div>
                <h4>OVERVIEW</h4>
                <p>This website is operated by .................................... Throughout the site, the
                terms “we”, “us” and “our” refer to .................................... ...................................
                offers this website, including all information, tools and services available
                from this site to you, the user, conditioned upon your acceptance of all
                terms, conditions, policies and notices stated here.</p>
                <p>By visiting our site and/ or purchasing something from us, you engage in our
                “Service” and agree to be bound by the following terms and conditions
                (“Terms of Service”, “Terms”), including those additional terms and
                conditions and policies referenced herein and/or available by hyperlink.
                These Terms of Service apply to all users of the site, including without
                limitation users who are browsers, vendors, customers, merchants, and/ or
                contributors of content.</p>
                <p>Please read these Terms of Service carefully before accessing or using our
                website. By accessing or using any part of the site, you agree to be bound by
                these Terms of Service. If you do not agree to all the terms and conditions of
                this agreement, then you may not access the website or use any services. If
                these Terms of Service are considered an offer, acceptance is expressly
                limited to these Terms of Service.</p>
                <p>Any new features or tools which are added to the current store shall also be
                subject to the Terms of Service. You can review the most current version of
                the Terms of Service at any time on this page. We reserve the right to
                update, change or replace any part of these Terms of Service by posting
                updates and/or changes to our website. It is your responsibility to check this
                page periodically for changes. Your continued use of or access to the website
                following the posting of any changes constitutes acceptance of those
                changes.</p>
                <p>Our store is hosted on Shopify Inc. They provide us with the online e-
                commerce platform that allows us to sell our products and services to you.</p>
                <h4>SECTION 1 - ONLINE STORE TERMS</h4>
                <p>By agreeing to these Terms of Service, you represent that you are at least
                the age of majority in your state or province of residence, or that you are the
                age of majority in your state or province of residence and you have given us
                your consent to allow any of your minor dependents to use this site.</p>
                <p>You may not use our products for any illegal or unauthorized purpose nor
                may you, in the use of the Service, violate any laws in your jurisdiction
                (including but not limited to copyright laws).</p>

                <p>You must not transmit any worms or viruses or any code of a destructive
                nature.
                A breach or violation of any of the Terms will result in an immediate
                termination of your Services.</p>
                <h4>SECTION 2 - GENERAL CONDITIONS</h4>
                <p>We reserve the right to refuse service to anyone for any reason at any time.
                You understand that your content (not including credit card information),
                may be transferred unencrypted and involve (a) transmissions over various
                networks; and (b) changes to conform and adapt to technical requirements of
                connecting networks or devices. Credit card information is always encrypted
                during transfer over networks.</p>
                <p>You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion
                of the Service, use of the Service, or access to the Service or any contact on
                the website through which the service is provided, without express written
                permission by us.</p>
                <p>The headings used in this agreement are included for convenience only and
                will not limit or otherwise affect these Terms.</p>
                <h4>SECTION 3 - ACCURACY, COMPLETENESS AND TIMELINESS OF
                INFORMATION</h4>
                <p>We are not responsible if information made available on this site is not
                accurate, complete or current. The material on this site is provided for
                general information only and should not be relied upon or used as the sole
                basis for making decisions without consulting primary, more accurate, more
                complete or more timely sources of information. Any reliance on the material
                on this site is at your own risk.</p>
                <p>This site may contain certain historical information. Historical information,
                necessarily, is not current and is provided for your reference only. We
                reserve the right to modify the contents of this site at any time, but we have
                no obligation to update any information on our site. You agree that it is your
                responsibility to monitor changes to our site.</p>
                <h4>SECTION 4 - MODIFICATIONS TO THE SERVICE AND PRICES</h4>
                <p>Prices for our products are subject to change without notice.
                We reserve the right at any time to modify or discontinue the Service (or any
                part or content thereof) without notice at any time.
                We shall not be liable to you or to any third-party for any modification, price
                change, suspension or discontinuance of the Service.</p>
                <h4>SECTION 5 - PRODUCTS OR SERVICES (if applicable)</h4>
                <p>Certain products or services may be available exclusively online through the
                website. These products or services may have limited quantities and are
                subject to return or exchange only according to our Return Policy.
                We have made every effort to display as accurately as possible the colors

                and images of our products that appear at the store. We cannot guarantee
                that your computer monitor&#39;s display of any color will be accurate.
                We reserve the right, but are not obligated, to limit the sales of our products
                or Services to any person, geographic region or jurisdiction. We may exercise
                this right on a case-by-case basis. We reserve the right to limit the quantities
                of any products or services that we offer. All descriptions of products or
                product pricing are subject to change at anytime without notice, at the sole
                discretion of us. We reserve the right to discontinue any product at any time.
                Any offer for any product or service made on this site is void where
                prohibited.</p>
                <p>We do not warrant that the quality of any products, services, information, or
                other material purchased or obtained by you will meet your expectations, or
                that any errors in the Service will be corrected.</p>
                <h4>SECTION 6 - ACCURACY OF BILLING AND ACCOUNT INFORMATION</h4>
                <p>We reserve the right to refuse any order you place with us. We may, in our
                sole discretion, limit or cancel quantities purchased per person, per
                household or per order. These restrictions may include orders placed by or
                under the same customer account, the same credit card, and/or orders that
                use the same billing and/or shipping address. In the event that we make a
                change to or cancel an order, we may attempt to notify you by contacting the
                email and/or billing address/phone number provided at the time the order
                was made. We reserve the right to limit or prohibit orders that, in our sole
                judgment, appear to be placed by dealers, resellers or distributors.</p>
                <p>You agree to provide current, complete and accurate purchase and account
                information for all purchases made at our store. You agree to promptly
                update your account and other information, including your email address and
                credit card numbers and expiration dates, so that we can complete your
                transactions and contact you as needed.</p>
                <p>For more detail, please review our Returns Policy.</p>
                <h4>SECTION 7 - OPTIONAL TOOLS</h4>
                <p>We may provide you with access to third-party tools over which we neither
                monitor nor have any control nor input.
                You acknowledge and agree that we provide access to such tools ”as is” and
                “as available” without any warranties, representations or conditions of any
                kind and without any endorsement. We shall have no liability whatsoever
                arising from or relating to your use of optional third-party tools.
                Any use by you of optional tools offered through the site is entirely at your
                own risk and discretion and you should ensure that you are familiar with and
                approve of the terms on which tools are provided by the relevant third-party
                provider(s).
                We may also, in the future, offer new services and/or features through the

                website (including, the release of new tools and resources). Such new
                features and/or services shall also be subject to these Terms of Service.</p>
                <h4>SECTION 8 - THIRD-PARTY LINKS</h4>
                <p>Certain content, products and services available via our Service may include
                materials from third-parties.
                Third-party links on this site may direct you to third-party websites that are
                not affiliated with us. We are not responsible for examining or evaluating the
                content or accuracy and we do not warrant and will not have any liability or
                responsibility for any third-party materials or websites, or for any other
                materials, products, or services of third-parties.
                We are not liable for any harm or damages related to the purchase or use of
                goods, services, resources, content, or any other transactions made in
                connection with any third-party websites. Please review carefully the third-
                party&#39;s policies and practices and make sure you understand them before
                you engage in any transaction. Complaints, claims, concerns, or questions
                regarding third-party products should be directed to the third-party.</p>
                <h4>SECTION 9 - USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS</h4>
                <p>If, at our request, you send certain specific submissions (for example contest
                entries) or without a request from us you send creative ideas, suggestions,
                proposals, plans, or other materials, whether online, by email, by postal mail,
                or otherwise (collectively, &#39;comments&#39;), you agree that we may, at any time,
                without restriction, edit, copy, publish, distribute, translate and otherwise
                use in any medium any comments that you forward to us. We are and shall be
                under no obligation (1) to maintain any comments in confidence; (2) to pay
                compensation for any comments; or (3) to respond to any comments.
                We may, but have no obligation to, monitor, edit or remove content that we
                determine in our sole discretion are unlawful, offensive, threatening,
                libelous, defamatory, pornographic, obscene or otherwise objectionable or
                violates any party’s intellectual property or these Terms of Service.
                You agree that your comments will not violate any right of any third-party,
                including copyright, trademark, privacy, personality or other personal or
                proprietary right. You further agree that your comments will not contain
                libelous or otherwise unlawful, abusive or obscene material, or contain any
                computer virus or other malware that could in any way affect the operation
                of the Service or any related website. You may not use a false email address,
                pretend to be someone other than yourself, or otherwise mislead us or third-
                parties as to the origin of any comments. You are solely responsible for any
                comments you make and their accuracy. We take no responsibility and
                assume no liability for any comments posted by you or any third-party.</p>
                <h4>SECTION 10 - PERSONAL INFORMATION</h4>
                <p>Your submission of personal information through the store is governed by
                our Privacy Policy. To view our Privacy Policy.</p>
                <h4>SECTION 11 - ERRORS, INACCURACIES AND OMISSIONS</h4>

                <p>Occasionally there may be information on our site or in the Service that
                contains typographical errors, inaccuracies or omissions that may relate to
                product descriptions, pricing, promotions, offers, product shipping charges,
                transit times and availability. We reserve the right to correct any errors,
                inaccuracies or omissions, and to change or update information or cancel
                orders if any information in the Service or on any related website is
                inaccurate at any time without prior notice (including after you have
                submitted your order).</p>
                <p>We undertake no obligation to update, amend or clarify information in the
                Service or on any related website, including without limitation, pricing
                information, except as required by law. No specified update or refresh date
                applied in the Service or on any related website, should be taken to indicate
                that all information in the Service or on any related website has been
                modified or updated.</p>
                <h4>SECTION 12 - PROHIBITED USES</h4>
                <p>In addition to other prohibitions as set forth in the Terms of Service, you are
                prohibited from using the site or its content: (a) for any unlawful purpose; (b)
                to solicit others to perform or participate in any unlawful acts; (c) to violate
                any international, federal, provincial or state regulations, rules, laws, or local
                ordinances; (d) to infringe upon or violate our intellectual property rights or
                the intellectual property rights of others; (e) to harass, abuse, insult, harm,
                defame, slander, disparage, intimidate, or discriminate based on gender,
                sexual orientation, religion, ethnicity, race, age, national origin, or disability;
                (f) to submit false or misleading information; (g) to upload or transmit viruses
                or any other type of malicious code that will or may be used in any way that
                will affect the functionality or operation of the Service or of any related
                website, other websites, or the Internet; (h) to collect or track the personal
                information of others; (i) to spam, phish, pharm, pretext, spider, crawl, or
                scrape; (j) for any obscene or immoral purpose; or (k) to interfere with or
                circumvent the security features of the Service or any related website, other
                websites, or the Internet. We reserve the right to terminate your use of the
                Service or any related website for violating any of the prohibited uses.</p>
                <h4>SECTION 13 - DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</h4>
                <p>We do not guarantee, represent or warrant that your use of our service will
                be uninterrupted, timely, secure or error-free.
                We do not warrant that the results that may be obtained from the use of the
                service will be accurate or reliable.
                You agree that from time to time we may remove the service for indefinite
                periods of time or cancel the service at any time, without notice to you.
                You expressly agree that your use of, or inability to use, the service is at your
                sole risk. The service and all products and services delivered to you through
                the service are (except as expressly stated by us) provided &#39;as is&#39; and &#39;as
                available&#39; for your use, without any representation, warranties or conditions
                of any kind, either express or implied, including all implied warranties or

                conditions of merchantability, merchantable quality, fitness for a particular
                purpose, durability, title, and non-infringement.
                In no case shall ..................................., our directors, officers, employees,
                affiliates, agents, contractors, interns, suppliers, service providers or
                licensors be liable for any injury, loss, claim, or any direct, indirect,
                incidental, punitive, special, or consequential damages of any kind, including,
                without limitation lost profits, lost revenue, lost savings, loss of data,
                replacement costs, or any similar damages, whether based in contract, tort
                (including negligence), strict liability or otherwise, arising from your use of
                any of the service or any products procured using the service, or for any
                other claim related in any way to your use of the service or any product,
                including, but not limited to, any errors or omissions in any content, or any
                loss or damage of any kind incurred as a result of the use of the service or
                any content (or product) posted, transmitted, or otherwise made available
                via the service, even if advised of their possibility. Because some states or
                jurisdictions do not allow the exclusion or the limitation of liability for
                consequential or incidental damages, in such states or jurisdictions, our
                liability shall be limited to the maximum extent permitted by law.</p>
                <h4>SECTION 14 - INDEMNIFICATION</h4>
                <p>You agree to indemnify, defend and hold harmless ................................... and our
                parent, subsidiaries, affiliates, partners, officers, directors, agents,
                contractors, licensors, service providers, subcontractors, suppliers, interns
                and employees, harmless from any claim or demand, including reasonable
                attorneys’ fees, made by any third-party due to or arising out of your breach
                of these Terms of Service or the documents they incorporate by reference,
                or your violation of any law or the rights of a third-party.</p>
                <h4>SECTION 15 - SEVERABILITY</h4>
                <p>In the event that any provision of these Terms of Service is determined to be
                unlawful, void or unenforceable, such provision shall nonetheless be
                enforceable to the fullest extent permitted by applicable law, and the
                unenforceable portion shall be deemed to be severed from these Terms of
                Service, such determination shall not affect the validity and enforceability of
                any other remaining provisions.</p>
                <h4>SECTION 16 - TERMINATION</h4>
                <p>The obligations and liabilities of the parties incurred prior to the termination
                date shall survive the termination of this agreement for all purposes.
                These Terms of Service are effective unless and until terminated by either
                you or us. You may terminate these Terms of Service at any time by notifying
                us that you no longer wish to use our Services, or when you cease using our
                site.</p>
                <p>If in our sole judgment you fail, or we suspect that you have failed, to comply
                with any term or provision of these Terms of Service, we also may terminate
                this agreement at any time without notice and you will remain liable for all

                amounts due up to and including the date of termination; and/or accordingly
                may deny you access to our Services (or any part thereof).</p>
                <h4>SECTION 17 - ENTIRE AGREEMENT</h4>
                <p>The failure of us to exercise or enforce any right or provision of these Terms
                of Service shall not constitute a waiver of such right or provision.
                These Terms of Service and any policies or operating rules posted by us on
                this site or in respect to The Service constitutes the entire agreement and
                understanding between you and us and govern your use of the Service,
                superseding any prior or contemporaneous agreements, communications and
                proposals, whether oral or written, between you and us (including, but not
                limited to, any prior versions of the Terms of Service).
                Any ambiguities in the interpretation of these Terms of Service shall not be
                construed against the drafting party.</p>
                <h4>SECTION 18 - GOVERNING LAW</h4>
                <p>These Terms of Service and any separate agreements whereby we provide
                you Services shall be governed by and construed in accordance with the laws
                of Australia.</p>
                <h4>SECTION 19 - CHANGES TO TERMS OF SERVICE</h4>
                <p>You can review the most current version of the Terms of Service at any time
                at this page.
                We reserve the right, at our sole discretion, to update, change or replace any
                part of these Terms of Service by posting updates and changes to our
                website. It is your responsibility to check our website periodically for
                changes. Your continued use of or access to our website or the Service
                following the posting of any changes to these Terms of Service constitutes
                acceptance of those changes.</p>
                <h4>SECTION 20 - CONTACT INFORMATION</h4>
                <p>Questions about the Terms of Service should be sent to us at
                ………………………………….</p>
            </div>
        </div>
    </div>

    <div class="popup" id="privacy">
        <div class="terms">
            <div class="wrapper">
                <div class="popup__close">
                    <svg width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M7 28C7 11.67 11.67 7 28 7s21 4.67 21 21-4.85 21-21 21S7 44.33 7 28Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.83 22.17 22.17 33.83m11.66 0L22.17 22.17" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                </div>

                <div class="popup__title">Privacy Policy</div>
                <h4>Personal information we collect </h4>
                <p>When you visit the Site, we automatically collect certain information about
                your device, including information about your web browser, IP address, time
                zone, and some of the cookies that are installed on your device. Additionally,
                as you browse the Site, we collect information about the individual web
                pages or products that you view, what websites or search terms referred you
                to the Site, and information about how you interact with the Site. We refer to
                this automatically-collected information as “Device Information”. </p>
                <p>We collect Device Information using the following technologies: <br>
                - “Cookies” are data files that are placed on your device or computer and
                often include an anonymous unique identifier. For more information about
                cookies, and how to disable cookies, visit http://www.allaboutcookies.org. <br>
                - “Log files” track actions occurring on the Site, and collect data including
                your IP address, browser type, Internet service provider, referring/exit
                pages, and date/time stamps. <br>
                - “Web beacons”, “tags”, and “pixels” are electronic files used to record
                information about how you browse the Site. </p>
                <p>Additionally when you make a purchase or attempt to make a purchase
                through the Site, we collect certain information from you, including your
                name, billing address, shipping address, payment information (including
                credit card numbers  email address, and phone number. We refer to this
                information as “Order Information”. </p>

                <p>When we talk about “Personal Information” in this Privacy Policy, we are
                talking both about Device Information and Order Information. </p>
                <h4>How do we use your personal information? </h4>
                <p>We use the Order Information that we collect generally to fulfill any orders
                placed through the Site (including processing your payment information,
                arranging for shipping, and providing you with invoices and/or order
                confirmations). Additionally, we use this Order Information to: <br>
                - Communicate with you; <br>
                - Screen our orders for potential risk or fraud; and <br>
                - When in line with the preferences you have shared with us, provide you
                with information or advertising relating to our products or services. </p>
                <p>We use the Device Information that we collect to help us screen for potential

                risk and fraud (in particular, your IP address), and more generally to improve
                and optimize our Site (for example, by generating analytics about how our
                customers browse and interact with the Site, and to assess the success of our
                marketing and advertising campaigns). </p>
                <h4>Sharing your personal Information </h4>
                <p>We share your Personal Information with third parties to help us use your
                Personal Information, as described above. For example, we use Shopify to
                power our online store--you can read more about how Shopify uses your
                Personal Information here: https://www.shopify.com/legal/privacy. We also
                use Google Analytics to help us understand how our customers use the Site --
                you can read more about how Google uses your Personal Information here:
                https://www.google.com/intl/en/policies/privacy/. You can also opt-out of
                Google Analytics here: https://tools.google.com/dlpage/gaoptout. </p>
                <p>Finally, we may also share your Personal Information to comply with
                applicable laws and regulations, to respond to a subpoena, search warrant or
                other lawful request for information we receive, or to otherwise protect our
                rights. </p>
                <h4>Behavioural advertising </h4>
                <p>As described above, we use your Personal Information to provide you with
                targeted advertisements or marketing communications we believe may be of
                interest to you. For more information about how targeted advertising works,
                you can visit the Network Advertising Initiative’s (“NAI”) educational page at
                http://www.networkadvertising.org/understanding-online-advertising/how-
                does-it-work. </p>
                <p>You can opt out of targeted advertising by using the links below: <br>
                - Facebook: https://www.facebook.com/settings/?tab=ads <br>
                - Google: https://www.google.com/settings/ads/anonymous <br>
                - Bing: https://advertise.bingads.microsoft.com/en-
                us/resources/policies/personalized-ads </p>
                <p>Additionally, you can opt out of some of these services by visiting the Digital
                Advertising Alliance’s opt-out portal at: http://optout.aboutads.info/. </p>
                <h4>Do not track </h4>
                <p>Please note that we do not alter our Site’s data collection and use practices
                when we see a Do Not Track signal from your browser. </p>
                <h4>Your rights </h4>
                <p>If you are a European resident, you have the right to access personal
                information we hold about you and to ask that your personal information be
                corrected, updated, or deleted. If you would like to exercise this right, please
                contact us through the contact information below. </p>

                <p>Additionally, if you are a European resident we note that we are processing
                your information in order to fulfil contracts we might have with you (for
                example if you make an order through the Site), or otherwise to pursue our
                legitimate business interests listed above. Additionally, please note that your
                information will be transferred outside of Europe, including to Canada and
                the United States. </p>
                <h4>Data retention </h4>
                <p>When you place an order through the Site, we will maintain your Order
                Information for our records unless and until you ask us to delete this
                information. </p>
                <h4>Changes </h4>
                <p>We may update this privacy policy from time to time in order to reflect, for
                example, changes to our practices or for other operational, legal or
                regulatory reasons. </p>
                <h4>Minors </h4>
                <p>The Site is not intended for individuals under the age of 12.</p>
            </div>
        </div>
    </div>

    {{ HTML::script('/elitenftcourse/js/ajax-form.js') }}

@endsection