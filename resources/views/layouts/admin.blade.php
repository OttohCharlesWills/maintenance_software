<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Maintainance Software') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-light bg-white shadow-sm px-4">
        <div>
            <h5 style="margin: 0"><b>Admin Panel</b></h5>
        </div>

        <div style="display: flex; gap: 1rem; align-items:center;">
            <span>
                Welcome, {{ Auth::user()->name }}
            </span>

            <li class="nav-item" style="list-style-type: none">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-danger w-100">
                        Logout
                    </button>
                </form>
            </li>
        </div>
    </nav>

    <div id="app" class="d-flex">
        @include('includes.adminsidebar')

        <main class="" class="flex-grow-1">
            @yield('admincontent')
        </main>

        <div id="running-timers" style="
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 5px;
        "></div>
    </div>


<script>
    let timers = {};

    function fetchRunningMachines() {
        fetch('/running-machines')
            .then(res => res.json())
            .then(data => {
                data.forEach(m => {
                    if(!timers[m.machine_id]){
                        // create timer element
                        let el = document.createElement('div');
                        el.id = 'timer-' + m.machine_id;
                        el.style.background = '#333';
                        el.style.color = '#fff';
                        el.style.padding = '5px 10px';
                        el.style.borderRadius = '5px';
                        el.innerText = `${m.machine_name}: 00:00:00`;
                        document.getElementById('running-timers').appendChild(el);

                        timers[m.machine_id] = {
                            element: el,
                            startTimestamp: m.start_time,
                            status: m.status,
                            pausedSeconds: 0,
                            machine_name: m.machine_name 
                        };
                    } else {
                        // update status if changed
                        timers[m.machine_id].status = m.status;
                    }
                });

                // remove finished timers
                Object.keys(timers).forEach(id => {
                    if(!data.find(m => m.machine_id == id)){
                        timers[id].element.remove();
                        delete timers[id];
                    }
                });
            });
    }

    // update timer display every second
    setInterval(() => {
        Object.values(timers).forEach(t => {
            if(t.status === 'running'){
                let seconds = Math.floor(Date.now()/1000) - t.startTimestamp + t.pausedSeconds;
                let h = String(Math.floor(seconds/3600)).padStart(2,'0');
                let m = String(Math.floor((seconds%3600)/60)).padStart(2,'0');
                let s = String(seconds%60).padStart(2,'0');
                t.element.innerText = `${t.machine_name}: ${h}:${m}:${s}`;
            } else if(t.status === 'standby'){
                // freeze, do nothing (timer paused)
            } else {
                // shutdown/faulty, remove element
                t.element.remove();
                delete timers[t.machine_id];
            }
        });
    }, 1000);

    // fetch every 10s to catch new running machines
    fetchRunningMachines();
    setInterval(fetchRunningMachines, 10000);
</script>
</body>
</html>
