<?php if(!isset($bien_bao_mat)){exit();} ?>

<?php 
	$so_dong_tren_mot_trang=10;
	if(!isset($_GET['trang'])){$_GET['trang']=1;}
	$tv="select count(*) from nguoi_dung";
	$conn = new mysqli("localhost", "root", "", "ban_hang");
	$tv_1 = mysqli_query($conn, $tv);
	$tv_2 = mysqli_fetch_array($tv_1);
	$so_trang=ceil($tv_2[0]/$so_dong_tren_mot_trang);
	$vtbd=($_GET['trang']-1)*$so_dong_tren_mot_trang;
	$tv="select * from nguoi_dung order by nguoi_dung_id desc limit $vtbd,$so_dong_tren_mot_trang";
	$tv_1 = mysqli_query($conn, $tv);
?>

<div class="content">
    <div class="row">
        <div class="title col-12 box_shadow">
            <b>Quản lý người dùng</b>
        </div>
    </div>
    <div class="row main_frame box_card box_shadow">
        <div class="element_btn">
            <div>
                <a href="?thamso=them_nguoi_dung" class="addnew_btn"><i class="fas fa-plus"></i>Thêm người dùng</a>
            </div>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-secondary">
                        <th scope="col">Tài khoản</th>
                        <th scope="col">Mật khẩu</th>
                        <th scope="col">Email</th>
                        <th scope="col">Sửa</th>
                        <th scope="col">Khóa/Mở</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                        while ($tv_2 = mysqli_fetch_array($tv_1)) {
                            $nguoi_dung_id = $tv_2['nguoi_dung_id'];
                            $tai_khoan = $tv_2['tai_khoan'];
                            $mat_khau = $tv_2['mat_khau'];
                            $email = $tv_2['email'];
                            $trang_thai = $tv_2['trang_thai'];
                            $link_sua="?thamso=sua_nguoi_dung&nguoi_dung_id=".$nguoi_dung_id;
                    ?>
                    <tr>
                        <td><?php echo $tai_khoan; ?></td>
                        <td><?php echo $mat_khau; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><a href="<?php echo $link_sua; ?>">Sửa</a></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="category_paging">
            <?php
                for ($i = 1; $i <= $so_trang; $i++) {
                    $link_phan_trang = "?thamso=nguoi_dung&trang=".$i;
                    echo "<a href='$link_phan_trang' class='phan_trang'>";
                    echo $i;
                    echo "</a> ";
                }
            ?>
        </div>
    </div>
</div>

<script>
function confirmAlert() {
    if (confirm("Bạn có muốn xóa người dùng này không?")) return true
    else return false
}
</script>