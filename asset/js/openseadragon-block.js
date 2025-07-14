document.addEventListener('DOMContentLoaded', function () {
    const blocks = document.querySelectorAll('.openseadragon-block');
  
    blocks.forEach((el) => {
      const tileSource = el.dataset.tilesource;
      const zoom1 = parseFloat(el.dataset.zoom1);
      const zoom2 = parseFloat(el.dataset.zoom2);
      const zoom3 = parseFloat(el.dataset.zoom3);
      const zoom4 = parseFloat(el.dataset.zoom4);
      const positionx = parseFloat(el.dataset.positionx);
      const positiony = parseFloat(el.dataset.positiony);
  
      const tileSources = [tileSource];
  
      const zoomLevels = {
        small: zoom1,
        medium: zoom2,
        large: zoom3,
        xlarge: zoom4
      };
  
      const initialPosition = {
        x: positionx,
        y: positiony
      };
  
      const viewerOptions = {
        element: el,
        tileSources: tileSources,
        showNavigationControl: false,
        gestureSettingsMouse: {
          clickToZoom: false,
          dblClickToZoom: false,
          pinchToZoom: false,
          wheelToZoom: false
        }
      };
  
      const viewer = OpenSeadragon(viewerOptions);
  
      function calculateResponsiveZoom() {
        const width = document.documentElement.clientWidth;
        if (width <= 600) return zoomLevels.small;
        if (width <= 900) return zoomLevels.medium;
        if (width <= 1200) return zoomLevels.large;
        return zoomLevels.xlarge;
      }
  
      viewer.addHandler("open", function () {
        viewer.viewport.zoomTo(calculateResponsiveZoom(), new OpenSeadragon.Point(0.5, 0.5), true);
        viewer.viewport.panTo(new OpenSeadragon.Point(initialPosition.x, initialPosition.y), { immediately: true });
        viewer.setMouseNavEnabled(false);
      });
  
      function handleResize() {
        viewer.viewport.zoomTo(calculateResponsiveZoom(), null, true);
      }
  
      window.addEventListener('resize', handleResize);
      window.addEventListener('orientationchange', handleResize);
    });
  });
  