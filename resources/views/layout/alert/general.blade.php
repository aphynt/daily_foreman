<style>
    .sims-swal-popup {
        width: 390px !important;
        max-width: calc(100vw - 32px) !important;
        padding: 32px 28px 26px !important;
        border-radius: 24px !important;
        border: 1px solid rgba(15, 23, 42, 0.06);
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow:
            0 30px 70px rgba(15, 23, 42, 0.16),
            0 10px 30px rgba(15, 23, 42, 0.08) !important;
    }

    .sims-swal-title {
        margin-top: 8px !important;
        margin-bottom: 8px !important;
        font-size: 22px !important;
        font-weight: 750 !important;
        letter-spacing: -0.4px !important;
        color: #0f172a !important;
    }

    .sims-swal-html {
        margin: 0 !important;
        font-size: 14px !important;
        line-height: 1.65 !important;
        color: #64748b !important;
    }

    .sims-swal-confirm {
        min-width: 130px !important;
        padding: 12px 22px !important;
        border: none !important;
        border-radius: 12px !important;
        background:
            linear-gradient(
                135deg,
                #001831 0%,
                #073c74 100%
            ) !important;
        color: #ffffff !important;
        font-size: 14px !important;
        font-weight: 650 !important;
        box-shadow: 0 10px 22px rgba(0, 24, 49, 0.20) !important;

        transition:
            transform .2s ease,
            box-shadow .2s ease !important;
    }

    .sims-swal-confirm:hover {
        transform: translateY(-1px);
        box-shadow:
            0 14px 28px rgba(0, 24, 49, 0.26) !important;
    }

    .sims-swal-confirm:focus {
        box-shadow:
            0 0 0 4px rgba(44, 123, 229, 0.15),
            0 10px 22px rgba(0, 24, 49, 0.20) !important;
    }

    .sims-swal-icon {
        border-width: 3px !important;
        transform: scale(.88);
    }

    .swal2-actions {
        margin-top: 24px !important;
    }

    #notifier {
        position: fixed;
        z-index: 99999;
        top: 24px;
        right: 24px;
        width: min(390px, calc(100vw - 32px));
        padding: 0;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-12px) translateX(10px);
        transition:
            opacity .35s ease,
            transform .35s ease,
            visibility .35s ease;
    }

    #notifier.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0) translateX(0);
    }

    #notifier.hide {
        opacity: 0;
        visibility: hidden;
        transform: translateY(-8px) translateX(8px);
    }

    .modern-notification {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 14px;
        padding: 17px 18px;
        overflow: hidden;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.98);
        border: 1px solid rgba(15, 23, 42, 0.07);
        box-shadow:
            0 22px 55px rgba(15, 23, 42, 0.14),
            0 5px 16px rgba(15, 23, 42, 0.06);

        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
    }

    .notification-icon {
        flex-shrink: 0;
        width: 42px;
        height: 42px;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 13px;
        background:
            linear-gradient(
                135deg,
                #dcfce7,
                #ecfdf5
            );
        color: #16a34a;
    }

    .notification-icon svg {
        width: 21px;
        height: 21px;
    }

    .notification-content {
        flex: 1;
        min-width: 0;
    }

    .notification-title {
        margin-bottom: 3px;

        color: #0f172a;

        font-size: 14px;
        font-weight: 700;
        line-height: 1.4;
    }

    #notification-message {
        color: #64748b;

        font-size: 13px;
        line-height: 1.55;

        word-break: break-word;
    }

    .notification-close {
        width: 28px;
        height: 28px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border: 0;
        border-radius: 8px;
        color: #94a3b8;
        background: transparent;
        cursor: pointer;
        transition:
            background .2s ease,
            color .2s ease;
    }

    .notification-close:hover {
        background: #f1f5f9;
        color: #334155;
    }

    .notification-close svg {
        width: 16px;
        height: 16px;
    }

    .notification-progress {
        position: absolute;
        left: 0;
        bottom: 0;
        width: 100%;
        height: 3px;
        transform-origin: left center;
        background:
            linear-gradient(
                90deg,
                #0f766e,
                #22c55e
            );
    }

    #notifier.show .notification-progress {
        animation: notificationProgress 3s linear forwards;
    }

    @keyframes notificationProgress {
        from {
            transform: scaleX(1);
        }

        to {
            transform: scaleX(0);
        }
    }

    @media (max-width: 576px) {

        #notifier {
            top: 14px;
            right: 16px;
            left: 16px;

            width: auto;
        }

        .modern-notification {
            padding: 15px;
            border-radius: 16px;
        }

        .notification-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
        }

        .sims-swal-popup {
            border-radius: 20px !important;
            padding: 28px 22px 22px !important;
        }

        .sims-swal-title {
            font-size: 20px !important;
        }
    }

</style>

<div id="notifier">
    <div class="modern-notification">
        <div class="notification-icon">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4.5 12.75l6 6 9-13.5"
                />
            </svg>
        </div>

        <div class="notification-content">
            <div class="notification-title">
                Berhasil
            </div>
            <div id="notification-message">
                Notification message
            </div>

        </div>
        <button
            type="button"
            class="notification-close"
            onclick="hideNotification()"
            aria-label="Tutup notifikasi"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="2"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>
        <div class="notification-progress"></div>
    </div>
</div>

<script>

    let notificationTimeout;
    function showNotification(message) {
        const notifier = document.getElementById('notifier');
        const notificationMessage = document.getElementById('notification-message');
        if (!notifier || !notificationMessage) {
            return;
        }
        clearTimeout(notificationTimeout);
        notificationMessage.innerText = message;
        notifier.classList.remove('hide');
        const progress = notifier.querySelector('.notification-progress');

        if (progress) {
            progress.style.animation = 'none';
            void progress.offsetWidth;
            progress.style.animation = '';
        }

        requestAnimationFrame(() => {
            notifier.classList.add('show');
        });

        notificationTimeout = setTimeout(() => {
            hideNotification();
        }, 3000);
    }

    function hideNotification() {
        const notifier =
            document.getElementById('notifier');
        if (!notifier) {
            return;
        }
        notifier.classList.remove('show');
        notifier.classList.add('hide');
        setTimeout(() => {
            notifier.classList.remove('hide');
        }, 400);
    }
</script>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            confirmButtonText: 'Oke',
            buttonsStyling: false,
            showClass: {
                popup: 'swal2-show'
            },
            hideClass: {
                popup: 'swal2-hide'
            },
            customClass: {
                popup: 'sims-swal-popup',
                title: 'sims-swal-title',
                htmlContainer: 'sims-swal-html',
                confirmButton: 'sims-swal-confirm',
                icon: 'sims-swal-icon'
            }
        });
    });
</script>
@endif

@if (session('info'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: @json(session('info')),
            confirmButtonText: 'Mengerti',
            buttonsStyling: false,
            customClass: {
                popup: 'sims-swal-popup',
                title: 'sims-swal-title',
                htmlContainer: 'sims-swal-html',
                confirmButton: 'sims-swal-confirm',
                icon: 'sims-swal-icon'
            }
        });
    });
</script>

@endif
@if (session('alert'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Selamat datang!',
            text: @json(Auth::user()->name),
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            backdrop: false,
            customClass: {
                popup: 'sims-toast',
                title: 'sims-toast-title',
                htmlContainer: 'sims-toast-text',
                timerProgressBar: 'sims-toast-progress'
            },

            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

    });
</script>
@endif
