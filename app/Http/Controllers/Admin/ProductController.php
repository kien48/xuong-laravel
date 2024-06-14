<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Catelogue;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\ProductTag;
use App\Models\ProductVariant;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PATH_VIEW = 'admin.products.';
    const PATH_UPLOAD = 'products';
    public function index()
    {
        //
        $data = Product::query()->with(['catelogue','tags'])->latest('id')->get();
        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $catelogues = Catelogue::query()->pluck('name','id')->all();
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        $tags = Tag::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__,compact('catelogues','colors','sizes','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataProduct = $request->except('product_variant','tags','product_galleries');
        $dataProduct['is_active'] = isset($request->is_active) ? 1 : 0;
        $dataProduct['is_hot_deal'] = isset($request->is_hot_deal) ? 1 : 0;
        $dataProduct['is_good_deal'] = isset($request->is_good_deal) ? 1 : 0;
        $dataProduct['is_new'] = isset($request->is_new) ? 1 : 0;
        $dataProduct['is_show_home'] = isset($request->is_show_home) ? 1 : 0;
        $dataProduct['slug'] = Str::slug($dataProduct['name'].'-'.$dataProduct['sku']);
        if($dataProduct['img_thumbnail']){
            $dataProduct['img_thumbnail'] = Storage::put(self::PATH_UPLOAD, $dataProduct['img_thumbnail']);
        }

        $dataProductVariantTmp = $request->product_variant;
        $dataProductVariants= [];
        foreach ($dataProductVariantTmp as $key => $value) {
            $tmp = explode('-',$key);
            $dataProductVariants[] = [
                'product_size_id'=>$tmp[0],
                'product_color_id'=>$tmp[1],
                'quantity'=>$value['quantity'],
                'image'=>$value['image'] ?? null,
            ];
        }

        $dataProductGalleries = $request->product_galleries ?: [];
        $dataTags = $request->tags;


        try {

            DB::beginTransaction();

            /** @var Product $product */
            $product = Product::query()->create($dataProduct);

            foreach ($dataProductVariants as $dataProductVariant) {
                $dataProductVariant['product_id'] = $product->id;
                if($dataProductVariant['image']){
                    $dataProductVariant['image'] = Storage::put(self::PATH_UPLOAD, $dataProductVariant['image']);
                }
                ProductVariant::query()->create($dataProductVariant);
            }

            $product->tags()->sync($dataTags);
            foreach ($dataProductGalleries as $image) {
                ProductGallery::query()->create([
                    'product_id'=>$product->id,
                    'image'=>Storage::put(self::PATH_UPLOAD, $image),
                ]);
            }



            DB::commit();
            return redirect()->route('admin.products.index');
        }catch(\Exception $exception){
            DB::rollBack();
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $dataProduct = Product::query()->findOrFail($id);
        $dataProductVariant = ProductVariant::query()->where('product_id',$id)->get();
        $dataProductGalleries = ProductGallery::query()->where('product_id',$id)->get();
        $dataProductTag = ProductTag::query()->with(['tags'])->where('product_id',$id)->get()->toArray();
        return view(self::PATH_VIEW . __FUNCTION__,compact('dataProduct','dataProductVariant','dataProductGalleries','dataProductTag'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $model = Product::query()->findOrFail($id);
        $catelogues = Catelogue::query()->pluck('name','id')->all();
        $colors = ProductColor::query()->pluck('name','id')->all();
        $sizes = ProductSize::query()->pluck('name','id')->all();
        $tags = Tag::query()->pluck('name','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__,compact('model','catelogues','colors','sizes','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $model = Catelogue::query()->findOrFail($id);

        $data = $request->except('cover');
        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        if ($request->hasFile('cover')){
            $data['cover'] = Storage::put(self::PATH_UPLOAD, $request->file('cover'));
        }
        $currentCover = $model->cover;
        $model->update($data);
        if( $request->hasFile('cover') &&$currentCover && Storage::exists($currentCover)){
            Storage::delete($currentCover);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
//        $variants = $product->variants;
//        foreach ($variants as $variant) {
////            if (Storage::exists($variant->image)) {
////                Storage::delete($variant->image);
////            }
//            dd($variant->image);
//        }

        try {
            DB::transaction(function () use ($product) {
                // Xóa các liên kết với tags
                $product->tags()->sync([]);

                // Lấy danh sách các gallery và xóa các file liên quan
                $galleries = $product->galleries;
                foreach ($galleries as $gallery) {
                    if ($gallery->image && Storage::exists($gallery->image)) {
                        Storage::delete($gallery->image);
                    }
                }
                // Xóa galleries liên quan
                $product->galleries()->delete();

                // Lấy đường dẫn của cover hiện tại
                $currentImgThumbnail = $product->img_thumbnail;

                // Kiểm tra và xóa file cover nếu tồn tại
                if ($currentImgThumbnail && Storage::exists($currentImgThumbnail)) {
                    Storage::delete($currentImgThumbnail);
                }

                // Lấy danh sách các image variants và xóa các file liên quan
                $variants = $product->variants;
                foreach ($variants as $variant) {
                    if ($variant->image && Storage::exists($variant->image)) {
                        Storage::delete($variant->image);
                    }
                }
                // Xóa các biến thể sản phẩm
                $product->variants()->delete();

                // Xóa sản phẩm
                $product->delete();
            },5);

            return back();
        } catch (\Exception $exception) {
            return back();
        }

    }

}
