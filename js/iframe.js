document.addEventListener('DOMContentLoaded', function () {
    var projectButtons = document.querySelectorAll('.item-box__button');
    var mainContainer = document.querySelector('.container');

    projectButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            var projectLink = this.getAttribute('data-project-link');
            if (projectLink) {
                // Create an overlay for the iframe
                var overlay = document.createElement('div');
                overlay.className = 'iframe-overlay';

                // Create a close button
                var closeButton = document.createElement('button');
                closeButton.className = 'close-button';
                closeButton.textContent = 'Close';

                // Create an iframe
                var iframe = document.createElement('iframe');
                iframe.src = projectLink;
                iframe.style.width = '100%';
                iframe.style.height = '100%';
                iframe.style.border = 'none';
                iframe.sandbox = 'allow-same-origin allow-scripts allow-popups allow-forms';

                // Append the close button and iframe to the overlay
                overlay.appendChild(closeButton);
                overlay.appendChild(iframe);

                // Append the overlay to the main container
                mainContainer.appendChild(overlay);

                // Add event listener to close the overlay when the close button is clicked
                closeButton.addEventListener('click', function () {
                    mainContainer.removeChild(overlay);
                });

                // Add event listener to show a warning when the user right-clicks within the iframe
                iframe.contentWindow.addEventListener('contextmenu', function (e) {
                    e.preventDefault();
                    showContextMenuWarning(overlay);
                });
            }
        });
    });

    function showContextMenuWarning(overlay) {
        // Create a warning overlay
        var warningOverlay = document.createElement('div');
        warningOverlay.className = 'warning-overlay';
        warningOverlay.textContent = 'Right-clicking is disabled in this area.';

        // Append the warning overlay to the iframe overlay
        overlay.appendChild(warningOverlay);

        // Remove the warning overlay after a delay (e.g., 3 seconds)
        setTimeout(function () {
            overlay.removeChild(warningOverlay);
        }, 3000);
    }
});
