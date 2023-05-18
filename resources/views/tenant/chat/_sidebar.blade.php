@section('sidebar')
    <div class="overflow-y-auto">
        <!-- Tabs -->
        <div class="tabs p-5">
            <nav class="tab-nav mt-5">
                <button class="nav-link h5 uppercase active" data-toggle="tab"
                    data-target="#tab-1">Direct</button>
                <button class="nav-link h5 uppercase" data-toggle="tab" data-target="#tab-2">Groups</button>
            </nav>
            <div class="tab-content mt-5">
                <div id="tab-1" class="collapse open">
                    <form class="flex  mb-5">
                        <label class="form-control-addon-within rounded-full">
                            <input class="form-control border-none" placeholder="Search">
                            <button
                                class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                        </label>
                    </form>

                    <a href="{{ route('chat.show', ['id' => 2]) }}" class="flex items-center py-5">
                        <div class="avatar w-16 h-16 ltr:mr-5 rtl:ml-5">
                            <div class="status bg-success"></div>
                        </div>
                        <div>
                            <h5>Potato Bahadur</h5>
                            <p>Last seen today 2:20PM</p>
                        </div>
                    </a>
                    <hr>
                </div>

                <div id="tab-2" class="collapse">
                    <form class="flex  mb-5">
                        <label class="form-control-addon-within rounded-full">
                            <input class="form-control border-none" placeholder="Search">
                            <button
                                class="text-gray-300 dark:text-gray-700 text-xl leading-none la la-search ltr:mr-4 rtl:ml-4"></button>
                        </label>
                    </form>

                    <a href="{{ route('chat.show', ['id' => 2]) }}" class="flex items-center py-5">
                        <div class="avatar w-16 h-16 ltr:mr-5 rtl:ml-5">
                            <div class="status bg-success"></div>
                        </div>
                        <div>
                            <h5>Potato Bahadur</h5>
                            <p>Last seen today 2:20PM</p>
                        </div>
                    </a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
