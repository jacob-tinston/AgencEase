<!-- Alerts -->
<div class="fixed bottom-5 right-5">
    @if(session('success'))
        <div class="alert alert_success w-fit pr-12 mt-4">
            <strong class="uppercase"><bdi>Success!</bdi></strong>
            {!! session('success') !!}
            <button class="dismiss la la-times" data-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert_danger w-fit pr-12 mt-4">
            <strong class="uppercase"><bdi>Error!</bdi></strong>
            {!! session('error') !!}
            <button class="dismiss la la-times" data-dismiss="alert"></button>
        </div>
    @endif
</div>
