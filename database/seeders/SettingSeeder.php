<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;
use App\Models\SettingTranslation;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'about',
                'image_path' => '/storage/images/hand-earth.png',
                'parent_id' => 0,
                'translations' => [
                    'vi' => [
                        'name' => 'Giới Thiệu',
                        'description' => '<p class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        Tận tâm để mang lại cho khách hàng sản phẩm và dịch vụ vượt trên sự mong đợi là tôn chỉ của công ty TNHH ĐÀO TẠO TƯ VẤN VỀ QUẢN LÝ VÀ ĐẦU TƯ. Qua hơn 20 năm thành lập và hoạt động, công ty đang tiếp tục mở rộng hoạt động kinh doanh để cung cấp sản phẩm, dịch vụ tư vấn tạo ra các giá trị bền vững cho sự phát triển của khách hàng.
                        <span class="block pt-2">Mọi hoạt động của công ty đều dựa trên các giá trị cốt lõi, cam kết về chất lượng đối với khách hàng, đối tác, với xã hội, với chính công ty và từng nhân viên. Những giá trị này là nền tảng cho mọi hoạt động để công ty trở thành một doanh nghiệp kinh doanh sáng tạo vì con người.</span>
                    </p>'
                    ],
                    'en' => [
                        'name' => 'ABOUT US',
                        'description' => '<p class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        Tận tâm để mang lại cho khách hàng sản phẩm và dịch vụ vượt trên sự mong đợi là tôn chỉ của công ty TNHH ĐÀO TẠO TƯ VẤN VỀ QUẢN LÝ VÀ ĐẦU TƯ. Qua hơn 20 năm thành lập và hoạt động, công ty đang tiếp tục mở rộng hoạt động kinh doanh để cung cấp sản phẩm, dịch vụ tư vấn tạo ra các giá trị bền vững cho sự phát triển của khách hàng.
                        <span class="block pt-2">Mọi hoạt động của công ty đều dựa trên các giá trị cốt lõi, cam kết về chất lượng đối với khách hàng, đối tác, với xã hội, với chính công ty và từng nhân viên. Những giá trị này là nền tảng cho mọi hoạt động để công ty trở thành một doanh nghiệp kinh doanh sáng tạo vì con người.</span>
                    </p>'
                    ]
                ]
            ],
            [
                'key' => 'library_images',
                'image_path' => 'images/svg/gallary1.svg',
                'parent_id' => 0,
                'translations' => [
                    'vi' => [
                        'name' => 'Thư viện hình ảnh',
                        'description' => 'Thư viện hình ảnh'
                    ],
                    'en' => [
                        'name' => 'Library Images',
                        'description' => 'Library Images'
                    ]
                ]
            ],
            [
                'key' => 'library_videos',
                'image_path' => 'images/svg/gallary2.svg',
                'parent_id' => 0,
                'translations' => [
                    'vi' => [
                        'name' => 'Thư viện video',
                        'description' => 'Thư viện video'
                    ],
                    'en' => [
                        'name' => 'Library Videos',
                        'description' => 'Library Videos'
                    ]
                ]
            ],
            [
                'key' => 'library_documents',
                'image_path' => 'images/svg/gallary3.svg',
                'parent_id' => 0,
                'translations' => [
                    'vi' => [
                        'name' => 'Thư viện tài liệu',
                        'description' => 'Thư viện tài liệu'
                    ],
                    'en' => [
                        'name' => 'Library Documents',
                        'description' => 'Library Documents'
                    ]
                ]
            ],
            [
                'key' => 'about_us',
                'image_path' => '/storage/images/hand-earth.png',
                'parent_id' => 1,
                'translations' => [
                    'vi' => [
                        'name' => 'Giới thiệu Ban Quản Lý Dự Án Đầu Tư Xây Dựng Hạ Tầng Đô Thị',
                        'description' => 'Ban Quản lý Dự án đầu tư xây dựng hạ tầng đô thị Thành phố Hồ Chí Minh là đơn vị sự nghiệp công lập trực thuộc Ủy ban nhân dân Thành phố, hoạt động theo cơ chế tự chủ về tài chính, tự bảo đảm chi thường xuyên theo quy định hiện hành; chịu sự chỉ đạo, quản lý trực tiếp và toàn diện của Ủy ban nhân dân Thành phố, đồng thời chịu sự kiểm tra, thanh tra và hướng dẫn về chuyên môn của Sở quản lý chuyên ngành theo quy định của pháp luật.'
                    ],
                    'en' => [
                        'name' => 'INTRODUCTION TO THE MANAGEMENT BOARD OF THE PROJECT INVESTMENT AND CONSTRUCTION OF URBAN INFRASTRUCTURE',
                        'description' => 'The Management Board of the Project Investment and Construction of Urban Infrastructure of Ho Chi Minh City is a public institution directly under the People’s Committee of the City, operating under a self-financing mechanism in terms of finance, self-financing regular expenses according to current regulations; subject to the direct guidance and management of the People’s Committee of the City, while subject to inspection, supervision and guidance on technical matters by the Department of Management of the relevant sector according to the regulations of the law.'
                    ]
                ]
            ],
            [
                'key' => 'project',
                'image_path' => 'images/about-img.svg',
                'parent_id' => 1,
                'translations' => [
                    'vi' => [
                        'name' => 'Dự án VSMT TP. HCM (HCM-CES)',
                        'description' => '<div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        <p class="mb-4">
                            Dự án Vệ sinh môi trường TP.HCM giai đoạn 2 là một trong những dự án hạ tầng môi trường trọng điểm của thành phố, nhằm cải thiện chất lượng nước và hệ thống thoát nước cho lưu vực kênh Nhiêu Lộc – Thị Nghè và khu vực quận 2 cũ (nay là TP. Thủ Đức).
                        </p>
                        <p class="mb-4">
                            <span class="text-[#46AF08] font-bold">Tổng vốn đầu tư:</span>
                            khoảng 11.133 tỷ đồng (tương đương 524 triệu USD), trong đó 450 triệu USD là vốn vay ODA từ Ngân hàng Thế giới, phần còn lại là vốn đối ứng từ ngân sách TP.HCM.
                        </p>
                        <p>
                            <span class="text-[#46AF08] font-bold">Mục tiêu:</span>
                            hoàn chỉnh hệ thống thu gom và xử lý nước thải cho toàn bộ lưu vực Nhiêu Lộc – Thị Nghè và một phần TP. Thủ Đức, góp phần cải thiện môi trường sống và sức khỏe người dân.
                        </p>
                    </div>'
                    ],
                    'en' => [
                        'name' => 'PROJECT VSMT TP. HCM (HCM-CES)',
                        'description' => '<div class="text-gray-600 w-full text-justify text-xs md:text-sm 2xl:text-base">
                        <p class="mb-4">
                            The VSMT project of Ho Chi Minh City Phase 2 is one of the key environmental infrastructure projects in the city, aiming to improve the quality of water and sewage systems for the Nhiêu Lộc – Thị Nghè watershed and the old district 2 (now Thủ Đức).
                        </p>
                        <p class="mb-4">
                            <span class="text-[#46AF08] font-bold">Total investment:</span>
                            khoảng 11.133 tỷ đồng (tương đương 524 triệu USD), trong đó 450 triệu USD là vốn vay ODA từ Ngân hàng Thế giới, phần còn lại là vốn đối ứng từ ngân sách TP.HCM.
                        </p>
                        <p>
                            <span class="text-[#46AF08] font-bold">Mục tiêu:</span>
                            hoàn chỉnh hệ thống thu gom và xử lý nước thải cho toàn bộ lưu vực Nhiêu Lộc – Thị Nghè và một phần TP. Thủ Đức, góp phần cải thiện môi trường sống và sức khỏe người dân.
                        </p>
                    </div>'
                    ]
                ]
            ],
            [
                'key' => 'meaning',
                'image_path' => 'images/about-img-1.svg',
                'parent_id' => 1,
                'translations' => [
                    'vi' => [
                        'name' => 'Ý nghĩa của dự án',
                        'description' => 'Dự án không chỉ góp phần cải thiện môi trường nước và hệ thống thoát nước cho TP.HCM mà còn nâng cao chất lượng sống cho người dân, giảm thiểu ô nhiễm và bảo vệ hệ sinh thái sông Sài Gòn và hạ lưu sông Đồng Nai.'
                    ],
                    'en' => [
                        'name' => 'MEANING OF THE PROJECT',
                        'description' => 'The project not only contributes to improving the water quality and sewage system of Ho Chi Minh City but also improves the quality of life for residents, reducing pollution and protecting the Sài Gòn River and the lower reaches of the Đồng Nai River.'
                    ]
                ]
            ],
            [
                'key' => 'logo',
                'image_path' => '/images/svg/logo.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Logo',
                        'description' => 'Logo'
                    ],
                    'en' => [
                        'name' => 'Logo',
                        'description' => 'Logo'
                    ]
                ]
            ],
            [
                'key' => 'copyright',
                'image_path' => '/images/svg/logo.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Copyright',
                        'description' => '<p class="text-sm text-gray-400 text-center lg:text-left">
                            Copyright © 2023 Imct Company<br>
                            All Rights Reserved.
                        </p>'
                    ],
                    'en' => [
                        'name' => 'Copyright',
                        'description' => '<p class="text-sm text-gray-400 text-center lg:text-left">
                            Copyright © 2023 Imct Company<br>
                            All Rights Reserved.
                        </p>'
                    ]
                ]
            ],
            //Thông tin liên hệ
            [
                'key' => 'phone',
                'image_path' => '/images/svg/phone.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Số điện thoại',
                        'description' => '0909 999 999'
                    ],
                    'en' => [
                        'name' => 'Phone Number',
                        'description' => '0909 999 999'
                    ]
                ]
            ],
            //Địa chỉ
            [
                'key' => 'address',
                'image_path' => '/images/svg/location.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Địa chỉ',
                        'description' => 'abcxyzzzzzzzzzzzzzzzzzzzzz'
                    ],
                    'en' => [
                        'name' => 'Address',
                        'description' => 'abcxyzzzzzzzzzzzzzzzzzzzzz'
                    ]
                ]
            ],
            //Email
            [
                'key' => 'email',
                'image_path' => '/images/svg/email.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Email',
                        'description' => 'info@duanvesinhmoitruong.com'
                    ],
                    'en' => [
                        'name' => 'Email',
                        'description' => 'info@duanvesinhmoitruong.com'
                    ]
                ]
            ],
            //Facebook
            [
                'key' => 'facebook',
                'image_path' => '/images/svg/facebook-green.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Facebook',
                        'description' => 'https://www.facebook.com/duanvesinhmoitruong'
                    ],
                    'en' => [
                        'name' => 'Facebook',
                        'description' => 'https://www.facebook.com/duanvesinhmoitruong'
                    ]
                ]
            ],
            //Youtube
            [
                'key' => 'youtube',
                'image_path' => '/images/svg/youtube-green.svg',
                'parent_id' => 2,
                'translations' => [
                    'vi' => [
                        'name' => 'Youtube',
                        'description' => 'https://www.youtube.com/duanvesinhmoitruong'
                    ],
                    'en' => [
                        'name' => 'Youtube',
                        'description' => 'https://www.youtube.com/duanvesinhmoitruong'
                    ]
                ]
            ]
        ];

        foreach ($settings as $settingData) {
            // Tạo setting
            $setting = Setting::create([
                'active' => true,
                'image_path' => $settingData['image_path'],
                'key' => $settingData['key'],
                'parent_id' => $settingData['parent_id'] ?? 0
            ]);

            // Tạo translations cho setting
            foreach ($settingData['translations'] as $lang => $translation) {
                SettingTranslation::create([
                    'setting_id' => $setting->id,
                    'language' => $lang,
                    'name' => $translation['name'],
                    'description' => $translation['description']
                ]);
            }
        }
    }
}
