<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * ouc theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage OUC
 * @author     Pukunui Australia
 * @author     Based on code originally written by G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_ouc_get_html_for_settings($OUTPUT, $PAGE);
$haslogo = (!empty($PAGE->theme->settings->logo));

$ltr = (!right_to_left());  // To know if to add 'pull-right' and 'desktop-first-column' classes in the layout for LTR.
$hassidepre = $PAGE->blocks->is_known_region('side-pre');
if ($hassidepre) {
    $useblock = 'side-pre';
    /*
     This deals with the side to show the blocks on.
     If we have a 'side-pre' then the blocks are on the left for LTR and right for RTL.
    */
    if ($ltr) {
        $left = true;
    } else {
        $left = false;
    }
} else {
    $useblock = 'side-post';
    /*
     This deals with the side to show the blocks on.
     If we have a 'side-post' then the blocks are on the right for LTR and left for RTL.
    */
    if ($ltr) {
        $left = false;
    } else {
        $left = true;
    }
}

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome web fonts -->
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css" rel="stylesheet">
    <!-- Google web fonts -->
    <link href='//fonts.googleapis.com/css?family=Oswald:400,700' rel='stylesheet' type='text/css'>
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>

<?php echo $OUTPUT->standard_top_of_body_html() ?>

<header role="banner" class="navbar <?php echo $html->navbarclass ?>">
	<div class="row-fluid mainheader">
	<div class="span3">
	<?php if (!$haslogo) { ?>
        <div class="setlogo"></div>
    <?php } else { ?>
         <a href="<?php echo $CFG->wwwroot; ?>" title="<?php print_string('home'); ?>"><div class="logo"></div></a>
    <?php } ?>
	</div>
	
	<div class="span8 coursename">
		<h1 class="coursetitle"><span id="lightblue">Course</span>&nbsp;:&nbsp;<?php echo $PAGE->heading ?></h1>
		<p>Centre for Professional Learning and Development (OLPD)</p>
	</div>
	
    <div class="span1 pull-right" id="profilepic">
    	<?php if (isloggedin()) { ?>
			<a href="<?php echo $CFG->wwwroot.'/user/profile.php?id='.$USER->id; ?>">
			<?php echo $OUTPUT->user_picture($USER); ?>
			</a> 
		<?php } ?>        
    </div>
	</div>
    <nav role="navigation" class="navbar-inner">
        <div class="container-fluid">
            <a class="brand" href="<?php echo $CFG->wwwroot;?>"><i class="icon-home"></i> <?php echo $SITE->shortname; ?></a>
            <a class="btn btn-navbar" data-toggle="workaround-collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse collapse">
                <?php echo $OUTPUT->custom_menu(); ?>
                <ul class="nav pull-right">
                    <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                    <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div id="page" class="container-fluid">

    <header id="page-header" class="clearfix">
        <div id="page-navbar" class="clearfix">
            <div class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></div>
            <nav class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></nav>
        </div>
        <div id="course-header">
            <?php echo $OUTPUT->course_header(); ?>
        </div>
    </header>

    <div id="page-content" class="row-fluid">
        <div id="region-main-ouc" class="span9<?php if ($ltr) { echo ' pull-right'; } ?>">
                <section id="region-main" class="row-fluid">
                <?php
                echo $OUTPUT->course_content_header();
                echo $OUTPUT->main_content();
                echo $OUTPUT->course_content_footer();
                ?>
            </section>
        </div>
        <?php
        $classextra = '';
        if ($left) {
            $classextra = ' desktop-first-column';
        }
        echo $OUTPUT->oucblocks($useblock, 'span3'.$classextra);
        ?>
    </div>

    <footer id="page-footer">
        <div id="course-footer"><?php echo $OUTPUT->course_footer(); ?></div>
        <p class="helplink"><?php echo $OUTPUT->page_doc_link(); ?></p>
        <?php
        echo $html->footnote;
        echo $OUTPUT->login_info();
        echo $OUTPUT->home_link();
        echo $OUTPUT->standard_footer_html();
        ?>
    </footer>

    <?php echo $OUTPUT->standard_end_of_body_html() ?>

</div>
</body>
</html>