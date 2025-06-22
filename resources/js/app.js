import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
class Carousel {
    constructor(container) {
        this.container = container;
        this.items = Array.from(container.querySelectorAll('.carousel-item'));
        this.indicatorsContainer = container.querySelector('.indicators');
        this.currentIndex = 0;
        this.autoPlayInterval = null;
        this.animationDuration = 500;

        this.init();
    }

    init() {
        // Создаем индикаторы
        this.items.forEach((_, index) => {
            const indicator = document.createElement('div');
            indicator.className = `indicator ${index === 0 ? 'active' : ''}`;
            indicator.addEventListener('click', () => this.goTo(index));
            this.indicatorsContainer.appendChild(indicator);
        });

        // Обработчики кнопок
        container.querySelector('.prev').addEventListener('click', () => this.prev());
        container.querySelector('.next').addEventListener('click', () => this.next());

        // Автопрокрутка
        this.startAutoPlay();
        
        // Пауза при наведении
        this.container.addEventListener('mouseenter', () => this.stopAutoPlay());
        this.container.addEventListener('mouseleave', () => this.startAutoPlay());
    }

    updateIndicators() {
        this.indicatorsContainer.querySelectorAll('.indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index === this.currentIndex);
        });
    }

    goTo(index) {
        if (index < 0) index = this.items.length - 1;
        if (index >= this.items.length) index = 0;

        this.items[this.currentIndex].classList.remove('active');
        this.currentIndex = index;
        this.items[this.currentIndex].classList.add('active');
        this.updateIndicators();
    }

    next() {
        this.goTo(this.currentIndex + 1);
    }

    prev() {
        this.goTo(this.currentIndex - 1);
    }

    startAutoPlay() {
        if (!this.autoPlayInterval) {
            this.autoPlayInterval = setInterval(() => this.next(), 5000);
        }
    }

    stopAutoPlay() {
        clearInterval(this.autoPlayInterval);
        this.autoPlayInterval = null;
    }
}

// Инициализация карусели
const container = document.querySelector('.carousel-container');
new Carousel(container);