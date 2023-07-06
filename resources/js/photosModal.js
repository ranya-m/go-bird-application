const openPhotosModalButton = document.getElementById('open-photos-modal');
const closePhotosModalButton = document.getElementById('close-photos-modal');
const photosModal = document.getElementById('photos-modal');

// Function to show the modal and disable scrolling
function showAllPhotos() {
    photosModal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Function to close the modal and enable scrolling
function closeAllPhotos() {
    photosModal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

export {openPhotosModalButton, closePhotosModalButton, photosModal, showAllPhotos, closeAllPhotos};

