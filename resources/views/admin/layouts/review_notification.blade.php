<div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScroll"
    aria-labelledby="offcanvasScrollLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasScrollLabel" class="offcanvas-title">Thông báo</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0" id="vertical-scroll">
        <p class="text-center" id="notification_review">
            @if (Auth::user())
                @foreach (Auth::user()->notifications->whereNotIn('read_status', ['read'])->sortByDesc('created_at') as $notification)
                    <div class="bs-toast toast fade show bg-primary mb-3" role="alert" aria-live="assertive"
                        aria-atomic="true">
                        <div class="toast-header">
                            <i class="bx bx-bell me-2"></i>
                            <div class="me-auto fw-semibold">{{ $notification->title }}</div>
                            <small>{!! \App\Helpers\Helper::calTimeNotifi($notification->created_at) !!}</small>
                            <button type="button" class="btn-close read-notifi" data-bs-dismiss="toast"
                                aria-label="Close" data-notification-id="{{ $notification->id }}"></button>
                        </div>
                        <div class="toast-body">
                            {{ $notification->content }}
                        </div>
                    </div>
                @endforeach
            @endif
        </p>
        {{-- <button type="button" class="btn btn-primary mb-2 d-grid w-100">Continue</button>
        <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
            Cancel
        </button> --}}
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        @if (Auth::user())
            $('.read-notifi').on('click', function() {
                var notificationId = $(this).data('notification-id');
                $.ajax({
                    url: '/notification/read/' + notificationId,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        console.log(res);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                })
            })
        @endif

        $('.read-notifi').click(function() {
            if ($('#notification_review').children().length == 0) {
                $("#notification-button").removeClass("btn-danger");
                $("#notification-button").addClass("btn-outline-primary");
            }
        });
    });
</script>
