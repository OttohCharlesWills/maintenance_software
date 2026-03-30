<div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
        <h4 class="mb-4">Machine System</h4>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="/superadmin/dashboard" class="nav-link text-white">
                    Dashboard
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.equipment') }}" class="nav-link text-white">
                    Equipments
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.meters') }}" class="nav-link text-white">
                    Meters
                </a>
            </li>
            
            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.locations.index') }}" class="nav-link text-white">
                    Locations
                </a>
            </li>
            
            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.users.create') }}" class="nav-link text-white">
                    Create Users
                </a>
            </li>
            
            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.users.index') }}" class="nav-link text-white">
                    User Managements
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.maintenance') }}" class="nav-link text-white">
                    Maintenance Report
                </a>
            </li>
            
            <li class="nav-item mb-2">
                <a href="{{ route('superadmin.production.reports') }}" class="nav-link text-white">
                    Production Report
                </a>
            </li>


        </ul>
    </div>