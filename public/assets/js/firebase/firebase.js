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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: location.origin + '/auto-store-token',
                type: 'POST',
                data: {
                    token: response
                },
                dataType: 'JSON',
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
    console.log(1);
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(title, options);
    console.log(payload.notification)

    // alert(title);
});
