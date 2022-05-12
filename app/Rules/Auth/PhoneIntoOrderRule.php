<?php

namespace App\Rules\Auth;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PhoneIntoOrderRule implements Rule
{
  private string $order_token;

  /**
   * Create a new rule instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->order_token = strval(request()->cookie('order_token'));
  }

  /**
   * Determine if the validation rule passes.
   *
   * @param  string  $attribute
   * @param  mixed  $value
   * @return bool
   */
  public function passes($attribute, $value)
  {
    $value = strval(filter_var($value, FILTER_SANITIZE_NUMBER_INT));

    $orders = Orders::with('parameters')->where('status', '=', '0')->where('end', '>', Carbon::now()->toDateTimeString())->whereHas('parameters', function(Builder $query) use ($value){
      $query->where('name', '=' , 'phone')->where('value', '=' , $value);
    })->get();

    if ($orders->count() > 0) {
      if ($orders->first()->token !== $this->order_token) {
        return false;
      }
    }

    return true;
  }

  /**
   * Get the validation error message.
   *
   * @return string
   */
  public function message()
  {
    return 'The :attribute has already been taken another user.';
  }
}
