// Home Page Interactive Features

document.addEventListener("DOMContentLoaded", function () {
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add("visible");
            }
        });
    }, observerOptions);

    // Add fade-in class to elements and observe them
    document
        .querySelectorAll(".news-card, .card, .position-relative")
        .forEach((el) => {
            el.classList.add("fade-in");
            observer.observe(el);
        });

    // Image lazy loading fallback
    document.querySelectorAll("img[data-src]").forEach((img) => {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const image = entry.target;
                    image.src = image.dataset.src;
                    image.classList.remove("loading-placeholder");
                    imageObserver.unobserve(image);
                }
            });
        });
        imageObserver.observe(img);
    });

    // Card hover effects
    document.querySelectorAll(".news-card, .card").forEach((card) => {
        card.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-8px)";
        });

        card.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0)";
        });
    });

    // Read more functionality
    document.querySelectorAll(".read-more-btn").forEach((btn) => {
        btn.addEventListener("click", function (e) {
            e.preventDefault();
            const content = this.previousElementSibling;
            const isExpanded = content.classList.contains("expanded");

            if (isExpanded) {
                content.classList.remove("expanded");
                this.textContent = "Read More";
            } else {
                content.classList.add("expanded");
                this.textContent = "Read Less";
            }
        });
    });
});

// Performance optimizations
window.addEventListener("load", function () {
    // Remove loading states
    document.querySelectorAll(".loading-placeholder").forEach((el) => {
        el.classList.remove("loading-placeholder");
    });
});
