<?php 

/* Fix project current menu active style */
add_filter('nav_menu_css_class', function($classes, $item) {

if (
    ($item->title === 'Projects') && is_singular('project') || ($item->title === 'Insights') && is_singular('post')
) {
    $classes[] = 'current-menu-item';
}

return $classes;
}, 10, 2);




// Add page name as a custom body class
function add_page_slug_to_body_class($classes) {
    if (is_singular()) { // Only for single posts/pages
        global $post;
        if (isset($post->post_name)) {
            $classes[] = $post->post_name . '-page';
        }
    }
    return $classes;
}
add_filter('body_class', 'add_page_slug_to_body_class');


add_action('wp_head', function () {
    if (is_front_page()) {
        ?>
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "MarketingAgency",
            "@id": "https://beepossible.com/#marketing-agency",
            "name": "Bee Possible Ltd",
            "url": "https://beepossible.com",
            "description": "Bee Possible is a results-driven marketing agency in Cyprus offering digital marketing, social media management, custom website development, UI/UX, and branding.",
            "areaServed": {
                "@type": "Country",
                "name": "Cyprus"
            },
            "knowsAbout": [
                "Digital Marketing Cyprus",
                "Custom Websites",
                "Social Media Marketing Cyprus",
                "Google Ads Cyprus",
                "Branding Cyprus",
                "Brand Strategy",
                "E-Commerce Strategy",
                "Campaign Management",
                "UI/UX Design & Strategy"
            ],
            "sameAs": [
                "https://www.facebook.com/beepossible.consulting"
            ]
            }
        </script>


        <script type="application/ld+json">
        {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [
            {
            "@type": "Question",
            "name": "What is the best marketing agency in Cyprus?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "The best marketing agency in Cyprus depends on your goals, but Bee Possible is known for delivering measurable results in digital marketing, brand strategy, and social media management."
            }
            },
            {
            "@type": "Question",
            "name": "How much does digital marketing cost in Cyprus?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Digital marketing services in Cyprus typically range from €500 to €3000+ per month depending on the scope, including design, paid ads, and content creation."
            }
            },
            {
            "@type": "Question",
            "name": "Do I need a website for my business in Cyprus?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, having an official website is essential for businesses in Cyprus to appear on Google when customers search for their services."
            }
            },
            {
            "@type": "Question",
            "name": "What services does a marketing agency in Cyprus offer?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "Marketing agencies in Cyprus offer services such as SEO, Google Ads, social media marketing, branding, content creation, and website optimisation."
            }
            },
            {
            "@type": "Question",
            "name": "How long does it take to see results from SEO in Cyprus?",
            "acceptedAnswer": {
                "@type": "Answer",
                "text": "SEO results in Cyprus usually take between 3 to 6 months depending on competition, website quality, and consistency of optimisation."
            }
            }
        ]
        }
        </script>
        <?php
    }
});

/* only for marketing agency page */ 
add_action('wp_head', function () {
    if (is_page('marketing-agency-cyprus')) {
        ?>
        <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "FAQPage",
          "@id": "https://beepossible.com/marketing-agency-cyprus/#faq",
          "mainEntity": [
            {
              "@type": "Question",
              "name": "What is the best marketing agency in Cyprus?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Choosing the right marketing agency depends on your goals, but Bee Possible stands out by combining strategy, UI/UX design, custom WordPress development, and performance marketing to deliver measurable growth."
              }
            },
            {
              "@type": "Question",
              "name": "How much does marketing cost in Cyprus?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Marketing services in Cyprus typically range from €500 to €3000+ per month depending on the scope, including social media management, advertising, and strategy."
              }
            },
            {
              "@type": "Question",
              "name": "What services does your marketing agency offer?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "We offer UI/UX design, custom WordPress website development, social media marketing, paid advertising, branding, and complete marketing strategy tailored to your business goals."
              }
            },
            {
              "@type": "Question",
              "name": "Do you build custom WordPress websites?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Yes, we develop fully custom WordPress websites focused on performance, user experience, and scalability, tailored specifically to your business needs."
              }
            },
            {
              "@type": "Question",
              "name": "Why is marketing strategy important for my business?",
              "acceptedAnswer": {
                "@type": "Answer",
                "text": "Without a clear strategy, marketing efforts become inconsistent and ineffective. A structured strategy ensures your brand, campaigns, and messaging work together to generate real results."
              }
            }
          ]
        }
        </script>
        <?php
    }
});