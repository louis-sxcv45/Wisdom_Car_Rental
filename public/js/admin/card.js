document.querySelectorAll('.checkbox-container').forEach(function(container) {
    container.addEventListener('click', function(event) {
        if (event.target.tagName !== 'BUTTON' && event.target.tagName !== 'FORM' && event.target.tagName !== 'INPUT') {
            const checkbox = container.querySelector('.card-checkbox');
            checkbox.checked = !checkbox.checked;
            container.classList.toggle('selected', checkbox.checked);
        }
    });
});