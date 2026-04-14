import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';

gsap.registerPlugin(ScrollTrigger, ScrollToPlugin);

const HERO_SELECTOR = '[data-wave-hero]';
const STAGE_SELECTOR = '[data-wave-stage]';
const CANVAS_SELECTOR = '[data-wave-canvas]';
const TEXT_SELECTOR = '[data-wave-text]';
const TITLE_MAIN_SELECTOR = '[data-wave-title-main]';
const TITLE_ACCENT_SELECTOR = '[data-wave-title-accent]';
const SECTION_LINK_SELECTOR = '[data-scroll-link]';
const HASH_LINK_SELECTOR = 'a[href^="#"]';
const SIDEBAR_CLOSE_SELECTOR = '[data-sidebar-close]';

const TOTAL_FRAMES = 150;
const FRAMES_BASE_PATH = '/somosdevs/animacao';
const FRAME_COMPLETE_AT_SCROLL = 0.94;

const clamp = (value, min, max) => Math.min(max, Math.max(min, value));

const createFrameUrl = (index) => {
    return `${FRAMES_BASE_PATH}/img${String(index + 1).padStart(3, '0')}.jpg`;
};

const splitToAnimatedChars = (element) => {
    if (!element) {
        return [];
    }

    if (element.dataset.waveCharsSplit === 'true') {
        return Array.from(element.querySelectorAll('[data-wave-char]'));
    }

    const text = element.textContent || '';
    const fragment = document.createDocumentFragment();
    const chars = [];

    element.setAttribute('aria-label', text.trim());
    element.setAttribute('role', 'text');

    const tokens = text.split(/(\s+)/);

    tokens.forEach((token) => {
        if (!token) {
            return;
        }

        if (/^\s+$/.test(token)) {
            fragment.appendChild(document.createTextNode(token));
            return;
        }

        const wordSpan = document.createElement('span');

        wordSpan.className = 'inline-flex whitespace-nowrap align-baseline';
        wordSpan.setAttribute('aria-hidden', 'true');

        Array.from(token).forEach((char) => {
            const charSpan = document.createElement('span');

            charSpan.dataset.waveChar = 'true';
            charSpan.className = 'inline-block';
            charSpan.setAttribute('aria-hidden', 'true');
            charSpan.textContent = char;
            wordSpan.appendChild(charSpan);
            chars.push(charSpan);
        });

        fragment.appendChild(wordSpan);
    });

    element.textContent = '';
    element.appendChild(fragment);
    element.dataset.waveCharsSplit = 'true';

    return chars;
};

