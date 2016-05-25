<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GrahamCampbell\DigitalOcean\Facades\DigitalOcean;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class DropletController extends Controller
{
    public function getIndex()
    {
        $digital = DigitalOcean::connection('main');
        $droplet = $digital->droplet();
        return view("droplet.index", ["droplets" => $droplet->getAll()]);
    }

    public function getRefresh($id)
    {
        $digital = DigitalOcean::connection('main');
        $droplet = $digital->droplet();
        $drop = $droplet->getById($id);
        if ($drop->status == "active") {
            Session::flash("type", "danger");
            Session::flash("msg", "Shutting down server");
            $droplet->powerOff($id);
        }
        else {
            Session::flash("type", "success");
            Session::flash("msg", "Powering on server");
            $droplet->powerOn($id);
        }
        return redirect()->route('droplet-home');
    }

    public function getDelete($id)
    {
        $digital = DigitalOcean::connection('main');
        $droplet = $digital->droplet();
        $drop = $droplet->getById($id);
        if ($drop->status == "active") {
            $droplet->powerOff($id);
        }
        $droplet->delete($id);
        Session::flash("type", "danger");
        Session::flash("msg", "Deletion started");
        return redirect()->route('droplet-home');
    }

    public function getCreate()
    {
        $faker = \Faker\Factory::create();
        $digital = DigitalOcean::connection('main');
        $droplet = $digital->droplet();
        $droplet->create("Debian-RT-".$faker->firstName, "fra1", "2gb", 17528900);
        Session::flash("type", "success");
        Session::flash("msg", "Creating server");
        return redirect()->route('droplet-home');
    }
}
