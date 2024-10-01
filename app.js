document.addEventListener('DOMContentLoaded', function() {
    const addFieldButtons = document.querySelectorAll('.add-field');

    addFieldButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-target'));
            const newField = document.createElement('input');
            newField.type = 'text';
            newField.name = target.id + '[]';
            newField.placeholder = 'Añade más ' + target.id.replace('_', ' ');
            target.appendChild(newField);
        });
    });
});
