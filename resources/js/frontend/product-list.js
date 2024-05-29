import $ from 'jquery';
window.jQuery = $;
window.$ = $;

$(document).ready(function() {
    let timeoutId;

    $('#product-search').on('keyup', function() {
        clearTimeout(timeoutId); 
        
        timeoutId = setTimeout(function() {
            let query = $('#product-search').val().trim(); 
            let slug = $('#category-slug').val();
            
            $.ajax({
                url: "/search-products", 
                type: "GET",
                data: { query: query, category_slug: slug  },
                success: function(data) {
                    console.log('Success:', data);  
                    
                    $('.product-list-wrapper').empty();

                    if (data.length > 0) {
                        $('.product-list-wrapper').addClass('tw-grid');
                        $.each(data, function(index, product) {
                            let productHTML = `
                                <div class="product-col">
                                    <div class="item_product_main">
                                        <div class="variants product-action tw-flex tw-flex-col tw-gap-2">
                                            <div class="product-thumbnail">
                                                <a class="image_thumb" href="/product-detail/${product.slug}" title="">
                                                    <span class="imgWrap pt_100">
                                                        <div class="imgWrap-item tw-w-full tw-h-[320px]">
                                                            <img class="lazyload loaded tw-rounded-2xl tw-h-full" src="${product.photo}" alt="${product.title}" data-was-processed="true">
                                                        </div>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="product-info tw-flex tw-flex-col tw-items-center tw-gap-1">
                                                <h3 class="product-name tw-font-bold tw-text-lg">
                                                    <a href="/product-detail/${product.slug}" class="hover:tw-text-yellow-500" title="">${product.title}</a>
                                                </h3>
                                                <div class="price-box">
                                                    <span class="price-title">Giá từ: <span class="min-price tw-font-bold">${new Intl.NumberFormat().format(product.price)}đ</span></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            $('.product-list-wrapper').append(productHTML);
                        });
                    } else {
                        $('.product-list-wrapper').removeClass('tw-grid')
                        $('.product-list-wrapper').html('<div class="tw-p-4 tw-bg-yellow-200 tw-text-black"><span>No products found. Please find the other products</span></div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);  
                }
            });
            
        }, 300);
    });
});


    
