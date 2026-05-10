<?php
/**
 * Sidebar — News RSS + Recommended + Twitter + Constitution Preview + Membership Form
 */
?>

<!-- NEWS FEED -->
<div class="sidebar-widget">
    <div class="sidebar-widget-title">📰 <?php esc_html_e( 'آخرین اخبار', 'persian-atheists' ); ?></div>
    <div class="sidebar-widget-body" style="padding:0;">

        <div class="tabs" style="padding:0 14px;">
            <button class="tab-btn active" data-tab="politics"><?php esc_html_e( 'سیاسی و حقوق بشر', 'persian-atheists' ); ?></button>
            <button class="tab-btn" data-tab="science"><?php esc_html_e( 'علمی و تکنولوژی', 'persian-atheists' ); ?></button>
        </div>

        <div class="tab-pane active" id="tab-politics" style="padding:0 14px 14px;">
            <?php
            $pol_feeds = [
                [ 'url' => 'https://feeds.bbci.co.uk/persian/rss.xml', 'name' => 'BBC فارسی', 'icon' => 'B' ],
                [ 'url' => 'https://www.radiofarda.com/api/zpozbrrxiz', 'name' => 'رادیو فردا', 'icon' => 'R' ],
            ];
            foreach ( $pol_feeds as $feed ) {
                $rss = @fetch_feed( $feed['url'] );
                if ( ! is_wp_error( $rss ) ) {
                    foreach ( $rss->get_items( 0, 3 ) as $item ) { ?>
                        <div class="news-item">
                            <div style="width:26px;height:26px;border-radius:50%;background:var(--accent);display:flex;align-items:center;justify-content:center;color:#fff;font-size:10px;font-weight:700;flex-shrink:0;"><?php echo esc_html( $feed['icon'] ); ?></div>
                            <div>
                                <div class="news-item-text"><a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" rel="noopener" style="color:inherit;"><?php echo esc_html( wp_trim_words( $item->get_title(), 12, '...' ) ); ?></a></div>
                                <div class="news-item-meta"><?php echo esc_html( $feed['name'] ); ?> · <?php echo esc_html( $item->get_date( 'j M Y' ) ); ?></div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo '<div class="news-item"><div style="font-size:12px;color:var(--muted);">' . esc_html( $feed['name'] ) . ' — در دسترس نیست</div></div>';
                }
            }
            ?>
        </div>

        <div class="tab-pane" id="tab-science" style="padding:0 14px 14px;">
            <?php
            $sci_feeds = [
                [ 'url' => 'https://www.nature.com/nature.rss', 'name' => 'Nature', 'icon' => 'N' ],
                [ 'url' => 'https://feeds.arstechnica.com/arstechnica/science', 'name' => 'Ars Technica', 'icon' => 'A' ],
            ];
            foreach ( $sci_feeds as $feed ) {
                $rss = @fetch_feed( $feed['url'] );
                if ( ! is_wp_error( $rss ) ) {
                    foreach ( $rss->get_items( 0, 3 ) as $item ) { ?>
                        <div class="news-item">
                            <div style="width:26px;height:26px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:10px;font-weight:700;flex-shrink:0;"><?php echo esc_html( $feed['icon'] ); ?></div>
                            <div>
                                <div class="news-item-text"><a href="<?php echo esc_url( $item->get_permalink() ); ?>" target="_blank" rel="noopener" style="color:inherit;"><?php echo esc_html( wp_trim_words( $item->get_title(), 12, '...' ) ); ?></a></div>
                                <div class="news-item-meta"><?php echo esc_html( $feed['name'] ); ?></div>
                            </div>
                        </div>
                    <?php }
                } else {
                    echo '<div class="news-item"><div style="font-size:12px;color:var(--muted);">' . esc_html( $feed['name'] ) . ' — در دسترس نیست</div></div>';
                }
            }
            ?>
        </div>

        <div style="padding:0 14px 14px;">
            <a href="<?php echo esc_url( home_url( '/news' ) ); ?>" class="view-all" style="display:block;text-align:center;"><?php esc_html_e( 'مشاهده همه اخبار', 'persian-atheists' ); ?></a>
        </div>
    </div>
</div>

<!-- RECOMMENDED ARTICLES -->
<div class="sidebar-widget">
    <div class="sidebar-widget-title">⭐ <?php esc_html_e( 'مطالب منتخب', 'persian-atheists' ); ?></div>
    <div class="sidebar-widget-body" style="padding:0;">
        <?php
        $rq = new WP_Query( [ 'post_type' => 'post', 'posts_per_page' => 4, 'orderby' => 'comment_count', 'post_status' => 'publish' ] );
        while ( $rq->have_posts() ) : $rq->the_post(); ?>
            <a href="<?php the_permalink(); ?>" style="display:flex;gap:10px;padding:10px 14px;border-bottom:1px solid var(--border);text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='var(--bg)'" onmouseout="this.style.background='transparent'">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div style="flex-shrink:0;width:60px;height:60px;border-radius:6px;overflow:hidden;">
                        <?php the_post_thumbnail( 'pa-square', [ 'style' => 'width:100%;height:100%;object-fit:cover;' ] ); ?>
                    </div>
                <?php endif; ?>
                <div>
                    <div style="font-size:13px;font-weight:600;color:var(--text);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;"><?php the_title(); ?></div>
                    <div style="font-size:11px;color:var(--muted);margin-top:4px;"><?php the_author(); ?> · <?php pa_time_ago(); ?></div>
                </div>
            </a>
        <?php endwhile; wp_reset_postdata(); ?>
        <div style="padding:10px 14px;">
            <a href="<?php echo esc_url( home_url( '/articles' ) ); ?>" class="view-all" style="display:block;text-align:center;"><?php esc_html_e( 'مشاهده همه', 'persian-atheists' ); ?></a>
        </div>
    </div>
</div>

<!-- TWITTER/X FEED -->
<div class="sidebar-widget">
    <div class="sidebar-widget-title">𝕏 <?php esc_html_e( 'آخرین توییت‌ها', 'persian-atheists' ); ?></div>
    <div class="sidebar-widget-body">
        <?php
        $tweets = [
            [ 'name' => 'Iranian Atheists', 'handle' => '@IranAtheists', 'text' => 'سکولاریسم کامل‌ترین و نهایی‌ترین گام برای آزادی و اصلاح اجتماعی است.', 'time' => '۲ ساعت پیش', 'av' => 'A' ],
            [ 'name' => 'Arash',            'handle' => '@ArashAtheist',  'text' => 'آزاداندیشی، شک‌گرایی و اومانیسم ریشه‌های مشترکی دارند که در آن‌ها می‌توان بهترین بستر برای رشد انسان را یافت.', 'time' => '۳ ساعت پیش', 'av' => 'A' ],
            [ 'name' => 'Mina',             'handle' => '@MinaAtheiss',   'text' => 'علم بزرگترین ابزار برای فهم جهان واقعی و ساختن آینده‌ای بهتر است.', 'time' => '۴ ساعت پیش', 'av' => 'M' ],
        ];
        foreach ( $tweets as $t ) : ?>
            <div style="padding:10px 0;border-bottom:1px solid var(--border);">
                <div style="display:flex;gap:8px;align-items:center;margin-bottom:6px;">
                    <div style="width:28px;height:28px;border-radius:50%;background:var(--primary);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:12px;font-weight:700;flex-shrink:0;"><?php echo esc_html( $t['av'] ); ?></div>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:var(--text);"><?php echo esc_html( $t['name'] ); ?></div>
                        <div style="font-size:11px;color:var(--muted);"><?php echo esc_html( $t['handle'] ); ?></div>
                    </div>
                </div>
                <p style="font-size:13px;color:var(--text);line-height:1.6;"><?php echo esc_html( $t['text'] ); ?></p>
                <div style="font-size:11px;color:var(--muted);margin-top:5px;"><?php echo esc_html( $t['time'] ); ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- CONSTITUTION PREVIEW -->
<div class="sidebar-widget">
    <div class="sidebar-widget-title">📜 <?php esc_html_e( 'اساسنامه گروه', 'persian-atheists' ); ?></div>
    <div class="sidebar-widget-body">
        <?php
        $toc = [
            [ 'n' => '۱', 't' => 'مقدمه' ],
            [ 'n' => '۲', 't' => 'اصول بنیادین' ],
            [ 'n' => '۳', 't' => 'عضویت در گروه' ],
            [ 'n' => '۴', 't' => 'قوانین و مقررات' ],
            [ 'n' => '۵', 't' => 'اصلاح اساسنامه' ],
        ];
        foreach ( $toc as $s ) : ?>
            <a href="<?php echo esc_url( home_url( '/constitution#section-' . $s['n'] ) ); ?>" class="toc-item">
                <div class="toc-num"><?php echo esc_html( $s['n'] ); ?></div>
                <div class="toc-label"><?php echo esc_html( $s['t'] ); ?></div>
            </a>
        <?php endforeach; ?>
        <a href="<?php echo esc_url( home_url( '/constitution' ) ); ?>" class="btn btn-outline" style="width:100%;justify-content:center;margin-top:14px;"><?php esc_html_e( 'مطالعه کامل', 'persian-atheists' ); ?></a>
    </div>
</div>

<!-- MEMBERSHIP MINI FORM -->
<div class="sidebar-widget">
    <div class="sidebar-widget-title">👥 <?php esc_html_e( 'عضویت در گروه (دنیای واقعی)', 'persian-atheists' ); ?></div>
    <div class="sidebar-widget-body">
        <p style="font-size:13px;color:var(--muted);margin-bottom:14px;"><?php esc_html_e( 'فرم درخواست عضویت. پس از بررسی با شما تماس خواهیم گرفت.', 'persian-atheists' ); ?></p>
        <form id="sidebarMemberForm">
            <?php wp_nonce_field( 'pa_membership_submit', 'pa_membership_nonce' ); ?>
            <div class="form-group"><input type="text" name="full_name" class="form-control" placeholder="<?php esc_attr_e( 'نام کامل *', 'persian-atheists' ); ?>" required></div>
            <div class="form-group"><input type="text" name="username" class="form-control" placeholder="<?php esc_attr_e( 'نام کاربری *', 'persian-atheists' ); ?>" required></div>
            <div class="form-group"><input type="email" name="email" class="form-control" placeholder="<?php esc_attr_e( 'ایمیل *', 'persian-atheists' ); ?>" required></div>
            <div class="form-group">
                <select name="country" class="form-control" required>
                    <option value=""><?php esc_html_e( 'کشور *', 'persian-atheists' ); ?></option>
                    <option value="IR"><?php esc_html_e( 'ایران', 'persian-atheists' ); ?></option>
                    <option value="DE"><?php esc_html_e( 'آلمان', 'persian-atheists' ); ?></option>
                    <option value="GB"><?php esc_html_e( 'انگلستان', 'persian-atheists' ); ?></option>
                    <option value="US"><?php esc_html_e( 'آمریکا', 'persian-atheists' ); ?></option>
                    <option value="SE"><?php esc_html_e( 'سوئد', 'persian-atheists' ); ?></option>
                    <option value="CA"><?php esc_html_e( 'کانادا', 'persian-atheists' ); ?></option>
                    <option value="NL"><?php esc_html_e( 'هلند', 'persian-atheists' ); ?></option>
                    <option value="other"><?php esc_html_e( 'سایر', 'persian-atheists' ); ?></option>
                </select>
            </div>
            <div class="form-group"><input type="number" name="age" class="form-control" placeholder="<?php esc_attr_e( 'سن *', 'persian-atheists' ); ?>" min="16" max="100" required></div>
            <div class="form-group"><input type="url" name="social_link" class="form-control" placeholder="<?php esc_attr_e( 'لینک شبکه اجتماعی (اختیاری)', 'persian-atheists' ); ?>"></div>
            <div class="form-group">
                <div class="upload-area" onclick="this.querySelector('input').click()">
                    <div style="font-size:28px;margin-bottom:6px;">📎</div>
                    <div style="font-size:12px;color:var(--muted);"><?php esc_html_e( 'آپلود تصویر شناسایی (اختیاری)', 'persian-atheists' ); ?></div>
                    <input type="file" name="id_upload" accept=".jpg,.jpeg,.png,.pdf" style="display:none;" onchange="this.parentElement.querySelector('div:nth-child(2)').textContent=this.files[0]?.name||'آپلود تصویر شناسایی'">
                </div>
            </div>
            <div class="form-group">
                <label class="form-check">
                    <input type="checkbox" name="consent" required>
                    <span><?php esc_html_e( '* با قوانین و شرایط گروه موافقم', 'persian-atheists' ); ?></span>
                </label>
            </div>
            <div id="memberFormMsg" style="display:none;padding:10px;border-radius:6px;font-size:13px;margin-bottom:10px;"></div>
            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;"><?php esc_html_e( 'ارسال درخواست', 'persian-atheists' ); ?></button>
        </form>
    </div>
</div>
