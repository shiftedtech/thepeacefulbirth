<?php
/**
 * Default page content, written as core blocks so everything stays editable
 * in the block editor. Also registered as block patterns so sections can be
 * re-added later (Add block → Patterns → Peaceful Birth).
 *
 * @package peaceful-birth
 */

defined( 'ABSPATH' ) || exit;

/* ---------- tiny block-markup helpers ---------- */

function pb_attrs( array $attrs ) {
	return $attrs ? ' ' . serialize_block_attributes( $attrs ) : '';
}

function pb_classes( $base, $class ) {
	return trim( $base . ' ' . $class );
}

function pb_p( $html, $class = '' ) {
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = $class ? ' class="' . esc_attr( $class ) . '"' : '';
	return "<!-- wp:paragraph" . pb_attrs( $attrs ) . " -->\n<p{$cls}>{$html}</p>\n<!-- /wp:paragraph -->\n";
}

function pb_h( $html, $level = 2, $class = '' ) {
	$attrs = array();
	if ( 2 !== $level ) {
		$attrs['level'] = $level;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$cls = esc_attr( pb_classes( 'wp-block-heading', $class ) );
	return "<!-- wp:heading" . pb_attrs( $attrs ) . " -->\n<h{$level} class=\"{$cls}\">{$html}</h{$level}>\n<!-- /wp:heading -->\n";
}

function pb_group( $inner, $class = '', $tag = 'div', $id = '' ) {
	$attrs = array();
	if ( 'div' !== $tag ) {
		$attrs['tagName'] = $tag;
	}
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$id_attr = $id ? ' id="' . esc_attr( $id ) . '"' : '';
	$cls     = esc_attr( pb_classes( 'wp-block-group', $class ) );
	return "<!-- wp:group" . pb_attrs( $attrs ) . " -->\n<{$tag}{$id_attr} class=\"{$cls}\">{$inner}</{$tag}>\n<!-- /wp:group -->\n";
}

function pb_list( array $items, $class = '' ) {
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = esc_attr( pb_classes( 'wp-block-list', $class ) );
	$lis   = '';
	foreach ( $items as $item ) {
		$lis .= "<!-- wp:list-item -->\n<li>{$item}</li>\n<!-- /wp:list-item -->\n";
	}
	return "<!-- wp:list" . pb_attrs( $attrs ) . " -->\n<ul class=\"{$cls}\">{$lis}</ul>\n<!-- /wp:list -->\n";
}

/** @param array $buttons [ [label, url, outline?], ... ] */
function pb_buttons( array $buttons, $class = '' ) {
	$inner = '';
	foreach ( $buttons as $b ) {
		$outline = ! empty( $b[2] );
		$attrs   = $outline ? array( 'className' => 'is-style-outline' ) : array();
		$cls     = $outline ? 'wp-block-button is-style-outline' : 'wp-block-button';
		$inner  .= "<!-- wp:button" . pb_attrs( $attrs ) . " -->\n<div class=\"{$cls}\"><a class=\"wp-block-button__link wp-element-button\" href=\"" . esc_url( $b[1] ) . "\">{$b[0]}</a></div>\n<!-- /wp:button -->\n";
	}
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = esc_attr( pb_classes( 'wp-block-buttons', $class ) );
	return "<!-- wp:buttons" . pb_attrs( $attrs ) . " -->\n<div class=\"{$cls}\">{$inner}</div>\n<!-- /wp:buttons -->\n";
}

function pb_image( $src, $alt, $class = '' ) {
	$attrs = array( 'sizeSlug' => 'full', 'linkDestination' => 'none' );
	if ( $class ) {
		$attrs['className'] = $class;
	}
	$cls = esc_attr( pb_classes( 'wp-block-image size-full', $class ) );
	return "<!-- wp:image" . pb_attrs( $attrs ) . " -->\n<figure class=\"{$cls}\"><img src=\"" . esc_url( $src ) . "\" alt=\"" . esc_attr( $alt ) . "\"/></figure>\n<!-- /wp:image -->\n";
}

function pb_quote( $text, $cite, $class = '' ) {
	$attrs = $class ? array( 'className' => $class ) : array();
	$cls   = esc_attr( pb_classes( 'wp-block-quote', $class ) );
	return "<!-- wp:quote" . pb_attrs( $attrs ) . " -->\n<blockquote class=\"{$cls}\">" . pb_p( $text ) . "<cite>{$cite}</cite></blockquote>\n<!-- /wp:quote -->\n";
}

function pb_details( $summary, $answer ) {
	return "<!-- wp:details -->\n<details class=\"wp-block-details\"><summary>{$summary}</summary>" . pb_p( $answer ) . "</details>\n<!-- /wp:details -->\n";
}

function pb_shortcode( $code ) {
	return "<!-- wp:shortcode -->\n{$code}\n<!-- /wp:shortcode -->\n";
}

function pb_head( $eyebrow, $title, $sub = '', $class = '' ) {
	return pb_group(
		pb_p( $eyebrow, 'pb-eyebrow' ) . pb_h( $title ) . ( $sub ? pb_p( $sub, 'pb-sub' ) : '' ),
		pb_classes( 'pb-head', $class )
	);
}

/* ---------- sections ---------- */

function pb_section_hero() {
	$img = get_template_directory_uri() . '/assets/images/hero.svg';
	$text = pb_group(
		pb_p( 'Doula support · Birth classes', 'pb-eyebrow' )
		. pb_h( 'Your positive birth experience starts here.', 1 )
		. pb_p( 'I help couples feel calm, informed and supported — from pregnancy, through labour, and into the first days with your baby.', 'pb-lead' )
		. pb_buttons( array( array( 'Book a free consultation', '#contact' ), array( 'View services', '#services', true ) ) )
		. pb_list( array( '<strong>Couples</strong> supported together', '<strong>Evidence-based</strong> birth classes', '<strong>Any birth setting</strong> fully supported' ), 'pb-trust' ),
		'pb-hero__text'
	);
	return pb_group( pb_group( $text . pb_image( $img, 'The Peaceful Birth doula', 'pb-arch' ), 'pb-container pb-hero__inner' ), 'pb-hero', 'section', 'top' );
}

function pb_section_signs() {
	$signs = array(
		array( 'You feel anxious about labour', 'Fear of the unknown is normal. A doula helps you understand every stage so you can meet it with calm instead of worry.' ),
		array( 'You want a positive birth experience', 'You have hopes for how your birth feels — and you want someone in your corner helping you work towards them.' ),
		array( "Your partner wants to help, but isn't sure how", 'I guide your husband or partner with simple, practical ways to support you, so you both feel confident on the day.' ),
		array( 'You want to make informed choices', 'Understand your options, ask the right questions and feel heard by your care team.' ),
		array( 'You had a difficult previous birth', 'Planning for a different experience this time? Continuous support can make all the difference.' ),
		array( 'You want continuous support', 'Midwives and doctors change shifts. Your doula stays with you — before, during and after birth.' ),
	);
	$cards = '';
	foreach ( $signs as $i => $s ) {
		$cards .= pb_group( pb_p( sprintf( '%02d', $i + 1 ), 'pb-num' ) . pb_h( $s[0], 3 ) . pb_p( $s[1] ), 'pb-card' );
	}
	return pb_group(
		pb_group( pb_head( 'Is a doula right for you?', 'Signs that tell you that you need a doula in your birth team' ) . pb_group( $cards, 'pb-grid pb-grid--3' ), 'pb-container' ),
		'pb-section pb-section--warm', 'section', 'why'
	);
}

function pb_section_services() {
	$services = array(
		array( '📖', 'Birth Classes', 'Prepare together as a couple with practical, evidence-based classes.', array( 'Stages of labour & what to expect', 'Breathing, relaxation & comfort positions', 'Partner support techniques', 'Birth plan & your options', 'Early postpartum & newborn basics' ), 'Ask about classes', false ),
		array( '🤲', 'Doula Support', 'Complete emotional and physical support from pregnancy to after birth.', array( 'Prenatal meetings to plan your birth', 'Birth preferences guidance', 'On call for you near your due date', 'Continuous support during labour', 'Postnatal follow-up visit' ), 'Book doula support', true ),
		array( '☕', 'Consultation', 'A one-to-one session for questions, birth planning or a second opinion on your plan.', array( 'Talk through your fears & hopes', 'Review your birth plan', 'Ideas for a calmer birth', 'Online or in person' ), 'Book a consultation', false ),
	);
	$cards = '';
	foreach ( $services as $s ) {
		$inner = ( $s[5] ? pb_p( 'Most popular', 'pb-flag' ) : '' )
			. pb_p( $s[0], 'pb-icon' ) . pb_h( $s[1], 3 ) . pb_p( $s[2] )
			. pb_list( $s[3], 'pb-ticks' )
			. pb_buttons( array( array( $s[4], '#contact', ! $s[5] ) ), 'pb-buttons-block' );
		$cards .= pb_group( $inner, $s[5] ? 'pb-service pb-service--featured' : 'pb-service' );
	}
	return pb_group(
		pb_group( pb_head( 'Birth support service', 'Support for every part of your journey', "Choose the support that fits you. Every package can be tailored — let's talk about what you need." ) . pb_group( $cards, 'pb-grid pb-grid--3 pb-services' ), 'pb-container' ),
		'pb-section', 'section', 'services'
	);
}

function pb_section_steps() {
	$steps = array(
		array( 'Reach out', 'Send me a message on WhatsApp or through the form with your due date.' ),
		array( 'Free consultation', 'We have a relaxed chat about your pregnancy, your hopes and your questions.' ),
		array( 'Prepare together', 'Classes and prenatal meetings so you and your partner feel ready.' ),
		array( 'Birth day & beyond', "I'm with you through labour and check in after your baby arrives." ),
	);
	$cards = '';
	foreach ( $steps as $i => $s ) {
		$cards .= pb_group( pb_p( (string) ( $i + 1 ), 'pb-step__num' ) . pb_h( $s[0], 3 ) . pb_p( $s[1] ), 'pb-step' );
	}
	return pb_group(
		pb_group( pb_head( 'Simple & personal', 'How to work with me' ) . pb_group( $cards, 'pb-steps' ), 'pb-container' ),
		'pb-section pb-section--dark', 'section', 'how'
	);
}

function pb_section_about() {
	$img  = get_template_directory_uri() . '/assets/images/about.svg';
	$text = pb_group(
		pb_p( 'Meet your doula', 'pb-eyebrow' )
		. pb_h( "Hello, I'm here to walk with you." )
		. pb_p( 'Birth is one of the most powerful moments in your life — and you deserve to feel safe, respected and supported through it. As a doula, I offer continuous emotional and physical support, practical guidance and a calm presence for both you and your husband.' )
		. pb_p( 'I share honest stories, tips and real experiences on Instagram so families can learn what birth can look like when you feel prepared.' )
		. pb_list( array( 'Calm presence', 'Informed choices', 'Couples together', 'Respectful care' ), 'pb-pills' ),
		'pb-about__text'
	);
	return pb_group(
		pb_group( pb_image( $img, 'Your doula', 'pb-arch pb-arch--small' ) . $text, 'pb-container pb-about' ),
		'pb-section', 'section', 'about'
	);
}

function pb_section_stories() {
	$stories = pb_quote( 'She helped us feel calm and prepared. My husband knew exactly how to support me — it was the positive birth we hoped for.', 'Client couple · First baby', 'pb-story' )
		. pb_quote( 'After a hard first birth, I was scared. This time I felt heard and supported the whole way through. Thank you so much.', 'Mother of two', 'pb-story' )
		. pb_quote( 'The birth class changed everything for us. We went in knowing our options and feeling like a team.', 'Birth class couple', 'pb-story' );
	$ig = pb_group(
		pb_group( pb_h( 'Watch real stories &amp; tips on Instagram', 3 ) . pb_p( 'Story time videos, client testimonies and birth tips — follow along at <strong>@thepeacefulbirth</strong>.' ) )
		. pb_buttons( array( array( 'Leave a review', '#review', true ), array( 'Follow on Instagram', '#instagram' ) ) ),
		'pb-ig'
	);
	return pb_group(
		pb_group( pb_head( 'Story time', 'Testimony from previous clients' ) . pb_group( $stories, 'pb-grid pb-grid--3' ) . $ig, 'pb-container' ),
		'pb-section pb-section--warm', 'section', 'stories'
	);
}

function pb_section_faq() {
	$faq = pb_details( 'What does a doula do?', 'A doula provides continuous emotional, physical and informational support before, during and after birth. A doula does not provide medical care — I work alongside your doctor or midwife.' )
		. pb_details( 'Is a doula only for natural births?', 'No. I support all kinds of births, wherever you give birth — with or without pain relief, inductions and caesarean births.' )
		. pb_details( 'Will my husband still have a role?', 'Yes! I support couples together. I show your partner practical ways to help and make sure they feel confident and included.' )
		. pb_details( 'When should I book?', 'Ideally in your second trimester, so we have time to prepare together — but get in touch at any stage to check availability.' )
		. pb_details( 'Do you offer online classes or consultations?', 'Consultations can be online or in person. Ask me about current class formats and dates.' );
	$head = pb_group(
		pb_p( 'Questions', 'pb-eyebrow' ) . pb_h( 'Frequently asked questions' )
		. pb_p( "Can't find your answer? Send me a message — I'm happy to help.", 'pb-sub' )
		. pb_buttons( array( array( 'Ask on WhatsApp', '#whatsapp', true ) ) ),
		'pb-head pb-head--left'
	);
	return pb_group( pb_group( $head . pb_group( $faq, 'pb-faq' ), 'pb-container pb-faq-wrap' ), 'pb-section', 'section', 'faq' );
}

function pb_section_contact() {
	$text = pb_group(
		pb_p( "Let's talk", 'pb-eyebrow' ) . pb_h( 'Book your free consultation' )
		. pb_p( "Tell me a little about you and your due date. I'll get back to you to arrange a relaxed chat." )
		. pb_shortcode( '[peaceful_birth_contact_links]' ),
		'pb-contact__text'
	);
	return pb_group( pb_group( $text . pb_shortcode( '[peaceful_birth_form]' ), 'pb-container pb-contact' ), 'pb-section pb-section--cta', 'section', 'contact' );
}

function pb_home_content() {
	return pb_section_hero() . pb_section_signs() . pb_section_services() . pb_section_steps()
		. pb_section_about() . pb_section_stories() . pb_section_faq() . pb_section_contact();
}

function pb_review_content() {
	return pb_h( 'Thank you for letting me be part of your birth story', 1 )
		. pb_p( 'Your words help other mothers and couples find calm, supported birth care. Would you take a minute to share your experience on Google?' );
}

/* ---------- patterns ---------- */

add_action( 'init', function () {
	register_block_pattern_category( 'peaceful-birth', array( 'label' => __( 'Peaceful Birth', 'peaceful-birth' ) ) );
	$patterns = array(
		'hero'     => array( __( 'Hero', 'peaceful-birth' ), 'pb_section_hero' ),
		'signs'    => array( __( 'Signs you need a doula', 'peaceful-birth' ), 'pb_section_signs' ),
		'services' => array( __( 'Services', 'peaceful-birth' ), 'pb_section_services' ),
		'steps'    => array( __( 'How to work with me', 'peaceful-birth' ), 'pb_section_steps' ),
		'about'    => array( __( 'About', 'peaceful-birth' ), 'pb_section_about' ),
		'stories'  => array( __( 'Testimonials', 'peaceful-birth' ), 'pb_section_stories' ),
		'faq'      => array( __( 'FAQ', 'peaceful-birth' ), 'pb_section_faq' ),
		'contact'  => array( __( 'Contact & booking form', 'peaceful-birth' ), 'pb_section_contact' ),
		'home'     => array( __( 'Full home page', 'peaceful-birth' ), 'pb_home_content' ),
	);
	foreach ( $patterns as $slug => $p ) {
		register_block_pattern( 'peaceful-birth/' . $slug, array(
			'title'      => $p[0],
			'categories' => array( 'peaceful-birth' ),
			'content'    => call_user_func( $p[1] ),
		) );
	}
} );
