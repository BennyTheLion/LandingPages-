<?php
/**
 * Template Name: DJ Landing Page
 * Description: Professional DJ landing page for WordPress
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
    <meta name="description" content="DJ מקצועי לחתונות ואירועים עם ניסיון של 30 שנה. התמחות בכל סגנונות המוזיקה. DJ ארז גולד - ההופעה שלכם, החלום שלנו.">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700;800&family=Assistant:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <!-- Header -->
    <header class="header">
        <nav class="nav container">
            <a href="<?php echo home_url(); ?>" class="logo">DJ ארז גולד</a>
            <ul class="nav-links">
                <li><a href="#about">אודות</a></li>
                <li><a href="#services">שירותים</a></li>
                <li><a href="#contact">יצירת קשר</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>DJ מקצועי לחתונות, אירועים וחגיגות</h1>
                <p class="subtitle">עם ניסיון של 30 שנה על העמדה</p>
                <p class="description">
                    מחפש DJ שירקיד את הקהל בלי הפסקה ויבין בדיוק מה אתם רוצים לשמוע?<br>
                    נעים להכיר – אני DJ עם ניסיון של מעל 30 שנה, מתמחה בכל סגנונות המוזיקה
                </p>
                <div class="cta-buttons">
                    <a href="#contact" class="btn btn-primary">
                        <i class="fas fa-phone"></i>
                        בואו נתחיל!
                    </a>
                    <a href="https://wa.me/972522648094" class="btn btn-secondary" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        וואטסאפ
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about scroll-reveal" id="about">
        <div class="container">
            <h2 class="section-title">למה לבחור בי?</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>עם התמחות מיוחדת בסטים מעורבים של מיינסטרים, קלאסיקות, מזרחית, לועזית, אלקטרונית, ישראלית ועוד – בהתאמה מלאה לאופי הקהל ולרצון הלקוח.</p>
                    
                    <p>כל אירוע הוא עולם בפני עצמו, ואני כאן כדי לדייק אותו – מהשיר הראשון ועד השיר האחרון.</p>
                    
                    <p><strong>הקהל לא מפסיק לרקוד – ואתם לא מפסיקים לחייך.</strong></p>
                    
                    <p>בואו נבנה יחד את הפלייליסט הכי טוב של החיים שלכם.</p>
                </div>
                <div class="about-image">
                    <?php 
                    // Try to get the featured image or use a default
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('large', array('alt' => 'DJ ארז גולד', 'style' => 'max-width: 400px; height: 400px; object-fit: cover;'));
                    } else {
                        // Use the uploaded image if available
                        $upload_dir = wp_upload_dir();
                        $image_path = $upload_dir['baseurl'] . '/dj-erez-gold.jpg';
                        echo '<img src="' . esc_url($image_path) . '" alt="DJ ארז גולד" style="max-width: 400px; height: 400px; object-fit: cover;">';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features scroll-reveal">
        <div class="container">
            <h2 class="section-title">מה אני מביא לאירוע שלכם?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-medal"></i>
                    </div>
                    <h3 class="feature-title">ניסיון עשיר בכל סוגי האירועים</h3>
                    <p>30 שנות ניסיון בתחום, עבודה עם מגוון רחב של לקוחות ואירועים</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="feature-title">התאמה אישית לכל זוג וקהל</h3>
                    <p>הבנה עמוקה של הצרכים האישיים ויצירת חוויה מותאמת אישית</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-music"></i>
                    </div>
                    <h3 class="feature-title">שליטה רחבה במוזיקה מכל הזמנים</h3>
                    <p>ידע מוזיקלי עשיר בכל הסגנונות - מקלאסיקות ועד החדשות ביותר</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-fire"></i>
                    </div>
                    <h3 class="feature-title">אנרגיה ומקצועיות</h3>
                    <p>אהבה אמיתית למוזיקה ולרגעים שלכם, עם גישה מקצועית ברמה הגבוהה ביותר</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services scroll-reveal" id="services">
        <div class="container">
            <div class="services-content">
                <h2 class="section-title">השירות שלי</h2>
                <h3>DJ מקצועי לחתונות, אירועים וחגיגות</h3>
                <p>אני מציע שירות מקצועי ומותאם אישית לכל סוג אירוע. עם ציוד מתקדם, מערכת הגברה איכותית, ותכנון מוזיקלי מדויק שיבטיח שהקהל שלכם יהיה על הרחבה כל הערב.</p>
                
                <p>השירות כולל התייעצות מוקדמת, הכנת פלייליסט מותאם, הגעה מוקדמת להתקנה, וליווי מקצועי לאורך כל האירוע.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact scroll-reveal" id="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h3>בואו ניצור קשר!</h3>
                    <p>מוכנים לתכנן את האירוע המושלם? אני כאן בשבילכם!</p>
                    
                    <div class="contact-methods">
                        <div class="contact-method">
                            <i class="fas fa-phone"></i>
                            <a href="tel:+972522648094">052-2648094</a>
                        </div>
                        <div class="contact-method">
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/972522648094" target="_blank">שלחו הודעה בוואטסאפ</a>
                        </div>
                        <div class="contact-method">
                            <i class="fab fa-facebook"></i>
                            <a href="https://www.facebook.com/share/19CKXU9HWC/" target="_blank">עמוד הפייסבוק</a>
                        </div>
                        <div class="contact-method">
                            <i class="fab fa-instagram"></i>
                            <a href="https://www.instagram.com/djerezgold?utm_source=qr&igsh=MWx3ODAwYmJ1Mno2dg==" target="_blank">עקבו באינסטגרם</a>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="https://www.facebook.com/share/19CKXU9HWC/" target="_blank" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.instagram.com/djerezgold?utm_source=qr&igsh=MWx3ODAwYmJ1Mno2dg==" target="_blank" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://wa.me/972522648094" target="_blank" class="social-link">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="tel:+972522648094" class="social-link">
                            <i class="fas fa-phone"></i>
                        </a>
                    </div>
                </div>
                <div class="contact-form">
                    <h3>שלחו לי הודעה</h3>
                    <?php 
                    // WordPress contact form - you can replace this with Contact Form 7 or any other form plugin
                    if (function_exists('wpcf7_contact_form')) {
                        echo do_shortcode('[contact-form-7 id="1" title="DJ Contact Form"]');
                    } else {
                        // Fallback HTML form
                    ?>
                    <form class="contact-form-element" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
                        <?php wp_nonce_field('dj_contact_form', 'dj_contact_nonce'); ?>
                        <input type="hidden" name="action" value="dj_contact_form">
                        
                        <div class="form-group">
                            <input type="text" name="full_name" placeholder="שם מלא" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="טלפון" required>
                        </div>
                        <div class="form-group">
                            <input type="date" name="event_date" placeholder="תאריך האירוע">
                        </div>
                        <div class="form-group">
                            <select name="event_type">
                                <option value="">סוג האירוע</option>
                                <option value="wedding">חתונה</option>
                                <option value="bar_bat_mitzvah">בר/בת מצווה</option>
                                <option value="birthday">יום הולדת</option>
                                <option value="corporate">אירוע חברה</option>
                                <option value="other">אחר</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="additional_info" placeholder="פרטים נוספים" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">שלח הודעה</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/972522648094" target="_blank" class="whatsapp-float">
        <i class="fab fa-whatsapp"></i>
    </a>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> DJ ארז גולד. כל הזכויות שמורות.</p>
            <p>אתר מקצועי לשירותי DJ - חתונות, אירועים וחגיגות</p>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>

<?php
// Handle form submission
add_action('admin_post_dj_contact_form', 'handle_dj_contact_form');
add_action('admin_post_nopriv_dj_contact_form', 'handle_dj_contact_form');

function handle_dj_contact_form() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['dj_contact_nonce'], 'dj_contact_form')) {
        wp_die('Security check failed');
    }

    // Get form data
    $full_name = sanitize_text_field($_POST['full_name']);
    $phone = sanitize_text_field($_POST['phone']);
    $event_date = sanitize_text_field($_POST['event_date']);
    $event_type = sanitize_text_field($_POST['event_type']);
    $additional_info = sanitize_textarea_field($_POST['additional_info']);

    // Email content
    $subject = 'הודעה חדשה מאתר DJ ארז גולד';
    $message = "
        שם מלא: {$full_name}
        טלפון: {$phone}
        תאריך האירוע: {$event_date}
        סוג האירוע: {$event_type}
        פרטים נוספים: {$additional_info}
    ";

    // Send email (replace with actual email)
    $admin_email = get_option('admin_email');
    wp_mail($admin_email, $subject, $message);

    // Redirect back with success message
    wp_redirect(add_query_arg('message', 'success', wp_get_referer()));
    exit;
}
?>