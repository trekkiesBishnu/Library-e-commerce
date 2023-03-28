<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link"  href="{{url('/admin/home')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">DashBoard</span>
        </a>
      </li>
      <li class="nav-item">
            <a class="nav-link" href="{{ route('category') }}">
              <i class="mdi mdi-emoticon menu-icon"></i>
              <span class="menu-title">Category</span>
            </a>
          </li>
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('book') }}">
                <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Books</span>
          {{-- <i class="menu-arrow"></i> --}}
        </a>
        {{-- <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
          </ul>
        </div> --}}
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('author') }}">
                <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Authors</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('slider') }}">
                <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Slider</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('orderList')}}">
                <i class="mdi mdi-emoticon menu-icon"></i>
          <span class="menu-title">Order List</span>
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link"  href="{{ route('user') }}" >
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">User Pages</span>
          {{-- <i class="menu-arrow"></i> --}}
        </a>
        {{-- <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/login-2.html"> Login 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/register-2.html"> Register 2 </a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/samples/lock-screen.html"> Lockscreen </a></li>
          </ul>
        </div> --}}
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('roles') }}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Roles </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('permissions') }}">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Permissions </span>
        </a>
      </li>
    </ul>
  </nav>