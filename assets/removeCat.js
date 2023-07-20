const deleteIdeaBtns = document.getElementsByClassName('deleteCatBtn');

for (const deleteIdeaBtn of deleteIdeaBtns) {
    deleteIdeaBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent default behavior of the anchor tag

        fetch(deleteIdeaBtn.getAttribute('href'))
            .then(response => {
                if (response.status === 200) {
                    // Find the parent element of the cat (the col-lg-4 div)
                    const catElement = deleteIdeaBtn.closest('.cat-card');

                    // Create a success message element
                    const flashMessage = document.createElement('div');
                    flashMessage.classList.add('alert', 'alert-success', 'flash-message');
                    flashMessage.textContent = "L'idée a bien été supprimée.";
                    flashMessage.setAttribute('role', 'alert');

                    // Insert the success message before the parent element (catElement)
                    catElement.before(flashMessage);

                    // Remove the cat element from the DOM
                    catElement.remove();

                    // Optional: Scroll to the success message so the user can see it
                    flashMessage.scrollIntoView();

                    // Remove the success message after 2500 milliseconds (2.5 seconds)
                    setTimeout(() => {
                        flashMessage.remove();
                    }, 2500);
                } else {
                    alert("Erreur");
                }
            });
    });
}