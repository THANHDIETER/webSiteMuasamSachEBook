<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="/submit-address" method="post" class="border p-4 rounded shadow-sm">
            <h2 class="mb-4">ĐỊA CHỈ GIAO HÀNG</h2>
            
            <div class="mb-3">
                <label for="name" class="form-label">Họ tên *</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email nhận đơn hàng *</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">Quốc gia *</label>
                <select id="country" name="country" class="form-select" required>
                    <option value="Vietnam">Việt Nam</option>
                    <option value="USA">Hoa Kỳ</option>
                    <option value="Japan">Nhật Bản</option>
                    <option value="South Korea">Hàn Quốc</option>
                    <option value="France">Pháp</option>
                    <!-- Add more countries as needed -->
                </select>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Tỉnh / Thành Phố *</label>
                <select id="city" name="city" class="form-select" required>
                    <option value="">Chọn Tỉnh / Thành Phố</option>
                    <option value="Ha Noi">Hà Nội</option>
                    <option value="Ho Chi Minh">TP. Hồ Chí Minh</option>
                    <option value="Da Nang">Đà Nẵng</option>
                    <option value="Hai Phong">Hải Phòng</option>
                    <option value="Can Tho">Cần Thơ</option>
                    <option value="An Giang">An Giang</option>
                    <option value="Ba Ria-Vung Tau">Bà Rịa - Vũng Tàu</option>
                    <option value="Bac Giang">Bắc Giang</option>
                    <option value="Bac Kan">Bắc Kạn</option>
                    <option value="Bac Lieu">Bạc Liêu</option>
                    <option value="Bac Ninh">Bắc Ninh</option>
                    <option value="Ben Tre">Bến Tre</option>
                    <option value="Binh Dinh">Bình Định</option>
                    <option value="Binh Duong">Bình Dương</option>
                    <option value="Binh Phuoc">Bình Phước</option>
                    <option value="Binh Thuan">Bình Thuận</option>
                    <option value="Ca Mau">Cà Mau</option>
                    <option value="Cao Bang">Cao Bằng</option>
                    <option value="Dak Lak">Đắk Lắk</option>
                    <option value="Dak Nong">Đắk Nông</option>
                    <option value="Dien Bien">Điện Biên</option>
                    <option value="Dong Nai">Đồng Nai</option>
                    <option value="Dong Thap">Đồng Tháp</option>
                    <option value="Gia Lai">Gia Lai</option>
                    <option value="Ha Giang">Hà Giang</option>
                    <option value="Ha Nam">Hà Nam</option>
                    <option value="Ha Tinh">Hà Tĩnh</option>
                    <option value="Hai Duong">Hải Dương</option>
                    <option value="Hau Giang">Hậu Giang</option>
                    <option value="Hoa Binh">Hòa Bình</option>
                    <option value="Hung Yen">Hưng Yên</option>
                    <option value="Khanh Hoa">Khánh Hòa</option>
                    <option value="Kien Giang">Kiên Giang</option>
                    <option value="Kon Tum">Kon Tum</option>
                    <option value="Lai Chau">Lai Châu</option>
                    <option value="Lam Dong">Lâm Đồng</option>
                    <option value="Lang Son">Lạng Sơn</option>
                    <option value="Lao Cai">Lào Cai</option>
                    <option value="Long An">Long An</option>
                    <option value="Nam Dinh">Nam Định</option>
                    <option value="Nghe An">Nghệ An</option>
                    <option value="Ninh Binh">Ninh Bình</option>
                    <option value="Ninh Thuan">Ninh Thuận</option>
                    <option value="Phu Tho">Phú Thọ</option>
                    <option value="Phu Yen">Phú Yên</option>
                    <option value="Quang Binh">Quảng Bình</option>
                    <option value="Quang Nam">Quảng Nam</option>
                    <option value="Quang Ngai">Quảng Ngãi</option>
                    <option value="Quang Ninh">Quảng Ninh</option>
                    <option value="Quang Tri">Quảng Trị</option>
                    <option value="Soc Trang">Sóc Trăng</option>
                    <option value="Son La">Sơn La</option>
                    <option value="Tay Ninh">Tây Ninh</option>
                    <option value="Thai Binh">Thái Bình</option>
                    <option value="Thai Nguyen">Thái Nguyên</option>
                    <option value="Thanh Hoa">Thanh Hóa</option>
                    <option value="Thua Thien-Hue">Thừa Thiên-Huế</option>
                    <option value="Tien Giang">Tiền Giang</option>
                    <option value="Tra Vinh">Trà Vinh</option>
                    <option value="Tuyen Quang">Tuyên Quang</option>
                    <option value="Vinh Long">Vĩnh Long</option>
                    <option value="Vinh Phuc">Vĩnh Phúc</option>
                    <option value="Yen Bai">Yên Bái</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="district" class="form-label">Quận / Huyện *</label>
                <select id="district" name="district" class="form-select" required>
                    <option value="">Chọn Quận / Huyện</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Số nhà & tên đường *</label>
                <textarea id="address" name="address" rows="2" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Di động *</label>
                <input type="tel" id="phone" name="phone" class="form-control" required pattern="[0-9]{10}">
            </div>

            <div class="mb-3">
                <label class="form-label">Đây là:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="home" value="home" checked>
                    <label class="form-check-label" for="home">Nhà riêng</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="work" value="work">
                    <label class="form-check-label" for="work">Nơi làm việc</label>
                </div>
            </div>

            <button type="submit" class="btn btn-warning w-100">Giao đến địa chỉ này</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const cityDistricts = {
    "Ha Noi": ["Ba Dinh", "Hoan Kiem","Chuong My", "Tay Ho", "Long Bien", "Cau Giay", "Dong Da", "Hai Ba Trung", "Thanh Xuan", "Hoai Duc", "Gia Lam", "Me Linh", "Soc Son", "Dong Anh", "Thanh Oai", "Thanh Tri", "Hoang Mai", "Nam Tu Liem", "Bac Tu Liem", "Son Tay", "Quoc Oai", "Phuc Tho", "Phu Xuyen", "Ba Vi", "My Duc"],
    "Ho Chi Minh": ["Quận 1", "Quận 2", "Quận 3", "Quận 4", "Quận 5", "Quận 6", "Quận 7", "Quận 8", "Quận 9", "Quận 10", "Quận 11", "Quận 12", "Binh Tan", "Binh Thanh", "Tan Binh", "Go Vap", "Phu Nhuan", "Tan Phu", "Thu Duc", "Can Gio", "Nha Be", "Cu Chi", "Hoc Mon", "Binh Chanh"],
    "An Giang": ["Long Xuyen", "Chau Doc", "An Phu", "Thoai Son", "Tinh Bien", "Tri Ton", "Chau Phu", "Chau Thanh", "Phu Tan", "Cho Moi"],
    "Ba Ria - Vung Tau": ["Vung Tau", "Ba Ria", "Con Dao", "Dat Do", "Long Dien", "Phu My", "Xuyen Moc"],
    "Bac Giang": ["Bac Giang City", "Lang Giang", "Yen Dung", "Yen The", "Luc Nam", "Luc Ngan", "Tan Yen", "Hiep Hoa", "Son Dong"],
    "Bac Kan": ["Bac Kan Town", "Ba Be", "Bach Thong", "Cho Don", "Cho Moi", "Na Ri", "Ngan Son", "Pac Nam"],
    "Bac Lieu": ["Bac Lieu City", "Dong Hai", "Gia Rai", "Hoa Binh", "Hong Dan", "Phuoc Long", "Vinh Loi"],
    "Bac Ninh": ["Bac Ninh City", "Gia Binh", "Luong Tai", "Que Vo", "Thuan Thanh", "Tien Du", "Tu Son", "Yen Phong"],
    "Ben Tre": ["Ben Tre City", "Ba Tri", "Binh Dai", "Chau Thanh", "Cho Lach", "Giong Trom", "Mo Cay Bac", "Mo Cay Nam", "Thanh Phu"],
    "Binh Dinh": ["Quy Nhon", "An Lao", "Hoai Nhon", "Hoai An", "Phu My", "Tay Son", "Tuy Phuoc", "Van Canh", "Vinh Thanh"],
    "Binh Duong": ["Thu Dau Mot", "Di An", "Tan Uyen", "Ben Cat", "Bau Bang", "Dau Tieng", "Phu Giao", "Bac Tan Uyen"],
    "Binh Phuoc": ["Dong Xoai", "Phuoc Long", "Binh Long", "Bu Dang", "Bu Dop", "Chon Thanh", "Dong Phu", "Hon Quan", "Loc Ninh"],
    "Binh Thuan": ["Phan Thiet", "La Gi", "Bac Binh", "Duc Linh", "Ham Tan", "Ham Thuan Bac", "Ham Thuan Nam", "Phu Quy", "Tuy Phong"],
    "Ca Mau": ["Ca Mau City", "Cai Nuoc", "Dam Doi", "Nam Can", "Ngoc Hien", "Phu Tan", "Thoi Binh", "Tran Van Thoi", "U Minh"],
    "Can Tho": ["Ninh Kieu", "Binh Thuy", "Cai Rang", "O Mon", "Thot Not", "Phong Dien", "Co Do", "Thoi Lai", "Vinh Thanh"],
    "Cao Bang": ["Cao Bang City", "Bao Lac", "Bao Lam", "Ha Lang", "Ha Quang", "Hoa An", "Nguyen Binh", "Phuc Hoa", "Quang Hoa", "Thach An", "Tra Linh"],
    "Dak Lak": ["Buon Ma Thuot", "Buon Don", "Cu Kuin", "Ea Kar", "Ea Sup", "Krông Ana", "Krông Bong", "Krông Buk", "Krông Năng", "Krông Pắc", "Lak", "M'Đrak"],
    "Dak Nong": ["Gia Nghia", "Cu Jut", "Dak Glong", "Dak Mil", "Dak R'Lap", "Dak Song", "Krong No", "Tuy Duc"],
    "Dien Bien": ["Dien Bien Phu", "Muong Lay", "Dien Bien", "Muong Cha", "Muong Ang", "Nam Po", "Tua Chua", "Tuan Giao"],
    "Dong Nai": ["Bien Hoa", "Long Khanh", "Cam My", "Long Thanh", "Nhon Trach", "Trang Bom", "Vinh Cuu", "Tan Phu"],
    "Dong Thap": ["Cao Lanh", "Sa Dec", "Hong Ngu", "Chau Thanh", "Thanh Binh", "Tam Nong", "Thap Muoi", "Lai Vung", "Lap Vo"],
    "Gia Lai": ["Pleiku", "An Khe", "Ayun Pa", "Chu Pah", "Chu Se", "Dak Doa", "Ia Grai", "Ia Pa", "K'Bang", "Krong Pa", "Mang Yang", "Phu Thien"],
    "Ha Giang": ["Ha Giang City", "Bac Me", "Dong Van", "Hoang Su Phi", "Meo Vac", "Quan Ba", "Quang Binh", "Vi Xuyen", "Xin Man", "Yen Minh"],
    "Ha Nam": ["Phu Ly", "Binh Luc", "Duy Tien", "Kim Bang", "Ly Nhan", "Thanh Liem"],
    "Ha Tinh": ["Ha Tinh City", "Hong Linh", "Cam Xuyen", "Can Loc", "Duc Tho", "Huong Khe", "Huong Son", "Ky Anh", "Loc Ha", "Nghi Xuan", "Thach Ha", "Vu Quang"],
    "Hai Duong": ["Hai Duong City", "Chi Linh", "Binh Giang", "Cam Giang", "Gia Loc", "Kim Thanh", "Kinh Mon", "Nam Sach", "Ninh Giang", "Thanh Ha", "Thanh Mien", "Tu Ky"],
    "Hoa Binh": ["Hoa Binh City", "Cao Phong", "Da Bac", "Kim Boi", "Ky Son", "Lac Son", "Lac Thuy", "Mai Chau", "Tan Lac", "Yen Thuy"],
    "Hung Yen": ["Hung Yen City", "An Thi", "Khoai Chau", "Kim Dong", "My Hao", "Phu Cu", "Tien Lu", "Van Giang", "Van Lam", "Yen My"],
    "Kon Tum": ["Kon Tum City", "Dak Glei", "Dak Ha", "Dak To", "Kon Plong", "Kon Ray", "Ngoc Hoi", "Sa Thay", "Tu Mo Rong"],
    "Lai Chau": ["Lai Chau City", "Muong Te", "Nam Nhun", "Phong Tho", "Sin Ho", "Tam Duong", "Tan Uyen", "Than Uyen"],
    "Lang Son": ["Lang Son City", "Bac Son", "Binh Gia", "Cao Loc", "Chi Lang", "Dinh Lap", "Huu Lung", "Loc Binh", "Trang Dinh", "Van Lang", "Van Quan"],
    "Lao Cai": ["Lao Cai City", "Bac Ha", "Bao Thang", "Bao Yen", "Bat Xat", "Muong Khuong", "Sa Pa", "Si Ma Cai", "Van Ban"],
    "Lam Dong": ["Da Lat", "Bao Loc", "Bao Lam", "Cat Tien", "Da Huoai", "Da Teh", "Dam Rong", "Don Duong", "Duc Trong", "Lac Duong", "Lam Ha"],
    "Nam Dinh": ["Nam Dinh City", "Giao Thuy", "Hai Hau", "My Loc", "Nam Truc", "Nghia Hung", "Truc Ninh", "Vu Ban", "Xuan Truong", "Y Yen"],
    "Ninh Binh": ["Ninh Binh City", "Tam Diep", "Gia Vien", "Hoa Lu", "Kim Son", "Nho Quan", "Yen Khanh", "Yen Mo"],
    "Quang Binh": ["Dong Hoi", "Ba Don", "Bo Trach", "Le Thuy", "Minh Hoa", "Quang Ninh", "Tuyen Hoa"],
    "Quang Nam": ["Tam Ky", "Hoi An", "Dien Ban", "Duy Xuyen", "Nam Giang", "Nam Tra My", "Nong Son", "Phu Ninh", "Phuoc Son", "Que Son", "Thang Binh", "Tien Phuoc"],
    "Son La": ["Son La City", "Bac Yen", "Mai Son", "Moc Chau", "Muong La", "Phu Yen", "Quynh Nhai", "Song Ma", "Sop Cop", "Thuan Chau", "Yen Chau"],
    "Thai Binh": ["Thai Binh City", "Dong Hung", "Hung Ha", "Kien Xuong", "Quynh Phu", "Tien Hai", "Thai Thuy", "Vu Thu"],
    "Thai Nguyen": ["Thai Nguyen City", "Pho Yen", "Song Cong", "Dai Tu", "Dong Hy", "Phu Binh", "Phu Luong", "Vo Nhai"],
    "Tuyen Quang": ["Tuyen Quang City", "Chiem Hoa", "Ham Yen", "Lam Binh", "Na Hang", "Son Duong", "Yen Son"],
    "Vinh Long": ["Vinh Long City", "Binh Minh", "Binh Tan", "Long Ho", "Mang Thit", "Tam Binh", "Tra On", "Vung Liem"],
    "Yen Bai": ["Yen Bai City", "Nghia Lo", "Luc Yen", "Mu Cang Chai", "Tram Tau", "Van Chan", "Van Yen", "Yen Binh"],
    "Bac Kan": ["Bac Kan City", "Ba Be", "Bach Thong", "Cho Don", "Cho Moi", "Na Ri", "Ngan Son", "Pac Nam"],
    "Ben Tre": ["Ben Tre City", "Ba Tri", "Binh Dai", "Chau Thanh", "Giong Trom", "Mo Cay Bac", "Mo Cay Nam", "Thanh Phu"],
    "Ca Mau": ["Ca Mau City", "Cai Nuoc", "Dam Doi", "Nam Can", "Ngoc Hien", "Phu Tan", "Thoi Binh", "Tran Van Thoi", "U Minh"],
    "Dak Nong": ["Gia Nghia", "Cu Jut", "Dak G'Long", "Dak Mil", "Dak R'Lap", "Krong No", "Tuy Duc"],
    "Khanh Hoa": ["Nha Trang", "Cam Ranh", "Ninh Hoa", "Van Ninh", "Khanh Son", "Khanh Vinh", "Dien Khanh", "Cam Lam", "Truong Sa"],
    "Ninh Thuan": ["Phan Rang - Thap Cham", "Bac Ai", "Ninh Hai", "Ninh Phuoc", "Ninh Son", "Thuan Bac", "Thuan Nam"],
    "Phu Tho": ["Viet Tri", "Phu Tho Town", "Cam Khe", "Doan Hung", "Ha Hoa", "Lam Thao", "Phu Ninh", "Tam Nong", "Tan Son", "Thanh Ba", "Thanh Son", "Thanh Thuy", "Yen Lap"],
    "Phu Yen": ["Tuy Hoa", "Song Cau", "Dong Hoa", "Dong Xuan", "Phu Hoa", "Son Hoa", "Song Hinh", "Tay Hoa"],
    "Quang Tri": ["Dong Ha", "Quang Tri Town", "Cam Lo", "Con Co", "Gio Linh", "Hai Lang", "Huong Hoa", "Dakrong", "Trieu Phong", "Vinh Linh"],
    "Soc Trang": ["Soc Trang City", "Nga Nam", "Vinh Chau", "Chau Thanh", "Cu Lao Dung", "Ke Sach", "Long Phu", "My Tu", "My Xuyen", "Thanh Tri", "Tran De"],
    "Tra Vinh": ["Tra Vinh City", "Cang Long", "Cau Ke", "Cau Ngang", "Chau Thanh", "Duyen Hai", "Tra Cu", "Tieu Can"],
    "Quang Ngai": ["Quang Ngai City", "Ba To", "Binh Son", "Duc Pho", "Ly Son", "Minh Long", "Mo Duc", "Nghia Hanh", "Son Ha", "Son Tay", "Son Tinh", "Tra Bong", "Tu Nghia"],
    "Hau Giang": ["Vi Thanh", "Nga Bay", "Chau Thanh", "Chau Thanh A", "Long My", "Phung Hiep", "Vi Thuy"],
    "Kien Giang": ["Rach Gia", "Ha Tien", "An Bien", "An Minh", "Chau Thanh", "Giang Thanh", "Giong Rieng", "Go Quao", "Hon Dat", "Kien Hai", "Phu Quoc", "Tan Hiep", "U Minh Thuong", "Vinh Thuan"],
   
   


};


        
        const citySelect = document.getElementById("city");
        const districtSelect = document.getElementById("district");

        citySelect.addEventListener("change", () => {
            const selectedCity = citySelect.value;
            districtSelect.innerHTML = '<option value="">Chọn Quận / Huyện</option>'; // Reset districts

            if (selectedCity && cityDistricts[selectedCity]) {
                cityDistricts[selectedCity].forEach(district => {
                    const option = document.createElement("option");
                    option.value = district;
                    option.textContent = district;
                    districtSelect.appendChild(option);
                });
            }
        });

       </script>
       
       </body>
       </html>