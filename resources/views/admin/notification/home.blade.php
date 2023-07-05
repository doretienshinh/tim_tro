@extends('admin.layouts.admin_layout');
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-3">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('send.web-notification') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Message Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="form-group">
                                <label>Message Body</label>
                                <textarea class="form-control" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Send Notification</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBAgrCOA5WHu5HgFFhhrd908vgae7dL6h0",
            authDomain: "laravel-notification-timtro.firebaseapp.com",
            projectId: "laravel-notification-timtro",
            storageBucket: "laravel-notification-timtro.appspot.com",
            messagingSenderId: "763594530872",
            appId: "1:763594530872:web:2be42053c9a32a6d9c86cd",
            measurementId: "G-NN1VZ03Z0T"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
            console.log(payload.notification)

            // alert(title);
        });
    </script>
@endsection
