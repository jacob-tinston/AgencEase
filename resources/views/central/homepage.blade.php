@extends('central.layouts.main')

@section('body')
    <div class="container mt-20 py-10">
        <div class="w-full mt-16">
            <div class="mx-5 md:mx-10 text-center uppercase">
                <h1 class="text-6xl font-bold text-center">Coming Soon</h1>
                <h2 class="text-primary mt-5">AgencEase</h2>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-5 mt-16">
            <div class="card text-center">
                <div class="p-5">
                    <h2 class="uppercase">Gold</h2>
                    <h4 class="uppercase mt-2">For Small Projects</h4>
                </div>
                <div class="p-5 bg-background bg-opacity-50 dark:bg-opacity-50 uppercase text-primary">
                    <div class="text-2xl font-bold mb-2">£15</div>
                    <span class="border-t border-primary pt-1 text-xs">Monthly</span>
                </div>
                <div class="p-5">
                    <a href="#" class="btn btn_primary uppercase">Get Started</a>
                </div>
                <hr class="border-dashed">
                <div class="p-5">
                    <ul class="leading-loose">
                        <li>1 User</li>
                        <li>Max 100 Items</li>
                        <li>500 Queries To Database</li>
                        <li>Basic Statistics</li>
                        <li>Email Support</li>
                    </ul>
                </div>
            </div>

            <div class="card text-center">
                <div class="p-5">
                    <h2 class="uppercase">Diamond</h2>
                    <h4 class="uppercase mt-2">For Medium Projects</h4>
                </div>
                <div class="p-5 bg-background bg-opacity-50 dark:bg-opacity-50 uppercase text-primary">
                    <div class="text-2xl font-bold mb-2">£25</div>
                    <span class="border-t border-primary pt-1 text-xs">Monthly</span>
                </div>
                <div class="p-5">
                    <a href="#" class="btn btn_primary uppercase">Get Started</a>
                </div>
                <hr class="border-dashed">
                <div class="p-5">
                    <ul class="leading-loose">
                        <li>Upto 5 Users</li>
                        <li>Max 100 Items</li>
                        <li>500 Queries To Database</li>
                        <li>Basic Statistics</li>
                        <li>Email Support</li>
                    </ul>
                </div>
            </div>

            <div class="card text-center">
                <div class="p-5">
                    <h2 class="uppercase">Platinum</h2>
                    <h4 class="uppercase mt-2">For Complex Projects</h4>
                </div>
                <div class="p-5 bg-background bg-opacity-50 dark:bg-opacity-50 uppercase text-primary">
                    <div class="text-2xl font-bold mb-2">£35</div>
                    <span class="border-t border-primary pt-1 text-xs">Monthly</span>
                </div>
                <div class="p-5">
                    <a href="#" class="btn btn_primary uppercase">Get Started</a>
                </div>
                <hr class="border-dashed">
                <div class="p-5">
                    <ul class="leading-loose">
                        <li>Upto 5 Users</li>
                        <li>Max 100 Items</li>
                        <li>500 Queries To Database</li>
                        <li>Basic Statistics</li>
                        <li>Email Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
