<?php 
	if(!isset($bien_bao_mat)){exit();}
?>
<?php 
	$so_dong_tren_mot_trang=10;
	if(!isset($_GET['trang'])){$_GET['trang']=1;}
	
	$tv="select count(*) from hoa_don";
	$conn = new mysqli("localhost", "root", "", "ban_hang");
	$tv_1 = mysqli_query($conn, $tv);
	$tv_2 = mysqli_fetch_array($tv_1);
	$so_trang=ceil($tv_2[0]/$so_dong_tren_mot_trang);
	
	$vtbd=($_GET['trang']-1)*$so_dong_tren_mot_trang;
	$tv="select * from hoa_don order by id desc limit $vtbd,$so_dong_tren_mot_trang";
	$tv_1 = mysqli_query($conn, $tv);
?>
<div class="content">
    <div class="row">
        <div class="title col-12 box_shadow">
            <b>Quản lý hóa đơn</b>
        </div>
    </div>
    <div class="row main_frame box_card box_shadow">
        <div>
            <form action="./" method="get">
                <input type="hidden" name="thamso" value="hoa_don">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-3 row">
                            <label class="col-4 col-form-label">Từ ngày</label>
                            <div class="col-8">
                            <input type="date" name="tu_ngay" class="form-control" min="1900-01-01" max="9999-12-31" style="width:200px" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3 row">
                            <label class="col-4 col-form-label">Đến ngày</label>
                            <div class="col-8">
                                <input type="date" name="den_ngay" class="form-control" min="1900-01-01" max="9999-12-31" style="width:200px" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-2">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Lọc ngày">
                        </div>
                    </div>
                </div>
            </form>
            <form action="./" method="get">
            <input type="hidden" name="thamso" value="hoa_don">
                    <div class="row">
                        <div class="col-4">
                            <select name="tinh_thanh" class="form-select form-select-sm mb-3" id="city" aria-label=".form-select-sm" required>
                                <option value="" selected>Chọn tỉnh thành</option>           
                            </select>
                        </div>
                        <div class="col-4">
                            <select name="quan_huyen" class="form-select form-select-sm mb-3" id="district" aria-label=".form-select-sm" required>
                                <option value="" selected>Chọn quận huyện</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Lọc địa chỉ">
                            </div>
                        </div>
                    </div>
            </form>
        </div>
        <div class="table-responsive-lg">
            <table class="table table-bordered">
                <thead>
                    <tr class="table-secondary">
						<th scope="col">ID đơn hàng</th>
                        <th scope="col">Tên Khách hàng</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Điện thoại</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Ngày mua</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                    if (isset($_GET['tu_ngay'], $_GET['den_ngay'])) {
                        $tu_ngay = $_GET['tu_ngay'];
                        $den_ngay = $_GET['den_ngay'];
                        $query = "SELECT * FROM hoa_don WHERE ngay_mua BETWEEN '$tu_ngay' AND '$den_ngay'";
                        $dia_chi_ct = "SELECT hoa_don.*, nguoi_dung.* FROM hoa_don INNER JOIN nguoi_dung ON hoa_don.ten_nguoi_mua = nguoi_dung.ho_ten";
                        $result = mysqli_query($conn, $query);
                        $result2 = mysqli_query($conn, $dia_chi_ct);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $row2 = mysqli_fetch_assoc($result2);
                                ?>
                                <tr>
                                    <td><?= $row2['id']; ?></td>
                                    <td><?= $row2['ho_ten']; ?></td>
                                    <td><?= $row2['dia_chi'] . ', ' . $row2['quan_huyen'] . ', ' . $row2['tinh_thanh']; ?></td>
                                    <td><?= $row['dien_thoai']; ?></td>
                                    <td><?= number_format($row['tong_tien'], 0, ",", ".")."đ"; ?></td>
                                    <td></td>
                                    <td><?= $row['ngay_mua']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    } else if (isset($_GET['tinh_thanh'], $_GET['quan_huyen'])) {
                        $tinh_thanh = $_GET['tinh_thanh'];
                        $quan_huyen = $_GET['quan_huyen'];
                        $query = "SELECT * FROM nguoi_dung WHERE tinh_thanh = '$tinh_thanh' AND quan_huyen = '$quan_huyen'";
                        $dia_chi_ct = "SELECT hoa_don.*,nguoi_dung.* FROM hoa_don INNER JOIN nguoi_dung ON nguoi_dung.tinh_thanh = '$tinh_thanh' AND nguoi_dung.quan_huyen = '$quan_huyen'";
                        $result = mysqli_query($conn, $query);
                        $result2 = mysqli_query($conn, $dia_chi_ct);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $row2 = mysqli_fetch_assoc($result2);
                                ?>
                                <tr>
                                    <td><?= $row2['id']; ?></td>
                                    <td><?= $row2['ho_ten']; ?></td>
                                    <td><?= $row2['dia_chi'] . ', ' . $row2['quan_huyen'] . ', ' . $row2['tinh_thanh']; ?></td>
                                    <td><?= $row2['so_dien_thoai']; ?></td>
                                    <td><?= number_format($row2['tong_tien'], 0, ",", ".")."đ"; ?></td>
                                    <td></td>
                                    <td><?= $row2['ngay_mua']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    } else {
                        $query = "SELECT hoa_don.*,nguoi_dung.* FROM hoa_don INNER JOIN nguoi_dung ON hoa_don.ten_nguoi_mua = nguoi_dung.ho_ten";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['ten_nguoi_mua']; ?></td>
                                    <td><?= $row['dia_chi'] . ', ' . $row['quan_huyen'] . ', ' . $row['tinh_thanh']; ?></td>
                                    <td><?= $row['so_dien_thoai']; ?></td>
                                    <td><?= number_format($row['tong_tien'], 0, ",", ".")."đ"; ?></td>
                                    <td></td>
                                    <td><?= $row['ngay_mua']; ?></td>
                                </tr>
                                <?php
                            }
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="category_paging">
			<?php 
				for($i=1;$i<=$so_trang;$i++) {
					$link_phan_trang="?thamso=hoa_don&trang=".$i;
					echo "<a href='$link_phan_trang' class='phan_trang' >";
						echo $i;
					echo "</a> ";
				}
			?>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
	var citis = document.getElementById("city");
    var districts = document.getElementById("district");
    var Parameter = {
        url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json", 
        method: "GET", 
        responseType: "application/json", 
    };
    var promise = axios(Parameter);
    promise.then(function (result) {
        renderCity(result.data);
    });

function renderCity(data) {
    for (const x of data)
        citis.options[citis.options.length] = new Option(x.Name, x.Name);
    citis.onchange = function () {
        district.length = 1;
        if(this.value != "") {
            const result = data.filter(n => n.Name === this.value);
            for (const k of result[0].Districts)
                districts.options[districts.options.length] = new Option(k.Name, k.Name);
        }
    };
}
</script>