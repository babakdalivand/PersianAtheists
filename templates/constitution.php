<?php
/**
 * Template Name: Constitution
 * @package persian-atheists
 */

get_header();
?>

<main id="main-content" role="main">
  <div class="constitution-page">

    <!-- Page Header -->
    <header class="page-header">
      <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(212,160,23,0.1);border:1px solid rgba(212,160,23,0.3);border-radius:99px;padding:6px 18px;margin-bottom:20px">
        <svg width="14" height="14" fill="none" stroke="var(--accent)" stroke-width="2" viewBox="0 0 24 24">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
        </svg>
        <span style="font-size:13px;font-weight:600;color:var(--accent)"><?php esc_html_e( 'سند رسمی', 'persian-atheists' ); ?></span>
      </div>
      <h1 class="page-title"><?php esc_html_e( 'اساسنامه گروه', 'persian-atheists' ); ?></h1>
      <p class="text-muted" style="font-size:18px;max-width:580px;margin:16px auto 0">
        <?php esc_html_e( 'این اساسنامه چارچوب اصول، ارزش‌ها و قوانین فعالیت گروه آتئیست‌های ایرانی را تعریف می‌کند.', 'persian-atheists' ); ?>
      </p>
    </header>

    <!-- Table of Contents -->
    <nav class="toc" style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-lg);padding:var(--space-5);margin-bottom:var(--space-8)" aria-label="<?php esc_attr_e( 'Table of Contents', 'persian-atheists' ); ?>">
      <h2 style="font-size:16px;margin-bottom:12px;color:var(--accent)"><?php esc_html_e( 'فهرست مطالب', 'persian-atheists' ); ?></h2>
      <ol style="padding:0;list-style:none;display:flex;flex-direction:column;gap:8px">
        <?php
        $sections = [
          '1' => 'مقدمه',
          '2' => 'اصول بنیادین',
          '3' => 'عضویت در گروه',
          '4' => 'قوانین و مقررات',
          '5' => 'اصلاح اساسنامه',
        ];
        foreach ( $sections as $num => $title ) :
        ?>
        <li>
          <a href="#section-<?php echo esc_attr( $num ); ?>"
             style="display:flex;align-items:center;gap:10px;font-size:14px;font-weight:600;color:var(--text-muted);text-decoration:none;padding:6px 0;border-bottom:1px solid var(--border);transition:color 0.2s">
            <span style="width:24px;height:24px;background:var(--bg);border:1px solid var(--border);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;flex-shrink:0">
              <?php echo esc_html( $num ); ?>
            </span>
            <?php echo esc_html( $title ); ?>
          </a>
        </li>
        <?php endforeach; ?>
      </ol>
    </nav>

    <!-- If page has custom content, show it. Otherwise show default structure. -->
    <?php if ( have_posts() ) : the_post(); ?>
    <?php if ( get_the_content() ) : ?>
      <div class="entry-content" style="font-size:16px;line-height:2;color:var(--text-muted)">
        <?php the_content(); ?>
      </div>
    <?php else : ?>

    <!-- Default Constitution Content -->
    <div class="constitution-sections">

      <div class="constitution-section" id="section-1">
        <div class="section-number"><?php esc_html_e( 'بخش اول', 'persian-atheists' ); ?></div>
        <h2><?php esc_html_e( 'مقدمه', 'persian-atheists' ); ?></h2>
        <p><?php esc_html_e( 'این گروه برای ترویج اندیشه آزاد، خردگرایی و تفکر انتقادی تأسیس شده است. ما باور داریم که هر انسانی حق دارد بدون ترس از آزار، عقیده خود را ابراز کند. این اساسنامه چارچوب اصول، ارزش‌ها و قوانین فعالیت گروه را تعریف می‌کند. ما متعهد به حمایت از حقوق بشر و احترام به تنوع انسانی هستیم.', 'persian-atheists' ); ?></p>
      </div>

      <div class="constitution-section" id="section-2">
        <div class="section-number"><?php esc_html_e( 'بخش دوم', 'persian-atheists' ); ?></div>
        <h2><?php esc_html_e( 'اصول بنیادین', 'persian-atheists' ); ?></h2>
        <p><?php esc_html_e( 'آزادی اندیشه: هر کدام از اعضا حق دارد آزادانه اندیشه خود را بیان کند. اسکپتیسیسم: احترام به روش علمی و تفکر انتقادی در تمام جنبه‌های زندگی. انسان‌گرایی: احترام به کرامت انسانی و حقوق بشر بدون تبعیض. سکولاریسم: حمایت از جدایی دین از دولت به عنوان اصلی اساسی.', 'persian-atheists' ); ?></p>
      </div>

      <div class="constitution-section" id="section-3">
        <div class="section-number"><?php esc_html_e( 'بخش سوم', 'persian-atheists' ); ?></div>
        <h2><?php esc_html_e( 'عضویت در گروه', 'persian-atheists' ); ?></h2>
        <p><?php esc_html_e( 'عضویت در این گروه داوطلبانه است و پس از بررسی دقیق درخواست و مصاحبه انجام می‌شود. اعضا باید اصول اساسنامه را بپذیرند و به قوانین گروه پایبند باشند. هیچ‌گونه اعضویت اتوماتیک وجود ندارد و هر درخواست توسط تیم مدیریت به صورت دستی بررسی می‌شود.', 'persian-atheists' ); ?></p>
      </div>

      <div class="constitution-section" id="section-4">
        <div class="section-number"><?php esc_html_e( 'بخش چهارم', 'persian-atheists' ); ?></div>
        <h2><?php esc_html_e( 'قوانین و مقررات', 'persian-atheists' ); ?></h2>
        <p><?php esc_html_e( 'اعضا موظفند به یکدیگر احترام بگذارند. هیچ‌گونه خشونت کلامی، آزار یا تبعیض پذیرفته نیست. محتوای منتشر شده باید با اصول گروه مطابقت داشته باشد. اعضایی که قوانین را نقض کنند، پس از اخطار از گروه اخراج خواهند شد.', 'persian-atheists' ); ?></p>
      </div>

      <div class="constitution-section" id="section-5">
        <div class="section-number"><?php esc_html_e( 'بخش پنجم', 'persian-atheists' ); ?></div>
        <h2><?php esc_html_e( 'اصلاح اساسنامه', 'persian-atheists' ); ?></h2>
        <p><?php esc_html_e( 'تغییرات این اساسنامه نیازمند تأیید اکثریت مطلق اعضای اصلی گروه است. پیشنهادات اصلاح باید حداقل ۳۰ روز قبل از رأی‌گیری به اعضا ارائه شود. هرگونه تغییر در اصول اساسی، نیازمند اجماع کامل است.', 'persian-atheists' ); ?></p>
      </div>

    </div>

    <?php endif; ?>
    <?php endif; ?>

    <!-- Download / Version Info -->
    <div style="margin-top:var(--space-10);padding:var(--space-6);background:var(--surface);border:1px solid var(--border);border-radius:var(--radius-lg);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px">
      <div>
        <p style="font-weight:700;margin-bottom:4px"><?php esc_html_e( 'نسخه اساسنامه', 'persian-atheists' ); ?></p>
        <p class="text-muted text-sm"><?php esc_html_e( 'نسخه ۱.۰ — آخرین ویرایش', 'persian-atheists' ); ?></p>
      </div>
      <a href="<?php echo esc_url( home_url( '/membership/' ) ); ?>" class="btn btn-primary">
        <?php esc_html_e( 'درخواست عضویت', 'persian-atheists' ); ?>
      </a>
    </div>

  </div><!-- .constitution-page -->
</main>

<?php
get_template_part( 'parts/footer' );
wp_footer();
?>
