<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <select name="translates" id="" onchange="this.form.submit()">
                <option value="">Til</option>
                <option value="oz" {{request('translates') == 'oz' ? 'selected' : ''}}>O'z</option>
                <option value="uz" {{request('translates') == 'uz' ? 'selected' : ''}}>Uz</option>
                <option value="ru" {{request('translates') == 'ru' ? 'selected' : ''}}>Ru</option>
                <option value="en" {{request('translates') == 'en' ? 'selected' : ''}}>En</option>
            </select>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="{{route('logout')}}" role="button">
                <i class="fa fa-sign-out-alt"></i> Chiqish
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
