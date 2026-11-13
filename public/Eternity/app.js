/* ============================================================
   KrazySmm — script di interfaccia
   ============================================================ */

/**
 * Registro dei pezzi che vivono dentro <main>: quando cambio pagina dalla
 * barra laterale il contenuto viene sostituito senza ricaricare il sito,
 * quindi questi vanno riattivati sul contenuto nuovo.
 */
window.KS = {
  parts: [],
  on: function (fn) { this.parts.push(fn); fn(); },
  init: function () {
    this.parts.forEach(function (fn) { try { fn(); } catch (e) { console.error(e); } });
  }
};

(function () {
  'use strict';

  /* ---------- loghi piattaforma (client) ---------- */
  var BRANDS = window.BRANDS || {};
  var FALLBACK = {
    kwai: { c: '#FF6A00', t: 'K' },
    likee: { c: '#F93F7B', t: 'L' },
    linkedin: { c: '#0A66C2', t: 'in' },
    seo: { c: '#2563eb', t: '' },
    other: { c: '#8fa3bd', t: '' }
  };

  function platHTML(slug, size) {
    var b = BRANDS[slug];
    var cls = 'plat' + (size ? ' ' + size : '');
    if (b) {
      return '<span class="' + cls + '" style="--bc:' + b.c + '">' +
        '<svg viewBox="0 0 24 24" fill="currentColor"><path d="' + b.p + '"/></svg></span>';
    }
    var f = FALLBACK[slug] || FALLBACK.other;
    var inner = f.t
      ? '<span class="mono">' + f.t + '</span>'
      : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>';
    return '<span class="' + cls + '" style="--bc:' + f.c + '">' + inner + '</span>';
  }

  /* ---------- bandiere: le emoji-bandiera non si vedono su Windows,
       le sostituiamo con le SVG di flag-icons ---------- */
  var HI = '\uD83C';                       // surrogato alto dei "regional indicator"
  var FLAG_RE = new RegExp('(' + HI + '[\uDDE6-\uDDFF])(' + HI + '[\uDDE6-\uDDFF])', 'g');

  function ccOf(pair) { return String.fromCharCode(pair.codePointAt(0) - 0x1F1E6 + 97); }

  function flags(html) {
    return html.replace(FLAG_RE, function (_, a, b) {
      return '<span class="fi fi-' + ccOf(a) + ccOf(b) + '"></span>';
    });
  }

  function escape_(s) {
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }
  var pretty = function (s) { return flags(escape_(s)); };

  /* ---------- menu a tendina custom con ricerca ---------- */

  var openMenu = null;

  function closeOpen() {
    if (!openMenu) return;
    openMenu.root.classList.remove('open');
    openMenu = null;
  }

  function buildSelect(sel) {
    if (sel.dataset.kdone) return;
    sel.dataset.kdone = '1';

    var opts = [].map.call(sel.options, function (o, i) {
      return {
        i: i, value: o.value, label: o.text,
        plat: o.dataset.plat || '', meta: o.dataset.meta || '',
        disabled: o.disabled, search: (o.text + ' ' + o.value).toLowerCase()
      };
    });

    var root = document.createElement('div');
    root.className = 'ksel-root';

    var btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'ksel-btn';
    btn.innerHTML = '<span class="ksel-val"></span>' +
      '<svg class="ksel-caret" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" ' +
      'stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>';

    var pop = document.createElement('div');
    pop.className = 'ksel-pop';
    pop.innerHTML =
      '<div class="ksel-search">' +
      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">' +
      '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>' +
      '<input type="text" placeholder="' + (sel.dataset.search || 'Cerca...') + '" autocomplete="off">' +
      '</div><div class="ksel-list" role="listbox"></div><div class="ksel-none">Nessun risultato</div>';

    var input = pop.querySelector('input');
    var list = pop.querySelector('.ksel-list');
    var none = pop.querySelector('.ksel-none');

    root.appendChild(btn);
    root.appendChild(pop);
    sel.parentNode.insertBefore(root, sel);
    root.appendChild(sel);

    var active = -1;
    var shown = [];

    function paintValue() {
      var o = opts[sel.selectedIndex] || opts[0];
      if (!o) { btn.querySelector('.ksel-val').textContent = sel.dataset.ph || ''; return; }
      var empty = o.value === '';
      btn.querySelector('.ksel-val').innerHTML =
        (o.plat && !empty ? platHTML(o.plat) : '') +
        '<span class="' + (empty ? 'ph' : 'tx') + '">' + pretty(o.label) + '</span>';
    }

    function render(q) {
      q = (q || '').trim().toLowerCase();
      var terms = q ? q.split(/\s+/) : [];
      shown = opts.filter(function (o) {
        if (o.disabled) return false;
        return terms.every(function (t) { return o.search.indexOf(t) !== -1; });
      });
      var cut = shown.slice(0, 300);
      none.style.display = shown.length ? 'none' : 'block';
      list.innerHTML = cut.map(function (o) {
        var on = o.i === sel.selectedIndex;
        return '<div class="ksel-opt' + (on ? ' on' : '') + '" data-i="' + o.i + '" role="option">' +
          (o.plat && o.value !== '' ? platHTML(o.plat) : '') +
          '<span class="ksel-txt"><b>' + pretty(o.label) + '</b>' +
          (o.meta ? '<i>' + escape_(o.meta) + '</i>' : '') + '</span>' +
          (on ? '<svg class="ksel-tick" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" ' +
            'stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 5 5 9-10"/></svg>' : '') +
          '</div>';
      }).join('') +
        (shown.length > cut.length
          ? '<div class="ksel-more">Altri ' + (shown.length - cut.length) + ' risultati — affina la ricerca</div>'
          : '');
      active = -1;
    }

    function highlight(d) {
      var items = list.querySelectorAll('.ksel-opt');
      if (!items.length) return;
      if (active >= 0 && items[active]) items[active].classList.remove('hl');
      active = (active + d + items.length) % items.length;
      items[active].classList.add('hl');
      items[active].scrollIntoView({ block: 'nearest' });
    }

    function pick(i) {
      sel.selectedIndex = i;
      paintValue();
      close();
      sel.dispatchEvent(new Event('change', { bubbles: true }));
    }

    function open() {
      closeOpen();
      root.classList.add('open');
      render('');
      input.value = '';
      openMenu = { root: root };
      var r = btn.getBoundingClientRect();
      root.classList.toggle('up', window.innerHeight - r.bottom < 330 && r.top > 340);
      setTimeout(function () { input.focus(); }, 10);
      var cur = list.querySelector('.ksel-opt.on');
      if (cur) cur.scrollIntoView({ block: 'center' });
    }

    function close() {
      root.classList.remove('open');
      openMenu = null;
    }

    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      root.classList.contains('open') ? close() : open();
    });

    input.addEventListener('input', function () { render(input.value); });

    input.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowDown') { e.preventDefault(); highlight(1); }
      else if (e.key === 'ArrowUp') { e.preventDefault(); highlight(-1); }
      else if (e.key === 'Enter') {
        e.preventDefault();
        var items = list.querySelectorAll('.ksel-opt');
        var el = active >= 0 ? items[active] : items[0];
        if (el) pick(Number(el.dataset.i));
      } else if (e.key === 'Escape') { close(); btn.focus(); }
    });

    list.addEventListener('click', function (e) {
      var el = e.target.closest('.ksel-opt');
      if (el) pick(Number(el.dataset.i));
    });

    pop.addEventListener('click', function (e) { e.stopPropagation(); });

    paintValue();
  }

  /** Rifà il menu custom dopo che le opzioni della select sono cambiate. */
  function rebuildSelect(sel) {
    var root = sel.closest('.ksel-root');
    if (root) {
      root.parentNode.insertBefore(sel, root);
      root.remove();
    }
    delete sel.dataset.kdone;
    buildSelect(sel);
  }

  /** Piattaforma indovinata dal testo, per mostrare il logo giusto. */
  function platSlug(text) {
    var s = String(text).toLowerCase();
    var map = [['instagram', /instagram|reels/], ['tiktok', /tiktok|tik tok/],
      ['youtube', /youtube|yt|watch hour/], ['telegram', /telegram/],
      ['x', /twitter|tweet/], ['facebook', /facebook|fb/], ['spotify', /spotify/],
      ['whatsapp', /whatsapp/], ['twitch', /twitch/], ['kick', /kick/],
      ['linkedin', /linkedin/], ['reddit', /reddit/], ['tumblr', /tumblr/],
      ['vk', /vkontakte|vk/], ['discord', /discord/], ['snapchat', /snapchat|snap/],
      ['threads', /threads/], ['google', /google|maps/], ['pinterest', /pinterest/],
      ['soundcloud', /soundcloud/], ['trustpilot', /trustpilot/], ['applemusic', /apple/],
      ['kwai', /kwai/], ['likee', /likee/], ['seo', /traffic|backlink|seo/]];
    for (var i = 0; i < map.length; i++) if (map[i][1].test(s)) return map[i][0];
    return 'other';
  }

  document.addEventListener('click', closeOpen);
  KS.on(function () { document.querySelectorAll('select.ksel').forEach(buildSelect); });

  /* ---------- totale live nel form ordine ---------- */
  KS.on(function () {
    var qty = document.getElementById('qty');
    var out = document.getElementById('charge');
    if (qty && out) {
      var calc = function () {
        var rate = parseFloat(qty.dataset.rate || '0');
        var n = parseFloat(qty.value || '0');
        out.textContent = '$' + ((rate / 1000) * (isFinite(n) ? n : 0)).toFixed(4);
      };
      qty.addEventListener('input', calc);
      calc();
    }

    /* ---------- pulsanti rapidi quantità / importo ---------- */
    document.querySelectorAll('.qb').forEach(function (b) {
      b.addEventListener('click', function () {
        var t = b.dataset.q ? document.getElementById('qty') : document.getElementById('amt');
        if (!t) return;
        t.value = b.dataset.q || b.dataset.amt;
        t.dispatchEvent(new Event('input'));
        t.focus();
      });
    });
  });

  /* ---------- lingua: tengo localStorage allineato al cookie ---------- */
  (function () {
    var m = document.cookie.match(/(?:^|; )ks_lang=([a-z]{2})/);
    var cookie = m && m[1];
    var saved = null;
    try { saved = localStorage.getItem('krazysmm.lang'); } catch (e) {}
    if (cookie) {
      if (saved !== cookie) { try { localStorage.setItem('krazysmm.lang', cookie); } catch (e) {} }
    } else if (saved) {
      // prima visita su questo dispositivo dopo aver scelto la lingua altrove
      document.cookie = 'ks_lang=' + saved + ';path=/;max-age=31536000;samesite=lax';
      location.reload();
    }
  })();

  /* ---------- tema chiaro / scuro ---------- */
  var themeBtns = [].slice.call(document.querySelectorAll('.themebtn'));
  themeBtns.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var next = document.documentElement.dataset.theme === 'dark' ? 'light' : 'dark';
      document.documentElement.dataset.theme = next;
      try { localStorage.setItem('krazysmm.theme', next); } catch (e) {}
      var lbl = next === 'dark' ? 'Passa al tema chiaro' : 'Passa al tema scuro';
      themeBtns.forEach(function (b) { b.setAttribute('aria-label', lbl); });
    });
  });

  /* ---------- barra laterale: cursore sulla voce attiva ---------- */
  var nav = document.querySelector('.sidebar nav');
  if (nav) {
    var ind = nav.querySelector('.navind');
    var links = [].slice.call(nav.querySelectorAll('a'));
    var current = nav.querySelector('a.on');

    // il cursore segue solo la voce scelta, non il passaggio del mouse
    var moveTo = function (el) {
      if (!el || !ind) return;
      ind.style.height = el.offsetHeight + 'px';
      ind.style.transform = 'translateY(' + el.offsetTop + 'px)';
      ind.classList.add('ready');
    };
    var reset = function () {
      if (current) moveTo(current);
      else if (ind) ind.classList.remove('ready');
    };

    links.forEach(function (a) {
      a.addEventListener('click', function () {
        // scivola subito sulla voce cliccata, mentre la pagina carica
        links.forEach(function (o) { o.classList.remove('on'); });
        a.classList.add('on');
        current = a;
        moveTo(a);
        document.body.classList.remove('nav-open');
      });
    });

    if (current && ind) {                       // posizione iniziale senza animazione
      ind.style.transition = 'none';
      moveTo(current);
      requestAnimationFrame(function () { ind.style.transition = ''; });
    }
    window.addEventListener('resize', reset);

    // dopo un cambio pagina senza ricarica il cursore torna sulla voce giusta
    KS.navSync = function (href) {
      var match = null;
      links.forEach(function (a) {
        var on = a.getAttribute('href') === href;
        a.classList.toggle('on', on);
        if (on) match = a;
      });
      current = match;
      reset();
    };
  }

  /* ---------- barra laterale: apri / chiudi ---------- */
  var btnCollapse = document.querySelector('.collapse');
  if (btnCollapse) {
    var KEY = 'krazysmm.sidebar';
    try {
      if (localStorage.getItem(KEY) === '1') document.body.classList.add('collapsed');
    } catch (e) {}
    btnCollapse.addEventListener('click', function () {
      var on = document.body.classList.toggle('collapsed');
      try { localStorage.setItem(KEY, on ? '1' : '0'); } catch (e) {}
      btnCollapse.setAttribute('aria-label', on ? 'Espandi menu' : 'Riduci menu');
      if (typeof reset === 'function') setTimeout(reset, 340);
    });
  }

  /* ---------- homepage: calcolatore di prezzo ---------- */
  (function () {
    var sel = document.getElementById('calcSvc');
    var qty = document.getElementById('calcQty');
    var out = document.getElementById('calcOut');
    var note = document.getElementById('calcNote');
    var data = document.getElementById('calcData');
    if (!sel || !qty || !out) return;

    var T = {
      range: (data && data.dataset.range) || 'Min {min} — max {max}',
      bad: (data && data.dataset.bad) || 'Out of range: min {min}, max {max}.'
    };
    var fmt = function (s, mn, mx) {
      return s.replace('{min}', mn.toLocaleString()).replace('{max}', mx.toLocaleString());
    };

    function calc() {
      var o = sel.options[sel.selectedIndex];
      if (!o) return;
      var rate = parseFloat(o.dataset.rate || '0');
      var mn = parseInt(o.dataset.min || '1', 10);
      var mx = parseInt(o.dataset.max || '1', 10);
      var n = parseFloat(qty.value || '0');
      var ok = isFinite(n) && n >= mn && n <= mx;

      out.textContent = '$' + ((rate / 1000) * (isFinite(n) ? n : 0)).toFixed(4);
      out.classList.toggle('bad', !ok && !!qty.value);
      note.textContent = fmt(ok || !qty.value ? T.range : T.bad, mn, mx);
      note.classList.toggle('warn', !ok && !!qty.value);
    }

    sel.addEventListener('change', calc);
    qty.addEventListener('input', calc);
    calc();

    /* tutto il listino, caricato solo quando serve davvero */
    var full = sel.dataset.full;
    if (!full) return;
    var loading = false;

    async function loadAll() {
      if (loading) return;
      loading = true;
      try {
        var r = await fetch(full);
        var list = await r.json();
        if (!Array.isArray(list) || !list.length) return;

        var chosen = sel.value;
        var frag = document.createDocumentFragment();
        list.forEach(function (s) {
          var o = document.createElement('option');
          o.value = s.i;
          o.textContent = s.i + ' - ' + s.n;
          o.dataset.rate = s.r;
          o.dataset.min = s.a;
          o.dataset.max = s.b;
          o.dataset.plat = platSlug(s.c + ' ' + s.n);
          o.dataset.meta = '$' + Number(s.r).toFixed(4) + ' / 1000';
          frag.appendChild(o);
        });
        sel.innerHTML = '';
        sel.appendChild(frag);
        if ([].some.call(sel.options, function (o) { return o.value === chosen; })) sel.value = chosen;
        rebuildSelect(sel);
        calc();
      } catch (e) {
        loading = false;
      }
    }

    // al primo tocco sul calcolatore, appena entra in vista, o comunque dopo
    // qualche secondo: la pagina resta leggera ma il listino c'è sempre
    var box = sel.closest('.calc') || sel.parentElement;
    box.addEventListener('mousedown', loadAll, { once: true });
    box.addEventListener('focusin', loadAll, { once: true });
    if ('IntersectionObserver' in window) {
      var io2 = new IntersectionObserver(function (es) {
        if (es[0].isIntersecting) { loadAll(); io2.disconnect(); }
      });
      io2.observe(box);
    }
    setTimeout(loadAll, 3000);
  })();

  /* ---------- homepage: le sezioni compaiono salendo ---------- */
  (function () {
    if (!document.body.classList.contains('site')) return;
    var targets = document.querySelectorAll('.sec > h2, .sec > .lead, .pricecard, .step, .featcard, .faq details, .ctain, .calc');
    if (!targets.length || !('IntersectionObserver' in window)) return;
    if (matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    targets.forEach(function (el, i) {
      el.classList.add('rev');
      el.style.transitionDelay = ((i % 6) * 55) + 'ms';
    });

    var show = function (el) { el.classList.add('in'); };

    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (e) {
        if (e.isIntersecting) { show(e.target); io.unobserve(e.target); }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });
    targets.forEach(function (el) { io.observe(el); });

    // quello che è già sullo schermo si mostra subito, senza aspettare l'osservatore
    var onScreen = function () {
      targets.forEach(function (el) {
        var r = el.getBoundingClientRect();
        if (r.top < innerHeight * 0.95 && r.bottom > 0) show(el);
      });
    };
    onScreen();
    addEventListener('scroll', onScreen, { passive: true });

    // rete di sicurezza: se per qualsiasi motivo l'osservatore non scatta,
    // dopo qualche secondo il contenuto si mostra comunque
    setTimeout(function () {
      removeEventListener('scroll', onScreen);
      targets.forEach(show);
    }, 4000);
  })();

})();

