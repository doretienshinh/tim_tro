/**
 * Perfect Scrollbar
 */
'use strict';

document.addEventListener('DOMContentLoaded', function () {
  (function () {
    const verticalScroll = document.getElementById('vertical-scroll'),
      horizontalScroll = document.getElementById('horizontal-scroll'),
      horizVertScroll = document.getElementById('both-scrollbars-scroll');

    // Vertical Example
    // --------------------------------------------------------------------
    if (verticalScroll) {
      new PerfectScrollbar(verticalScroll, {
        wheelPropagation: false
      });
    }

    // Horizontal Example
    // --------------------------------------------------------------------
    if (horizontalScroll) {
      new PerfectScrollbar(horizontalScroll, {
        wheelPropagation: false,
        suppressScrollY: true
      });
    }

    // Both vertical and Horizontal Example
    // --------------------------------------------------------------------
    if (horizVertScroll) {
      new PerfectScrollbar(horizVertScroll, {
        wheelPropagation: false
      });
    }
  })();
});
