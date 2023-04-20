<?php
$dang_nhap = "SELECT * FROM nguoi_dung WHERE nguoi_dung_id = " . $_SESSION['uid'];
$tv_dang_nhap = mysqli_query($conn, $dang_nhap);
$row = mysqli_fetch_array($tv_dang_nhap);
echo "<br>";
echo "<br>";
echo "<form method='post' action=''  onsubmit='return check();' >";
echo "<input type='hidden' name='thong_tin_khach_hang' value='co' > ";
echo "<table>";
echo "<tr>";
echo "<td colspan='2' height='30px' >";
echo "<b>Thông tin giao hàng</b>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td height='40px' >Lưu ý : </td>";
echo "<td>";
echo "Tên người nhận bắt buộc phải điền vào, địa chỉ có thể thay đổi";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td width='180px' >Tên người mua :</td>";
echo "<td>";
echo '<input type="text" style="width:400px" name="ten_nguoi_mua" value="' . $row['ho_ten'] . '">';
echo "</td>";
echo "<td>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td width='180px' >Tên người Nhận :</td>";
echo "<td>";
echo '<input type="text" style="width:400px" name="ten_nguoi_nhan" id= "nh">';
echo "</td>";
echo "<td>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Email : </td>";
echo "<td>";
echo '<input type="text" style="width:400px" name="email" value="' . $row['email'] . '">';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Địa chỉ : </td>";
echo "<td>";
echo '<input type="text" style="width:400px;" name="dia_chi" value="' . $row['dia_chi'] . '- ' . $row['quan_huyen'] . '- ' . $row['tinh_thanh'] . '">';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Điện thoại : </td>";
echo "<td>";
echo '<input type="text" style="width:400px" name="dien_thoai"  value="' . $row['so_dien_thoai'] . '">';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan='2' height='30px' >";
echo "<b>Hình Thức thanh toán</b>";
echo "</td>";
echo "</tr>";

echo "<tr>";
echo "<td height='40px'>";
echo '<input id="httt-2" name="httt_ma" type="radio" class="custom-control-input" required="" value="2">';
echo '<label class="custom-control-label" for="httt-2">Chuyển khoản</label>';
echo "</td>";
echo "<td>";
echo ' <a style="width:400px;">(STK: 1111111111. Ngân hàng: 1thanhvien)</a>';
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo '<input id="httt-3" name="httt_ma" type="radio" class="custom-control-input" required="" value="3">';
echo '<label class="custom-control-label" for="httt-3">Ship COD</label>';
echo "</tr>";
echo "<td>&nbsp;</td>";
echo "<td>";
echo "<input type='submit' value='Mua hàng' > ";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</form>";
?>

<head>
    <script>
    function check() {
        var ten_nguoi_nhan = document.getElementById("nh").value;
        if (!ten_nguoi_nhan) {
            alert("Vui lòng điền thông tin người nhận!");
            return false;
        }
    }
    </script>
</head>