<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="{{asset('assets/backend/images/user.png')}}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                    <li role="separator" class="divider"></li>
                    <li>

                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          <i class="material-icons">input</i>{{ __('Sign Out') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>



                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
<!-- ===================Start Admin Side bar ============================  -->
            @if(Request::is('admin*'))

            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{route('admin.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                <a href="{{route('admin.tag.index')}}">
                    <i class="material-icons">label</i>
                    <span>Tag</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/category*') ? 'active' : '' }}">
                <a href="{{route('admin.category.index')}}">
                    <i class="material-icons">apps</i>
                    <span>Category</span>
                </a>
            </li>
            <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                <a href="{{route('admin.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Post</span>
                </a>
            </li>
                <li class="{{ Request::is('admin/favourite*') ? 'active' : '' }}">
                    <a href="{{route('favourite.posts')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favourite Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/comment*') ? 'active' : '' }}">
                    <a href="{{route('admin.comment.index')}}">
                        <i class="material-icons">comment</i>
                        <span> Comments </span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{route('admin.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Settings</span>
                    </a>
                </li>

            @endif

<!-- ================End Admin Side bar ============================  -->

<!-- ===================Start author Side bar ============================  -->

            @if(Request::is('author*'))

            <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                <a href="{{route('author.dashboard')}}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                <a href="{{route('author.post.index')}}">
                    <i class="material-icons">library_books</i>
                    <span>Post</span>
                </a>
            </li>
                <li class="{{ Request::is('author/favourite*') ? 'active' : '' }}">
                    <a href="{{route('favourite.posts')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favourite Posts</span>
                    </a>
                </li>
                <li class="{{ Request::is('author/comment*') ? 'active' : '' }}">
                    <a href="{{route('author.comment.index')}}">
                        <i class="material-icons">comment</i>
                        <span> Comments </span>
                    </a>
                </li>

            @endif

<!-- ================End author Side bar ============================  -->





            <li class="header ">System</li>



              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  <i class="material-icons">input</i>{{ __('Sign Out') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>



            </li>




        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2019 @ <a href="javascript:void(0);">Admin template designed by shahadat</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0
        </div>
    </div>
    <!-- #Footer -->
</aside>
