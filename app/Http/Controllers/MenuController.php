<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function nuevoColorMenu(Request $request)
    {
        if ($request->wantsJson()) {

            Menu::truncate();

            $NuevoColorMenu = new Menu();
            $NuevoColorMenu->colorSubMenu = $request->colorSubMenu;
            $NuevoColorMenu->colorMenu = $request->colorMenu;
            $NuevoColorMenu->save();
        }
    }
}
