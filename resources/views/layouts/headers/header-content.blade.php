<header class="header">
    <div class="logo"><img src="/elitenftcourse/images/logo.svg" alt="Elite NFT Course"></div>
    <nav class="menu">
        <ul>
            <li><a href="{{ route('videos.posts') }}">Videos</a></li>
            <li><a href="{{ route('downloads.files') }}">Downloads</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="{{ route('blog.posts') }}">Blog</a></li>
            <li><a href="{{ route('marketActivity') }}">Market Activity</a></li>
        </ul>
    </nav>
    <label class="menu__btn" for="menu__toggle">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384.97 384.97" style="enable-background:new 0 0 384.97 384.97" xml:space="preserve"><path d="M12.03 84.212h360.909c6.641 0 12.03-5.39 12.03-12.03 0-6.641-5.39-12.03-12.03-12.03H12.03C5.39 60.152 0 65.541 0 72.182c0 6.641 5.39 12.03 12.03 12.03zM372.939 180.455H12.03c-6.641 0-12.03 5.39-12.03 12.03s5.39 12.03 12.03 12.03h360.909c6.641 0 12.03-5.39 12.03-12.03s-5.389-12.03-12.03-12.03zM372.939 300.758H12.03c-6.641 0-12.03 5.39-12.03 12.03 0 6.641 5.39 12.03 12.03 12.03h360.909c6.641 0 12.03-5.39 12.03-12.03.001-6.641-5.389-12.03-12.03-12.03z" fill="#d8e543"/></svg>
    </label>
    <a href="{{ route('logout') }}" class="auth auth_logout">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384.97 384.97" xml:space="preserve"><path d="M180.46 360.91H24.06V24.06h156.4a12.03 12.03 0 0 0 0-24.06H12.03A12.03 12.03 0 0 0 0 12.03v360.91c0 6.64 5.39 12.03 12.03 12.03h168.42a12.03 12.03 0 0 0 0-24.06z" fill="currentColor"/><path d="m381.48 184.09-83-84.2a11.94 11.94 0 0 0-17.02 0 12.22 12.22 0 0 0 0 17.18l62.56 63.46H96.28a12.1 12.1 0 0 0-12.03 12.15 12.1 12.1 0 0 0 12.03 12.15h247.74l-62.56 63.46a12.22 12.22 0 0 0 0 17.18 11.93 11.93 0 0 0 17.01 0l83-84.2a12.3 12.3 0 0 0 .01-17.18z" fill="currentColor"/></svg>
    </a>
    <div class="hamburger-menu">
        <input id="menu__toggle" type="checkbox" />

        <ul class="menu__box">
            <li><a href="{{ route('videos.posts') }}">Videos</a></li>
            <li><a href="{{ route('downloads.files') }}">Downloads</a></li>
            <li><a href="#">Calendar</a></li>
            <li><a href="{{ route('blog.posts') }}">Blog</a></li>
            <li><a href="{{ route('marketActivity') }}">Market Activity</a></li>
        </ul>
    </div>

</header>
