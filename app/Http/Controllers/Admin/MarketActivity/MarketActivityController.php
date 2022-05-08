<?php

namespace App\Http\Controllers\Admin\MarketActivity;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MarketActivity\ParserForm;
use App\Models\MarketActivity;
use App\Parsers\Parser;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\MarketActivity\EditItemForm;

class MarketActivityController extends AdminController
{
  public function index()
  {
    $market_activity = MarketActivity::orderBy('position', 'asc')->get();
    return view('admin.content.market_activity.index', compact('market_activity'));
  }

  public function parserAction(ParserForm $request)
  {
    $validated = $request->safe()->only(['resource', 'count_raw', 'status']);

    $parser = new Parser();
        
    $collection = $parser->parse($validated['resource'], intval($validated['count_raw']));

    foreach ($collection as $key => $item) {

      $market_by_position = MarketActivity::orderBy('position', 'desc')->get();
      if ($market_by_position->count() > 0) {
        $item['position'] = intval($market_by_position->first()->position) + 1;
      } else {
        $item['position'] = 0;
      }

      $item['status'] = $validated['status'];

      MarketActivity::create($item);
    }

    return response()->json(['redirect' => route("admin.marketActivity")]);
  }

  public function sortableAction(Request $request)
  {
    $old_index = intval($request->get('old_index'));
    $new_index = intval($request->get('new_index'));
    $market_id = intval($request->get('market_id'));
    $position_last_market = MarketActivity::orderBy('position', 'desc')->first()->position;

    MarketActivity::where('id', '=', $market_id)->update(['position' => $new_index]);

    if ($old_index === 0) {
      MarketActivity::where('position', '<=', $new_index)->where('id', '!=', $market_id)->decrement('position', 1);
    } elseif($old_index < $new_index) {
      MarketActivity::where('position', '<=', $new_index)->where('position', '>=', $old_index)->where('id', '!=', $market_id)->decrement('position', 1);
    } elseif ($old_index === $position_last_market) {
      MarketActivity::where('position', '>=', $new_index)->where('id', '!=', $market_id)->increment('position', 1);
    } elseif ($old_index > $new_index) {
      MarketActivity::where('position', '>=', $new_index)->where('position', '<=', $old_index)->where('id', '!=', $market_id)->increment('position', 1);
    }
  }

  public function edit(Request $request)
  {
    $item = MarketActivity::where('id', '=', $request->route('item_id'))->get();

    if ($item->count() === 1) {

      $item = $item->first();

      return view('admin.content.market_activity.edit_item', compact('item'));
    }

    abort(404);
  }

  public function editAction(EditItemForm $request)
  {
    $item = MarketActivity::where('id', '=', $request->route('item_id'))->get();

    if ($item->count() === 1) {

      $validated = $request->safe()->only([
        'name', 'volume', 'shift', 
        'floor_price', 'status', 'preview',
        'icon_coin'
      ]);

      $item = $item->first();

      if (empty($request->file('preview')) and trim($request->get('remote_preview')) === $item->preview) {
        $validator = Validator::make($request->all(), ['preview' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      } 

      if (empty($request->file('icon_coin')) and trim($request->get('remote_icon_coin')) === $item->file) {
        $validator = Validator::make($request->all(), ['icon_coin' => 'required']);
        if ($validator->fails()) {
          return response()->json([
            'status' => false,
            'errors' => $validator->errors(),
          ]);
        }
      }

      if (!empty($request->file('preview'))) {
        $validated['preview'] = $request->file('preview')->hashName();
        $request->file('preview')->store('/images/MarketActivity/preview', 'content');
        if (MarketActivity::where('preview', '=', $item->preview)->count() <= 1) {
          Storage::disk('content')->delete('/images/MarketActivity/preview/' . $item->preview);
        }
      } else {
        $validated['preview'] = $item->preview;
      }

      if (!empty($request->file('icon_coin'))) {
        $validated['icon_coin'] = $request->file('icon_coin')->hashName();
        $request->file('icon_coin')->store('/images/MarketActivity/icons_coin', 'content');
        if (MarketActivity::where('icon_coin', '=', $item->icon_coin)->count() <= 1) {
          Storage::disk('content')->delete('/images/MarketActivity/icons_coin/' . $item->icon_coin);
        }
      } else {
        $validated['icon_coin'] = $item->icon_coin;
      }

      $item->update([
        'name' => $validated['name'],
        'volume'=> $validated['volume'],
        'shift' => $validated['shift'],
        'floor_price' => $validated['floor_price'],
        'status' => $validated['status'],
        'preview' => $validated['preview'],
        'icon_coin' => $validated['icon_coin'],
      ]);

      return response()->json([
        'status' => true,
        'title' => 'Information has been saved!'
      ]);
    }

    abort(404);
  }

  public function deleteAction(Request $request)
  {
    $item = MarketActivity::where('id', '=', $request->route('item_id'));
    if ($item->count() > 0) {

      if (MarketActivity::where('preview', '=', $item->first()->preview)->count() <= 1) {
        Storage::disk('public')->delete('/images/MarketActivity/preview/' . $item->first()->preview);
      }

      if (MarketActivity::where('icon_coin', '=', $item->first()->icon_coin)->count() <= 1) {
        Storage::disk('public')->delete('/images/MarketActivity/icons_coin/' . $item->first()->icon_coin);
      }

      $item->delete();

      $market_activity = MarketActivity::orderBy('position', 'asc')->get();
      foreach ($market_activity as $key => $item) {
        $item->position = $key;
        $item->save();
      }

      return response()->json(['result' => true]);
    }

    return response()->json(['result' => false]);
  }
}
