<?php

/**
 * Template for displaying overview tab of single course.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/single-course/tabs/overview.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit();

/**
 * @var LP_Course $course
 */
$course = LP_Global::course();

?>

<div class="course-description" id="learn-press-course-description">

	<?php
	/**
	 * @deprecated
	 */
	do_action('learn_press_begin_single_course_description');

	/**
	 * @since 3.0.0
	 */
	do_action('learn-press/before-single-course-description');

	echo $course->get_content();

	/**
	 * @since 3.0.0
	 */
	do_action('learn-press/after-single-course-description');

	/**
	 * @deprecated
	 */
	do_action('learn_press_end_single_course_description');
	?>

	<?php if (get_field('lp_referencias')) : ?>

		<!-- Custom tab panel Referencias -->
		<div class="course-extra-box tab-referencias">

			<h3 class="course-extra-box__title">Referencias</h3>

			<div class="course-extra-box__content">
				<div class="course-extra-box__content-inner">
					<?php echo wp_kses_post( get_field('lp_referencias') ); ?>
				</div>
			</div>

		</div>

	<?php endif; ?>

	<?php if (get_field('lp_creditos')) : ?>

		<!-- Custom tab panel Creditos -->

		<div class="course-extra-box tab-creditos">

			<h3 class="course-extra-box__title">Créditos</h3>

			<div class="course-extra-box__content">
				<div class="course-extra-box__content-inner">
					<?php echo wp_kses_post( get_field('lp_creditos') ); ?>
				</div>
			</div>

		</div>

<?php endif; ?>

</div>