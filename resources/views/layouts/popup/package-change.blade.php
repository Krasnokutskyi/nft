<div class="popup" id="package-change">
	
	<div class="popup__close">
	    <svg width="56" height="56" fill="none" xmlns="http://www.w3.org/2000/svg"><path clip-rule="evenodd" d="M7 28C7 11.67 11.67 7 28 7s21 4.67 21 21-4.85 21-21 21S7 44.33 7 28Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/><path d="M33.83 22.17 22.17 33.83m11.66 0L22.17 22.17" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
	</div>

    <div class="packages">
        <div class="wrapper">

            <div class="purchase__step current">
                <h2>Take a <span class="u5">look</span> and <span class="u6">choose</span> one</h2>
                <p class="packages__subtitle">Choose one of the packages to get access to more content.</p>
                <div class="packages__list">

                    @foreach ($packages->load(['users']) as $package)

                        @if($package->users->where('id', '=', auth('web')->user()->id)->count() === 1)
                            @continue;
                        @endif

                        <div class="packages__item" data-package_id="{{ $package->id }}">
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
                                    <a class="btn btn_small" data-package_id="{{ $package->id }}" href="#change_package">Purchase</a>
                                </div>
                                @if (!empty($package->discount))
                                    <div class="packages__price-old">Old Price ${{ $package->price }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="purchase__step">
                <form action="{{ route('orders.changePackageAction') }}" method="POST" next_step-ajax-form=".purchase__step:eq(2), .purchase__steps-step:eq(2)" preloader-ajax-form="body" class="ajax-form purchase">
                    @csrf
                    <div class="purchase__row row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="purchase__title">Billing Information</div>
                            <div class="purchase__group">
                                <label class="purchase__label">
                                    <span>Card Number</span>
                                    <div class="purchase__input_group">
                                        <input name="card_number" class="purchase__input" type="text" placeholder="0000 0000 0000 0000" autocomplete="off" required>
                                        <div class="error-text card_number_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Cardholder Name</span>
                                    <div class="purchase__input_group">
                                        <input name="cardholder_name" class="purchase__input" type="text" placeholder="John Doe" autocomplete="off" required>
                                        <div class="error-text cardholder_name_error"></div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>Expire Date</span>
                                    <div class="row-container">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="purchase__input_group">
                                                    <input name="expiration_month" class="purchase__input" type="text" placeholder="Month" autocomplete="off" required>
                                                    <div class="error-text expiration_month_error"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="purchase__input_group">
                                                    <input name="expiration_year" class="purchase__input" type="text" placeholder="Year" autocomplete="off" required>
                                                    <div class="error-text expiration_year_error"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                <label class="purchase__label">
                                    <span>CVV/CVC</span>
                                    <div class="purchase__input_group">
                                        <input name="cvv" class="purchase__input" type="text" placeholder="Security Code" autocomplete="off" required>
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
                                    <div class="purchase__summery-back">
                                        <a href="#prev">Change</a>
                                    </div>
                                    @foreach ($packages as $package)
                                        <div class="purchase__summery-package" data-package_id = "{{ $package->id }}">
                                            <div class="purchase__summery-package-img">
                                                <img src="/uploads/images/packages/preview/{{ $package->preview }}" alt="{{ $package->name }}">
                                            </div>
                                            <div class="purchase__summery-package-title">
                                                {{ $package->name }}
                                            </div>
                                            <div class="purchase__summery-package-price">
                                                ${{ (floatval($package->discount) == 0) ? $package->price : $package->discount }}
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="text" name="package" hidden autocomplete="off">
                                    <div class="error-text package_error"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="purchase__step">
                <div class="purchase__row">
                    <div class="purchase__finish" object-status="true">
                        <div class="purchase__finish-title">Payment Successful</div>
                        <div class="purchase__finish-img"></div>
                        <div class="purchase__finish-subtitle"></div>
                        <div class="purchase__finish-price"></div>
                    </div>
                    <div class="purchase__finish" object-status="false">
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
    </div>
</div>