<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

use Jyotish\Base\Data;
use Jyotish\Base\Locality;
use Jyotish\Base\Analysis;
use Jyotish\Ganita\Method\Swetest;
use Jyotish\Dasha\Dasha;


class HomeController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locality = new Locality([
            'longitude' => "77.80",
            'latitude' => "11.56",
            'altitude' => 0,
        ]);
        $DateTime = new DateTime();
        $DateTime->setTimezone(new DateTimeZone('Asia/Kolkata'));
        $DateTime->setDate(2000, 8, 27);
        $DateTime->setTime(15, 28);

        // $Ganita = new Swetest(["swetest" => "./vendor/kunjara/swetest/win/"]);
        $Ganita = new Swetest(["swetest" => "/usr/bin/"]);

        $data = new Data($DateTime, $locality, $Ganita);
        $data->calcParams();
        $data->calcRising();
        $data->calcPanchanga();

        $data->calcUpagraha();

        $data->calcDasha("vimshottari", null);

        $data->calcExtraLagna();

        $Analysis = new Analysis($data);
        $new = [
			"data" => $data,
			"Analysis" => $Analysis,
		];

        $dasha = $data->getData()['dasha']['vimshottari']['periods'];

        return $new;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
