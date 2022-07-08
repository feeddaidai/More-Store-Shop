<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection goods_name
     * @property Grid\Column|Collection store_id
     * @property Grid\Column|Collection brand_id
     * @property Grid\Column|Collection category_id
     * @property Grid\Column|Collection goods_body
     * @property Grid\Column|Collection body_images
     * @property Grid\Column|Collection view_num
     * @property Grid\Column|Collection sale_num
     * @property Grid\Column|Collection collect_num
     * @property Grid\Column|Collection goods_attr
     * @property Grid\Column|Collection add_time
     * @property Grid\Column|Collection deleted_at
     * @property Grid\Column|Collection thumb_image
     * @property Grid\Column|Collection medium_image
     * @property Grid\Column|Collection big_image
     * @property Grid\Column|Collection goods_id
     * @property Grid\Column|Collection sku_name
     * @property Grid\Column|Collection main_image
     * @property Grid\Column|Collection images
     * @property Grid\Column|Collection goods_storage
     * @property Grid\Column|Collection is_default
     * @property Grid\Column|Collection putaway_status
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection msg
     * @property Grid\Column|Collection content
     * @property Grid\Column|Collection order_code
     * @property Grid\Column|Collection store_name
     * @property Grid\Column|Collection goods_amount
     * @property Grid\Column|Collection order_amount
     * @property Grid\Column|Collection shipping_fee
     * @property Grid\Column|Collection shipping_code
     * @property Grid\Column|Collection shipping_type
     * @property Grid\Column|Collection order_status
     * @property Grid\Column|Collection refund_status
     * @property Grid\Column|Collection refund_amount
     * @property Grid\Column|Collection payment_type
     * @property Grid\Column|Collection payment_time
     * @property Grid\Column|Collection trade_no
     * @property Grid\Column|Collection sale_type
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection log_msg
     * @property Grid\Column|Collection goods_price
     * @property Grid\Column|Collection goods_num
     * @property Grid\Column|Collection goods_image
     * @property Grid\Column|Collection goods_pay_price
     * @property Grid\Column|Collection pay_code
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection voucher_id
     * @property Grid\Column|Collection voucher_price
     * @property Grid\Column|Collection after_price
     * @property Grid\Column|Collection before_price
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection tokenable_type
     * @property Grid\Column|Collection tokenable_id
     * @property Grid\Column|Collection abilities
     * @property Grid\Column|Collection last_used_at
     * @property Grid\Column|Collection sku_id
     * @property Grid\Column|Collection spec_id
     * @property Grid\Column|Collection spec_name
     * @property Grid\Column|Collection spec_value
     * @property Grid\Column|Collection spec_sort
     * @property Grid\Column|Collection spec_type
     * @property Grid\Column|Collection value_select
     * @property Grid\Column|Collection type_name
     * @property Grid\Column|Collection sex
     * @property Grid\Column|Collection phone
     * @property Grid\Column|Collection wechat_account
     * @property Grid\Column|Collection wechat_unique_id
     * @property Grid\Column|Collection qq
     * @property Grid\Column|Collection birthday
     * @property Grid\Column|Collection email_verified_at
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection goods_name(string $label = null)
     * @method Grid\Column|Collection store_id(string $label = null)
     * @method Grid\Column|Collection brand_id(string $label = null)
     * @method Grid\Column|Collection category_id(string $label = null)
     * @method Grid\Column|Collection goods_body(string $label = null)
     * @method Grid\Column|Collection body_images(string $label = null)
     * @method Grid\Column|Collection view_num(string $label = null)
     * @method Grid\Column|Collection sale_num(string $label = null)
     * @method Grid\Column|Collection collect_num(string $label = null)
     * @method Grid\Column|Collection goods_attr(string $label = null)
     * @method Grid\Column|Collection add_time(string $label = null)
     * @method Grid\Column|Collection deleted_at(string $label = null)
     * @method Grid\Column|Collection thumb_image(string $label = null)
     * @method Grid\Column|Collection medium_image(string $label = null)
     * @method Grid\Column|Collection big_image(string $label = null)
     * @method Grid\Column|Collection goods_id(string $label = null)
     * @method Grid\Column|Collection sku_name(string $label = null)
     * @method Grid\Column|Collection main_image(string $label = null)
     * @method Grid\Column|Collection images(string $label = null)
     * @method Grid\Column|Collection goods_storage(string $label = null)
     * @method Grid\Column|Collection is_default(string $label = null)
     * @method Grid\Column|Collection putaway_status(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection msg(string $label = null)
     * @method Grid\Column|Collection content(string $label = null)
     * @method Grid\Column|Collection order_code(string $label = null)
     * @method Grid\Column|Collection store_name(string $label = null)
     * @method Grid\Column|Collection goods_amount(string $label = null)
     * @method Grid\Column|Collection order_amount(string $label = null)
     * @method Grid\Column|Collection shipping_fee(string $label = null)
     * @method Grid\Column|Collection shipping_code(string $label = null)
     * @method Grid\Column|Collection shipping_type(string $label = null)
     * @method Grid\Column|Collection order_status(string $label = null)
     * @method Grid\Column|Collection refund_status(string $label = null)
     * @method Grid\Column|Collection refund_amount(string $label = null)
     * @method Grid\Column|Collection payment_type(string $label = null)
     * @method Grid\Column|Collection payment_time(string $label = null)
     * @method Grid\Column|Collection trade_no(string $label = null)
     * @method Grid\Column|Collection sale_type(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection log_msg(string $label = null)
     * @method Grid\Column|Collection goods_price(string $label = null)
     * @method Grid\Column|Collection goods_num(string $label = null)
     * @method Grid\Column|Collection goods_image(string $label = null)
     * @method Grid\Column|Collection goods_pay_price(string $label = null)
     * @method Grid\Column|Collection pay_code(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection voucher_id(string $label = null)
     * @method Grid\Column|Collection voucher_price(string $label = null)
     * @method Grid\Column|Collection after_price(string $label = null)
     * @method Grid\Column|Collection before_price(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection tokenable_type(string $label = null)
     * @method Grid\Column|Collection tokenable_id(string $label = null)
     * @method Grid\Column|Collection abilities(string $label = null)
     * @method Grid\Column|Collection last_used_at(string $label = null)
     * @method Grid\Column|Collection sku_id(string $label = null)
     * @method Grid\Column|Collection spec_id(string $label = null)
     * @method Grid\Column|Collection spec_name(string $label = null)
     * @method Grid\Column|Collection spec_value(string $label = null)
     * @method Grid\Column|Collection spec_sort(string $label = null)
     * @method Grid\Column|Collection spec_type(string $label = null)
     * @method Grid\Column|Collection value_select(string $label = null)
     * @method Grid\Column|Collection type_name(string $label = null)
     * @method Grid\Column|Collection sex(string $label = null)
     * @method Grid\Column|Collection phone(string $label = null)
     * @method Grid\Column|Collection wechat_account(string $label = null)
     * @method Grid\Column|Collection wechat_unique_id(string $label = null)
     * @method Grid\Column|Collection qq(string $label = null)
     * @method Grid\Column|Collection birthday(string $label = null)
     * @method Grid\Column|Collection email_verified_at(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection goods_name
     * @property Show\Field|Collection store_id
     * @property Show\Field|Collection brand_id
     * @property Show\Field|Collection category_id
     * @property Show\Field|Collection goods_body
     * @property Show\Field|Collection body_images
     * @property Show\Field|Collection view_num
     * @property Show\Field|Collection sale_num
     * @property Show\Field|Collection collect_num
     * @property Show\Field|Collection goods_attr
     * @property Show\Field|Collection add_time
     * @property Show\Field|Collection deleted_at
     * @property Show\Field|Collection thumb_image
     * @property Show\Field|Collection medium_image
     * @property Show\Field|Collection big_image
     * @property Show\Field|Collection goods_id
     * @property Show\Field|Collection sku_name
     * @property Show\Field|Collection main_image
     * @property Show\Field|Collection images
     * @property Show\Field|Collection goods_storage
     * @property Show\Field|Collection is_default
     * @property Show\Field|Collection putaway_status
     * @property Show\Field|Collection price
     * @property Show\Field|Collection msg
     * @property Show\Field|Collection content
     * @property Show\Field|Collection order_code
     * @property Show\Field|Collection store_name
     * @property Show\Field|Collection goods_amount
     * @property Show\Field|Collection order_amount
     * @property Show\Field|Collection shipping_fee
     * @property Show\Field|Collection shipping_code
     * @property Show\Field|Collection shipping_type
     * @property Show\Field|Collection order_status
     * @property Show\Field|Collection refund_status
     * @property Show\Field|Collection refund_amount
     * @property Show\Field|Collection payment_type
     * @property Show\Field|Collection payment_time
     * @property Show\Field|Collection trade_no
     * @property Show\Field|Collection sale_type
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection log_msg
     * @property Show\Field|Collection goods_price
     * @property Show\Field|Collection goods_num
     * @property Show\Field|Collection goods_image
     * @property Show\Field|Collection goods_pay_price
     * @property Show\Field|Collection pay_code
     * @property Show\Field|Collection status
     * @property Show\Field|Collection voucher_id
     * @property Show\Field|Collection voucher_price
     * @property Show\Field|Collection after_price
     * @property Show\Field|Collection before_price
     * @property Show\Field|Collection email
     * @property Show\Field|Collection token
     * @property Show\Field|Collection tokenable_type
     * @property Show\Field|Collection tokenable_id
     * @property Show\Field|Collection abilities
     * @property Show\Field|Collection last_used_at
     * @property Show\Field|Collection sku_id
     * @property Show\Field|Collection spec_id
     * @property Show\Field|Collection spec_name
     * @property Show\Field|Collection spec_value
     * @property Show\Field|Collection spec_sort
     * @property Show\Field|Collection spec_type
     * @property Show\Field|Collection value_select
     * @property Show\Field|Collection type_name
     * @property Show\Field|Collection sex
     * @property Show\Field|Collection phone
     * @property Show\Field|Collection wechat_account
     * @property Show\Field|Collection wechat_unique_id
     * @property Show\Field|Collection qq
     * @property Show\Field|Collection birthday
     * @property Show\Field|Collection email_verified_at
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection goods_name(string $label = null)
     * @method Show\Field|Collection store_id(string $label = null)
     * @method Show\Field|Collection brand_id(string $label = null)
     * @method Show\Field|Collection category_id(string $label = null)
     * @method Show\Field|Collection goods_body(string $label = null)
     * @method Show\Field|Collection body_images(string $label = null)
     * @method Show\Field|Collection view_num(string $label = null)
     * @method Show\Field|Collection sale_num(string $label = null)
     * @method Show\Field|Collection collect_num(string $label = null)
     * @method Show\Field|Collection goods_attr(string $label = null)
     * @method Show\Field|Collection add_time(string $label = null)
     * @method Show\Field|Collection deleted_at(string $label = null)
     * @method Show\Field|Collection thumb_image(string $label = null)
     * @method Show\Field|Collection medium_image(string $label = null)
     * @method Show\Field|Collection big_image(string $label = null)
     * @method Show\Field|Collection goods_id(string $label = null)
     * @method Show\Field|Collection sku_name(string $label = null)
     * @method Show\Field|Collection main_image(string $label = null)
     * @method Show\Field|Collection images(string $label = null)
     * @method Show\Field|Collection goods_storage(string $label = null)
     * @method Show\Field|Collection is_default(string $label = null)
     * @method Show\Field|Collection putaway_status(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection msg(string $label = null)
     * @method Show\Field|Collection content(string $label = null)
     * @method Show\Field|Collection order_code(string $label = null)
     * @method Show\Field|Collection store_name(string $label = null)
     * @method Show\Field|Collection goods_amount(string $label = null)
     * @method Show\Field|Collection order_amount(string $label = null)
     * @method Show\Field|Collection shipping_fee(string $label = null)
     * @method Show\Field|Collection shipping_code(string $label = null)
     * @method Show\Field|Collection shipping_type(string $label = null)
     * @method Show\Field|Collection order_status(string $label = null)
     * @method Show\Field|Collection refund_status(string $label = null)
     * @method Show\Field|Collection refund_amount(string $label = null)
     * @method Show\Field|Collection payment_type(string $label = null)
     * @method Show\Field|Collection payment_time(string $label = null)
     * @method Show\Field|Collection trade_no(string $label = null)
     * @method Show\Field|Collection sale_type(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection log_msg(string $label = null)
     * @method Show\Field|Collection goods_price(string $label = null)
     * @method Show\Field|Collection goods_num(string $label = null)
     * @method Show\Field|Collection goods_image(string $label = null)
     * @method Show\Field|Collection goods_pay_price(string $label = null)
     * @method Show\Field|Collection pay_code(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection voucher_id(string $label = null)
     * @method Show\Field|Collection voucher_price(string $label = null)
     * @method Show\Field|Collection after_price(string $label = null)
     * @method Show\Field|Collection before_price(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection tokenable_type(string $label = null)
     * @method Show\Field|Collection tokenable_id(string $label = null)
     * @method Show\Field|Collection abilities(string $label = null)
     * @method Show\Field|Collection last_used_at(string $label = null)
     * @method Show\Field|Collection sku_id(string $label = null)
     * @method Show\Field|Collection spec_id(string $label = null)
     * @method Show\Field|Collection spec_name(string $label = null)
     * @method Show\Field|Collection spec_value(string $label = null)
     * @method Show\Field|Collection spec_sort(string $label = null)
     * @method Show\Field|Collection spec_type(string $label = null)
     * @method Show\Field|Collection value_select(string $label = null)
     * @method Show\Field|Collection type_name(string $label = null)
     * @method Show\Field|Collection sex(string $label = null)
     * @method Show\Field|Collection phone(string $label = null)
     * @method Show\Field|Collection wechat_account(string $label = null)
     * @method Show\Field|Collection wechat_unique_id(string $label = null)
     * @method Show\Field|Collection qq(string $label = null)
     * @method Show\Field|Collection birthday(string $label = null)
     * @method Show\Field|Collection email_verified_at(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
