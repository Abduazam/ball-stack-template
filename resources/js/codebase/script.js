$(document).ready(function() {
    /**
     * Closing modal.
     */
    function closeModal() {
        $(".modal:visible").modal("hide");
    }

    window.addEventListener('refresh', closeModal);

    /**
     * Showing bootstrap dialog listener.
     */
    function showErrorFlash(event) {
        let successFlash = document.getElementById('error-flash-message');
        let flashText = successFlash.querySelector('#error-flash-text');

        flashText.innerHTML = event.detail[0].message;

        successFlash.style.transform = "translateY(0)";

        setTimeout(function() {
            successFlash.style.transform = "translateY(-100%)";
        }, 3000);
    }

    window.addEventListener('dispatch-error', showErrorFlash);

    /**
     * Showing bootstrap dialog listener.
     */
    function showSuccessFlash(event) {
        let successFlash = document.getElementById('success-flash-message');
        let flashText = successFlash.querySelector('#success-flash-text');

        flashText.innerHTML = event.detail[0].message;

        successFlash.style.transform = "translateY(0)";

        setTimeout(function() {
            successFlash.style.transform = "translateY(-100%)";
        }, 3000);
    }

    window.addEventListener('dispatch-success', showSuccessFlash);

    /**
     * Refreshing page listener.
     */
    window.addEventListener('refresh-page', function () {
        location.reload();
    });
});