const initWaveHeroAnimation = () => {
    const hero = document.querySelector(HERO_SELECTOR);

    if (!hero || hero.dataset.waveHeroInitialized === 'true') {
        return;
    }

    hero.dataset.waveHeroInitialized = 'true';

    const stage = hero.querySelector(STAGE_SELECTOR);
    const canvas = hero.querySelector(CANVAS_SELECTOR);
    const textLayer = hero.querySelector(TEXT_SELECTOR);
    const titleMain = hero.querySelector(TITLE_MAIN_SELECTOR);
    const titleAccent = hero.querySelector(TITLE_ACCENT_SELECTOR);

    if (!stage || !canvas || !textLayer || !titleMain || !titleAccent) {
        return;
    }

    const context = canvas.getContext('2d', {
        alpha: false,
        desynchronized: true,
    });

    if (!context) {
        return;
    }

    const isMobile = window.matchMedia('(max-width: 767px)').matches;
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const dprLimit = isMobile ? 1.5 : 2;

    const frameUrls = Array.from({ length: TOTAL_FRAMES }, (_, index) => createFrameUrl(index));
    const loadedFrames = new Array(TOTAL_FRAMES);

    const frameState = {
        progress: 0,
    };

    let drawnFrameIndex = -1;
    let preloadIndex = 0;
    let drawRaf = 0;
    let resizeRaf = 0;

    const getClosestLoadedFrame = (targetIndex) => {
        if (loadedFrames[targetIndex]) {
            return loadedFrames[targetIndex];
        }

        for (let offset = 1; offset < TOTAL_FRAMES; offset += 1) {
            const backward = targetIndex - offset;
            const forward = targetIndex + offset;

            if (backward >= 0 && loadedFrames[backward]) {
                return loadedFrames[backward];
            }

            if (forward < TOTAL_FRAMES && loadedFrames[forward]) {
                return loadedFrames[forward];
            }
        }

        return null;
    };

    const drawImageCover = (image) => {
        const canvasWidth = canvas.width;
        const canvasHeight = canvas.height;
        const imageWidth = image.naturalWidth || image.width;
        const imageHeight = image.naturalHeight || image.height;

        context.fillStyle = '#070d19';
        context.fillRect(0, 0, canvasWidth, canvasHeight);

        if (!imageWidth || !imageHeight) {
            return;
        }

        const scale = Math.max(canvasWidth / imageWidth, canvasHeight / imageHeight);
        const drawWidth = imageWidth * scale;
        const drawHeight = imageHeight * scale;
        const offsetX = (canvasWidth - drawWidth) / 2;
        const offsetY = (canvasHeight - drawHeight) / 2;

        context.drawImage(image, offsetX, offsetY, drawWidth, drawHeight);
    };

    const drawFrameAtProgress = (progress) => {
        const clampedProgress = clamp(progress, 0, 1);
        const frameIndex = Math.round(clampedProgress * (TOTAL_FRAMES - 1));

        if (frameIndex === drawnFrameIndex) {
            return;
        }

        const frame = getClosestLoadedFrame(frameIndex);

        if (!frame) {
            return;
        }

        drawImageCover(frame);
        drawnFrameIndex = frameIndex;
    };

    const queueDraw = () => {
        if (drawRaf) {
            return;
        }

        drawRaf = window.requestAnimationFrame(() => {
            drawRaf = 0;
            drawFrameAtProgress(frameState.progress);
        });
    };

    const loadFrame = (index, highPriority = false) => {
        if (loadedFrames[index]) {
            return Promise.resolve(loadedFrames[index]);
        }

        return new Promise((resolve) => {
            const image = new Image();

            image.decoding = 'async';

            if ('fetchPriority' in image) {
                image.fetchPriority = highPriority ? 'high' : 'low';
            }

            image.onload = () => {
                loadedFrames[index] = image;
                resolve(image);

                if (index === 0 || index === drawnFrameIndex || index === Math.round(frameState.progress * (TOTAL_FRAMES - 1))) {
                    queueDraw();
                }
            };

            image.onerror = () => {
                resolve(null);
            };

            image.src = frameUrls[index];
        });
    };

    const ensureFrameNeighborhood = (progress) => {
        const centerIndex = Math.round(clamp(progress, 0, 1) * (TOTAL_FRAMES - 1));

        for (let offset = 0; offset <= 3; offset += 1) {
            const next = centerIndex + offset;
            const prev = centerIndex - offset;

            if (next < TOTAL_FRAMES && !loadedFrames[next]) {
                loadFrame(next);
            }

            if (prev >= 0 && !loadedFrames[prev]) {
                loadFrame(prev);
            }
        }
    };

    const preloadInBackground = () => {
        if (preloadIndex >= TOTAL_FRAMES) {
            return;
        }

        const runBatch = () => {
            const batchSize = isMobile ? 4 : 7;
            const tasks = [];

            while (preloadIndex < TOTAL_FRAMES && tasks.length < batchSize) {
                if (!loadedFrames[preloadIndex]) {
                    tasks.push(loadFrame(preloadIndex));
                }

                preloadIndex += 1;
            }

            Promise.all(tasks).finally(() => {
                preloadInBackground();
            });
        };

        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(runBatch, { timeout: 450 });
            return;
        }

        window.setTimeout(runBatch, 24);
    };

    const resizeCanvas = () => {
        const stageRect = stage.getBoundingClientRect();
        const pixelRatio = Math.min(window.devicePixelRatio || 1, dprLimit);

        const width = Math.max(1, Math.round(stageRect.width * pixelRatio));
        const height = Math.max(1, Math.round(stageRect.height * pixelRatio));

        if (canvas.width !== width || canvas.height !== height) {
            canvas.width = width;
            canvas.height = height;
            canvas.style.width = `${stageRect.width}px`;
            canvas.style.height = `${stageRect.height}px`;
            queueDraw();
        }
    };

    const scheduleResize = () => {
        if (resizeRaf) {
            return;
        }

        resizeRaf = window.requestAnimationFrame(() => {
            resizeRaf = 0;
            resizeCanvas();
            ScrollTrigger.refresh();
        });
    };

    gsap.set(textLayer, {
        transformOrigin: '50% 50%',
        force3D: true,
        willChange: 'transform, opacity, filter',
    });

    const runEntryAnimation = () => {
        if (prefersReducedMotion) {
            return;
        }

        const mainChars = splitToAnimatedChars(titleMain);
        const accentChars = splitToAnimatedChars(titleAccent);
        const allChars = [...mainChars, ...accentChars];

        if (!allChars.length) {
            return;
        }

        gsap.set(textLayer, {
            y: 72,
            opacity: 1,
            filter: 'blur(0px)',
        });

        gsap.set(allChars, {
            opacity: 0,
            y: (index) => 94 - ((index % 5) * 9),
            x: (index) => Math.sin(index * 0.7) * 28,
            rotation: (index) => Math.sin(index * 0.45) * 16,
            filter: 'blur(9px)',
            transformOrigin: '50% 100%',
            willChange: 'transform, opacity, filter',
        });

        const entryTimeline = gsap.timeline({
            defaults: {
                ease: 'power4.out',
            },
        });

        entryTimeline.to(
            textLayer,
            {
                y: 0,
                duration: 1.28,
                ease: 'power3.out',
            },
            0,
        );

        entryTimeline.to(
            mainChars,
            {
                opacity: 1,
                y: 0,
                x: 0,
                rotation: 0,
                filter: 'blur(0px)',
                duration: 1.06,
                stagger: {
                    each: 0.026,
                    from: 'start',
                },
            },
            0.06,
        );

        entryTimeline.to(
            accentChars,
            {
                opacity: 1,
                y: 0,
                x: 0,
                rotation: 0,
                filter: 'blur(0px)',
                duration: 1.05,
                stagger: {
                    each: 0.029,
                    from: 'start',
                },
            },
            0.3,
        );
    };

    resizeCanvas();

    loadFrame(0, true).then(() => {
        frameState.progress = 0;
        drawFrameAtProgress(0);
    });

    runEntryAnimation();

    Promise.all(Array.from({ length: 12 }, (_, index) => loadFrame(index, true))).finally(() => {
        preloadIndex = 12;
        preloadInBackground();
    });

    if (!prefersReducedMotion) {
        const timeline = gsap.timeline({
            defaults: {
                ease: 'none',
            },
            scrollTrigger: {
                trigger: hero,
                start: 'top top',
                end: 'bottom top',
                scrub: 0.18,
                fastScrollEnd: true,
                invalidateOnRefresh: true,
            },
        });

        timeline.to(
            frameState,
            {
                progress: 1,
                duration: FRAME_COMPLETE_AT_SCROLL,
                onUpdate: () => {
                    queueDraw();
                    ensureFrameNeighborhood(frameState.progress);
                },
            },
            0,
        );

        timeline.to(
            textLayer,
            {
                scale: 0.34,
                duration: 0.8,
                ease: 'power2.out',
            },
            0,
        );

        timeline.to(
            textLayer,
            {
                opacity: 0,
                filter: 'blur(10px)',
                duration: 0.56,
                ease: 'power2.out',
            },
            0.24,
        );
    }

    window.addEventListener('resize', scheduleResize, { passive: true });
};

