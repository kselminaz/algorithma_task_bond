<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

# Algorithma bond task

## Apis
  3 api link is created in the task
  - bond interest payout dates
  - create bond order
  - bond interest payout date and amount for bond order
  All api's responses are in the same response format:{status,data,message}

## About bond interest payout dates

  <p> API link: /api/bond/{bond_id}/payouts . The method GET</p>
  <p> If the bond is not found with bond_id the response code will be 404,the response as 
  <code>
   {
    "status": 0,
    "data": [],
    "message": "the bond is not found "
  }
  </code>
  <p> Api link /api/bond/9/payouts </p>
   Api result
   <code>
   {
    "status": 1,
    "data": [
        {
            "date": "2022-02-07"
        },
        {
            "date": "2022-05-09"
        },
        {
            "date": "2022-08-08"
        },
        {
            "date": "2022-11-07"
        }
    ],
    "message": "Interest Payout Dates"
  }
  </code>
   
## About create new  bond order

  <p> Api link: /api/bond/{id}/order . The method POST</p>
  <p> If the bond is not found with 'id' the response code will be 404,the response as 
  <code>
   {
    "status": 0,
    "data": [],
    "message": "the bond is not found "
  }
  </code>

### Error codes
<p>order_date and order_count parameters must be passed and they must be in date format and numeric greater than 0.Response code is 400 
</p>
<p>Order_date bond must be between  "emissiya tarixi"(issue_date) and "son tedavul tarixi"(last_circulation_date).For wrong order_date parametr the response code will be 400 </p> 

### Right parameters and the example

 Parametrs: order_date: 15.10.2022 order_count:5

 Response with 200 status code: 

 <code>{ "status": 1, "data": { "id": 6, "bond": { "id": 9, "issue_date": "2021-11-08", "last_circulation_date": "2022-12-30", "nominal_price": 100, "coupon_payout_frequency": "4", "interest_calculation_period": "360", "coupon_interest": 10 }, "order_date": "2022-10-15", "bond_order_count": "5" }, "message": "Bond Order Model" } 
 </code>

 ## About bond order payouts and amounts

 <p> Api link: /api/bond/order/{order_id} .The method POST </p>
  <p> If the bond is not found with 'order_id' the response code will be 404,the response as 
  <code>
   {
    "status": 0,
    "data": [],
    "message": "the bond order is not found "
  }
  </code>

  The response example:

   /api/bond/order/6

   Response with 200 status code
  <code>
    {
    "status": 1,
    "data": [
        {
            "date": "2022-05-09",
            "amount": 13.3333
        },
        {
            "date": "2022-08-08",
            "amount": 50.5556
        },
        {
            "date": "2022-11-07",
            "amount": 50.5556
        }
    ],
    "message": "Order payout dates and amounts"
}
  </code>

  