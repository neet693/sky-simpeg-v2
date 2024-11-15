<div class="nav">
    <div class="d-flex justify-content-between align-items-center w-100 mb-3 mb-md-0">
        <div class="d-flex justify-content-start align-items-center">
            <button id="toggle-navbar" onclick="toggleNavbar()">
                <img src="{{ asset('template/assets/img/global/burger.svg') }}" class="mb-2" alt="">
            </button>
            <h2 class="nav-title">{{ $pageTitle ?? 'Overview' }}</h2>
        </div>
        <button class="btn-notif d-block d-md-none">
            <img src="{{ asset('template/assets/img/global/bell.svg') }}" alt="">
        </button>
    </div>

    <div class="d-flex justify-content-between align-items-center nav-input-container">
        <div class="nav-input-group">
            <input type="text" class="nav-input" placeholder="Search people, team, project">
            <button class="btn-nav-input">
                <img src="{{ asset('template/assets/img/global/search.svg') }}" alt="">
            </button>
        </div>

        <a href="#" class="btn btn-notif">
            <img src="{{ asset('template/assets/img/global/bell.svg') }}" alt="">
        </a>
    </div>
</div>
