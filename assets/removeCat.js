const deleteCatBtns = document.getElementsByClassName('deleteCatBtn');


for(const deleteCatBtn of deleteCatBtns) {
    deleteCatBtn.addEventListener('click', function (event) {
        event.preventDefault();

        fetch(deleteCatBtn.getAttribute('href'))
            .then(response => {
                if (response.status === 200) {

                    const flashMessage = document.createElement('div');
                    flashMessage.classList.add('alert', 'alert-success', 'flash-message');
                    flashMessage.textContent = "Cat profile successfully removed";
                    
                    flashMessage.setAttribute('role', 'alert');
                    
                    document.querySelector('.container').appendChild(flashMessage);
                    

                    setTimeout(() => {
                        flashMessage.remove();
                    }, 2500);


                } else {
                    alert("Erreur");
                }
            })
        ;
    });
}