/* ---------- chiave API: mostra e copia ---------- */
KS.on(function () {
  var el = document.getElementById('apiKey');
  var show = document.getElementById('keyShow');
  var copy = document.getElementById('keyCopy');
  if (!el) return;

  var open = false;
  if (show) {
    var showLabel = show.textContent.trim();
    var hideLabel = show.dataset.hide || showLabel;
    var icon = show.querySelector('svg');
    show.addEventListener('click', function () {
      open = !open;
      el.textContent = open ? el.dataset.key : '\u2022'.repeat(24);
      show.textContent = open ? hideLabel : showLabel;
      if (icon) show.insertBefore(icon, show.firstChild);
    });
  }
  if (copy) {
    copy.addEventListener('click', async function () {
      try { await navigator.clipboard.writeText(el.dataset.key); } catch (e) { return; }
      var before = copy.textContent;
      copy.textContent = copy.dataset.copied || 'OK';
      setTimeout(function () { copy.textContent = before; }, 1600);
    });
  }
});

/* ---------- ricarica: importo libero e pagamento in finestra ---------- */
KS.on(function () {
  var wrap = document.getElementById('ckwrap');
  if (!wrap) return;

  var frame = document.getElementById('ckFrame');
  var fall = document.getElementById('ckFall');
  var tab = document.getElementById('ckTab');
  var tab2 = document.getElementById('ckTab2');
  var bodyTxt = document.getElementById('ckBody');
  var amountLabel = document.getElementById('ckAmount');

  var form = document.getElementById('topForm');
  var input = document.getElementById('topAmount');
  var go = document.getElementById('topGo');
  var hint = document.querySelector('#topHint span');
  var discordLink = document.getElementById('topDiscord');
  var tgLink = document.getElementById('topTelegram');

  var T = {};
  try { T = JSON.parse(document.getElementById('topI18n').textContent); } catch (e) {}

  var min = Number(form.dataset.min) || 1;
  var max = Number(form.dataset.max) || 500;

  var watch = null, loads = 0;

  function close() {
    wrap.hidden = true;
    document.body.style.overflow = '';
    clearTimeout(watch);
    frame.src = 'about:blank';        // fermo il pagamento in sottofondo
  }
  document.getElementById('ckClose').addEventListener('click', close);
  document.getElementById('ckClose2').addEventListener('click', close);
  wrap.addEventListener('click', function (e) { if (e.target === wrap) close(); });
  // l'Esc si aggancia una volta sola: il riquadro lo ritrovo quando serve
  if (!window.__ksEsc) {
    window.__ksEsc = true;
    addEventListener('keydown', function (e) {
      if (e.key !== 'Escape') return;
      var w = document.getElementById('ckwrap');
      var btn = document.getElementById('ckClose');
      if (w && !w.hidden && btn) btn.click();
    });
  }

  /**
   * Il pagamento sta dentro al sito, in un riquadro.
   * Il negozio ha una verifica anti-bot che in un iframe puo' non passare e
   * far ricaricare la pagina in continuazione: se succede, o se il riquadro
   * resta vuoto, passiamo al link in una scheda nuova.
   */
  function toTab() {
    if (!fall.hidden) return;
    bodyTxt.textContent = T.frameBlocked || T.body || '';
    fall.hidden = false;
    frame.src = 'about:blank';
  }

  frame.addEventListener('load', function () {
    if (frame.src === 'about:blank') return;
    loads++;
    if (loads >= 4) toTab();          // ricarichi a raffica: verifica in loop
  });

  function openCheckout(url, amount) {
    loads = 0;
    fall.hidden = true;
    amountLabel.textContent = amount || '';
    tab.href = url;
    tab2.href = url;
    frame.src = url;
    wrap.hidden = false;
    document.body.style.overflow = 'hidden';

    clearTimeout(watch);
    watch = setTimeout(function () { if (!loads) toTab(); }, 15000);
  }

  function refresh() {
    var n = Math.round(Number(input.value));
    var ok = isFinite(n) && n >= min && n <= max;
    hint.textContent = ok ? (T.get || '').replace('{a}', String(n)) : (T.range || '');
    hint.parentElement.classList.toggle('warn', !ok && input.value !== '');
    if (discordLink) discordLink.hidden = true;
    if (tgLink) tgLink.hidden = true;
    go.disabled = !ok;
  }

  input.addEventListener('input', refresh);
  document.querySelectorAll('[data-top]').forEach(function (b) {
    b.addEventListener('click', function () { input.value = b.dataset.top; refresh(); input.focus(); });
  });

  form.addEventListener('submit', async function (e) {
    e.preventDefault();
    var n = Math.round(Number(input.value));
    if (!isFinite(n)) return;

    var before = go.textContent;
    go.disabled = true;
    go.textContent = T.opening || '...';

    try {
      var r = await fetch('/add-funds/checkout', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ amount: String(n) })
      });
      var data = await r.json();
      if (data.url) {
        openCheckout(data.url, '$' + n);
      } else {
        hint.textContent = data.error || T.range;
        hint.parentElement.classList.add('warn');
        if (discordLink) discordLink.hidden = !data.discord;
        if (tgLink) tgLink.hidden = !data.discord;
      }
    } catch (err) {
      hint.textContent = T.range;
      hint.parentElement.classList.add('warn');
    }
    go.disabled = false;
    go.textContent = before;
  });

  refresh();
});

