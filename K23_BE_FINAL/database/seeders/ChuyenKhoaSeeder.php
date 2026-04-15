<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuyenKhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuyen_khoas')->truncate();

        DB::table('chuyen_khoas')->insert([
            [
                'ten_chuyen_khoa' => 'Nội hô hấp',
                'mo_ta' => 'Chuyên khoa nội hô hấp tập trung chẩn đoán và điều trị các bệnh lý như viêm phổi, hen phế quản, bệnh phổi tắc nghẽn mãn tính (COPD), viêm phế quản và các rối loạn hô hấp khác. Bác sĩ sử dụng kỹ thuật nội soi phế quản, đo chức năng hô hấp và chẩn đoán hình ảnh để hỗ trợ điều trị hiệu quả.',
            ],
            [
                'ten_chuyen_khoa' => 'Ngoại thần kinh',
                'mo_ta' => 'Chuyên khoa này phụ trách phẫu thuật các bệnh lý liên quan đến hệ thần kinh trung ương và ngoại biên, bao gồm u não, chấn thương sọ não, thoát vị đĩa đệm và dị tật cột sống. Các bác sĩ thường thực hiện phẫu thuật vi phẫu, nội soi và phẫu thuật xâm lấn tối thiểu nhằm giảm thiểu rủi ro và phục hồi nhanh chóng cho bệnh nhân.',
            ],
            [
                'ten_chuyen_khoa' => 'Da liễu thẩm mỹ',
                'mo_ta' => 'Chuyên sâu điều trị các vấn đề về da như mụn trứng cá, nám, tàn nhang, sẹo rỗ và lão hóa da. Áp dụng công nghệ cao như laser CO2, lăn kim, PRP và peel hóa học để cải thiện thẩm mỹ và sức khỏe làn da. Ngoài ra, còn thực hiện tư vấn chăm sóc da phù hợp với từng loại da và lứa tuổi.',
            ],
            [
                'ten_chuyen_khoa' => 'Tai Mũi Họng trẻ em',
                'mo_ta' => 'Tập trung khám và điều trị các bệnh tai mũi họng thường gặp ở trẻ nhỏ như viêm amidan, viêm tai giữa, viêm VA, polyp mũi. Bác sĩ sử dụng các thiết bị chuyên dụng dành cho trẻ để đảm bảo an toàn, hiệu quả và tạo cảm giác thoải mái cho trẻ trong suốt quá trình khám chữa bệnh.',
            ],
            [
                'ten_chuyen_khoa' => 'Sản khoa',
                'mo_ta' => 'Chuyên cung cấp dịch vụ chăm sóc tiền sản, quản lý thai kỳ, tư vấn sinh nở và xử lý các biến chứng thai kỳ như tiền sản giật, sinh non, và thai ngược. Bác sĩ sản khoa cũng hỗ trợ sinh thường và sinh mổ, đồng thời theo dõi hồi phục hậu sản nhằm đảm bảo sức khỏe tối ưu cho mẹ và bé.',
            ],
            [
                'ten_chuyen_khoa' => 'Phụ khoa',
                'mo_ta' => 'Chuyên điều trị các bệnh lý như viêm nhiễm phụ khoa, rối loạn kinh nguyệt, u xơ tử cung, lạc nội mạc tử cung và ung thư phụ khoa. Chuyên khoa này còn thực hiện khám tầm soát ung thư cổ tử cung, xét nghiệm Pap và điều trị vô sinh nữ. Bác sĩ áp dụng các kỹ thuật hiện đại để mang lại hiệu quả cao.',
            ],
            [
                'ten_chuyen_khoa' => 'Nhi hô hấp - tiêu hóa',
                'mo_ta' => 'Phụ trách chăm sóc và điều trị các bệnh lý về hô hấp, tiêu hóa và dinh dưỡng ở trẻ như viêm phổi, tiêu chảy cấp, táo bón kéo dài, suy dinh dưỡng. Bác sĩ nhi chuyên khoa hô hấp - tiêu hóa phối hợp chặt chẽ với gia đình để theo dõi và điều trị toàn diện cho trẻ một cách hiệu quả và nhẹ nhàng.',
            ],
            [
                'ten_chuyen_khoa' => 'Nội tiết người lớn',
                'mo_ta' => 'Chẩn đoán và điều trị các rối loạn nội tiết như tiểu đường, cường giáp, suy giáp, rối loạn mỡ máu và bệnh lý tuyến thượng thận. Bác sĩ nội tiết sử dụng phương pháp điều trị cá nhân hóa, hướng dẫn chế độ ăn uống và lối sống phù hợp nhằm kiểm soát bệnh hiệu quả và lâu dài.',
            ],
            [
                'ten_chuyen_khoa' => 'Tim mạch can thiệp',
                'mo_ta' => 'Chuyên khoa thực hiện các kỹ thuật như chụp mạch vành, đặt stent động mạch, can thiệp mạch ngoại vi, và điều trị suy tim bằng phương pháp ít xâm lấn. Bác sĩ tim mạch can thiệp làm việc trong môi trường hiện đại với các thiết bị chẩn đoán hình ảnh tiên tiến để giảm thời gian điều trị và tăng tỷ lệ thành công.',
            ],
            [
                'ten_chuyen_khoa' => 'Phẫu thuật chỉnh hình cột sống',
                'mo_ta' => 'Tập trung phẫu thuật điều trị các bệnh lý cột sống như thoát vị đĩa đệm, hẹp ống sống, trượt đốt sống, cong vẹo cột sống và chấn thương cột sống. Bác sĩ chỉnh hình sử dụng kỹ thuật bắt vít, tạo hình đốt sống và phục hồi chức năng để cải thiện chất lượng sống cho bệnh nhân.',
            ],
            [
                'ten_chuyen_khoa' => 'Tư vấn tâm lý học đường',
                'mo_ta' => 'Cung cấp dịch vụ tham vấn và trị liệu tâm lý cho học sinh, sinh viên với các vấn đề như căng thẳng, lo âu, trầm cảm, áp lực học tập hoặc mâu thuẫn gia đình. Bác sĩ tâm lý sử dụng liệu pháp nhận thức – hành vi (CBT), trị liệu nhóm và kỹ năng sống để giúp học sinh ổn định tinh thần và phát triển tích cực.',
            ],
            [
                'ten_chuyen_khoa' => 'Nội tổng quát',
                'mo_ta' => 'Chuyên khám và điều trị các bệnh lý nội khoa tổng quát như tăng huyết áp, rối loạn chuyển hóa, bệnh lý tiêu hóa, hô hấp, thận, cơ xương khớp và các bệnh lý mãn tính khác. Bác sĩ nội tổng quát phối hợp đa chuyên khoa để quản lý sức khỏe toàn diện cho bệnh nhân.',
            ],
            [
                'ten_chuyen_khoa' => 'Ngoại tổng quát',
                'mo_ta' => 'Chuyên thực hiện các phẫu thuật ngoại khoa phổ biến như cắt ruột thừa, thoát vị bẹn, sỏi mật, u bướu phần mềm và các chấn thương phần mềm. Bác sĩ ngoại tổng quát có kinh nghiệm xử lý cấp cứu ngoại khoa và phẫu thuật an toàn, hiệu quả.',
            ],
            [
                'ten_chuyen_khoa' => 'Chấn thương chỉnh hình',
                'mo_ta' => 'Chuyên điều trị các chấn thương xương khớp, gãy xương, trật khớp, tổn thương dây chằng, thoái hóa khớp và phẫu thuật thay khớp. Bác sĩ sử dụng kỹ thuật cố định xương, phẫu thuật nội soi và phục hồi chức năng vận động.',
            ],
            [
                'ten_chuyen_khoa' => 'Mắt',
                'mo_ta' => 'Chuyên khám, chẩn đoán và điều trị các bệnh lý về mắt như cận thị, viễn thị, loạn thị, đục thủy tinh thể, glôcôm, viêm kết mạc và phẫu thuật mắt. Bác sĩ mắt sử dụng các thiết bị hiện đại để đảm bảo an toàn và hiệu quả điều trị.',
            ],
            [
                'ten_chuyen_khoa' => 'Răng Hàm Mặt',
                'mo_ta' => 'Chuyên điều trị các bệnh lý răng miệng, chỉnh nha, phục hình răng, phẫu thuật hàm mặt, nhổ răng khôn, điều trị viêm lợi, sâu răng và tẩy trắng răng. Bác sĩ sử dụng công nghệ nha khoa tiên tiến, đảm bảo thẩm mỹ và sức khỏe răng miệng.',
            ],
            [
                'ten_chuyen_khoa' => 'Ung bướu',
                'mo_ta' => 'Chuyên chẩn đoán, điều trị các loại ung thư như ung thư vú, ung thư phổi, ung thư gan, ung thư dạ dày, ung thư đại trực tràng... Bác sĩ ung bướu phối hợp hóa trị, xạ trị, phẫu thuật và chăm sóc giảm nhẹ cho bệnh nhân.',
            ],
            [
                'ten_chuyen_khoa' => 'Hồi sức cấp cứu',
                'mo_ta' => 'Chuyên tiếp nhận, xử lý các trường hợp cấp cứu nội, ngoại khoa, hồi sức tim phổi, sốc, đa chấn thương, ngộ độc, đột quỵ. Đội ngũ bác sĩ, điều dưỡng được đào tạo chuyên sâu về hồi sức cấp cứu, trang bị đầy đủ thiết bị hiện đại.',
            ],
            [
                'ten_chuyen_khoa' => 'Thận - Tiết niệu',
                'mo_ta' => 'Chuyên khám và điều trị các bệnh lý về thận, tiết niệu như sỏi thận, viêm cầu thận, suy thận, viêm đường tiết niệu, phì đại tuyến tiền liệt, rối loạn tiểu tiện. Bác sĩ sử dụng các phương pháp nội soi, tán sỏi, lọc máu hiện đại.',
            ],
            [
                'ten_chuyen_khoa' => 'Tiêu hóa - Gan mật',
                'mo_ta' => 'Chuyên điều trị các bệnh lý về dạ dày, đại tràng, gan, mật, tụy như viêm gan, xơ gan, viêm tụy, sỏi mật, viêm loét dạ dày, polyp đại tràng. Bác sĩ sử dụng nội soi tiêu hóa, siêu âm, xét nghiệm chuyên sâu để chẩn đoán và điều trị.',
            ],
            [
                'ten_chuyen_khoa' => 'Nam khoa',
                'mo_ta' => 'Chuyên khám, tư vấn và điều trị các bệnh lý nam khoa như rối loạn cương dương, xuất tinh sớm, vô sinh nam, viêm nhiễm nam khoa, bệnh lây truyền qua đường tình dục. Bác sĩ nam khoa tư vấn điều trị cá nhân hóa, bảo mật thông tin bệnh nhân.',
            ],
        ]);
    }
}
