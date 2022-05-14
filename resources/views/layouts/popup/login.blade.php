<div class="popup" id="login">
    <form action="{{ route('loginAction') }}" preloader-ajax-form="body" method="POST" class="ajax-form login">
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