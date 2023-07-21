const deleteCatBtns = document.getElementsByClassName('deleteCatBtn');

for (const deleteCatBtn of deleteCatBtns) {
    deleteCatBtn.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(deleteCatBtn.getAttribute('href'))
            .then(response => {
                if (response.status === 200) {
                    // Assuming you have a common parent for .cat-card elements,
                    // you can remove the .cat-card containing the deleted cat
                    deleteCatBtn.closest('.cat-card').remove();

                    // Display a flash message after successful deletion
                    const flashMessage = document.createElement('div');
                    flashMessage.classList.add('alert', 'alert-success', 'flash-message');
                    flashMessage.textContent = "Your cat's profile has been deleted!";
                    flashMessage.setAttribute('role', 'alert');
                    document.querySelector('.container').appendChild(flashMessage);

                    setTimeout(() => {
                        flashMessage.remove();
                    }, 2500);
                } else {
                    alert("Error");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Error occurred while processing the request.");
            });
    });
}