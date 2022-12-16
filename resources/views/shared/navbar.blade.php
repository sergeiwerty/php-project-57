<nav class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
        <a class="flex items-center" href="/">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Менеджер задач</span>
        </a>
        <div class="flex items-center lg:order-2">
            <a href="/login" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Вход
            </a>
            <a href="/register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2">
                Регистрация
            </a>
        </div>
        <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="">Задачи</a>
                </li>
                <li>
                    <a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="{{ route('task_statuses.index') }}">Статусы</a>
                </li>
                <li>
                    <a class="block py-2 pl-3 pr-4 text-gray-700 hover:text-blue-700 lg:p-0" href="">Метки</a>
                </li>
            </ul>
        </div>
{{--        {{dump($eloquentConnection->getConnection()->getRawPdo())}}--}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            {{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a class="nav-link" href="#">Задачи</a>--}}
            {{--                </li>--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a class="nav-link" href="#">Статусы</a>--}}
            {{--                </li>--}}
            {{--                <li class="nav-item">--}}
            {{--                    <a class="nav-link" href="#">Метки</a>--}}
            {{--                </li>--}}
            {{--            </ul>--}}
        </div>
    </div>
</nav>