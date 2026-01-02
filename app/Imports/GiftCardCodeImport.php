<?php

namespace App\Imports;

use App\Models\GiftCardCode;
use App\Models\Product;
use App\Models\ProductVariant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class GiftCardCodeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $errorException =  array(
            'codes_failed' => [],
            'products_failed' => [],
            'variants_failed' => [],
    );

    public function model(array $row)
    {
        $productId = Product::where('type','gift_card')->where('name',$row['product_name'])->first();
        $giftCardExist = GiftCardCode::where('code', $row['code'])->first();
        if (empty($giftCardExist)) {
            if ($productId) {
                $variantid = ProductVariant::where('product_id',$productId->id)->where('name',$row['variant_name'])->first();
                if ($variantid) {
                    return new GiftCardCode([
                        'product_id'     => $productId->id,
                        'variant_id'           => $variantid->id,
                        'code'           => $row['code']
                    ]);
                } else {
                     $this->errorException['variants_failed'][] = $row['variant_name'];
                }
            } else {
                $this->errorException['products_failed'][] = $row['product_name'];
            }
        } else {
            $this->errorException['codes_failed'][] = $row['code'];
        }
    }
}
