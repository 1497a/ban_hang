<?php
$conn = new mysqli("localhost", "root", "", "ban_hang");

if (isset($_SESSION['id_them_vao_gio'])) {
	$ten_nguoi_mua = trim($_POST['ten_nguoi_mua']);
	$ten_nguoi_nhan = trim($_POST['ten_nguoi_nhan']);
	$email = trim($_POST['email']);
	$dien_thoai = trim($_POST['dien_thoai']);
	$dia_chi = trim(nl2br($_POST['dia_chi']));
	$ngay_mua = date('Y-m-d');
	$hang_duoc_mua = "";
	$tong_tien = 0;

	for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
		$hang_duoc_mua = $hang_duoc_mua . $_SESSION['id_them_vao_gio'][$i] . "[|||]" . $_SESSION['sl_them_vao_gio'][$i] . "[|||||]";

		$id_san_pham = $_SESSION['id_them_vao_gio'][$i];
		$query = "SELECT gia FROM san_pham WHERE id = $id_san_pham";
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$gia = $row['gia'];

		$sl = $_SESSION['sl_them_vao_gio'][$i];
		$tong_tien += $gia * $sl;
	}

	$tong_tien = $tong_tien;
	$tv = "INSERT INTO hoa_don (
            id ,
            ten_nguoi_mua ,
			nguoi_nhan,
            email ,
            dia_chi ,
            dien_thoai ,
            hang_duoc_mua,
			ngay_mua,
			tong_tien
            )
            VALUES (
            NULL ,
            '$ten_nguoi_mua',
			'$ten_nguoi_nhan',
            '$email',
            '$dia_chi',
            '$dien_thoai',
            '$hang_duoc_mua',
			'$ngay_mua',
			'$tong_tien'
            );";
	mysqli_query($conn, $tv);
	unset($_SESSION['id_them_vao_gio']);
	unset($_SESSION['sl_them_vao_gio']);
	thong_bao_html_roi_chuyen_trang("Cảm ơn bạn đã mua hàng tại web site chúng tôi", "index.php");
}
?>