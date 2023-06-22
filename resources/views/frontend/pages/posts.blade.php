@extends('frontend.layouts.master')

@section('title', env('APP_NAME') . ' || Posts')

@section('main-content')

@include('frontend.layouts.header_fe')


@php
    $svgContent = file_get_contents(public_path('frontend/svg/posts.svg'));
    echo $svgContent;
  @endphp

<div class="post-wrap padding-large overflow-hidden">
    <div class="container">
        <div class="row">
            <main class="post-grid">
                <div class="row">
                    <article class="post-item mt-5">
                        <div class="post-content">
                            <div class="post-meta text-uppercase">
                                <span class="post-category">June 22, 2023  </span> / <span class="meta-date">-  technology</span>
                            </div>
                            <h1 class="post-title">Ảnh thực tế kính Vision Pro của Apple</h1>
                            <div class="hero-image col-lg-12 mt-5">
                                <img src="{{ asset('frontend/images/post_visionpro_1.png') }}" alt="single-post" class="img-fluid">
                            </div>
                            <div class="post-description review-item padding-medium">
                                <p>
                                    <strong>Vision Pro là sản phẩm thu hút sự chú ý nhất tại Hội nghị dành cho các nhà phát triển WWDC 2023 của Apple, diễn ra rạng sáng 6/6 tại California.</strong>
                                </p>
                                <p>Hàng trăm người tham dự có thể quan sát nhưng chưa được phép chạm vào hay trải nghiệm thiết bị được coi là "đến từ tương lai" của Apple. Hãng chỉ trưng bày tám chiếc Vision Pro ở tầng dưới của hội trường Steve Jobs Theater trong khuôn viên trụ sở Apple Park.</p>
                                
                                {{-- <ul style="list-style-type:disc;" class="inner-list">
                                    <li>Blandit mauris libero condimentum commodo sociis convallis sit.</li>
                                    <li>Magna diam amet justo sed vel dolor et volutpat integer.</li>
                                    <li>Laculis sit sapien hac odio elementum egestas neque.</li>
                                </ul> --}}
                                <p>Vision Pro thoạt nhìn giống chiếc kính cho bộ môn trượt tuyết nhưng đẹp và hiện đại hơn. Đây có thể coi là kính VR/AR có thiết kế hấp dẫn nhất khi so với các sản phẩm khác như Meta Quest 2, Quest 3, HTC Vive Pro 2 hay Oppo MR Glass.</p>
                                
                                <div class="hero-image col-lg-12 mt-5">
                                    <img src="{{ asset('frontend/images/post_visionpro_2.png') }}" alt="single-post" class="img-fluid">
                                </div>

                                <p>Kính có ba thành phần tách biệt là linh kiện mắt kính phía trước, tấm chắn bằng vải ngay phía sau để phù hợp với nhiều loại khuôn mặt khác nhau và phần dây đeo qua đầu. Thân kính được làm từ nhôm, bo tròn ở các góc khá giống tai nghe AirPods Max. Quan sát thực tế cho thấy chất lượng hoàn thiện tốt, khớp nối giữa các thành phần được làm đồng đều, liền mạch. Apple chưa công bố trọng lượng của sản phẩm.</p>
                               
                                {{-- <img src="images/post-image.jpg" alt="img-fluid" class="align-left pt-3 pe-3 pb-3"> --}}
                                {{-- <img src="images/post-image1.jpg" alt="img-fluid" class="align-left">
                                <p>
                                    <strong>Velit, praesent pharetra malesuada</strong>
                                </p> --}}
                                <p>TMàn hình phía trước hiển thị dải màu thay đổi đẹp mắt báo hiệu có người đang sử dụng. Tuy nhiên, sản phẩm demo tại lễ ra mắt không bật các chế độ khác. Trong video giới thiệu của Apple, phần mặt ngoài có thể hiển thị mắt người giả lập hiệu ứng như nhìn xuyên qua kính. Những người có tật về mắt có thể sử dụng Vision Pro bằng cách trang bị thêm cặp kính từ Zeiss.</p>
                               
                                <p>Phần cứng hiển thị của Vision Pro cũng là tốt nhất hiện nay trên một thiết bị thực tế ảo. Mỗi bên mắt kính sử dụng màn hình Micro LED 23 triệu điểm ảnh, mật độ cao hơn cả TV 4K cho mỗi mắt. Hệ thống thấu kính ba lớp giúp tăng hiệu quả hình ảnh ba chiều.</p>
                               
                                <p>Cách bố trí nút điều khiển của Vision Pro tương tự Apple Watch. Người dùng có một nút bấm chức năng ở phía trên mắt trái. Phần lồi lên ở phần gọng đeo hai bên dành chỗ cho loa phát âm thanh hỗ trợ công nghệ Spatial Audio.</p>
                               
                                <p>Phía trên mắt phải của kính là nút xoay giống Digital Crown của Apple Watch với tác dụng chuyển đổi các loại môi trường ảo. Bên trong được trang bị chip M2 để xử lý các tác vụ về thị giác máy tính, đồ họa, cùng một chip mới là R1 xử lý ảnh và âm thanh đầu vào. Sản phẩm chạy hệ điều hành hoàn toàn mới là visionOS. Tuy nhiên, Apple cho biết kính có thể chạy được hầu hết ứng dụng của iOS và iPadOS hiện tại.</p>
                                
                                <div class="hero-image col-lg-12 mt-5">
                                    <img src="{{ asset('frontend/images/post_visionpro_3.png') }}" alt="single-post" class="img-fluid">
                                </div>
                                
                                <p>Mặt dưới của kính là hàng loạt lỗ thoát nhiệt cùng đường cong giúp ôm vừa hầu hết hình dáng khuôn mặt khác nhau. Nhà sản xuất cũng tích hợp hệ thống 12 camera, 5 cảm biến và 6 microphone. Đây cũng là điểm tạo nên sự khác biệt của Vision Pro khi người dùng có thể tương tác với nội dung bằng thao tác cử chỉ tay và giọng nói. Ở bên trong, kính cũng có thể theo dõi chuyển động của mắt để nhận biết người dùng đang muốn nhìn, tương tác với nội dung nào.</p>
                                <p>Apple Vision Pro sẽ bán ra vào đầu năm sau với giá 3.499 USD.</p>

                                <div class="post-bottom-link d-flex justify-content-between">
                                    {{-- <div class="block-tag">
                                        <ul class="list-unstyled d-flex">
                                            <li class="pe-3">
                                                <a href="#">Tech</a>
                                            </li>
                                            <li class="pe-3">
                                                <a href="#">Tips</a>
                                            </li>
                                            <li class="pe-3">
                                                <a href="#">Gadgets</a>
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <div class="social-links d-flex">
                                        <div class="element-title pe-2">Share:</div>
                                        <ul class="d-flex list-unstyled">
                                            <li>
                                                <a href="#">
                                                    <svg class="facebook">
                            <use xlink:href="#facebook"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="instagram">
                            <use xlink:href="#instagram"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="twitter">
                            <use xlink:href="#twitter"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="linkedin">
                            <use xlink:href="#linkedin"></use>
                          </svg>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <svg class="youtube">
                            <use xlink:href="#youtube"></use>
                          </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="single-post-navigation" class="mb-5">
                                <div class="post-navigation d-flex flex-wrap align-items-center justify-content-between">
                                    <a itemprop="url" class="post-prev d-flex align-items-center" href="">
                                        <svg class="chevron-left">
                      <use xlink:href="#chevron-left"></use>
                    </svg>
                                        <span class="page-nav-title text-uppercase">Get some cool gadgets in 2023</span>
                                    </a>
                                    <a itemprop="url" class="post-next d-flex align-items-center" href="">
                                        <span class="page-nav-title text-uppercase">TOP 10 SMALL CAMERA IN THE WORLD</span>
                                        <svg class="chevron-right">
                      <use xlink:href="#chevron-right"></use>
                    </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>

                </div>
            </main>
        </div>
    </div>
</div>



{{-- thiếu dòng @endsection cho section maincontent sẽ bị mất head --}}
@endsection 