/* ---------- barra del sito: da barra piena a pillola quando si scorre ---------- */
(function () {
  var bar = document.querySelector('body.site .sitebar');
  if (!bar) return;

  var ticking = false;
  function apply() {
    bar.classList.toggle('stuck', (window.scrollY || document.documentElement.scrollTop) > 12);
    ticking = false;
  }
  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(apply);
  }

  addEventListener('scroll', onScroll, { passive: true });
  addEventListener('resize', onScroll, { passive: true });
  apply();
})();

/* ---------- pannello: cambio pagina senza ricaricare il sito ---------- */

(function () {
  if (!document.body.classList.contains('app')) return;      // solo nel pannello
  if (!window.fetch || !window.history || !window.DOMParser) return;

  var main = document.querySelector('main.content');
  if (!main) return;

  var busy = false;

  /** Solo i link interni del pannello: il resto segue la sua strada. */
  function internal(a) {
    if (!a || a.target || a.hasAttribute('download')) return false;
    if (a.origin !== location.origin) return false;
    if (a.getAttribute('href').charAt(0) === '#') return false;
    if (/^\/(logout|lang|api\/)/.test(a.pathname)) return false;
    return true;
  }

  /** Copio dal documento nuovo i pezzi fuori da <main> che possono cambiare. */
  function syncShell(doc, url) {
    document.title = doc.title;

    var pairs = [['.ptitle', 'text'], ['.bal span', 'text'], ['.usercard .uinfo i', 'text']];
    pairs.forEach(function (p) {
      var to = document.querySelector(p[0]), from = doc.querySelector(p[0]);
      if (to && from) to.textContent = from.textContent;
    });

    // pallino dei ticket da leggere
    document.querySelectorAll('.sidebar nav a').forEach(function (a) {
      var same = doc.querySelector('.sidebar nav a[href="' + a.getAttribute('href') + '"]');
      var badge = a.querySelector('.nbadge');
      var next = same && same.querySelector('.nbadge');
      if (badge && !next) badge.remove();
      else if (badge && next) badge.textContent = next.textContent;
      else if (!badge && next) a.appendChild(next.cloneNode(true));
    });

    if (typeof KS.navSync === 'function') KS.navSync(new URL(url, location.href).pathname);
  }

  function go(url, push, quiet) {
    if (busy) return;
    busy = true;
    if (!quiet) document.body.classList.add('loading');
    var keepScroll = quiet ? window.scrollY : 0;

    fetch(url, { credentials: 'same-origin', headers: { 'X-Requested-With': 'ks' } })
      .then(function (r) {
        if (!r.ok && r.status !== 404) throw new Error(r.status);
        return r.text().then(function (html) { return { html: html, url: r.url || url }; });
      })
      .then(function (res) {
        var doc = new DOMParser().parseFromString(res.html, 'text/html');
        var next = doc.querySelector('main.content');
        // login, homepage o qualsiasi pagina diversa: la carico per intero
        if (!next || !doc.body.classList.contains('app')) {
          if (quiet) { busy = false; return; }
          location.href = res.url;
          return;
        }

        main.replaceWith(next);
        main = next;
        syncShell(doc, res.url);
        if (push) history.pushState({ ks: 1 }, '', res.url);
        window.scrollTo({ top: keepScroll, behavior: 'auto' });
        busy = false;
        document.body.classList.remove('loading');
        KS.init();                                   // riattivo i pezzi interni
      })
      .catch(function () {
        busy = false;
        document.body.classList.remove('loading');
        if (!quiet) location.href = url;
      });
  }

  /**
   * Pagine di sola lettura: i dati si aggiornano da soli, in silenzio,
   * senza far sobbalzare la pagina e senza toccare quello che stai scrivendo.
   */
  var LIVE = ['/dashboard', '/orders', '/tickets', '/admin', '/admin/tickets'];
  setInterval(function () {
    if (document.hidden || busy) return;
    if (LIVE.indexOf(location.pathname) < 0) return;

    var el = document.activeElement;
    if (el && /^(INPUT|TEXTAREA|SELECT)$/.test(el.tagName)) return;
    if (document.querySelector('.ksel-root.open')) return;
    var modal = document.getElementById('ckwrap');
    if (modal && !modal.hidden) return;

    go(location.href, false, true);
  }, 30000);

  document.addEventListener('click', function (e) {
    if (e.defaultPrevented || e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;
    var a = e.target.closest ? e.target.closest('a') : null;
    if (!internal(a)) return;
    e.preventDefault();
    if (a.href === location.href) return;
    go(a.href, true);
  });

  // i moduli inviati con GET (ricerche, filtri) restano nella stessa pagina
  document.addEventListener('submit', function (e) {
    var f = e.target;
    if (e.defaultPrevented) return;                 // se ne occupa gia' un altro script
    if (!f || f.method.toLowerCase() !== 'get') return;
    if (f.target || !f.getAttribute('action')) return;
    if (new URL(f.action).origin !== location.origin) return;
    if (f.closest('.site')) return;
    e.preventDefault();
    var u = new URL(f.action);
    u.search = new URLSearchParams(new FormData(f)).toString();
    go(u.href, true);
  });

  addEventListener('popstate', function () { go(location.href, false); });
  history.replaceState({ ks: 1 }, '', location.href);
})();
