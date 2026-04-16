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
const HERO_EYEBROW_SELECTOR = '[data-wave-eyebrow]';
const HERO_DESCRIPTION_SELECTOR = '[data-wave-description]';
const HERO_ACTIONS_SELECTOR = '[data-wave-actions]';
const HERO_PROOF_SELECTOR = '[data-wave-proof]';
const HERO_SCROLL_CUE_SELECTOR = '[data-wave-scroll-cue]';
const HERO_SCROLL_CUE_ICON_SELECTOR = '[data-wave-scroll-cue-icon]';
const HERO_SCROLL_CUE_PULSE_SELECTOR = '[data-wave-scroll-cue-pulse]';
const HERO_DYNAMIC_ACCENT_PHRASES = [
    'crescer com software sob medida',
    'ganhar escala com automa\u00e7\u00f5es inteligentes',
    'evoluir com tecnologia sem gargalos',
    'transformar opera\u00e7\u00e3o em vantagem competitiva',
];
const HERO_ACCENT_ROTATION_DELAY = 2.35;
const SECTION_LINK_SELECTOR = '[data-scroll-link]';
const HASH_LINK_SELECTOR = 'a[href^="#"]';
const SIDEBAR_CLOSE_SELECTOR = '[data-sidebar-close]';

const TOTAL_FRAMES = 150;
const FRAMES_BASE_PATH = '/somosdevs/animations/scroll';
const FRAME_COMPLETE_AT_SCROLL = 0.94;
const IDLE_TOTAL_FRAMES = 240;
const IDLE_FRAMES_BASE_PATH = '/somosdevs/animations/fixed';
const IDLE_LOOP_DURATION_SECONDS = 8;
const IDLE_LOOP_BLEND_RATIO = 0.1;
const IDLE_LOOP_VEIL_ALPHA = 0.1;
const IDLE_LOOP_TOP_THRESHOLD = 8;

const clamp = (value, min, max) => Math.min(max, Math.max(min, value));
const smoothstep = (value) => {
    const t = clamp(value, 0, 1);

    return t * t * (3 - (2 * t));
};

const createFrameUrl = (index) => {
    return `${FRAMES_BASE_PATH}/img${String(index + 1).padStart(3, '0')}.jpg`;
};

