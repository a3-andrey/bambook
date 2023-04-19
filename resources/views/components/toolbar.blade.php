<!-- Topbar -->
<div id="topbar" class="topbar-fullwidth d-none d-lg-block">
    <div style="padding-top: 20px;padding-bottom: 20px;" class="container">
        <div class="row">
            <div class="col-md-6">
                <a href="/">
                    <img src="{{ image(config('site.logo')) }}">
                </a>
            </div>
            <div class="col-md-6 d-none d-sm-block">
                @guest
                <ul class="top-menu" style="float:right">
                    <li><a href="#">Регистрация</a></li>
                    <li>
                        <a href="#">
                        <button class="btn btn-outline" type="submit">Личный кабинет</button></a>
                    </li>
                </ul>
                @endguest
                @auth
                <ul class="top-menu" style="float:right">
                    <li class="nav-item dropdown">
                        <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" class="avatar" data-toggle="tooltip" data-original-title="">
                    </li>
                    <li>{{ \Illuminate\Support\Facades\Auth::user()->full_name }}</li>
                    <li class="dropdown mega-menu-item">
                        <a  style="font-weight: bold; margin-left: 7px;" href="#">Выйти</a>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </div>
</div>
<!-- end: Topbar -->
