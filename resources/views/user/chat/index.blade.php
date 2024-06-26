@extends('user.layouts.user_layout')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/chat.css') }}" />
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="app-chat overflow-hidden card">
            <div class="row g-0">

                <!-- Chat & Contacts -->
                <div class="col app-chat-contacts app-sidebar flex-grow-0 overflow-hidden border-end"
                    id="app-chat-contacts">
                    <div class="sidebar-header pt-3 px-3 mx-1">
                        <div class="d-flex align-items-center me-3 me-lg-0">
                            <div class="flex-shrink-0 avatar avatar-online me-2" data-bs-toggle="sidebar"
                                data-overlay="app-overlay-ex" data-target="#app-chat-sidebar-left">
                                <img class="user-avatar rounded-circle cursor-pointer" src="{{ asset('assets/img/avatars/default.png') }}"
                                    alt="Avatar">
                            </div>
                            <div class="flex-grow-1 input-group input-group-merge rounded-pill ms-1">
                                <span class="input-group-text" id="basic-addon-search31"><i
                                        class="bx bx-search fs-4"></i></span>
                                <input type="text" class="form-control chat-search-input" placeholder="Search..."
                                    aria-label="Search..." aria-describedby="basic-addon-search31">
                            </div>
                        </div>
                        <i class="bx bx-x cursor-pointer position-absolute top-0 end-0 mt-2 me-1 fs-4 d-lg-none d-block"
                            data-overlay data-bs-toggle="sidebar" data-target="#app-chat-contacts"></i>
                    </div>
                    <hr class="container-m-nx mt-3 mb-0">
                    <div class="sidebar-body">

                        <!-- Chats -->
                        <ul class="list-unstyled chat-contact-list pt-1" id="chat-list">
                            <li class="chat-contact-list-item chat-contact-list-item-title">
                                <h5 class="text-primary mb-0">Chats</h5>
                            </li>
                            <li class="chat-contact-list-item chat-list-item-0 d-none">
                                <h6 class="text-muted mb-0">No Chats Found</h6>
                            </li>
                            <li class="chat-contact-list-item">
                                <a class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="chat-contact-name text-truncate m-0">Waldemar Mannering</h6>
                                        <p class="chat-contact-status text-truncate mb-0 text-muted">Refer friends. Get
                                            rewards.</p>
                                    </div>
                                    <small class="text-muted mb-auto">5 Minutes</small>
                                </a>
                            </li>
                            <li class="chat-contact-list-item active">
                                <a class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar avatar-offline">
                                        <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="chat-contact-name text-truncate m-0">Felecia Rower</h6>
                                        <p class="chat-contact-status text-truncate mb-0 text-muted">I will purchase it for
                                            sure. 👍</p>
                                    </div>
                                    <small class="text-muted mb-auto">30 Minutes</small>
                                </a>
                            </li>
                            <li class="chat-contact-list-item">
                                <a class="d-flex align-items-center">
                                    <div class="flex-shrink-0 avatar avatar-busy">
                                        <span class="avatar-initial rounded-circle bg-label-success">CM</span>
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="chat-contact-name text-truncate m-0">Calvin Moore</h6>
                                        <p class="chat-contact-status text-truncate mb-0 text-muted">If it takes long you
                                            can mail inbox user</p>
                                    </div>
                                    <small class="text-muted mb-auto">1 Day</small>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Chat contacts -->

                <!-- Chat History -->
                <div class="col app-chat-history">
                    <div class="chat-history-wrapper">
                        <div class="chat-history-header border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex overflow-hidden align-items-center">
                                    <i class="bx bx-menu bx-sm cursor-pointer d-lg-none d-block me-2"
                                        data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                    <div class="flex-shrink-0 avatar">
                                        <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar" class="rounded-circle"
                                            data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right">
                                    </div>
                                    <div class="chat-contact-info flex-grow-1 ms-3">
                                        <h6 class="m-0">Felecia Rower</h6>
                                        <small class="user-status text-muted">NextJS developer</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="dropdown">
                                        <i class="bx bx-dots-vertical-rounded cursor-pointer fs-4"
                                            id="chat-header-actions" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        </i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="chat-header-actions">
                                            <a class="dropdown-item" href="javascript:void(0);">View Contact</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Clear Chat</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Report</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-history-body">
                            <ul class="list-unstyled chat-history mb-0">
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">How can we help? We're here for you! 😄</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <i class='bx bx-check-double text-success'></i>
                                                <small>10:00 AM</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Hey John, I am looking for the best admin template.</p>
                                                <p class="mb-0">Could you please help me to find it out? 🤔</p>
                                            </div>
                                            <div class="chat-message-text mt-2">
                                                <p class="mb-0">It should be Bootstrap 5 compatible.</p>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small>10:02 AM</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Sneat has all the components you'll ever need in a app.
                                                </p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <i class='bx bx-check-double text-success'></i>
                                                <small>10:03 AM</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Looks clean and fresh UI. 😃</p>
                                            </div>
                                            <div class="chat-message-text mt-2">
                                                <p class="mb-0">It's perfect for my next project.</p>
                                            </div>
                                            <div class="chat-message-text mt-2">
                                                <p class="mb-0">How can I purchase it?</p>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small>10:05 AM</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Thanks, you can purchase it.</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <i class='bx bx-check-double text-success'></i>
                                                <small>10:06 AM</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">I will purchase it for sure. 👍</p>
                                            </div>
                                            <div class="chat-message-text mt-2">
                                                <p class="mb-0">Thanks.</p>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small>10:08 AM</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Great, Feel free to get in touch.</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <i class='bx bx-check-double text-success'></i>
                                                <small>10:10 AM</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message">
                                    <div class="d-flex overflow-hidden">
                                        <div class="user-avatar flex-shrink-0 me-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                        <div class="chat-message-wrapper flex-grow-1">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Do you have design files for Sneat</p>
                                            </div>
                                            <div class="text-muted mt-1">
                                                <small>10:15 AM</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="chat-message chat-message-right">
                                    <div class="d-flex overflow-hidden">
                                        <div class="chat-message-wrapper flex-grow-1 w-50">
                                            <div class="chat-message-text">
                                                <p class="mb-0">Yes that's correct documentation file, Design files are
                                                    included with the template.</p>
                                            </div>
                                            <div class="text-end text-muted mt-1">
                                                <i class='bx bx-check-double'></i>
                                                <small>10:15 AM</small>
                                            </div>
                                        </div>
                                        <div class="user-avatar flex-shrink-0 ms-3">
                                            <div class="avatar avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- Chat message form -->
                        <div class="chat-history-footer">
                            <form class="form-send-message d-flex justify-content-between align-items-center mb-0">
                                <input class="form-control message-input border-0 me-3 shadow-none"
                                    placeholder="Type your message here...">
                                <div class="message-actions d-flex align-items-center">
                                    <label for="attach-doc" class="form-label mb-0">
                                        <i class="bx bx-paperclip bx-sm cursor-pointer mx-3"></i>
                                        <input type="file" id="attach-doc" hidden>
                                    </label>
                                    <button class="btn btn-primary d-flex send-msg-btn">
                                        <i class="bx bx-paper-plane me-md-1 me-0"></i>
                                        <span class="align-middle d-md-inline-block d-none">Send</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Chat History -->

                <!-- Sidebar Right -->
                <div class="col app-chat-sidebar-right app-sidebar overflow-hidden" id="app-chat-sidebar-right">
                    <div
                        class="sidebar-header d-flex flex-column justify-content-center align-items-center flex-wrap p-4 mt-2">
                        <div class="avatar avatar-xl avatar-online">
                            <img src="{{ asset('assets/img/avatars/default.png') }}" alt="Avatar" class="rounded-circle">
                        </div>
                        <h6 class="mt-3 mb-1">Felecia Rower</h6>
                        <small class="text-muted">NextJS Developer</small>
                        <i class="bx bx-x bx-sm cursor-pointer close-sidebar me-1 fs-4 d-block" data-bs-toggle="sidebar"
                            data-overlay data-target="#app-chat-sidebar-right"></i>
                    </div>
                    <div class="sidebar-body px-4 pb-4">
                        <div class="my-3">
                            <span class="text-muted text-uppercase">About</span>
                            <p class="mb-0 mt-2">A Next. js developer is a software developer who uses the Next. js
                                framework alongside ReactJS to build web applications.</p>
                        </div>
                        <div class="my-4">
                            <span class="text-muted text-uppercase">Personal Information</span>
                            <ul class="list-unstyled d-grid gap-2 mt-2">
                                <li class="d-flex align-items-center">
                                    <i class='bx bx-envelope'></i>
                                    <span class="align-middle ms-2">josephGreen@email.com</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class='bx bx-phone-call'></i>
                                    <span class="align-middle ms-2">+1(123) 456 - 7890</span>
                                </li>
                                <li class="d-flex align-items-center">
                                    <i class='bx bx-time-five'></i>
                                    <span class="align-middle ms-2">Mon - Fri 10AM - 8PM</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-4">
                            <span class="text-muted text-uppercase">Options</span>
                            <ul class="list-unstyled d-grid gap-2 mt-2">
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='bx bx-bookmark'></i>
                                    <span class="align-middle ms-2">Add Tag</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='bx bx-star'></i>
                                    <span class="align-middle ms-2">Important Contact</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='bx bx-image-alt'></i>
                                    <span class="align-middle ms-2">Shared Media</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='bx bx-trash-alt'></i>
                                    <span class="align-middle ms-2">Delete Contact</span>
                                </li>
                                <li class="cursor-pointer d-flex align-items-center">
                                    <i class='bx bx-block'></i>
                                    <span class="align-middle ms-2">Block Contact</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /Sidebar Right -->

                <div class="app-overlay"></div>
            </div>
        </div>



    </div>
@endsection
<script type="text/javascript" src="{{ asset('assets/js/chat/chat.js') }}"></script>
