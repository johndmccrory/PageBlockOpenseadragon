document.addEventListener('DOMContentLoaded', function () {
  const blocks = document.querySelectorAll('.openseadragon-block');

  // Respect reduced motion
  const reduceMotion = window.matchMedia?.('(prefers-reduced-motion: reduce)')?.matches;

  blocks.forEach((el) => {
    const tileSource = el.dataset.tilesource;

    const zoom1 = parseFloat(el.dataset.zoom1);
    const zoom2 = parseFloat(el.dataset.zoom2);
    const zoom3 = parseFloat(el.dataset.zoom3);
    const zoom4 = parseFloat(el.dataset.zoom4);

    const positionx = parseFloat(el.dataset.positionx);
    const positiony = parseFloat(el.dataset.positiony);

    const zoomLevels = { small: zoom1, medium: zoom2, large: zoom3, xlarge: zoom4 };
    const initialPosition = { x: positionx, y: positiony };

    function calculateResponsiveZoom() {
      const width = document.documentElement.clientWidth;
      if (width <= 600) return zoomLevels.small;
      if (width <= 900) return zoomLevels.medium;
      if (width <= 1200) return zoomLevels.large;
      return zoomLevels.xlarge;
    }

    const viewer = OpenSeadragon({
      element: el,
      tileSources: [tileSource],
      showNavigationControl: false,

      // Keep your “no interaction” intent
        gestureSettingsMouse: {
        clickToZoom: false,
        dblClickToZoom: false,
        pinchToZoom: false,
        wheelToZoom: false
      },

      // Phones/tablets
      gestureSettingsTouch: {
      dragToPan: false,
      pinchToZoom: false,
      flickEnabled: false,
      dblClickToZoom: false,
      clickToZoom: false
    },

      // Animation tuning (these matter)
      animationTime: reduceMotion ? 0 : 100,   // seconds for zoom/pan springs to settle
      blendTime: reduceMotion ? 0 : 0.1,       // crossfade between tiles as you zoom
      springStiffness: 5.5,                    // higher = snappier, lower = floatier
      minZoomImageRatio: 0.9,
      visibilityRatio: 1.0,
      constrainDuringPan: true
    });

    // Optional: hold onto a timer so you can cancel/restart animations cleanly
    let tourTimeout = null;

    function runPanZoomTour() {
      if (reduceMotion) return;

      // Start from your “hero” framing
      const baseZoom = calculateResponsiveZoom();
      viewer.viewport.zoomTo(baseZoom, new OpenSeadragon.Point(0.5, 0.5), true);
      viewer.viewport.panTo(new OpenSeadragon.Point(initialPosition.x, initialPosition.y), true);

      // Then animate to a second framing
      const start = { zoom: baseZoom, x: initialPosition.x, y: initialPosition.y };
      const end = {
        zoom: baseZoom * 1.15,        // gentle push-in; tweak to taste
        x: initialPosition.x + 0.06,  // gentle drift; tweak to taste
        y: initialPosition.y + 0.03
      };

      // Kick the animation on next tick so the initial “set” is applied first
      clearTimeout(tourTimeout);
      tourTimeout = setTimeout(() => {
        viewer.viewport.zoomTo(end.zoom, new OpenSeadragon.Point(0.5, 0.5), false);
        viewer.viewport.panTo(new OpenSeadragon.Point(end.x, end.y), false);
      }, 150);

      // If you want it to “breathe” back and forth (loop), add a return leg:
      // tourTimeout = setTimeout(() => {
      //   viewer.viewport.zoomTo(start.zoom, new OpenSeadragon.Point(0.5, 0.5), false);
      //   viewer.viewport.panTo(new OpenSeadragon.Point(start.x, start.y), false);
      // }, 150 + 4000);
    }

    viewer.addHandler('open', function () {
      // Your initial framing (no animation here, so it loads predictably)
      viewer.viewport.zoomTo(calculateResponsiveZoom(), new OpenSeadragon.Point(0.5, 0.5), true);
      viewer.viewport.panTo(new OpenSeadragon.Point(initialPosition.x, initialPosition.y), true);
      viewer.setMouseNavEnabled(false);

      // Then run the animation
      runPanZoomTour();
    });

    function handleResize() {
      // If you resize, reset to the responsive framing
      viewer.viewport.zoomTo(calculateResponsiveZoom(), null, true);

      // And (optionally) restart the tour so it still looks intentional
      runPanZoomTour();
    }

    window.addEventListener('resize', handleResize);
    window.addEventListener('orientationchange', handleResize);
  });
});