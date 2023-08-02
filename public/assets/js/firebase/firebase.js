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

function startFCM() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function (response) {
            $.ajax({
                url: location.origin + '/auto-store-token',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    console.log('Token stored.');
                },
                error: function (error) {
                    console.log(error);
                },
            });
        }).catch(function (error) {
            console.log(error);
        });
}

messaging.onMessage(function (payload) {
    console.log(payload);
    jQuery(function($) {
        $("#notification-button").removeClass("btn-outline-primary");
        $("#notification-button").addClass("btn-danger");
        $('#notification_review').append('<div class="text-right mb-3">Thông báo mới nhất</div><div class="bs-toast toast fade show bg-primary mb-3" role="alert" aria-live="assertive" aria-atomic="true"><div class="toast-header"><i class="bx bx-bell me-2"></i><div class="me-auto fw-semibold">' + payload.notification.title + '</div><small>Vừa xong</small></div><div class="toast-body">' + payload.notification.body + '</div></div><hr>')
    });
});