const createIdleFrameUrl = (index) => {
    return `${IDLE_FRAMES_BASE_PATH}/img${String(index + 1).padStart(3, '0')}.jpg`;
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
    const eyebrow = hero.querySelector(HERO_EYEBROW_SELECTOR);
    const description = hero.querySelector(HERO_DESCRIPTION_SELECTOR);
    const actions = hero.querySelector(HERO_ACTIONS_SELECTOR);
    const proof = hero.querySelector(HERO_PROOF_SELECTOR);
    const scrollCue = hero.querySelector(HERO_SCROLL_CUE_SELECTOR);
    const scrollCueIcon = hero.querySelector(HERO_SCROLL_CUE_ICON_SELECTOR);
    const scrollCuePulse = hero.querySelector(HERO_SCROLL_CUE_PULSE_SELECTOR);

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

    const scrollFrameUrls = Array.from({ length: TOTAL_FRAMES }, (_, index) => createFrameUrl(index));
    const idleFrameUrls = Array.from({ length: IDLE_TOTAL_FRAMES }, (_, index) => createIdleFrameUrl(index));
    const scrollLoadedFrames = new Array(TOTAL_FRAMES);
    const idleLoadedFrames = new Array(IDLE_TOTAL_FRAMES);

    const frameState = {
        progress: 0,
    };

    const idleLoopState = {
        phase: 0,
        progress: 0,
    };

    let drawnFrameSignature = '';
    let scrollPreloadIndex = 0;
    let idlePreloadIndex = 0;
    let drawRaf = 0;
    let resizeRaf = 0;
    let idleLoopTimeline = null;
    let idleLoopActive = false;
    let idleBlendState = null;
    let scrollCueTimeline = null;
    let accentSwapTimer = null;
    let accentSwapTimeline = null;

    const accentPhrases = Array.from(new Set([
        (titleAccent.textContent || '').trim(),
        ...HERO_DYNAMIC_ACCENT_PHRASES,
    ].filter(Boolean)));

    let accentPhraseIndex = 0;

    const createCharsScatterState = () => {
        return {
            opacity: 0,
            y: (index) => 94 - ((index % 5) * 9),
            x: (index) => Math.sin(index * 0.7) * 28,
            rotation: (index) => Math.sin(index * 0.45) * 16,
            filter: 'blur(9px)',
            transformOrigin: '50% 100%',
            willChange: 'transform, opacity, filter',
        };
    };

    const createCharsRestState = () => {
        return {
            opacity: 1,
            y: 0,
            x: 0,
            rotation: 0,
            filter: 'blur(0px)',
        };
    };

    const createCharsInAnimation = () => {
        return {
            ...createCharsRestState(),
            duration: 1.06,
            stagger: {
                each: 0.026,
                from: 'start',
            },
        };
    };

    const createCharsOutAnimation = () => {
        return {
            ...createCharsScatterState(),
            duration: 0.84,
            stagger: {
                each: 0.022,
                from: 'end',
            },
            ease: 'power3.in',
        };
    };

    const buildAccentChars = (phrase) => {
        if (!titleAccent) {
            return [];
        }

        titleAccent.textContent = phrase;
        delete titleAccent.dataset.waveCharsSplit;

        return splitToAnimatedChars(titleAccent);
    };

    let currentAccentChars = buildAccentChars(accentPhrases[accentPhraseIndex]);

    const getClosestLoadedFrame = (targetIndex, loadedFrames, totalFrames) => {
        if (loadedFrames[targetIndex]) {
            return loadedFrames[targetIndex];
        }

        for (let offset = 1; offset < totalFrames; offset += 1) {
            const backward = targetIndex - offset;
            const forward = targetIndex + offset;

            if (backward >= 0 && loadedFrames[backward]) {
                return loadedFrames[backward];
            }

            if (forward < totalFrames && loadedFrames[forward]) {
                return loadedFrames[forward];
            }
        }

        return null;
    };

    const drawImageCover = (image, alpha = 1, clear = true) => {
        const canvasWidth = canvas.width;
        const canvasHeight = canvas.height;
        const imageWidth = image.naturalWidth || image.width;
        const imageHeight = image.naturalHeight || image.height;

        if (clear) {
            context.fillStyle = '#070d19';
            context.fillRect(0, 0, canvasWidth, canvasHeight);
        }

        if (!imageWidth || !imageHeight) {
            return;
        }

        const scale = Math.max(canvasWidth / imageWidth, canvasHeight / imageHeight);
        const drawWidth = imageWidth * scale;
        const drawHeight = imageHeight * scale;
        const offsetX = (canvasWidth - drawWidth) / 2;
        const offsetY = (canvasHeight - drawHeight) / 2;

        context.save();
        context.globalAlpha = clamp(alpha, 0, 1);
        context.drawImage(image, offsetX, offsetY, drawWidth, drawHeight);
        context.restore();
    };

    const drawFrameForProgress = (progress, totalFrames, loadedFrames, sourceKey) => {
        const clampedProgress = clamp(progress, 0, 1);
        const frameIndex = Math.round(clampedProgress * (totalFrames - 1));
        const frameSignature = `${sourceKey}:${frameIndex}`;

        if (frameSignature === drawnFrameSignature) {
            return;
        }

        const frame = getClosestLoadedFrame(frameIndex, loadedFrames, totalFrames);

        if (!frame) {
            return;
        }

        drawImageCover(frame);
        drawnFrameSignature = frameSignature;
    };

    const drawIdleBlendFrame = (fromProgress, toProgress, mix, veilAlpha) => {
        const fromIndex = Math.round(clamp(fromProgress, 0, 1) * (IDLE_TOTAL_FRAMES - 1));
        const toIndex = Math.round(clamp(toProgress, 0, 1) * (IDLE_TOTAL_FRAMES - 1));
        const fromFrame = getClosestLoadedFrame(fromIndex, idleLoadedFrames, IDLE_TOTAL_FRAMES);
        const toFrame = getClosestLoadedFrame(toIndex, idleLoadedFrames, IDLE_TOTAL_FRAMES);

        if (!fromFrame && !toFrame) {
            return;
        }

        context.fillStyle = '#070d19';
        context.fillRect(0, 0, canvas.width, canvas.height);

        if (fromFrame) {
            drawImageCover(fromFrame, 1, false);
        }

        if (toFrame) {
            drawImageCover(toFrame, mix, false);
        }

        if (veilAlpha > 0) {
            context.save();
            context.globalAlpha = clamp(veilAlpha, 0, 1);
            context.fillStyle = '#050505';
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.restore();
        }

        drawnFrameSignature = '';
    };

    const drawScrollFrameAtProgress = (progress) => {
        drawFrameForProgress(progress, TOTAL_FRAMES, scrollLoadedFrames, 'scroll');
    };

    const drawIdleFrameAtProgress = (progress) => {
        drawFrameForProgress(progress, IDLE_TOTAL_FRAMES, idleLoadedFrames, 'idle');
    };

    const queueDraw = () => {
        if (drawRaf) {
            return;
        }

        drawRaf = window.requestAnimationFrame(() => {
            drawRaf = 0;

            if (idleLoopActive) {
                if (idleBlendState) {
                    drawIdleBlendFrame(
                        idleBlendState.fromProgress,
                        idleBlendState.toProgress,
                        idleBlendState.mix,
                        idleBlendState.veilAlpha,
                    );
                    return;
                }

                drawIdleFrameAtProgress(idleLoopState.progress);
                return;
            }

            drawScrollFrameAtProgress(frameState.progress);
        });
    };

    const loadFrame = (index, urls, loadedFrames, highPriority = false) => {
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
                queueDraw();
            };

            image.onerror = () => {
                resolve(null);
            };

            image.src = urls[index];
        });
    };

    const ensureFrameNeighborhood = (progress, totalFrames, urls, loadedFrames) => {
        const centerIndex = Math.round(clamp(progress, 0, 1) * (totalFrames - 1));

        for (let offset = 0; offset <= 3; offset += 1) {
            const next = centerIndex + offset;
            const prev = centerIndex - offset;

            if (next < totalFrames && !loadedFrames[next]) {
                loadFrame(next, urls, loadedFrames);
            }

            if (prev >= 0 && !loadedFrames[prev]) {
                loadFrame(prev, urls, loadedFrames);
            }
        }
    };

    const preloadScrollInBackground = () => {
        if (scrollPreloadIndex >= TOTAL_FRAMES) {
            return;
        }

        const runBatch = () => {
            const batchSize = isMobile ? 4 : 7;
            const tasks = [];

            while (scrollPreloadIndex < TOTAL_FRAMES && tasks.length < batchSize) {
                if (!scrollLoadedFrames[scrollPreloadIndex]) {
                    tasks.push(loadFrame(scrollPreloadIndex, scrollFrameUrls, scrollLoadedFrames));
                }

                scrollPreloadIndex += 1;
            }

            Promise.all(tasks).finally(() => {
                preloadScrollInBackground();
            });
        };

        if ('requestIdleCallback' in window) {
            window.requestIdleCallback(runBatch, { timeout: 450 });
            return;
        }

        window.setTimeout(runBatch, 24);
    };

    const preloadIdleInBackground = () => {
        if (idlePreloadIndex >= IDLE_TOTAL_FRAMES) {
            return;
        }

        const runBatch = () => {
            const batchSize = isMobile ? 4 : 9;
            const tasks = [];

            while (idlePreloadIndex < IDLE_TOTAL_FRAMES && tasks.length < batchSize) {
                if (!idleLoadedFrames[idlePreloadIndex]) {
                    tasks.push(loadFrame(idlePreloadIndex, idleFrameUrls, idleLoadedFrames));
                }

                idlePreloadIndex += 1;
            }

            Promise.all(tasks).finally(() => {
                preloadIdleInBackground();
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

    const shouldRunIdleLoop = () => {
        if (prefersReducedMotion) {
            return false;
        }

        return window.scrollY <= IDLE_LOOP_TOP_THRESHOLD;
    };

    const stopIdleLoop = () => {
        if (!idleLoopTimeline || !idleLoopActive) {
            return;
        }

        idleLoopTimeline.pause();
        idleLoopActive = false;
        idleBlendState = null;
    };

    const startIdleLoop = () => {
        if (!idleLoopTimeline || idleLoopActive) {
            return;
        }

        idleLoopTimeline.pause(0);
        idleLoopState.phase = 0;
        idleLoopState.progress = 0;
        idleBlendState = null;
        idleLoopActive = true;
        queueDraw();
        idleLoopTimeline.play(0);
    };

    const syncIdleLoopWithViewport = () => {
        if (shouldRunIdleLoop()) {
            startIdleLoop();
            return;
        }

        stopIdleLoop();
    };

    gsap.set(textLayer, {
        transformOrigin: '50% 50%',
        force3D: true,
        willChange: 'transform, opacity, filter',
    });

    if (!prefersReducedMotion) {
        idleLoopTimeline = gsap.timeline({
            paused: true,
            repeat: -1,
            defaults: {
                ease: 'none',
            },
        });

        idleLoopTimeline.to(idleLoopState, {
            phase: 1,
            duration: IDLE_LOOP_DURATION_SECONDS,
            ease: 'none',
            onUpdate: () => {
                const phase = idleLoopState.phase % 1;
                const blendStart = 1 - IDLE_LOOP_BLEND_RATIO;

                idleLoopState.progress = phase;

                if (phase < blendStart) {
                    idleBlendState = null;
                } else {
                    const blendRaw = (phase - blendStart) / IDLE_LOOP_BLEND_RATIO;
                    const blend = smoothstep(blendRaw);
                    const veilAlpha = Math.sin(blend * Math.PI) * IDLE_LOOP_VEIL_ALPHA;

                    idleBlendState = {
                        fromProgress: phase,
                        toProgress: 0,
                        mix: blend,
                        veilAlpha,
                    };

                    ensureFrameNeighborhood(0, IDLE_TOTAL_FRAMES, idleFrameUrls, idleLoadedFrames);
                }

                ensureFrameNeighborhood(phase, IDLE_TOTAL_FRAMES, idleFrameUrls, idleLoadedFrames);
                queueDraw();
            },
        });
    }

    const runScrollCueLoop = () => {
        if (!scrollCue || !scrollCueIcon || prefersReducedMotion || scrollCueTimeline) {
            return;
        }

        gsap.set(scrollCueIcon, { y: 0 });

        scrollCueTimeline = gsap.timeline({
            repeat: -1,
            repeatDelay: 0.16,
        });

        scrollCueTimeline.to(scrollCueIcon, {
            y: 8,
            duration: 0.72,
            ease: 'sine.inOut',
        });

        scrollCueTimeline.to(scrollCueIcon, {
            y: 0,
            duration: 0.72,
            ease: 'sine.inOut',
        });

        if (scrollCuePulse) {
            scrollCueTimeline.fromTo(
                scrollCuePulse,
                {
                    scale: 0.8,
                    autoAlpha: 0.48,
                },
                {
                    scale: 1.56,
                    autoAlpha: 0,
                    duration: 1.44,
                    ease: 'power1.out',
                },
                0,
            );
        }
    };

    const clearAccentRotation = () => {
        if (accentSwapTimer) {
            accentSwapTimer.kill();
            accentSwapTimer = null;
        }

        if (accentSwapTimeline) {
            accentSwapTimeline.kill();
            accentSwapTimeline = null;
        }
    };

    const cycleAccentPhrase = () => {
        if (prefersReducedMotion || !titleAccent || accentPhrases.length <= 1) {
            return;
        }

        const outgoingChars = currentAccentChars.length ? currentAccentChars : splitToAnimatedChars(titleAccent);
        const nextIndex = (accentPhraseIndex + 1) % accentPhrases.length;
        const nextPhrase = accentPhrases[nextIndex];

        accentSwapTimeline = gsap.to(outgoingChars, {
            ...createCharsOutAnimation(),
            onComplete: () => {
                currentAccentChars = buildAccentChars(nextPhrase);

                if (!currentAccentChars.length) {
                    accentPhraseIndex = nextIndex;
                    scheduleAccentRotation();
                    return;
                }

                gsap.set(currentAccentChars, createCharsScatterState());

                accentSwapTimeline = gsap.to(currentAccentChars, {
                    ...createCharsInAnimation(),
                    ease: 'power4.out',
                    onComplete: () => {
                        accentPhraseIndex = nextIndex;
                        accentSwapTimeline = null;
                        scheduleAccentRotation();
                    },
                });
            },
        });
    };

    const scheduleAccentRotation = () => {
        if (prefersReducedMotion || !titleAccent || accentPhrases.length <= 1) {
            return;
        }

        accentSwapTimer = gsap.delayedCall(HERO_ACCENT_ROTATION_DELAY, () => {
            accentSwapTimer = null;
            cycleAccentPhrase();
        });
    };

    const startAccentRotation = () => {
        if (prefersReducedMotion || !titleAccent || accentPhrases.length <= 1) {
            return;
        }

        clearAccentRotation();
        scheduleAccentRotation();
    };

    const runEntryAnimation = () => {
        const proofItems = proof ? Array.from(proof.children) : [];
        const actionItems = actions ? Array.from(actions.children) : [];

        if (prefersReducedMotion) {
            if (scrollCue) {
                gsap.set(scrollCue, { autoAlpha: 1, y: 0 });
            }

            if (titleAccent) {
                gsap.set(titleAccent, { autoAlpha: 1, y: 0, rotateX: 0, filter: 'blur(0px)' });
            }

            return;
        }

        const mainChars = splitToAnimatedChars(titleMain);
        currentAccentChars = buildAccentChars(accentPhrases[accentPhraseIndex]);

        if (scrollCue) {
            gsap.set(scrollCue, {
                autoAlpha: 1,
                y: 0,
                filter: 'blur(0px)',
            });

            runScrollCueLoop();
        }

        if (!mainChars.length) {
            return;
        }

        gsap.set(textLayer, {
            y: 72,
            opacity: 1,
            filter: 'blur(0px)',
        });

        gsap.set([eyebrow, description].filter(Boolean), {
            autoAlpha: 0,
            y: 20,
            filter: 'blur(6px)',
        });

        if (titleAccent) {
            gsap.set(titleAccent, {
                autoAlpha: 1,
                y: 0,
                filter: 'blur(0px)',
            });
        }

        if (proofItems.length) {
            gsap.set(proofItems, {
                autoAlpha: 0,
                y: 22,
                scale: 0.92,
                filter: 'blur(5px)',
            });
        }

        if (actionItems.length) {
            gsap.set(actionItems, {
                autoAlpha: 0,
                y: 18,
                scale: 0.98,
                filter: 'blur(5px)',
            });
        }

        gsap.set(mainChars, createCharsScatterState());

        if (currentAccentChars.length) {
            gsap.set(currentAccentChars, createCharsScatterState());
        }

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

        if (eyebrow) {
            entryTimeline.to(
                eyebrow,
                {
                    autoAlpha: 1,
                    y: 0,
                    filter: 'blur(0px)',
                    duration: 0.76,
                    ease: 'power2.out',
                },
                0.02,
            );
        }

        entryTimeline.to(
            mainChars,
            createCharsInAnimation(),
            0.06,
        );

        if (currentAccentChars.length) {
            entryTimeline.to(
                currentAccentChars,
                createCharsInAnimation(),
                0.34,
            );
        }

        if (description) {
            entryTimeline.to(
                description,
                {
                    autoAlpha: 1,
                    y: 0,
                    filter: 'blur(0px)',
                    duration: 0.82,
                    ease: 'power2.out',
                },
                0.46,
            );
        }

        if (proofItems.length) {
            entryTimeline.to(
                proofItems,
                {
                    autoAlpha: 1,
                    y: 0,
                    scale: 1,
                    filter: 'blur(0px)',
                    duration: 0.72,
                    stagger: {
                        each: 0.08,
                        from: 'start',
                    },
                    ease: 'power2.out',
                },
                0.62,
            );
        }

        if (actionItems.length) {
            entryTimeline.to(
                actionItems,
                {
                    autoAlpha: 1,
                    y: 0,
                    scale: 1,
                    filter: 'blur(0px)',
                    duration: 0.72,
                    stagger: {
                        each: 0.09,
                        from: 'start',
                    },
                    ease: 'power2.out',
                },
                0.78,
            );
        }

        entryTimeline.add(startAccentRotation, '>-0.08');

    };

    resizeCanvas();

    Promise.all([
        loadFrame(0, scrollFrameUrls, scrollLoadedFrames, true),
        loadFrame(0, idleFrameUrls, idleLoadedFrames, true),
    ]).then(() => {
        frameState.progress = 0;
        idleLoopState.phase = 0;
        idleLoopState.progress = 0;

        if (shouldRunIdleLoop()) {
            startIdleLoop();
            return;
        }

        drawScrollFrameAtProgress(0);
    });

    runEntryAnimation();

    Promise.all([
        ...Array.from({ length: 12 }, (_, index) => loadFrame(index, scrollFrameUrls, scrollLoadedFrames, true)),
        ...Array.from({ length: 18 }, (_, index) => loadFrame(index, idleFrameUrls, idleLoadedFrames, true)),
    ]).finally(() => {
        scrollPreloadIndex = 12;
        idlePreloadIndex = 18;
        preloadScrollInBackground();
        preloadIdleInBackground();
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
                onUpdate: (self) => {
                    if (self.progress > 0.001) {
                        stopIdleLoop();
                        return;
                    }

                    syncIdleLoopWithViewport();
                },
            },
        });

        timeline.to(
            frameState,
            {
                progress: 1,
                duration: FRAME_COMPLETE_AT_SCROLL,
                onUpdate: () => {
                    queueDraw();
                    ensureFrameNeighborhood(frameState.progress, TOTAL_FRAMES, scrollFrameUrls, scrollLoadedFrames);
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

        if (scrollCue) {
            timeline.to(
                scrollCue,
                {
                    autoAlpha: 0,
                    y: 24,
                    duration: 0.28,
                    ease: 'power2.out',
                },
                0.08,
            );
        }
    }

    window.addEventListener('resize', scheduleResize, { passive: true });
    window.addEventListener('scroll', syncIdleLoopWithViewport, { passive: true });

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopIdleLoop();
            return;
        }

        syncIdleLoopWithViewport();
    });
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
