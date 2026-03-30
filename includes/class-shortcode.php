<?php
add_shortcode('danh_sach_sinh_vien', function() {
    $students = new WP_Query(['post_type' => 'sinh_vien', 'posts_per_page' => -1]);
    
    ob_start();
    ?>
    <div class="sm-container">
        <table class="sm-student-table">
            <thead>
                <tr>
                    <th style="width:50px">STT</th>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Lớp</th>
                    <th>Ngày sinh</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($students->have_posts()) : 
                    $i = 1;
                    while ($students->have_posts()) : $students->the_post();
                        $id = get_the_ID();
                        // Lấy đúng tên biến đã lưu ở file class-cpt.php
                        $mssv = get_post_meta($id, '_mssv', true);
                        $nganh = get_post_meta($id, '_nganh', true);
                        $ngaysinh = get_post_meta($id, '_ngaysinh', true);
                        ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo esc_html($mssv); ?></td>
                            <td><?php the_title(); ?></td>
                            <td><?php echo esc_html($nganh); ?></td>
                            <td><?php echo esc_html($ngaysinh); ?></td>
                        </tr>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <tr><td colspan="5">Không có dữ liệu.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
    return ob_get_clean();
});

