@extends('admin.layout.master')
@section('meta')
<link rel="canonical" href="{{ route('admin.index') }}" />
@endsection
@section('style')
<style>
    /* Chat containers */
    .container {
        border: 2px solid #d8fff6;

        border-radius: 15px;

    }

    /* Darker chat container */
    .darker {
        border-color: #ccc;
        background-color: #ddd;
    }

    /* Clear floats */
    .container::after {
        content: "";
        clear: both;
        display: table;
    }

    /* Style images */
    .container img {
        float: left;
        max-width: 60px;
        width: 100%;
        margin-right: 20px;
        border-radius: 50%;
    }

    /* Style the right image */
    .container img.right {
        float: right;
        margin-left: 20px;
        margin-right: 0;
    }

    /* Style time text */
    .time-right {
        float: right;
        color: #aaa;
    }

    /* Style time text */
    .time-left {
        float: left;
        color: #999;
    }

    .container {
        display: flex;
        flex-flow: row;
    }

    .chat {
        position: fixed;
        left: 0px;
        bottom: 0px;
        height: 50px;
        width: 100%;
        background: #ffffff00;
        border-top: 2px solid #ffffff00;
    }

    #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    #myImg:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0.1)
        }

        to {
            transform: scale(1)
        }
    }

    /* The Close Button */
    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 100%;
        }
    }

    :root {
        --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        --msger-bg: #fff;
        --border: 2px solid #ddd;
        --left-msg-bg: #ececec;
        --right-msg-bg: #579ffb;
    }

    html {
        box-sizing: border-box;
    }

    *,
    *:before,
    *:after {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
    }


    body {
        background: #fff;
    }

    .msger {
        display: flex;
        flex-flow: column wrap;
        justify-content: space-between;
        width: 100%;
        max-width: 867px;
        margin: 47px 0px 50px 0px;
        max-height: 90vh;

        border-radius: 5px;
        background: #ffffec;
    }

    .msger-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: var(--border);
        background: #eee;
        color: #666;
    }

    .msger-chat {
        flex: 1;
        overflow-y: auto;
        margin: 5px;
    }

    .msger-chat::-webkit-scrollbar {
        width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
        background: #ddd;
    }

    .msger-chat::-webkit-scrollbar-thumb {
        background: #bdbdbd;
    }

    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 2px;
    }

    .msg:last-of-type {
        margin: 0;
    }

    .msg-img {
        width: 46px;
        height: 46px;
        margin-right: 10px;
        background: #ddd;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }

    .msg-bubble {
        max-width: 70%;
        padding: 10px;
        border-radius: 5px;
        background: #ffffff;
        color: #2f2f2f;
    }

    .msg-text {
        font-size: 14px;
    }

    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;

    }

    .msg-info-name {
        margin-right: 10px;
        font-weight: bold;
        font-size: 10px;
    }

    .msg-info-time {
        font-size: 0.85em;
    }

    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
    }

    .right-msg {
        flex-direction: row-reverse;
    }

    .right-msg .msg-bubble {
        background: #008f8f;
        color: #fff;
        border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }

    .msger-inputarea {
        display: flex;
        padding: 10px;
        border-top: var(--border);
        background: #eee;
    }

    .msger-inputarea * {
        padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 1em;
    }

    .msger-input {
        flex: 1;
        background: #ddd;
    }

    .msger-send-btn {
        margin-left: 10px;
        background: rgb(0, 196, 65);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.23s;
    }

    .msger-send-btn:hover {
        background: rgb(0, 180, 50);
    }

    .notify {
        position: fixed;
        top: 40px;
        background: #cd1307;
        color: #fff;
        z-index: 9999;
        margin: 20px;
        width: 89%;
        padding: 8px;
        border-radius: 10px;
        opacity: 0;
        transform: translateY(-20px);
        animation: slideFadeIn 0.6s ease forwards;
        display: none;
        font-size: 20px;
    }

    @keyframes slideFadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection
@section('main')
<div class="app-header st1">
    <div class="tf-container">
        <div class="tf-topbar d-flex justify-content-center align-items-center">
            <a href="{{ route('admin.index') }}" class="back-btn"><i class="icon-left white_color"></i></a>
            <h3 class="white_color">গ্রুপ চ্যাট</h3>
        </div>
    </div>
</div>

<div class="development-section d-flex justify-content-center align-items-center" style="height: 100vh; text-align: center;">
    <div class="development-content">
        <h1 class="development-header" style="margin-top:50%; font-size: 20px; color: #333;">এই ফিচারটি উন্নয়নাধীন</h1>
    </div>
</div>

@endsection


@section('script')
<script>
    function openModal(src) {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        modal.style.display = 'block';
        modalImg.src = src;
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
    }
</script>
<script>
    fetchNotification();
    async function fetchNotification() {
        try {
            const response = await fetch('/get-random-notification');
            const data = await response.json();
            if (data.message) {
                $('.notify').show();
                const now = new Date();
                const time = now.toLocaleTimeString([], {
                    hour: '2-digit',
                    minute: '2-digit'
                });
                $('.notify').html(data.message + ' | ' + time);
                setInterval(() => {
                    $('.notify').fadeOut(1000)
                }, 20000)
            }
        } catch (err) {
            console.error('Failed to fetch notification:', err);
        }
    }
    setInterval(fetchNotification, 22000);
</script>
<script>
    const chatBox = document.querySelector('.msger-chat');

    if (chatBox) {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    window.addEventListener('messageSent', event => {
        const chatBox = document.querySelector('.msger-chat');

        if (chatBox) {
            chatBox.scrollTop = chatBox.scrollHeight;
        }
    });
</script>
@endsection
