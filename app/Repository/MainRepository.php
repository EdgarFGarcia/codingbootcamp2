<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Item;

class MainRepository{
    public static function insertcategory($data){
        return Category::create([
            'name'      => $data->name
        ]);
    }

    public static function getcategory($item = null){
        if($item > ''){
            return Category::where('name', 'like', "%{$item}%")->get();
        }
        return Category::get();
    }

    public static function edititem($id, $data){
        return Category::where('id', $id)
        ->update([
            'name'      => $data->name
        ]);
    }

    public static function deleteitem($id){
        return Category::where('id', $id)->delete();
    }

    public static function createitem($data){
        return Item::create([
            'name'          => $data->name,
            'category_id'   => $data->category_id
        ]);
    }

    public static function getitems($item = null){
        if($item > ''){
            return Item::with(['categories'])->where('name', 'like', "%{$item}%")->get();
        }
        return Item::with(['categories'])->get();
    }

    public static function edititembyid($id, $data){
        return Item::where('id', $id)
        ->update([
            'name'          => $data->name,
            'category_id'   => $data->category_id
        ]);
    }

    public static function deleteitemviaid($id){
        return Item::where('id', $id)->delete();
    }
}