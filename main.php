<?php
/*
Plugin Name: staff role widget
Plugin URI: http://www.example.com/plugin
Description: 画像つきカスタムウィジェットを登録
Author: tailtension
Version: 0.1
Author URI: http://www.example.com
*/

$uri = get_template_directory_uri(); 
$dir = get_template_directory();


add_action( 'widgets_init', function () {
	register_widget( 'My_Widget' );  //WidgetをWordPressに登録する
  register_sidebar( array(  //「サイドバー」を登録する
		'name'          => 'recipe 1',
		'id'            => 'my_sidebar_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
  ) );
  register_sidebar( array(  //「サイドバー」を登録する
		'name'          => 'recipe 2',
		'id'            => 'my_sidebar_2',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
  ) );
  register_sidebar( array(  //「サイドバー」を登録する
		'name'          => 'recipe 3',
		'id'            => 'my_sidebar_3',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
  ) );
  register_sidebar( array(  //「サイドバー」を登録する
		'name'          => 'recipe 4',
		'id'            => 'my_sidebar_4',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
} );


//カスタムウィジェット
class My_Widget extends WP_Widget{
	/**
	 * Widgetを登録する
	 */

	function __construct() {
		parent::__construct(
			'my_widget', // Base ID
			'スタッフ画像', // Name
			array( 'description' => 'スタッフの紹介', ) // Args
		);
	}

	/**
	 * 表側の Widget を出力する
	 *
	 * @param array $args      'register_sidebar'で設定した「before_title, after_title, before_widget, after_widget」が入る
	 * @param array $instance  Widgetの設定項目
	 */
	public function widget( $args, $instance ) {
    global $uri;
    $team_img = $instance['team_img'];
    $team_name = $instance['team_name'];
		echo $args['before_widget'];

        echo '<img width="270" height="270" src="',$uri,'/images/pages/',$team_img,'" alt=""/></a> ';
        echo '
        <div class="thumbnail-desc">
        <h5 class="thumbnail-josip-title text-bold text-white">',$team_name,'</h5>
      </div>
      <figcaption><a class="btn-java btn btn-block btn-rect text-lg-left" href="team-member.html">view full profile</a></figcaption>
     ';

        echo $args['after_widget'];
	}

    /** Widget管理画面を出力する
     *
     * @param array $instance 設定項目
     * @return string|void
     */
    public function form( $instance ){
        $team_img = @$instance['team_img'];
        $team_img_name = $this->get_field_name('team_img');
        $team_img_id = $this->get_field_id('team_img');

        $team_name = @$instance['team_name'];
        $team_name_name = $this->get_field_name('team_name');
        $team_name_id = $this->get_field_id('team_name');

 ?>
        <p>
            <label for="<?php echo $team_img_id; ?>">スタッフ顔写真:</label>
            <input class="widefat" id="<?php echo $team_img_id; ?>" name="<?php echo $team_img_name; ?>" type="text" value="<?php echo esc_attr( $team_img ); ?>">
        </p>
        <p>
            <label for="<?php echo $team_name_id; ?>">スタッフ名:</label>
            <input class="widefat" id="<?php echo $team_name_id; ?>" name="<?php echo $team_name_name; ?>" type="text" value="<?php echo esc_attr( $team_name ); ?>">
        </p>
       
 <?php
    }

    /** 新しい設定データが適切なデータかどうかをチェックする。
     * 必ず$instanceを返す。さもなければ設定データは保存（更新）されない。
     *
     * @param array $new_instance  form()から入力された新しい設定データ
     * @param array $old_instance  前回の設定データ
     * @return array               保存（更新）する設定データ。falseを返すと更新しない。
     */
    function update($new_instance, $old_instance) {
        if(empty($new_instance['team_img']) 
        || empty($new_instance['team_name'])){
            return false;
        }
        return $new_instance;
    }
}
