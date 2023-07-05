// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    databaseURL: 'https://laravel-notification-timtro.firebaseio.com',
    apiKey: "AIzaSyBAgrCOA5WHu5HgFFhhrd908vgae7dL6h0",
    authDomain: "laravel-notification-timtro.firebaseapp.com",
    projectId: "laravel-notification-timtro",
    storageBucket: "laravel-notification-timtro.appspot.com",
    messagingSenderId: "763594530872",
    appId: "1:763594530872:web:2be42053c9a32a6d9c86cd",
    measurementId: "G-NN1VZ03Z0T"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});