const bootWaveHero = () => {
    const hero = document.querySelector(HERO_SELECTOR);

    if (!hero) {
        return;
    }

    const introOverlay = document.getElementById('intro-overlay');

    if (!introOverlay) {
        initWaveHeroAnimation();
        return;
    }

    window.addEventListener('site:ready', initWaveHeroAnimation, {
        once: true,
    });

    window.setTimeout(() => {
        initWaveHeroAnimation();
    }, 5200);
};

const initSectionSmoothScroll = () => {
    if (document.body.dataset.sectionScrollInitialized === 'true') {
        return;
    }

    const links = Array.from(new Set([
        ...document.querySelectorAll(SECTION_LINK_SELECTOR),
        ...document.querySelectorAll(HASH_LINK_SELECTOR),
    ]));

    if (!links.length) {
        return;
    }

    document.body.dataset.sectionScrollInitialized = 'true';

    const getHeaderOffset = () => {
        const header = document.querySelector('header');

        if (!header) {
            return 0;
        }

        return Math.round(header.getBoundingClientRect().height) + 8;
    };

    const closeSidebarIfNeeded = () => {
        if (!window.matchMedia('(max-width: 1023px)').matches) {
            return;
        }

        const closeButton = document.querySelector(SIDEBAR_CLOSE_SELECTOR);

        if (closeButton instanceof HTMLElement) {
            window.setTimeout(() => {
                closeButton.click();
            }, 120);
        }
    };

    links.forEach((link) => {
        link.addEventListener('click', (event) => {
            const fallbackTarget = (link.getAttribute('href') || '').replace('#', '');
            const targetId = link.getAttribute('data-scroll-target') || fallbackTarget;

            if (!targetId) {
                return;
            }

            const targetElement = document.getElementById(targetId);

            if (!targetElement) {
                return;
            }

            event.preventDefault();
            closeSidebarIfNeeded();

            const duration = window.matchMedia('(max-width: 767px)').matches ? 1.05 : 1.22;

            gsap.to(window, {
                duration,
                ease: 'power3.inOut',
                scrollTo: {
                    y: targetElement,
                    offsetY: getHeaderOffset(),
                    autoKill: true,
                },
            });
        }, { passive: false });
    });
};

const bootAppInteractions = () => {
    bootWaveHero();
    initSectionSmoothScroll();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootAppInteractions, { once: true });
} else {
    bootAppInteractions();
}
