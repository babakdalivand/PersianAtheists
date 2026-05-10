/**
 * Persian Atheists — Main JavaScript v1.0.0
 */
(function() {
  'use strict';

  /* DARK MODE */
  const html    = document.documentElement;
  const darkBtn = document.getElementById('darkModeToggle');

  function applyTheme(t) {
    html.setAttribute('data-theme', t);
    if (darkBtn) darkBtn.setAttribute('aria-label', t === 'dark' ? 'حالت روشن' : 'حالت تاریک');
  }

  if (darkBtn) {
    darkBtn.addEventListener('click', function() {
      const next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
      applyTheme(next);
      try { localStorage.setItem('pa_theme', next); } catch(e) {}
      if (typeof paData !== 'undefined') {
        fetch(paData.ajaxUrl, { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body: new URLSearchParams({ action:'pa_set_dark_mode', mode:next, nonce:paData.nonce }) });
      }
    });
  }

  try { const ls = localStorage.getItem('pa_theme'); if(ls) applyTheme(ls); } catch(e) {}

  /* TABS */
  document.addEventListener('click', function(e) {
    const btn = e.target.closest('.tab-btn');
    if (!btn) return;
    const wrap = btn.closest('.sidebar-widget') || btn.parentElement.parentElement;
    wrap.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    wrap.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    const pane = wrap.querySelector('#tab-' + btn.getAttribute('data-tab'));
    if (pane) pane.classList.add('active');
  });

  /* SEARCH */
  const searchBar = document.getElementById('headerSearchBar');
  document.querySelector('.search-toggle')?.addEventListener('click', () => {
    searchBar?.classList.toggle('open');
    if (searchBar?.classList.contains('open')) setTimeout(() => searchBar.querySelector('.search-input')?.focus(), 100);
  });
  document.getElementById('searchClose')?.addEventListener('click', () => searchBar?.classList.remove('open'));

  /* MOBILE MENU */
  const overlay = document.getElementById('mobileNavOverlay');
  document.getElementById('mobileMenuToggle')?.addEventListener('click', () => { overlay?.classList.add('open'); document.body.style.overflow='hidden'; });
  document.getElementById('mobileNavClose')?.addEventListener('click', () => { overlay?.classList.remove('open'); document.body.style.overflow=''; });
  overlay?.addEventListener('click', e => { if(e.target===overlay){ overlay.classList.remove('open'); document.body.style.overflow=''; } });

  /* LANGUAGE DROPDOWN */
  const langBtn  = document.querySelector('#langSwitch .lang-btn');
  const langDrop = document.querySelector('#langSwitch .lang-dropdown');
  langBtn?.addEventListener('click', e => { e.stopPropagation(); langDrop.style.display = langDrop.style.display==='block'?'none':'block'; });
  document.addEventListener('click', () => { if(langDrop) langDrop.style.display='none'; });

  /* ESC KEY */
  document.addEventListener('keydown', e => { if(e.key==='Escape'){ searchBar?.classList.remove('open'); overlay?.classList.remove('open'); document.body.style.overflow=''; } });

  /* MEMBERSHIP FORM */
  function bindMemberForm(formEl) {
    if (!formEl) return;
    formEl.addEventListener('submit', function(e) {
      e.preventDefault();
      const msgEl = formEl.querySelector('[id$="memberFormMsg"], .form-message');
      const btn   = formEl.querySelector('[type="submit"]');
      if (msgEl && !formEl.querySelector('[name="consent"]')?.checked) {
        return showMsg(msgEl, 'لطفاً با قوانین گروه موافقت کنید.', 'error');
      }
      if (btn) { btn.disabled=true; btn.textContent='در حال ارسال...'; }
      const fd = new FormData(formEl);
      fd.append('action','pa_membership_submit');
      if (typeof paData!=='undefined') fd.append('nonce', paData.nonce);
      fetch(typeof paData!=='undefined'?paData.ajaxUrl:'/wp-admin/admin-ajax.php', { method:'POST', body:fd })
        .then(r=>r.json())
        .then(data => {
          if (msgEl) showMsg(msgEl, data.success ? (data.data?.message||'درخواست ثبت شد!') : (data.data?.message||'خطایی رخ داد.'), data.success?'success':'error');
          if (data.success) formEl.reset();
        })
        .catch(()=>{ if(msgEl) showMsg(msgEl,'خطا در ارتباط با سرور.','error'); })
        .finally(()=>{ if(btn){btn.disabled=false;btn.textContent='ارسال درخواست';} });
    });
  }

  function showMsg(el, text, type) {
    el.textContent=text; el.style.display='block';
    el.style.cssText += ';background:'+(type==='success'?'rgba(34,197,94,0.1)':'rgba(239,68,68,0.1)')+';color:'+(type==='success'?'#16a34a':'#dc2626')+';border:1px solid '+(type==='success'?'#86efac':'#fca5a5');
  }

  bindMemberForm(document.getElementById('sidebarMemberForm'));
  bindMemberForm(document.getElementById('fullMembershipForm'));

  /* SCROLL ANIMATIONS */
  if ('IntersectionObserver' in window) {
    const io = new IntersectionObserver(entries => entries.forEach(e => { if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target);} }), {threshold:0.1});
    document.querySelectorAll('.constitution-section').forEach(el => io.observe(el));
  }

  /* STICKY HEADER */
  const header  = document.getElementById('site-header');
  let lastScroll = 0;
  window.addEventListener('scroll', () => {
    const y = window.scrollY;
    if(header){ header.classList.toggle('scrolled',y>50); header.classList.toggle('hidden',y>lastScroll&&y>150); }
    lastScroll=y;
  }, {passive:true});

  /* SMOOTH ANCHOR */
  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', function(e) {
      const el = document.getElementById(this.getAttribute('href').slice(1));
      if(el){ e.preventDefault(); window.scrollTo({top:el.getBoundingClientRect().top+window.scrollY-(header?.offsetHeight||80+16),behavior:'smooth'}); }
    });
  });

  /* FILE UPLOAD FEEDBACK */
  document.querySelectorAll('.upload-area input[type="file"]').forEach(inp => {
    inp.addEventListener('change', function() {
      const lbl = this.closest('.upload-area')?.querySelector('div:nth-child(2)');
      if(lbl && this.files[0]){ lbl.textContent=this.files[0].name; lbl.style.color='var(--accent)'; }
    });
  });

})();
