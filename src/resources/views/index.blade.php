<script>
    var interval;
    var iconUrl = '{{ asset("IMAGEPATH") }}';
    var iconPath = "{{ config("session-timer.icon.path") }}";
    var cookieName = "{{ config("session-timer.cookie_name") }}";
    var logoutPath = "{{ config("session-timer.logout_path") }}";
    var assertPath = "{{ config("session-timer.icon.assert") }}";
    var available = "{{ config("session-timer.icon.available") }}";
    var submitBtn = "{{ config("session-timer.texts.submit_button") }}";
    var cancelBtn = "{{ config("session-timer.texts.cancel_button") }}";
    var mainMessage = "{{ config("session-timer.texts.main_message") }}";
    var sessionLifeTime = parseFloat("{{ config("session-timer.session_lifetime") }}");
    var sessionSkipTime = parseFloat("{{ config("session-timer.session_skip_time") }}");
    var sessionExpireTime = parseFloat("{{ config("session-timer.session_expire_time") }}");

    /** Get Cookie Expire time */
    var sessionCookieExpireDate = ((1 / 24) / 60) * sessionSkipTime;

    /**
     * For Idle Timeout
     */
    function setIdle() {
        $(document).idle({
            onIdle: function () {
                swal(mainMessage, {
                    buttons: {
                        cancel: cancelBtn,
                        wait: {
                            text: submitBtn,
                            value: "wait"
                        },
                    },
                    closeOnClickOutside: false,
                    timer: sessionExpireTime * 60 * 1000,
                    icon: available ? (assertPath ? iconUrl.replace('IMAGEPATH', iconPath) : iconPath) : null,
                }).then((value) => {
                    if (value === "wait") {
                        Cookies.set(cookieName, new Date(), {expires: sessionCookieExpireDate});
                        $(document).trigger("idle:stop");
                        startTime();
                    } else {
                        window.location.replace(logoutPath);
                    }
                });
            },
            idle: sessionLifeTime * 60 * 1000
        });
    }

    /**
     * Set timeout for checking skip time
     */
    function startTime() {
        var waitTime = Cookies.get(cookieName);
        if (!waitTime) setIdle();
        interval = setInterval(function () {
            startTime();
        }, sessionSkipTime * 60 * 1000);
    }

    /**
     * Initiate Session timer
     */
    startTime();
</script>