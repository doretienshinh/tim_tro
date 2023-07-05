 <!-- Core JS -->
 <!-- build:js assets/vendor/js/core.js -->
 <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
 <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
 <script src="{{ asset('assets/js/extended-ui-perfect-scrollbar.js') }}"></script>


 <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
 <!-- endbuild -->

 <!-- Vendors JS -->
 <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

 <!-- Main JS -->
 <script src="{{ asset('assets/js/main.js') }}"></script>

 <!-- Page JS -->
 <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
 <script src="{{ asset('assets/vendor/libs/elevatezoom/elevatezoom.js') }}"></script>
 {{-- <!-- Place this tag in your head or just before your close body tag. -->
 <script async defer src="https://buttons.github.io/buttons.js"></script> --}}
 <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>

 <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>
 <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
 <script type="text/javascript" src="{{ asset('assets/js/firebase/firebase.js') }}"></script>
 <script>
     // Gloabl Chatify variables from PHP to JS
     window.chatify = {
         name: "{{ config('chatify.name') }}",
         sounds: {!! json_encode(config('chatify.sounds')) !!},
         allowedImages: {!! json_encode(config('chatify.attachments.allowed_images')) !!},
         allowedFiles: {!! json_encode(config('chatify.attachments.allowed_files')) !!},
         maxUploadSize: {{ Chatify::getMaxUploadSize() }},
         pusher: {!! json_encode(config('chatify.pusher')) !!},
         pusherAuthEndpoint: '{{ route('pusher.auth') }}'
     };
     console.log(window.chatify);
     window.chatify.allAllowedExtensions = chatify.allowedImages.concat(chatify.allowedFiles);
 </script>
 <script>
     var auth_id = {{ Auth::user() ? Auth::user()->id : '' }};
     const pusher = new Pusher(chatify.pusher.key, {
         encrypted: chatify.pusher.options.encrypted,
         cluster: chatify.pusher.options.cluster,
         authEndpoint: chatify.pusherAuthEndpoint,
         auth: {
             headers: {
                 "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
             },
         },
     });

     const channelName = "private-chatify";
     var channel = pusher.subscribe(`${channelName}.${auth_id}`);

     channel.bind("messaging", function(data) {
         $('.noti-chat').removeClass('btn-outline-primary');
         $('.noti-chat').addClass('btn-danger');
     });
 </script>
 <script>
    @if (Auth::user() && !Auth::user()->device_key)
        startFCM();
    @endif
</script>
