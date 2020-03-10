<nav id="sidebar">
    <div class="sidebar-header">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/image/placeholder.png') }}">
        </a><br>
        <a>{{ auth()->user()->name }} ({{ auth()->user()->role->name }})</a>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ request()->is('') ? 'active' : '' }}">
            <a href="{{  url('/dashboard') }}">Dashboard</a>
        </li>
        @if(auth()->user()->role_id != 1)
        <li class="{{ request()->is('profile') ? 'active' : '' }}">
            <a href="{{  url('/profile') }}">Profile</a>
        </li>
        @endif

        @if(auth()->user()->role_id == 1) 
        <li class="{{ request()->is('users') || request()->is('roles') ? 'active' : '' }}">
            <a href="#userManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                User Management</a>
            <ul class="collapse {{ request()->is('users') || request()->is('roles') ? 'show' : '' }} list-unstyled" id="userManagement">
                <li>
                <a href="{{ url('roles') }}">Roles</a>
                </li>
                <li>
                    <a href="{{ url('users') }}">Users</a>
                </li>
            </ul>
        </li>
        @endif
        <li>
            <a href="#expenseManagement" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                Expense Management</a>
            <ul class="collapse {{ request()->is('expense-categories') || request()->is('expenses') ? 'show' : '' }} list-unstyled" id="expenseManagement">
                @if(auth()->user()->role_id == 1) 
                <li>
                    <a href="{{ url('expense-categories') }}">Categories</a>
                </li>
                @endif
                <li>
                    <a href="{{ url('expenses') }}">Expenses</a>
                </li>
            </ul>
        </li>
    
    </ul>

</nav>