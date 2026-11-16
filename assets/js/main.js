// Acworth Water Damage Restoration — vanilla JS only.
// Reveal-on-scroll via IntersectionObserver; mobile menu closes when a link
// inside it is tapped, on scroll, or on Escape. FAQ uses native <details>, no JS needed.
(function () {
  'use strict';

  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0 });
    revealEls.forEach(function (el) { observer.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }
  // Safety timer (defense in depth): no content wrapper should carry
  // .reveal any more, but if one ever does, it must never stay hidden.
  setTimeout(function () {
    document.querySelectorAll('.reveal:not(.in)').forEach(function (el) {
      el.classList.add('in');
    });
  }, 900);

  // Header gains a shadow once the page scrolls.
  var header = document.querySelector('.site-header');
  function onScrollHeader() {
    if (!header) return;
    header.classList.toggle('scrolled', window.scrollY > 8);
  }
  window.addEventListener('scroll', onScrollHeader, { passive: true });
  onScrollHeader();

  // Close the mobile menu after a link inside it is tapped.
  document.querySelectorAll('.mobile-menu a').forEach(function (link) {
    link.addEventListener('click', function () {
      var wrap = link.closest('.mobile-menu-wrap');
      if (wrap) wrap.removeAttribute('open');
    });
  });

  // MOBILE AUDIT 2026-11-16 (item F, P1 — Delaware scroll-trap fix).
  // The menu panel is a 70vh scroll container with
  // overscroll-behavior:contain, so a touch swipe starting inside it
  // scrolls the panel and the page NEVER moves — the scroll-close
  // handler below never fires. Two escapes, both leaving ordinary
  // in-panel scrolls untouched:
  // (a) backdrop tap-to-close — the .menu-backdrop sheet (a <header>
  // sibling, shown while html.menu-open) eats taps outside the panel;
  // (b) edge-swipe close — a swipe pushing PAST the panel's top edge
  // (scrollTop 0, swiping down) or bottom edge (scrolled to the end,
  // swiping up) closes the menu; the next swipe then scrolls the page.
  // A 300ms guard stops the closing gesture's own touchend/click from
  // re-toggling the hamburger summary.
  var menuWrap = document.querySelector('.mobile-menu-wrap');
  var menuPanel = document.querySelector('.mobile-menu');
  var backdrop = document.querySelector('.menu-backdrop');
  var guardUntil = 0;
  function closeMenu() {
    if (!menuWrap) return;
    menuWrap.removeAttribute('open');
    syncExpanded();
  }
  function syncMenuOpen() {
    var open = !!(menuWrap && menuWrap.open);
    document.documentElement.classList.toggle('menu-open', open);
  }
  if (menuWrap) {
    menuWrap.addEventListener('toggle', syncMenuOpen);
    syncMenuOpen();
  }
  if (backdrop) {
    backdrop.addEventListener('click', function () { closeMenu(); });
  }
  if (menuWrap) {
    menuWrap.querySelector('summary').addEventListener('click', function (e) {
      if (Date.now() < guardUntil) e.preventDefault();
    }, true);
  }
  if (menuPanel) {
    var edgeStartY = 0, edgeStartTop = 0, edgeClosed = false;
    menuPanel.addEventListener('touchstart', function (e) {
      if (e.touches.length !== 1) return;
      edgeStartY = e.touches[0].clientY;
      edgeStartTop = menuPanel.scrollTop;
      edgeClosed = false;
    }, { passive: true });
    menuPanel.addEventListener('touchmove', function (e) {
      if (e.touches.length !== 1 || edgeClosed) return;
      var dy = e.touches[0].clientY - edgeStartY;
      var atTop = edgeStartTop <= 0;
      var atBottom = edgeStartTop + menuPanel.clientHeight >= menuPanel.scrollHeight - 1;
      if ((atTop && dy > 28) || (atBottom && dy < -28)) {
        edgeClosed = true;
        guardUntil = Date.now() + 300;
        closeMenu();
      }
    }, { passive: true });
  }

  // Close the mobile menu on scroll (standing rule: menu closes on scroll).
  window.addEventListener('scroll', function () {
    document.querySelectorAll('details.mobile-menu-wrap[open]').forEach(function (d) {
      d.removeAttribute('open');
    });
    syncExpanded();
  }, { passive: true });

  // Only one desktop dropdown open at a time.
  document.querySelectorAll('.main-nav details').forEach(function (detail) {
    detail.addEventListener('toggle', function () {
      if (!detail.open) return;
      document.querySelectorAll('.main-nav details').forEach(function (other) {
        if (other !== detail) other.removeAttribute('open');
      });
    });
  });

  // Keep aria-expanded in sync on every header <summary>.
  function syncExpanded() {
    document.querySelectorAll('header details summary').forEach(function (s) {
      s.setAttribute('aria-expanded', s.parentElement.open ? 'true' : 'false');
    });
  }
  document.querySelectorAll('header details').forEach(function (d) {
    d.addEventListener('toggle', syncExpanded);
  });
  syncExpanded();

  // Escape closes any open header dropdown / mobile menu.
  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') return;
    document.querySelectorAll('header details[open]').forEach(function (d) {
      d.removeAttribute('open');
    });
    syncExpanded();
  });

  // Click outside the header closes open desktop dropdowns.
  document.addEventListener('click', function (e) {
    if (e.target.closest('.site-header')) return;
    document.querySelectorAll('.main-nav details[open]').forEach(function (d) {
      d.removeAttribute('open');
    });
    syncExpanded();
  });

  // Mobile call bar: hidden at first paint so it can never cover the hero
  // buttons; it slides in once the user has scrolled a little.
  var docEl = document.documentElement;
  function callbar() {
    if (window.scrollY > 80) {
      docEl.classList.add('callbar-on');
    } else {
      docEl.classList.remove('callbar-on');
    }
  }
  window.addEventListener('scroll', callbar, { passive: true });
  callbar();
})();
