
<?php
/**
 * Adds Foo_Widget widget.
 */
class Foo_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'foo_widget', // Base ID
			esc_html__('Widget Title', 'text_domain'), // Name
			array( 'description' => esc_html__('A Foo Widget', 'text_domain'), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		echo $args['before_widget'];
		if (! empty($instance['title'])) {
			echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
		}
		echo esc_html__('Hello, World!', 'text_domain');
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		$title = ! empty($instance['title']) ? $instance['title'] : esc_html__('New title', 'text_domain');
		?>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_attr_e('Title:', 'text_domain'); ?></label> 
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = ( ! empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';

		return $instance;
	}
} // class Foo_Widget

//This sample widget can then be registered in the 'widgets_init' hook:

// register Foo_Widget widget
function register_foo_widget()
{
	register_widget('Foo_Widget');
}
add_action('widgets_init', 'register_foo_widget');
//Note : You must use get_field_name() and get_field_id() function to generate form element name and id.

//Example With Namespaces
//If you use PHP 5.3. with namespaces you should call the constructor directly as in the following example:

namespace a\b\c;

class My_Widget_Class extends \WP_Widget
{
	function __construct()
	{
			   parent::__construct('baseID', 'name');
	}
		// ... rest of functions
}
// ..and call the register_widget() with:

add_action('widgets_init', function () {
	 register_widget('a\b\c\My_Widget_Class');
});

/*(see: http://stackoverflow.com/questions/5247302/php-namespace-5-3-and-wordpress-widget/5247436#5247436)

That's all. You will automatically get a multi-widget. No special tweaks needed any longer for that.

More information is available in the version 2.8 information.

Displaying Widgets and Widget Areas
There are at least 3 ways that Widgets can be displayed:

Widget Areas
The first, and most common, is by adding the desired Widget to a Widget Area via the Appearance -> Widgets menu in the Administration Screens.

WordPress comes with some predefined Widget Areas that each have unique identifiers (view the source of the Widgets page to see them) that you'll need to know in order to display the Widget Area. If the predefined Widget Areas are insufficient for your needs you may register a custom Widget Areas.
*/

//When you're ready you can display that Widget Area by inserting the following code into whichever Theme file you desire:
if (dynamic_sidebar('example_widget_area_name')) :
else :
endif;
//That code displays all of the Widgets added to that Widget Area.

//Display Widget Area Only If Active
//Here's the code used in the sidebar.php file of the Twenty Fourteen Theme.

if (is_active_sidebar('sidebar-1')) : ?>
	<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar('sidebar-1'); ?>
	</div><!-- #primary-sidebar -->
<?php endif; //This code checks to see if the new widget area is populated otherwise doesn't execute.?>

