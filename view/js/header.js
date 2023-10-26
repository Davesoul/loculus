
document.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const workshop = document.getElementById('space');
    const loculus = document.getElementById('loculus');
    const searchBar = document.getElementById("bar");

    function handleMenuClick(event) {
        const clickedElement = event.target;
        const buttonElement = clickedElement.closest('.btn');

        if (buttonElement) {
            closeOtherMenus(buttonElement);

            const menu = buttonElement.querySelector('.objects');
            const container = buttonElement.querySelector('.objects > .popup-container');
            
            adjustMenuPosition(buttonElement, menu);
            
            buttonElement.classList.toggle('active');
            menu.classList.toggle('active');
            container.classList.toggle('active');
        }
    }

    function closeOtherMenus(currentButton) {
        const buttons = document.querySelectorAll('.btn');
        
        buttons.forEach(button => {
            if (button != currentButton && !button.contains(currentButton)) {
                button.classList.remove('active');
                const prevMenu = button.querySelector('.objects');
                const prevContainer = button.querySelector('.objects > .popup-container');
                prevMenu.classList.remove('active');
                prevContainer.classList.remove('active');
            }
        });
    }

    function adjustMenuPosition(buttonElement, menu) {
        const menuRect = menu.getBoundingClientRect();
        const viewport = window.innerWidth;

        if (menuRect.x + menuRect.right >= viewport) {
            menu.style.right = "10px";
            
            if (menuRect.x < 0) {
                menu.style.left = "10px";
            }
        }
    }

    header.addEventListener("click", handleMenuClick);



    // Get the required elements
    const wp = document.querySelector('#workshop');
    const wpmenu = wp.querySelector('.popup-container');

    // Add a click event listener to the workshop menu
    wp.addEventListener('click', () => {
        // Clear the workshop menu
        wpmenu.innerHTML = '';

        // Get all workshop items
        const workshopItems = workshop.querySelectorAll('.obj');

        // Loop through workshop items and add their names to the menu
        workshopItems.forEach(item => {
            const frameTitle = item.querySelector('h6').textContent;
            
            const listItem = document.createElement('li');
            const link = document.createElement('a');
            link.href = '#space';
            link.textContent = frameTitle;

            listItem.appendChild(link);
            wpmenu.appendChild(listItem);

            // Add a click event listener to scroll and focus on the selected item
            link.addEventListener('click', () => {
                const loculusHeight = workshop.style.height;
                const bound = item.getBoundingClientRect();
                const scrollTop = item.offsetTop - 100;

                // Reset z-index and border for all items
                workshopItems.forEach(w => {
                    w.style.zIndex = '1';
                    w.style.border = 'solid 2px rgba(0,0,0,0)';
                });

                // Scroll to the selected item smoothly
                workshop.scrollTo({
                    top: scrollTop,
                    behavior: "smooth"
                });

                // Highlight the selected item
                item.style.zIndex = '5';
                item.style.border = 'solid 2px var(--secondarycolor)';
            });
        });

        // If the menu is empty, display a message
        if (!wpmenu.hasChildNodes()) {
            wpmenu.innerHTML = "Empty Workshop";
        }
    });



    // Additional functions and event listeners can be added here

    // Open search bar on screens narrower than 765 pixels
const btns = document.querySelectorAll('.btn');
const searchContainer = document.getElementById('searchcontainer');
const searchButton = document.getElementById('searchbtn');

const searchButtonElement = searchButton.closest('#searchbtn');

if (searchButtonElement) {
    searchButtonElement.addEventListener('click', () => {
        searchContainer.classList.toggle('on');
        if (searchContainer.classList.contains('on')) {
            searchBar.focus();
        } else {
            searchBar.value = '';
        }

        btns.forEach(btn => btn.classList.toggle('off'));

        window.onclick = function(event) {
            if (event.target != searchContainer && event.target != searchButton && event.target != searchBar) {
                searchContainer.classList.remove('on');
                btns.forEach(btn => btn.classList.remove('off'));
                searchBar.value = '';
            }
        };
    });

    // Prevent the search bar form from submitting
    const searchForm = document.getElementById('sForm');

    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        // Add your code for handling the search here
    });
}

});
