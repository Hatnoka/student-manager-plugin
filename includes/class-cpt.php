<?php
add_action('init', function() {
    register_post_type('sinh_vien', [
        'labels' => ['name' => 'Sinh viên', 'singular_name' => 'Sinh viên', 'add_new' => 'Thêm sinh viên'],
        'public' => true,
        'menu_icon' => 'dashicons-id-alt',
        'supports' => ['title', 'editor']
    ]);
});

add_action('add_meta_boxes', function() {
    add_meta_box('sm_info', 'Thông tin sinh viên', 'sm_render_fields', 'sinh_vien');
});

function sm_render_fields($post) {
    wp_nonce_field('sm_save', 'sm_nonce');
    // QUAN TRỌNG: Tên biến phải khớp
    $mssv = get_post_meta($post->ID, '_mssv', true);
    $nganh = get_post_meta($post->ID, '_nganh', true);
    $ngaysinh = get_post_meta($post->ID, '_ngaysinh', true);
    ?>
    <p>MSSV: <input type="text" name="mssv" value="<?php echo esc_attr($mssv); ?>" style="width:100%"></p>
    <p>Ngành: 
        <select name="nganh" style="width:100%">
            <option value="CNTT" <?php selected($nganh, 'CNTT'); ?>>CNTT</option>
            <option value="Kinh tế" <?php selected($nganh, 'Kinh tế'); ?>>Kinh tế</option>
            <option value="Marketing" <?php selected($nganh, 'Marketing'); ?>>Marketing</option>
        </select>
    </p>
    <p>Ngày sinh: <input type="date" name="ngaysinh" value="<?php echo esc_attr($ngaysinh); ?>" style="width:100%"></p>
    <?php
}

add_action('save_post', function($post_id) {
    if (!isset($_POST['sm_nonce']) || !wp_verify_nonce($_POST['sm_nonce'], 'sm_save')) return;
    update_post_meta($post_id, '_mssv', sanitize_text_field($_POST['mssv']));
    update_post_meta($post_id, '_nganh', sanitize_text_field($_POST['nganh']));
    update_post_meta($post_id, '_ngaysinh', sanitize_text_field($_POST['ngaysinh']));
});