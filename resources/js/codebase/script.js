/**
 * Closing modal.
 */
function closeModal() {
    const modals = document.querySelectorAll('.modal.show');
    modals.forEach(modal => {
        const modalInstance = bootstrap.Modal.getInstance(modal);
        if (modalInstance) {
            modalInstance.hide();
        }
    });
}

window.addEventListener('refresh', closeModal);

function cleanInputs() {
    const modals = document.querySelectorAll('.modal.show');
    modals.forEach(modal => {
        const inputs = modal.querySelectorAll('input');
        inputs.forEach(input => {
            input.value = '';
        });

        // const textareas = modal.querySelectorAll('textarea');
        // textareas.forEach(textarea => {
        //     textarea.value = '';
        // });
        //
        // const selects = modal.querySelectorAll('select');
        // selects.forEach(select => {
        //     select.selectedIndex = 0;
        // });
    });
}

window.addEventListener('created', cleanInputs);

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

window.addEventListener('unchecked', function (event) {
    const checkbox = document.getElementById(event.detail[0].id);

    if (checkbox) {
        checkbox.checked = false;
    }
});

window.addEventListener('checked', function (event) {
    const checkbox = document.getElementById(event.detail[0].id);

    if (checkbox) {
        checkbox.checked = true;
    }
});


