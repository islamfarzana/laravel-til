function Carousel(options) {
    var element  = document.getElementById(options.elem || 'carousel'),
        interval = options.interval || 3000,

        btnPlayText = options.btnPlayText || 'Play',
        btnStopText = options.btnStopText || 'Stop',

        arrNextText = options.arrNextText || '&rsaquo;',
        arrPrevText = options.arrPrevText || '&lsaquo;',

        crslClass           = 'js-Carousel',
        crslArrowPrevClass  = 'js-Carousel-arrowPrev',
        crslArrowNextClass  = 'js-Carousel-arrowNext',
        crslDotsClass       = 'js-Carousel-dots',
        crslButtonStopClass = 'js-Carousel-btnStop',
        crslButtonPlayClass = 'js-Carousel-btnPlay',

        count   = element.querySelectorAll('li').length,
        current = 0,
        cycle   = null;

    if (count > 1) {
        render();
    }

    function render() {
        var actions = {
            dots: function() {
                return showDots();
            },
            arrows: function() {
                return showArrows();
            },
            buttons: function() {
                return showButtons();
            },
            autoplay: function() {
                return play();
            },
            infinite: function() {
                return moveItem(count - 1, -element.offsetWidth + 'px', 'afterBegin');
            },
            initial: function() {
                var initial = 0 || (options.initial >= count) ? count : options.initial;
                return show(initial);
            }
        };

        for (var key in actions) {
            if (options.hasOwnProperty(key) && options[key]) {
                actions[key]();
            }
        }
    }

    function moveItem(i, marginLeft, position) {
        var itemToMove = element.querySelectorAll('.' + crslClass + ' > ul li')[i];
        itemToMove.style.marginLeft = marginLeft;

        element.querySelector('.' + crslClass + ' > ul')
          .removeChild(itemToMove);

        element.querySelector('.' + crslClass + ' > ul')
          .insertAdjacentHTML(position, itemToMove.outerHTML);
    }

    function showDots() {
        var dotContainer = document.createElement('ul');
        dotContainer.classList.add(crslDotsClass);
        dotContainer.addEventListener('click', scrollToImage.bind(this));

        for (var i = 0; i < count; i++) {
            var dotElement = document.createElement('li');
            dotElement.setAttribute('data-position', i);

            dotContainer.appendChild(dotElement);
        }

        element.appendChild(dotContainer);
        currentDot();
    }


    function currentDot() {
        [].forEach.call(element.querySelectorAll('.' + crslDotsClass + ' li'), function(item) {
            item.classList.remove('is-active');
        });

        element.querySelectorAll('.' + crslDotsClass + ' li')[current].classList.add('is-active');
    }

    function scrollToImage(e) {
        if (e.target.tagName === 'LI') {
            show(e.target.getAttribute('data-position'));

            resetInterval();
        }
    }

    function showArrows() {
        var buttonPrev = document.createElement('button');
        buttonPrev.innerHTML = arrPrevText;
        buttonPrev.classList.add(crslArrowPrevClass);

        var buttonNext = document.createElement('button');
        buttonNext.innerHTML = arrNextText;
        buttonNext.classList.add(crslArrowNextClass);

        buttonPrev.addEventListener('click', showPrev);
        buttonNext.addEventListener('click', showNext);

        element.appendChild(buttonPrev);
        element.appendChild(buttonNext);
    }

    function showButtons() {
        var buttonPlay = document.createElement('button');
        buttonPlay.innerHTML = btnPlayText;
        buttonPlay.classList.add(crslButtonPlayClass);
        buttonPlay.addEventListener('click', play);

        var buttonStop = document.createElement('button');
        buttonStop.innerHTML = btnStopText;
        buttonStop.classList.add(crslButtonStopClass);
        buttonStop.addEventListener('click', stop);

        element.appendChild(buttonPlay);
        element.appendChild(buttonStop);
    }

    function animatePrev(item) {
        item.style.marginLeft = '';
    }

    function animateNext(item) {
        item.style.marginLeft = -element.offsetWidth + 'px';
    }

    function show(slide) {
        var delta = current - slide;

        if (delta < 0) {
            moveByDelta(-delta, showNext);
        } else {
            moveByDelta(delta, showPrev);
        }
    }

    function moveByDelta(delta, direction) {
        for (var i = 0; i < delta; i++) {
            direction();
        }
    }

    function showPrev() {
        if (options.infinite) {
            showPrevInfinite();
        } else {
            showPrevLinear();
        }

        resetInterval();
    }

    function showPrevInfinite() {
        animatePrev(element.querySelectorAll('.' + crslClass + ' > ul li')[0]);
        moveItem(count - 1, -element.offsetWidth + 'px', 'afterBegin');

        adjustCurrent(-1);
    }

    function showPrevLinear() {
        stop();
        if (current === 0) {
            return;
        }
        animatePrev(element.querySelectorAll('.' + crslClass + ' > ul li')[current - 1]);
        
        adjustCurrent(-1);
    }

    function showNext() {
        if (options.infinite) {
            showNextInfinite();
        } else {
            showNextLinear();
        }

        resetInterval();
    }

    function showNextInfinite() {
        animateNext(element.querySelectorAll('.' + crslClass + ' > ul li')[1]);
        moveItem(0, '', 'beforeEnd');

        adjustCurrent(1);
    }

    function showNextLinear() {
        if (current === count - 1) {
            stop();
            return;
        }
        animateNext(element.querySelectorAll('.' + crslClass + ' > ul li')[current]);

        adjustCurrent(1);
    }

    function adjustCurrent(val) {
        current += val;

        switch (current) {
            case -1:
                current = count - 1;
                break;
            case count:
                current = 0;
                break;
            default:
                current = current;
        }

        if (options.dots) {
            currentDot();
        }
    }

    function resetInterval() {
        if (cycle) {
            stop();
            play();
        }
    }

    function play() {
        if (cycle) {
            return;
        }
        cycle = setInterval(showNext.bind(this), interval);
    }

    function stop() {
        clearInterval(cycle);
        cycle = null;
    }

    function live() {
        return current;
    }

    return {
        'live': live,
        'show': show,
        'prev': showPrev,
        'next': showNext,
        'play': play,
        'stop': stop
    };
}