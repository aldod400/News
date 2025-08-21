
document.addEventListener('DOMContentLoaded', function() {
    const scrollContainer = document.querySelector('.scroll-content');
    const leftButton = document.getElementById('scrollLeft');
    const rightButton = document.getElementById('scrollRight');
    
    if (leftButton && rightButton && scrollContainer) {
        leftButton.addEventListener('click', function() {
            scrollContainer.scrollBy({
                left: -150,
                behavior: 'smooth'
            });
        });

        rightButton.addEventListener('click', function() {
            scrollContainer.scrollBy({
                left: 150,
                behavior: 'smooth'
            });
        });
        
        // إضافة CSS للتأكد من أن الـ scroll يعمل
        scrollContainer.style.overflowX = 'hidden';
        scrollContainer.style.scrollBehavior = 'smooth';
    }
    
    updateVisibleItems();
});

window.addEventListener('resize', function() {
    updateVisibleItems();
});

function updateVisibleItems() {
    const width = window.innerWidth;
    const scrollButtons = document.querySelectorAll('.scroll-button');
    const scrollContainer = document.querySelector('.scroll-content');
    
    if (width <= 1200) {
        // إخفاء أزرار التمرير على الشاشات الصغيرة
        scrollButtons.forEach(button => {
            button.classList.add('d-none');
        });
        if (scrollContainer) {
            scrollContainer.style.overflowX = 'auto';
        }
    } else {
        // إظهار أزرار التمرير على الشاشات الكبيرة
        scrollButtons.forEach(button => {
            button.classList.remove('d-none');
        });
        if (scrollContainer) {
            scrollContainer.style.overflowX = 'hidden';
        }
    }
}
