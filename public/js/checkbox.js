const checkbox = document.querySelector('#checkbox');
const button = document.querySelector('#btn1');
const text = document.querySelector('#text');

button.addEventListener("click", ($event) => {
    $event.preventDefault();
    $event.stopPropagation();
    const clone = checkbox.cloneNode(true);
    clone.hidden = false;
    const input = clone.querySelector('input[type="checkbox"]');
    input.value = text.value.toLowerCase();
    input.name = "ingredients[]";
    clone.querySelector('.form-check-label').textContent = text.value;
    checkbox.parentElement.append(clone);
});