<!doctype html>
<html lang="en">
<?php
// Set per-page SEO metadata before rendering the shared <head> partial.
$pageTitle = 'Home | Web Developer Portfolio';
$pageDescription = 'Explore my web development portfolio, featured projects, and contact details for collaboration opportunities.';
// Include shared head markup (meta tags, stylesheet link, and escaped title/description).
include __DIR__ . '/includes/head.php';
?>
<body>
    <!-- Reuse the common site navigation on the homepage. -->
    <?php include __DIR__ . '/includes/nav.php'; ?>
    <div class="principal">
            <!-- Hero/banner section introducing the portfolio owner. -->
            <header class="about">
                <h1>
                    <span class="banner-static">My Name is </span><span id="typing-banner" aria-live="polite"></span>
                </h1>
                <h2>
                    I'm a Web Developer
                </h2>
                <a class="scrolldown" href="#grid">
                    <p class="scrolldown">
                        Scroll Down
                    </p>
                    <img src="img/down.png" alt="Down arrow icon" width="32" height="32" loading="lazy">
                </a>
        </header>
        <div class="content">
            <main>
                <!-- Grid of featured projects; each card links to an external or placeholder project. -->
                <div class="grid" id="grid">
                    <section id="g1">
                        <a href="https://js-array.viljamas-simsonas.netmatters-scs.co.uk/" target="_blank" rel="noopener noreferrer">
                            <div class="debugimg g1"></div>
                            <h2>Project One</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                    <section id="g2">
                        <a href="https://netmatters.viljamas-simsonas.netmatters-scs.co.uk/" target="_blank" rel="noopener noreferrer">
                            <div class="debugimg g2"></div>
                            <h2>Project Two</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                    <section id="g3">
                        <a href="#">
                            <div class="debugimg g3"></div>
                            <h2>Project Three</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                    <section id="g4">
                        <a href="#">
                            <div class="debugimg g4"></div>
                            <h2>Project Four</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                    <section id="g5">
                        <a href="#">
                            <div class="debugimg g5"></div>
                            <h2>Project Five</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                    <section id="g6">
                        <a href="#">
                            <div class="debugimg g6"></div>
                            <h2>Project Six</h2>
                            <p>View Project &gt;&gt;</p>
                        </a>
                    </section>
                </div>
            </main>
            <!-- Contact area combines static contact copy with the interactive contact form. -->
            <footer class="contact" id="contact">
                <div class="getintouch">
                    <h2>
                        Get In Touch
                    </h2>
                    <p>
                        Have a project in mind or want to talk through an idea?
                        I&apos;d love to hear from you and discuss how we can build
                        something great together.
                    </p>
                    <h3 class="phone-number">
                        00000 000000
                    </h3>
                    <h3>
                        info@netmatters.com
                    </h3>
                    <p>
                        I&apos;m available for freelance work, collaborations,
                        and full-time opportunities. Send a message using
                        the form and I&apos;ll get back to you as soon as possible.
                    </p>
                </div>
                <div class="form-container">
                    <!-- Client-side JavaScript enhances validation and submits this form to contact.php. -->
                    <form id="contact-form" action="/contact-submit" method="post" novalidate>
                        <div class="name-section">
                            <div class="name-input">
                                <input id="first-name" name="first-name" placeholder="First Name*" required>
                            </div>
                            <div class="name-input">
                                <input id="last-name" name="last-name" placeholder="Last Name*" required>
                            </div>
                        </div>
                        <div>
                            <input id="email" name="email" type="email" placeholder="Email Address*" required>
                        </div>
                        <div>
                            <input id="phone" name="phone" type="tel" placeholder="Phone Number*" required>
                        </div>
                        <div>
                            <input id="subject" name="subject" placeholder="Subject">
                        </div>
                        <div>
                            <input id="message" name="message" placeholder="Message*" class="message" required>
                        </div>
                        <p id="form-status" class="form-status" role="alert"></p>
                        <div>
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </footer>
            <!-- Quick jump back to the top of the page after scrolling. -->
            <div class="backtop">
                <a href="#">
                    <img src="img/up.png" alt="Up arrow icon" width="16" height="16" loading="lazy">
                    <p class="scrolldown">
                        Back To Top
                    </p>
                </a>
            </div>
        </div>
    </div>
    <!-- Shared scripts are loaded once at the end of <body> for better page performance. -->
    <?php include __DIR__ . '/includes/scripts.php'; ?>
</body>
</html>
