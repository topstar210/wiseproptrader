<link rel="stylesheet" href="/css/dashboard/sidebar.css">

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <ul class="list-unstyled components">
            <ul class="list-unstyled CTAs">
                <li><a href="{{ route('dash_wiseprop_funding') }}">New Wiseprop Funding</a></li>
            </ul>
            <p>Main Menu</p>
            <hr />
            <li class="<?php echo $pagename=="client-area"?"active":"" ?>">
                <a href="{{ route('dash_client_area') }}">Client Area</a>
            </li>
            <li class="<?php echo $pagename=="profile"?"active":"" ?>">
                <a href="{{ route('dash_profile') }}">Profile</a>
            </li>
            <li class="<?php echo $pagename=="download"?"active":"" ?>">
                <a href="{{ route('dash_download') }}">Download</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Extras</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Trading Academy</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Billing</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Wise Prop Traders</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Customer Support</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Leaderboard</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Certificates</a>
            </li>
            <li>
                <a href="{{ route('dash_comingsoon') }}">Autochartist</a>
            </li>
            <hr />
            <li>
                <a href="{{ route('home') }}">Back to website</a>
            </li>
            <li>
                <a href="#langaugeSubmenu" data-toggle="collapse" aria-expanded="false">Langauge</a>
                <ul class="collapse list-unstyled" id="langaugeSubmenu">
                    <li><a href="#">English</a></li>
                    <li><a href="#">French</a></li>
                </ul>
            </li>
        </ul>

    </nav>

    <!-- Page Content Holder -->
    
</div>