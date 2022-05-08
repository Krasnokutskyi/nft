@extends('layouts.app')

@section('content')

    <div class="page">

        @include('layouts.headers.header-content')

        <div class="wrapper">
            <div class="market__title"><span>Market Activity</span></div>
            <div class="market market_inner">
                <div class="row">

                    @if ($market_activity->count() > 0)
                        @foreach ($market_activity as $key => $item)
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="market__item">
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
                    @else
                        <p class="lack_posts">List is empty.</p>
                    @endif
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="footer-cnt">
                <div class="wrapper">
                    <div class="footer__logo">
                        <img src="./images/footer-logo.svg" alt="Elite NFT Course">
                    </div>
                    <div class="footer__links">
                        <a href="#">Terms &amp; Conditions</a>
                        <a href="#">Privacy Policy</a>
                    </div>
                    <div class="footer__copy">© 2022 Elite NFT Course<br>All Rights Reserved - 2022</div>
                </div>
            </div>
        </footer>
    </div>

@endsection